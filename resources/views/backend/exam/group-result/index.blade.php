@extends('backend.layouts.app')
@section('title', 'Group Result')
@section('content')

        <div id="content" class="content">
            <div class="panel panel-inverse">
                <div class="panel-heading">
                    <h4 class="panel-title">Exam Result Group list  </h4>
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

                    <form action="{{ route('admin.result.group.store') }}" method="post" accept-charset="utf-8" >
                        @csrf
                    
                        <div class="form-inline">

                            <input type="text" name="name" class="form-control"  placeholder="Enter Exam Name">
     
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



                            <select name="mcq_exam_setting_id" id="mcq_exam_setting_id" class="mcq_exam_setting_id form-control mr-3" >
                                 <option  value="">Select MCQ Exam</option>
                            </select>

                            <select name="written_exam_setting_id" id="written_exam_setting_id" class="written_exam_setting_id form-control mr-3" >
                                 <option  value="">Select Written Exam</option>
                            </select>



                            <button type="submit" class="btn btn-primary btn-sm" id="search_id"> <i class="fa fa-check"></i>  Submit</button>
                            
                        </div>

                     </form>


                     <br>
                     <hr>
                     <br>




                     <table class="table table-bordered">
                        <thead>
                            <tr class="text-center">
                                <th>#</th>
                                <th>Name</th>
                                <th>Class</th>
                                <th>Session</th>
                                <th>Batch</th>
                                <th>MCQ Name</th>
                                <th>MCQ Mark</th>
                                <th>Written Name</th>
                                <th>Written Mark</th>
                                <th>Action</th>
                            </tr>
                        </thead>

                        <tbody>
                            @foreach ($result_groups as $group)
                            <tr>
                                <td>{{ $loop->index+1 }}</td>
                                <td>{{ $group->name }}</td>
                                <td>{{ $group->classes?$group->classes->name:'' }}</td>
                                <td>{{ $group->sessiones?$group->sessiones->name:'' }}</td>
                                <td>{{ $group->batchsetting?$group->batchsetting->batch_name:'' }}</td>
                                <td>{{ $group->mcqexamsetting->mcqQuestionSubjects?$group->mcqexamsetting->mcqQuestionSubjects->question_no:'' }}</td>
                                <td>{{ $group->mcq_exam_total_mark }}</td>
                                <td>{{ $group->writtenexamsetting->writtenQuestionSubjects?$group->writtenexamsetting->writtenQuestionSubjects->question_no:'' }}</td>
                                <td>{{ $group->written_exam_total_mark }}</td>
                                                    
                                <td class="text-center" style="width: 15%">
                                    <div class="btn-group-vertical">
                                        
                                        <a href="{{ route('admin.result.group.show', $group->id) }}" class="btn btn-sm btn-outline-dark">Show result</a>
                                        

                                        <form action="{{ route('admin.result.group.destroy', $group->id) }}" method="POST">
                                            @csrf
                                            @method('delete')
                                        <button type="submit" class="btn btn-sm btn-outline-danger">Delete</button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>

                    </table>
 




 

                      
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


         $(document).on('change','.class_id ,.session_id,.batch_setting_id', function () {


              getMCQExamSetting();
              getWrittenExamSetting();
        });



         function getMCQExamSetting()
         {
              var class_id    = $('.class_id').val();
              var session_id  = $('.session_id').val();
              var batch_setting_id  = $('.batch_setting_id').val();

                if(class_id && session_id && batch_setting_id)
                {
                    $.ajax({
                        type: "get",
                        url: "{{ route('admin.result.get.exam.setting.mcq') }}",
                        data: {class_id:class_id,session_id:session_id,batch_setting_id:batch_setting_id},
                        success: function (data) {
                            if(data.status == true)
                            {
                                $(".mcq_exam_setting_id").html(data.batch_setting);
                            }
                        },
                        error: function (data) {
                            console.log('Error:', data);
                        }
                    });
                }
         }


         function getWrittenExamSetting()
         {
              var class_id    = $('.class_id').val();
              var session_id  = $('.session_id').val();
              var batch_setting_id  = $('.batch_setting_id').val();

                if(class_id && session_id && batch_setting_id)
                {
                    $.ajax({
                        type: "get",
                        url: "{{ route('admin.result.get.exam.setting.written') }}",
                        data: {class_id:class_id,session_id:session_id,batch_setting_id:batch_setting_id},
                        success: function (data) {
                            if(data.status == true)
                            {
                                $(".written_exam_setting_id").html(data.batch_setting);
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
