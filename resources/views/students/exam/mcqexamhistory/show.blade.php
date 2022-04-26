@extends('students.layouts.app')
@section('title', 'Quiz Test Result')
@section('content')
    <div id="content" class="content">
        <div class="panel panel-inverse">
            <div class="panel-heading">
                <h4 class="panel-title">Quiz Test Result</h4>
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
                <div class="row">
                    <div class="col-md-12">


                        <div class="table-responsive">

                            @php
                                $end = $answer->examSettings->exam_end_date_time;
                                $isExamDateOver = now() > $end;
                                $isInstantView = $answer->examSettings->result_view;
                            @endphp

                            <table class="table">
                                <tbody>
                                    <tr>
                                        <td> <b>Name of Exam</b></td>
                                        <th colspan="5">
                                            {{ $answer->mcqQuestionSubjects ? $answer->mcqQuestionSubjects->question_no : null }}
                                        </th>
                                    </tr>
                                    <tr>
                                        <th>Subject</th>
                                        <th>:</th>
                                        <td>{{ $answer->subjects ? $answer->subjects->name : null }}</td>

                                        <th>Class</th>
                                        <th>:</th>
                                        <td> {{ $answer->classes ? $answer->classes->name : null }}</td>
                                    </tr>
                                    <tr>
                                        <th>Session</th>
                                        <th>:</th>
                                        <td> {{ $answer->sessiones ? $answer->sessiones->name : null }}</td>

                                        <th>Total Qustion</th>
                                        <th>:</th>
                                        <td>
                                            {{ $answer->mcqQuestionSubjects ? ($answer->mcqQuestionSubjects->mcqQuestions ? $answer->mcqQuestionSubjects->mcqQuestions->count() : 0) : 0 }}
                                        </td>
                                    </tr>
                                    <tr>
                                        <th>Date</th>
                                        <th>:</th>
                                        <td colspan="4">
                                            {{ Date('d-m-Y', strtotime($answer->created_at)) }}
                                        </td>
                                    </tr>

                                    <tr>
                                        <th>Your Score</th>
                                        <th>:</th>
                                        <td colspan="4">
                                            {{ $isInstantView || $isExamDateOver ? $answer->mcqexamanssummery->where('result',1)->count() :'Not ready' }}
                                        </td>
                                    </tr>
                                </tbody>
                            </table>

                        </div>



                        <div>
                            @if ($answer->status == 1)
                                @if ($isInstantView || $isExamDateOver)
                                    @foreach ($answer->mcqQuestionSubjects ? ($answer->mcqQuestionSubjects->mcqQuestions ? $answer->mcqQuestionSubjects->mcqQuestions : null) : null as $key => $mcqQes)
                                        <div class="model-test-question">

                                            <div class="question-box">
                                                <div class="qb-head">
                                                    <h5> Question {{ $key + 1 }} of
                                                        {{ $answer->mcqQuestionSubjects ? $answer->mcqQuestionSubjects->mcqQuestions->count() : 0 }}
                                                    </h5>
                                                </div>
                                                <div>
                                                    <div class="qb-body">
                                                        <p>{!! $mcqQes ? $mcqQes->describe : null !!}</p>
                                                        
                                                        <p>
                                                            @if ($mcqQes->image != null)
                                                                <img src="{{ asset($mcqQes->image) }}" alt=""  width="500px">
                                                            @endif
                                                        </p>
                                                        
                                                        
                                                        <p>{!! $mcqQes ? $mcqQes->question : null !!}</p>
                                                        
                                                        <input type="hidden" value="{{ $mcqQes ? $mcqQes->id : null }}"
                                                            name="question_no_{{ $key }}" />
                                                        <input type="hidden" value="{{ $mcqQes ? $mcqQes->id : null }}"
                                                            name="questions[]" />
                                                        <div class="single-question">

                                                            <div class="input-box">
                                                                @foreach ($mcqQes ? ($mcqQes->options ? $mcqQes->options : null) : null as $optio)
                                                                    <div class="form-check">
                                                                        @php
                                                                            $given_option_id = $answer->correctAnswers($mcqQes->id) ? $answer->correctAnswers($mcqQes->id)->given_option_id : null;
                                                                            $correct_option_id = $answer->correctAnswers($mcqQes->id) ? $answer->correctAnswers($mcqQes->id)->correct_option_id : null;
                                                                        @endphp
                                                                        <input class="form-check-input radio-clickable"
                                                                            type="radio"
                                                                            name="question_option_{{ $key }}"
                                                                            value="{{ $optio ? $optio->id : null }}" @if ($given_option_id == $optio->id) checked @else '' @endif>

                                                                        <label class="form-check-label">
                                                                            <span>({{ $optio ? $optio->pattern : null }})</span>&nbsp;
                                                                            &nbsp;
                                                                            <span> {{ $optio ? $optio->option : null }}
                                                                            </span>
                                                                            @if (($optio ? $optio->answer : null) == 1)
                                                                                <span style="color:green;"> <i
                                                                                        class="fa fa-check"></i> </span>
                                                                            @endif

                                                                            @if ($optio->id == $given_option_id && $given_option_id == $correct_option_id)
                                                                                @if (($optio ? $optio->answer : null) == 1 && $given_option_id == $correct_option_id)
                                                                                    <span style="color:green;"> <i
                                                                                            class="fa fa-check"></i> </span>
                                                                                @endif
                                                                            @elseif($optio->id == $given_option_id &&
                                                                                $given_option_id != $correct_option_id)
                                                                                <span style="color:red;"> <i
                                                                                        class="fa fa-times"></i> </span>
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
                                @else
                                    <h4 class="text-center text-info">Result will publish when exam time finished</h4>
                                @endif
                                
                            @elseif ($answer->status == 3)
                                <h4 class="text-center text-danger">Exam cancelled</h4>
                            @endif
                        </div>















                    </div>
                </div>

            </div>
        </div>
        </div>
     


@endsection
