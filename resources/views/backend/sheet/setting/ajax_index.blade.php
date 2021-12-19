<div class="table-responsive"> 
	  <table id="laravel_datatable" class="table hovered table-bordered ">
                    <thead>
                    <tr>
                        <th class="text-nowrap">Sl No</th>
                        <th class="text-nowrap">Sheet No/Name</th>
                        <th class="text-nowrap">Subject Name</th>
                        <th class="text-nowrap">Chapter</th>
                        <th class="text-nowrap">Topic</th>
                        <th class="text-nowrap">Batch</th>
                        <th class="text-nowrap">Seesion</th>
                        <th class="text-nowrap">Class</th>
                        <th class="text-nowrap">Publish</th>
                        <th class="text-nowrap">Amount</th>
                        <th class="text-nowrap">Taken By</th>
                        <th class="text-nowrap">Status</th>
                        <th class="text-nowrap">Action</th>
                    </tr>
                    </thead>
                    <tbody>

                    @foreach($sheetSettings as $sheet)
                        <tr>
                            <td>{{ $loop->index+1}}</td>
                            <td>{{ $sheet->sheets?$sheet->sheets->sheet_no:NULL}}</td>
                            
                            <td>{{ $sheet->subjects?$sheet->subjects->name:NULL}}</td>
                            <td>{{ $sheet->sheets->chapter?$sheet->sheets->chapter->name:NULL}}</td>
                            <td>{{ $sheet->sheets?$sheet->sheets->topic:NULL}}</td>
                            <td>{{ $sheet->batchsetting?$sheet->batchsetting->batch_name:''  }} </td>
                            <td>{{ $sheet->sessiones?$sheet->sessiones->name:''  }} </td>
                            <td>{{ $sheet->classes?$sheet->classes->name:''}}</td>

                           
                            <td>{{ date('d-m-Y',strtotime($sheet->publish_date))}}</td>

                            <td>{{ $sheet->amounts?$sheet->amounts->amount:''}}</td>

                            <td>
                                 @if($sheet->taken_by==1)
                                    <span class="btn btn-info btn-sm">Global</span>
                                @elseif($sheet->taken_by==2)
                                    <span class="btn btn-primary btn-sm">Only Batch</span>
                                @else
                                    <span class="btn btn-danger btn-sm">All Student</span>
                                @endif
                            </td>

                            
                            <td>
                                @if($sheet->status==1)
                                    <span class="btn btn-info btn-sm">Active</span>
                                @elseif($sheet->status==2)
                                    <span class="btn btn-primary btn-sm">Completed</span>
                                    @else
                                    <span class="btn btn-danger btn-sm">Deleted</span>
                                @endif
                            </td>
                            <td>

                                <a href="{{ route('admin.sheet.setting.edit', $sheet->id) }}" class="btn btn-primary btn-sm">Edit</a>
                                <a href="{{route('admin.sheet.student.setting.create','sid='.$sheet->id)}}" class="btn btn-success btn-sm ">Setting</a> 
                                <a href="{{route('admin.sheet.setting.destroy',$sheet->id) }}" id="delete" class="btn btn-danger btn-sm ">Trash</a> 
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
</div>