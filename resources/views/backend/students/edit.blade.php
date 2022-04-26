@extends('backend.layouts.app')
@section('title','Edit Student')
@section('content')


    <div id="content" class="content">
        <div class="panel panel-inverse">
            <div class="panel-heading">
                <h4 class="panel-title">Edit Student  </h4>
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


                <form action="{{ route('student.update',$student->id) }}" method="post" enctype="multipart/form-data">
                    @CSRF

                    <div class="row">



                        <div class="col-xs-12 col-sm-6 col-md-4">
                            <div class="form-group">
                                <label for="">Name</label>
                                <input type="text" name="name" value="{{ $student->user->name }}" class="form-control" placeholder="Student Name" required>
                                <div class="text-danger">{{ $errors->first('name') }}</div>
                            </div>
                        </div>

                        <div class="col-xs-12 col-sm-6 col-md-4">
                            <div class="form-group">
                                <label for="class">Class :</label>
                                <select name="class_id" id="classes_id" class="class_id form-control" required>
                                    <option value="">Select Class</option>
                                    @foreach($classes as $class)
                                        <option {{ $student->class_id == $class->id ? 'selected' :'' }} value="{{ $class->id }}"> {{ $class->name }}</option>
                                    @endforeach
                                </select>
                                <div class="text-danger">{{ $errors->first('class_id') }}</div>
                            </div>
                        </div>
                        <div class="col-xs-12 col-sm-6 col-md-4">
                            <div class="form-group">
                                <label for="Session">Session :</label>
                                <select name="session_id" id="sessiones_id" class="session_id form-control" required>
                                    <option value="">Select Session</option>
                                    @foreach($sessiones as $session)
                                        <option {{ $student->session_id == $session->id ? 'selected' :'' }} value="{{ $session->id }}"> {{ $session->name }}</option>
                                    @endforeach
                                </select>
                                 <div class="text-danger">{{ $errors->first('session_id') }}</div>
                            </div>
                        </div>

                        <div class="col-xs-12 col-sm-6 col-md-4">
                            <div class="form-group">
                                <label for="Batch Setting">Batch  : ({{ $student->batchsetting?$student->batchsetting->batch_name:'' }})</label>
                                <select name="batch_setting_id" id="batch_setting_id" class="batch_setting_id form-control" required>
                                    <option  value="">Select Batch</option>
                                </select>
                                <div class="text-danger">{{ $errors->first('batch_setting_id') }}</div>
                            </div>
                        </div>


                        <div class="col-xs-12 col-sm-6 col-md-4">
                            <div class="form-group">
                                <label for="Batch Setting">Batch Type  :</label>
                                <select name="batch_type_id" id="batch_type_id" class="form-control">
                                     <option value="">Select Section</option>
                                     @foreach($batchtypies as $type)
                                     <option {{ $student->batch_type_id == $type->id ? 'selected' :'' }} value="{{ $type->id }}">{{ $type->name }}</option>
                                     @endforeach
                                </select>
                                <div class="text-danger">{{ $errors->first('batch_type_id') }}</div>
                            </div>
                        </div>



                        <div class="col-xs-12 col-sm-6 col-md-4">
                            <div class="form-group">
                                <label for="">Roll</label>
                                <input type="text" name="roll" value="{{ $student->roll }}" class="form-control" placeholder="Roll">
                                 <div class="text-danger">{{ $errors->first('roll') }}</div>
                            </div>
                        </div> 

                        <div class="col-xs-12 col-sm-6 col-md-3">
                            <div class="form-group">
                                <label for="">Admission Date</label>
                                <input type="date" name="admission_date" value="{{ $student->admission_date }}" class="form-control" placeholder="Admission Date" required>
                                 <div class="text-danger">{{ $errors->first('admission_date') }}</div>
                            </div>
                        </div> 

                        <div class="col-xs-12 col-sm-6 col-md-3">
                            <div class="form-group">
                                <label for="">Month</label>
                                 <select name="start_month_id" id="start_month_id" class="form-control" required>
                                     <option value="">Select Month</option>
                                     @foreach($months as $month)
                                     <option {{ $student->start_month_id == $month->id ? 'selected' : '' }} value="{{ $month->id }}">{{ $month->name }}</option>
                                     @endforeach
                                </select>
                                 <div class="text-danger">{{ $errors->first('start_month_id') }}</div>
                            </div>
                        </div>
                        <div class="col-xs-12 col-sm-6 col-md-3">
                            <div class="form-group">
                                <label for="">Student Type</label>
                                 <select name="student_type_id" id="student_type_id" class="form-control" required>
                                     <option value="">Select Student Type {{ $student->student_type_id  }} </option>
                                     @foreach($student_typies as $student_type)
                                     <option  {{ $student->student_type_id == $student_type->id ? 'selected' : '' }} value="{{ $student_type->id }}">{{ $student_type->name }}</option>
                                     @endforeach
                                </select>
                                 <div class="text-danger">{{ $errors->first('student_type_id') }}</div>
                            </div>
                        </div>
                        <div class="col-xs-12 col-sm-6 col-md-3">
                            <div class="form-group">
                                <label for="">Activate Status</label>
                                 <select name="activate_status" id="activate_status" class="form-control" required>
                                     <option value="">Select Student Type</option>
                                     <option {{$student->activate_status == 1 ?'selected' : ''}} value="1">Active</option>
                                     <option {{$student->activate_status == 2 ?'selected' : ''}} value="2">Deactive</option>
                                </select>
                                 <div class="text-danger">{{ $errors->first('activate_status') }}</div>
                            </div>
                        </div>
                        <div class="col-xs-12 col-sm-6 col-md-4">
                            <div class="form-group">
                                <label for="">School</label>
                                <input type="text" name="school_name" value="{{  $student->school_name }}" class="form-control" placeholder="Enter Student School Name">
                                  <div class="text-danger">{{ $errors->first('school_name') }}</div>
                            </div>
                        </div>


                    </div>
                    <hr><br/><br/>
                    

                    @if($datacount==0)

                     <div class="row">
                        <div class="col-xs-12 col-sm-6 col-md-3">
                            <div class="form-group">
                                <label for="school">Father Name :</label>
                                <input type="text" name="father" id="father" value="{{ old('father') }}" class="form-control" placeholder="Enter Father Name">
                                 <div class="text-danger">{{ $errors->first('father') }}</div>
                            </div>
                        </div>
                        <div class="col-xs-12 col-sm-6 col-md-3">
                            <div class="form-group">
                                <label for="school">Mother Name :</label>
                                <input type="text" name="mother" id="mother" value="{{  old('mother') }}" class="form-control" placeholder="Enter Mother Name">
                                 <div class="text-danger">{{ $errors->first('mother') }}</div>
                            </div>
                        </div>

                        <div class="col-xs-12 col-sm-6 col-md-3">
                            <div class="form-group">
                                <label for="school">Guardian Mobile  :</label>
                                <input type="text" name="guardianmobile" id="guardianmobile" value="{{ old('guardian_mobile') }}" class="form-control" placeholder="Enter guardian mobile number">
                                 <div class="text-danger">{{ $errors->first('guardianmobile') }}</div>
                            </div>
                        </div>

                        <div class="col-xs-12 col-sm-6 col-md-3">
                            <div class="form-group">
                                <label for="school">Student Mobile  :</label>
                                <input type="text" name="ownmobile" id="ownmobile" value="{{ old('own_mobile') }}" class="form-control" placeholder="Enter own mobile number" >
                                 <div class="text-danger">{{ $errors->first('ownmobile') }}</div>
                            </div>
                        </div>

                        <div class="col-xs-12 col-sm-6 col-md-3">
                            <div class="form-group">
                                <label for="school">Whats app number :</label>
                                <input type="text" name="whatsapp_number" id="whatsapp_number" value="{{ old('whatsapp_number') }}" class="form-control" placeholder="Enter Whats app number">
                                 <div class="text-danger">{{ $errors->first('whatsapp_number') }}</div>
                            </div>
                        </div>
                        <div class="col-xs-12 col-sm-6 col-md-3">
                            <div class="form-group">
                                <label for="school">Facebook ID Link :</label>
                                <input type="text" name="facebook_id" id="facebook_id" value="{{ old('facebook_id') }}" class="form-control" placeholder="Enter Facebook ID Link">
                                 <div class="text-danger">{{ $errors->first('facebook_id') }}</div>
                            </div>
                        </div>

                        <div class="col-xs-12 col-sm-6 col-md-3">
                            <div class="form-group">
                                <label for="school">Bkash Number  :</label>
                                <input type="text" name="bkash_number" id="bkash_number" value="{{ old('bkash_number') }}" class="form-control" placeholder="Enter Bkash Number">
                                 <div class="text-danger">{{ $errors->first('bkash_number') }}</div>
                            </div>
                        </div>

                        <div class="col-xs-12 col-sm-6 col-md-3">
                            <div class="form-group">
                                <label for="school">Email Address  :</label>
                                <input type="text" name="email" id="email" value="{{ old('email') }}" class="form-control" placeholder="Enter Email Address">
                                 <div class="text-danger">{{ $errors->first('email') }}</div>
                            </div>
                        </div> 


                        <div class="col-xs-12 col-sm-6 col-md-3">
                            <div class="form-group">
                                <label for="school">Address:</label>
                                <input type="text" name="address" id="address" value="{{ old('address') }}" class="form-control" placeholder="Enter address">
                                 <div class="text-danger">{{ $errors->first('address') }}</div>
                            </div>
                        </div> 

                        <div class="col-xs-12 col-sm-6 col-md-3">
                            <div class="form-group">
                                <label for="school">Note:</label>
                                <input type="text" name="note" id="note" value="{{ old('notes') }}" class="form-control" placeholder="Enter Note">
                                 <div class="text-danger">{{ $errors->first('note') }}</div>
                            </div>
                        </div>


                        {{--  <div class="col-xs-12 col-sm-6 col-md-3">
                            <div class="form-group">
                                <label for="school">Images:</label>
                                <input type="file" name="image" id="image" value="{{ old('image') }}" class="form-control" placeholder="Enter image">
                                 <div class="text-danger">{{ $errors->first('image') }}</div>
                            </div>
                        </div>  --}}
 
  
                        <div class="col-xs-12 col-sm-6 col-md-3">
                            <div class="form-group">
                                <label for="status">Status</label>
                                <select name="status" id="status" class="form-control" required>
                                    <option {{ old('status') == 1 ? 'selected' : '' }} value="1">Active</option>
                                    <option {{ old('status') == 2 ? 'selected' : ''  }} value="2">Inactive</option>
                                </select>
                            </div>
                        </div>
                    </div>



                    @else

                     <div class="row">
                        <div class="col-xs-12 col-sm-6 col-md-3">
                            <div class="form-group">
                                <label for="school">Father Name :</label>
                                <input type="text" name="father" id="father" value="{{ $studentinfo->father }}" class="form-control" placeholder="Enter Father Name">
                                 <div class="text-danger">{{ $errors->first('father') }}</div>
                            </div>
                        </div>
                        <div class="col-xs-12 col-sm-6 col-md-3">
                            <div class="form-group">
                                <label for="school">Mother Name :</label>
                                <input type="text" name="mother" id="mother" value="{{  $studentinfo->mother }}" class="form-control" placeholder="Enter Mother Name">
                                 <div class="text-danger">{{ $errors->first('mother') }}</div>
                            </div>
                        </div>

                        <div class="col-xs-12 col-sm-6 col-md-3">
                            <div class="form-group">
                                <label for="school">Guardian Mobile  :</label>
                                <input type="text" name="guardianmobile" id="guardianmobile" value="{{ $studentinfo->guardian_mobile }}" class="form-control" placeholder="Enter guardian mobile number">
                                <div class="text-danger">{{ $errors->first('guardianmobile') }}</div>
                            </div>
                        </div>

                        <div class="col-xs-12 col-sm-6 col-md-3">
                            <div class="form-group">
                                <label for="school">Student Mobile  :</label>
                                <input type="text" name="ownmobile" id="ownmobile" value="{{ $studentinfo->own_mobile }}" class="form-control" placeholder="Enter own mobile number" >
                                 <div class="text-danger">{{ $errors->first('ownmobile') }}</div>
                            </div>
                        </div>

                        <div class="col-xs-12 col-sm-6 col-md-3">
                            <div class="form-group">
                                <label for="school">Whats app number :</label>
                                <input type="text" name="whatsapp_number" id="whatsapp_number" value="{{ $studentinfo->whatsapp_number }}" class="form-control" placeholder="Enter Whats app number">
                                 <div class="text-danger">{{ $errors->first('whatsapp_number') }}</div>
                            </div>
                        </div>
                        <div class="col-xs-12 col-sm-6 col-md-3">
                            <div class="form-group">
                                <label for="school">Facebook ID Link :</label>
                                <input type="text" name="facebook_id" id="facebook_id" value="{{ $studentinfo->facebook_id }}" class="form-control" placeholder="Enter Facebook ID Link">
                                 <div class="text-danger">{{ $errors->first('facebook_id') }}</div>
                            </div>
                        </div>

                        <div class="col-xs-12 col-sm-6 col-md-3">
                            <div class="form-group">
                                <label for="school">Bkash Number  :</label>
                                <input type="text" name="bkash_number" id="bkash_number" value="{{ $studentinfo->bkash_number }}" class="form-control" placeholder="Enter Bkash Number">
                                 <div class="text-danger">{{ $errors->first('bkash_number') }}</div>
                            </div>
                        </div>

                        <div class="col-xs-12 col-sm-6 col-md-3">
                            <div class="form-group">
                                <label for="school">Email Address  :</label>
                                <input type="text" name="email" id="email" value="{{ $studentinfo->email }}" class="form-control" placeholder="Enter Email Address">
                                 <div class="text-danger">{{ $errors->first('email') }}</div>
                            </div>
                        </div> 


                        <div class="col-xs-12 col-sm-6 col-md-3">
                            <div class="form-group">
                                <label for="school">Address:</label>
                                <input type="text" name="address" id="address" value="{{ $studentinfo->address }}" class="form-control" placeholder="Enter address">
                                 <div class="text-danger">{{ $errors->first('address') }}</div>
                            </div>
                        </div> 

                        <div class="col-xs-12 col-sm-6 col-md-3">
                            <div class="form-group">
                                <label for="school">Note:</label>
                                <input type="text" name="note" id="note" value="{{ $studentinfo->notes }}" class="form-control" placeholder="Enter Note">
                                 <div class="text-danger">{{ $errors->first('note') }}</div>
                            </div>
                        </div>


                        {{--  <div class="col-xs-12 col-sm-6 col-md-3">
                            <div class="form-group">
                                <label for="school">Images:</label>
                                <input type="file" name="image" id="image" value="{{ old('image') }}" class="form-control" placeholder="Enter image">
                                 <div class="text-danger">{{ $errors->first('image') }}</div>
                            </div>
                        </div>  --}}
 
  
                        <div class="col-xs-12 col-sm-6 col-md-3">
                            <div class="form-group">
                                <label for="status">Status</label>
                                <select name="status" id="status" class="form-control" >
                                    <option {{ $student->status == 1 ? 'selected' : '' }} value="1">Active</option>
                                    <option {{ $student->status == 2 ? 'selected' : ''  }} value="2">Inactive</option>
                                </select>
                            </div>
                        </div>
                    </div>

                    @endif

                    <button type="submit" class="btn btn-primary mt-3">Update</button>

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
            var class_id    = $('.class_id option:selected').val();
            var session_id  = $('.session_id option:selected').val();
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



         $('#sessiones_id').on('change', function () {
        
              var classes_id    = $('#classes_id').val();
              var sessiones_id  = $('#sessiones_id').val();
              
               
                $.ajax({
                    type: "get",
                    url: "{{ route('get.batch.setting') }}",
                    data: {classes_id:classes_id,sessiones_id:sessiones_id},
                    success: function (data) {
                         $("#batch_setting_id").html(data);
                    },
                    error: function (data) {
                        console.log('Error:', data);
                    }
                });
            }); 
        });
    </script>
    
    
@endsection
@endsection
