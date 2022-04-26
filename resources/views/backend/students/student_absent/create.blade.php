@extends('backend.layouts.app')
@section('title','Add Student Absent')


    @push('css')
    <link href="{{ asset('public/backend') }}/multi-selector/css/fselector.css" rel="stylesheet" /> 
    <script src="{{ asset('public/backend') }}/multi-selector/js/jquery.js"></script>
    <script src="{{ asset('public/backend') }}/multi-selector/js/fselector.js"></script>
        <script>
        (function($) {
            $(function() {
                $('.test').fSelect();
            });
        })(jQuery);
        </script>
    @endpush
@section('content')



            <div id="content" class="content">
            <div class="row">
                <div class="col-xl-12">
                    <div class="panel panel-inverse" data-sortable-id="form-stuff-10">
                        <div class="panel-heading">
                            <h4 class="panel-title">Add Student Absent</h4>
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
                            <form action="{{ route('admin.absent.store') }}" method="POST" >
                                @csrf

                                <div class="row">
                                    <div class="col-md-6">

                                        <div class="row">

                                            <div class="col-md-12">
                                                <input type="hidden" id="searchingStudentByAjax" value="{{route('admin.get_student_by_key_up')}}"/>
                                                <input type="hidden" id="setProductIdByClickingThisUrl" value=""/>
                                                <input type="hidden" id="student_id"  value="" class="student_id"/>
                                                <div class="form-group dropdown">
                                                    <label for="">Student name </label>
                                                    <input autocomplete="off" type="text" id="p_name_sku_bar_code_id" value="" class="form-control studentName" placeholder="Student name">
                                                    <div id="student_list" class="" > </div>
                                                        <style>
                                                            .dropdown .dropdown-menu {
                                                                top: 55px;
                                                                width:100%;
                                                            }
                                                        </style>
                                                </div>
                                            </div>
                                            <div class="col-md-12">
                                                <div class="form-group">
                                                    <label >Batch Name</label>
                                                    <select name="batch_setting_id" id="" class="batch_setting_id form-control" required>
                                                        <option value="">Select Batch </option>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="col-md-12">
                                                <div class="form-group">
                                                    <label >Batch Type</label>
                                                     <select name="batch_type_id" id="" class="batch_type_id form-control" required>
                                                        <option value="">Select Batch Type </option>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label for="" >Class</label>
                                                    <input type="text" disabled class="class_id form-control" />
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label >Session</label>
                                                    <input type="text" disabled class="session_id form-control" />
                                                </div>
                                            </div>
                                            
                                        </div>
                                    </div><!---- col-md-6 end--->

                                    <div class="col-md-6">
                                        <div class="row">

                                            <div class="col-md-12">
                                                <div class="form-group">
                                                    <label >Month (<small>Current Year - {{date('Y')}}</small>) </label>
                                                    <select name="month_id[]" id="" class="test start_month_id form-control" multiple="multiple" required>
                                                        <option value="">Select Start Month</option>
                                                        @foreach($months as $month)
                                                        <option {{ old('start_month_id') == $month->id ? 'selected' : '' }} value="{{ $month->id }}">
                                                            {{ $month->name }}
                                                        </option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                            </div>

                                            <div class="col-md-12">
                                                <div class="form-group">
                                                    <label >Reason </label>
                                                    <input type="text"  name="reason" value=""  class="form-control "/>
                                                </div>
                                            </div>
                                            
                                            <div class="col-md-12">
                                                <div class="form-group">
                                                    <label >Note </label>
                                                    <input type="text"  name="note" value=""  class="form-control "/>
                                                </div>
                                            </div>

                                            <div class="col-md-12">
                                                <div class="form-group">
                                                    <label >Status</label>
                                                    <select name="status" id="" class="form-control" required>
                                                        <option value="">Select Status</option>
                                                        <option {{ old('status') == 1 ? 'selected' : '' }} value="1">Active</option>
                                                        <option {{ old('status') == 2 ? 'selected' : '' }} value="2">Deactive</option>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="col-md-12"></div>
                                            <div class="hidden_div"></div>
                                            <input type="hidden"  value="{{$get_student_id}}" />
                                            <input type="hidden" name="user_id" value="{{$student_user_id}}" class="user_id" />

                                        </div><!---- child row in a row end--->
                                    </div><!---- col-md-6 end--->

                                </div>
                                <!----div row end--->



                                    <input type="submit" value="Submit" class="submitButton btn btn-md btn-primary  pull-right" disabled style="margin-left:1%;">
                                    <a  class="btn btn-md btn-danger pull-right" href="{{ route('admin.absent.index') }}">Cancel</a>

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
                    emptyInputDatas();
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
        $(document).on('change keyup click','.dropdown_class,.studentName, .student_id',function(){
            var user_id         = $('.student_id').val();
           // var class_id        = $('.class_id option:selected').val();
            //var session_id      = $('.session_id option:selected').val();
            if(user_id.length > 0)
            {
                var url  = "{{route('admin.getStudentBatch')}}";
                $.ajax({
                        url: url,
                        type: "GET",
                        data: {user_id:user_id},
                        success: function(response)
                        {
                            if(response.status == true)
                            {
                                $('.batch_setting_id').html(response.data);
                            }else{
                                $('.batch_setting_id').html('<option value="">Select Student First</option>');
                            }
                        },
                    });
            }else{
                $('.batch_setting_id').html('<option value="">Select Student First</option>');
                emptyInputDatas();
            }
        });
    /*get batch id by student id , class id and session id*/

    /*get batch id by student id , class id and session id*/
        $(document).on('change keyup','.studentName, .student_id,.batch_setting_id,.batch_type_id',function(){
            var user_id           = $('.student_id').val();
            var batch_setting_id  = $('.batch_setting_id option:selected').val();
            var batch_type_id     = $('.batch_type_id option:selected').val();
            
            if(user_id.length > 0 && batch_setting_id && batch_type_id)
            {
                $.ajax({
                        type: "get",
                        url: "{{ route('admin.getWaiverStudentDataByStudentId') }}",
                        data: {user_id:user_id,batch_setting_id:batch_setting_id,batch_type_id:batch_type_id},
                        success: function(data)
                        {
                            if(data.status == true)
                            {
                                $('.class_id').val(data.class);
                                $('.session_id').val(data.session);
                                
                                $('.class_type_id').val(data.Class_type);
                                $('.user_id').val(data.user_id);
                                $(".hidden_div").html(data.hidden);
                                $('.submitButton').removeAttr('disabled','disabled');
                            }else{
                                emptyInputDatas();
                            }
                        },
                    });
            }else{
                emptyInputDatas();
            }
        });
        function emptyInputDatas()
        {
            $('.class_id').val('');
            $('.session_id').val('');
            
            $('.class_type_id').val('');
            $('.user_id').val('');
            $(".hidden_div").html('');
            $('.submitButton').attr('disabled','disabled');
        }
    /*get batch id by student id , class id and session id*/



    /*get batch id by student id , class id and session id*/
        $(document).on('change keyup click','.dropdown_class,.studentName, .student_id,.batch_setting_id',function(){
            var user_id           = $('.student_id').val();
            var batch_setting_id  = $('.batch_setting_id option:selected').val();
            
            if(user_id.length > 0 && batch_setting_id)
            {
                var url  = "{{route('admin.getStudentBatchType')}}";
                $.ajax({
                        url: url,
                        type: "GET",
                        data: {user_id:user_id,batch_setting_id:batch_setting_id},
                        success: function(response)
                        {
                            if(response.status == true)
                            {
                                $('.batch_type_id').html(response.data);
                            }else{
                                $('.batch_type_id').html('<option value="">Select Batch First</option>');
                            }
                        },
                    });
            }else{
                $('.batch_type_id').html('<option value="">Select Batch First</option>');
                emptyInputDatas();
            }
        });
    /*get batch id by student id , class id and session id*/





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
