<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\PatientsModel; 

class PatientsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = PatientsModel::latest()->get ();
        $total = PatientsModel::count();
        return view('components/patients', compact('data','total')); 
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request -> validate ([
            'FName' => 'required',
            'LName' => 'required',
            'Contact' => 'required',
            'UserName'  => 'required',
            'Age'  => 'required',
            'Area'  => 'required',
            'Password' => 'required',
        ]);

        // insert Data
        $form_data = array(
            'FName' => $request->FName,
            'LName' => $request->LName,
            'UserName'  => $request->UserName,
            'Contact'  => $request->Contact,
            'Age'  => $request->Age,
            'Area'  => $request->Area,
            'Password' => $request->Password,

        );
        PatientsModel::create ($form_data);
        return redirect('/component/patients/register')
            ->with('success','Account Was Successfully Created..Proceed To Log In.');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $data = PatientsModel::findOrFail($id);
        // echo json_encode($data);
        return view('components/patients/show', compact('data'));
        // echo $data;
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $data = PatientsModel::findOrFail($id);
        return response()->json(['data' => $data]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $Id = $request->editId;
            $request -> validate ([
                'FName' => 'required',
                'LName' => 'required',
                'UserName'  => 'required',
                'Contact'  => 'required',
                'Age'  => 'required',
                'Area'  => 'required',
                'Password' => 'required',
            ]);

        // Update Data
        $form_data = array(
            'FName' => $request->FName,
            'LName' => $request->LName,
            'UserName'  => $request->UserName,
            'Contact'  => $request->Contact,
            'Age'  => $request->Age,
            'Area'  => $request->Area,
            'Password' => $request->Password,
        );
        // update
        PatientsModel::whereId ($Id)->update($form_data);
        return redirect('PatientsResource')
            ->with('success','Data Is Successfully Updated');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, $id)
    {
        $rowId = $request->deleteId;
         // delete
        $data = PatientsModel::findOrFail($rowId);
        $data ->delete();
        return redirect('PatientsResource')
            ->with('success','Data Is Successfully deleted');
    }
}
