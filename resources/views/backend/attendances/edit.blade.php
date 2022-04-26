@extends('backend.layouts.app')
@section('title','Edit Student Attendance')
@section('content')


    <div id="content" class="content">
        <div class="panel panel-inverse">
            <div class="panel-heading">
                <h4 class="panel-title">Edit Student Attendance </h4>
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


                <form action="" method="get" enctype="multipart/form-data">
                   
                    <div class="row">
                        <div class="col-xs-12 col-sm-2 col-md-2">
                            <div class="form-group">
                                <label for="class">Class :</label>
                                <select name="class_id" id="class_id" class="class_id form-control" disabled="">
                                    <option value="">Select Class</option>
                                    @foreach($classes as $class)
                                        <option  {{ $attendance->classes_id == $class->id ? 'selected' :'' }} value="{{ $class->id }}"> {{ $class->name }}</option>
                                    @endforeach
                                </select>
                                <div class="text-danger">{{ $errors->first('class_id') }}</div>
                            </div>
                        </div>
                        <div class="col-xs-12 col-sm-2 col-md-2">
                            <div class="form-group">
                                <label for="Session">Session :</label>
                                <select name="session_id" id="session_id" class="session_id form-control" disabled>
                                    <option value="">Select Session</option>
                                    @foreach($sessiones as $session)
                                        <option {{ $attendance->sessiones_id == $session->id ? 'selected' :'' }} value="{{ $session->id }}"> {{ $session->name }}</option>
                                    @endforeach
                                </select>
                                 <div class="text-danger">{{ $errors->first('session_id') }}</div>
                            </div>
                        </div>

                        <div class="col-xs-12 col-sm-2 col-md-2">
                            <div class="form-group">
                                <label for="Batch Setting">Batch  :</label>
                                <select name="batch_setting_id" id="batch_setting_id" class="batch_setting_id form-control" disabled>
                                     <option  value="">Select Batch</option>
                                     <option  value="{{ $attendance->batchsetting?$attendance->batchsetting->id:'' }}" selected>{{ $attendance->batchsetting?$attendance->batchsetting->batch_name:'' }}</option>
                                    
                                </select>
                                <div class="text-danger">{{ $errors->first('batch_setting_id') }}</div>
                            </div>
                        </div>
 
                        
                         
                        <div class="col-xs-12 col-sm-2 col-md-2">
                            <div class="form-group">
                                <label for="">Date of Attendance</label>
                                <input type="date" name="attendance_date" class="form-control"  value="{{ $attendance->attendance_date }}"   disabled>
                                 <div class="text-danger">{{ $errors->first('attendance_date') }}</div>
                            </div>
                        </div>





                        <div class="col-xs-12 col-sm-2 col-md-2">
                        	<div class="form-group mb-3 pt-2">

                                 <button type="submit" class="btn btn-primary mt-3 disabled "> <i class="fa fa-search"></i> Search</button>
                        	</div>
                        </div>
                    </div>
                </form>

            
                <div class="row">

                	<div class="col-md-12">
                		<h4>Student Attendance</h4>
                	</div>
                	<div class="col-md-12">
                		<form action="{{ route('student.attendance.update',$attendance->id) }}" method="post">
                			@csrf
		                	<div class="table-responsive">
			                	<table class="table table-hovered table-bordered">
			                		<tr>
                                        <th>ID</th>
                                        
			                			<th>Student ID</th>
			                			<th>Name</th>
                                        <th>Class</th>
                                        <th>Batch</th>
			                			<th>Action</th>
			                			<th>SMS </th>
			                		 
			                		</tr>

			                		@foreach($attendance->attendancedetail as $student)
			                		 <tr>
                                        <td>{{ $loop->iteration }}</td>
			                		 	
                                       
			                		 	<td>{{  $student->student->user->useruid }}</td>
                                        <td>{{  $student->student->user->name }}</td>
                                        <td>{{  $student->student->classes->name }}</td>
                                        <td>{{  $student->student->batchsetting->batch_name }}</td>

                                        <td>
                                            <input type="hidden" value="{{ $attendance->classes_id }}" name="classes_id">
                                            <input type="hidden" value="{{ $attendance->sessiones_id }}" name="sessiones_id">
                                            <input type="hidden" value="{{ $attendance->batch_setting_id }}" name="batch_setting_id">
                                            <input type="hidden" value="{{ $attendance->attendance_date }}" name="attendance_date">
                                            <select name="attendance[]" id="" class="form-control {{ $student->attendance == "Absent" ? 'text-danger' : '' }} ">
                                                <option {{ $student->attendance == "Present" ? 'selected' : '' }} value="Present">Present</option>
                                                <option {{ $student->attendance == "Absent" ? 'selected' : '' }} value="Absent">Absent</option>
                                            </select>
                                            <input type="hidden" value="{{ $student->student_id }}" name="student[]">
                                        </td>
                                         <td>
                                             <select name="sms[]" id="" class="form-control">
                                                <option value="Yes" @if($student->attendance == "Absent") selected @endif >Yes</option>
                                                <option @if($student->attendance == "Present") selected @endif value="No">No</option>
                                            </select>
                                        </td>
                                         
			                		 	 
			                		</tr>
			                		@endforeach
			                	</table>

			                	<button class="btn btn-primary btn-sm">Submit</button>
		                	</div>
                		</form>
				</div>

                </div>
            
 










            </div>









        </div>
    </div>






 
@endsection
