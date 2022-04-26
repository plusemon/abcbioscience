@extends('backend.layouts.app')
@section('title','Add Quiz Question')
@section('content')


    <div id="content" class="content">
        <div class="panel panel-inverse">
            <div class="panel-heading">
                <h4 class="panel-title">Add Quiz Question </h4>
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
                <form action="{{ route('quizquestion.store') }}" method="post" enctype="multipart/form-data">
                    @CSRF
                    
                    <div class="row">
                         <div class="col-xs-12 col-sm-12 col-md-12">
                            <div class="form-group">
                                <label for="class">Quiz :</label>
                                <select name="quiz_id" id="quiz_id" class="class_id form-control" >
                                    <option value="">Select Quiz</option>
                                    @foreach($quizzes as $quiz)
                                        <option {{ old('quiz_id') == $quiz->id ? 'selected' :'' }} value="{{ $quiz->id }}"> {{ $quiz->quiz_name }}</option>
                                    @endforeach
                                </select>
                                <div class="text-danger">{{ $errors->first('quiz_id') }}</div>
                            </div>
                        </div>
                         

                        <div class="col-xs-12 col-sm-12 col-md-12">
                            <div class="form-group">
                                <label for="">Question</label>
                                <input type="text" name="question_name" value="{{ old('question_name') }}" class="form-control" placeholder="Enter Question">
                                 <div class="text-danger">{{ $errors->first('question_name') }}</div>
                            </div>
                        </div>
                    </div>
                      <div class="row">
                          
                        <div class="col-md-12">
                            <p>Options</p>
                        </div>

                        <div class="col-xs-12 col-sm-5 col-md-5">
                            <div class="form-group">
                                 <input type="text" name="option_name[]" value="{{ old('option_name') }}" class="form-control" placeholder="Options 01">
                                 <div class="text-danger">{{ $errors->first('option_name') }}</div>
                            </div>
                        </div>

                        <div class="col-xs-12 col-sm-5 col-md-5">
                            <div class="form-group">
                                 <select name="answer[]" id="" class="form-control" >
                                    <option value="0">Incorrect Answer</option>
                                    <option value="1">correct Answer</option>
                                </select>
                                 <div class="text-danger">{{ $errors->first('answer') }}</div>
                            </div>
                        </div>

                        <div class="col-xs-12 col-sm-5 col-md-5">
                            <div class="form-group">
                                 <input type="text" name="option_name[]" value="{{ old('option_name') }}" class="form-control" placeholder="Options 02">
                                 <div class="text-danger">{{ $errors->first('option_name') }}</div>
                            </div>
                        </div>

                         <div class="col-xs-12 col-sm-5 col-md-5">
                            <div class="form-group">
                                 <select name="answer[]" id="" class="form-control" >
                                    <option value="0">Incorrect Answer</option>
                                    <option value="1">correct Answer</option>
                                </select>
                                 <div class="text-danger">{{ $errors->first('answer') }}</div>
                            </div>
                        </div>

                        <div class="col-xs-12 col-sm-5 col-md-5">
                            <div class="form-group">
                                 <input type="text" name="option_name[]" value="{{ old('option_name') }}" class="form-control" placeholder="Options 03">
                                 <div class="text-danger">{{ $errors->first('option_name') }}</div>
                            </div>
                        </div>

                        <div class="col-xs-12 col-sm-5 col-md-5">
                            <div class="form-group">
                                 <select name="answer[]" id="" class="form-control" >
                                    <option value="0">Incorrect Answer</option>
                                    <option value="1">correct Answer</option>
                                </select>
                                 <div class="text-danger">{{ $errors->first('answer') }}</div>
                            </div>
                        </div>

                        <div class="col-xs-12 col-sm-5 col-md-5">
                            <div class="form-group">
                                 <input type="text" name="option_name[]" value="{{ old('option_name') }}" class="form-control" placeholder="Options 04">
                                 <div class="text-danger">{{ $errors->first('option_name') }}</div>
                            </div>
                        </div>

                         <div class="col-xs-12 col-sm-5 col-md-5">
                            <div class="form-group">
                                 <select name="answer[]" id="" class="form-control" >
                                    <option value="0">Incorrect Answer</option>
                                    <option value="1">correct Answer</option>
                                </select>
                                 <div class="text-danger">{{ $errors->first('answer') }}</div>
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
