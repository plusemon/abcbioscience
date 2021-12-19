<div class="table-responsive">
	<table class="table table-hovered table-bordered">
		<tr>
            <th>ID</th>
			<th>Status</th>
            
			<th>Student ID</th>
			<th>Name</th>
			<th>Mobile</th>
            <th>Class</th>
            <th>Batch</th>
			 
		 
		</tr>

		@foreach($attendance->attendancedetail->where("attendance","Absent") as $student)
		 <tr>
            <td>{{ $loop->iteration }}</td>
		 	<td>

		 		@if($student->attendance == "Absent")
		 		Absent
		 		@elseif($student->attendance == "Present")
		 		 Present
		 		@endif
		 
		 	</td>
           
		 	<td>{{  $student->student->user->useruid }}</td>
            <td>{{  $student->student->user->name }}</td>
		 	<td>{{  $student->student->user->mobile }}</td>
            <td>{{  $student->student->classes->name }}</td>
            <td>{{  $student->student->batchsetting->batch_name }}</td>
             
		 	 
		</tr>
		@endforeach
	</table>

	 
</div>