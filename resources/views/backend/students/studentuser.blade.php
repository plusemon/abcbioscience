@extends('backend.layouts.app')
@section('title', 'Student User List')
@section('content')
    <div id="content" class="content">
        <div class="panel panel-inverse">
            <div class="panel-heading">
                <h4 class="panel-title">Student User List</h4>
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

                <div class="form-inline mb-4" >


                    <input type="hidden" id="searchingStudentByAjax" value="{{ route('admin.get_student_by_key_up') }}" />
                    <input type="hidden" id="setProductIdByClickingThisUrl" value="" />
                    <input type="hidden" id="student_id" name="user_id" value="" class="student_id student_id_class" />
                    <div class="form-group dropdown">
                        <input type="text" id="p_name_sku_bar_code_id" value="" autocomplete="off"
                            class="form-control studentName" placeholder="Student name" class="form-control">
                        <div id="student_list" class=""> </div>
                        <style>
                            .dropdown .dropdown-menu {
                                top: 55px;
                                width: 100%;
                            }

                        </style>
                    </div>



                    <input type="text" id="mobile" name="mobile" @if (isset($mobile)) value="{{ $mobile }}" @endif class="form-control mobile_class"
                        placeholder="Enter Mobile number">


                    <button type="submit" class="btn btn-primary btn-sm" id="search_id"> <i class="fa fa-search"></i> Search</button>
 
                </div>



                 <select name="pagination" id="pagination_id" class="pagination_id_class btn btn-primary btn-sm mb-4">
                    <option value="100">100</option>
                    <option value="10">10</option>
                    <option value="50">50</option>
                    <option value="15">15</option>
                    <option value="30">30</option>
                
                    <option value="500">500</option>
                    <option value="all_data">All Data</option>
                </select>


                 <div id="showResult"></div>

             </div>
        </div>
    </div>



    <input type="hidden" id="getHtmlResponse" data-url="{{ route('student.user.indexListByAjax') }}" >
     

@section('customjs')

    <script>
        $(document).ready(function() {
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            $(document).ready(function() {
                getBatchSetting();
                getClassType();
            });

            $(document).on('change', '.class_id ,.session_id', function() {
                getBatchSetting();
            });

            function getBatchSetting() {
                var class_id = $('.class_id').val();
                var session_id = $('.session_id').val();
                if (class_id && session_id) {
                    $.ajax({
                        type: "get",
                        url: "{{ route('get.batch.setting') }}",
                        data: {
                            class_id: class_id,
                            session_id: session_id
                        },
                        success: function(data) {
                            if (data.status == true) {
                                $(".batch_setting_id").html(data.batch_setting);
                            }
                        },
                        error: function(data) {
                            console.log('Error:', data);
                        }
                    });
                }
            }



            $(document).on('change', '.batch_setting_id,.class_id ,.session_id', function() {
                getClassType();
            });

            function getClassType() {
                var class_id = $('.class_id').val();
                var session_id = $('.session_id').val();
                var batch_setting_id = $('.batch_setting_id').val();
                if (class_id && session_id) {
                    $.ajax({
                        type: "get",
                        url: "{{ route('get_class_type_by_batch_setting') }}",
                        data: {
                            class_id: class_id,
                            session_id: session_id,
                            batch_setting_id: batch_setting_id
                        },
                        success: function(data) {
                            if (data.status == true) {
                                $(".student_type_id").html(data.class_type);
                            } else {
                                $(".student_type_id").html(data.class_type);
                            }
                        },
                        error: function(data) {
                            console.log('Error:', data);
                        }
                    });
                }
            }

        });
    </script>



    <script>
        /*Auto Complete for student name*/
        /** Search and Add to Cart By Product Name/SKU/Bar Code **/
        //$(document).ready(function(){
        var ctrlDown = false,
            ctrlKey = 17,
            cmdKey = 91,
            vKey = 86,
            cKey = 67;
        $(document).on('keyup', '#p_name_sku_bar_code_id', function(e) {
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
        function searchAndAddToCartByPNameSkuBarcode() {
            $('.student_id').val('');
            var name = $('.studentName').val();
            var url = $('#searchingStudentByAjax').val();
            if (name.length > 1) {
                setTimeout(function() {
                    $.ajax({
                        url: url,
                        type: "GET",
                        data: {
                            name: name
                        },
                        success: function(response) {
                            $('#student_list').fadeIn();
                            $('#student_list').html(response.data);
                        },
                    });
                }, 700)
            } else {
                $('.student_id').val('');
                $('#student_list').fadeOut();
            }
        }

        /*
        |-----------------
        |   After searchAndAddToCartByPNameSkuBarcode Result
        |-----------------
        */
        var ctrlDown = false,
            ctrlKey = 17,
            cmdKey = 91,
            vKey = 86,
            cKey = 67;
        $(document).on('click', '.dropdown_class', function(e) {
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
        $(document).click(function() {
            $('#student_list').fadeOut();
            //$('#p_name_sku_bar_code_id').val('');
            //$('#p_name_sku_bar_code_id').focus();
        });
    </script>



      <script>
            /*for page reload pagination*/
 
                  //============default Details of Delivery Charge section ==========
            $(document).ready(function(){
                getHtmlResponse();
            });


             $(document).on('click','#search_id',function(e){
                e.preventDefault();
                getHtmlResponse();
            });

            
            $(document).on('change','.pagination_id_class',function(e){
                e.preventDefault();
                getHtmlResponse();
           
            });


            function getHtmlResponse()
            {
                var url = $('#getHtmlResponse').data("url");
                var pagination   = getValueFromSelectOption('pagination_id_class');

                var mobile       = getValueFromInputField('mobile_class');
                var student_id   = getValueFromInputField('student_id_class');
                
              
    
                $.ajax({
                    url: url,
                    type: "GET",
                    data: {pagination:pagination,mobile:mobile,student_id:student_id},
                    success: function(response)
                    {
                        $('#showResult').html(response);
                         
                    },
                });
            }
            //============default Details of Delivery Charge section End ==========



 


            //=======================Pagination links===========================================
            $(document).on("change",".pagination_links a",function(x){
                x.preventDefault();
                var page = $(this).attr('href');
                var pageNumber = page.split('?page=')[1];
                return getPagination(pageNumber);
            });
            function getPagination(pageNumber){
                var createUrl = $('#getHtmlResponse').data("url");
                var url =  createUrl+"?page="+pageNumber;

                var pagination   = getValueFromSelectOption('pagination_id_class');

                var mobile       = getValueFromInputField('mobile_class');
                var student_id   = getValueFromInputField('student_id_class');
               

                $.ajax({
                        url: url,
                        type: "GET",
                        datatype:"HTML",
                        data: {pagination:pagination,mobile:mobile,student_id:student_id},
                        success: function(response)
                        {
                            $('#showResult').html(response);
                          
                        },
                    });
            }
            //=======================Pagination links===========================================

            function getValueFromSelectOption(className)
            {
                return $('.'+className).val();
            }

            function getValueFromInputField(className)
            {
                return $('.'+className).val();
            }
           

        //=====================================================================================

            

        </script>


@endsection
@endsection
