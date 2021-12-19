@extends('frontend.layouts.app')
@section('title', 'Enrollment Batch Detail')
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
                        <h6>Enrollment Batch Details </h6>
                         
                    </div>
                    <div class="hr-body">
                      <div class="table-responsive">
                          <table id="laravel_datatable" class="table table-striped table-bordered table-td-valign-middle">
                              <thead>
                                  <tr>
                                      <th width="30%">Menu </th>
                                      <th width="70%">Info</th>
                                  </tr>
                              </thead>
                              <tbody>
                                  <tr>
                                      <td>Batch ID</td>
                                      <td>{{ $setting->batch_uid }}</td>
                                  </tr>  

                                  <tr>
                                      <td>Batch Name</td>
                                      <td>{{ $setting->batch_name }}</td>
                                  </tr>

                                  <tr>
                                      <td>Batch Class</td>
                                      <td>{{ $setting->classes?$setting->classes->name:'' }}</td>
                                  </tr>  

                                  <tr>
                                      <td>Batch Session</td>
                                      <td>{{ $setting->sessiones?$setting->sessiones->name:'' }}</td>
                                  </tr>

                                  <tr>
                                      <td>Batch Class Type</td>
                                      <td>{{ $setting->classtype?$setting->classtype->name:'' }}</td>
                                  </tr>  

                                  <tr>
                                      <td>Batch Day of Class</td>
                                      <td>
                                           @foreach($setting->dayandtime as $daytime)
                                            <p> 
                                                <span style="width: 33%">{{ $daytime->day?$daytime->day->name:'' }}</span> - 
                                                <span style="width: 33%">{{ date('h:i A',strtotime($daytime->start_time)) }}</span> - 
                                                <span style="width: 33%">{{ date('h:i A',strtotime($daytime->end_time)) }}</span></p>
                                            @endforeach
                                      </td>
                                  </tr>


                                 

                                   <tr>
                                      <td>Roll</td>
                                      <td>
                                          {{ $student->roll }}
                                      </td>
                                  </tr>

                                   <tr>
                                      <td>Admission Date</td>
                                      <td>
                                          {{ date('d-m-Y',strtotime($student->admission_date)) }}
                                      </td>
                                  </tr>  
                                  <tr>
                                      <td>Admission Month</td>
                                      <td>
                                          {{ $student->month?$student->month->name:'' }}
                                      </td>
                                  </tr>  


                                  <tr>
                                      <td>Action</td>
                                      <td>
                                           <a href="{{ route('student.batch.enroll') }}" title="" class="btn btn-primary btn-sm"><i class="fa fa-arrow-left"></i> Back to batch List</a>
                                      </td>
                                  </tr>  








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
