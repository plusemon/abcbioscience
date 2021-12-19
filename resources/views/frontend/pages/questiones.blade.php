@extends('frontend.layouts.app')
@section('title', 'School Questions')
@section('content')
    <!-- Old Question -->
    <section class="py-5 bgc">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="section-title">
                        <h2>Questions</h2>
                    </div>
                </div>
            </div>
            <div class="row mt-3">
                @foreach ($questions as $question)
                    <div class="col-12 col-sm-6 col-md-4 col-lg-3 mb-4">
                        <a href="{{ route('old_school.questions.show', $question->id) }}" class="school-question box" download="">
                            <span>{{ $question->name }}</span>
                        </a>
                    </div>
                @endforeach
            </div>
        </div>
    </section>
    <!-- Old Question -->
@endsection
