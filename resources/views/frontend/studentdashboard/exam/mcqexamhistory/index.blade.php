@extends('frontend.layouts.app')
@section('title', 'Quiz History')
@section('content')

    <!--USER DASHBOARD-->
    <section class="user-dashboard py-4">
        <div class="container">
            <div class="dashboard-area d-flex bd-highlight">
                

          
            @include('frontend.studentdashboard.dashboardmenu')
         

              <div class="dashboard-main w-100 bd-highlight py-3">
                  <div class="dr-head">
                      <div class="ud-mobile">
                            <i class="fa fa-bars" id="ud-mobile-btn"></i>Profile Menu
                        </div>
                        <h6> Quiz History </h6>
                        <hr>
                    </div>
                    <div class="hr-body">
                      <div class="table-responsive">
                        
                      
                      <table class="table table-bordered table-hovered">
                        <thead>
                          <tr>
                            <th>SL</th>
                            <th>Quiz</th>
                            <th>Subject</th>
                            <th>Batch</th>
                            <th>Class</th>
                            <th>Session</th>
                            <th>Total Mark</th>
                            <th>Your Mark</th>
                            <th>Date</th>
                             
                            <th>Action</th>
                          </tr>
                        </thead>
                        <tbody>

                          @foreach ($answers as $answer) 
                                  <tr>
                                    <td>{{ $loop->iteration }}</td>
                                      <td>{{ optional($answer->mcqQuestionSubjects)->question_no}}</td>
                                      <td>{{ $answer->subjects->name}}</td>
                                 
                                      <td> {{$answer->batchsetting->batch_name}}</td>
                                      <td> {{$answer->classes->name}}</td>
                                  
                                      <td> {{$answer->sessiones->name}}</td>
                                  
                                      <td>
                                       {{ optional(optional($answer->mcqQuestionSubjects)->mcqQuestions)->count() ?? ''}} 
                                      </td>
                                  
                                      <td> {{$answer->mcqexamanssummery->where('result',1)->count() }} </td>
                                   
                                      <td>
                                       {{    $answer->created_at->format('d-m-Y h:i A') }}
                                      </td>
                                  
                                     
                                   <td> 
                                      <a href="{{route('student.exam.mcq.show', $answer->id )}}"  class="btn btn-primary btn-sm">Detail
                                      <i class="fa fa-eye ml-0 ml-sm-2"></i></a>
                                    </td> 

                                </tr>
                                 
                        @endforeach
                           
                        </tbody>
                      </table>

                      </div>













                            
                    </div>
                </div>

            </div>
        </div>
    </section>
    <!--END USER DASHBOARD-->



    @include('frontend.studentdashboard.mobilemenu')


@endsection
