@extends('frontend.layouts.app')
@section('title','College Questions')
@section('content')

<!-- Old College Question -->
<section class="py-5 my-5 bgc">
    <div class="container">
        <div class="card  bg-light border-primary">
            <div class="card-header">
                      Previous College Questions
            </div>
            <div class="card-body">
                <div class="row">
                @foreach ($colleges as $school)
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
<!-- Old College Question -->


@endsection
