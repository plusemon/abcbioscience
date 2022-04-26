@extends('backend.layouts.app')
@section('title','MCQ Exam Setting ')
@section('content')


    <div id="content" class="content">
        <div class="panel panel-inverse">
            <div class="panel-heading">
                <h4 class="panel-title">Written Exam Setting </h4>
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





                <form action="" method="post">
                    @CSRF
                    <div class="row" >

                        <div class="col-xs-12 col-sm-6 col-md-5">
                            <div class="form-group">
                                <label for="Session">Question Name/No :</label>
                                <input type="text" value="{{$writtenSubjectQuestionName}}" disabled class=" form-control"/>
                                <input type="hidden" class="question_subject_id" value="{{$written_question_subject_id}}" name="written_question_subject_id" />
                            </div>
                        </div>
                        <div class="col-xs-12 col-sm-6 col-md-4">
                            <div class="form-group">
                                <label for="Session">Subject :</label>
                                <input type="text" value="{{$writtenSubjectName}}" disabled class=" form-control"/>
                                <input type="hidden" class="subject_id" value="{{$written_subject_id}}" name="written_subject_id" />
                            </div>
                        </div>
                        <div class="col-xs-12 col-sm-6 col-md-3">
                            <div class="form-group">
                                <label for="Session">Examination Type :</label>
                                <input type="text" value="{{$ExamTypeName}}" disabled class=" form-control"/>
                                <input type="hidden" class="examination_type_id" value="{{$examination_type_id}}" name="examination_type_id" />
                            </div>
                        </div>

                        <div class="col-xs-12 col-sm-6 col-md-3">
                            <div class="form-group">
                                <label for="class">Class :</label>
                                <input type="text" value="{{$className}}" disabled class=" form-control"/>
                                <input type="hidden" class="class_id" value="{{$class_id}}" name="class_id" />
                            </div>
                        </div>
                        <div class="col-xs-12 col-sm-6 col-md-3">
                            <div class="form-group">
                                <label for="Session">Session :</label>
                                <input type="text" value="{{$sessionName}}" disabled class=" form-control"/>
                                <input type="hidden" class="session_id" value="{{$session_id}}" name="session_id" />
                            </div>
                        </div>
                        <div class="col-xs-12 col-sm-6 col-md-3">
                            <div class="form-group">
                                <label for="Session">Batch :</label>
                                <input type="text" value="{{$batchSettingName}}" disabled class="form-control"/>
                                <input type="hidden"  class="batch_setting_id" value="{{$batchSettingId}}" name="batch_setting_id" />
                            </div>
                        </div>
                        <div class="col-xs-12 col-sm-6 col-md-3">
                            <div class="form-group">
                                <label for="Session">Batch Type :</label>
                                <input type="text" value="{{$batchTypeName}}" disabled class="form-control"/>
                                <input type="hidden" class="batch_type_id" value="{{$batchTypeId}}" name="batch_type_id" />
                            </div>
                        </div>

                        <input type="hidden"   class="exam_setting_id" name="exam_setting_id" value="{{ $question?$question->id:NULL }}" />
                        <input type="hidden"   class="fee_cat_id" name="fee_cat_id" value="{{ $question?$question->fee_cat_id:NULL }}" />
                        <input type="hidden"   class="fee_amount_setting_id" name="fee_amount_setting_id" value="{{ $question?$question->amounts?$question->amounts->id:NULL:NULL }}" />

                        <div class="col-xs-12 col-sm-6 col-md-3">
                            <div class="form-group">
                                <label for="Session">Exam Date :</label>
                                <input type="text" disabled @if($question) value="{{ date('d-m-Y',strtotime($question->exam_start_date))}}" @endif class="form-control"/>
                                <div class="text-danger">{{ $errors->first('exam_start_date') }}</div>
                            </div>
                        </div>
                        <div class="col-xs-12 col-sm-6 col-md-3">
                            <div class="form-group">
                                <label for="Session">Exam Start Time :</label>
                                <input type="text" disabled @if($question) value="{{ date('h:i:s a',strtotime($question->exam_start_time))}}" @endif class="form-control"/>
                                <div class="text-danger">{{ $errors->first('exam_start_time') }}</div>
                            </div>
                        </div>
                        <div class="col-xs-12 col-sm-6 col-md-3">
                            <div class="form-group">
                                <label for="Session">Exam End Time :</label>
                                <input type="text" disabled @if($question) value="{{ date('h:i:s a',strtotime($question->exam_end_time))}}" @endif class="form-control"/>
                                <div class="text-danger">{{ $errors->first('exam_end_time') }}</div>
                            </div>
                        </div>
                        <div class="col-xs-12 col-sm-6 col-md-3">
                            <div class="form-group">
                                <label for="Session">Fee Category :</label>
                                <input type="text" disabled @if($question) value="{{ $question->feeCategores?$question->feeCategores->name:NULL }}" @endif class="form-control"/>
                                <div class="text-danger">{{ $errors->first('exam_end_time') }}</div>
                            </div>
                        </div>

                        <div class="col-xs-12 col-sm-6 col-md-2">
                            {{--  <input type="submit" value="Submit" class="btn btn-primary" style="margin-top:16%"/>  --}}
                        </div>
                    </div>

                    <hr/>
                    <div class="row" style="margin-top:3%;" id="studentList">
                        <table id="laravel_datatable" class="table table-striped table-bordered table-td-valign-middle">
                            <thead>
                            <tr>
                                <th class="text-nowrap" style="width:8%;">Sl No</th>
                                <th class="text-nowrap" style="width:15%;">Student ID</th>
                                <th class="text-nowrap">Student Name</th>
                                <th class="text-nowrap">Roll</th>
                                <th class="text-nowrap">Status</th>
                                <th class="text-nowrap">Action</th>
                            </tr>
                            </thead>
                                <input type="hidden" class="writtenCreateStudentList"  value="{{route('admin.written.question.student.setting.create.student.list')}}" />
                                <input type="hidden" class="writtenStoreStudent"  value="{{route('admin.written.question.student.setting.store')}}" />
                            <tbody class="showResult">

                            </tbody>
                        </table>
                    </div>


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
            //getBatchSetting();
            //getClassType();
            getAllStudentByBatchAndBatchType();
        });
        function getAllStudentByBatchAndBatchType()
        {
            var question_subject_id = $('.question_subject_id').val();
            var subject_id          = $('.subject_id').val();
            var examination_type_id = $('.examination_type_id').val();
            var class_id            = $('.class_id').val();
            var session_id          = $('.session_id').val();
            var batch_setting_id    = $('.batch_setting_id').val();
            var batch_type_id       = $('.batch_type_id').val();
            var exam_setting_id     = $('.exam_setting_id').val();
            var url                 = $('.writtenCreateStudentList').val();
            $.ajax({
                    type: "get",
                    url: url,
                    data: {class_id:class_id,session_id:session_id,batch_setting_id:batch_setting_id,batch_type_id:batch_type_id},
                    success: function (data) {
                        if(data.status == true)
                        {
                            $(".showResult").html(data.html);
                        }else{
                            $(".showResult").html('');
                        }
                    },
                    error: function (data) {
                        console.log('Error:', data);
                    }
                });
        }


        $(document).on('click','.all_action', function (e) {
            e.preventDefault();
            changeAction($(this).data('id'),$(this).data('action'));
        });
        function changeAction(id,actionType)
        {
            var question_subject_id     = $('.question_subject_id').val();
            var subject_id              = $('.subject_id').val();
            var examination_type_id     = $('.examination_type_id').val();
            var class_id                = $('.class_id').val();
            var session_id              = $('.session_id').val();
            var batch_setting_id        = $('.batch_setting_id').val();
            var batch_type_id           = $('.batch_type_id').val();
            var exam_setting_id         = $('.exam_setting_id').val();
            var fee_cat_id              = $('.fee_cat_id').val();
            var fee_amount_setting_id   = $('.fee_amount_setting_id').val();

            var student_id              = id;
            var action_type             = actionType;
            var url                     = $('.writtenStoreStudent').val();
            $.ajax({
                    type: "post",
                    url: url,
                    data: {class_id:class_id,session_id:session_id,batch_setting_id:batch_setting_id,
                        batch_type_id:batch_type_id,question_subject_id:question_subject_id,subject_id:subject_id,
                        examination_type_id:examination_type_id,exam_setting_id:exam_setting_id,
                        student_id:student_id, action_type:action_type,fee_cat_id:fee_cat_id,fee_amount_setting_id:fee_amount_setting_id
                    },
                    success: function (data) {
                        if(data.status == true)
                        {   
                            if(data.capability == 'active')
                            {
                                toastr.success("{{ Session::get('message','Student  question setting is active successfully') }}");
                            }else{
                                toastr.success("{{ Session::get('message','Student  question setting is inactive successfully') }}");
                            }
                            setTimeout(function(){
                                window.location.reload(1);
                            },500);
                        }else{
                            toastr.error("{{ Session::get('message','Student  question setting is not successfull') }}");
                        }
                        
                    },
                    error: function (data) {
                        console.log('Error:', data);
                    }
                });
        }






        //not use below part
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
