@extends('backend.layouts.app')
@section('title','Sheet Setting ')
@section('content')


    <div id="content" class="content">
        <div class="panel panel-inverse">
            <div class="panel-heading">
                <h4 class="panel-title">Sheet Setting </h4>
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





                <form action="{{ route('admin.sheet.setting.store') }}" method="post">
                    @CSRF
                    <div class="row" >

                        <div class="col-xs-12 col-sm-6 col-md-5">
                            <div class="form-group">
                                <label for="Session">Sheet No/Name :</label>
                                <input type="text" value="{{$sheetName}}" disabled class=" form-control"/>
                                <input type="hidden" value="{{$sheet_id}}" name="sheet_id" />
                            </div>
                        </div>
                        <div class="col-xs-12 col-sm-6 col-md-4">
                            <div class="form-group">
                                <label for="Session">Subject :</label>
                                <input type="text" value="{{$subjectName}}" disabled class=" form-control"/>
                                <input type="hidden" value="{{$subject_id}}" name="subject_id" />
                            </div>
                        </div>
                        <div class="col-xs-12 col-sm-6 col-md-3">
                            <div class="form-group">
                                <label for="Session">Sheet Type :</label>
                                <input type="text" value="{{$sheetTypeName}}" disabled class=" form-control"/>
                                <input type="hidden" value="{{$sheet_type_id}}" name="sheet_type_id" />
                            </div>
                        </div>

                        <div class="col-xs-12 col-sm-6 col-md-3">
                            <div class="form-group">
                                <label for="class">Class :</label>
                                <input type="text" value="{{$className}}" disabled class="batch_setting_id form-control"/>
                                <input type="hidden" value="{{$class_id}}" name="class_id" />
                            </div>
                        </div>
                        <div class="col-xs-12 col-sm-6 col-md-3">
                            <div class="form-group">
                                <label for="Session">Session :</label>
                                <input type="text" value="{{$sessionName}}" disabled class="batch_setting_id form-control"/>
                                <input type="hidden" value="{{$session_id}}" name="session_id" />
                            </div>
                        </div>

                        <div class="col-xs-12 col-sm-6 col-md-3">
                            <div class="form-group">
                                <label for="Batch Setting">Batch  :</label>
                                <select name="batch_setting_id" id="" class="batch_setting_id form-control" required>
                                    <option  value="">Select Batch</option>
                                    @foreach($batches as $batch)
                                        <option {{ old('batch_setting_id') == $batch->id ? 'selected' :'' }} value="{{ $batch->id }}"> {{ $batch->batch_name }}</option>
                                    @endforeach
                                </select>
                                <div class="text-danger">{{ $errors->first('batch_setting_id') }}</div>
                            </div>
                        </div>
                        <div class="col-xs-12 col-sm-6 col-md-3">
                            <div class="form-group">
                                <label for="Session">Batch Type :</label>
                                <select name="batch_type_id" id="batch_type_id" class="batch_type_id form-control" required>
                                    <option value="">Select Session</option>
                                    @foreach($batchTypies as $batchType)
                                        <option {{ old('batch_type_id') == $batchType->id ? 'selected' :'' }} value="{{ $batchType->id }}"> {{ $batchType->name }}</option>
                                    @endforeach
                                </select>
                                <div class="text-danger">{{ $errors->first('batch_type_id') }}</div>
                            </div>
                        </div>

                        <div class="col-xs-12 col-sm-6 col-md-3">
                            <div class="form-group">
                                <label for="">Publish</label>
                                <select name="publish_by" id="publish_by" class="form-control" required>
                                    <option value="">Select Publish</option>
                                    <option value="1">Now</option>
                                    <option value="2">Later</option>
                                     
                                </select>
                                <div class="text-danger">{{ $errors->first('taken_by') }}</div>
                            </div>
                        </div>


                        <div class="col-xs-12 col-sm-6 col-md-3">
                            <div class="form-group">
                                <label for="Session">Publish Date :</label>
                                <input type="date" value="" name="publish_date" class="form-control" required/>
                                <div class="text-danger">{{ $errors->first('publish_date') }}</div>
                            </div>
                        </div>
                        <div class="col-xs-12 col-sm-6 col-md-3">
                            <div class="form-group">
                                <label for="Batch Setting">Fee Category  :</label>
                                <select name="fee_cat_id" class="form-control" required>
                                    <option value="">Fee Category</option>
                                    @foreach($fee_categories as $fee_cat)
                                    <option {{ old('fee_cat_id') == $fee_cat->id ? 'selected' :'' }} value="{{ $fee_cat->id }}">{{ $fee_cat->name }}</option>
                                    @endforeach
                                </select>
                                <div class="text-danger">{{ $errors->first('fee_cat_id') }}</div>
                            </div>
                        </div>
                        <div class="col-xs-12 col-sm-6 col-md-3">
                            <div class="form-group">
                                <label for="Batch Setting">Pay Times  :</label>
                                <select name="pay_time_id" id="pay_time_id" class="form-control" required>
                                    <option value="">Select Pay Time</option>
                                    @foreach($payTimes as $paytime)
                                    <option {{ old('pay_time_id') == $paytime->id ? 'selected' :'' }} value="{{ $paytime->id }}">{{ $paytime->name }}</option>
                                    @endforeach
                                </select>
                                <div class="text-danger">{{ $errors->first('pay_time_id') }}</div>
                            </div>
                        </div>



                        
                        <div class="col-xs-12 col-sm-6 col-md-3">
                            <div class="form-group">
                                <label for="">Amount</label>
                                <input type="number" value="" name="amount" step="any" class="form-control" placeholder="Amount"/>
                                <div class="text-danger">{{ $errors->first('amount') }}</div>
                            </div>
                        </div>

                        <div class="col-xs-12 col-sm-6 col-md-3">
                            <div class="form-group">
                                <label for="">Taken By</label>
                                <select name="taken_by" id="taken_by" class="form-control" required>
                                    <option value="">Select Taken By</option>
                                    <option value="1">Global Student</option>
                                    <option value="2">Only Batch Student</option>
                                     
                                </select>
                                <div class="text-danger">{{ $errors->first('taken_by') }}</div>
                            </div>
                        </div>

                        

                        <div class="col-xs-12 col-sm-12 col-md-12">
                            <input type="submit" value="Submit" class="btn btn-primary" />
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
