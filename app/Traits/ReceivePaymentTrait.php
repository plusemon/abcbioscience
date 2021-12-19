<?php

namespace App\Traits;

use App\Model\PaymentHistory;
use Auth;

trait ReceivePaymentTrait
{

    protected $amount;
    protected $invoice_no;
    protected $reference_no;
    protected $student_id;
    protected $fee_cat_id;
    protected $user_id;
    protected $class_id;
    protected $session_id;
    protected $batch_setting_id;
    protected $batch_type_id;
    protected $fee_amount_setting_id;
    protected $student_waiver_id;
    protected $origin_id;

    protected $payment_method_id;
    protected $account_id;

    public function receivePayment()
    {
        $pay = new PaymentHistory();
        $pay->invoice_no           = $this->invoice_no;
        $pay->reference_no         = $this->reference_no;
        $pay->fee_cat_id           = $this->fee_cat_id;
        $pay->origin_id            = $this->origin_id;
        $pay->fee_amount_setting_id = $this->fee_amount_setting_id;
        $pay->amount               = $this->amount;
        $pay->user_id              = $this->user_id;
        $pay->student_id           = $this->student_id;
        $pay->batch_setting_id      = $this->batch_setting_id;
        $pay->batch_type_id        = $this->batch_type_id;
        $pay->class_id             = $this->class_id;
        $pay->session_id           = $this->session_id;
        $pay->student_waiver_id    = $this->student_waiver_id;

        $pay->payment_method_id    = $this->payment_method_id;
        $pay->account_id           = $this->account_id;
        $pay->receive_date         = date('Y-m-d h:i:s');
        $pay->receive_by           = Auth::user()->id;
        $pay->created_by           = Auth::user()->id;
        $pay->status               = 1;
        $pay->save();
        $pay->invoice_no            = "00".$pay->id;
        $pay->save();
        return $pay;
    }

}