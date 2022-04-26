<?php

namespace App\Model\Backend\Payment;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

use DB;
use App\Model\Backend\Payment\AccountPaymentHistory;
use App\Model\Backend\Payment\AccountPaymentHistoryDetail;
class Account extends Model
{
    use SoftDeletes;

    protected $fillable = [
        "business_location_id",
        "business_type_id",
        "branch_id",
        "payment_method_id",
        "bank_id",
        "account_name",
        "account_no",
        "opening_amount",
        "contract_person",
        "contract_phone",
        "address",
        "status",
        "is_active",
        "is_varified",
    ];

    public function isActive()
    {
        return $this->is_active == 1;
    }

    public function isVerified()
    {
        return $this->is_Verified == 1;
    }

    public function paymentMethod()
    {
        return $this->belongsTo(PaymentMethod::class);
    }

    public function bank()
    {
        return $this->belongsTo(Bank::class);
    }

    public function initialDeposit()
    {
        return number_format($this->opening_amount,2,'.','');
       
    }

    public function totalAmount()
    {
        $data = AccountPaymentHistory::whereNull('deleted_at')
        ->select(
        DB::raw('SUM(CASE 
        WHEN payment_type_id = 1
            THEN payment_amount
        END) as income'),
        DB::raw('SUM(CASE 
        WHEN payment_type_id = 2
            THEN payment_amount
        END) as expense')
        )
        ->where('account_id',$this->id)
        ->get();
        $totalIncome    = $data->sum('income');
        $totalExpenese  =  $data->sum('expense');
        return number_format(($this->initialDeposit() + $totalIncome) - $totalExpenese,2,'.','') ;
    }

}
