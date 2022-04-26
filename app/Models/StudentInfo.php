<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class StudentInfo extends Model
{
    
	 protected $fillable = [
        'user_id', 'father', 'mother','guardian_mobile', 'own_mobile', 'email','bkash_number', 'whatsapp_number', 'facebook_id','address','notes','status',
    ];

}
