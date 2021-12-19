<div class="table-responsive">
            <table id="laravel_datatable" class="table table-striped table-bordered table-td-valign-middle">
            <thead>
                <tr>
                    <th width="1%">ID</th>
                    <th class="text-nowrap">Class</th>
                    <th class="text-nowrap">Session</th>
                    <th class="text-nowrap">Batch</th>
                   
                    <th class="text-nowrap">Last time to Present</th>
                    <th class="text-nowrap">Status</th>
                    <th class="text-nowrap">Action</th> 
                </tr>
            </thead>
            <tbody>
                

            	@foreach($pending as $detail)
            	         @php
                            $start = $detail->mainattendance->attendance_date;
                            $now = now();
                            
                            $isStarted = $start >= $now;
                             
                        @endphp
            	
                @if($isStarted)
            
                	<tr>
                        <td>  {{ $loop->iteration }} </td>
                        <td>  {{ $detail->student?$detail->student->user->name:'' }} </td>
                        <td>  {{ $detail->student?$detail->student->sessiones->name:'' }} </td>
                        <td>  {{ $detail->student?$detail->student->batchsetting->batch_name:'' }} </td>
                        <td>  {{ $detail->mainattendance? Date('d-M h:i A',strtotime($detail->mainattendance->attendance_date)) :'' }}</td>
                        <td>   Pending </td>
                        <td>
                            
                        	<form action="{{ route('student.attendance.present') }}" method="post" name="submitForm" >
            					@csrf
            					<input type="hidden" name="attendance_detail_id" value="{{ $detail->id }}">
            					 

                                 <input value="Submit Attendance"
                                                            onclick="this.disabled=true; this.value='Submitting...'; submitForm.submit()"
                                                            class="btn btn-custom">
            				</form>
                        </td>
                    </tr>
                @endif
              

            	@endforeach


                

            </tbody>
        </table>

      </div>  