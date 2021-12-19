<?php

namespace App\Http\Controllers\Backend\Payment;

use App\Http\Controllers\Controller;
use App\Model\Backend\Payment\PaymentMethod;
use Illuminate\Http\Request;

class PaymentMethodController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view("backend.account.payment-method.view", [
            "paymentMethods" => PaymentMethod::whereNull('deleted_at')->get(),
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //return view("backend.account.payment-method.add");
        return redirect()->route("admin.paymentMethod.index");
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            "method" => "required|string|max:100|unique:payment_methods,method"
        ]);

        $paymentMethod = new PaymentMethod();

        $paymentMethod->business_location_id = 1;
        $paymentMethod->business_type_id = 1;
        $paymentMethod->method = $request->method;
        $paymentMethod->status = 1;
        $paymentMethod->is_active = 1;
        $paymentMethod->is_verified = 1;
        $paymentMethod->created_by = auth()->user()->id;

        if ($paymentMethod->save()) {
            $notification = array(
                'message' => 'Successfully Payment Method added!',
                'alert-type' => 'success'
            );
        } else {
            $notification = array(
                'message' => 'Someting Went Wrong!',
                'alert-type' => 'error'
            );
        }
        return redirect()->back()->with($notification);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Model\Backend\Payment\PaymentMethod  $paymentMethod
     * @return \Illuminate\Http\Response
     */
    public function show(PaymentMethod $paymentMethod)
    {
        return redirect()->route("admin.paymentMethod.index");
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Model\Backend\Payment\PaymentMethod  $paymentMethod
     * @return \Illuminate\Http\Response
     */
    public function edit(PaymentMethod $paymentMethod)
    {
        return view("backend.account.payment-method.edit", [
            "paymentMethod" => $paymentMethod,
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Model\Backend\Payment\PaymentMethod  $paymentMethod
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, PaymentMethod $paymentMethod)
    {
        $this->validate($request, [
            "method" => "required|string|max:100|unique:payment_methods,method," . $paymentMethod->id
        ]);

        $paymentMethod->method = $request->method;

        if ($paymentMethod->save()) {
            $notification = array(
                'message' => 'Successfully Payment Method Updated!',
                'alert-type' => 'success'
            );
        } else {
            $notification = array(
                'message' => 'Someting Went Wrong!',
                'alert-type' => 'error'
            );
        }
        return redirect()->back()->with($notification);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Model\Backend\Payment\PaymentMethod  $paymentMethod
     * @return \Illuminate\Http\Response
     */
    public function destroy(PaymentMethod $paymentMethod)
    {
        $paymentMethod->deleted_at = date('Y-m-d h:i:s');
        $paymentMethod->save();
        if ($paymentMethod->save()) {
            $notification = array(
                'message' => 'Successfully Payment Method Deleted!',
                'alert-type' => 'success'
            );
        } else {
            $notification = array(
                'message' => 'Someting Went Wrong!',
                'alert-type' => 'error'
            );
        }
        return redirect()->back()->with($notification);
    }
}
