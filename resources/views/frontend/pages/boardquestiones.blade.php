@extends('frontend.layouts.app')
@section('title','Board Questions')
@section('content')

    <!-- Old Board Question -->
    <section class="py-5 my-5 bgc">
        <div class="container">
            <div class="card  bg-light border-primary">
                <div class="card-header card-primary">
                          Previous Board Questions
                </div>
                <div class="card-body">
                    <div class="row">
                    @foreach ($boards as $board)
                    <div class="col-md-3">
                        <a href="{{ route('old.questions',['board_id' => $board->id]) }}" class="school-question box my-3 mx-1">
                            <span>{{ $board->years->count() }}</span>
                            <h4>{{ $board->name }}</h4>
                        </a>
                    </div>
                    @endforeach
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Old Board Question -->


@endsection
