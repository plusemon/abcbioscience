@extends('frontend.layouts.app')
@section('title','School Questions')
@section('content')

<!-- Old School Question -->
<section class="py-5 my-5 bgc">
    <div class="container">
        <div class="card  bg-light border-primary">
            <div class="card-header">
                      Previous Schools Questions
            </div>
            <div class="card-body">
                <div class="row">
                @foreach ($schools as $school)
                <div class="col-md-3">
                    <a href="{{ route('old.questions',['school_id' => $school->id]) }}" class="school-question box my-3 mx-1">
                        <span>{{ $school->sessions->count() }}</span>
                        <h4>{{ $school->institute }}</h4>
                    </a>
                </div>
                @endforeach
                </div>
            </div>
        </div>
    </div>
</section>
<!-- Old School Question -->


@endsection
