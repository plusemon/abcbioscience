<?php

namespace App\Model\Backend\Payment;

use Illuminate\Database\Eloquent\Model;
use App\Model\Backend\Payment\AccountPaymentHistoryDetail;
use App\Model\Backend\Payment\PaymentMethod;
use App\Model\Backend\Payment\Account;
use App\Model\Backend\Supplier;
use App\Model\Backend\Customer\Customer;
class AccountPaymentHistory extends Model
{
    public function paymentNotes()
    {
        return $this->hasOne(AccountPaymentHistoryDetail::class,'account_payment_history_id','id');
    }

    public function paymentMethods()
    {
        return $this->belongsTo(PaymentMethod::class,'payment_method_id','id');
    }
    public function accounts()
    {
        return $this->belongsTo(Account::class,'account_id','id');
    }

    public function suppliers()
    {
        return $this->belongsTo(Supplier::class,'client_supplier_id','id');//->whereNull('deleted_at')
    }
    public function customers()
    {
        return $this->belongsTo(Customer::class,'client_supplier_id','id');//->whereNull('deleted_at');
    }

}
