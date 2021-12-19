 <div class="row">

    <div class="col-md-12">


         <div class="form-group">
             <div class="row">
                 <div class="col-md-12">
                      <label>Topic</label> <br>
                     <input type="text" name="topic" class="form-control" placeholder="Enter Home work Topic" required>  
                 </div>
                 <div class="col-md-6">
                      <label>Attachment</label> <br>
                      <input type="file" name="attachment" class="form-control" placeholder="Enter file">
                 </div>
                 <div class="col-md-6">
                    <label>Date of submission</label> <br>
                    <input type="datetime-local" name="dead_line" class="form-control" placeholder="Enter date" required>
                 </div>
             </div> 
            
             
            
             
             
             
         </div> 

         <hr>

        <div class="table-responsive">
            <table class="table table-hovered table-bordered">
                <tr>
                    <th>SL</th>
                    <th>Student ID</th>
                    <th>Name</th>
                    <th>Class</th>
                    <th>Batch</th>
                    <th>Roll</th>
                </tr>

                 @foreach($allstudents as $student)
                    <tr>
                        <td>{{ $loop->iteration }}
                            <input type="hidden" name="student_id[]" value="{{ $student->id }}">
                        </td>
                        <td>{{ $student->user?$student->user->useruid:'' }}</td>
                        <td>{{ $student->user?$student->user->name:''  }}</td>
                        <td>{{ $student->classes?$student->classes->name:'' }}</td>
                        <td>{{ $student->batchsetting?$student->batchsetting->batch_name:'' }}</td>
                        <td>{{ $student->user?$student->user->roll:'' }}</td>

                    </tr>
                @endforeach
            </table>

            <button class="btn btn-primary btn-sm">Submit</button>
        </div>     
    </div>
</div>           
                
       