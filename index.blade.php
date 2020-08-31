
@include('layouts.header')
<!-- Page Wrapper -->
<!-- Content Wrapper -->
@include('layouts.sideBar')
@include('layouts.topBar')



  <style>
      h3{
          margin-left:10px;
          color: green;
          font-size:32px;
          font-weight:bold;
      }
      .line{
          width:100%;
          height:0.1%;
          background-color:#B8B8B8;
      }
      .nfound p{
          width:38%;
          color:gray;
      }
     .nfound h3{
         margin-top:15px;
          color: black;
          font-size:42px;
      }
      .nfound{
          margin-top:35px;
          width:75%;
          margin-left:13%;
          background-color:white;
          border : 1px solid green;
          border-radius:12px;
          height:55%;
      }

      .nfound a{
          padding:13px;
          margin-top:5px;
          margin-bottom:5px;
          color:green;
          border: 1px solid green;
          width:30%;
          height:10%;
          border-radius:12px;
          background-color:white;
      }
      .nfound a:hover{
          background-color:green;
          color:white;
      }


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
    .list{
        list-style-type: none;
        margin-left: 500px;
        margin-top:10px;
        margin-bottom: 20px;

    }
    .infoUser{
        background-color:whitesmoke;
        border-radius:12px;
        margin-left:50px;
        width: 100%;

    }
  </style>


 
<div class="row"> 
       <div class="col-lg-12" > 
       @include('user.partials.userblock')
       <hr>
</div>
<div class="col-lg-4 col-lg-offset-3">

          @if (Auth::user()->hasFriendrequestPending($user))
     <li class="list">
          <i class="fas fa-user-clock" style="color:green;"> 
          <a href="#" style="
    color: green;
"> Waiting for{{ $user->name }} {{ $user->last_name }} To Accept Your Friend Request </a>
          </i>
          <br> <a href="#"
          style="
            font-size: 18px;
            font-family: cursive;
            color: darkgreen;
        "> <i class="fas fa-user"></i> View Profile of {{ $user->name }} {{ $user->last_name }} </a>
        </li>
        @elseif (Auth::user()->hasFriendRequestReceived($user))
        <li class="list">
    <a href=" {{ route('friends.accept', ['id' => $user ->id]) }}" class="btn btn-primary" style="
    
    background-color: green;
    border: none;
">Accept friend request</a>
    <br> <a href="#" style="
            font-size: 18px;
            font-family: cursive;
            color: darkgreen;
        "><i class="fas fa-user"></i>  View Profile of {{ $user->name }} {{ $user->last_name }} </a>
       </li>
        @elseif ( Auth::user()->isFriendsWith($user) )
        <li class="list">
        
         <h6 style="margin-left:-10px;font-size: 22px;font-weight: bold;font-family: sans-serif;color: limegreen;"> 
         <i class="fas fa-user-check"></i>  You and {{ $user->name }} {{ $user->last_name }} Are Friends !</h6>
        <a href="#" style="
            font-size: 18px;
            font-family: cursive;
            color: darkgreen;
            margin-left: -9px;
        "> <i class="fas fa-user"></i>  View Profile of {{ $user->name }} {{ $user->last_name }} </a><br>
    </li>
    <li class="list">
         <form action=" {{ route('friends.delete', ['id' => $user->id]) }}" method="post">
                  <i class="fas fa-user-times" style="color:red; margin-left: -8px;">
                  </i> <input type="submit" value="  Delete friend" class="btn btn-primary"
                      style="
                        background-color: red;
                        border: none;
                        border-radius: 8px;
                    ">
                      <input type="hidden" name="_token" value="{{ csrf_token() }}">
                </form>
       
        @elseif ( Auth::user()->id != $user->id)
    </li>
    <li class="list"><a href="{{ route('friends.add', ['id' => $user->id]) }}" style="
    color: green;
    font-weight: bold;
    font-family: cursive;
"> <i class="fas fa-user-plus"></i>  Add as friend</a>
       <br> <a href="#" style="
            font-size: 18px;
            font-family: cursive;
            color: darkgreen;
        "> <i class="fas fa-user"></i> View Profile of {{ $user->name }} {{ $user->last_name }} </a>
    </li>
    @endif


          
      





</div>

  
            
       
<div class="infoUser">
                <h4 style="
               
               font-size: 45px;
                margin-left: 20px;
                font-family: cursive;
                color: darkgreen;
            
            "> {{ $user->name }}'s friends : </h4>
                @if (!$user->friends()->count()) 
                <p style="
                    font-size: 19px;
                    margin-left: 70px;
                    color: red;
                "> {{ $user->name }} has no friends. </p>
                @else
                    @foreach ($user->friends() as $user)
                            @include('user.partials.userblock')
                            <br>
                            @endforeach
                @endif

             </div>


     
  <!--   <div class="modal fade" id="deleteUsermodal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Are U Sure You Wanna Delete This Person From Your List Friends ?</h5>
                <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
                </div>
            <div class="modal-body">

                <form id="deleteUserForm"  action="#" method="POST" >
                {{ csrf_field() }}
                {{ method_field('DELETE') }}
                <div class="modal-footer">
                <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
                <button type=submit class="btn" name="" data-dismiss="modal" onclick="formSubmit()" style="
                        background-color: red;
                        color:white;
                        "
                        >
                Delete </button>
                </div>
                
                </form>
                                    <script  type=text/javascript>
                                     function deleteUserData(id)
                                          {
                                              var id = id;
                                              var url = '{{ route("friends.delete", ":id") }}';
                                              url = url.replace(':id', id);
                                              $("#deleteUserForm").attr('action', url);
                                          }
                                              function formSubmit()
                                          {
                                              $("#deleteUserForm").submit();
                                          }
                                          </script>-->