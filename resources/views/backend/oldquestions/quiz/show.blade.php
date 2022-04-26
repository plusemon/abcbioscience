@extends('backend.layouts.app')
@section('title','MCQ Questions View')
@section('content')


    <div id="content" class="content">
        <div class="panel panel-default">
            <div class="panel-heading">
                <h4 class="panel-title">Quiz : {{ $quiz->quiz_name }} </h4>
                <div class="panel-heading-btn">
                    <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-default" data-click="panel-expand">
                        <i class="fa fa-expand"></i>
                    </a>
                    <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-success" data-click="panel-reload">
                        <i class="fa fa-redo"></i>
                    </a>
                    <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-warning" data-click="panel-collapse">
                        <i class="fa fa-minus"></i>
                    </a>
                    <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-danger" data-click="panel-remove">
                        <i class="fa fa-times"></i>
                    </a>

                </div>
            </div>
            <div class="panel-body">



                            
                @foreach($quiz->QuizQuestion as $question)

                    <h5>{{ $question->question_name }}</h5>
                    <hr class="mt-1">
                    <ul>
                        @foreach($question->QuizQuestionValue as $option)
                        <li>{{ $option->option_name }}  @if($option->answer ==1) <span class="text-white p-3 bg-green ml-5">Correct Answer</span>  @endif</li>
                        @endforeach
                    </ul>

                        

                @endforeach

            </div>
        </div>
    </div>

@endsection
