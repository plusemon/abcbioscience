@extends('frontend.layouts.app')
@section('title','Lecture Sheet')
@section('content')
 


<!--  lecture sheet-->
<section class="latcure-sheet-section bg-white py-5">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="section-title">
                        <h4 class="after-dot">lecture sheet</h4>
                        <hr>
                    </div>
                </div>
            </div>
            <div class="latcure-sheet-content pt-4">
                 <div class="row">
                    @foreach($sheetsetting as $sheet)
                    <div class="col-12 col-sm-6 col-lg-4 col-xl-3">
                        <div class="latcure-sheet-box">
                            <div class="latcure-sheet-photo">
                                <img src="{{ asset($sheet->sheets->thumbnail) }}" alt="latcure sheet photo">
                            </div>
                            <div class="latcure-sheet-text pt-2">
                                <h5>{{ $sheet->sheets->sheet_no }}</h5>
                                
                                <p class="ls-price">
                                   
                                   {{--  <span class="sell">৳ 350</span> --}}
                                </p>
                            </div>
                            <div class="latcure-box-overlay clearfix">
                                <a href="{{ route('lecture.sheet.detail',$sheet->id) }}">
                                    <div class="latcure-download">download <i class="fa fa-download ml-2"></i></div>
                                </a>
                            </div>
                        </div>
                    </div>
                    @endforeach
                 </div>
            </div>
        </div>
    </section>

    <!--  lecture sheet-->

@endsection