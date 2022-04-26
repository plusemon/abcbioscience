<?php

namespace App\Http\Controllers\Backend\Payment;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Model\Backend\Payment\Account;
use App\Model\Backend\Payment\Bank;
use App\Model\Backend\Payment\PaymentMethod;

class AccountController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view("backend.account.account.view", [
            "accounts" => Account::all(),
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $data['paymentMethods'] = PaymentMethod::whereNull('deleted_at')->get();
        $data['banks'] = Bank::whereNull('deleted_at')->get();
        $data['account']        = Account::find(1);
        return view("backend.account.account.create",$data);
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
            "payment_method_id" => "required",
            "bank_id" => "required",
        ]);

        $account = new Account();
        $account->payment_method_id = $request->payment_method_id;
        $account->bank_id = $request->bank_id;
        $account->account_name = $request->account_name;
        $account->account_no = $request->account_no;
        $account->opening_amount = $request->opening_amount;
        $account->contract_person = $request->contract_person;
        $account->contract_phone = $request->contract_phone;
        $account->address = $request->address;
       
        $account->created_by = auth()->user()->id;
        if ($account->save()) {
            $notification = array(
                'message' => 'Successfully Account added!',
                'alert-type' => 'success'
            );
        } else {
            $notification = array(
                'message' => 'Someting Went Wrong!',
                'alert-type' => 'error'
            );
        }
        return redirect()->route('admin.account.index')->with($notification);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Model\Backend\Payment\Account  $account
     * @return \Illuminate\Http\Response
     */
    public function show(Account $account)
    {
        $account->payment_method = $account->paymentMethod;
        $account->bank = $account->bank;
        return $account;
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Model\Backend\Payment\Account  $account
     * @return \Illuminate\Http\Response
     */
    public function edit(Account $account)
    {
        return view("backend.account.account.edit", [
            "paymentMethods" => PaymentMethod::whereNull('deleted_at')->get(),
            "banks" => Bank::whereNull('deleted_at')->get(),
            "account" => $account,
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Model\Backend\Payment\Account  $account
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Account $account)
    {
        $this->validate($request, [
            "payment_method_id" => "required",
            "bank_id" => "required",
        ]);

        $account->payment_method_id = $request->payment_method_id;
        $account->bank_id = $request->bank_id;
        $account->account_name = $request->account_name;
        $account->account_no = $request->account_no;
        $account->opening_amount = $request->opening_amount;
        $account->contract_person = $request->contract_person;
        $account->contract_phone = $request->contract_phone;
        $account->address = $request->address;

        $account->created_by = auth()->user()->id;
        if ($account->save()) {
            $notification = array(
                'message' => 'Successfully Account updated!',
                'alert-type' => 'success'
            );
        } else {
            $notification = array(
                'message' => 'Someting Went Wrong!',
                'alert-type' => 'error'
            );
        }
        return redirect()->route('admin.account.index')->with($notification);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Model\Backend\Payment\Account  $account
     * @return \Illuminate\Http\Response
     */
    public function destroy(Account $account)
    {
        $account->deleted_at = date('Y-m-d h:i:s');
        if ($account->save()) 
        {
            $notification = array(
                'message' => 'Successfully Account deleted!',
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




    public function getAccountByPaymentMethod(Request $request)
    {
        $id = $request->id;
        $accounts = Account::where('payment_method_id',$id)->whereNull('deleted_at')->get();
        $html = "";
        foreach($accounts as $key => $account)
        {
            $html .= '<option value="'.$account->id.'">'
            .$account->account_name ." - " .$account->account_no ." (". $account->bank->short_name .")" ?? "" .
             '</option>';
        }
        return  $html;
    }

}
