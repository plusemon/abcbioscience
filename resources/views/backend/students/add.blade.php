@extends('backend.layouts.app')
@section('title', 'Add New Student')
@section('content')


    <div id="content" class="content">
        <div class="panel panel-inverse">
            <div class="panel-heading">
                <h4 class="panel-title">Add New Student </h4>
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
                        @if (is_array(session('error')))
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
                
                @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif


                <form action="{{ route('student.store') }}" method="post" enctype="multipart/form-data">
                    @CSRF

                     <div class="row">
                         <div class="col-xs-12 col-sm-6 col-md-4">
                             <div class="form-group">
                                <label for="student_type">Student User Type</label>
                                <select name="student_type" id="student_type" class="form-control" required>
                                    <option  value="">Select Type</option>
                                    <option {{ old('student_type') == 1 ? 'selected' : '' }} value="1">New User</option>
                                    <option {{ old('student_type') == 2 ? 'selected' : '' }} value="2">Existing </option>
                                </select>
                            </div>
                         </div> 

                         <div class="col-xs-12 col-sm-6 col-md-4 userdiv">
                             <div class="form-group">
                                <label for="status">Non Enroll Student User</label>
                                <select name="user_id" id="status" class="form-control select2">
                                    <option value="">Select User</option>
                                         @foreach ($studentusers as $user)
                                            @if ($user->activestudents->count() ==  0)
                                            <option value="{{ $user->id }}">{{ $user->useruid }} -  {{ $user->name }} - {{ $user->mobile }} </option>}
                                            @endif
                                        @endforeach
                                </select>
                            </div>
                         </div>


                        <div class="col-xs-12 col-sm-6 col-md-4 namediv">
                            <div class="form-group">
                                <label for="">Name <span class="text-danger">*</span></label>
                                <input type="text" name="name" value="{{ old('name') }}" class="form-control"
                                    placeholder="Student Name">
                                <div class="text-danger">{{ $errors->first('name') }}</div>
                            </div>
                        </div>
                        <div class="col-xs-12 col-sm-6 col-md-4 emaildiv">
                            <div class="form-group">
                                <label for="">Email Address</label>
                                <input type="text" name="email" value="{{ old('email') }}" class="form-control"
                                    placeholder="Email">
                                <div class="text-danger">{{ $errors->first('email') }}</div>
                            </div>
                        </div>
                        <div class="col-xs-12 col-sm-6 col-md-4 mobilediv">
                            <div class="form-group">
                                <label for="">Mobile No <span class="text-danger">*</span></label>
                                <input type="text" name="mobile" value="{{ old('mobile') }}" class="form-control"
                                    placeholder="Student Mobile No">
                                <div class="text-danger">{{ $errors->first('mobile') }}</div>
                            </div>
                        </div>
                    </div>

                    <hr />

                    <div class="row">
                        <div class="col-xs-12 col-sm-6 col-md-3">
                            <div class="form-group">
                                <label for="school">Father Name :</label>
                                <input type="text" name="father" id="father" value="{{ old('father') }}"
                                    class="form-control" placeholder="Enter Father Name">
                                <div class="text-danger">{{ $errors->first('father') }}</div>
                            </div>
                        </div>
                        <div class="col-xs-12 col-sm-6 col-md-3">
                            <div class="form-group">
                                <label for="school">Mother Name :</label>
                                <input type="text" name="mother" id="mother" value="{{ old('mother') }}"
                                    class="form-control" placeholder="Enter Mother Name">
                                <div class="text-danger">{{ $errors->first('mother') }}</div>
                            </div>
                        </div>

                        <div class="col-xs-12 col-sm-6 col-md-3">
                            <div class="form-group">
                                <label for="school">Guardian Mobile : <span class="text-danger">*</span></label>
                                <input type="text" name="guardianmobile" id="guardianmobile"
                                    value="{{ old('guardianmobile') }}" class="form-control"
                                    placeholder="Enter guardian mobile number" required>
                                <div class="text-danger">{{ $errors->first('guardianmobile') }}</div>
                            </div>
                        </div>


                        <div class="col-xs-12 col-sm-6 col-md-3">
                            <div class="form-group">
                                <label for="school">Whats app number :</label>
                                <input type="text" name="whatsapp_number" id="whatsapp_number"
                                    value="{{ old('whatsapp_number') }}" class="form-control"
                                    placeholder="Enter Whats app number">
                                <div class="text-danger">{{ $errors->first('whatsapp_number') }}</div>
                            </div>
                        </div>
                        <div class="col-xs-12 col-sm-6 col-md-3">
                            <div class="form-group">
                                <label for="school">Facebook ID Link :</label>
                                <input type="text" name="facebook_id" id="facebook_id" value="{{ old('facebook_id') }}"
                                    class="form-control" placeholder="Enter Facebook ID Link">
                                <div class="text-danger">{{ $errors->first('facebook_id') }}</div>
                            </div>
                        </div>

                        <div class="col-xs-12 col-sm-6 col-md-3">
                            <div class="form-group">
                                <label for="school">Bkash Number :</label>
                                <input type="text" name="bkash_number" id="bkash_number"
                                    value="{{ old('bkash_number') }}" class="form-control"
                                    placeholder="Enter Bkash Number">
                                <div class="text-danger">{{ $errors->first('bkash_number') }}</div>
                            </div>
                        </div>




                        <div class="col-xs-12 col-sm-6 col-md-3">
                            <div class="form-group">
                                <label for="school">Address:</label>
                                <input type="text" name="address" id="address" value="{{ old('address') }}"
                                    class="form-control" placeholder="Enter address">
                                <div class="text-danger">{{ $errors->first('address') }}</div>
                            </div>
                        </div>

                        <div class="col-xs-12 col-sm-6 col-md-3">
                            <div class="form-group">
                                <label for="school">Note:</label>
                                <input type="text" name="note" id="note" value="{{ old('note') }}" class="form-control"
                                    placeholder="Enter Note">
                                <div class="text-danger">{{ $errors->first('note') }}</div>
                            </div>
                        </div>
                        <div class="col-xs-12 col-sm-6 col-md-3">
                            <div class="form-group">
                                <label for="school">Images:</label>
                                <input type="file" name="image" id="image" value="{{ old('image') }}"
                                    class="form-control" placeholder="Enter image">
                                <div class="text-danger">{{ $errors->first('image') }}</div>
                            </div>
                        </div>
                        <div class="col-xs-12 col-sm-6 col-md-3">
                            <div class="form-group">
                                <label for="status">Status</label>
                                <select name="status" id="status" class="form-control" required>
                                    <option {{ old('status') == 1 ? 'selected' : '' }} value="1">Active</option>
                                    <option {{ old('status') == 2 ? 'selected' : '' }} value="2">inactive</option>
                                </select>

                            </div>
                        </div>
                    </div>
                    <hr />

                    <div class="row">
                        <div class="col-xs-12 col-sm-3 col-md-3">
                            <div class="form-group">
                                <label for="class">Class : <span class="text-danger">*</span></label>
                                <select name="class_id" id="class_id" class="class_id form-control">
                                    <option value="">Select Class</option>
                                    @foreach ($classes as $class)
                                        <option {{ old('class_id') == $class->id ? 'selected' : '' }}
                                            value="{{ $class->id }}"> {{ $class->name }}</option>
                                    @endforeach
                                </select>
                                <div class="text-danger">{{ $errors->first('class_id') }}</div>
                            </div>
                        </div>
                        <div class="col-xs-12 col-sm-3 col-md-3">
                            <div class="form-group">
                                <label for="Session">Session : <span class="text-danger">*</span></label>
                                <select name="session_id" id="session_id" class="session_id form-control">
                                    <option value="">Select Session</option>
                                    @foreach ($sessiones as $session)
                                        <option {{ old('session_id') == $session->id ? 'selected' : '' }}
                                            value="{{ $session->id }}"> {{ $session->name }}</option>
                                    @endforeach
                                </select>
                                <div class="text-danger">{{ $errors->first('session_id') }}</div>
                            </div>
                        </div>

                        <div class="col-xs-12 col-sm-3 col-md-3">
                            <div class="form-group">
                                <label for="Batch Setting">Batch : <span class="text-danger">*</span></label>
                                <select name="batch_setting_id" id="batch_setting_id" class="batch_setting_id form-control">
                                    <option value="">Select Batch</option>
                                </select>
                                <div class="text-danger">{{ $errors->first('batch_setting_id') }}</div>
                            </div>
                        </div>

                        <div class="col-xs-12 col-sm-6 col-md-3">
                            <div class="form-group">
                                <label for="">Batch Type: <span class="text-danger">*</span></label>
                                <select name="batch_type_id" id="batch_type_id" class="batch_type_id form-control">
                                    <option value="">Select Batch Type</option>
                                    @foreach ($batchTypes as $type)
                                        <option value="{{ $type->id }}">{{ $type->name }}</option>
                                    @endforeach
                                </select>
                                <div class="text-danger">{{ $errors->first('batch_type_id') }}</div>
                            </div>
                        </div>

                        <div class="col-xs-12 col-sm-3 col-md-3">
                            <div class="form-group">
                                <label for="Batch Setting">Section :</label>
                                <select name="section_id" id="section_id" class="form-control">
                                    <option value="">Select Section</option>
                                    @foreach ($sectiones as $section)
                                        <option {{ old('section_id') == $section->id ? 'selected' : '' }}
                                            value="{{ $section->id }}">{{ $section->name }}</option>
                                    @endforeach
                                </select>
                                <div class="text-danger">{{ $errors->first('section_id') }}</div>
                            </div>
                        </div>


                        <div class="col-xs-12 col-sm-6 col-md-3">
                            <div class="form-group">
                                <label for="">Roll</label>
                                <input type="text" name="roll" value="{{ old('roll') }}" class="form-control"
                                    placeholder="Roll">
                                <div class="text-danger">{{ $errors->first('roll') }}</div>
                            </div>
                        </div>

                        <div class="col-xs-12 col-sm-6 col-md-3">
                            <div class="form-group">
                                <label for="">Admission Date: <span class="text-danger">*</span></label>
                                <input type="date" name="admission_date" value="{{ old('admission_date') }}"
                                    class="form-control" placeholder="Admission Date">
                                <div class="text-danger">{{ $errors->first('admission_date') }}</div>
                            </div>
                        </div>

                        <div class="col-xs-12 col-sm-6 col-md-3">
                            <div class="form-group">
                                <label for="">Month <span class="text-danger">*</span></label>
                                <select name="month_id" id="month_id" class="form-control">
                                    <option value="">Select Month</option>
                                    @foreach ($months as $month)
                                        <option {{ old('month_id') == $month->id ? 'selected' : '' }}
                                            value="{{ $month->id }}">{{ $month->name }}</option>
                                    @endforeach
                                </select>
                                <div class="text-danger">{{ $errors->first('month_id') }}</div>
                            </div>
                        </div>

                        <div class="col-xs-12 col-sm-6 col-md-4">
                            <div class="form-group">
                                <label for="">School</label>
                                <input type="text" name="school_name" value="{{ old('school_name') }}"
                                    class="form-control" placeholder="Enter Student School Name">
                                <div class="text-danger">{{ $errors->first('school_name') }}</div>
                            </div>
                        </div>
                    </div>
                    <button type="submit" class="btn btn-primary mt-3">Submit</button>
                </form>
            </div>









        </div>
    </div>







@section('customjs')

    <script>
        $(document).ready(function() {
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            
            
            
            $('.userdiv').hide();
            $('.namediv').hide();
            $('.emaildiv').hide();
            $('.mobilediv').hide();


            $('#student_type').on('change',function()
            {
                var student_type = $('#student_type').val();

                if(student_type==1)
                {
                    $('.userdiv').hide();
                    $('.namediv').show();
                    $('.emaildiv').show();
                    $('.mobilediv').show();
                }
                else if(student_type==2)
                {
                    $('.userdiv').show();
                    $('.namediv').hide();
                    $('.emaildiv').hide();
                    $('.mobilediv').hide();
                }
                else{
                    $('.userdiv').hide();
                    $('.namediv').hide();
                    $('.emaildiv').hide();
                    $('.mobilediv').hide();
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


@endsection
@endsection
