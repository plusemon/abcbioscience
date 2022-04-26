@extends('backend.layouts.app')
@section('title','Student collection List')
@section('content')
 <div id="content" class="content">
            <div class="panel panel-inverse">
                <div class="panel-heading">
                    <h4 class="panel-title">Student Fee Collection List  </h4>
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
                      <div class="col-md-12">
                            <a href="{{route('admin.fee-collection.create')}}" class="btn-primary btn float-right mb-1"> <i class="fa fa-plus"></i>Monthly Fee Collection </a>
                    <a href="{{route('admin.othersFeeCollection')}}" class="btn-primary btn float-right mb-1" style="margin-right:1%;"> <i class="fa fa-plus"></i>Others Fee Collection </a>

                      </div>
                  </div>
                   

                   <div class="row">
 

                            <input type="hidden" id="searchingStudentByAjax" value="{{route('admin.get_student_by_key_up')}}"/>
                            <input type="hidden" id="setProductIdByClickingThisUrl" value=""/>
                            <input type="hidden" id="student_id" name="user_id" value="" class="student_id student_id_class"/>
                            <div class="form-group dropdown">
                               <input  type="text" id="p_name_sku_bar_code_id" value="" autocomplete="off" class="form-control studentName" placeholder="Student name" class="form-control col-md-2">
                                <div id="student_list" class="" > </div>
                                    <style>
                                        .dropdown .dropdown-menu {
                                            top: 55px;
                                            width:100%;
                                        }
                                    </style>
                        </div>

  
                        <select name="class_id" id="class_id" class="class_id form-control col-md-3" >
                            <option value="">Select Class</option>
                            @foreach($classes as $class)
                                <option @if(isset($class_id)) {{ $class_id == $class->id ? 'selected' :'' }} @endif value="{{ $class->id }}"> {{ $class->name }}</option>
                            @endforeach
                        </select>

                        <select name="session_id" id="session_id" class="session_id form-control col-md-3" >
                            <option value="">Select Session</option>
                            @foreach($sessiones as $session)
                                <option @if(isset($session_id)) {{ $session_id == $session->id ? 'selected' :'' }} @endif value="{{ $session->id }}"> {{ $session->name }}</option>
                            @endforeach
                        </select>

                         <select name="batch_setting_id" id="batch_setting_id" class="batch_setting_id form-control col-md-3" >
                             <option  value="">Select Batch</option>
                        </select>
                        <select name="fee_cat_id" id="" class="fee_cat_id form-control col-md-3" required>
                            <option value="">Select Fee Category</option>
                            @foreach($fee_categories as $feeCat)
                            <option {{ old('fee_cat_id') == $feeCat->id ? 'selected' : '' }} value="{{ $feeCat->id }}">{{ $feeCat->name }}</option>
                            @endforeach
                        </select>
                        <select name="month_id" id="" class="month_id form-control col-md-3" required>
                            <option value="">Select Month</option>
                            @foreach($months as $month)
                            <option {{ old('month_id') == $month->id ? 'selected' : '' }} value="{{ $month->id }}">{{ $month->name }}</option>
                            @endforeach
                        </select>

                        <input type="date" name="start_date" value="" class="start_date form-control col-md-3">
                        <input type="date" name="end_date" value="" class="end_date form-control col-md-3">
                                           

                        <button type="submit" class="btn btn-primary col-md-1 mr-3 mt-2" id="search_id"> <i class="fa fa-search"></i>  Search</button>
                        
                     

                       <select name="pagination" id="pagination_id" class="pagination_id_class btn btn-primary btn-sm col-md-1 mr-3 mt-2">
                            <option value="10">10</option>
                            <option value="15">15</option>
                            <option value="30">30</option>
                            <option value="50">50</option>
                            <option value="100">100</option>
                            <option value="500">500</option>
                            <option value="all_data">All Data</option>
                        </select>
                    
                    </div>


                    <hr>






                    

                    
                    <div id="showResult">
                        
                    </div>


                </div>
            </div>
        </div>
        



<input type="hidden" id="getHtmlResponse" data-url="{{route('admin.student.fee-collection.index.ajax')}}" >
       

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
            |   After searchAndAddToCartByPNameSkuBarcode Result
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

                var pagination          = getValueFromSelectOption('pagination_id_class');
                var student_id          = getValueFromSelectOption('student_id_class');
                var class_id            = getValueFromSelectOption('class_id');
                var session_id          = getValueFromSelectOption('session_id');
                var batch_setting_id    = getValueFromSelectOption('batch_setting_id');
                var fee_cat_id          = getValueFromSelectOption('fee_cat_id');
                var month_id            = getValueFromSelectOption('month_id');
                var start_date          = getValueFromInputField('start_date');
                var end_date            = getValueFromInputField('end_date');
                
              
    
                $.ajax({
                    url: url,
                    type: "GET",
                    data: {pagination:pagination,fee_cat_id:fee_cat_id,student_id:student_id,class_id:class_id,session_id:session_id,batch_setting_id:batch_setting_id,month_id:month_id,start_date:start_date,end_date:end_date},
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

                var student_id          = getValueFromSelectOption('student_id_class');
                var class_id            = getValueFromSelectOption('class_id');
                var session_id          = getValueFromSelectOption('session_id');
                var batch_setting_id    = getValueFromSelectOption('batch_setting_id');
                var fee_cat_id          = getValueFromSelectOption('fee_cat_id');
                var month_id            = getValueFromSelectOption('month_id');
                var start_date          = getValueFromInputField('start_date');
                var end_date            = getValueFromInputField('end_date');
                
              
    
                $.ajax({
                    url: url,
                    type: "GET",
                    data: {pagination:pagination,fee_cat_id:fee_cat_id,student_id:student_id,class_id:class_id,session_id:session_id,batch_setting_id:batch_setting_id,month_id:month_id,start_date:start_date,end_date:end_date},
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

                $(document).on('click', '.check_all_class', function() {
                 if (this.checked == false) {
                     
                     $('.check_single_class').prop('checked', false).change();
                     $(".check_single_class").each(function() {
                         var id = $(this).attr('id');
                         $(this).val('').change();

                     });
                 } else {
                    
                     $('.check_single_class').prop("checked", true).change();

                     $(".check_single_class").each(function() {
                         var id = $(this).attr('id');
                         $(this).val(id).change();
                     });
                 }
             });

        </script>



@endsection
@endsection  