<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\PatientsModel;
use App\Models\DoctorModel;
use App\Models\AdminModel;

class UserAuthenticationController extends Controller
{
    function adminLogIn (Request $request)
    {
        $UserName = $request->UserName;
        $Password = $request->Password;

        $data = AdminModel::where('UserName',$UserName)
        ->where('Password',$Password)
        ->get(['FName','LName','Contact','UserName','Password','id']);

        $length = count ($data);
        if ($length == 0) 
        {
            return redirect('admin/login')
            ->with('error','Sorry No User Records Found');
            }

        elseif ($length !== 0)
        {
            $UserType = "Admin";
            $DbFName =  $data[0]["FName"];
            $DbId =  $data[0]["id"];
            $DbLName =  $data[0]["LName"];
            $DbContact =  $data[0]["Contact"];
            $DbUserName =  $data[0]["UserName"];
            $DbPassword =  $data[0]["Password"];

            $UserFullName = $DbFName. " " . " ". $DbLName; 


            if (($DbUserName === $UserName) && ($DbPassword === $Password))
            {
                $request->session()->put('user',$UserFullName);
                $request->session()->put('id',$DbId);
                $request->session()->put('contact',$DbContact);
                $request->session()->put('userType',$UserType);
                return redirect('profile/admin');
            }
        }
    }

    function patientsLogIn (Request $request)
    {
        $UserName = $request->UserName;
        $Password = $request->Password;

        $data = PatientsModel::where('UserName',$UserName)
        ->where('Password',$Password)
        ->get(['FName','LName','Contact','Age','Area','UserName','Password','id']);

        $length = count ($data);
        if ($length == 0) 
        {
            return redirect('patients/login')
            ->with('error','Sorry No User Records Found');
            }

        elseif ($length !== 0)
        {
            $UserType = "Patient";
            $DbFName =  $data[0]["FName"];
            $DbId =  $data[0]["id"];
            $DbLName =  $data[0]["LName"];
            $DbContact =  $data[0]["Contact"];
            $DbAge =  $data[0]["Age"];
            $DbArea =  $data[0]["Area"];
            $DbUserName =  $data[0]["UserName"];
            $DbPassword =  $data[0]["Password"];

            $UserFullName = $DbFName. " " . " ". $DbLName; 


            if (($DbUserName === $UserName) && ($DbPassword === $Password))
            {
                $request->session()->put('user',$UserFullName);
                $request->session()->put('age',$DbAge);
                $request->session()->put('id',$DbId);
                $request->session()->put('area',$DbArea);
                $request->session()->put('contact',$DbContact);
                $request->session()->put('userType',$UserType);
                return redirect('profile/patient');
            }
        }
    }

    function doctorLogIn (Request $request)
    {
        $UserName = $request->UserName;
        $Password = $request->Password;

        $data = DoctorModel::where('UserName',$UserName)
        ->where('Password',$Password)
        ->get(['FName','LName','Contact','Details','UserName','Password','id']);

        $length = count ($data);
        if ($length == 0) 
        {
            return redirect('patients/login')
            ->with('error','Sorry No User Records Found');
            }

        elseif ($length !== 0)
        {
            $UserType = "Doctor";
            $DbFName =  $data[0]["FName"];
            $DbId =  $data[0]["id"];
            $DbLName =  $data[0]["LName"];
            $DbContact =  $data[0]["Contact"];
            $DbDetails =  $data[0]["Details"];
            $DbUserName =  $data[0]["UserName"];
            $DbPassword =  $data[0]["Password"];

            $UserFullName = $DbFName. " " . " ". $DbLName; 


            if (($DbUserName === $UserName) && ($DbPassword === $Password))
            {
                $request->session()->put('user',$UserFullName);
                $request->session()->put('details',$DbDetails);
                $request->session()->put('id',$DbId);
                $request->session()->put('contact',$DbContact);
                $request->session()->put('userType',$UserType);
                return redirect('profile/doctor');
            }
        }
    }
}
