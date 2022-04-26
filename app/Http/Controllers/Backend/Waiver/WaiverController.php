<?php

namespace App\Http\Controllers\Backend\Waiver;

use App\Http\Controllers\Controller;
use App\Model\Waiver;
use Illuminate\Http\Request;
use App\Model\WaiverType;

use DB;
use Validator;
class WaiverController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data['waiver'] = Waiver::where('status',1)->latest()->get();
        return view('backend.waiver.waiver.index',$data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $data['waiverTypes'] = WaiverType::where('status',1)->latest()->get();
        return view('backend.waiver.waiver.create',$data);
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
            'name'              => 'required',
            'waiver_type_id'    => 'required',
            'amount'            => 'required',
        ]);
        
        if ($validator->fails()){
            return redirect()->back()
                        ->withErrors($validator)
                        ->withInput();
        }  

        $data = new Waiver();
        $data->name             = $request->name;
        $data->waiver_type_id   = $request->waiver_type_id;
        $data->amount           = $request->amount;
        $data->status = 1;
        $data->save();
        $notification = array(
            'message' => 'Waiver Created Successfully!',
            'alert-type' => 'success'
        );

        return redirect()->route('admin.waiver.index')->with($notification);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Model\Waiver  $waiver
     * @return \Illuminate\Http\Response
     */
    public function show(Waiver $waiver)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Model\Waiver  $waiver
     * @return \Illuminate\Http\Response
     */
    public function edit(Waiver $waiver)
    {
        $data['waiverTypes'] = WaiverType::where('status',1)->latest()->get();
        $data['waiver'] = $waiver;
        return view('backend.waiver.waiver.edit',$data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Model\Waiver  $waiver
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Waiver $waiver)
    {
        $validator = Validator::make($request->all(), [
            'name'              => 'required',
            'waiver_type_id'    => 'required',
            'amount'            => 'required',
        ]);
        
        if ($validator->fails()){
            return redirect()->back()
                        ->withErrors($validator)
                        ->withInput();
        }  

        $waiver->name             = $request->name;
        $waiver->waiver_type_id   = $request->waiver_type_id;
        $waiver->amount           = $request->amount;
        $waiver->status           = 1;
        $waiver->save();
        $notification = array(
            'message' => 'Waiver Updated Successfully!',
            'alert-type' => 'success'
        );

        return redirect()->route('admin.waiver.index')->with($notification);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Model\Waiver  $waiver
     * @return \Illuminate\Http\Response
     */
    public function destroy(Waiver $waiver)
    {
        $waiver->status = 2;
        $waiver->deleted_at = date('Y-m-d h:i:s');
        $waiver->save();
        $notification = array(
            'message' => 'Waiver Type Deleted Successfully!',
            'alert-type' => 'success'
        );
        return redirect()->route('admin.waiver.index')->with($notification);
    }
}
