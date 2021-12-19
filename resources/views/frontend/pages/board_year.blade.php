@extends('frontend.layouts.app')
@section('title',$websetting->homepage_title)
@section('content')


    <section>
       <div class="container">
            <div class="row">
            <div class="col-12">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item" aria-current="page"><a href="#">School</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Session</li>

                    </ol>
                </nav>
            </div>
        </div>
       </div>
    </section>


    <!-- Old Question -->
    <section class="py-5 bgc">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="section-title">
                        <h2>Session</h2>
                        <hr>
                    </div>
                </div>
            </div>
            <div class="row mt-3">
                @foreach($years as $year)
                <div class="col-12 col-sm-6 col-md-4 col-lg-3 mb-4">
                    <a href="{{ route('old.questions',['year_id' => $year->id]) }}" class="school-question box">
                        <span> {{ $year->subjects->count() }} </span> <br>
                        <span>{{ $year->year }}</span>
                    </a>
                </div>
                @endforeach
            </div>
        </div>
    </section>
    <!-- Old Question -->







@endsection