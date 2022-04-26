@extends('frontend.layouts.app')
@section('title','Lecture Sheet')
@section('content')
 

 <!-- Old College Question -->
<section class="py-5 bgc">
    <div class="container">
         <div class="row">
             <div class="col-xs-12 col-sm-7 col-md-7 p-4">
                 <div class="sheet-title pb-4">
                     <h4>{{ $sheet->sheets?$sheet->sheets->sheet_no:'' }}</h4>
                 </div>
                 <div class="sheet-detail">
                     <div class="sheet-img">
                          <img src="{{ asset($sheet->sheets?$sheet->sheets->thumbnail:'')  }}" alt="">
                     </div>
                     <div class="sheet-body py-5">
                         {!! $sheet->sheets?$sheet->sheets->description:'' !!}
                     </div>
                 </div>
             </div>
             <div class="col-xs-12 col-sm-5 col-md-5 p-4 bg-white shadow-sm p-3 mb-5 bg-white rounded">
                 <div class="sheet-payment ">
                      <table class="table">
                          <tr>
                              <th>Class</th>
                              <td>{{ $sheet->sheets?$sheet->sheets->classes->name:''  }}</td>
                              
                          </tr>
                          <tr>
                             <th>Session</th>
                              <td>{{ $sheet->sheets?$sheet->sheets->sessiones->name:''  }}</td>
                          </tr>
                      </table>

                      <h3 class="btn btn-info text-white w-100 my-5">
                          Sheet Fees : 
                                <span class="sheet-price-name">  </span>
                                @if($sheet->amounts->pay_time_id==3)
                                Free
                                @else
                                <span class="sheet-price">{{ $sheet->amounts?$sheet->amounts->amount:''}} taka</span>
                                @endif
                      </h3>
                    <center>
                      <a href="{{ asset($sheet->sheets?$sheet->sheets->sheet_file:'')  }}" class="btn btn-primary" download=""> <i class="fa fa-download"></i> Donwload Now</a>
                    </center>
                 </div>
             </div>
         </div>
    </div>
</section>
<!-- Old College Question -->



@endsection