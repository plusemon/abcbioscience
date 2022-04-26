<div class="table-responsive">
	 <table id="laravel_datatable" class="table table-striped table-bordered table-td-valign-middle" style="margin-top:10px;">
        <thead>
            <tr>
                <th width="1%">ID</th>
                <th class="text-nowrap">Student ID</th>
                <th class="text-nowrap">Student Name</th>
                <th class="text-nowrap">Class</th>
                <th class="text-nowrap">Session</th>
                <th class="text-nowrap">Section</th>
                <th class="text-nowrap">Batch</th>
                <th class="text-nowrap">Fee Category</th>
                <th class="text-nowrap">Waiver Value <br/><small>(amount)</small></th>
                <th class="text-nowrap">Action</th>
            </tr>
        </thead>
        <tbody>
            @foreach($waiverStudents as $waiver)
                <tr>
                    <td>
                        {{ $loop->iteration }}
                    </td>
                    <td>
                        
                        {{$waiver->students?$waiver->students->user?$waiver->students->user->useruid:NULL:NULL}}   

</td>
                      <td>   {{$waiver->students?$waiver->students->user?$waiver->students->user->name:NULL:NULL}}
                    </td>
                    <td>
                        {{ $waiver->classes?$waiver->classes->name:NULL }}
                    </td>
                    <td>
                        {{ $waiver->sessiones?$waiver->sessiones->name:NULL }}
                    </td>
                    <td>
                        {{ $waiver->sections?$waiver->sections->name:NULL }}
                    </td>
                    <td>
                        {{ $waiver->batchsetting?$waiver->batchsetting->batch_name:NULL }}
                    </td>
                    <td>
                        {{$waiver->feeCategories?$waiver->feeCategories->name : NULL}}
                    </td>
                    <td>
                        {{$waiver->waiver_value}}
                        @if($waiver->waiver_type_id == 1)
                            %
                            @else
                            
                        @endif
                    </td>
                    <td>
                        <a href="{{ route('admin.student-waiver.show',$waiver->id) }}" class="btn btn-info btn-sm"><i class="fa fa-eye"></i> View</a>
                        <a href="{{ route('admin.student-waiver.edit',$waiver->id) }}" class="btn btn-primary btn-sm"><i class="fa fa-edit"></i> Edit</a>
                        <a href="{{route('admin.studentWaiverDestory',$waiver->id)}}" id="delete" class="btn btn-danger btn-sm"><i class="fa fa-trash"></i> Delete</a>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>