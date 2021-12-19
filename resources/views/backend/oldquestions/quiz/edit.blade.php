@extends('backend.layouts.app')
@section('title','Edit Quiz')
@section('content')


    <div id="content" class="content">
        <div class="panel panel-inverse">
            <div class="panel-heading">
                <h4 class="panel-title">Edit Quiz </h4>
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
                <form action="{{ route('quiz.update',$quiz->id) }}" method="post" enctype="multipart/form-data">
                    @CSRF
                    
                    <div class="row">
                         <div class="col-xs-12 col-sm-3 col-md-3">
                            <div class="form-group">
                                <label for="class">Class :</label>
                                <select name="class_id" id="class_id" class="class_id form-control" >
                                    <option value="">Select Class</option>
                                    @foreach($classes as $class)
                                        <option {{ $quiz->classes_id == $class->id ? 'selected' :'' }} value="{{ $class->id }}"> {{ $class->name }}</option>
                                    @endforeach
                                </select>
                                <div class="text-danger">{{ $errors->first('class_id') }}</div>
                            </div>
                        </div>
                        <div class="col-xs-12 col-sm-3 col-md-3">
                            <div class="form-group">
                                <label for="Session">Session :</label>
                                <select name="session_id" id="session_id" class="session_id form-control" >
                                    <option value="">Select Session</option>
                                    @foreach($sessiones as $session)
                                        <option {{ $quiz->sessiones_id == $session->id ? 'selected' :'' }} value="{{ $session->id }}"> {{ $session->name }}</option>
                                    @endforeach
                                </select>
                                 <div class="text-danger">{{ $errors->first('session_id') }}</div>
                            </div>
                        </div>



                        <div class="col-xs-12 col-sm-3 col-md-3">
                            <div class="form-group">
                                <label for="Batch Setting">Batch  :</label>
                                <select name="batch_setting_id" id="batch_setting_id" class="batch_setting_id form-control" >
                                     <option  value="">Select Batch</option>
                                     <option value="{{ $quiz->batch_setting_id }}" selected="">{{ $quiz->batchsetting->batch_name }}</option>

                                </select>
                                <div class="text-danger">{{ $errors->first('batch_setting_id') }}</div>
                            </div>
                        </div>

                         <div class="col-xs-12 col-sm-3 col-md-3">
                            <div class="form-group">
                                <label for="">Batch Type</label>
                                <select name="student_type_id" id="student_type_id" class="student_type_id form-control" >
                                     <option value="">Select Batch Type</option>
                                    
                                </select>
                                 <div class="text-danger">{{ $errors->first('student_type_id') }}</div>
                            </div>
                        </div>

                        <div class="col-xs-12 col-sm-4 col-md-4">
                            <div class="form-group">
                                <label for="">MCQ Quiz Name</label>
                                <input type="text" name="quiz_name" value="{{ $quiz->quiz_name }}" class="form-control" placeholder="Quiz Name">
                                 <div class="text-danger">{{ $errors->first('quiz_name') }}</div>
                            </div>
                        </div>

                        <div class="col-xs-12 col-sm-3 col-md-3">
                            <div class="form-group">
                                <label for="">MCQ Quiz Time</label>
                                <input type="text" name="quiz_time" value="{{ $quiz->quiz_time }}" class="form-control" placeholder="Quiz time">
                                 <div class="text-danger">{{ $errors->first('quiz_time') }}</div>
                            </div>
                        </div>

                        <div class="col-xs-12 col-sm-3 col-md-3">
                            <div class="form-group">
                                <label for="Subject">Subject :</label>
                                <select name="subject_id" id="subject_id" class="subject_id form-control" >
                                    <option value="">Select Subject</option>
                                    @foreach($subjects as $subject)
                                        <option {{ $quiz->subject_id == $subject->id ? 'selected' :'' }} value="{{ $subject->id }}"> {{ $subject->name }}</option>
                                    @endforeach
                                </select>
                                 <div class="text-danger">{{ $errors->first('subject_id') }}</div>
                            </div>
                        </div>



                        <div class="col-xs-12 col-sm-9 col-md-9">
                            <div class="form-group">
                                <label for="school">MCQ Quiz Description:</label>
                                <textarea name="quiz_description" type="text" id="quiz_description" class="form-control" placeholder="Enter Quiz Description">{{ $quiz->quiz_description }}</textarea>
                                 <div class="text-danger">{{ $errors->first('quiz_description') }}</div>
                            </div>
                        </div>
                        <div class="col-xs-12 col-sm-3 col-md-3">
                            <div class="form-group">
                                <label for="status">Status</label>
                                <select name="status" id="status" class="form-control">
                                    <option {{ $quiz->status == 1 ? 'selected' : '' }} value="1">Active</option>
                                    <option {{ $quiz->status == 2 ? 'selected' : '' }} value="2">Inactive</option>
                                </select>
                            </div>
                        </div>



                    </div>

                 
 

                    <button type="submit" class="btn btn-primary mt-3">Submit</button>

                </form>
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



        $(document).on('change','.batch_setting_id,.class_id ,.session_id', function () {
            getClassType();
        });

            function getClassType()
            {
                var class_id          = $('.class_id').val();
                var session_id        = $('.session_id').val();
                var batch_setting_id  = $('.batch_setting_id').val();
                if(class_id && session_id)
                {
                    $.ajax({
                        type: "get",
                        url: "{{ route('get_class_type_by_batch_setting') }}",
                        data: {class_id:class_id,session_id:session_id,batch_setting_id:batch_setting_id},
                        success: function (data) {
                            if(data.status == true)
                            {
                                $(".student_type_id").html(data.class_type);
                            }else{
                                $(".student_type_id").html(data.class_type);
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
