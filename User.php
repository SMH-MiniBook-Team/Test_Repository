<?php

namespace App;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Passport\HasApiTokens;
use Illuminate\Database\Eloquent\SoftDeletes;
use Storage;

class User extends Authenticatable
{
    use Notifiable, HasApiTokens, SoftDeletes;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */

    protected $dates = ['deleted_at'];
    protected $fillable = [
        'name', 'last_name', 'email', 'password', 'birth_date', 'gender', 'country', 'phone', 'active', 'activation_token', 'avatar',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token', 'activation_token'
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];



    protected $appends = ['avatar_url'];
    public function getAvatarUrlAttribute()
    {
        return Storage::url('avatars/'.$this->id.'/'.$this->avatar);
    }

/* ===================== Concerning Friends Request And Users Search ========================*/


    /*mes amis*/
    public function friendsOfMine()
    {
        return $this->belongsToMany('App\User','friends','user_id','friend_id');
    }
    /*les amis de quelqu'un*/
    public function friendof()
    {
        return $this->belongsToMany('App\User','friends','friend_id','user_id');
    }
    /*friends of this user where the user has accepted *//*c'est qq chose comme la jointure en pl Sql*/
    public function friends()
    {
        return $this->friendsOfMine()->wherePivot('accepted',true)->get()->merge($this->friendof()->wherePivot('accepted',true)->get());
    }
    public function friendRequest()
    {
        return $this->friendsOfMine()->wherePivot('accepted', false)->get();
    }
    public function friendRequestPending()
    {
        return $this->friendof()->wherePivot('accepted', false)->get();
    }
    public function hasFriendRequestPending(User $user)
    {
        return (bool) $this->friendRequestPending()->where('id', $user->id)->count();
    }
    public function hasFriendRequestReceived(User $user)
    {
        return (bool) $this->friendRequest()->where('id', $user->id)->count();
    }
    public function addFriend(User $user)
    {
        $this->friendof()->attach($user->id);
    }
    public function deleteFriend(User $user)
    {
        $this->friendof()->detach($user->id);
        $this->friendsOfMine()->detach($user->id);
    }

    public function acceptFriendRequest(User $user)
    {
        $this->friendRequest()->where('id',$user->id)->first()->pivot->update(['accepted' => true,]);
    }
    public function isFriendsWith(User $user)
    {
        return (bool) $this->friends()->where('id', $user->id)->count();
    }
}

/* ===================== ============================================= ========================*/
