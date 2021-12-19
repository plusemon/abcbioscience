@extends('backend.layouts.app')
@section('title', 'Mcq Exam Results')
@section('content')

    <div id="content" class="content">
        <div class="panel panel-inverse">
            <div class="panel-heading">
                <h4 class="panel-title">Result View </h4>
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
                <table class="table">
                    <tr>
                        <td>Name of Exam</td>
                        <td>:</td>
                        <td>{{ $exam->mcqQuestionSubjects ? $exam->mcqQuestionSubjects->question_no : null }}</td>
                        <td>Student Name</td>
                         <td>:</td>
                        <td> {{ $exam->student->user->name ?? '' }}</td>
                    </tr>
                    <tr>
                        <td>Class</td>
                         <td>:</td>
                        <td>{{ $exam->classes->name }}</td>
                        <td>Date</td>
                         <td>:</td>
                        <td>{{ $exam->created_at->format('d-m-Y') }}</td>
                    </tr>
                    <tr>
                        <td>Session</td>
                         <td>:</td>
                        <td>{{ $exam->sessiones->name }}</td>
                         <td>Subject</td>
                          <td>:</td>
                        <td>{{ $exam->subjects->name }}</td>
                    </tr>
       
                    <tr>
                        <td class="font-weight-bold">Total Question</td>
                         <td>:</td>
                        <td>{{ $exam->mcqQuestionSubjects ? ($exam->mcqQuestionSubjects->mcqQuestions ? $exam->mcqQuestionSubjects->mcqQuestions->count() : 0) : 0 }}</td>
                         <td class="font-weight-bold">Score</td>
                          <td>:</td>
                        <td>{{ $exam->mcqexamanssummery->where('result',1)->count() }}</td>
                    </tr>
     
                </table>


                @foreach ($exam->mcqQuestionSubjects ? ($exam->mcqQuestionSubjects->mcqQuestions ? $exam->mcqQuestionSubjects->mcqQuestions : null) : null as $key => $mcqQes)
                    <div class="model-test-question">

                        <div class="question-box">
                            <div class="qb-head">
                                <h5>Question {{ $key + 1 }} of
                                    {{ $exam->mcqQuestionSubjects->mcqQuestions->count() ?? '' }}
                                </h5>
                            </div>
                            <div>
                                <div class="qb-body">
                                    <p>{!! $mcqQes ? $mcqQes->question : null !!}.</p>
                                    <input type="hidden" value="{{ $mcqQes ? $mcqQes->id : null }}"
                                        name="question_no_{{ $key }}" />
                                    <input type="hidden" value="{{ $mcqQes ? $mcqQes->id : null }}" name="questions[]" />
                                    <div class="single-question">
                                        <div class="input-box">
                                            @foreach ($mcqQes ? ($mcqQes->options ? $mcqQes->options : null) : null as $optio)
                                                <div class="form-check">
                                                    @php
                                                        $given_option_id = $exam->correctAnswers($mcqQes->id) ? $exam->correctAnswers($mcqQes->id)->given_option_id : null;
                                                        $correct_option_id = $exam->correctAnswers($mcqQes->id) ? $exam->correctAnswers($mcqQes->id)->correct_option_id : null;
                                                    @endphp
                                                    <input class="form-check-input radio-clickable" type="radio"
                                                        name="question_option_{{ $key }}"
                                                        value="{{ $optio ? $optio->id : null }}" @if ($given_option_id == $optio->id) checked @else '' @endif>

                                                    <label class="form-check-label">
                                                        <span>{{ $optio ? $optio->pattern : null }})</span>&nbsp;
                                                        &nbsp;
                                                        <span> {{ $optio ? $optio->option : null }} </span>
                                                        @if (($optio ? $optio->answer : null) == 1)
                                                            <span style="color:green;"> <i class="fa fa-check"></i>
                                                            </span>
                                                        @endif

                                                        @if ($optio->id == $given_option_id && $given_option_id == $correct_option_id)
                                                            @if (($optio ? $optio->answer : null) == 1 && $given_option_id == $correct_option_id)
                                                                <span style="color:green;"> <i class="fa fa-check"></i>
                                                                </span>
                                                            @endif
                                                        @elseif($optio->id == $given_option_id &&
                                                            $given_option_id != $correct_option_id)
                                                            <span style="color:red;"> <i class="fa fa-times"></i>
                                                            </span>
                                                        @endif
                                                    </label>
                                                </div>
                                            @endforeach
                                        </div>
                                    </div>
                                    <div style="margin-left:2%;padding:2%;padding-top:1%;">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach



            </div>
        </div>

    </div>
    </div>

@endsection
