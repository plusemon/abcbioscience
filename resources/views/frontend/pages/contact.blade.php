@extends('frontend.layouts.app')
@section('title','Contact Us')
@section('content')



<section class="contect-section bgw py-5">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="section-title py-1">
                        <h2>Contact us</h2>
                        <p>Send a message to us</p>
                    </div>
                </div>
            </div>
            <div class="row py-5">
                <div class="col-12 col-md-6">
                    <div class="p-contect-form">
                        <form action="{{ route('contactstore') }}" method="post">
                            @csrf
                            <div class="form-group py-2" style="visibility: visible; animation-name: fadeInUp;">
                                <label for="name">Name <span class="text-danger">*</span></label>
                                <input type="text" name="name" value="{{ old('name') }}" class="form-control" id="name" placeholder="Enter Your Name">
                                <div class="text-danger"> {{ $errors->first('name') }}</div>
                            </div>

                            <div class="form-group py-2" style="visibility: visible; animation-name: fadeInUp;">
                                <label for="email">Email  </label>
                                <input type="email" name="email" value="{{ old('email') }}" class="form-control" id="email" placeholder="Enter your valid Email">
                                <div class="text-danger"> {{ $errors->first('email') }}</div>
                            </div>

                            <div class="form-group py-2" style="visibility: visible; animation-name: fadeInUp;">
                                <label for="phone">Mobile Number <span class="text-danger">*</span></label>
                                <input type="text" name="mobile" class="form-control" value="{{ old('mobile') }}"  id="mobile" placeholder="Enter your valid WhatsApp mobile number">
                                <div class="text-danger"> {{ $errors->first('mobile') }}</div>
                            </div>

                            <div class="form-group py-2" style="visibility: visible; animation-name: fadeInUp;">
                                <label for="name">Subject <span class="text-danger">*</span></label>
                                <input type="text" name="subject" value="{{ old('subject') }}" class="form-control" id="name" placeholder="Enter Subject">
                                <div class="text-danger"> {{ $errors->first('subject') }}</div>
                            </div>

                            <div class="form-group py-2" style="visibility: visible; animation-name: fadeInUp;">
                                <label for="message">Message/Comments <span class="text-danger">*</span></label>
                                <textarea class="form-control mb-2" name="message" placeholder="Your message" spellcheck="false">{{ old('message') }}</textarea>
                                <div class="text-danger"> {{ $errors->first('message') }}</div>
                            </div>

                            <button type="submit" class="btn btn-primary  my-3">
                                <i class="fa fa-paper-plane-o"></i> Submit
                            </button>
                        </form>
                    </div>
                </div>
                <div class="col-12 col-md-6 mt-4">
                    <div class="contect-location">
                        <p class="wow animate__ animate__fadeInUp animated" style="visibility: visible; animation-name: fadeInUp;"><span><i class="fa fa-map-marker pr-2"></i> Office Address :</span> {{ $websetting->state_address }} {{ $websetting->local_address }} {{ $websetting->address }}</p>

                        <p class="wow animate__ animate__fadeInUp animated" style="visibility: visible; animation-name: fadeInUp;"><span><i class="fa fa-phone pr-2"></i> WhatsApp - </span> {{ $websetting->phone }}</p>

                        <p class="wow animate__ animate__fadeInUp animated" style="visibility: visible; animation-name: fadeInUp;"><span><i class="fa fa-envelope-o pr-2"></i> Email - </span> {{ $websetting->email }}</p>


                    </div>
                    <div class="fc-social-media">
                        @foreach($socialmedia as $media)
                            <a href="{{ $media->link }}" target="_blank" title="{{ $media->name }}"><i class="{{ $media->icon }}"></i>
                            </a>
                        @endforeach
                        
                        
                        <br>
                        <br>
                        
                        <img src="{{ asset('public/images/website/abcbioscience_whatsapp.jpeg') }}" style="width:50%">
                    </div>
                </div>
            </div>
        </div>
    </section>







@endsection
