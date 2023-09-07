

<!doctype html>
<html>
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>Bills</title>

@include('../../header')

</head>
<body class="app-body">
    <div class="body-content" >
    @include('../navigation/navigation')

    <div class="w3-panel w3-blue w3-round-xlarge page-heading-div">
		<p class="page-name">Consultations </p>
        <div class="w3-container total-badge " >
            <p>Total Bills <span class="w3-badge w3-red">{{$total}}</span></p>
        </div>
    </div>

    
    <table>
        <tr>
            <td><span class="space-span" >|||</span></td>
                    <td>
                        @if (session('userType') =='Patient')
                            <button type="button" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#addModal">Add New</button>
                        @endif
                    </td>
            <td><span class="space-span" >|||</span></td>
            <td>
                <form  method="post" action="{{route('ConsultationsResource.store')}}" enctype="multipart/form-data" >
                    {{ csrf_field() }}
                    <div class="my-grid-container">
                        <input  value="{{session('id')}}" type="hidden" name="billId">
                        <button type="submit"  class="btn btn-success ">Consultations Bills</button>
                    </div>
                </form>
            </td>
            <td><span class="space-span" >|||</span></td>
        </tr>
    </table>


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

    {{ csrf_field() }}
		<div class="main-body">
			<br>
			<table class="table table-dark table-hover view-table"  id="table">
				<thead>
					<tr>
                        <th class="text-center">Name</th>
						<th class="text-center">Contact</th>
						<th class="text-center">Service</th>
						<th class="text-center">Fee</th>
						<th class="text-center">Paid Amount</th>
						<th class="text-center">Balance</th>
						<th class="text-center">Date</th>
						<th class="text-center">Payments</th>
						<th class="text-center">Action1</th>
                        @if(session('userType') == 'Admin')
						<th class="text-center">Action2</th>
						<th class="text-center">Action3</th>
                        @endif
					</tr>
				</thead>
                <tbody>
				@foreach($data as $row)
				<tr class="row{{$row->id}}">
                    <td class="text-center">{{$row->Name}}</td>
					<td class="text-center">{{$row->Contact}}</td>
					<td class="text-center">{{$row->Service}}</td>
					<td class="text-center">{{number_format($row->Fee)}}</td>
					<td class="text-center">{{number_format($row->Holder1)}}</td>
					<td class="text-center">{{number_format(($row->Fee) - ($row->Holder1))}}</td>
					<td class="text-center">{{$row->created_at}}</td>

                    <td class="text-center">
                        @if ($row->Holder2 == 'Cleared')
                        <button type="button" class="btn btn-primary">Cleared</button>
                        @else
                        <button type="button" class="btn btn-danger">Pending</button>
                        @endif
                    </td>
                    <td class="text-center">
                        <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-id="{{ $row->id }}" data-bs-target="#showModal">Details</button>
                    </td>
                    @if(session('userType') == 'Admin')
                        <td class="text-center" >
                            <button type="button" class="btn btn-success" data-bs-toggle="modal" data-bs-id="{{ $row->id }}" data-bs-target="#editModal">  Edit</button>
                        </td>
                    
                        <td class="text-center">
                            <button type="button" class="btn btn-danger" data-bs-toggle="modal" data-bs-id="{{ $row->id }}" data-bs-target="#deleteModal">Delete</button>
                        </td>
                    @endif
				</tr>
				@endforeach
                </tbody>
                <tfoot>
                    <tr>
						<th class="text-center"></th>
						<th class="text-center"></th>
						<th class="text-center">Total</th>
						<th class="text-center">{{ number_format($sum)}}</th>
						<th class="text-center">{{ number_format($paid)}}</th>
						<th class="text-center">{{number_format($balance)}}</th>
						<th class="text-center"></th>
						<th class="text-center"></th>
						<th class="text-center"></th>
					</tr>
                </tfoot>
			</table>


    
    <!-- The add Modal -->
    <div class="modal fade modal-lg" id="addModal" tabindex="-1" aria-labelledby="addModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <!-- Modal Header -->
                <div class="modal-header">
                    
                    <p class="modal-title text-center" >Adding New Consultation</p>
                </div>

                <!-- Modal body -->
                <div class="modal-body">
                    <form  action="{{route('ConsultationsResource.store')}}" method="post">
                        
                        {{ csrf_field() }}
                        @include('templates.consultation-add')
                        
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
    <div class="modal fade modal-lg" id="showModal" tabindex="-1" aria-labelledby="showModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <!-- Modal Header -->
                <div class="modal-header">
                    <p class="modal-title text-center" >Viewing A Doctor Details</p>
                </div>

                <!-- Modal body -->
                <div class="modal-body">
                    <table class="table table-borderless" >
                        <tr>
                            <td>
                                <b><p class="text-start">Name</p></b>
                                <p class="text-start" id="show-Name-id" ></p>
                            </td>
                            <td>
                                <b><p class="text-start">Contact</p></b>
                                <p class="text-start" id="show-Contact-id" ></p>
                            </td>
                            <td>
                                <b><p class="text-start">Age</p></b>
                                <p class="text-start" id="show-Age-id" ></p>    
                            </td>
                            <td>
                                <b><p class="text-start">Area</p></b>
                                <p class="text-start" id="show-Area-id" ></p>
                            </td>
                            <td>
                                <b><p class="text-start">Service</p></b>
                                <p class="text-start" id="show-Service-id" ></p>
                            </td>
                            <td>
                                <b><p class="text-start">Fee</p></b>
                                <p class="text-start" id="show-Fee-id" ></p>
                            </td>
                        </tr>
                    </table>
                    
                    <b><p class="text-start">Question</p></b>
                    <p class="text-start" id="show-Question-id" ></p>
                    <b><p class="text-start">Doctor Reply</p></b>
                    <p class="text-start" id="show-Doctor-Reply-id" ></p>
                    <b><p class="text-start">My Reply</p></b>
                    <p class="text-start" id="show-My-Reply-id" ></p>
                    
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
                <p class="modal-title text-center" >Editing An Consultation</p>
            </div>

            <!-- Modal body -->
            <div class="edit-modal-body">
                <form  action="{{route('ConsultationsResource.update','test')}}" method="post">
                    {{method_field('patch')}}
                    {{ csrf_field() }}
                    @include('templates.consultation-edit')
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
                <h5 class="modal-title" id="deleteModalLabel">Deleting An Consultation</h5>
            </div>
            
            <!-- Modal body -->
            <div class="delete-modal-body">
                <br><p class="modal-title text-center" >Are Sure You Want To Delete</p><br>
                <p id="Delete-Name" class="text-center" ></p><br>
                <p id="Delete-Question" class="text-center" ></p><br>
            </div>
            
            <!-- Modal footer -->
            <div class="modal-footer">
                <button type="button" class="btn btn-danger" data-bs-dismiss="modal">No Close</button>
                <form  action="{{route('ConsultationsResource.destroy','testing')}}" method="post">
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
    var RequestUrl = "/ConsultationsResource/"+id+"/edit";
    $.get(RequestUrl, function (data) {
        $('#showModal').modal('show');
        var fee = parseInt(data.data.Fee);
        var Fee = fee.toLocaleString();
        $('#show-Name-id').html(data.data.Name);
        $('#show-Contact-id').html(data.data.Contact);
        $('#show-Age-id').html(data.data.Age);
        $('#show-Area-id').html(data.data.Area);
        $('#show-Question-id').html(data.data.Question);
        $('#show-Service-id').html(data.data.Service);
        $('#show-Fee-id').html(Fee);
        $('#show-Doctor-Reply-id').html(data.data.FeedBack);
        $('#show-My-Reply-id').html(data.data.Reply);
    })
});

$('#editModal').on('show.bs.modal', function(event){
    var target = jQuery(event.relatedTarget)
    var id = target.attr('data-bs-id');
    var RequestUrl = "/ConsultationsResource/"+id+"/edit";
    $.get(RequestUrl, function (data) {
        var fee = parseInt(data.data.Fee);
        var Fee = fee.toLocaleString();
        $('#editModal').modal('show');
        $('#editId').val(data.data.id);
        $('#edit-Name').val(data.data.Name);
        $('#edit-Age').val(data.data.Age);
        $('#edit-Area').val(data.data.Area);
        $('#edit-Contact').val(data.data.Contact);
        $('#edit-Service').val(data.data.Service);
        $('#edit-Fee').val(Fee);
        $('#edit-Consultation').val(data.data.Question);
    })
});


$('#deleteModal').on('show.bs.modal', function(event){
    var target = jQuery(event.relatedTarget)
    var id = target.attr('data-bs-id');
    var RequestUrl = "/ConsultationsResource/"+id+"/edit";
    $.get(RequestUrl, function (data) {
        $('#deleteModal').modal('show');
        $('#deleteId').val(data.data.id);
        $('#Delete-Name').html(data.data.Name);
        $('#Delete-Question').html(data.data.Question);
    })
});


</script>
</body>
</html>

