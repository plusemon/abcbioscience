@extends('frontend.layouts.app')
@section('title','Contact')
@section('content')

  

 <section class="about-section py-5">
        <div class="container">
             <div class="row pt-5">
                <div class="col-12">
                    <div class="section-title">
                        <h4 class="after-dot">About Us</h4>
                    </div>
                </div>
                <div class="col-12 pt-3">
                        {!! $about->details !!}           
                 </div>
            </div>
        </div>
    </section>


    <section class="mission-vission py-5">
        <div class="container">
            <div class="row">
                <div class="col-12 col-md-6">
                    <div class="mv">
                        <div class="mv-photo">
                            <img src="{{ asset($about->mission_image) }}" alt="mission photo">
                        </div>
                        <div class="mv-txt">
                            <h4>Our Mission</h4>
                            {!! $about->mission_details !!}                                          
                        </div>
                    </div>
                </div>
                <div class="col-12 col-md-6">
                    <div class="mv">
                        <div class="mv-photo">
                            <img src="{{ asset($about->vission_image) }}" alt="vission photo">
                        </div>
                        <div class="mv-txt">
                            <h4>Our vission</h4>
                            {!! $about->vission_details !!}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

@endsection