@extends('frontend.layouts.app')
@section('title','Lecture Sheet')
@section('content')
 

 <section class="letcure-sheet-details-section bg-white py-5">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="section-title">
                        <h4 class="after-dot">{{ $sheetsetting->sheets?$sheetsetting->sheets->sheet_no:'' }}</h4>
                        <p>Publish Date: {{ $sheetsetting->publish_date }}</p>
                    </div>
                </div>
            </div>
            <div class="letcure-sheet-details-content pt-5">
                <div class="row">
                    <div class="col-12 col-md-5">
                        <div class="lsd-photo text-center text-md-right mb-4">
                            <img src="{{ asset($sheetsetting->sheets?$sheetsetting->sheets->thumbnail:'') }}" alt="letcure sheet photo">
                        </div>
                    </div>
                    <div class="col-12 col-md-7">
                       
                        
                        
                        <div class="lsd-details">

                            
                             {!! $sheetsetting->sheets?$sheetsetting->sheets->description:'' !!}
                             
                        </div>

                        <div class="lsd-download">
                           {{-- <div class="ls-price ls-details">
                               <span class="descount"><del>৳ 500</del></span>
                                    <span class="sell">৳ 350</span>
                           </div> --}}
                         
                        </div>
                    </div>

                    <div class="col-md-12">
                        <a href="{{ asset($sheetsetting->sheets?$sheetsetting->sheets->sheet_file:'') }}" title="" class="btn btn-primary btn-sm" download><i class="fa fa-download ml-2"></i> Download now </a>
                    </div>
                     
                </div>
            </div>
        </div>
    </section>


@endsection