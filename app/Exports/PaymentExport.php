<?php

namespace App\Exports;
 
use App\Models\Student;
use Maatwebsite\Excel\Concerns\FromCollection;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;

class PaymentExport implements FromView 
{
    private $data = [];


    public function __construct($collections)
    {
        $this->data = $collections;
    }

    public function view(): View
    {
        return view('backend.fee_management.fee_collection.payment_export',[
          'collections' => $this->data
      ]);
    }



}
