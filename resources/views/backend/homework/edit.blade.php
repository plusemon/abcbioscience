@extends('backend.layouts.app')
@section('title','Edit Home Work')
@section('content')


    <div id="content" class="content">
        <div class="panel panel-inverse">
            <div class="panel-heading">
                <h4 class="panel-title">Add New Home Work </h4>
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


                <form action="{{ route('student.homework.update',$homework->id) }}" method="post" enctype="multipart/form-data">
                   @csrf
                    <div class="row">
                        <div class="col-xs-12 col-sm-2 col-md-2">
                            <div class="form-group">
                                <label for="class">Class :</label>
                                <select name="class_id" id="class_id" class="class_id form-control" >
                                    <option value="">Select Class</option>
                                    @foreach($classes as $class)
                                        <option  {{ $homework->classes_id == $class->id ? 'selected' :'' }}  value="{{ $class->id }}"> {{ $class->name }}</option>
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
                                        <option   {{ $homework->sessiones_id == $session->id ? 'selected' :'' }}  value="{{ $session->id }}"> {{ $session->name }}</option>
                                    @endforeach
                                </select>
                                 <div class="text-danger">{{ $errors->first('session_id') }}</div>
                            </div>
                        </div>

                        <div class="col-xs-12 col-sm-2 col-md-2">
                            <div class="form-group">
                                <label for="Batch Setting">Batch  :</label>
                                <select name="batch_setting_id" id="batch_setting_idd" class="batch_setting_idd form-control" >
                                     <option  value="">Select Batch</option>
                                     <option value="{{ $homework->batch_setting_id }}" selected="">{{ $homework->batchsetting->batch_name }}</option>
                                </select>
                                <div class="text-danger">{{ $errors->first('batch_setting_id') }}</div>
                            </div>
                        </div>
 
                        
                       
                        <div class="col-xs-12 col-sm-2 col-md-2">
                            <div class="form-group">
                                <label for="">Subject</label>
                                <select name="subject_id" id="subject_id" class="form-control" required>
                                            <option value="">Select Subject</option>
                                            @foreach ($subjects as $subject)
                                                <option {{ $homework->subject_id == $subject->id ? 'selected' : '' }}
                                                    value="{{ $subject->id }}">{{ $subject->name }}</option>
                                            @endforeach
                                </select>
                                <div class="text-danger">{{ $errors->first('subject_id') }}</div>
                            </div>
                        </div>


 						<div class="col-xs-12 col-sm-2 col-md-2">
                            <div class="form-group">
                                <label for="">Chapter</label>
                                <select name="chapter_id" id="chapter_id" class="form-control">
                                     <option value="">Select Chapter</option>
                                     <option value="{{ $homework->chapter_id }}" selected="">{{ $homework->chapter->name }}</option>
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

                             <div class="col-md-12">


                                     <div class="form-group">
                                        
                                         <input type="text" name="topic" class="form-control" value="{{ $homework->topic }}" placeholder="Enter Home work Topic" required>
                                     </div> 

                                     <hr>

                                    <div class="table-responsive">
                                        <table class="table table-hovered table-bordered">
                                            <tr>
                                                <th>Checkbox</th>
                                                <th>SL</th>
                                                <th>Student ID</th>
                                                <th>Name</th>
                                                <th>Mobile</th>
                                                <th>Status</th>
                                                <th>SMS</th>
                                            </tr>

                                             @foreach($homework->homework as $homework)
                                                <tr>
                                                    <th>
        <input type="checkbox" name="homework_detail_id[]" value="{{ $homework->id }}" @if($homework->status == "0") checked="" @endif> </th>
                                                    <td>{{ $loop->iteration }}
                                                         
                                                        <input type="hidden" name="user_id[]" value="{{ $homework->student->user->id }}">
                                                        <input type="hidden" name="student_id[]" value="{{ $homework->student->id }}">
                                                    </td>
                                                    <td>
                                                        {{ $homework->student->user->useruid }}
                                                       
                                                    </td>
                                                    <td>
                                                         {{ $homework->student->user->name }}
                                                    </td>

                                                     <td>
                                                         {{ $homework->student->user->mobile }}
                                                    </td>

                                                    <td>
                                                         <select name="homework[]" id="" class="form-control">
                                                            <option value="1" @if($homework->status == "1") selected @endif class="text-success">Submitted</option>
                                                            <option value="0" @if($homework->status == "0") selected @endif class="text-danger" >Pending</option>
                                                        </select>
                                                    </td>

                                                    <td>
                                                        <select name="sms[]" id="" class="form-control">
                                                            <option value="Yes" @if($homework->status == "0") selected @endif >Yes</option>
                                                            <option @if($homework->status == "1") selected @endif value="No">No</option>
                                                        </select>
                                                    </td>   

                                                </tr>
                                            @endforeach
                                        </table>
                                        
                                      
                                         <div class="text-center">
                                         
                                           
                                            <div class="form-group">
                                                <button type="submit" class="btn btn-primary">Send Message</button>
                                            </div>
                                        </div>
                                        <br>

                                        
                                    </div>     
                                </div>
                            </div>           
                 

                  {{--   submit data for homework  --}}
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

 


            
        });
    </script>


@endsection
@endsection
