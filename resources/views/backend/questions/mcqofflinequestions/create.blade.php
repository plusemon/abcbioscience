@extends('backend.layouts.app')
@section('title','Add New Mcq Offline Questions')
@section('content')


    <div id="content" class="content">
        <div class="panel panel-inverse">
            <div class="panel-heading">
                <h4 class="panel-title">Add New Mcq Offline Questions  </h4>
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


                    @if (session()->has('error'))
                    <div class="alert alert-danger">
                        @if(is_array(session('error')))
                            <ul>
                                @foreach (session('error') as $message)
                                    <li>{{ $message }}</li>
                                @endforeach
                            </ul>
                        @else
                            {{ session('error') }}
                        @endif
                    </div>
                    @endif


                <form action="{{ route('mcqoffline.store') }}" method="post" enctype="multipart/form-data">
                    @CSRF

                    <div class="row">
                        <div class="col-xs-12 col-sm-6 col-md-6">
                            <div class="form-group">
                                <label for="class">Question No/Name :</label>
                                <input type="text" name="question_no" placeholder="Question no/name" class="form-control" >
                                <div class="text-danger">{{ $errors->first('question_no') }}</div>
                            </div>
                        </div>
                        <div class="col-xs-12 col-sm-6 col-md-6">
                            <div class="form-group">
                                <label for="Subject">Subject :</label>
                                <select name="subject_id" id="subject_id" class="form-control" >
                                    <option value="">Select Subject</option>
                                    @foreach($subjectes as $subject)
                                        <option {{ old('subject_id') == $subject->id ? 'selected' :'' }} value="{{ $subject->id }}"> {{ $subject->name }}</option>
                                    @endforeach
                                </select>
                                 <div class="text-danger">{{ $errors->first('session_id') }}</div>
                            </div>
                        </div>


                        <div class="col-xs-12 col-sm-6 col-md-6">
                            <div class="form-group">
                                <label for="Subject">Chapter :</label>
                                <select name="chapter_id" id="chapter_id" class="form-control" >
                                    <option value="">Select Chapter</option>
                                   
                                </select>
                                 <div class="text-danger">{{ $errors->first('chapter_id') }}</div>
                            </div>
                        </div>

                        <div class="col-xs-12 col-sm-6 col-md-6">
                            <div class="form-group">
                                <label for="class">Chapter Topic/Lesson:</label>
                                <input type="text" name="topic" value="{{ old('topic') }}" placeholder="Chapter topic" class="form-control" >
                                <div class="text-danger">{{ $errors->first('topic') }}</div>
                            </div>
                        </div>
                        <div class="col-xs-12 col-sm-4 col-md-4">
                            <div class="form-group">
                                <label for="class">Class :</label>
                                <select name="class_id" id="class_id" class="class_id form-control" >
                                    <option value="">Select Class</option>
                                    @foreach($classes as $class)
                                        <option {{ old('class_id') == $class->id ? 'selected' :'' }} value="{{ $class->id }}"> {{ $class->name }}</option>
                                    @endforeach
                                </select>
                                <div class="text-danger">{{ $errors->first('class_id') }}</div>
                            </div>
                        </div>
                        <div class="col-xs-12 col-sm-4 col-md-4">
                            <div class="form-group">
                                <label for="Session">Session :</label>
                                <select name="session_id" id="session_id" class="session_id form-control" >
                                    <option value="">Select Session</option>
                                    @foreach($sessiones as $session)
                                        <option {{ old('session_id') == $session->id ? 'selected' :'' }} value="{{ $session->id }}"> {{ $session->name }}</option>
                                    @endforeach
                                </select>
                                <div class="text-danger">{{ $errors->first('session_id') }}</div>
                            </div>
                        </div>
                        <div class="col-xs-12 col-sm-4 col-md-4">
                            <div class="form-group">
                                <label for="Session">Examination Type :</label>
                                <select name="examination_type_id" id="" class="examination_type_id form-control" >
                                    <option value="">Select Session</option>
                                    @foreach($examTypies as $examType)
                                        <option {{ old('session_id') == $examType->id ? 'selected' :'' }} value="{{ $examType->id }}"> {{ $examType->name }}</option>
                                    @endforeach
                                </select>
                                <div class="text-danger">{{ $errors->first('examination_type_id') }}</div>
                            </div>
                        </div>
                        <div class="col-xs-12 col-sm-4 col-md-4">
                            <div class="form-group">
                                <label for="total_mark ">Total Mark  :</label>
                                <input type="text" class="form-control" name="total_mark" id="total_mark" placeholder="Enter total Mark">
                                <div class="text-danger">{{ $errors->first('total_mark') }}</div>
                            </div>
                        </div>
                        <div class="col-xs-12 col-sm-12 col-md-12">
                            <div class="form-group">
                                <label for="Batch Setting">Description  :</label>
                                <textarea name="description" class="form-control summernote" placeholder="Question Description"></textarea>
                                <div class="text-danger">{{ $errors->first('description') }}</div>
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




      $(document).on('change','#subject_id', function () {

            var subject_id    = $('#subject_id').val();

              $.ajax({
                    type: "get",
                    url: "{{ route('getchapter') }}",
                    data: {subject_id:subject_id},
                    success: function (data) {
                        if(data.status == true)
                        {
                            $("#chapter_id").html(data);
                        }else{
                            $("#chapter_id").html(data);
                        }
                    },
                    error: function (data) {
                        console.log('Error:', data);
                    }
                });
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
