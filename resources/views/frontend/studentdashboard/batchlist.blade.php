@extends('frontend.layouts.app')
@section('title', 'Enrollment Courses List')
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
                        <h6>Enrollment Courses List </h6>
                        
                    </div>
                    <div class="hr-body">

                          @if($students->count()>0)
                          <div class="table-responsive">
                                <table id="laravel_datatable" class="table table-striped table-bordered table-td-valign-middle">
                                <thead>
                                    <tr>
                                        <th width="1%">ID</th>
                                       
                                        <th class="text-nowrap">Class</th>
                                        <th class="text-nowrap">Session</th>
                                        <th class="text-nowrap">Batch</th>
                                        <th class="text-nowrap">Class Type</th>
                                        <th class="text-nowrap">Roll</th>
                                        <th class="text-nowrap">Admission Date</th>
                                        <th class="text-nowrap">Status</th>
                                        <th class="text-nowrap">Action</th> 
                                     
                                    </tr>
                                </thead>
                                <tbody>


                                    @foreach($students as $student)
                                        <tr>
                                            <td>{{ $loop->iteration }}</td>
                                           
                                            <td>{{ $student->classes?$student->classes->name:NULL }}</td>
                                            <td>{{ $student->sessiones?$student->sessiones->name:NULL }}</td>
                                            <td>
                                                {{ $student->batchsetting?$student->batchsetting->batch_name:NULL }}
                                            </td>
                                            <td>
                                                {{ $student->batchsetting->classtype?$student->batchsetting->classtype->name:NULL }}
                                            </td>
                                            <td>{{ $student->roll }}</td>
                                            <td>{{ date('d-m-Y', strtotime($student->admission_date)) }}</td>
                                            <td>
                                                  @if($student->status==1)
                                                   <p class="btn btn-primary btn-sm">Active</p>
                                                   @elseif($student->status==2) 
                                                   <p class="btn btn-warning btn-sm">Pending</p>
                                                   @elseif($student->status==3) 
                                                   <p class="btn btn-warning btn-sm">Pending</p>
                                                   @endif
                                            </td>
                                            <td>
                                              <a href="{{ route('student.batch.enroll.detail',$student->batchsetting->id) }}" title="" class="btn btn-primary btn-sm"> <i class="fa fa-eye"></i> Show</a>
                                            </td>
                                            
                                        </tr>
                                    @endforeach

                                </tbody>
                            </table>

                          </div>  
                          @else


                          <p class="pl-3">No Batch Found please enroll Batch  <a href="{{ route('allbatch') }}" class="btn btn-primary btn-sm">Click here for batch enrollment </a> </p>

                          @endif
                    </div>
                </div>

            </div>
        </div>
    </section>
    <!--END USER DASHBOARD-->



    @include('frontend.studentdashboard.mobilemenu')


@endsection
