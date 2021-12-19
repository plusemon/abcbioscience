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



                    <div class="row">

                        <div class="col-xs-12 col-sm-6 col-md-4">
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
                                <label for="Batch Setting">Batch  :</label>
                                <select name="current_batch_setting_id"  class="current_batch_setting_id form-control" >
                                    <option  value="">Select Batch</option>
                                </select>
                                <div class="text-danger">{{ $errors->first('current_batch_setting_id') }}</div>
                            </div>
                        </div>
                        
                        <div class="col-xs-12 col-sm-6 col-md-4">
                            <div class="form-group">
                                <label for="Batch Setting">Batch Type  :</label>
                                <select name="batch_type_id"  class="current_batch_type_id form-control">
                                    <option value="">Select Section</option>
                                    @foreach($batchTypes as $btype)
                                    <option   {{ $batch_type_id == $btype->id ? 'selected' :'' }}  value="{{ $btype->id }}">{{ $btype->name }}</option>
                                    @endforeach
                                </select>
                                <div class="text-danger">{{ $errors->first('batch_type_id') }}</div>
                            </div>
                        </div>
                        <div class="col-xs-12 col-sm-6 col-md-4">
                            <div class="form-group">
                                <label for="Batch Setting">Action Type  :</label>
                                <select name="action_type"  class="action_type form-control">
                                    <option value="">Select Option</option>
                                    <option value="1">Add New Batch</option>
                                    <option value="2">Promotion Class</option>
                                    {{-- <option value="3">Change Batch</option> --}}
                                </select>
                                <div class="text-danger">{{ $errors->first('action_type') }}</div>
                            </div>
                        </div>
                    </div>
                </form>

                <div class="existingData" >
                </div>

                <div class="showForm"></div>

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


    /*get form blade*/
        $(document).on('change keyup','.dropdown_class,.studentName, .student_id,.current_class_id,.current_session_id,.current_batch_setting_id,.current_batch_type_id,.action_type',function(){
            var userId                 = $('.student_id').val();
            var actionType             = $('.action_type option:selected').val();
            
            var userId                 = $('.student_id').val();
            var actionType             = $('.action_type option:selected').val();
            
            if(userId && actionType)
            {
                if(actionType == 1)
                {
                    sendRequest(chaeckAble = false);
                }else{
                    sendRequest(chaeckAble = true);
                }   
            }
            else{
                allEmptyHtmlData();
            }
        });
        function sendRequest(chaeckAble)
        {
            var user_id                 = $('.student_id').val();
            var current_class_id        = $('.current_class_id option:selected').val();
            var current_session_id      = $('.current_session_id option:selected').val();
            var current_batch_setting_id = $('.current_batch_setting_id option:selected').val();
            var current_batch_type_id   = $('.current_batch_type_id option:selected').val();
            var action_type             = $('.action_type option:selected').val();
            var url  = "";
            if(chaeckAble == true)
            {
                if(action_type == 2)
                {
                    if(user_id &&  current_class_id && current_session_id && current_batch_setting_id && current_batch_type_id && action_type )
                    {
                        url = "{{route('admin.promotionFromByAjax')}}";
                    }else{
                        allEmptyHtmlData();
                    }
                }else{
                    url = "{{route('admin.promotionFromByAjax')}}";
                }
            }
            else{
                url = "{{route('admin.promotionFromByAjax')}}";
            }

            $.ajax({
                    url: url,
                    type: "GET",
                    data: {user_id:user_id,current_class_id:current_class_id,current_session_id:current_session_id,
                            current_batch_setting_id:current_batch_setting_id,current_batch_type_id:current_batch_type_id,
                            action_type:action_type
                        },
                    success: function(response)
                    {
                        $('.showForm').html(response.html);
                        $('.existingData').html(response.existingHtml);
                        $('.hiddenData').html(response.hiddenData);
                    },
            });
        }
        function allEmptyHtmlData()
        {
            $('.showForm').html('');
            $('.existingData').html('');
            $('.hiddenData').html('');
        }
       /*get form blade*/





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
        //current part  

        });
    </script>

@endsection
@endsection
