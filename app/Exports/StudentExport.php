<?php

namespace App\Exports;
 
use App\Models\Student;
use Maatwebsite\Excel\Concerns\FromCollection;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;

class StudentExport implements FromView  
{
    private $data = [];


    public function __construct($allstudents)
    {
        $this->data = $allstudents;
    }

    public function view(): View
    {
        return view('backend.students.exportstudent',[
          'allstudents' => $this->data
      ]);
    }



}
