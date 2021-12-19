@extends('backend.layouts.app')
@section('title','Edit Student Waive')
@section('content')


            <div id="content" class="content">
            <div class="row">
                <div class="col-xl-12">
                    <div class="panel panel-inverse" data-sortable-id="form-stuff-10">
                        <div class="panel-heading">
                            <h4 class="panel-title">Edit Student Waiver</h4>
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
                            <form action="{{ route('admin.student-waiver.update',$studentWaiver->id) }}" method="POST" >
                                @csrf
                                @method('PUT')
                                <div class="row">
                                    <div class="col-md-6">

                                    <div class="row">

                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label >Student Name</label>
                                                <select name="student_id" id="" class="student_id form-control" required>
                                                    <option value="">Select Student</option>
                                                    @foreach($students as $student)
                                                    <option {{ $get_student_id ==  $student->id ? 'selected' : ''  }} {{ $studentWaiver->student_id == $student->id ? 'selected' : '' }} value="{{ $student->id }}">
                                                        {{ $student->user?$student->user->name:NULL }}
                                                         ({{ $student->user?$student->user->mobile:NULL }})
                                                    </option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label >Batch Name</label>
                                                <input type="text" disabled class="batch_setting_id form-control" />
                                            </div>
                                        </div>
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label for="" >Class</label>
                                                <input type="text" disabled class="class_id form-control" />
                                            </div>
                                        </div>
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label >Session</label>
                                                <input type="text" disabled class="session_id form-control" />
                                            </div>
                                        </div>
                                       
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label >Class Type </label>
                                                <input type="text" disabled class="class_type_id form-control" />
                                            </div>
                                        </div>

                                    </div><!---- child row in a row end--->

                                    </div><!---- col-md-6 end--->

                                    <div class="col-md-6">
                                    <div class="row">

                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label >Fee Category </label>
                                                <select name="fee_cat_id" id="" class="fee_cat_id form-control" required>
                                                    <option value="">Select Fee Category</option>
                                                    @foreach($fee_categories as $feeCat)
                                                    <option {{ $studentWaiver->fee_cat_id == $feeCat->id ? 'selected' : '' }} value="{{ $feeCat->id }}">
                                                        {{ $feeCat->name }}
                                                    </option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>

                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label >Waiver </label>
                                                <select name="waiver_id" id="" class="waiver_id form-control" required>
                                                    <option value="">Select Waiver</option>
                                                    @foreach($waivers as $waiver)
                                                    <option {{ $studentWaiver->waiver_id == $waiver->id ? 'selected' : '' }} value="{{ $waiver->id }}">
                                                        {{ $waiver->name }}
                                                    </option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>

                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label >Start Month (<small>Current Year - {{date('Y')}}</small>) </label>
                                                <select name="start_month_id" id="" class="start_month_id form-control" required>
                                                    <option value="">Select Start Month</option>
                                                    @foreach($months as $month)
                                                    <option {{ $studentWaiver->start_month_id == $month->id ? 'selected' : '' }} value="{{ $month->id }}">
                                                        {{ $month->name }}
                                                    </option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label >End Month (<small>Current Year - {{date('Y')}}</small>)</label>
                                                <select name="end_month_id" id="" class="end_month_id form-control" required>
                                                    <option value="">Select End Month</option>
                                                    @foreach($months as $month)
                                                    <option {{ $studentWaiver->end_month_id == $month->id ? 'selected' : '' }} value="{{ $month->id }}">
                                                        {{ $month->name }} 
                                                    </option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>

                                        

                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label >Status</label>
                                                <select name="status" id="" class="form-control" required>
                                                    <option value="">Select Status</option>
                                                    <option {{ $studentWaiver->activate_status == 1 ? 'selected' : '' }} value="1">Active</option>
                                                    <option {{ $studentWaiver->activate_status == 2 ? 'selected' : '' }} value="2">Deactive</option>
                                                </select>
                                            </div>
                                        </div>
                                       
                                        <div class="hidden_div"></div>
                                        <input type="hidden"  value="{{$get_student_id}}" />
                                        <input type="hidden" name="user_id" value="{{$student_user_id}}" class="user_id" />

                                    </div><!---- child row in a row end--->
                                    </div><!---- col-md-6 end--->

                                </div>
                                <!----div row end--->



                                    <input type="submit" value="Update" class="submitButton btn btn-md btn-primary  pull-right" disabled style="margin-left:1%;">
                                    <a  class="btn btn-md btn-danger pull-right" href="{{ route('admin.student-waiver.index') }}">Cancel</a>

                            </form>
                        </div>

                    </div>
                </div>

            </div>
        </div>













@section('customjs')

    <script>
            $.ajaxSetup({
              headers: {
                  'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
              }
          });



        $(document).ready(function(){
            $('.submitButton').attr('disabled','disabled');
            getStudentCurrentData();
        });
        $(document).on('change','.student_id',function(){
            $('.submitButton').attr('disabled','disabled');
            getStudentCurrentData();
        });

        function getStudentCurrentData()
        {   
            var student_id  = $('.student_id option:selected').val();
            $.ajax({
                    type: "get",
                    url: "{{ route('admin.getWaiverStudentDataByStudentId') }}",
                    data: {student_id:student_id},
                    success: function (data) {
                        if(data.status == true)
                        {
                            $('.class_id').val(data.class);
                            $('.session_id').val(data.session);
                            $('.batch_setting_id').val(data.batch_setting);
                            $('.class_type_id').val(data.Class_type);
                            $('.user_id').val(data.user_id);
                            $(".hidden_div").html(data.hidden);
                            $('.submitButton').removeAttr('disabled','disabled');
                        }else{
                            $('.class_id').val('');
                            $('.session_id').val('');
                            $('.batch_setting_id').val('');
                            $('.class_type_id').val('');
                            $('.user_id').val('');
                            $(".hidden_div").html('');
                            $('.submitButton').attr('disabled','disabled');
                        }
                    },
                    error: function (data) {

                    }
                });
        }

        function nanCheck(val)
        {
            var total = val;
            if(isNaN(val)) {
                var total = 0;
            }
            return total;
        }

    </script>


@endsection
@endsection
