<div class="table-responsive">
	<table id="laravel_datatable" class="table table-striped table-bordered table-td-valign-middle">
            <thead>
                <tr>
                    <th width="1%">ID</th>
                    <th>Image</th>
                    <th>Student ID</th>
                    <th class="text-nowrap">Name</th>
                    <th class="text-nowrap">Mobile</th>
                    <th class="text-nowrap">Class</th>
                    <th class="text-nowrap">Session</th>
                    <th class="text-nowrap">Batch</th>
                    <th class="text-nowrap">Section</th>
                    <th class="text-nowrap">Roll</th>
                    <th class="text-nowrap">Status</th>
                    <th class="text-nowrap">Action</th>
                </tr>
            </thead>
            <tbody>


                @foreach($allstudents as $student)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>
                            <a href="{{ asset($student->user?$student->user->image:'') }}">  
                                <img src="{{ asset($student->user?$student->user->image:'') }}" alt="" width="50"> 
                            </a>
                        </td>
                        <td>{{ $student->user?$student->user->useruid:'' }}</td>
                        <td>{{ $student->user?$student->user->name:''  }}</td>
                        <td>{{ $student->user?$student->user->mobile:'' }}</td>
                        <td>{{ $student->classes?$student->classes->name:'' }}</td>
                        <td>{{ $student->sessiones?$student->sessiones->name:'' }}</td>
                        <td>{{ $student->batchsetting?$student->batchsetting->batch_name:'' }}</td>
                        <td>{{ $student->user?$student->user->section_id:'' }}</td>
                        <td>{{ $student->user?$student->user->roll:'' }}</td>

                        <td>
                           
                           @if($student->status==1)

                            <p class="btn btn-primary btn-sm">Active</p>
                            @elseif($student->status==2) 
                            <p class="btn btn-danger btn-sm">Inactive</p>
                            @endif 


                        </td>
                        <td>
                            <div class="dropdown">
                                <button type="button" class="btn btn-sm  btn-primary dropdown-toggle" data-toggle="dropdown">
                                 <i class="fa fa-cogs"></i>  Action                                             </button>
                                <div class="dropdown-menu">

                                    <a href="{{ route('student.user.edit',$student->user_id) }}" class="dropdown-item"><i class="fa fa-edit"></i>User Edit</a>
                                    
                                    <a href="{{ route('student.user.login.dashboard',$student->user_id) }}" class="dropdown-item"><i class="fa fa-dashboard"></i> Student Dashboard</a>

                                    <a href="{{ route('student.edit',$student->id) }}" class="dropdown-item"><i class="fa fa-edit"></i> Edit</a>
                                    <a href="{{ route('student.show',$student->id) }}" class="dropdown-item"><i class="fa fa-eye"></i> Show</a>
                                     <a href="{{ route('student.destroy',$student->id) }}" id="delete" class="dropdown-item"><i class="fa fa-trash"></i> Delete</a>

                                </div>
                            </div>
                        </td>
                    </tr>



                @endforeach

            </tbody>
        </table>

    </div>