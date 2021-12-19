@extends('students.layouts.app')
@section('title', 'Pending Home works')
@section('content')
    <div id="content" class="content">
        <div class="panel panel-inverse">
            <div class="panel-heading">
                <h4 class="panel-title">Pending Home Works</h4>
                <div class="panel-heading-btn">
                    <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-default" data-click="panel-expand">
                        <i class="fa fa-expand"></i>
                    </a>
                    <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-success" data-click="panel-reload">
                        <i class="fa fa-redo"></i>
                    </a>
                    <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-warning" data-click="panel-collapse">
                        <i class="fa fa-minus"></i>
                    </a>
                    <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-danger" data-click="panel-remove">
                        <i class="fa fa-times"></i>
                    </a>

                </div>
            </div>
            <div class="panel-body">
                <div class="row">
                    <div class="col-md-12">

                         
                          <div class="table-responsive">
                                <table id="laravel_datatable" class="table table-striped table-bordered table-td-valign-middle">
                                <thead>
                                    <tr>
                                        <th width="1%">ID</th>

                                        <th class="text-nowrap">Topic</th>
                                        <th class="text-nowrap">Chapter</th>
                                        <th class="text-nowrap">Subject</th>
                                        
                                        <th class="text-nowrap">Class</th>
                                        <th class="text-nowrap">Session</th>
                                        <th class="text-nowrap">Batch</th>
                                        <th class="text-nowrap">Attachment</th>
                                        
                                        <th class="text-nowrap">Created Date</th>
                                        <th class="text-nowrap">Submission Date</th>
                                        <th class="text-nowrap">Status</th>
                                        <th class="text-nowrap">Action</th> 
                                    </tr>
                                </thead>
                                <tbody>

                                	@foreach($pending as $detail)
 
                                    @php
                                                $start = $detail->mainhomework->dead_line;
                                                $now = now();
                                                
                                                $isStarted = $start >= $now;
                                                 
                                            @endphp
                                    
                                    @if($isStarted)

                                	<tr>
                                        <td>  {{ $loop->iteration }} </td>
                                        <td>  {{ $detail->mainhomework->topic }} </td>
                                        <td>  {{ $detail->student?$detail->mainhomework->chapter->name:'' }} </td>
                                        <td>  {{ $detail->student?$detail->mainhomework->subject->name:'' }} </td>
                                        <td>  {{ $detail->student?$detail->student->classes->name:'' }} </td>
                                        <td>  {{ $detail->student?$detail->student->sessiones->name:'' }} </td>
                                        <td>  {{ $detail->student?$detail->student->batchsetting->batch_name:'' }} </td>
                                         <td> 
                                        
                                            @if(!empty($detail->mainhomework?$detail->mainhomework->attachment:''))
                                            
                                             <a href="{{ asset($detail->mainhomework?$detail->mainhomework->attachment:'') }}" class="btn btn-primary btn-sm" download> <i class="fa fa-download"></i> Download</a> 
                                             <a href="{{ asset($detail->mainhomework?$detail->mainhomework->attachment:'') }}" class="btn btn-info btn-sm" target="_blank"> <i class="fa fa-eye"></i> Preview</a>
                                            @else
                                                
                                            No File
                                                
                                            @endif
	             
                                        </td>
                                        <td>  {{ date('d-m-Y',strtotime($detail->created_at)) }}</td>
                                        <td>  {{ date('d-m-Y h:i A',strtotime($detail->mainhomework->dead_line)) }}</td>
                                        <td>
                                            @if($detail->status==1)
                                            <p class="btn btn-success">Submitted</p>
                                            @elseif($detail->status==0)
                                            <p class="btn btn-danger">Pending</p>
                                            @endif
                                        </td>
                                        <td>
                                        	<form action="{{ route('student.homework.submitted') }}" method="post" >
		                    					@csrf
		                    					<input type="hidden" name="homework_detail_id" value="{{ $detail->id }}">
		                    					<button type="submit" class="btn btn-primary btn-sm">Submit Home Work</button>
		                    				</form>
                                        </td>
                                    </tr>
                                    @endif
                                	@endforeach


                                    

                                </tbody>
                            </table>

                          </div>  
                        

 
                    </div>
                </div>

            </div>
        </div>
    </div>
     


@endsection
