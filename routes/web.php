<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Artisan;
use App\Http\Controllers\UserAuthenticationController;
use App\Http\Controllers\DoctorController;
use App\Http\Controllers\PatientsController;
use App\Http\Controllers\ServicesController;
use App\Http\Controllers\ConsultationsController;
use App\Models\AdminModel;
// Models
use App\Models\ServicesModel;
use App\Models\DoctorModel;
use App\Models\PatientsModel;
use App\Models\ConsultationsModel;


// migrate db tables
Route::get('/migrate', function(){
    Artisan::call('migrate'); 
    dd('Migrations Done!');
});

//Clear route cache:
Route::get('/cache-clear', function() {
    Artisan::call('route:cache');
    return 'Routes cache cleared';
});

//Clear config cache:
Route::get('/config-cache', function() {
    Artisan::call('config:cache');
    return 'Config cache cleared';
}); 

// Clear application cache:
Route::get('/clear-cache', function() {
    Artisan::call('cache:clear');
    return 'Application cache cleared';
});

// Clear view cache:
Route::get('/view-clear', function() {
    Artisan::call('view:clear');
    return 'View cache cleared';
});

 //Clear route cache:
Route::get('/route-cache', function() {
    Artisan::call('route:cache');
    return 'Routes cache cleared';
});

//Clear config cache:
Route::get('/config-cache', function() {
    Artisan::call('config:cache');
    return 'Config cache cleared';
}); 





Route::get('/', function () {return view('welcome');});


// Logins
Route::get('/patients/login', function () {return view('login/patients');});
Route::get('/admin/login', function () {return view('login/admin');});
Route::get('/doctor/login', function () {return view('login/doctor');});


Route::post('users/admin/login',[UserAuthenticationController ::class,'adminLogIn']);
Route::post('users/patients/login',[UserAuthenticationController ::class,'patientsLogIn']);
Route::post('users/doctor/login',[UserAuthenticationController ::class,'doctorLogIn']);



// Log out
Route::get('users/admin/logout', function () 
{
    if (session()->has('user')){session()->pull('user');}
    return redirect('/admin/login');
});

Route::get('users/patients/logout', function () 
{
    if (session()->has('user')){session()->pull('user');}
    return redirect('/patients/login');
});

Route::get('users/doctor/logout', function () 
{
    if (session()->has('user')){session()->pull('user');}
    return redirect('/doctor/login');
});



// Profile
Route::get('profile/admin', function () 
{if (session()->has('user')) {return view('profile/admin');}return view('welcome');});

Route::get('profile/patient', function () 
{if (session()->has('user')) {return view('profile/patient');}return view('welcome');});

Route::get('profile/doctor', function () 
{if (session()->has('user')) {return view('profile/doctor');}return view('welcome');});

Route::get('/admin/doctor/add', function () 
{
    if (session()->has('user')) {
        return view('admin/doctor/add');
    }
    return view('welcome');
});
Route::get('/admin/patients/add', function () 
{
    if (session()->has('user')) {
        return view('admin/patients/add');
    }
    return view('welcome');
});
Route::get('/admin/services/add', function () 
{
    if (session()->has('user')) {
        return view('admin/services/add');
    }
    return view('welcome');
});


Route::get('/admin/doctors/view', function () 
{   
    if (session()->has('user')) {
        $data = DoctorModel::latest()->get ();
        $total = DoctorModel::count();
        return view('admin/doctor/view', compact('data','total')); 
    }
    return view('welcome');
});

// Components
Route::get('/component/patients', function () 
{   
    if (session()->has('user')) {
        $data = PatientsModel::latest()->get ();
        $total = PatientsModel::count();
        return view('components/patients', compact('data','total')); 
    }
    return view('welcome');
});

Route::get('/component/patients/register', function () 
{return view('components/pateints-register');});

Route::get('/component/consultation', function () 
{   
    if (session()->has('user')) {
        $data = ConsultationsModel::latest()->get ();
        $total = ConsultationsModel::count();
        $services = ServicesModel::get(['Name']);
        return view('components/consultation', compact('data','total','services')); 
    }
    return view('welcome');
});
Route::get('/component/consultation/bills', function () 
{   
    if (session()->has('user')) {
        $data = ConsultationsModel::latest()->get ();
        $total = ConsultationsModel::count();
        $sum = ConsultationsModel::sum('Fee');
        $paid = ConsultationsModel::sum('Holder1');
        $services = ServicesModel::get(['Name']);
        $balance = $sum - $paid;
        return view('components/adminBills', compact('data','total','sum','paid','balance','services')); 
    }
    return view('welcome');
});
Route::get('/component/admin', function () 
{
    if (session()->has('user')) {
        $data = AdminModel::latest()->get ();
        $total = AdminModel::count();
        return view('components/admin',compact('data','total'));
    }
    return view('welcome');
});
Route::get('/component/doctor', function () 
{
    if (session()->has('user')) {
        $data = DoctorModel::latest()->get ();
        $total = DoctorModel::count();
        return view('components/doctor',compact('data','total'));
    }
    return view('welcome');
});

Route::get('/component/services', function () 
{   
    if (session()->has('user')) {
        $data = ServicesModel::latest()->get ();
        $total = ServicesModel::count();
        return view('components/services', compact('data','total')); 
    }
    return view('welcome');
});



Route::get('get/service/amount/{name}',[ConsultationsController::class,'getServiceAmount']);


// resources
Route::resource('AdminResource',AdminController::class);
Route::resource('DoctorResource',DoctorController::class);
Route::resource('PatientsResource',PatientsController::class);
Route::resource('ServicesResource',ServicesController::class);
Route::resource('ConsultationsResource',ConsultationsController::class);

