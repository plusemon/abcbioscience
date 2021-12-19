@extends('backend.layouts.app')
@section('title','Fee Setting')
@section('content')


    <div id="content" class="content">
        <div class="panel panel-inverse">
            <div class="panel-heading">
                <h4 class="panel-title">Fee Setting  </h4>
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



                    

                <form action="{{ route('admin.fee-setting.update',$feeSetting->id) }}" method="post">
                    @CSRF
                    @method('PUT')
                    <div class="row" >
                        <div class="col-xs-12 col-sm-6 col-md-4">
                            <div class="form-group">
                                <label for="class">Fee Category :</label>
                                <select name="fee_cat_id"  class="form-control" required>
                                    <option value="">Select Fee Category</option>
                                    @foreach($fee_categories as $feeCat)
                                        <option {{ $feeSetting->fee_cat_id == $feeCat->id ? 'selected' :'' }} value="{{ $feeCat->id }}"> {{ $feeCat->name }}</option>
                                    @endforeach
                                </select>
                                <div class="text-danger">{{ $errors->first('fee_cat_id') }}</div>
                            </div>
                        </div>
                        <div class="col-xs-12 col-sm-6 col-md-4">
                            <div class="form-group">
                                <label for="class">Class :</label>
                                <select name="class_id"  class="class_id form-control" required>
                                    <option value="">Select Class</option>
                                    @foreach($classes as $class)
                                        <option {{ $feeSetting->class_id == $class->id ? 'selected' :'' }} value="{{ $class->id }}"> {{ $class->name }}</option>
                                    @endforeach
                                </select>
                                <div class="text-danger">{{ $errors->first('class_id') }}</div>
                            </div>
                        </div>
                        <div class="col-xs-12 col-sm-6 col-md-4">
                            <div class="form-group">
                                <label for="Session">Session :</label>
                                <select name="session_id" id="" class="session_id form-control" required>
                                    <option value="">Select Session</option>
                                    @foreach($sessiones as $session)
                                        <option {{ $feeSetting->session_id == $session->id ? 'selected' :'' }} value="{{ $session->id }}"> {{ $session->name }}</option>
                                    @endforeach
                                </select>
                                 <div class="text-danger">{{ $errors->first('session_id') }}</div>
                            </div>
                        </div>
                        <div class="col-xs-12 col-sm-6 col-md-4">
                            <div class="form-group">
                                <label for="Batch Setting">Batch  :</label>
                                <select name="batch_setting_id" id="" class="batch_setting_id form-control" required>
                                     <option  value="1">Select Batch</option>
                                     @foreach ($batch_settings as $item)
                                     <option {{ $feeSetting->batch_setting_id == $item->id ? 'selected' :'' }}  value="{{$item->id}}">{{$item->batch_name}}</option>
                                     @endforeach
                                </select>
                                <div class="text-danger">{{ $errors->first('batch_setting_id') }}</div>
                            </div>
                        </div>

                        <div class="col-xs-12 col-sm-6 col-md-4">
                            <div class="form-group">
                                <label for="">Student Type</label>
                                 <select name="student_type_id"  class="student_type_id form-control" >
                                     <option value="">Select Student Type</option>
                                </select>
                                 <div class="text-danger">{{ $errors->first('student_type_id') }}</div>
                            </div>
                        </div>

                        <div class="col-xs-12 col-sm-6 col-md-4">
                            <div class="form-group">
                                <label for="Batch Setting">Section  :</label>
                                <select name="section_id" id="section_id" class="form-control" required>
                                     <option value="">Select Section</option>
                                     @foreach($sectiones as $section)
                                     <option {{ $feeSetting->section_id  == $section->id ? 'selected' :'' }} value="{{ $section->id }}">{{ $section->name }}</option>
                                     @endforeach
                                </select>
                                <div class="text-danger">{{ $errors->first('section_id') }}</div>
                            </div>
                        </div>
                        
                        
                        <div class="col-xs-12 col-sm-6 col-md-4">
                            <div class="form-group">
                                <label for="">amount</label>
                                <input type="number" value="{{$feeSetting->amount}}" name="amount" class="form-control"/>
                                <div class="text-danger">{{ $errors->first('amount') }}</div>
                            </div>
                        </div>

                        <div class="col-xs-12 col-sm-6 col-md-4">
                            <div class="form-group">
                                <label for="">Action Type</label>
                                <select name="fee_category_action_type_id" id="" class="fee_category_action_type_id form-control" required>
                                    @foreach($fee_action_typies as $feeAction)
                                    <option {{ $feeSetting->fee_category_action_type_id == $feeAction->id ? 'selected' :'' }} value="{{ $feeAction->id }}">{{ $feeAction->name }}</option>
                                    @endforeach
                               </select>
                                <div class="text-danger">{{ $errors->first('fee_category_action_type_id') }}</div>
                            </div>
                        </div>

                        <div class="col-xs-12 col-sm-6 col-md-2">
                            <input type="submit" value="Update" class="btn btn-primary" style="margin-top:16%"/>
                        </div>
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
