@extends('backend.layouts.app')
@section('title','Surprise Send SMS')
@section('content')


    <div id="content" class="content">
        <div class="panel panel-inverse">
            <div class="panel-heading">
                <h4 class="panel-title">Surprise Send SMS</h4>
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
                <form action="{{ route('subject.store') }}" method="post">
                    @CSRF
                    
 
                    <div class="form-group">
                        <label for="message" class="col-sm-12 control-label">Class</label>
                        <div class="col-sm-12">
                             <select name="class_id" id="class_id" class="class_id form-control" >
                                    <option value="">Select Class</option>
                                    @foreach($classes as $class)
                                        <option {{ old('class_id') == $class->id ? 'selected' :'' }} value="{{ $class->id }}"> {{ $class->name }}</option>
                                    @endforeach
                            </select>
                            <span class="text-danger">{{ $errors->first('class_id') }}</span>
                             
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="message" class="col-sm-12 control-label">Session</label>
                        <div class="col-sm-12">
                                <select name="session_id" id="session_id" class="session_id form-control" >
                                    <option value="">Select Session</option>
                                    @foreach($sessiones as $session)
                                        <option {{ old('session_id') == $session->id ? 'selected' :'' }} value="{{ $session->id }}"> {{ $session->name }}</option>
                                    @endforeach
                                </select>
                            <span class="text-danger">{{ $errors->first('session_id') }}</span>
                             
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="message" class="col-sm-12 control-label">Batch</label>
                        <div class="col-sm-12">
                                <select name="batch_setting_id" id="batch_setting_id" class="batch_setting_id form-control" >
                                     <option  value="">Select Batch</option>
                                </select>
                            <span class="text-danger">{{ $errors->first('session_id') }}</span>
                             
                        </div>
                    </div>


                    <div class="form-group">
                        <style type="text/css">
                             span{
                                padding: 0 10px;
                             }   
                        </style>
                         <div class="col-sm-12 ">
                            <p><span><input type="checkbox" name=""></span>Check all</p>
                            <ul>
                                
                           
                            <div class="surprisesms">
                                
                            </div>

                             </ul>
                             
                              
                         </div>
                    </div>

                    <div class="form-group">
                        <label for="message" class="col-sm-12 control-label">Message</label>
                        <div class="col-sm-12">
                             <textarea name="message" id="message"  class="form-control" rows="10" placeholder="Write sms here"></textarea>
                            <span class="text-danger">{{ $errors->first('message') }}</span>

                            <ul id="sms-counter" class="list-unstyled pt-4">
                              <li>Length: <span class="length"></span></li>
                              <li>Messages: <span class="messages"></span></li>
                              <li>Per Message: <span class="per_message"></span></li>
                              <li>Remaining: <span class="remaining"></span></li>
                            </ul>
                             
                             
                        </div>
                    </div>

                     

                    <button type="submit" class="btn btn-primary mt-3">Submit</button>
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


  $(document).on('change','.batch_setting_id', function () {

                var class_id          = $('.class_id').val();
                var session_id        = $('.session_id').val();
                var batch_setting_id  = $('.batch_setting_id').val();


                  $.ajax({
                        type: "get",
                        url: "{{ route('getbatchstudentforsms') }}",
                        data: {class_id:class_id,session_id:session_id,batch_setting_id:batch_setting_id},
                        success: function (data) {
                            if(data.status == true)
                            {
                                $(".surprisesms").html(data);
                            }else{
                                $(".surprisesms").html(data);
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
