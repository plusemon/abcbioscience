@extends('frontend.layouts.app')
@section('title','detail')

@section('content')


 
<div class="breadgarm-section small-padding">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="breadgam">
                    <ul>
                        <li><a href="#"><i class="fa fa-home"></i></a></li>
                        <li>/</li>
                        <li>Bangladesh</li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- breadgarm-section -->

<!-- top-category-section -->

<div class="top-category-section">
    <div class="container">
    <div class="row">
        <div class="col-md-8">
            <div class="top-categorynew">
                <div class="row">
                    <div class="col-sm-6 col-md-6">
                        <div class="category-details">
                            <a href="#">BSMMU VC Gets COVID-19 Vaccine Jab</a>
                            <p>﻿Coronavirus vaccination program has been started in five hospitals of the capital including Bangabandhu Sheikh Mujib Medical University (BSMMU). The first vaccination was taken by BSMMU Vice-Chancellor Prof. Kanak Kanti Barua.The vaccination program started at 9 am on Thursday (January 26) ...</p>
                        </div>
                    </div>
                    <div class="col-sm-6 col-md-6">
                        <div class="category-images">
                            <a href="#">
                                <img src="{{ asset('public/frontend') }}/asset/images/1-601239661535a-60124510cd66d.jpg" alt="img">
                            </a>
                        </div>
                    </div>
                </div>
            </div>

            <div class="row">

                 @foreach($news as $new)
                <div class="col-sm-4 col-md-4">
                    <div class="single-categorynews">
                        <a href="#">
                            <img src="{{ asset($new->image) }}" alt="img">
                            <h4>{{ $new->title }}</h4>
                        </a>
                    </div>
                </div>
                @endforeach
            </div>

        </div>

         <div class="col-md-4">
             <div class="popularlist categorylatest">
                <h2>Latest <a href="#"><i class="fa fa-caret-right" aria-hidden="true"></i></a></h2>
                    <ul>

                        @foreach($news as $new)
                        <li>
                            <a href="#">
                            <img src="{{ asset($new->image) }}" alt="img">
                            <h3>{{ $new->title }}</h3>
                            </a>
                        </li>
                        @endforeach
                    </ul>
                    <div class="allbutton">
                       <a href="#">All News</a>
                    </div>
                </div>
         </div>


    </div>
    </div>
</div>


<!-- top-category-section -->




@endsection