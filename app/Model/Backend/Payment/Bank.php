<?php

namespace App\Model\Backend\Payment;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Bank extends Model
{
    use SoftDeletes;
    protected $fillable = [
        "business_location_id",
        "business_type_id",
        "branch_id",
        "payment_method_id",
        "name",
        "short_name",
        "address",
        "status",
        "is_active",
        "is_varified",
        "deleted_at",
        "created_by",
    ];

    public function isActive()
    {
        return $this->is_active==1;
    }

    public function isVerified()
    {
        return $this->is_Verified==1;
    }

    public function paymentMethod()
    {
        return $this->belongsTo(PaymentMethod::class);
    }

    public function accounts()
    {
        return $this->hasMany(Account::class);
    }
}
