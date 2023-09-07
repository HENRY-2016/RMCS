
<div id="navigation-div" >
    <ul class="main-navigation-ul">
        @if (session('userType') == 'Admin')
            <li class="main-navigation-li"><a href="{{url('profile/admin')}}">Profile</a></li>
        @endif
        @if (session('userType') == 'Patient')
            <li class="main-navigation-li"><a href="{{url('profile/patient')}}">Profile</a></li>
        @endif
        @if (session('userType') == 'Doctor')
            <li class="main-navigation-li"><a href="{{url('profile/doctor')}}">Profile</a></li>
        @endif
        @if (session('userType') == 'Doctor' || session('userType') === 'Admin')
        <li class="main-navigation-li" ><a href="{{url('component/consultation')}}">Consultations</a></li>
        <li class="main-navigation-li"><a href="{{url('component/patients')}}">Patients</a></li>
        @endif
        <li class="main-navigation-li"><a href="{{url('component/doctor')}}">Doctors</a></li>
        <li class="main-navigation-li"><a href="{{url('component/services')}}">Services</a></li>
        @if(session('userType')=='Patient')
            <form  method="post" action="{{route('ConsultationsResource.store')}}" enctype="multipart/form-data" >
                {{ csrf_field() }}
                    <input  value="{{session('id')}}" type="hidden" name="id">
                    <button type="submit" class="main-navigation-patient" >Consultations</button>
            </form>

        @endif
        @if(session('userType')=='Doctor')
        <li class="btn btn-danger log-out-btn" ><a  style="text-decoration: none;" href="/users/doctor/logout" class="log-out-btn">Log Out</a></li>
        @endif
        @if(session('userType')=='Patient')
        <li class="btn btn-danger log-out-btn-patient" ><a  style="text-decoration: none;" href="/users/patients/logout" class="log-out-btn">Log Out</a></li>
        @endif
        @if(session('userType')=='Admin')
        <li class="btn btn-danger log-out-btn" ><a  style="text-decoration: none;" href="/users/admin/logout" class="log-out-btn">Log Out</a></li>
        @endif
    </ul>
</div>