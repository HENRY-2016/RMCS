

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
		<p class="page-name">Admin Profile </p>
        <div class="w3-container total-badge " >
        </div>
    </div>

    <center>
        <div class="card text-white bg-primary mb-3" style="max-width: 25rem;">
            <div class="card-header">User Profile</div>
            <div class="card-body">
                <img src="{{asset('imgs/admin-2.png')}}" class=" card-profile-img">
                <h5 class="card-title">Role</h5>
                <p class="card-text">Admin</p>
                <h5 class="card-title">Role</h5>
                <p class="card-text">Admin</p>
            </div>
            <a  href="{{url('/users/admin/logout')}}" class="btn btn-danger">Log Out</a>
        </div>
    </center>

    </div>
</div>
</body>
</html>

