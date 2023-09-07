<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ServicesModel;

class ServicesController extends Controller
{
     /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = ServicesModel::latest()->get ();
        $total = ServicesModel::count();
        return view('components/services', compact('data','total')); 
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
            'Name' => 'required',
            'Description' => 'required',
            'Amount'  => 'required',
        ]);

        // insert Data
        $form_data = array(
            'Name' => $request->Name,
            'Description' => $request->Description,
            'Amount'  => $request->Amount,
        );
        ServicesModel::create ($form_data);
        return redirect('ServicesResource')
            ->with('success','Data Added successfully.');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $data = ServicesModel::findOrFail($id);
        // echo json_encode($data);
        return view('components/services/show', compact('data'));
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
        $data = ServicesModel::findOrFail($id);
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
                'Name' => 'required',
                'Description' => 'required',
                'Amount'  => 'required',
            ]);

        // Update Data
        $form_data = array(
            'Name' => $request->Name,
            'Description' => $request->Description,
            'Amount'  => $request->Amount,
        );
        // update
        ServicesModel::whereId ($Id)->update($form_data);
        return redirect('ServicesResource')
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
        $data = ServicesModel::findOrFail($rowId);
        $data ->delete();
        return redirect('ServicesResource')
            ->with('success','Data Is Successfully deleted');
    }
}
