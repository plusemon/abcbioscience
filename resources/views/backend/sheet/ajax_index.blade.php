<div class="table-responsive">       
        <table id="data-table-default" class="table  table-responsive table-striped table-bordered table-td-valign-middle">
            <thead>
                <tr>
                    <th width="1%">SL</th>
                    <th class="text-nowrap">Sheet No/Name</th>
                    <th class="text-nowrap">Subject</th>
                    <th class="text-nowrap">Class</th>
                    <th class="text-nowrap">Session</th>
                    <th class="text-nowrap">Chapter</th>
                    <th class="text-nowrap">Topic</th>
                    <th class="text-nowrap">Status</th>
                    <th class="text-nowrap">Created At</th>
                    <th class="text-nowrap">Action</th>
                </tr>
            </thead>
            <tbody>
     	         
     	    @foreach($sheets as  $sheet)
            <tr>
                <td>{{ $loop->iteration }}</td>
                <td>{{ $sheet->sheet_no }}</td>
                <td>{{ $sheet->subjects?$sheet->subjects->name:'' }}</td>
                <td>{{ $sheet->classes?$sheet->classes->name:'' }}</td>
                <td>{{ $sheet->sessiones?$sheet->sessiones->name:'' }}</td>
                <td>{{ $sheet->chapter?$sheet->chapter->name:'' }}</td>
                <td>{{ $sheet->topic }}</td>
                <td>
                	@if($sheet->status==1)
                	<p class="btn btn-primary btn-xs">Active</p>
                	@elseif($sheet->status==2)
                	<p class="btn btn-danger btn-xs">Deactive</p>
                	@endif
                </td>
                  <td>{{ $sheet->created_at->format('d-M-Y H:s A') }}</td>
                <td>
                    <a href="{{ route('sheet.edit', $sheet->id) }}" class="btn btn-xs btn-success">
                		<i class="fa fa-edit"></i> Edit
                	</a> 
                    <a href="{{ route('admin.sheet.setting.create', 'sid='.$sheet->id) }}" class="btn btn-xs btn-primary">
                		<i class="fa fa-cogs"></i> Settings
                	</a> 
                	 
                	<a href="{{ route('sheet.destroy',$sheet->id) }}" id="delete" class="btn btn-xs btn-danger">
                		<i class="fa fa-times"></i> Delete
                	</a>
                </td>
            </tr>
                   
            @endforeach
            </tbody>
        </table>
</div>