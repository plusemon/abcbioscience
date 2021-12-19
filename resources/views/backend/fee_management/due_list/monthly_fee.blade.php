    @extends('backend.layouts.app')
    @section('title','Monthly Fee Due List')
    @section('content')



                <div id="content" class="content">
                <div class="row">
                    <div class="col-xl-12">
                        <div class="panel panel-inverse" data-sortable-id="form-stuff-10">
                            <div class="panel-heading">
                                <h4 class="panel-title">Monthly Fee Due List</h4>
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
                               
                                    <div class="row">
                                        <div class="col-md-4">
                                            {{-- <input type="hidden" id="searchingStudentByAjax" value="{{route('admin.get_student_by_key_up')}}"/>
                                            <input type="hidden" id="setProductIdByClickingThisUrl" value=""/>
                                            <input type="hidden" id="student_id" name="student_id" value="" class="student_id"/>
                                            <div class="form-group dropdown">
                                                <label for="">Student name </label>
                                                <input  type="text" id="p_name_sku_bar_code_id" value="" class="form-control studentName" placeholder="Student name">
                                                <div id="student_list" class="" > </div>
                                                    <style>
                                                        .dropdown .dropdown-menu {
                                                            top: 55px;
                                                            width:100%;
                                                        }
                                                    </style>
                                            </div> --}}
                                            <div class="form-group">
                                                <label >Fee Category </label>
                                                <select name="fee_cat_id" id="" class="fee_cat_id form-control" required>
                                                    @foreach($fee_categories as $feeCat)
                                                    <option {{ old('fee_cat_id') == $feeCat->id ? 'selected' : '' }} value="{{ $feeCat->id }}">{{ $feeCat->name }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                                
                                        <div class="col-md-4">
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
                                        <div class="col-md-4">
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

                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label >Batch </label>
                                                <select name="batch_setting_id" id="" class="batch_setting_id form-control" required>
                                                    <option value="">Select Batch </option>
                                                     @foreach($batch_settings as $batch)
                                                    <option {{ $batchId == $batch->id ? 'selected' : '' }}  {{ old('batch_setting_id') == $batch->id ? 'selected' : '' }} value="{{ $batch->id }}">{{ $batch->batch_name }}</option>
                                                    @endforeach 
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label >Batch Type </label>
                                                <select name="batch_type_id" id="" class="batch_type_id form-control" required>
                                                    <option value="">Select Batch Type </option>
                                                    @foreach($batchTypies as $batchtype)
                                                    <option  {{ old('batch_type_id') == $batchtype->id ? 'selected' : '' }} value="{{ $batchtype->id }}">{{ $batchtype->name }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label >Month </label>
                                                <select name="month_id" id="" class="month_id form-control" required>
                                                    <option value="">Select Month</option>
                                                    @foreach($months as $month)
                                                    <option {{ old('month_id') == $month->id ? 'selected' : '' }} value="{{ $month->id }}">{{ $month->name }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                        {{--
                                            <div class="col-md-3">
                                                <div class="form-group">
                                                    <label >Year </label>
                                                    <select name="year" id="" class="year form-control" required>
                                                        <option value="">Select Year</option>
                                                        @php $j = 2020 ; @endphp
                                                        @for($i = 20; $i <= 50; $i++)
                                                            <option value="{{$j}}">{{$j}}</option>
                                                            @php $j++ ;@endphp
                                                        @endfor
                                                    </select>
                                                </div>
                                            </div>
                                        --}}
                                    </div>
                                        <hr/> <br/>
                                    <div class="row">
                                        <div class="col-md-12">
                                            <table class="table table-bordered table-hovered">
                                                <thead>
                                                    <tr>
                                                        <th>Sl</th>
                                                        <th>Student Name</th>
                                                        <th>UID - Roll</th>
                                                        <th>Monthly Fee</th>
                                                        <th>Waiver</th>
                                                        <th>Payable <br/>(Amount)</th>
                                                        <th>Paid <br/>Amount</th>
                                                        <th>Due <br/>Amount</th>
                                                    </tr>
                                                </thead>
                                                <tbody class="show_result">

                                                </tbody>
                                               {{--   <tr>
                                                    <th colspan="2" style="text-align:right;">Total</th>
                                                    <th> <strong class="total_payable_amount"></strong></th>
                                                    <th><strong class="total_paid_amount"></strong></th>
                                                    <th><strong class="total_collecting_amount"></strong></th>
                                                    <th><strong class="total_due_amount"></strong></th>
                                                </tr>  --}}
                                            </table>
                                        </div>
                                    </div>

                                        <a  class="btn btn-sm btn-danger pull-right " href="{{ route('admin.fee-collection.index') }}" style="margin-right:1%;">Cancel</a>
                                        <br/><br/>
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



    /*Auto Complete for student name*/
        /** Search and Add to Cart By Product Name/SKU/Bar Code **/
            //$(document).ready(function(){
                var ctrlDown = false,
                ctrlKey = 17,
                cmdKey = 91,
                vKey = 86,
                cKey = 67;
                $(document).on('keyup','#p_name_sku_bar_code_id',function(e){
                    e.preventDefault();
                    if (e.keyCode == ctrlKey || e.keyCode == cmdKey) ctrlDown = true;
                    if (ctrlDown && (e.keyCode == vKey || e.keyCode == cKey)) return false;
                    searchAndAddToCartByPNameSkuBarcode();
                });
            //);

        /** Search and Add to Cart By Product Name/SKU/Bar Code **/
         /*
        |--------------------------------------------------------------------------------------
        | Search and Add to Cart By Product Name/SKU/Bar Code
        |----------------------------------------------------------------
        */
            function searchAndAddToCartByPNameSkuBarcode()
            {
                $('.student_id').val('');
                var name = $('.studentName').val();
                var url = $('#searchingStudentByAjax').val();
                if(name.length > 1)
                {
                    setTimeout(function (){
                        $.ajax({
                            url: url,
                            type: "GET",
                            data: {name:name},
                            success: function(response)
                            {
                                $('#student_list').fadeIn();
                                $('#student_list').html(response.data);
                            },
                        });
                    }, 700)
                }else{
                    $('.student_id').val('');
                    $('#student_list').fadeOut();
                }
            }

            /*
            |-----------------
            |	After searchAndAddToCartByPNameSkuBarcode Result
            |-----------------
            */
                var ctrlDown = false,
                ctrlKey = 17,
                cmdKey = 91,
                vKey = 86,
                cKey = 67;
                $(document).on('click','.dropdown_class',function(e){
                    $('.student_id').val('');
                    e.preventDefault();
                    if (e.keyCode == ctrlKey || e.keyCode == cmdKey) ctrlDown = true;
                    if (ctrlDown && (e.keyCode == vKey || e.keyCode == cKey)) return false;
                    //$('#p_name_sku_bar_code_id').val($(this).data('id'));
                    $('#student_list').fadeOut();

                        var product_text = $(this).text();
                        var product_id = $(this).data('id');
                        $('.student_id').val(product_id);
                        $('#p_name_sku_bar_code_id').val(product_text)
                        /*
                        var url = $('#setProductIdByClickingThisUrl').val();
                        $.ajax({
                        url: url,
                        type: "GET",
                        data: {product_id:product_id},
                        success: function(response)
                        {
                            $('#showResult').html(response.data);
                            $('#p_name_sku_bar_code_id').val('');
                            //$('#p_name_sku_bar_code_id').focus();
                        },
                    });
                    */
                });
                $(document).click(function(){
                    $('#student_list').fadeOut();
                    //$('#p_name_sku_bar_code_id').val('');
                    //$('#p_name_sku_bar_code_id').focus();
                });
            /*
            |-----------------
            |	After searchAndAddToCartByPNameSkuBarcode Result
            |-----------------
            */
        /*
        |----------------------------------------------------------------
        | Search and Add to Cart By Product Name/SKU/Bar Code
        |--------------------------------------------------------------------------------------------
        */
    /*Auto Complete for student name*/
    
    
    /*get batch id by student id , class id and session id*/
        $(document).on('change keyup click','.dropdown_class,.studentName, .student_id,.class_id,.session_id',function(){
            var user_id         = $('.student_id').val();
            var class_id        = $('.class_id option:selected').val();
            var session_id      = $('.session_id option:selected').val();
            if(user_id && class_id && session_id)
            {
                var url  = "{{route('admin.getBatchSettingIdByClassSessionUserId')}}";
                $.ajax({
                        url: url,
                        type: "GET",
                        data: {user_id:user_id,class_id:class_id,session_id:session_id},
                        success: function(response)
                        {
                            //console.log(response);
                            $('.batch_setting_id').html(response.data);
                        },
                    });
            }else{

            }
        });
    /*get batch id by student id , class id and session id*/





        $(document).ready(function(){
            $('.submitButton').attr('disabled','disabled');
        });

        $(document).on('change','.fee_cat_id,.class_id,.session_id,.batch_setting_id,.batch_type_id,.month_id',function(){
            $('.submitButton').attr('disabled','disabled');
            getStudentCurrentData();
        });

        function getStudentCurrentData()
        {
            var fee_cat_id      = $('.fee_cat_id option:selected').val();
            var class_id        = $('.class_id option:selected').val();
            var session_id      = $('.session_id option:selected').val();
            var batch_type_id   = $('.batch_type_id option:selected').val();
            var month_id        = $('.month_id option:selected').val();
            var batch_setting_id = $('.batch_setting_id option:selected').val();

            if(fee_cat_id && class_id && session_id && month_id && batch_setting_id && batch_type_id)
            {
                $.ajax({
                    type: "get",
                    url: "{{ route('admin.monthlyFeeDueListSearchResult') }}",
                    data: {fee_cat_id:fee_cat_id ,class_id:class_id,
                            session_id:session_id,batch_type_id:batch_type_id,
                            month_id:month_id,batch_setting_id:batch_setting_id
                        },
                    success: function (data) {
                        if(data.status == true)
                        {
                            $(".show_result").html(data.htmlData);
                            $('.submitButton').removeAttr('disabled','disabled');
                            setDueAmount();
                            setFooterAmount();
                        }else{
                            $(".show_result").html('');
                            $('.submitButton').attr('disabled','disabled');
                        }
                    },
                    error: function (data) {

                    }
                });
            }else{
                $(".show_result").html('');
            }
        }
 

    function setFooterAmount()
    {
        var totalPayableAmount = 0;
        var totalPaidAmount = 0;
        var totalCollectAmount = 0;
        var totalDueAmount = 0;
        $('.payable_amount').each(function(){
            totalPayableAmount += parseFloat(nanCheck($(this).val()));
        });

        $('.paid_amount').each(function(){
            totalPaidAmount += parseFloat(nanCheck($(this).val()));
        });

        $('.type').each(function(){
            totalCollectAmount += parseFloat(nanCheck($(this).val()));
        });
        $('.due_amount').each(function(){
            totalDueAmount += parseFloat(nanCheck($(this).val()));
        });

        $('.total_payable_amount').val(totalPayableAmount);
        $('.total_paid_amount').val(totalPaidAmount);
        $('.total_collecting_amount').val(totalCollectAmount);
        $('.total_due_amount').val(totalDueAmount);
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
