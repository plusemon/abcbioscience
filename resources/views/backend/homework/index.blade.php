@extends('backend.layouts.app')
@section('title','Home Work list')
@section('content')


    <div id="content" class="content">
        <div class="panel panel-inverse">
            <div class="panel-heading">
                <h4 class="panel-title">Home Work list</h4>
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
                        <div class="col-xs-12 col-sm-2 col-md-2">
                            <div class="form-group">
                                <label for="class">Class :</label>
                                <select name="class_id" id="class_id" class="class_id form-control" >
                                    <option value="">Select Class</option>
                                    @foreach($classes as $class)
                                        <option @if(isset($class_id)) {{ $class_id == $class->id ? 'selected' :'' }} @endif value="{{ $class->id }}"> {{ $class->name }}</option>
                                    @endforeach
                                </select>
                                <div class="text-danger">{{ $errors->first('class_id') }}</div>
                            </div>
                        </div>
                        <div class="col-xs-12 col-sm-2 col-md-2">
                            <div class="form-group">
                                <label for="Session">Session :</label>
                                <select name="session_id" id="session_id" class="session_id form-control" >
                                    <option value="">Select Session</option>
                                    @foreach($sessiones as $session)
                                        <option @if(isset($session_id)) {{ $session_id == $session->id ? 'selected' :'' }} @endif value="{{ $session->id }}"> {{ $session->name }}</option>
                                    @endforeach
                                </select>
                                 <div class="text-danger">{{ $errors->first('session_id') }}</div>
                            </div>
                        </div>

                        <div class="col-xs-12 col-sm-2 col-md-2">
                            <div class="form-group">
                                <label for="Batch Setting">Batch  :</label>
                                <select name="batch_setting_id" id="batch_setting_id" class="batch_setting_id form-control" >
                                     <option  value="">Select Batch</option>
                                </select>
                                <div class="text-danger">{{ $errors->first('batch_setting_id') }}</div>
                            </div>
                        </div>
 
                        
                       
                        <div class="col-xs-12 col-sm-2 col-md-2">
                            <div class="form-group">
                                <label for="">Subject</label>
                                <select name="subject_id" id="subject_id" class="subject_id form-control" required>
                                    <option value="">Select Subject</option>
                                    @foreach ($subjects as $subject)
                                        <option {{ old('subject_id') == $subject->id ? 'selected' : '' }}
                                            value="{{ $subject->id }}">{{ $subject->name }}</option>
                                    @endforeach
                                </select>
                                <div class="text-danger">{{ $errors->first('subject_id') }}</div>
                            </div>
                        </div>


 						<div class="col-xs-12 col-sm-2 col-md-2">
                            <div class="form-group">
                                <label for="">Chapter</label>
                                <select name="chapter_id" id="chapter_id" class="chapter_id form-control">
                                     <option value="">Select Chapter</option>

                                 </select>
                                <div class="text-danger">{{ $errors->first('chapter_id') }}</div>
                            </div>
                        </div>





                        <div class="col-xs-12 col-sm-2 col-md-2">
                            <div class="form-group mb-3">

                                 <button type="button" id="search_id" class="btn btn-primary mt-3"> <i class="fa fa-search"></i> Search</button>
                            </div>
                        </div>

                         

                    </div>

 

                  <div class="row">
                    <div class="col-md-12 col-sm-12 col-xs-12 col-lg-12">
                        <hr>    
                        <div id="ShowResult"></div>
                    </div>
                  </div>

 
                










            </div>









        </div>
    </div>


      <!-- Modal -->
 <div class="modal  fade bd-example-modal-lg" id="submitted_student" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
          <div class="modal-dialog modal-lg modal-dialog-scrollable" role="document">
            <div class="modal-content">
              <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Home work Submitted Student List</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
              </div>
              <div class="modal-body">
                   <div id="submitted_student_list"></div>
              </div>
              <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                 
              </div>
            </div>
          </div>
        </div>     



        <!-- Modal -->
        <div class="modal  fade bd-example-modal-lg" id="pending_student" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
          <div class="modal-dialog modal-lg modal-dialog-scrollable" role="document">
            <div class="modal-content">
              <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Pending Home Work Student List</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
              </div>
              <div class="modal-body">
                   <div id="pending_student_list"></div>
              </div>
              <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                 
              </div>
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
            getHtmlResponse();
            
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


 

            $(document).on('change', '#subject_id', function() {

		            var subject_id = $('#subject_id').val();

		            $.ajax({
		                type: "get",
		                url: "{{ route('getchapter') }}",
		                data: {
		                    subject_id: subject_id
		                },
		                success: function(data) {
		                    if (data.status == true) {
		                        $("#chapter_id").html(data);
		                    } else {
		                        $("#chapter_id").html(data);
		                    }
		                },
		                error: function(data) {
		                    console.log('Error:', data);
		                }
		            });
		        });




             $(document).on('click','#search_id', function() {
                    getHtmlResponse();
             });


              $(document).on('change','.pagination_id_class',function(e){
                e.preventDefault();
                getHtmlResponse();
           
            });




            function getHtmlResponse()
            {
                    var class_id    = $('.class_id').val();
                    var session_id  = $('.session_id').val();
                    var batch_setting_id= $('.batch_setting_id').val();
                    var subject_id  = $('.subject_id').val();
                    var chapter_id  = $('.chapter_id').val();

 

                    $.ajax({
                            type: "get",
                            url: "{{ route('student.homework.index.ajax') }}",
                            data: {class_id:class_id,session_id:session_id,batch_setting_id:batch_setting_id,subject_id:subject_id,chapter_id:chapter_id},
                            success: function (data) {
                                if(data.status == true)
                                {
                                    $("#ShowResult").html(data);
                                }
                                else{
                                     $("#ShowResult").html(data);
                                }
                            },
                            error: function (data) {
                                console.log('Error:', data);
                            }
                        });
                      
            }


 

            function getValueFromSelectOption(className)
            {
                return $('.'+className).val();
            }

            function getValueFromInputField(className)
            {
                return $('.'+className).val();
            }
           

        //=====================================================================================


          //=====================================================================================
            $(document).on('click','.submitted_model_show',function(e){
                e.preventDefault();
                $('#submitted_student').modal('show');

                var home_work_id = $(this).data('id');

                $.ajax({
                        type: "get",
                        url: "{{ route('get.homework.submitted.student') }}",
                        data: {home_work_id:home_work_id},
                        success: function (data) {
                            $('#submitted_student_list').html(data);
                            $('#submitted_student').modal('show');
                        },
                        error: function (data) {
                            console.log('Error:', data);
                        }
                    });
                    

                
            });
            //=====================================================================================




         //=====================================================================================
            $(document).on('click','.pending_model_show',function(e){
                e.preventDefault();
                $('#pending_student').modal('show');

                var home_work_id = $(this).data('id');

                $.ajax({
                        type: "get",
                        url: "{{ route('get.homework.pending.student') }}",
                        data: {home_work_id:home_work_id},
                        success: function (data) {
                            $('#pending_student_list').html(data);
                            $('#pending_student').modal('show');
                        },
                        error: function (data) {
                            console.log('Error:', data);
                        }
                    });
                    

                
            });
            //=====================================================================================

 
            
        });
    </script>


@endsection
@endsection
