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
                                    <div class="row">
                                        <div class="col-md-4">
                                            <input type="hidden" id="searchingStudentByAjax" value="{{route('admin.get_student_by_key_up')}}"/>
                                            <input type="hidden" id="setProductIdByClickingThisUrl" value=""/>
                                            <input type="hidden" id="student_id" name="user_id" value="" class="student_id"/>
                                            <div class="form-group dropdown">
                                                <label for="">Student name </label>
                                                <input  type="text" id="p_name_sku_bar_code_id" value="" autocomplete="off" class="form-control studentName" placeholder="Student name">
                                                <div id="student_list" class="" > </div>
                                                    <style>
                                                        .dropdown .dropdown-menu {
                                                            top: 55px;
                                                            width:100%;
                                                        }
                                                    </style>
                                            </div>
                                        </div>

                                        <div class="col-md-2">
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
                                        <div class="col-md-2">
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
                                                <label >Batch </label>
                                                <select name="batch_setting_id" id="" class="batch_setting_id form-control" required>
                                                    <option value="">Select Batch </option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-md-4">
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
                                                        <th>Sl</th>
                                                        <th>Fee Category</th>
                                                        <th>Payable <br/>(Amount)</th>
                                                        <th>Paid <br/>Amount</th>
                                                        <th>Collecting <br/>Amount</th>
                                                        <th>Due <br/>Amount</th>
                                                    </tr>
                                                </thead>
                                                <tbody class="show_result">

                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                        <a  class="btn btn-sm btn-danger pull-right " href="{{ route('admin.fee-collection.index') }}" style="margin-right:1%;">Cancel</a>
                                        <br/><br/>
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



    $(document).on('change','.fee_cat_id,.class_id,.session_id,.batch_setting_id,.batch_type_id',function()
    {
        var class_id        = $('.class_id option:selected').val();
        var session_id      = $('.session_id option:selected').val();
        var fee_cat_id      = $('.fee_cat_id option:selected').val();
        var batch_setting_id = $('.batch_setting_id option:selected').val();
        var batch_type_id   = $('.batch_type_id option:selected').val();
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
                        $('.submitButton').removeAttr('disabled','disabled');
                        setDueAmount();
                        setFooterAmount();
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
            $('.submitButton').attr('disabled','disabled');
            getStudentCurrentData();
            setDueAmount();
            setFooterAmount();
        });

        $(document).on('change keyup click','.dropdown_class,.studentName,.student_id,.class_id,.session_id,.batch_setting_id,.fee_cat_id,.batch_type_id,.fee_amount_setting_id',function(){
            $('.submitButton').attr('disabled','disabled');
            getStudentCurrentData();
        });

        function getStudentCurrentData()
        {
            var student_id      = $('.student_id').val();
            var class_id        = $('.class_id option:selected').val();
            var session_id      = $('.session_id option:selected').val();
            var fee_cat_id      = $('.fee_cat_id option:selected').val();
            var fee_amount_setting_id = $('.fee_amount_setting_id option:selected').val();
            var batch_setting_id = $('.batch_setting_id option:selected').val();
            var batch_type_id   = $('.batch_type_id option:selected').val();

            if(student_id && class_id && session_id && fee_cat_id && fee_amount_setting_id && batch_setting_id && batch_type_id)
            {
                $.ajax({
                    type: "get",
                    url: "{{ route('admin.othersFeeCollectionByStudent') }}",
                    data: {student_id:student_id ,class_id:class_id,
                            session_id:session_id,fee_cat_id:fee_cat_id,
                            fee_amount_setting_id:fee_amount_setting_id,batch_setting_id:batch_setting_id ,batch_type_id:batch_type_id
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

    /*default value sert part*/
    function setDueAmount()
    {
        $('.payable_amount').each(function(){
            var id = $(this).data('id');
            var payableAmount   = $('#payable_amount_id_'+id).val();
            var paidamount      = $('#paid_amount_id_'+id).val();
            var dueAmount       = payableAmount - paidamount;
            $('#due_amount_id_'+id).attr('value',dueAmount);
            $('#due_amount_id_'+id).val(dueAmount);
            if(dueAmount == 0)
            {
                $('#checked_id_'+id).prop('checked', false);
                $('#checked_id_'+id).val('NULL');
                $('#checked_id_'+id).hide();
                $('#ids_'+id).val('');
                $('#collecting_amount_id_'+id).attr('disabled','disabled');
            }
        });
    }
    /*default value sert part*/

    /*keyup part*/
    $(document).on('keyup','.type',function(){
        var id      = $(this).data('id');
        var payableAmount   = $('#payable_amount_id_'+id).val();
        var paidamount      = $('#paid_amount_id_'+id).val();
        var previousDueAmount = payableAmount - paidamount;
        var amount  = nanCheck($('#collecting_amount_id_'+id).val());
        if(amount > previousDueAmount)
        {
            $('#collecting_amount_id_'+id).attr('value',previousDueAmount);
            $('#collecting_amount_id_'+id).val(previousDueAmount);
            amount = previousDueAmount;
        }else{
            $('#collecting_amount_id_'+id).attr('value',amount);
            amount = amount;
        }
        var nowDueAmount = previousDueAmount - amount;
        $('#due_amount_id_'+id).attr('value',nowDueAmount);
        $('#due_amount_id_'+id).val(nowDueAmount);
        if(amount > 0)
        {
            $('#checked_id_'+id).prop('checked', true);
            $('#checked_id_'+id).val(id);
            $('#checked_id_'+id).show();
            $('#ids_'+id).val(id);
        }else{
            $('#checked_id_'+id).prop('checked', false);
            $('#checked_id_'+id).val('NULL');
            $('#checked_id_'+id).hide();
            $('#ids_'+id).val('');
        }
        setFooterAmount();
    });
    /*keyup part*/
    $(document).on('click','.check_class',function(){
        var check_id   = $(this).data('check_id');
        var checkValue = $('#collecting_amount_id_'+check_id).val();

        var payableAmount   = $('#payable_amount_id_'+check_id).val();
        var paidamount      = $('#paid_amount_id_'+check_id).val();
        var previousDueAmount = payableAmount - paidamount;
        //var amount  = nanCheck($('#collecting_amount_id_'+check_id).val());

        if ($(this).is(':checked'))
        {
            $('#checked_id_'+check_id).val(check_id);
            $('#collecting_amount_id_'+check_id).val(checkValue);
            $('#ids_'+check_id).val(check_id);
        }
        else{
            $('#checked_id_'+check_id).val('NULL');
            $('#collecting_amount_id_'+check_id).removeAttr('value').trigger('change');
            $('#collecting_amount_id_'+check_id).attr('value','').trigger('change');
            $('#collecting_amount_id_'+check_id).val('').trigger('change');
            $('#due_amount_id_'+check_id).val(previousDueAmount).trigger('change');

            $('#checked_id_'+check_id).hide();
            $('#ids_'+check_id).val('');
        }
        setFooterAmount();
    });


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


    $(document).on('click','.submitButton',function()
    {
        var string = $('.fee_cat_id option:selected').text();
        var ref = string.slice(0, 3);
        $('.reference_no').val(ref);
    });

    </script>




    @endsection
    @endsection
