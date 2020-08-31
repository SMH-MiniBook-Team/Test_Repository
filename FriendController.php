<?php

namespace App\Http\Controllers;
use App\User;
use Illuminate\Http\Request;
use Auth;


class FriendController extends Controller
{
      public function getIndex()
      {
          $friends = Auth::user()->friends();
          $requests= Auth::user()->friendRequest();

          return view('friends.index')
          ->with('friends', $friends)
          ->with('requests', $requests);
      }


      public function getAdd($id)
      {
          $user = User::where('id', $id)->first();
//check if the user doesn't exist
          if(!$user) {
              return redirect()
              ->route('profile.index')
              ->with('info','That user could not be found.');
          }
//make sure to not add yourself
           if (Auth::user()->id === $user->id) {
               return redirect()->route('home');
           }

//check if the friend request already exists
          if(Auth::user()->hasFriendRequestPending($user) || $user->hasFriendRequestPending(Auth::user())) {
            return redirect()
            ->route('profile.index', ['id' => $user->id])
            ->with('info','Friend request already pending.');
        }
//check if the person is already a friend with the user
           if(Auth::user()->isFriendsWith($user)) {
               return redirect()
               ->route('profile.index',['id' => $user->id])
               ->with('info','You are already friends.');
           }
//now we're sure that we accualy CAN add a friend
        Auth::user()->addFriend($user);
        return redirect()
        ->route('profile.index',['id' => $id])
        ->with('info','Friend request sent.');
        
      }



      public function getAccept($id)
      {
          $user = User::where('id', $id)->first();

          if(!$user) {
            return redirect()
            ->route('search.results')
            ->with('message','That user could not be found.');
        }
          if(!Auth::user()->hasFriendRequestReceived($user)) {
              return redirect()->route('home');
          }
          Auth::user()->acceptFriendRequest($user);

          return redirect()
                ->route('search.results', ['id' => $id])
                ->with('message', 'Friend request accepted.');
      }




      public function postDelete($id)
      {
         $user = User::where('id', $id)->first();

         if (!Auth::user()->isFriendsWith($user)) {
             return redirect()->back();
         }

         Auth::user()->deleteFriend($user);
         return redirect()->back()->with('message', 'Friend deleted');
      }
}