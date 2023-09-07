

<!doctype html>
<html>
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>Welcome</title>

<script src="{{asset('js/main.js')}}"></script>
<link rel="stylesheet" type="text/css" href="{{asset('css/main.css')}}">
<link rel="stylesheet" type="text/css" href="{{asset('css/w3.css')}}">
</head>
<body class="app-body">
<div class="main-content-card card-welcome">
<div id="card-content">
<div id="login-logo-div">
    <center>
    <img  class="welcome-img" src="{{asset('imgs/log-2.png')}}" />
    </center>
    </div>
    <div id="card-title">
    <label class="login-title-label main-label-style" > ...Welcome Back.. </label><br>
    <label class="login-title-label main-label-style" > Please Select</label><br>
    <label class="login-title-label main-label-style" > Login Account</label>


    </div>
    <a href="{{url('/patients/login')}}" > 
    <button type="button"    class="log-in-btn welcome-labels main-label-style">Log In As Patient</button>
    </a>
    <br><br>
    <a href="{{url('/admin/login')}}" >
    <button type="button"    class="log-in-btn welcome-labels main-label-style">Log In As Admin</button>
    </a>
    <br><br>
    <a href="{{url('/doctor/login')}}" >
    <button type="button"    class="log-in-btn welcome-labels main-label-style">Log In As Doctor</button>
    </a>
    <br><br>
    
</div>
</div>

</body>
</html>
