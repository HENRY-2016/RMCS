

<!doctype html>
<html>
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>User LogIn</title>

  @include('../../header')

</head>
<body class="app-body">
    <div class="main-content-card card-login">
    <div id="card-content">
    <div id="login-logo-div">
      <center>
        <img  class="logo-img" src="{{asset('imgs/user.png')}}" />
      </center>
        </div>
      <div id="card-title">
        @if ($message = Session::get('error'))
          <div class="alert alert-success" >
          <label class="login-title-label main-label-style" > {{$message}}</label>
          </div>
        @endif
      
        <label class="login-title-label main-label-style" > Please Login First.</label>

      </div>
          <form  style="max-width:500px;margin:auto" action="{{url('users/patients/login')}}" method="post">
          {{ csrf_field() }}
            <div class="input-container">
              <input id="username" class="text-input-fields" type="text"  name="UserName" autocomplete="off" required="required" placeholder="Username">
            </div><br>

            

            <div class="input-container">
              <input id="password" class="text-input-fields" type="password" autocomplete="off" required="required" placeholder="Password" name="Password">
            </div><br>
            <button type="submit" name="user-login-btn" class="log-in-btn">Patient Log In</button>
            <br>

      </form>
      <center>
        <br><a  href="{{url('/component/patients/register')}}" class="btn btn-success">Register Now</a>
        <a  href="{{url('/')}}" class="btn btn-primary">Main Menu</a><br>

      </center>
    </div>
  </div>

</body>
</html>
