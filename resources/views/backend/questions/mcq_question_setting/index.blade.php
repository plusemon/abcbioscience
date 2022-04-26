@extends('backend.layouts.app')
@section('title','Mcq Questions List')
@section('content')

    <div id="content" class="content">
        <div class="panel panel-inverse">
            <div class="panel-heading">
                <h4 class="panel-title">Mcq Questions List </h4>
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

                <a href="{{ route('admin.mcq.index') }}" class="btn btn-primary btn-sm float-right mb-1" id="create-new-class"><i class="fa fa-list"></i> Mcq Question List</a>


                    <form action="" method="get" class="form-inline mb-3">


                       
 
                        <select name="class_id" id="class_id" class="class_id form-control mr-3" >
                            <option value="">Select Class</option>
                            @foreach($classes as $class)
                                <option @if(isset($class_id)) {{ $class_id == $class->id ? 'selected' :'' }} @endif value="{{ $class->id }}"> {{ $class->name }}</option>
                            @endforeach
                        </select>

                        <select name="session_id" id="session_id" class="session_id form-control mr-3" >
                            <option value="">Select Session</option>
                            @foreach($sessiones as $session)
                                <option @if(isset($session_id)) {{ $session_id == $session->id ? 'selected' :'' }} @endif value="{{ $session->id }}"> {{ $session->name }}</option>
                            @endforeach
                        </select>

                         <select name="batch_setting_id" id="batch_setting_id" class="batch_setting_id form-control mr-3" >
                             <option  value="">Select Batch</option>
                        </select>


                         <select name="subject_id" id="subject_id" class="subject_id form-control mr-3" >
                            <option value="">Select Subject</option>
                            @foreach($subjects as $subject)
                                <option @if(isset($subject_id)) {{ $subject_id == $subject->id ? 'selected' :'' }} @endif value="{{ $subject->id }}"> {{ $subject->name }}</option>
                            @endforeach
                        </select>




                        <button type="submit" class="btn btn-primary btn-sm"> <i class="fa fa-search"></i>  Search</button>
                        
                    </form>






                <div class="table-responsive">
                  <table  class="table table-hovered table-bordered table-td-valign-middle">
                    <thead>
                    <tr>
                        <th class="text-nowrap">Sl No</th>
                        <th class="text-nowrap">Question No/Name</th>
                        <th class="text-nowrap">Subject Name</th>
                        <th class="text-nowrap">Chapter</th>
                        <th class="text-nowrap">Topic</th>
                        <th class="text-nowrap">Batch</th>
                        <th class="text-nowrap">Class</th>
                        <th class="text-nowrap">Session</th>
                        <th class="text-nowrap">Exam Start<br/> Date & Time</th>
                        <th class="text-nowrap">Exam End<br/>Date & Time</th>
                        <th class="text-nowrap">Exam Duration</th>
                       
                        <th class="text-nowrap">Exam Fee</th>
                        <th class="text-nowrap">Status</th>
                        <th class="text-nowrap">Action</th>
                    </tr>
                    </thead>
                    <tbody>

                    @foreach($questions as $question)
                        <tr>
                            <td>{{ $loop->index+$questions->firstItem()}}</td>
                            <td>{{ $question->mcqQuestionSubjects?$question->mcqQuestionSubjects->question_no:NULL}}</td>
                            <td>{{ $question->subjects?$question->subjects->name:NULL}}</td>
                            <td>{{ $question->mcqQuestionSubjects->chapter?$question->mcqQuestionSubjects->chapter->name:NULL}}</td>
                            <td>{{ $question->mcqQuestionSubjects->topic}}</td>
                            <td>{{ $question->batchsetting?$question->batchsetting->batch_name:''  }} </td>
                            <td>{{ $question->classes?$question->classes->name:''}}</td>
                            <td>{{ $question->sessiones?$question->sessiones->name:''}}</td>

                            <td>{{ date('d-m-Y h:i A',strtotime($question->exam_start_date_time))}}</td>
                            <td>{{ date('d-m-Y h:i A',strtotime($question->exam_end_date_time))}}</td>
                            <td>{{  $question->duration }} Minutes</td>
                            

                            <td>{{ $question->amounts?$question->amounts->amount:''}}</td>
                            
                            <td>
                                @if($question->exam_status==1)
                                    <span class="badge badge-info">Active</span>
                                @elseif($question->exam_status==2)
                                    <span class="badge badge-success">Completed</span>
                                @endif
                            </td>
                            <td class="d-flex btn-group">
                              <a href="{{route('admin.mcq-setting.edit',$question->id)}}" class="btn btn-outline-success btn-sm d-flex align-items-center "> <i class="fa fa-edit"></i> Edit</a>  

                               <a href="{{route('admin.mcq.question.student.setting.create','qtype=mcq&qid='.$question->id)}}" class="btn btn-outline-success"> Setting</a>
                               <a href="{{route('admin.mcq-setting.delete',$question->id)}}" class="btn btn-outline-danger" id="delete"> Delete</a>

                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
                </div>
                <div class="justify-content-center d-flex">
                    {{$questions->links()}}
                </div>
            </div>

        </div>
    </div>


@section('customjs')

    <script>
        $(document).ready( function () {
            $.ajaxSetup({
              headers: {
                  'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
              }
          });

        $(document).ready(function(){
            getBatchSetting();
            getClassType();
        });

        $(document).on('change','.class_id ,.session_id', function () {
              getBatchSetting();
        });

        function getBatchSetting()
        {
            var class_id    = $('.class_id').val();
              var session_id  = $('.session_id').val();
                if(class_id && session_id)
                {
                    $.ajax({
                        type: "get",
                        url: "{{ route('get.batch.setting') }}",
                        data: {class_id:class_id,session_id:session_id},
                        success: function (data) {
                            if(data.status == true)
                            {
                                $(".batch_setting_id").html(data.batch_setting);
                            }
                        },
                        error: function (data) {
                            console.log('Error:', data);
                        }
                    });
                }
        }
 
            
        });
    </script>
@endsection
@endsection
