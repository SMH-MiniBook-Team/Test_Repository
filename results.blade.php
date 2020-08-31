
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
  </style>




<h3> Your search for "{{ Request::input('query') }} " : </h3>
<div class="line"></div>
 @if (!$users->count()) 
 <div class="nfound">
     <center>
<img src="img/crying.gif" alt="Funny image">
 <h3> Oops! User Not Found. </h3>
 <p> You must have picked the wrong user because we 
     couldn't found it ! either you type it wrong, either it dosen't exist !
 </p>
<br>
 <a href="{{ url('/home') }}"> Back To Home Page</a>

 </center>
 </div>
  @else
   <div class="row"> 
       <div class="col-lg-12" > 
       @foreach ($users as $user)

       @include('user/partials/userblock')
       
         @endforeach
        </div>
     </div>
     @endif 
     
     <div class="modal fade" id="deleteUsermodal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
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
                                    <script>
                                              function formSubmit()
                                          {
                                              $("#deleteUserForm").submit();
                                          }
                                          </script>