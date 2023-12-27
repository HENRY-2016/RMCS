

<!doctype html>
<html>
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>User LogIn</title>

@include('../../header')

</head>
<body class="app-body">
<div class="main-content-card card-register">
<div id="card-content">
<div id="login-logo-div">
    
    </div>
    <div id="card-title">
    @if ($message = Session::get('success'))
        <div class="alert alert-primary" role="alert" >
            <p class="text-center">{{$message}}</p>
        </div>
    @endif


    @if ($errors -> any())
        <div  class="alert alert-danger" role="alert">
            <ul>
            @foreach($errors -> all() as $error)
            <li>{{$error}}</li>
            @endforeach
            </ul>
        </div>
    @endif
    <br>
    
    <label class="login-title-label main-label-style" > Register First.</label>

    </div>
        <form  style="max-width:500px;margin:auto" action="{{route('PatientsResource.store')}}" method="post">
        {{ csrf_field() }}
        <div class="my-grid-containerss">
            <div class="my-grid-item">
                <input id="add-FName" class="text-input-fields" type="text"   name="FName" autocomplete="off" required="required" placeholder="First Name">
            </div>

            <div class="my-grid-item">
                <input id="add-LName" class="text-input-fields" type="text" name="LName" autocomplete="off" required="required" placeholder="Last Name">
            </div>

            <div class="my-grid-item">
                <input id="add-Age" class="text-input-fields" type="text" name="Age" autocomplete="off" required="required" placeholder="Age">
            </div>

            <div class="my-grid-item">
                <input id="add-Area" class="text-input-fields" type="text"  name="Area" autocomplete="off" required="required" placeholder="Area">
            </div>

            <div class="my-grid-item">
                <input id="add-Contact" class="text-input-fields" type="text" name="Contact" autocomplete="off" required="required" placeholder="Contact">
            </div>

            <div class="my-grid-item">
                <input id="add-UserName" class="text-input-fields" type="text"  name="UserName" autocomplete="off" required="required" placeholder="User Name">
            </div>

            <div class="my-grid-item">
                <input id="add-Password" class="text-input-fields" type="text"  name="Password" autocomplete="off" required="required" placeholder="Password">
            </div>

            <div class="my-grid-item">
            <center>

                <button type="submit" style="width: 200px;"  name="user-login-btn" class="btn btn-primary">Register Now</button>&nbsp;
                &nbsp;&nbsp;&nbsp;
                <a  href="{{url('/')}}" style="width: 200px;" class="btn btn-success">Log In</a><br>
                </center>

            </div>
        </div>
    </form>
    <center>

</center>
</div>
</div>

</body>
</html>
