@extends('backend.layouts.app')
@section('title','Student Attendance List')
@section('content')


    <div id="content" class="content">
        <div class="panel panel-inverse">
            <div class="panel-heading">
                <h4 class="panel-title">Student Attendance List</h4>
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






                    <form  class="form-inline" method="get">
 
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

                         <select name="batch_setting_id" id="batch_setting_id" class="batch_setting_id form-control mr-3" >
                             <option  value="">Select Batch</option>
                        </select>

                        <input type="date" name="attendance_date" class="form-control" @if(isset($attendance_date)) value="{{ $attendance_date }}" @endif>
                                 



                        <button type="submit" class="btn btn-primary btn-sm" id="search_id"> <i class="fa fa-search"></i>  Search</button>
                        
                    </form>


                    <select name="pagination" id="pagination_id" class="pagination_id_class btn btn-primary btn-sm mt-4">
                            <option value="50">50</option>
                            <option value="10">10</option>
                            <option value="15">15</option>
                            <option value="30">30</option>
                            <option value="100">100</option>
                            <option value="500">500</option>
                            <option value="all_data">All Data</option>
                    </select>
                    
                        
                    <hr>

                     <div class="table-responsive">

                         <table class="table table-hovered table-bordered">
                             <thead>
                                 <tr>
                                     <th>Serial</th>
                                     <th>Date & Time</th>
                                     <th>Class</th>
                                     <th>Session</th>
                                     <th>Batch</th>
                                     <th>Class Type</th>
                                     <th>Total Student</th>
                                     <th>Total Present</th>
                                     <th>Total Absent</th>
                                     <th>Action</th>
                                 </tr>
                             </thead>
                             <tbody>
                                @foreach($attendances as $attendance)
                                 <tr>
                                     <td>{{ $loop->iteration }}</td>
                                     <td>    {{ date('d-m-Y h:i A',strtotime($attendance->attendance_date)) }} </td>
                                     <td>{{ $attendance->classes->name }}</td>
                                     <td>{{ $attendance->sessiones->name }}</td>
                                     <td>{{ $attendance->batchsetting->batch_name }}</td>
                                     <td>{{ $attendance->batchsetting->classtype->name }}</td>
                                     <td> 

                                      
        <a href="" data-id="{{ $attendance->id }}" class="ShowAttendance btn btn-primary btn-sm"> <i class="fa fa-eye"></i> {{ $attendance->attendancedetail->count() }} </a>

        <a href="{{ route('student.attendance.attendanceexport',$attendance->id) }}" class="btn btn-primary btn-sm"> <i class="fa fa-download"></i> PDF</a>
        <a href="{{ route('student.attendance.attendancepresentexport',$attendance->id) }}" class="btn btn-success btn-sm"> <i class="fa fa-download"></i> Present</a>
        <a href="{{ route('student.attendance.attendanceabsentexport',$attendance->id) }}" class="btn btn-warning btn-sm"> <i class="fa fa-download"></i> Absent</a> 
                
                
                </td>
                                     <td>

               
                <a href="" data-id="{{ $attendance->id }}" class="verifyClassModalOpen btn btn-info btn-sm"> {{ $attendance->attendancedetail->where('attendance','Present')->count() }} </a>
               
                                    </td>
                                     <td>

               <a href="" data-id="{{ $attendance->id }}" class="verifyClassModalOpenAbsent btn btn-warning btn-sm"> {{  $attendance->attendancedetail->where('attendance','Absent')->count() }} </a>
           

                                    </td>
          
                                     <td>
                                         <a href="{{ route('student.attendance.edit',$attendance->id) }}" class="btn btn-primary btn-sm"><i class="fa fa-edit"> Edit</i></a>

                                         <a href="{{ route('student.attendance.destroy',$attendance->id) }}" id="delete" class="btn btn-danger   btn-sm"><i class="fa fa-trash"> Delete</i></a>
                                     </td>
                                 </tr>
                                @endforeach
                             </tbody>
                         </table>
                         </div>
 





            </div>
        </div>
    </div>


        <!-- Modal -->
        <div class="modal  fade bd-example-modal-lg" id="present_student" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
          <div class="modal-dialog modal-lg modal-dialog-scrollable" role="document">
            <div class="modal-content">
              <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Present Student List</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
              </div>
              <div class="modal-body">
                   <div id="present_student_list"></div>
              </div>
              <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                 
              </div>
            </div>
          </div>
        </div>     



        <!-- Modal -->
        <div class="modal  fade bd-example-modal-lg" id="absent_student" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
          <div class="modal-dialog modal-lg modal-dialog-scrollable" role="document">
            <div class="modal-content">
              <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Absent Student List</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
              </div>
              <div class="modal-body">
                   <div id="absent_student_list"></div>
              </div>
              <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                 
              </div>
            </div>
          </div>
        </div> 



        <!-- Modal -->
        <div class="modal  fade bd-example-modal-lg" id="attendance_student" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
          <div class="modal-dialog modal-lg modal-dialog-scrollable" role="document">
            <div class="modal-content">
              <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Attendance Student List</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
              </div>
              <div class="modal-body">
                   <div id="attendance_student_list"></div>
              </div>
              <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                 
              </div>
            </div>
          </div>
        </div>



  <input type="hidden" id="getHtmlResponse" data-url="{{route('student.attendance.index.ajax')}}" >
    


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


        //=====================================================================================
            $(document).on('click','.verifyClassModalOpen',function(e){
                e.preventDefault();
                $('#present_student').modal('show');

                var attendence_id = $(this).data('id');

                $.ajax({
                        type: "get",
                        url: "{{ route('get.attendance.present.student') }}",
                        data: {attendence_id:attendence_id},
                        success: function (data) {
                            $('#present_student_list').html(data);
                            $('#present_student').modal('show');
                        },
                        error: function (data) {
                            console.log('Error:', data);
                        }
                    });
                    

                
            });
            //=====================================================================================




         //=====================================================================================
            $(document).on('click','.verifyClassModalOpenAbsent',function(e){
                e.preventDefault();
                $('#absent_student').modal('show');

                var attendence_id = $(this).data('id');

                $.ajax({
                        type: "get",
                        url: "{{ route('get.attendance.absent.student') }}",
                        data: {attendence_id:attendence_id},
                        success: function (data) {
                            $('#absent_student_list').html(data);
                            $('#absent_student').modal('show');
                        },
                        error: function (data) {
                            console.log('Error:', data);
                        }
                    });
                    

                
            });
            //=====================================================================================


       //=====================================================================================
            $(document).on('click','.ShowAttendance',function(e){
                e.preventDefault();
                $('#attendance_student').modal('show');

                var attendence_id = $(this).data('id');

                $.ajax({
                        type: "get",
                        url: "{{ route('student.attendance.show') }}",
                        data: {attendence_id:attendence_id},
                        success: function (data) {
                            $('#attendance_student_list').html(data);
                            $('#attendance_student').modal('show');
                        },
                        error: function (data) {
                            console.log('Error:', data);
                        }
                    });
                    

                
            });
            //=====================================================================================
 

    </script>


        



@endsection


@endsection
