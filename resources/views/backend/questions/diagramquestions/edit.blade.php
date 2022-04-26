@extends('backend.layouts.app')
@section('title','Edit Diagram Questions')
@section('content')


    <div id="content" class="content">
        <div class="panel panel-inverse">
            <div class="panel-heading">
                <h4 class="panel-title">Edit Diagram Questions  </h4>
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


                <form action="{{ route('admin.diagramquestion.update',$question->id) }}" method="post" enctype="multipart/form-data">
                    @CSRF
                    @method('PUT')
                     <div class="row">
                        <div class="col-xs-12 col-sm-6 col-md-6">
                            <div class="form-group">
                                <label for="class">Question No/Name :</label>
                                <input type="text" value="{{$question->question_no}}" name="question_no" placeholder="Question no/name" class="form-control" >
                                <div class="text-danger">{{ $errors->first('question_no') }}</div>
                            </div>
                        </div>
                        <div class="col-xs-12 col-sm-6 col-md-6">
                            <div class="form-group">
                                <label for="Subject">Subject :</label>
                                <select name="subject_id" id="subject_id" class="form-control" >
                                    <option value="">Select Subject</option>
                                    @foreach($subjectes as $subject)
                                        <option {{ $question->subject_id == $subject->id ? 'selected' :'' }} value="{{ $subject->id }}"> {{ $subject->name }}</option>
                                    @endforeach
                                </select>
                                 <div class="text-danger">{{ $errors->first('session_id') }}</div>
                            </div>
                        </div>


                        <div class="col-xs-12 col-sm-6 col-md-6">
                            <div class="form-group">
                                <label for="Subject">Chapter : ( {{   $question->chapter?$question->chapter->name:'' }})</label>
                                <select name="chapter_id" id="chapter_id" class="form-control" required>
                                    <option value="">Select Chapter</option>

                                </select>
                                 <div class="text-danger">{{ $errors->first('chapter_id') }}</div>
                            </div>
                        </div>

                        <div class="col-xs-12 col-sm-6 col-md-6">
                            <div class="form-group">
                                <label for="class">Chapter Topic:</label>
                                <input type="text" name="topic" value="{{ $question->topic }}" placeholder="Chapter topic" class="form-control" >
                                <div class="text-danger">{{ $errors->first('topic') }}</div>
                            </div>
                        </div>


                        <div class="col-xs-12 col-sm-4 col-md-4">
                            <div class="form-group">
                                <label for="class">Class :</label>
                                <select name="class_id" id="class_id" class="class_id form-control" >
                                    <option value="">Select Class</option>
                                    @foreach($classes as $class)
                                        <option {{ $question->class_id == $class->id ? 'selected' :'' }} value="{{ $class->id }}"> {{ $class->name }}</option>
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
                                        <option {{ $question->session_id == $session->id ? 'selected' :'' }} value="{{ $session->id }}"> {{ $session->name }}</option>
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
                                        <option {{ $question->examination_type_id == $examType->id ? 'selected' :'' }} value="{{ $examType->id }}"> {{ $examType->name }}</option>
                                    @endforeach
                                </select>
                                <div class="text-danger">{{ $errors->first('examination_type_id') }}</div>
                            </div>
                        </div>


                        <div class="col-xs-12 col-sm-4 col-md-4">
                            <div class="form-group">
                                <label for="total_mark ">Total Mark  :</label>
                                <input type="text" class="form-control"  value="{{ $question->total_mark }}" name="total_mark" id="total_mark">
                                <div class="text-danger">{{ $errors->first('total_mark') }}</div>
                            </div>
                        </div>





                        <div class="col-xs-12 col-sm-3 col-md-3">
                            <div class="form-group">
                                <label for="Batch Setting">Attachment  :</label>
                                <input type="file" class="form-control" name="attachment" id="attachment">
                                <div class="text-danger">{{ $errors->first('attachment') }}</div>
                            </div>
                        </div>

                        <div class="col-xs-12 col-sm-2 col-md-2">
                            <div class="form-group">
                                <label for="Batch Setting">Old File</label> <br/>
                                <a href="{{ asset($question->attachment) }}" download=""  >Download</a>
                            </div>
                        </div>

                        <div class="col-xs-12 col-sm-12 col-md-12">
                            <div class="form-group">
                                <label for="Batch Setting">Description  :</label>
                                <textarea name="description" class="form-control summernote" placeholder="Question Description">{{$question->description}}</textarea>
                                <div class="text-danger">{{ $errors->first('description') }}</div>
                            </div>
                        </div>
                    </div>

                    <button type="submit" class="btn btn-primary mt-3">Update</button>
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
            getchapter();
        });

         $(document).on('change','.class_id ,.session_id', function () {
              getBatchSetting();
        });




         function getchapter()
        {
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
        };










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
