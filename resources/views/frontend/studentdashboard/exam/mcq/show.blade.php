@extends('frontend.layouts.app')
@section('title', 'Mcq Exam Details')
@section('content')

    <!--USER DASHBOARD-->
    <section class="user-dashboard py-4">
        <div class="container">
            <div class="dashboard-area d-flex bd-highlight">

                @include('frontend.studentdashboard.dashboardmenu')

                <div class="dashboard-main w-100 bd-highlight py-3">
                    <div class="dr-head dashboard-header">
                        <div class="ud-mobile">
                            <i class="fa fa-bars" id="ud-mobile-btn"></i> Dashboard Menu
                        </div>
                        <h6>Quiz Test </h6>
                    </div>
                    <div class="hr-body text-center">
                         <div class="table-responsive">
                            <table class="table">
                            <tbody>
                                <tr>
                                    <th colspan="6">
                                        {{ $exam->mcqQuestionSubjects ? $exam->mcqQuestionSubjects->question_no : null }}
                                    </th>
                                </tr>
                                <tr>
                                    <th>Subject</th>
                                    <th>:</th>
                                    <td>{{ $exam->subjects ? $exam->subjects->name : null }}
                                    </td>

                                    <th>Class</th>
                                    <th>:</th>
                                    <td> {{ $exam->classes ? $exam->classes->name : null }}
                                    </td>
                                </tr>


                                <tr>
                                    <th>Chapter</th>
                                    <th>:</th>
                                    <td>{{ optional($exam->mcqexam->chapter)->name }}
                                    </td>

                                    <th>Topic</th>
                                    <th>:</th>
                                    <td> {{ optional($exam->mcqexam)->topic }}
                                    </td>
                                </tr>


                                <tr>
                                    <th>Session</th>
                                    <th>:</th>
                                    <td> {{ $exam->sessiones ? $exam->sessiones->name : null }}
                                    </td>

                                    <th>Total Question</th>
                                    <th>:</th>
                                    <td>
                                        {{ $exam->mcqQuestionSubjects ? ($exam->mcqQuestionSubjects->mcqQuestions ? $exam->mcqQuestionSubjects->mcqQuestions->count() : 0) : 0 }}
                                    </td>
                                </tr>




                                <tr>
                                    <th>Exam Date</th>
                                    <th>:</th>
                                    <td>
                                        {{ $exam->exam_end_date_time->format('d-m-Y') }}
                                    </td>
                                    <th>Exam Duration</th>
                                    <th>:</th>
                                    <td>
                                        {{ $exam->duration . ' minutes' }}
                                    </td>
                                </tr>
                                <tr>
                                    <th>Exam Start Time</th>
                                    <th>:</th>
                                    <td>
                                        {{ $exam->exam_start_date_time->format('h:i A') }}
                                    </td>
                                    <th>Exam End Time</th>
                                    <th>:</th>
                                    <td>
                                        {{ $exam->exam_end_date_time->format('h:i A') }}
                                    </td>
                                </tr>







                            </tbody>
                        </table>
                        </div>

                         @php
                            $start = $exam->exam_start_date_time;
                            $end = $exam->exam_end_date_time;
                            $now = now();
                            $isStarted = $start <= $now;
                            $isExpired = $end < $now;
                            $isValid = $start <= $now && $end > $now;
                            $isPermitted = $exam->checkCapabilityToAttentInExam();
                            $isAttend = $attend;
                            
                            if ($isAttend) {
                                $expireAt = $attend->created_at->addMinutes($exam->duration);
                                $isNotTimeOut = $expireAt > $now;
                                $isNotFinished = !$attend->status;
                            }
                        @endphp



                         <form action="{{ route('student.exam.mcq.store') }}" method="post" name="submitForm">
                            @csrf

                            <input type="hidden" name="batch_setting_id"
                                value="{{ $exam ? $exam->batch_setting_id : null }}" />
                            <input type="hidden" name="batch_type_id"
                                value="{{ $exam ? $exam->batch_type_id : null }}" />
                            <input type="hidden" name="class_id" value="{{ $exam ? $exam->class_id : null }}" />
                            <input type="hidden" name="session_id" value="{{ $exam ? $exam->session_id : null }}" />
                            <input type="hidden" name="examination_type_id"
                                value="{{ $exam ? $exam->examination_type_id : null }}" />
                            <input type="hidden" name="mcq_exam_setting_id" value="{{ $exam ? $exam->id : null }}" />
                            <input type="hidden" name="mcq_question_subject_id"
                                value="{{ $exam ? $exam->question_subject_id : null }}" />
                            <input type="hidden" name="subject_id" value="{{ $exam ? $exam->subject_id : null }}" />
                            <input type="hidden" name="student_id" value="{{ $findstudentid->id }}" />

                            @if ($isStarted && !$isExpired)
                                @if ($isPermitted)
                                    @if ($isAttend)
                                        <input type="hidden" name="attend_id" value="{{ $attend->id }}">
                                        @if ($isNotFinished)
                                            @if ($isNotTimeOut)
                                                <div id="content">
                                                    <p id="remain_bar" class="alert alert-info"><i
                                                            class="fa fa-clock-o"></i> <span id="remain_time"></span>
                                                    </p>

                                                    @foreach ($exam->mcqQuestionSubjects->mcqQuestions as $key => $mcqQes)
                                                        <div class="model-test-question">

                                                            <div class="question-box">
                                                                <div class="qb-head">
                                                                    <h5>question
                                                                        {{ $key + 1 }} of
                                                                        {{ $exam->mcqQuestionSubjects->mcqQuestions->count() }}
                                                                    </h5>
                                                                </div>
                                                                <div>
                                                                    <div class="qb-body text-left">
                                                                        <p>{!! $mcqQes ? $mcqQes->describe : null !!}  </p>
                                                                       
                                                                        <p>
                                                                            @if ($mcqQes->image != null)
                                                                                <img src="{{ asset($mcqQes->image) }}"
                                                                                    alt="" width="100px">
                                                                            @endif
                                                                        </p>
                                                                        
                                                                        <p>{!! $mcqQes ? $mcqQes->question : null !!} </p>
                                                                        <input type="hidden"
                                                                            value="{{ $mcqQes ? $mcqQes->id : null }}"
                                                                            name="question_no_{{ $key }}" />
                                                                        <input type="hidden"
                                                                            value="{{ $mcqQes ? $mcqQes->id : null }}"
                                                                            name="questions[]" />
                                                                        <div class="single-question">
                                                                            <div class="input-box">
                                                                                @foreach ($mcqQes ? ($mcqQes->options ? $mcqQes->options : null) : null as $optio)
                                                                                    <div class="form-check">
                                                                                        <input
                                                                                            class="form-check-input radio-clickable"
                                                                                            type="radio"
                                                                                            name="question_option_{{ $key }}"
                                                                                            value="{{ $optio ? $optio->id : null }}">
                                                                                        <label class="form-check-label"
                                                                                            for="11">
                                                                                            <span>({{ $optio ? $optio->pattern : null }})</span>&nbsp;
                                                                                            &nbsp;
                                                                                            <span>
                                                                                                {!! $optio ? $optio->option : null !!}
                                                                                            </span>
                                                                                        </label>
                                                                                    </div>
                                                                                    @if (($optio ? $optio->answer : null) == 1)
                                                                                        <input type="hidden"
                                                                                            value="{{ $optio ? $optio->id : null }}"
                                                                                            name="question_answer_{{ $key }}" />
                                                                                    @endif
                                                                                @endforeach
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    @endforeach
                                                    <div class="text-center">
                                                        <input value="Submit"
                                                            onclick="this.disabled=true; this.value='Submitting...'; submitForm.submit()"
                                                            class="btn btn-custom">
                                                    </div>
                                                </div>

                                            @else
                                                <h4 class="text-danger">Exam Timeout</h4>
                                            @endif
                                        @else
                                            @if ($isAttend->verified)
                                                <h4 class="text-success">Successfully Completed</h4>
                                                <a href="{{ route('student.exam.mcq.show', $attend->id) }}"
                                                    class="btn btn-custom">View Result</a>
                                            @else
                                                <h4 class="text-danger">Exam Cancelled</h4>
                                            @endif

                                        @endif
                                    @else
                                        <input type="hidden" name="admit" value="{{ $exam->id }}">
                                        <button type="submit" class="btn btn-primary">Start
                                            Exam</button>
                                    @endif
                                @else
                                    <h4 class="text-danger">Permission Not allowed
                                    </h4>
                                @endif
                            @elseif($isExpired)
                                <h4 class="text-danger">Exam Timeout</h4>
                            @else
                               <h4 class="text-danger"> Comming Soon .... Exam Start time : <span class="text-success"> {{  Date('d-m-Y h:i A',strtotime($start))  }} </span>  </h4>
                            @endif
                        </form>
  
 
                    </div>
                </div>

            </div>
        </div>
    </section>
    <!--END USER DASHBOARD-->
    @include('frontend.studentdashboard.mobilemenu')

@endsection

@if ($isAttend && $isNotTimeOut && $isNotFinished)
    @section('customjs')
        <script>
            var countDownDate = new Date("{{ $expireAt }}").getTime();
            var x = setInterval(function() {

                var now = new Date().getTime();
                var distance = countDownDate - now;

                var minutes = Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60));
                var seconds = Math.floor((distance % (1000 * 60)) / 1000);

                document.getElementById("remain_time").innerHTML = minutes + "m " + seconds + "s ";

                if (minutes < 5 && seconds == 0) {
                    $('#remain_bar').removeClass('alert-info').addClass('alert-danger');
                }

                if (distance < 0) {
                    clearInterval(x);
                    document.getElementById("remain_time").innerHTML = 'Finishing!';
                    // location.reload();
                    document.submitForm.submit();
                }
            }, 1000);
        </script>
    @endsection
@endif

@php
if ($attend && !$attend->verified) {
    $attend->status = 1;
    $attend->save();
}
@endphp
