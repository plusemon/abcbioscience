<?php

namespace App\Http\Controllers\Backend\Waiver;

use App\Http\Controllers\Controller;
use App\Model\WaiverType;
use Illuminate\Http\Request;
use DB;
use Validator;

class WaiverTypeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data['waiverTypes'] = WaiverType::where('status',1)->latest()->get();
        return view('backend.waiver.waiver_type.index',$data);
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
        $validator = Validator::make($request->all(), [
            'name'          => 'required'
        ]);
        
        if ($validator->fails()){
            return redirect()->back()
                        ->withErrors($validator)
                        ->withInput();
        }  

        $data = new WaiverType();
        $data->name = $request->name;
        $data->status = 1;
        $data->save();
        $notification = array(
            'message' => 'Waiver type Created Successfully!',
            'alert-type' => 'success'
        );

        return redirect()->route('admin.waiver-type.index')->with($notification);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Model\WaiverType  $waiverType
     * @return \Illuminate\Http\Response
     */
    public function show(WaiverType $waiverType)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Model\WaiverType  $waiverType
     * @return \Illuminate\Http\Response
     */
    public function edit(WaiverType $waiverType)
    {
        $data['waiverTypes'] = $waiverType;
        return view('backend.waiver.waiver_type.edit',$data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Model\WaiverType  $waiverType
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, WaiverType $waiverType)
    {
        $validator = Validator::make($request->all(), [
            'name'          => 'required'
        ]);
        
        if ($validator->fails()){
            return redirect()->back()
                        ->withErrors($validator)
                        ->withInput();
        }  

        $waiverType->name = $request->name;
        $waiverType->status = 1;
        $waiverType->save();
        $notification = array(
            'message' => 'Waiver Type Updated Successfully!',
            'alert-type' => 'success'
        );

        return redirect()->route('admin.waiver-type.index')->with($notification);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Model\WaiverType  $waiverType
     * @return \Illuminate\Http\Response
     */
    public function destroy(WaiverType $waiverType)
    {
        $waiverType->status = 2;
        $waiverType->deleted_at = date('Y-m-d h:i:s');
        $waiverType->save();
        $notification = array(
            'message' => 'Waiver Type Deleted Successfully!',
            'alert-type' => 'success'
        );
        return redirect()->route('admin.waiver-type.index')->with($notification);
    }
}
