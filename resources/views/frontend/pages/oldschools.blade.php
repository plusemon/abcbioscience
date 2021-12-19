@extends('frontend.layouts.app')
@section('title',$websetting->homepage_title)
@section('content')

    <!-- Old Question -->
    <section class="py-5 bgc">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="section-title">
                        <h2>Session</h2>

                    </div>
                </div>
            </div>
            <div class="row mt-3">
                @foreach($sessions as $year)
                <div class="col-12 col-sm-6 col-md-4 col-lg-3 mb-4">
                    <a href="{{ route('old.questions',['session_id' => $year->id]) }}" class="school-question box">
                        <span>{{ $year->classes->count() }}</span><br>
                        <span>{{ $year->year }}</span>
                    </a>
                </div>
                @endforeach
            </div>
        </div>
    </section>
    <!-- Old Question -->

@endsection
