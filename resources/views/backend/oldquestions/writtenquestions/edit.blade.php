@extends('backend.layouts.app')
@section('title','Add New Written Questions')
@section('content')


    <div id="content" class="content">
        <div class="panel panel-inverse">
            <div class="panel-heading">
                <h4 class="panel-title">Add New Written Questions  </h4>
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


                <form action="{{ route('written.question.update',$question->id) }}" method="post" enctype="multipart/form-data">
                    @CSRF

                    
                  

                    <div class="row">
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
                                <label for="Batch Setting">Batch  :</label>
                                <select name="batch_setting_id" id="batch_setting_id" class="batch_setting_id form-control" >

                                     <option  value="">Select Batch</option>
                                </select>
                                <div class="text-danger">{{ $errors->first('batch_setting_id') }}</div>
                            </div>
                        </div>

                        <div class="col-xs-12 col-sm-4 col-md-4">
                            <div class="form-group">

                                Old File <a href="{{ asset($question->attachment) }}" download=""  >Download</a>
                                <br>
                                <br>

                                <label for="Batch Setting">Attachment  :</label>
                                 <input type="file" class="form-control" name="attachment" id="attachment">
                                <div class="text-danger">{{ $errors->first('attachment') }}</div>
                            </div>
                        </div>

                        <div class="col-xs-12 col-sm-4 col-md-4">
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

                        <div class="col-xs-12 col-sm-4 col-md-4">
                            <div class="form-group">
                                <label for="Subject">Question Type :</label>
                                <select name="question_type" id="question_type" class="form-control" >
                                    <option value="">Select Type</option>
                                     <option {{ $question->question_type == "Free" ? 'selected' : '' }} value="Free">Free</option>
                                     <option {{ $question->question_type == "Paid" ? 'selected' : '' }} value="Paid">Paid</option>
                                </select>
                                 <div class="text-danger">{{ $errors->first('question_type') }}</div>
                            </div>
                        </div>




                        <div class="col-xs-12 col-sm-4 col-md-4">
                            <div class="form-group">
                                <label for="Subject">Amount :</label>
                                 <input type="text" name="amount" id="amount" value="{{ $question->amount }}" class="form-control" placeholder="Enter Amount">
                                 <div class="text-danger">{{ $errors->first('question_type') }}</div>
                            </div>
                        </div>


					 

                        <div class="col-xs-12 col-sm-4 col-md-4">
                            <div class="form-group">
                                <label for="Subject">Status :</label>
                                <select name="status" id="status" class="form-control" >
                                    <option value="">Select Type</option>
                                     <option {{ $question->status == 1 ? 'selected' : '' }} value="1">Active</option>
                                     <option {{ $question->status == 2 ? 'selected' : '' }} value="2">Inactive</option>
                                </select>
                                 <div class="text-danger">{{ $errors->first('status') }}</div>
                            </div>
                        </div>



						<div class="col-xs-12 col-sm-12 col-md-12">
                            <div class="form-group">
                                <label for="Batch Setting">Description  :</label>
                                <textarea name="description" class="form-control" placeholder="Question Description">{{  $question->description  }}</textarea>
                                <div class="text-danger">{{ $errors->first('attachment') }}</div>
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
