<?php

namespace App\Http\Controllers\Backend\Fee;

use App\Http\Controllers\Controller;
use App\Model\FeeCategory;
use App\Model\FeeCategoryType;
use Illuminate\Http\Request;
use App\Model\Module;
use DB;
use Validator;
class FeeCategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data['fee_categories'] = FeeCategory::whereNull('deleted_at')->where('status',1)->latest()->get();
        return view("backend.fee_management.fee_category.index",$data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //$data['modules'] = Module::whereNull('deleted_at')->where('status',1)->latest()->get();
        $data['typies'] = FeeCategoryType::whereNull('deleted_at')->where('status',1)->latest()->get();
        return view("backend.fee_management.fee_category.create",$data);
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
            'fee_category_type_id'  => 'required',
            'name'                  => 'required',
        ]);
        if ($validator->fails()){
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }

        $data = new FeeCategory();
       // $data->module_id    = $request->module_id;
        $data->fee_category_type_id     = $request->fee_category_type_id;
        $data->name                     = $request->name;
        $data->status                   = 1;
        $data->save();
        $notification = array(
            'message' => 'Fee Category Create Successfully!',
            'alert-type' => 'success'
        );
        return redirect()->route('admin.fee-category.index')->with($notification);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Model\FeeCategory  $feeCategory
     * @return \Illuminate\Http\Response
     */
    public function show(FeeCategory $feeCategory)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Model\FeeCategory  $feeCategory
     * @return \Illuminate\Http\Response
     */
    public function edit(FeeCategory $feeCategory)
    {
        //$data['modules'] = Module::whereNull('deleted_at')->where('status',1)->latest()->get();
        $data['typies'] = FeeCategoryType::whereNull('deleted_at')->where('status',1)->latest()->get();
        $data['fee_category'] = $feeCategory;
        return view("backend.fee_management.fee_category.edit",$data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Model\FeeCategory  $feeCategory
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, FeeCategory $feeCategory)
    {
        $validator = Validator::make($request->all(), [
            'fee_category_type_id'  => 'required',
            'name'                  => 'required',
        ]);
        if ($validator->fails()){
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }

        //$feeCategory->module_id                 = $request->module_id;
        $feeCategory->fee_category_type_id      = $request->fee_category_type_id;
        $feeCategory->name                      = $request->name;
        $feeCategory->status                    = 1;
        $feeCategory->save();
        $notification = array(
            'message' => 'Fee Category Updated Successfully!',
            'alert-type' => 'success'
        );
        return redirect()->route('admin.fee-category.index')->with($notification);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Model\FeeCategory  $feeCategory
     * @return \Illuminate\Http\Response
     */
    public function destroy(FeeCategory $feeCategory)
    {
        $feeCategory->status = 2;
        $feeCategory->deleted_at = date('Y-m-d h:i:s');
        $feeCategory->save();
        $notification = array(
            'message' => 'Fee Category Deleted Successfully!',
            'alert-type' => 'success'
        );
        return redirect()->route('admin.fee-category.index')->with($notification);
    }
}
