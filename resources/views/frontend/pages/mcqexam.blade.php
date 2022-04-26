@extends('frontend.layouts.app')
@section('title','MCQ Question List')
@section('content')
 

   <!-- brdc-section-->
    <section class="brdc-section py-3 bgg">
        <div class="container section-box">
            <div class="row">
                <div class="col-12">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb wow animate__animated animate__fadeInUp">
                            <li class="breadcrumb-item"><a href="index.html">Home</a></li>
                            <li class="breadcrumb-item active" aria-current="page">Question list</li>
                        </ol>
                    </nav>
                </div>
            </div>
        </div>
    </section>
    <!--    brdc-section end -->

    <!--    question list section-->
    <section class="question-list-section py-2 bgw">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="question-list-content row">

                        @foreach ($currentExams as $item)
                        <div class="enroll-question start-exam clearfix m-2">
                            <h5 class="text-center"> <b>Name of Exam</b> : {{$item->mcqQuestionSubjects?$item->mcqQuestionSubjects->question_no:NULL}}</h5>
                            <table class="table">
                                <tbody><tr>
                                    <th>Subject</th>
                                    <th>:</th>
                                    <td>{{$item->subjects?$item->subjects->name:NULL}}</td>
                                 
                                    <th>Class</th>
                                    <th>:</th>
                                    <td> {{$item->classes?$item->classes->name:NULL}}</td>
                                </tr>
                                <tr>
                                    <th>Session</th>
                                    <th>:</th>
                                    <td> {{$item->sessiones?$item->sessiones->name:NULL}}</td>
                               
                                    <th>Total Qustion</th>
                                    <th>:</th>
                                    <td>
                                     {{$item->mcqQuestionSubjects?$item->mcqQuestionSubjects->mcqQuestions?$item->mcqQuestionSubjects->mcqQuestions->count() : 0 : 0}} 
                                    </td>
                                </tr>
                                <tr>
                                    <th>Date</th>
                                    <th>:</th>
                                    <td>
                                     {{ $item->exam_start_date }}
                                     {{--  Remaining Time :  
                                      {{ \Carbon\Carbon::parse($item->exam_start_date)->diffForhumans() }} --}}
                                    </td>
                                
                                    <th>Time</th>
                                    <th>:</th>
                                    <td> {{$item->total_exam_time }} min</td>
                                </tr>
                                <tr>
                                    <th>Exam Start Time</th>
                                    <th> : </th>
                                    <td> {{ Date('h:i A',strtotime($item->exam_start_time ))}} </td>
                                    <th>Exam End Time</th>
                                    <th> : </th>
                                    <td> {{ Date('h:i A',strtotime($item->exam_end_time))}}    </td>
                                </tr>

                                </tbody>
                            </table>


                            @if(Auth::check())

                             @php
                                $examTotalTime  =   "$item->total_exam_time";
                                $examStarTime   =   strtotime($item->exam_start_time);
                                $nowTime        =   time();
                                $examEndTime    =   strtotime($item->exam_end_time);
                                $remainingTime  =   $examEndTime - $nowTime;
                                $data['remaingTime'] = number_format(($remainingTime / 60),2,':','');
                            @endphp 
                            <div class="enroll-qus clearfix mt-1">
                                @if ($item->checkCapabilityToAttentInExam() &&  
                                    $item->exam_start_date == date('Y-m-d')
                                )
                                    @if ($examStarTime <= $nowTime && $examEndTime > $nowTime)
                                        <div class="qes-btn clearfix">

                                            

                                            <a href="{{route('student.examStart','esid='.$item->id.'&qsid='.$item->question_subject_id.'&sid='.Auth::user()->id)}}">Start Quiz
                                            <i class="fa fa-arrow-right ml-0 ml-sm-2"></i></a>



                                        </div>
                                    @elseif($examStarTime > $nowTime)
                                            <span>Comming soon.... </span>
                                        @else
                                            <span>Time Over, The Exam is completed </span>
                                    @endif
                                @elseif($item->checkCapabilityToAttentInExam() == NULL)
                                    <span>You are unable to attend this exam, please contract with admin </span>
                                @endif
                            </div>
                            @else

                             <div class="enroll-qus clearfix mt-1">
                                 <div class="qes-btn clearfix">
                                     <a href="{{ route('student.login') }}" title="" class="btn btn-primary btn-sm">Start Quiz <i class="fa fa-arrow-right ml-0 ml-sm-2"></i></a>
                                </div>
                            </div>

                            @endif
                        </div>
                        @endforeach

                        
                        
                       
                    </div>

                </div>
            </div>
        </div>
    </section>
    <!--    question list section end-->


@endsection