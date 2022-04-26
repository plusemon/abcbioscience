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
                             <td>{{ $attendance->attendance_date }}  <br>
                               {{ date('h:i A',strtotime($attendance->created_at)) }} </td>
                             <td>{{ $attendance->classes->name }}</td>
                             <td>{{ $attendance->sessiones->name }}</td>
                             <td>{{ $attendance->batchsetting->batch_name }}</td>
                             <td>{{ $attendance->batchsetting->classtype->name }}</td>
                             <td> 

      
        <a href="" data-id="{{ $attendance->id }}" class="ShowAttendance btn btn-primary btn-sm"> <i class="fa fa-eye"></i> {{ $attendance->attendancedetail->count() }} </a>

        <a href="{{ route('student.attendance.attendanceexport',$attendance->id) }}" class="btn btn-primary btn-sm"> <i class="fa fa-download"></i> PDF</a>
        
        </td>
                             <td>

       
        <a href="" data-id="{{ $attendance->id }}" class="verifyClassModalOpen btn btn-info btn-sm"> {{ $attendance->total_present }} </a>
       
                            </td>
                             <td>

       <a href="" data-id="{{ $attendance->id }}" class="verifyClassModalOpenAbsent btn btn-warning btn-sm"> {{ $attendance->total_absent }} </a>
   

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