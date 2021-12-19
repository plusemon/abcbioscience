<?php

namespace App\Http\Controllers\Backend\Payment;

use App\Http\Controllers\Controller;
use App\Model\Backend\Payment\Bank;
use App\Model\Backend\Payment\PaymentMethod;
use Illuminate\Http\Request;

class BankController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view("backend.account.bank.view", [
            "banks" => Bank::all(),
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
       
        return view("backend.account.bank.add", [
            "paymentMethods" => PaymentMethod::all()
        ]);
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
            "name" => "required|string|max:255|unique:banks,name",
            "short_name" => "required|string|max:50|unique:banks,short_name",
            "address" => "required|string",
        ]);

        $data = [
            "name" => $request->name,
            "short_name" => $request->short_name,
            "address" => $request->address,
            "status" => 1,
            "is_active" => 1,
            "is_verified" => 1,
            "created_by" => auth()->user()->id,
        ];

        $bank = new Bank($data);

        if($bank->save())
        {
            $notification = array(
                'message' => 'Successfully Bank added!',
                'alert-type' => 'success'
            );
        }else{
            $notification = array(
                'message' => 'Someting Went Wrong!',
                'alert-type' => 'error'
            );
        }
        return redirect()->route('admin.bank.index')->with($notification);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Model\Backend\Payment\Bank  $bank
     * @return \Illuminate\Http\Response
     */
    public function show(Bank $bank)
    {
        $bank->payment_method = $bank->paymentMethod->method;
        return $bank;
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Model\Backend\Payment\Bank  $bank
     * @return \Illuminate\Http\Response
     */
    public function edit(Bank $bank)
    {
        return view("backend.account.bank.edit", [
            "bank" => $bank,
            "paymentMethods" => PaymentMethod::all()
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Model\Backend\Payment\Bank  $bank
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Bank $bank)
    {
        $this->validate($request, [
            "name" => "required|string|max:255|unique:banks,name," . $bank->id,
            "short_name" => "required|string|max:50|unique:banks,short_name," . $bank->id,
            "address" => "required|string",
        ]);

        $data = [
            "name" => $request->name,
            "short_name" => $request->short_name,
            "address" => $request->address,
            "status" => 1,
            "is_active" => 1,
            "is_verified" => 1,
        ];

        $bank->fill($data);

        if($bank->save())
        {
            $notification = array(
                'message' => 'Successfully Bank updated!',
                'alert-type' => 'success'
            );
        }else{
            $notification = array(
                'message' => 'Someting Went Wrong!',
                'alert-type' => 'error'
            );
        }
        return redirect()->route('admin.bank.index')->with($notification);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Model\Backend\Payment\Bank  $bank
     * @return \Illuminate\Http\Response
     */
    public function destroy(Bank $bank)
    {
        $bank->deleted_at = date('Y-m-d h:i:s');
        if($bank->save())
        {
            $notification = array(
                'message' => 'Successfully Bank Deleted!',
                'alert-type' => 'success'
            );
        }else{
            $notification = array(
                'message' => 'Someting Went Wrong!',
                'alert-type' => 'error'
            );
        }
        return redirect()->back()->with($notification);
    }
}
