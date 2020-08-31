
<style>
      .found{
          padding:10px;
        margin-top:35px;
          width:75%;
          margin-left:5%;
          background-color:white;
          border : 1px solid #B8B8B8;
          border-radius:12px;
          height:fit-content;
      }
      .found .info{
          margin-left:100px;
          margin-top:-90px;
      }

      .found  .infoPlus{
        width:200px;
        float:right;
        margin-top:-100px;
    }
    .found  .infoPlus a{
        margin-right:25px;
        font-weight: bold;
        color: green;
    }
    .found  .infoPlus a i{
        margin-left:5px;
    }
  </style>





<div class="found">
<a href="{{ route('profile.index', ['id' => $user->id]) }}">
            <img style="margin-right: 5px;" class="img-profile rounded-circle" src="{{asset('storage/' . config('chatify.user_avatar.folder') . '/' .$user->avatar )}}" width="85" height="85" alt="avatar">
            <div class="info">
                <h1 style="
           color: lightseagreen;
              ">{{ $user->name }} {{ $user->last_name }}</h1>
                @if ($user->birth_date) 
                <h5 style="
           color: lightseagreen;
              ">Born On : {{ $user->birth_date }}</h5>
                @endif
                @if ($user->country)
                <h5 style="
           color: lightseagreen;
              "> From : {{  $user->country }}</h5>
                @endif
                </div>
</a>
 </div>