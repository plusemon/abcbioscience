@extends('frontend.layouts.app')
@section('title', 'Pending Home Work')
@section('content')

    <!--USER DASHBOARD-->
    <section class="user-dashboard py-4">
        <div class="container">
            <div class="dashboard-area d-flex bd-highlight">
                

          
            @include('frontend.studentdashboard.dashboardmenu')
         

              <div class="dashboard-main w-100 bd-highlight py-3">
                  <div class="dr-head dashboard-header">
                      <div class="ud-mobile">
                            <i class="fa fa-bars" id="ud-mobile-btn"></i> Menu
                        </div>
                        <h6>Pending Home Work </h6>
                        
                    </div>
                    <div class="hr-body">

                         
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


                                    @if($detail->mainhomework->dead_line < now())


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
                                            <p class="text-success">Submitted</p>
                                            @elseif($detail->status==0)
                                            <p class="text-warning">Pending</p>
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
    </section>
    <!--END USER DASHBOARD-->



    @include('frontend.studentdashboard.mobilemenu')


@endsection
