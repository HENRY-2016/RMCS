

<!doctype html>
<html>
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>Profile</title>

@include('../../header')

</head>
<body class="app-body">
    <div class="body-content" >
    @include('../navigation/navigation')

	<div class="w3-panel w3-blue w3-round-xlarge page-heading-div">
		<p class="page-name">Patient Profile </p>
        <div class="w3-container total-badge " >
        </div>
    </div>

    <center>
        <div class="card text-white bg-primary mb-3" style="max-width: 25rem;">
            <div class="card-header">Patient Profile</div>
            <div class="card-body">
                <img src="{{asset('imgs/dr-profile.png')}}" class=" card-profile-img">
                <h5 class="card-title">Name</h5>
                <p class="card-title">{{session('user')}}</p>
                <h5 class="card-title">Age</h5>
                <p class="card-title">{{session('age')}}</p>
                <h5 class="card-title">Contact</h5>
                <p class="card-title">{{session('contact')}}</p>
                <h5 class="card-title">About</h5>
                <p class="card-title">{{session('Details')}}</p>

            </div>
            <a  href="{{url('users/doctor/logout')}}" class="btn btn-danger">Log Out</a>
        </div>
    </center>

    </div>
</div>
</body>
</html>

