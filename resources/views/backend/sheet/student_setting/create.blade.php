@extends('backend.layouts.app')
@section('title','Sheet Student Setting Create')
@section('content')


    <div id="content" class="content">
        <div class="panel panel-inverse">
            <div class="panel-heading">
                <h4 class="panel-title">Sheet Student Setting Create</h4>
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





                <form action="{{ route('admin.sheet.student.setting.bulk.store') }}" method="post">
                    @CSRF
                    <div class="row" >

                        <div class="col-xs-12 col-sm-6 col-md-5">
                            <div class="form-group">
                                <label for="Session">Sheet Name/No :</label>
                                <input type="text" value="{{$sheetName}}" disabled class="form-control"/>
                                <input type="hidden" class="sheet_id" value="{{$sheet_id}}" name="sheet_id" />
                            </div>
                        </div>
                        <div class="col-xs-12 col-sm-6 col-md-4">
                            <div class="form-group">
                                <label for="Session">Subject :</label>
                                <input type="text" value="{{$subjectName}}" disabled class=" form-control"/>
                                <input type="hidden" class="subject_id" value="{{$subject_id}}" name="subject_id" />
                            </div>
                        </div>
                        <div class="col-xs-12 col-sm-6 col-md-3">
                            <div class="form-group">
                                <label for="Session">Sheet Type :</label>
                                <input type="text" value="{{$sheetTypeName}}" disabled class="form-control"/>
                                <input type="hidden" class="sheet_type_id" value="{{$sheet_type_id}}" name="sheet_type_id" />
                            </div>
                        </div>

                        <div class="col-xs-12 col-sm-6 col-md-4">
                            <div class="form-group">
                                <label for="class">Class :</label>
                                <input type="text" value="{{$className}}" disabled class=" form-control"/>
                                <input type="hidden" class="class_id" value="{{$class_id}}" name="class_id" />
                            </div>
                        </div>
                        <div class="col-xs-12 col-sm-6 col-md-4">
                            <div class="form-group">
                                <label for="Session">Session :</label>
                                <input type="text" value="{{$sessionName}}" disabled class=" form-control"/>
                                <input type="hidden" class="session_id" value="{{$session_id}}" name="session_id" />
                            </div>
                        </div>
                        <div class="col-xs-12 col-sm-6 col-md-4">
                            <div class="form-group">
                                <label for="Session">Batch :</label>
                                <input type="text" value="{{$batchSettingName}}" disabled class="form-control"/>
                                <input type="hidden"  class="batch_setting_id" value="{{$batchSettingId}}" name="batch_setting_id" />
                            </div>
                        </div>
                        <div class="col-xs-12 col-sm-6 col-md-4">
                            <div class="form-group">
                                <label for="Session">Batch Type :</label>
                                <input type="text" value="{{$batchTypeName}}" disabled class="form-control"/>
                                <input type="hidden" class="batch_type_id" value="{{$batchTypeId}}" name="batch_type_id" />
                            </div>
                        </div>

                        <input type="hidden"   class="sheet_setting_id" name="sheet_setting_id" value="{{ $sheet_stting?$sheet_stting->id:NULL }}" />
                        <input type="hidden"   class="fee_cat_id" name="fee_cat_id" value="{{ $sheet_stting?$sheet_stting->fee_cat_id:NULL }}" />
                        <input type="hidden"   class="fee_amount_setting_id" name="fee_amount_setting_id" value="{{ $sheet_stting?$sheet_stting->amounts?$sheet_stting->amounts->id:NULL:NULL }}" />

                        <div class="col-xs-12 col-sm-6 col-md-4">
                            <div class="form-group">
                                <label for="Session">Publish Date :</label>
                                <input type="text" disabled @if($sheet_stting) value="{{ date('d-m-Y',strtotime($sheet_stting->publish_date))}}" @endif class="form-control"/>
                                <div class="text-danger">{{ $errors->first('publish_date') }}</div>
                            </div>
                        </div>
                        <div class="col-xs-12 col-sm-6 col-md-4">
                            <div class="form-group">
                                <label for="Session">Fee Category :</label>
                                <input type="text" disabled @if($sheet_stting) value="{{ $sheet_stting->feeCategores?$sheet_stting->feeCategores->name:NULL }}" @endif class="form-control"/>
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
                                <th><p><span><input type="checkbox" name="" id="checkedAll"></span> Check all</p></th>
                                <th class="text-nowrap" style="width:8%;">Sl No</th>
                                <th class="text-nowrap" style="width:15%;">Student ID</th>
                                <th class="text-nowrap">Student Name</th>
                                <th class="text-nowrap">Roll</th>
                                <th class="text-nowrap">Status</th>
                                <th class="text-nowrap">Action</th>
                            </tr>
                            </thead>
                                <input type="hidden" class="sheetStudentSettingCreateStudentList"  value="{{route('admin.sheetStudentSettingCreateStudentList')}}" />
                                <input type="hidden" class="sheetStudentSettingStore"  value="{{route('admin.sheet.student.setting.store')}}" />
                            <tbody class="showResult">

                            </tbody>
                        </table>

                        <button type="submit" name="active" class="btn btn-primary btn-sm mr-3">Active</button>
                        <button type="submit" name="inactive" class="btn btn-warning btn-sm">Inactive</button>
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
        });


        $(document).ready(function(){
            //getBatchSetting();
            //getClassType();
            getAllStudentByBatchAndBatchType();
        });
        function getAllStudentByBatchAndBatchType()
        {
            var sheet_id            = $('.sheet_id').val();
            var subject_id          = $('.subject_id').val();
            var sheet_type_id       = $('.sheet_type_id').val();
            var class_id            = $('.class_id').val();
            var session_id          = $('.session_id').val();
            var batch_setting_id    = $('.batch_setting_id').val();
            var batch_type_id       = $('.batch_type_id').val();
            var sheet_setting_id    = $('.sheet_setting_id').val();
            var url                 = $('.sheetStudentSettingCreateStudentList').val();
            $.ajax({
                    type: "get",
                    url: url,
                    data: {sheet_type_id:sheet_type_id,sheet_id:sheet_id,class_id:class_id,session_id:session_id,batch_setting_id:batch_setting_id,batch_type_id:batch_type_id},
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
            var sheet_id                = $('.sheet_id').val();
            var subject_id              = $('.subject_id').val();
            var sheet_type_id           = $('.sheet_type_id').val();
            var class_id                = $('.class_id').val();
            var session_id              = $('.session_id').val();
            var batch_setting_id        = $('.batch_setting_id').val();
            var batch_type_id           = $('.batch_type_id').val();
            var sheet_setting_id         = $('.sheet_setting_id').val();
            var fee_cat_id              = $('.fee_cat_id').val();
            var fee_amount_setting_id   = $('.fee_amount_setting_id').val();

            var student_id              = id;
            var action_type             = actionType;
            var url                     = $('.sheetStudentSettingStore').val();
            $.ajax({
                    type: "post",
                    url: url,
                    data: {class_id:class_id,session_id:session_id,batch_setting_id:batch_setting_id,
                        batch_type_id:batch_type_id,sheet_id:sheet_id,subject_id:subject_id,
                        sheet_type_id:sheet_type_id,sheet_setting_id:sheet_setting_id,
                        student_id:student_id, action_type:action_type,fee_cat_id:fee_cat_id,fee_amount_setting_id:fee_amount_setting_id
                    },
                    success: function (data) {
                        if(data.status == true)
                        {
                            if(data.capability == 'active')
                            {
                                toastr.success("{{ Session::get('message','Student  sheet setting is active successfully') }}");
                            }else{
                                toastr.success("{{ Session::get('message','Student  sheet setting is inactive successfully') }}");
                            }
                            setTimeout(function(){
                                window.location.reload(1);
                            },500);
                        }else{
                            toastr.error("{{ Session::get('message','Student  sheet setting is not successfull') }}");
                        }

                    },
                    error: function (data) {
                        console.log('Error:', data);
                    }
                });
        }






            //not use below part yet now
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
            //not use below part yet now
        
    </script>

     <script>
        
             $(document).ready(function() {
                 $("#checkedAll").change(function() {
                    if (this.checked) {
                        $(".checkSingle").each(function() {
                            this.checked=true;
                        });
                    } else {
                        $(".checkSingle").each(function() {
                            this.checked=false;
                        });
                    }
                });

                $(".checkSingle").click(function () {
                    if ($(this).is(":checked")) {
                        var isAllChecked = 0;

                        $(".checkSingle").each(function() {
                            if (!this.checked)
                                isAllChecked = 1;
                        });

                        if (isAllChecked == 0) {
                            $("#checkedAll").prop("checked", true);
                        }     
                    }
                    else {
                        $("#checkedAll").prop("checked", false);
                    }
                });
            });


    </script>

@endsection
@endsection
