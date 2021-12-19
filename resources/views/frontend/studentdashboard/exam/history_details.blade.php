@extends('frontend.layouts.app')
@section('title','Lecture Sheet')

@section('css')

@endsection
@section('content')

        <section class="model-test-section py-5">
            <div class="container">
                <div class="row">
                    <div class="col-12">
                        <div class="model-test-body">
                            <div class="model-test-head">
                               {{--   <h4>Online MCQs practic in choching center</h4>
                                <h6>Online Exam 01</h6>  --}}
                                <p><i class="fa fa-clock-o"></i> Remaining Time  : <span class="countdown"></span> </p>
                                {{--  <div class="progress">
                                    <div class="progress-bar bg-info" role="progressbar" style="width: 50%" aria-valuenow="50" aria-valuemin="0" aria-valuemax="100"></div>
                                </div>  --}}
                            </div>
                            
                            @foreach($examHistoryDetail->mcqQuestionSubjects?$examHistoryDetail->mcqQuestionSubjects->mcqQuestions?$examHistoryDetail->mcqQuestionSubjects->mcqQuestions:NULL:NULL  as $key=> $mcqQes)
                                <div class="model-test-question">

                                    <div class="question-box">
                                        <div class="qb-head">
                                            <h5>question {{ $key + 1 }} of {{ $examHistoryDetail->mcqQuestionSubjects?$examHistoryDetail->mcqQuestionSubjects->count():0 }}</h5>
                                        </div>
                                        <div>
                                            <div class="qb-body">
                                                    <p>{{$mcqQes?$mcqQes->question: NULL}}.</p>
                                                    <input type="hidden" value="{{$mcqQes?$mcqQes->id: NULL}}" name="question_no_{{$key}}" />
                                                    <input type="hidden" value="{{$mcqQes?$mcqQes->id: NULL}}" name="questions[]" />
                                                    <div class="single-question">
                                                        <div class="input-box">
                                                            @foreach($mcqQes?$mcqQes->options?$mcqQes->options : NULL : NULL as $optio)
                                                            <div class="form-check">
                                                                @php 
                                                                    $given_option_id = $examHistoryDetail->correctAnswers($mcqQes->id)?$examHistoryDetail->correctAnswers($mcqQes->id)->given_option_id : NULL;
                                                                    $correct_option_id = $examHistoryDetail->correctAnswers($mcqQes->id)?$examHistoryDetail->correctAnswers($mcqQes->id)->correct_option_id : NULL;
                                                                @endphp
                                                                <input class="form-check-input radio-clickable" type="radio" name="question_option_{{$key}}"  value="{{$optio?$optio->id:NULL}}" @if($given_option_id == $optio->id) checked @else '' @endif >
                                                                
                                                                <label class="form-check-label">
                                                                    <span>{{$optio?$optio->pattern:NULL}})</span>&nbsp; &nbsp; 
                                                                    <span> {{$optio?$optio->option:NULL}} </span>
                                                                    @if(($optio?$optio->answer:NULL) == 1)
                                                                       <span style="color:green;"> <i class="fa fa-check"></i> </span>
                                                                    @endif
                                                                    
                                                                    @if($optio->id == $given_option_id && $given_option_id == $correct_option_id)
                                                                        @if(($optio?$optio->answer:NULL) == 1 && $given_option_id  == $correct_option_id)
                                                                        <span style="color:green;"> <i class="fa fa-check"></i> </span>
                                                                        @endif
                                                                    @elseif($optio->id == $given_option_id  && $given_option_id != $correct_option_id)
                                                                       <span style="color:red;"> <i class="fa fa-times"></i> </span>
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
            </div>
        </section>

    @section('customjs')
    @endsection
@endsection
