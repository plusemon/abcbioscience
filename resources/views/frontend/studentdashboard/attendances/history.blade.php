@extends('frontend.layouts.app')
@section('title', 'Student Attendance History')
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
                        <h6>Student Attendance History</h6>
                        
                    </div>
                    <div class="hr-body">

                         
                          <div class="table-responsive">
                                <table id="laravel_datatable" class="table table-striped table-bordered table-td-valign-middle">
                                <thead>
                                    <tr>
                                        <th width="1%">ID</th>
                                       
                                        <th class="text-nowrap">Class</th>
                                        <th class="text-nowrap">Session</th>
                                        <th class="text-nowrap">Batch</th>
                                        <th class="text-nowrap">Attendance Date & Time</th>
                                        <th class="text-nowrap">Status</th>
                                        
                                    </tr>
                                </thead>
                                <tbody>

                                    @foreach($attendance_details as $detail)

                                    <tr>
                                        <td>  {{ $loop->iteration }} </td>
                                        <td>  {{ $detail->student?$detail->student->user->name:'' }} </td>
                                        <td>  {{ $detail->student?$detail->student->sessiones->name:'' }} </td>
                                        <td>  {{ $detail->student?$detail->student->batchsetting->batch_name:'' }} </td>
                                        <td>  {{ Date('d-m-Y h:i A',strtotime($detail->mainattendance?$detail->mainattendance->attendance_date:'')) }}</td>
                                        <td>{{ $detail->attendance }}</td>
                                    </tr>

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
