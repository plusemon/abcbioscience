@extends('backend.layouts.app')
@section('title','Promotion Class')
@section('content')


    <div id="content" class="content">
        <div class="panel panel-inverse">
            <div class="panel-heading">
                <h4 class="panel-title">Promotion Class  </h4>
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



                    <div class="row"  style="@if($currentStudent) display:visible; @else display:none; @endif">
                        <div class="col-xs-12 col-sm-6 col-md-4">
                            <div class="form-group">
                                <label for="">Name</label>
                                <input type="text" value="{{ $currentStudent?$currentStudent->name:NULL }}" disabled class="form-control">
                            </div>
                        </div>
                        <div class="col-xs-12 col-sm-6 col-md-4">
                            <div class="form-group">
                                <label for="">Email Address</label>
                                <input type="text"  value="{{ $currentStudent?$currentStudent->email:NULL }}" disabled class="form-control" >
                            </div>
                        </div>
                        <div class="col-xs-12 col-sm-6 col-md-4">
                            <div class="form-group">
                                <label for="">Mobile No</label>
                                <input type="text"  value="{{ $currentStudent?$currentStudent->mobile:NULL }}" disabled class="form-control" >
                            </div>
                        </div>
                    </div>
                    <hr  style="@if($currentStudent) display:visible; @else display:none; @endif"/>




                <form action="" method="GET">
                    <div class="row">

                        <div class="col-xs-12 col-sm-6 col-md-4">
                            <div class="form-group">
                                <label for="">Student</label>
                                <select name="student_id" id="student_id" class="form-control" >
                                    <option value="">Select Student</option>
                                    @foreach($allstudents as $student)
                                    <option @if(isset($_GET['student_id'])) {{ $_GET["student_id"] == $student->id ?'selected':""}}@endif value="{{ $student->id }}">{{ $student->name }}</option>
                                    @endforeach
                                </select>
                                <div class="text-danger">{{ $errors->first('student_id') }}</div>
                            </div>
                        </div>
                        <div class="col-xs-12 col-sm-6 col-md-4">
                            <div class="form-group">
                                <label for="class">Class :</label>
                                <select name="current_class_id"  class="current_class_id form-control" >
                                    <option value="">Select Class</option>
                                    @foreach($classes as $class)
                                        <option {{ $current_class_id == $class->id ? 'selected' :'' }} value="{{ $class->id }}"> {{ $class->name }}</option>
                                    @endforeach
                                </select>
                                <div class="text-danger">{{ $errors->first('current_class_id') }}</div>
                            </div>
                        </div>
                        <div class="col-xs-12 col-sm-6 col-md-4">
                            <div class="form-group">
                                <label for="Session">Session :</label>
                                <select name="current_session_id"  class="current_session_id form-control" >
                                    <option value="">Select Session</option>
                                    @foreach($sessiones as $session)
                                        <option {{ $current_session_id == $session->id ? 'selected' :'' }}  value="{{ $session->id }}"> {{ $session->name }}</option>
                                    @endforeach
                                </select>
                                <div class="text-danger">{{ $errors->first('current_session_id') }}</div>
                            </div>
                        </div>


                        <div class="col-xs-12 col-sm-6 col-md-4">
                            <div class="form-group">
                                <label for="">Batch  :</label>
                                <select name="current_batch_setting_id"  class="current_batch_setting_id form-control" >
                                    <option  value="">Select Batch</option>
                                </select>
                                <div class="text-danger">{{ $errors->first('current_batch_setting_id') }}</div>
                                <input type="hidden" value="{{$current_batch_setting_id}}" class="currentBatchSettingId" />
                            </div>
                        </div>
                        <div class="col-xs-12 col-sm-6 col-md-4">
                            <div class="form-group">
                                <label for="">Section  :</label>
                                <select name="current_section_id" id="current_section_id" class="form-control">
                                    <option value="">Select Section</option>
                                    @foreach($sectiones as $section)
                                    <option   {{ $current_section_id == $section->id ? 'selected' :'' }}  value="{{ $section->id }}">{{ $section->name }}</option>
                                    @endforeach
                                </select>
                                <div class="text-danger">{{ $errors->first('current_section_id') }}</div>
                            </div>
                        </div>
                        <div class="col-xs-12 col-sm-6 col-md-1">
                                <input type="submit" value="Search" class="btn btn-primary" style="margin-top: 25px;" />
                        </div>
                        <div class="col-xs-12 col-sm-6 col-md-1">
                                <a href="{{ route('admin.promotion-class.create') }}"class="btn btn-info" style="margin-top: 25px;" > Back</a>
                        </div>
                    </div>
                </form>
                <hr  style="@if($currentStudent) display:visible; @else display:none; @endif"/>
                <br/><br/>




                <form action="{{ route('admin.new-batch.store') }}" method="post">
                    @CSRF
                    <div class="row" style="@if($currentStudent) display:visible; @else display:none; @endif background-color:#e9ecef;opacity: 1;padding-top:10px;">
                        <div class="col-xs-12 col-sm-3 col-md-3">
                            <div class="form-group">
                                <label for="class">Class :</label>
                                <select name="class_id"  class="class_id form-control" required>
                                    <option value="">Select Class</option>
                                    @foreach($newClasses as $class)
                                        <option {{ old('class_id') == $class->id ? 'selected' :'' }} value="{{ $class->id }}"> {{ $class->name }}</option>
                                    @endforeach
                                </select>
                                <div class="text-danger">{{ $errors->first('class_id') }}</div>
                            </div>
                        </div>
                        <div class="col-xs-12 col-sm-3 col-md-3">
                            <div class="form-group">
                                <label for="Session">Session :</label>
                                <select name="session_id" i class="session_id form-control" required>
                                    <option value="">Select Session</option>
                                    @foreach($newSessiones as $session)
                                        <option {{ old('session_id') == $session->id ? 'selected' :'' }} value="{{ $session->id }}"> {{ $session->name }}</option>
                                    @endforeach
                                </select>
                                <div class="text-danger">{{ $errors->first('session_id') }}</div>
                            </div>
                        </div>
                        <div class="col-xs-12 col-sm-3 col-md-3">
                            <div class="form-group">
                                <label for="">Batch  :</label>
                                <select name="batch_setting_id"  class="batch_setting_id form-control" required>
                                    <option  value="1">Select Batch</option>
                                </select>
                                <div class="text-danger">{{ $errors->first('batch_setting_id') }}</div>
                            </div>
                        </div>
                        <div class="col-xs-12 col-sm-3 col-md-3">
                            <div class="form-group">
                                <label for="">Section  :</label>
                                <select name="section_id" id="section_id" class="form-control" required>
                                    <option value="">Select Section</option>
                                    @foreach($sectiones as $section)
                                    <option {{ old('section_id') == $section->id ? 'selected' :'' }} value="{{ $section->id }}">{{ $section->name }}</option>
                                    @endforeach
                                </select>
                                <div class="text-danger">{{ $errors->first('section_id') }}</div>
                            </div>
                        </div>
                        <div class="col-xs-12 col-sm-6 col-md-3">
                            <div class="form-group">
                                <label for="">Roll</label>
                                <input type="text" name="roll" value="{{ old('roll') }}" class="form-control" placeholder="Roll" required>
                                <div class="text-danger">{{ $errors->first('roll') }}</div>
                            </div>
                        </div>
                        <div class="col-xs-12 col-sm-6 col-md-3">
                            <div class="form-group">
                                <label for="">Admission Date</label>
                                <input type="date" name="admission_date" value="{{ old('admission_date') }}" class="form-control" placeholder="Admission Date">
                                <div class="text-danger">{{ $errors->first('admission_date') }}</div>
                            </div>
                        </div>
                        <div class="col-xs-12 col-sm-6 col-md-3">
                            <div class="form-group">
                                <label for="">Month</label>
                                <select name="month_id" id="month_id" class="form-control" required>
                                    <option value="">Select Month</option>
                                    @foreach($months as $month)
                                    <option value="{{ $month->id }}">{{ $month->name }}</option>
                                    @endforeach
                                </select>
                                <div class="text-danger">{{ $errors->first('month_id') }}</div>
                            </div>
                        </div>
                        <div class="col-xs-12 col-sm-6 col-md-3">
                            <div class="form-group">
                                <label for="">Student Type</label>
                                <select name="student_type_id"  class="student_type_id form-control" >
                                    <option value="">Select Student Type</option>
                                    {{--  @foreach($student_typies as $student_type)
                                    <option value="{{ $student_type->id }}">{{ $student_type->name }}</option>
                                    @endforeach --}}
                                </select>
                                <div class="text-danger">{{ $errors->first('student_type_id') }}</div>
                            </div>
                        </div>
                        <div class="col-xs-12 col-sm-6 col-md-6">
                            <div class="form-group">
                                <label for="">School</label>
                                <input type="text" name="school_name" value="{{ $currentStudent?$currentStudent->students?$currentStudent->students->school_name:NULL:NULL }}" class="form-control" placeholder="Enter Student School Name">
                                <div class="text-danger">{{ $errors->first('school_name') }}</div>
                            </div>
                        </div>
                        <div class="col-xs-12 col-sm-6 col-md-4">
                            <div class="form-group">
                                <label for="status">Status</label>
                                <select name="activate_status" id="status" class="form-control" required>
                                    <option {{ old('status') == 1 ? 'selected' : '' }} value="1">Active</option>
                                    <option {{ old('status') == 2 ? 'selected' : ''  }} value="2">inactive</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-xs-12 col-sm-6 col-md-2">
                            <input type="submit" value="Submit" class="btn btn-primary" style="margin-top: 25px;" />
                        </div>
                        <input name="previous_admitted" type="hidden" value="@if($currentStudent){{ $currentStudent->students?$currentStudent->students->classes?$currentStudent->students->classes->name :NULL:NULL }} @endif" />
                        <input name="previous_student_id" type="hidden" value="@if($currentStudent){{ $currentStudent->students?$currentStudent->students->id:NULL }} @endif" />
                        <input name="student_user_id" type="hidden" value="{{$user_id}}" />
                    </div>

                </form>





                <br/><br/><br/>
                <hr  style="@if($currentStudent) display:visible; @else display:none; @endif" />
                <br/<br/>



                @if($currentStudent)
                <div class="row" style="@if($currentStudent) display:visible; @else display:none; @endif">
                    <div class="col-xs-12 col-sm-6 col-md-4">
                        <div class="form-group">
                            <label for="school">Father Name :</label>
                            <input disabled  type="text" value="{{ $currentStudent->studentInfo?$currentStudent->studentinfo->father:NULL }}" class="form-control">
                        </div>
                    </div>
                    <div class="col-xs-12 col-sm-6 col-md-4">
                        <div class="form-group">
                            <label for="school">Mother Name :</label>
                            <input  disabled type="text" value="{{ $currentStudent->studentinfo?$currentStudent->studentinfo->mother:NULL }}" class="form-control">
                        </div>
                    </div>

                    <div class="col-xs-12 col-sm-6 col-md-4">
                        <div class="form-group">
                            <label for="school">Guardian Mobile  :</label>
                            <input  disabled type="text" value="{{ $currentStudent->studentinfo?$currentStudent->studentinfo->guardian_mobile:NULL }}" class="form-control">
                        </div>
                    </div>
                </div>
                @endif
                <hr  style="@if($currentStudent) display:visible; @else display:none; @endif" />
                <br/>

                @if($currentStudent)
                <div class="row" style="@if($currentStudent) display:visible; @else display:none; @endif">
                    <div class="col-xs-12 col-sm-3 col-md-3">
                        <div class="form-group">
                            <label for="class">Class :</label>
                            <input  disabled type="text" value="{{ $currentStudent->students?$currentStudent->students->classes?$currentStudent->students->classes->name :NULL:NULL }}" class="form-control">
                        </div>
                    </div>
                    <div class="col-xs-12 col-sm-3 col-md-3">
                        <div class="form-group">
                            <label for="Session">Session :</label>
                            <input  disabled type="text" value="{{ $currentStudent->students?$currentStudent->students->sessiones?$currentStudent->students->sessiones->name :NULL:NULL  }}" class="form-control">
                        </div>
                    </div>
                    <div class="col-xs-12 col-sm-3 col-md-3">
                        <div class="form-group">
                            <label for="">Batch  :</label>
                            <input  disabled type="text" value="{{ $currentStudent->students?$currentStudent->students->batch?$currentStudent->students->batch->name :NULL:NULL  }}" class="form-control">
                        </div>
                    </div>
                    <div class="col-xs-12 col-sm-3 col-md-3">
                        <div class="form-group">
                            <label for="">Section  :</label>
                            <input  disabled type="text" value="{{ $currentStudent->students?$currentStudent->students->sections?$currentStudent->students->sections->name :NULL:NULL  }}" class="form-control">
                        </div>
                    </div>
                    <div class="col-xs-12 col-sm-6 col-md-3">
                        <div class="form-group">
                            <label for="">Roll</label>
                            <input disabled  type="text" value="{{ $currentStudent->students?$currentStudent->students->roll:NULL }}" class="form-control">
                        </div>
                    </div>
                    <div class="col-xs-12 col-sm-6 col-md-3">
                        <div class="form-group">
                            <label for="">Admission Date</label>
                            <input disabled  type="text" value="{{ $currentStudent->students ? $currentStudent->students->admission_date : NULL }}" class="form-control">
                        </div>
                    </div>
                    <div class="col-xs-12 col-sm-6 col-md-6">
                        <div class="form-group">
                            <label for="">School/College</label>
                            <input disabled  type="text" value="{{ $currentStudent?$currentStudent->students?$currentStudent->students->school_name:NULL:NULL }}" class="form-control">
                        </div>
                    </div>
                </div>
            </div>
            @endif








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

             getCurrentBatchSetting();
        });

        $(document).on('change','.class_id ,.session_id', function () {
              getBatchSetting();
        });

        function getBatchSetting()
        {
            var class_id                = $('.class_id').val();
            var session_id              = $('.session_id').val();
            var batchSettingId          = $('.currentBatchSettingId').val();
                if(class_id && session_id)
                {
                    $.ajax({
                        type: "get",
                        url: "{{ route('admin.get_batch_setting') }}",
                        data: {class_id:class_id,session_id:session_id,batchSettingId:batchSettingId},
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



        //current part
            $(document).on('change','.current_class_id ,.current_session_id', function () {
                getCurrentBatchSetting();
            });
            function getCurrentBatchSetting()
            {
                var class_id    = $('.current_class_id').val();
                var session_id  = $('.current_session_id').val();
                if(class_id && session_id)
                {
                    $.ajax({
                        type: "get",
                        url: "{{ route('get.batch.setting') }}",
                        data: {class_id:class_id,session_id:session_id},
                        success: function (data) {
                            if(data.status == true)
                            {
                                $(".current_batch_setting_id").html(data.batch_setting);
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
