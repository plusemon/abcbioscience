<?php

namespace App\Http\Controllers\Backend\SMS;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\SmsTemplete;

class SmsTempleteController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data['SmsTemplates'] = SmsTemplete::latest()->get();
        return view('backend.sms.smstemplete.index',$data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('backend.sms.smstemplete.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'name'=> 'required',
            'message'=> 'required',
            'status'=> 'required'
        ]);

        $sms_tem = new SmsTemplete();
        $sms_tem->name = $request->name;
        $sms_tem->message = $request->message;
        $sms_tem->status = $request->status;

        $sms_tem->save();

        $notification = array(
            'message' => 'Sms Template Create Successfully!',
            'alert-type' => 'success'
        );

        return redirect()->route('sms_templete.index')->with($notification);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $data['templete'] = SmsTemplete::find($id);

        return view('backend.sms.smstemplete.edit',$data);

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
        $request->validate([
            'name'=> 'required',
            'message'=> 'required',
            'status'=> 'required'
        ]);

        $sms_tem =  SmsTemplete::find($id);
        $sms_tem->name = $request->name;
        $sms_tem->message = $request->message;
        $sms_tem->status = $request->status;

        $sms_tem->save();

        $notification = array(
            'message' => 'Sms Template Updated Successfully!',
            'alert-type' => 'success'
        );

        return redirect()->route('sms_templete.index')->with($notification);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
       
        $sms_tem = SmsTemplete::find($id)->delete();

        $notification = array(
            'message' => 'Sms Template Delete Successfully!',
            'alert-type' => 'success'
        );

        return redirect()->route('sms_templete.index')->with($notification);
    }
}
