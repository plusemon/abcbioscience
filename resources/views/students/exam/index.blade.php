@extends('frontend.layouts.app')
@section('title','Available Written Exams')
@section('content')


<section class="brdc-section py-3 bgg">
        <div class="container section-box">
            <div class="row">
                <div class="col-12">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb wow animate__ animate__fadeInUp animated" style="visibility: visible; animation-name: fadeInUp;">
                            <li class="breadcrumb-item"><a href="index.html">Home</a></li>
                            <li class="breadcrumb-item active" aria-current="page">Written Exam</li>
                        </ol>
                    </nav>
                </div>
            </div>
        </div>
    </section>
 
    <section class="enroll-question-details-section py-2 bgw">
        <div class="container">
            <div class="quize-start-page-content">
                <div class="row">
                    <div class="col-12 col-md-6 col-lg-7 text-center">
                        @foreach ($examHistories as $item) 
                        <div class="enroll-question start-exam clearfix">
                            <h5>Name of Exam :  {{$item->mcqQuestionSubjects?$item->mcqQuestionSubjects->question_no:NULL}}</h5>
                            <table>
                                <tbody><tr>
                                    <th>Subject</th>
                                    <th>:</th>
                                    <td>{{$item->subjects?$item->subjects->name:NULL}}</td>
                                </tr>
                                <tr>
                                    <th>Class</th>
                                    <th>:</th>
                                    <td> {{$item->classes?$item->classes->name:NULL}}</td>
                                </tr>
                                <tr>
                                    <th>Section</th>
                                    <th>:</th>
                                    <td> {{$item->sessiones?$item->sessiones->name:NULL}}</td>
                                </tr>
                                <tr>
                                    <th>Total Question</th>
                                    <th>:</th>
                                    <td>
                                     {{$item->mcqQuestionSubjects?$item->mcqQuestionSubjects->mcqQuestions?$item->mcqQuestionSubjects->mcqQuestions->count() : 0 : 0}} 
                                    </td>
                                </tr>
                                <tr>
                                    <th>Correct Answer</th>
                                    <th>:</th>
                                    <td>
                                     {{$item->final_result ?? 0}} 
                                    </td>
                                </tr>
                                <tr>
                                    <th>Date</th>
                                    <th>:</th>
                                    <td>
                                     {{ $item->examSettings?$item->examSettings->exam_start_date_time:NULL }}
                                    </td>
                                </tr>
                                <tr>
                                    <th>Time</th>
                                    <th>:</th>
                                    <td> {{$item->examSettings?$item->examSettings->duration:NULL }} min</td>
                                </tr>

                                </tbody>
                            </table>

                            <div class="enroll-qus clearfix mt-1">
                                <div class="qes-btn clearfix">
                                    <a href="{{route('student.exam.wriiten.history.show','qasid='.$item->id.'&sid='.Auth::user()->id)}}">View Details
                                    <i class="fa fa-arrow-right ml-0 ml-sm-2"></i></a>
                                </div>
                            </div>
                        </div>
                      @endforeach
                    </div>

                    <div class="col-12 col-md-6 col-lg-5 ">
                        <div class="latest-question-box">
                           <h4>Latest Question</h4>
                           @foreach ($examHistories as $item)
                            <div class="question-list-box-content">
                                <h6>
                                    {{$item->examtypies?$item->examtypies->name:NULL}}
                                </h6>
                                <div class="qs-time-total clearfix">
                                    <span> <i>Time: 0.50 hrs</i></span>
                                    
                                    <span> <i>Total question : 50</i></span>
                                </div>
                                <div class="question-details-btn">
                                    <a href="#">Qeuestion Details</a>
                                </div>
                            </div>
                            @endforeach
                        </div>

                        {{-- <div class="latest-question-box">
                           <h4>Old Question</h4>
                           @foreach ($latestExams as $item)
                            <div class="question-list-box-content">
                                <h6>name of ther question</h6>
                                <div class="qs-time-total clearfix">
                                    <span> <i>Time: 0.50 hrs</i></span>
                                    
                                    <span> <i>Total question : 50</i></span>
                                </div>
                                <div class="question-details-btn">
                                    <a href="#">Qeuestion Details</a>
                                </div>
                            </div>
                            @endforeach
                        </div> --}}

                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection