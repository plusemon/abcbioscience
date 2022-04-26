<div class="table-responsive">
 	 <table class="table table-hovered table-bordered">
	     <thead>
	         <tr>
	             <th>Serial</th>
	             <th>Student ID</th>
	             <th>Student Name</th>
	             <th>Class</th>
	             <th>Session</th>
	             <th>Batch</th>
	             <th>Status</th>
	          </tr>
	     </thead>
	     <tbody>
	        @foreach($homeworks as $homework)
	         <tr>
	             <td>{{ $loop->iteration }}</td>
	             <td>
	             	{{ $homework->student->user->useruid }}

	             </td>
	             <td>
	             	{{ $homework->student->user->name }}
	             </td>
	             <td>
	             	{{ $homework->student->classes->name }}
	             </td>
	             <td>
	             	{{ $homework->student->sessiones->name }}
	             </td>
	             <td>
	             	{{ $homework->student->batchsetting->batch_name }}	 
	             </td>
	            
	            <td>
	            	@if($homework->status==1)
	            	<span class="btn btn-success btn-sm">Submitted</span>
	            	@elseif($homework->status==0)
	            	<span class="btn btn-warning btn-sm">Pending</span>
	            	@endif
	            </td>
	              
	              
	             
	             
	         </tr>
	        @endforeach
	     </tbody>
	 </table>
 </div>