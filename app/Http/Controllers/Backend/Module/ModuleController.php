<?php

namespace App\Http\Controllers\Backend\Module;

use App\Http\Controllers\Controller;
use App\Model\Module;
use Illuminate\Http\Request;
use DB;
use Validator;

class ModuleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data['modules'] = Module::whereNull('deleted_at')->where('status',1)->latest()->get();
        return view("backend.module.module.index",$data);
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

        $data = new Module();
        $data->name = $request->name;
        $data->status = 1;
        $data->save();
        $notification = array(
            'message' => 'Module Create Successfully!',
            'alert-type' => 'success'
        );

        return redirect()->route('admin.module.index')->with($notification);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Model\Module  $module
     * @return \Illuminate\Http\Response
     */
    public function show(Module $module)
    {
        
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Model\Module  $module
     * @return \Illuminate\Http\Response
     */
    public function edit(Module $module)
    {
        $data['module'] = $module;
        return view("backend.module.module.edit",$data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Model\Module  $module
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Module $module)
    {
        $validator = Validator::make($request->all(), [
            'name'          => 'required'
        ]);
        
        if ($validator->fails()){
            return redirect()->back()
                        ->withErrors($validator)
                        ->withInput();
        }  

        
        $data = $module;
        $data->name = $request->name;
        $data->status = 1;
        $data->save();
        $notification = array(
            'message' => 'Module Updated Successfully!',
            'alert-type' => 'success'
        );

        return redirect()->route('admin.module.index')->with($notification);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Model\Module  $module
     * @return \Illuminate\Http\Response
     */
    public function destroy(Module $module)
    {
        $module->status = 2;
        $module->deleted_at = date('Y-m-d h:i:s');
        $module->save();
        $notification = array(
            'message' => 'Module Deleted Successfully!',
            'alert-type' => 'success'
        );

        return redirect()->route('admin.module.index')->with($notification);
    }
}
