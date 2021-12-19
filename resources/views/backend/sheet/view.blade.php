@extends('backend.layouts.app')
@section('title','Sheet List')
@section('content')
 <div id="content" class="content">
            <div class="panel panel-inverse">
                <div class="panel-heading">
                    <h4 class="panel-title">Sheet List</h4>
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
                    <a href="{{ route('sheet.create') }}" class="btn btn-primary btn-xs pull-right mb-2"> <i class="fa fa-plus"></i> Add New Sheet</a>
                    



                     <form action="" method="get" class="form-inline mb-3">


                       
 
                        <select name="class_id" id="class_id" class="class_id form-control mr-3" >
                            <option value="">Select Class</option>
                            @foreach($classes as $class)
                                <option @if(isset($class_id)) {{ $class_id == $class->id ? 'selected' :'' }} @endif value="{{ $class->id }}"> {{ $class->name }}</option>
                            @endforeach
                        </select>

                        <select name="session_id" id="session_id" class="session_id form-control mr-3" >
                            <option value="">Select Session</option>
                            @foreach($sessiones as $session)
                                <option @if(isset($session_id)) {{ $session_id == $session->id ? 'selected' :'' }} @endif value="{{ $session->id }}"> {{ $session->name }}</option>
                            @endforeach
                        </select>
  
                         <select name="subject_id" id="subject_id" class="subject_id form-control mr-3" >
                            <option value="">Select Subject</option>
                            @foreach($subjects as $subject)
                                <option @if(isset($subject_id)) {{ $subject_id == $subject->id ? 'selected' :'' }} @endif value="{{ $subject->id }}"> {{ $subject->name }}</option>
                            @endforeach
                        </select>


                          <select name="chapter_id" id="chapter_id" class="subject_id form-control mr-3" >
                            <option value="">Select Chapter</option>
                           
                        </select>

                       


                        <button type="submit" class="btn btn-primary btn-sm" id="search_id"> <i class="fa fa-search"></i>  Search</button>
                        
                    </form>

                     <select name="pagination" id="pagination_id" class="pagination_id_class btn btn-primary btn-sm">
                            <option value="100">100</option>
                            <option value="50">50</option>
                            <option value="10">10</option>
                            <option value="15">15</option>
                            <option value="30">30</option>
                            <option value="500">500</option>
                            <option value="all_data">All Data</option>
                        </select>

                        <br>
                        <br>

                      <div id="showResult"></div>





                </div>
            </div>
        </div>
        

<input type="hidden" id="getHtmlResponse" data-url="{{route('sheet.index.ajax')}}" >
    

@section('customjs')



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
 
                var class_id            = getValueFromSelectOption('class_id');
                var session_id          = getValueFromSelectOption('session_id');
                var subject_id          = getValueFromSelectOption('subject_id');
                var chapter_id          = getValueFromSelectOption('chapter_id');

    
                $.ajax({
                    url: url,
                    type: "GET",
                    data: {pagination:pagination,class_id:class_id,session_id:session_id,subject_id:subject_id,chapter_id:chapter_id},
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

                var class_id            = getValueFromSelectOption('class_id');
                var session_id          = getValueFromSelectOption('session_id');
                var subject_id          = getValueFromSelectOption('subject_id');
                var chapter_id          = getValueFromSelectOption('chapter_id');
                
               

                $.ajax({
                        url: url,
                        type: "GET",
                        datatype:"HTML",
                        data: {pagination:pagination,class_id:class_id,session_id:session_id,subject_id:subject_id,chapter_id:chapter_id},
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




      <script>

     
          $(document).on('change','#subject_id', function () {

                var subject_id    = $('#subject_id').val();

                  $.ajax({
                        type: "get",
                        url: "{{ route('getchapter') }}",
                        data: {subject_id:subject_id},
                        success: function (data) {
                            if(data.status == true)
                            {
                                $("#chapter_id").html(data);
                            }else{
                                $("#chapter_id").html(data);
                            }
                        },
                        error: function (data) {
                            console.log('Error:', data);
                        }
                    });
            });
     
      
        </script>
@endsection
@endsection