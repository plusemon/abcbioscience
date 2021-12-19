@extends('students.layouts.app')
@section('title', 'Quiz Test History')
@section('content')
    <div id="content" class="content">
        <div class="panel panel-inverse">
            <div class="panel-heading">
                <h4 class="panel-title">Quiz Test History</h4>
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
                        
                      
                      <table class="table table-bordered table-hovered datatables">
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
    </div>
     

@endsection
