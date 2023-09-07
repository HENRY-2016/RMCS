

<!doctype html>
<html>
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>Patients</title>

@include('../../header')

</head>
<body class="app-body">
    <div class="body-content" >
    @include('../navigation/navigation')

	<div class="w3-panel w3-blue w3-round-xlarge page-heading-div">
		<p class="page-name">Patients </p>
        <div class="w3-container total-badge " >
            <p>Total Patients <span class="w3-badge w3-red">{{$total}}</span></p>
        </div>
    </div>
    @if(session('userType')=='Admin')
        <button type="button" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#addModal">Add New</button><br>
    @endif
	

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

    {{ csrf_field() }}
		<div class="main-body" >
			<table class="table table-dark table-hover view-table"  id="table">
				<thead>
					<tr>
                        <th class="text-center">First Name</th>
						<th class="text-center">Last Name</th>
						<th class="text-center">UserName</th>
						<th class="text-center">Age</th>
						<th class="text-center">Contact</th>
						<th class="text-center">Date</th>
						<th class="text-center">Action1</th>
                        @if(session('userType')=='Admin')
						<th class="text-center">Action2</th>
						<th class="text-center">Action3</th>
                        @endif
					</tr>
				</thead>
				@foreach($data as $row)
				<tr class="row{{$row->id}}">
                    <td class="text-center">{{$row->FName}}</td>
					<td class="text-center">{{$row->LName}}</td>
					<td class="text-center">{{$row->UserName}}</td>
					<td class="text-center">{{$row->Age}}</td>
					<td class="text-center">{{$row->Contact}}</td>
					<td class="text-center">{{$row->created_at}}</td>
                    <td class="text-center">
                        <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-id="{{ $row->id }}" data-bs-target="#showModal">Details</button>
                    </td>
                    @if(session('userType')=='Admin')
                    <td class="text-center" >
                        <button type="button" class="btn btn-success" data-bs-toggle="modal" data-bs-id="{{ $row->id }}" data-bs-target="#editModal">Edit</button>
                    </td>
                    <td class="text-center">
                        <button type="button" class="btn btn-danger" data-bs-toggle="modal" data-bs-id="{{ $row->id }}"  data-bs-target="#deleteModal">Delete</button>
                    </td>
                    @endif
				</tr>
				@endforeach
			</table>


    
    <!-- The add Modal -->
    <div class="modal fade modal-lg" id="addModal" tabindex="-1" aria-labelledby="addModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <!-- Modal Header -->
                <div class="modal-header">
                    <p class="modal-title text-center" >Adding A New Patient</p>
                </div>

                <!-- Modal body -->
                <div class="modal-body">
                    <form  action="{{route('PatientsResource.store')}}" method="post">
                        
                        {{ csrf_field() }}
                        @include('templates.patient-add')
                        
                    </form>
                </div>
            
            <!-- Modal footer -->
            <div class="modal-footer">
                <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Close</button>
            </div>
            </div>
        </div>
    </div>

    <!-- The show Modal -->
    <div class="modal fade modal-sm" id="showModal" tabindex="-1" aria-labelledby="showModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <!-- Modal Header -->
                <div class="modal-header">
                    <p class="modal-title text-center" >Viewing A Patient Details</p>
                </div>

                <!-- Modal body -->
                <div class="modal-body">
                    <b><p class="text-start">Name</p></b>
                    <p class="text-start" id="show-Name-id" ></p>
                    <b><p class="text-start">Contact</p></b>
                    <p class="text-start" id="show-Contact-id" ></p>
                    <b><p class="text-start">Age</p></b>
                    <p class="text-start" id="show-Age-id" ></p>
                    <b><p class="text-start">Area</p></b>
                    <p class="text-start" id="show-Area-id" ></p>
                    <b><p class="text-start">User Name</p></b>
                    <p class="text-start" id="show-UserName-id" ></p>
                    <b><p class="text-start">Password</p></b>
                    <p class="text-start" id="show-Password-id" ></p>
                </div>
            
            <!-- Modal footer -->
            <div class="modal-footer">
                <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Close</button>
            </div>
            </div>
        </div>
    </div>

    <!-- The edit Modal -->
    <div class="modal fade modal-lg" id="editModal" tabindex="-1" aria-labelledby="editModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
            <!-- Modal Header -->
            <div class="modal-header">
                <p class="modal-title text-center" >Editing A Patient</p>
            </div>

            <!-- Modal body -->
            <div class="edit-modal-body">
                <form  action="{{route('PatientsResource.update','null')}}" method="post">
                    {{method_field('patch')}}
                    {{ csrf_field() }}
                    @include('templates.patient-edit')
                    <input type="hidden"  id="editId" name="editId" >
                </form>
            </div>
            
            <!-- Modal footer -->
            <div class="modal-footer">
                <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Close</button>
            </div>
            </div>
        </div>
    </div>


    <!-- The delete Modal -->
    <div class="modal fade" id="deleteModal" tabindex="-1" aria-labelledby="deleteModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="deleteModalLabel">Deleting A Patient</h5>
            </div>
            
            <!-- Modal body -->
            <div class="delete-modal-body">
                <br><p class="modal-title text-center" >Are Sure You Want To Delete</p><br>
                <p id="Delete-Name" class="text-center" ></p><br>
            </div>
            
            <!-- Modal footer -->
            <div class="modal-footer">
                <button type="button" class="btn btn-danger" data-bs-dismiss="modal">No Close</button>
                <form  action="{{route('PatientsResource.destroy','null')}}" method="post">
                    {{ csrf_field() }}
                    {{method_field('DELETE')}}
                    <button  type="submit" class="btn btn-primary" data-bs-dismiss="modal">Yes Delete</button>
                    <input type="hidden"  id="deleteId" name="deleteId" >
                </form>
            </div>
            </div>
        </div>
    </div>



    </div>
    </div>
    <script>

$(document).ready(function() {$('#table').DataTable();});

$('#showModal').on('show.bs.modal', function(event){
    var target = jQuery(event.relatedTarget)
    var id = target.attr('data-bs-id');
    var RequestUrl = "/PatientsResource/"+id+"/edit";
    $.get(RequestUrl, function (data) {
        $('#showModal').modal('show');
        var Name = data.data.FName +" "+ " "+ data.data.LName;
        $('#show-Name-id').html(Name);
        $('#show-Contact-id').html(data.data.Contact);
        $('#show-Age-id').html(data.data.Age);
        $('#show-Area-id').html(data.data.Age);
        $('#show-UserName-id').html(data.data.UserName);
        $('#show-Password-id').html(data.data.Password);

    })
});

$('#editModal').on('show.bs.modal', function(event){
    var target = jQuery(event.relatedTarget)
    var id = target.attr('data-bs-id');
    var RequestUrl = "/PatientsResource/"+id+"/edit";
    $.get(RequestUrl, function (data) {
        $('#editModal').modal('show');
        $('#editId').val(data.data.id);
        $('#edit-FName').val(data.data.FName);
        $('#edit-LName').val(data.data.LName);
        $('#edit-Contact').val(data.data.Contact);
        $('#edit-Area').val(data.data.Area);
        $('#edit-UserName').val(data.data.UserName);
        $('#edit-Password').val(data.data.Password);
        $('#edit-Age').val(data.data.Age);
    })
});

$('#deleteModal').on('show.bs.modal', function(event){
    var target = jQuery(event.relatedTarget)
    var id = target.attr('data-bs-id');
    var RequestUrl = "/PatientsResource/"+id+"/edit";
    $.get(RequestUrl, function (data) {
        $('#deleteModal').modal('show');
        $('#deleteId').val(data.data.id);
        var Name = data.data.FName +" "+ " "+ data.data.LName;
        $('#Delete-Name').html(Name);
    })
});


</script>
</body>
</html>

