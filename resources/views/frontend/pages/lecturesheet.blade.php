@extends('frontend.layouts.app')
@section('title','Lecture Sheet')
@section('content')
 

 <!-- Old College Question -->
<section class="py-5 bgc">
    <div class="container">
        <div class="card  bg-light border-primary">
            <div class="card-header">
                      Leacture Sheets
            </div>
            <div class="card-body">
                <div class="row">
                    @foreach ($sheetsetting as  $sheet)
                        <div class="col-12 col-sm-4 col-md-3 mb-4 d-flex">
                            <a href="{{ route('lecture.sheet.detail',$sheet->id) }}" class="sheet-box">
                                <div class="sheet-image">
                                    <img src="{{ asset($sheet->sheets?$sheet->sheets->thumbnail:'')  }}" alt="">
                                </div>
                                <div class="sheet-head">
                                    <h4> {{$sheet->sheets?$sheet->sheets->sheet_no:'' }} </h4>
                                </div>
                                <div class="sheet-price">
                                    <p>
                                        <span class="sheet-price-name">Price :</span>
                                        @if($sheet->amounts->pay_time_id==3)
                                        Free
                                        @else
                                        <span class="sheet-price">{{ $sheet->amounts?$sheet->amounts->amount:''}} taka</span>
                                        @endif
                                    </p>
                                </div>
                            </a>
                        </div>
                        @endforeach
                    </div>
            </div>
        </div>
    </div>
</section>
<!-- Old College Question -->


 

@endsection