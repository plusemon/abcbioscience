<div class="table-responsive">
 	 <table class="table table-hovered table-bordered">
	     <thead>
	         <tr>
	             <th  width="1%">Serial</th>
	             <th  width="7%">Date</th>
	             <th>Topic</th>
	             <th>Subject</th>
	             <th>Class</th>
	             <th>Session</th>
	             <th>Batch</th>
	             <th>Submission Date</th>
	             <th>Attachment</th>
	             <th>Total Student</th>
	             <th>Total Submit</th>
	             <th>Total Pending</th>
	             <th>Action</th>
	         </tr>
	     </thead>
	     <tbody>
	        @foreach($homeworks as $homework)
	         <tr>
	             <td>{{ $loop->iteration }}</td>
	             <td> {{ Date('d-m-Y',strtotime($homework->created_at)) }} </td>
	             <td>{{ $homework->topic }}</td>
	             <td>{{ $homework->subject?$homework->subject->name:'' }}</td>
	             <td>{{ $homework->classes->name }}</td>
	             <td>{{ $homework->sessiones->name }}</td>
	             <td>{{ $homework->batchsetting->batch_name }}</td>
	             
	             <td> {{ Date('d-m-Y h:i A',strtotime($homework->dead_line)) }} </td>
	             <td> 
	             
	             @if(!empty($homework->attachment))
    	             <a href="{{ asset($homework->attachment) }}" class="btn btn-primary btn-sm mb-2" download> <i class="fa fa-download"></i> Download</a>
    	             
    	             
    	             
    	             <a href="{{ asset($homework->attachment) }}" class="btn btn-info btn-sm pt-2" target="_blank"> <i class="fa fa-eye"></i> Preview</a>
    	             
	             @else
	             No File
	             @endif
	             
	             </td>
	             
	              
	             <td> 

	<a href="#"  class="btn btn-primary btn-sm">{{ $homework->homework->count() }} </a></td>
	             <td>


	<a href="" data-id="{{ $homework->id }}" class="submitted_model_show btn btn-info btn-sm"> {{ $homework->homework->where('status',1)->count() }} </a>

	            </td>
	             <td>

	<a href="" data-id="{{ $homework->id }}" class="pending_model_show btn btn-warning btn-sm"> {{ $homework->homework->where('status',0)->count() }} </a>


	            </td>

	             <td>
	                 <a href="{{ route('student.homework.edit',$homework->id) }}" class="btn btn-primary btn-sm"><i class="fa fa-edit"> Send SMS</i></a>

	                 <a href="{{ route('student.homework.destroy',$homework->id) }}" id="delete" class="btn btn-danger   btn-sm"><i class="fa fa-trash"> Delete</i></a>
	             </td>
	         </tr>
	        @endforeach
	     </tbody>
	 </table>
 </div>