@extends('frontend.layouts.app')
@section('title', 'Written Exam Details')

@section('css')
    <style>
        #remain_bar {

            position: fixed;
            right: 139px;
            top: 80px;
            border-radius: 15px;
            padding: 5px 10px;
            z-index: 100;
            background-color: #ffc107;
        }

        @media screen and (max-width: 315px) {
            #remain_bar {
                right: 68px;
                top: 9px;
            }
        }

        @media screen and (max-width: 1000px) {
            #remain_bar {
                right: 100px;
                top: 87px;
            }
        }

        @media screen and (max-width: 768px) {

            #remain_bar {
                right: 70px;
                top: 84px;
            }
        }

    </style>
@endsection

@section('content')

    <!--USER DASHBOARD-->
    <section class="user-dashboard py-4">
        <div class="container">
            <div class="dashboard-area d-flex bd-highlight">

                @include('frontend.studentdashboard.dashboardmenu')

                <div class="dashboard-main w-100 bd-highlight py-3">
                    <div class="dr-head dashboard-header">
                        <div class="ud-mobile">
                            <i class="fa fa-bars" id="ud-mobile-btn"></i> Profile Menu
                        </div>
                        <h6>Writting Exam Hall </h6>

                    </div>
                    <div class="hr-body text-center">
                        <h5 class="text-center">{{ $exam->writtenexam ? $exam->writtenexam->question_no : '' }}
                        </h5>
                        <table id="laravel_datatable" class="table table-striped table-bordered table-td-valign-middle">
                            <thead>
                                <tr>
                                    <th class="text-nowrap">Class</th>
                                    <th class="text-nowrap">Session</th>
                                    <th class="text-nowrap">Batch</th>
                                    <th class="text-nowrap">Subject</th>
                                    <th class="text-nowrap">Time</th>

                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td> {{ $exam->classes->name }}</td>
                                    <td> {{ $exam->sessiones->name }}</td>
                                    <td> {{ $exam->batchsetting->batch_name }}</td>
                                    <td> {{ $exam->subjects->name }}</td>
                                    <td>{{ $exam->duration . ' minutes' }}</td>
                                </tr>
                            </tbody>
                        </table>


                        @if ($errors->any())
                            <div class="alert alert-danger">
                                <ul>
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif


                        @php
                            $start = $exam->exam_start_date_time;
                            $end = $exam->exam_end_date_time;
                            $now = now();
                            
                            $isValid = $start <= $now && $end > $now;
                            $isPermitted = $exam->checkCapabilityToAttentInExam();
                            $isAttend = $attend;
                            
                            if ($isAttend) {
                                $expireAt = $attend->created_at->addMinutes($exam->duration);
                            
                                $isNotTimeOut = $expireAt > $now;
                                $isNotFinished = !$attend->submission_files;
                            }
                        @endphp

                        <div>
                            @if ($isValid)
                                @if ($isPermitted)
                                    @if ($isAttend)
                                        @if ($isNotFinished)
                                            @if ($isNotTimeOut)
                                                 

                                                <!--    <img src="{{ asset($exam->writtenexam->attachment) }}" alt="" width="100%">
                                                
                                                -->
                                                
                                <?php 
		  
                                            $path_parts = pathinfo($exam->writtenexam?$exam->writtenexam->attachment:'');
                                            
                                              if($path_parts['extension']=='jpeg' || $path_parts['extension']=='png' || $path_parts['extension']=='jpg'){ ?>
                                                     <img src="{{ asset($exam->writtenexam->attachment) }}" alt="" width="100%">
                                                     
                                                     
                                             <?php  }else{   ?>
                                             
                                              
                                      <!--        <embed src="{{ asset($exam->writtenexam?$exam->writtenexam->attachment:'') }}" style="width:100%; height:800px;" frameborder="0">-->
                                              
                                             <a href="{{ asset($exam->writtenexam?$exam->writtenexam->attachment:'') }}" class="btn btn-primary btn-sm"> <i class="fa fa-eye"></i> Click to Preview </a>
                                              
                                              
                                            
                                             <?php  }  ?>

                                                <div id="remain_bar" class="h6 alert alert-info">
                                                    Your time remaining: <span id="remain_time">Exam Started</span>
                                                </div>
                                                <!--<h6 class="alert-warning alert">Dont Leave or Refresh this page untill
                                                    submit
                                                    your
                                                    answersheet..!</h6>-->

                                                <form action="{{ route('student.exam.written.store') }}" method="POST"
                                                    enctype="multipart/form-data" class="row align-items-center">
                                                    @csrf

                                                    <input type="hidden" name="exam_setting_id" value="{{ $exam->id }}">
                                                    <input type="hidden" name="student_id" value="{{ $student->id }}">
                                                    <div class="col-md-2"></div>
                                                    <div class="form-group col-md-12">

                                                       <!-- <label for="Choose Aswersheet (Pdf, jpg, png etc.)"></label>-->
                            <input type="hidden" name="upload_files[]" class="form-control-file" multiple >
                                                    </div>
                                                    <div class="text-center" style="width:30%;margin:0 auto">
                                                           <button type="submit" class="btn btn-success">Upload Answer sheet to Messenger </button>
                                                        
                                                      <!--  <a herf="{{ $exam->classes?$exam->classes->fb_link:'' }}" class="btn btn-success" target="_blank"> Upload Answer sheet to Messenger </a>-->
                                                    </div>
                                                </form>
                                                
                                             
                                              <!--  <p class="text-info">Here you can upload multiple files at once..
                                                    Just select your files and submit.
                                                </p>-->
                                            @else
                                                <h4 class="text-danger">Your exam timeout</h4>
                                            @endif
                                        @else
                                            <h4 class="text-success">Successfully Completed</h4>
                                            <a href="{{ route('student.exam.written.history') }}"
                                                class="btn btn-custom">View Result</a>
                                        @endif
                                    @else
                                        <form action="{{ route('student.exam.written.store') }}" method="POST">
                                          
                                            @csrf
                                            <input type="hidden" name="exam_setting_id" value="{{ $exam->id }}">
                                            <input type="hidden" name="attend" value="attend">
                                            <input type="text" name="student_id" value="{{ $student->id }}" style="display:none">
                                            <button type="submit" class="btn btn-custom my-2">Start Exam Now</button>
                                        </form>

                                    @endif
                                @else
                                    <h4 class="text-danger">You have not permission to take this exam</h4>
                                @endif
                            @else
                               <h4 class="text-primary">Comming Soon .... Exam Start time : <span class="text-success"> {{  Date('d-m-Y h:i A',strtotime($start))  }} </span>  </h4>
                            @endif
                        </div>
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
                    document.getElementById("remain_time").innerHTML = 'Finishing exam..!';
                    location.reload();
                }
            }, 1000);
        </script>
    @endsection
@endif

@php
if ($attend && $attend->status == 0) {
    $attend->status = 3;
    $attend->save();
}
@endphp
