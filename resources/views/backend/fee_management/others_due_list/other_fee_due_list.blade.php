    @extends('backend.layouts.app')
    @section('title',' Others Fee Due List')
    @section('content')

                <div id="content" class="content">
                <div class="row">
                    <div class="col-xl-12">
                        <div class="panel panel-inverse" data-sortable-id="form-stuff-10">
                            <div class="panel-heading">
                                <h4 class="panel-title">Others Fee Due List</h4>
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

                                 <form action="{{ route('admin.othersPaymentFeeDueList') }}" method="post">
                                    @csrf
                                   
                                    <div class="row">
                                        <div class="col-md-3">
                                            <div class="form-group">
                                                <label for="" >Class</label>
                                                <select name="class_id" id="" class="class_id form-control" required>
                                                    <option value="">Select Class</option>
                                                    @foreach($classes as $class)
                                                    <option {{ $classId == $class->id ? 'selected' : '' }}{{ old('class_id') == $class->id ? 'selected' : '' }} value="{{ $class->id }}">{{ $class->name }}</option>
                                                    @endforeach
                                            </select>
                                            </div>
                                        </div>
                                        <div class="col-md-3">
                                            <div class="form-group">
                                                <label >Session</label>
                                                <select name="session_id" id="" class="session_id form-control" required>
                                                    <option value="">Select Session</option>
                                                    @foreach($sessiones as $session)
                                                    <option {{ $sessionId == $session->id ? 'selected' : '' }}{{ old('session_id') == $session->id ? 'selected' : '' }} value="{{ $session->id }}">{{ $session->name }}</option>
                                                    @endforeach
                                            </select>
                                            </div>
                                        </div>
                                        <div class="col-md-3">
                                            <div class="form-group">
                                                <label >Batch </label>
                                                <select name="batch_setting_id" id="" class="batch_setting_id form-control" required>
                                                    <option value="">Select Batch </option>
                                                </select>
                                            </div>
                                        </div>
                                         <div class="col-md-3">
                                            <div class="form-group">
                                                <label >Batch Type</label>
                                                <select name="batch_type_id" id="" class="batch_type_id form-control" required>
                                                    <option value="">Select Batch </option>
                                                    @foreach($batchTypies as $batch)
                                                    <option {{ $batchId == $batch->id ? 'selected' : '' }}  {{ old('batch_type_id') == $batch->id ? 'selected' : '' }} value="{{ $batch->id }}">{{ $batch->name }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label >Fee Category </label>
                                                <select name="fee_cat_id" id="" class="fee_cat_id form-control" required>
                                                    <option value="">Fee Category</option>
                                                    @foreach($fee_categories as $feeCat)
                                                    <option {{ old('fee_cat_id') == $feeCat->id ? 'selected' : '' }} value="{{ $feeCat->id }}">{{ $feeCat->name }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                        
                                       

                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label >Category Details </label>
                                                <select name="fee_amount_setting_id" id="" class="fee_amount_setting_id form-control" required>
                                                    <option value="">Category Details</option>
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                        <hr/> <br/>
                                    <div class="row">
                                        <div class="col-md-12">
                                           <table class="table table-bordered table-hovered">
                                                <thead>
                                                    <tr>
                                                        <th>
                                                            <input type="checkbox" name="" id="checkedAll">
                                                        </th>
                                                        <th>Sl</th>
                                                        <th>Student Name</th>
                                                        <th>UID</th>
                                                         
                                                        <th>Payable <br/>(Amount)</th>
                                                        <th>Paid <br/>Amount</th>
                                                        <th>Due <br/>Amount</th>
                                                        <th>Status</th>
                                                    </tr>
                                                </thead>
                                                
                                                
                                                <tbody class="show_result">

                                                </tbody>
                                                
                                               
                                                </table>
                                        </div>
                                    </div>


                                        
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

        $('.submitButton').attr('disabled','disabled');


        $(document).ready(function(){
            getBatchSetting();
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
   



    $(document).on('change','.fee_cat_id,.class_id,.session_id,.batch_setting_id,.batch_type_id',function()
    {
        var class_id        = $('.class_id option:selected').val();
        var session_id      = $('.session_id option:selected').val();
        var batch_setting_id = $('.batch_setting_id option:selected').val();

        var batch_type_id   = $('.batch_type_id option:selected').val();
        var fee_cat_id      = $('.fee_cat_id option:selected').val();


        if(class_id && session_id && fee_cat_id )
        {
            $.ajax({
                type: "get",
                url: "{{ route('admin.searchFeeAmountSettingByOthersData') }}",
                data: {class_id:class_id,session_id:session_id,fee_cat_id:fee_cat_id,
                        batch_setting_id:batch_setting_id ,batch_type_id:batch_type_id
                    },
                success: function (data) {
                    if(data.status == true)
                    {
                        $(".fee_amount_setting_id").html(data.data);
                         
                    }else{
                        $(".fee_amount_setting_id").html('<option value="">Please Select Valid Data </option>');
                        $('.submitButton').attr('disabled','disabled');
                    }
                },
                error: function (data) {

                }
            });
        }else{
            $(".orgin_id").html('<option value="">Please Select Valid Data </option>');
        }
    });

 
        $(document).ready(function(){
        
            getStudentCurrentData();
        });

        $(document).on('change keyup click','.dropdown_class,.studentName,.student_id,.class_id,.session_id,.batch_setting_id,.fee_cat_id,.batch_type_id,.fee_amount_setting_id',function(){
            
            getStudentCurrentData();
        });

        function getStudentCurrentData()
        {
            var class_id        = $('.class_id option:selected').val();
            var session_id      = $('.session_id option:selected').val();
            var batch_setting_id = $('.batch_setting_id option:selected').val();

            var batch_type_id   = $('.batch_type_id option:selected').val();
            var fee_cat_id      = $('.fee_cat_id option:selected').val();
            var fee_amount_setting_id = $('.fee_amount_setting_id option:selected').val();

            if(class_id && session_id && fee_cat_id && fee_amount_setting_id && batch_setting_id && batch_type_id)
            {
                $.ajax({
                    type: "get",
                    url: "{{ route('admin.othersPaymentFeeDueList') }}",
                    data: {class_id:class_id,
                            session_id:session_id,fee_cat_id:fee_cat_id,
                            fee_amount_setting_id:fee_amount_setting_id,batch_setting_id:batch_setting_id ,batch_type_id:batch_type_id
                        },
                    success: function (data) {
                         $(".show_result").html(data);
                    },
                    error: function (data) {

                    }
                });
            }else{
                $(".show_result").html('');
            }
        }

     
    </script>




    @endsection
    @endsection
