<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ConsultationsModel;

class ConsultationsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = ConsultationsModel::latest()->get ();
        $total = ConsultationsModel::count();
        return view('components/consultation', compact('data','total')); 
        
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
    
        
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $id = $request->input('id');
        $billId = $request->input('billId');
        $Admin = $request->input('Admin');
        if ($id)
        {
            $data = ConsultationsModel::where('UserId',$id) -> get();
            $total = ConsultationsModel::where('UserId',$id) ->count();
            return view('components/consultation', compact('data','total')); 
        }
        if ($billId)
        {
            $sum = ConsultationsModel::where('UserId',$billId)->sum('Fee');
            $paid = ConsultationsModel::where('UserId',$billId)->sum('Holder1');
            $total = ConsultationsModel::where('UserId',$billId) ->count();
            $data = ConsultationsModel::where('UserId',$billId) -> get();
            return view('components/bill', compact('data','sum','total','paid')); 
        }

        if ($Admin)
        {
            $sum = ConsultationsModel::sum('Fee');

            $data = ConsultationsModel::get();
            return view('components/consultations/bill', compact('data','sum')); 
        }


        $request -> validate ([
            'Name' => 'required',
            'Contact' => 'required',
            'Age'  => 'required',
            'UserId'=>'required',
            'Area'  => 'required',
            'Service' => 'required',
            'Fee' => 'required',
            'Consultation'=>'required',
        ]);

        // insert Data
        $status = 'Pending';
        $reply = 'Pending';
        $bill = 00000;
        $form_data = array(
            'Name' => $request->Name,
            'UserId' => $request->UserId,
            'Contact'  => $request->Contact,
            'Age'  => $request->Age,
            'Area'  => $request->Area,
            'Service' => $request->Service,
            'Fee'  => $request->Fee,
            'Question' => $request->Consultation,
            'Reply' => "",
            'FeedBack' => "",
            'Holder1' => $bill,
            'Holder2' => $status,
            'Holder3' => "",
            'Holder4' => "",
            'Holder5' => "",
            'Holder6' => "",
            'Holder7' => "",
            'Holder8' => "",
            'Holder9' => $reply,
            'Holder10' => "",
        );
        ConsultationsModel::create ($form_data);
        return redirect('ConsultationsResource')
        // return view('/components/consultations/add')
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
        $data = ConsultationsModel::findOrFail($id);
        // echo json_encode($data);
        return view('components/consultations/show', compact('data'));
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
        $data = ConsultationsModel::findOrFail($id);
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
        $payId = $request->input('payId');

        if($request->has('FeedBack') && !empty($request->input('FeedBack'))) 
            {
                $request -> validate (['FeedBack' => 'required',]);
    
            // Update Data
            $form_data = array('FeedBack' => $request->FeedBack,);
            // update
            ConsultationsModel::whereId ($Id)->update($form_data);
            return view('components/profile')
                ->with('success','Data Is Successfully Updated');

            }

        if($request->has('Reply') && !empty($request->input('Reply'))) 
            {
                $request -> validate (['Reply' => 'required',]);
            // Update Data
            $form_data = array('Reply' => $request->Reply,);
            // update
            ConsultationsModel::whereId ($Id)->update($form_data);
            return view('doctors/profile')
                ->with('success','Data Is Successfully Updated');
            }

        if($request->has('ClientFeedBack') && !empty($request->input('ClientFeedBack'))) 
            {
                $feedBackId = $request->feedBackId;
                $request -> validate (['ClientFeedBack' => 'required',]);
            // Update Data
            $form_data = array('FeedBack' => $request->ClientFeedBack);
            // update
            ConsultationsModel::whereId ($feedBackId)->update($form_data);
            return redirect('profile/patient')
                ->with('success','Your Feed Back Successfully Received');
            }
        
        if($request->has('DoctorReply') && !empty($request->input('DoctorReply'))) 
            {
                $replyId = $request->replyId;
                $reply = 'Replied';
                $request -> validate (['DoctorReply' => 'required',]);
            // Update Data
            $form_data = array(
                                'Reply' => $request->DoctorReply,
                                'Holder10' => $request->DoctorsName,
                                'Holder9' => $reply,
                            );
            // update
            ConsultationsModel::whereId ($replyId)->update($form_data);
            return redirect('ConsultationsResource')
                ->with('success','Thank You For Replying Our Patient');
            }
        
        if($request->has('Payment') && !empty($request->input('Payment'))) 
            {
                $status = 'Cleared';
                $request -> validate (['Payment' => 'required',]);
                // Update Data
                $form_data = array(
                                    'Holder1' => $request->Payment,
                                    'Holder2' => $status,
                                );
                // update
                ConsultationsModel::whereId ($payId)->update($form_data);
                return redirect('ConsultationsResource')
                    ->with('success','Payment Has Been Successfully Updated');
            }
        
        //     $request -> validate ([
        //         'Name' => 'required',
        //         'UserId' => 'required',
        //         'UserName'  => 'required',
        //         'Contact'  => 'required',
        //         'Age'  => 'required',
        //         'Area'  => 'required',
        //         'Service' => 'required',
        //         'Fee' => 'required',
        //         'Consultation'=>'required',
        //     ]);

        // // Update Data
        // $form_data = array(
        //     'Name' => $request->Name,
        //     'UserId' => $request->UserId,
        //     'UserName'  => $request->UserName,
        //     'Contact'  => $request->Contact,
        //     'Age'  => $request->Age,
        //     'Area'  => $request->Area,
        //     'Service' => $request->Service,
        //     'Fee'  => $request->Fee,
        //     'Question' => $request->Consultation,
        // );
        // // update
        // ConsultationsModel::whereId ($id)->update($form_data);
        // return redirect('ConsultationsResource')
        //     ->with('success','Data Is Successfully Updated');
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
        $data = ConsultationsModel::findOrFail($rowId);
        $data ->delete();
        return redirect('ConsultationsResource')
            ->with('success','Data Is Successfully deleted');
    }
}
