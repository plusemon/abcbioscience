@extends('frontend.layouts.app')
@section('title', 'Student Personal Information ')
@section('content')

    <!--USER DASHBOARD-->
    <section class="user-dashboard py-4">
        <div class="container">
            <div class="dashboard-area d-flex bd-highlight">
                

          
            @include('frontend.studentdashboard.dashboardmenu')
         

              <div class="dashboard-main w-100 bd-highlight py-3">
                  <div class="dr-head dashboard-header">
                      <div class="ud-mobile">
                            <i class="fa fa-bars" id="ud-mobile-btn"></i> Profile Menu
                        </div>
                        <h6> Student Personal Information </h6>
                        
                    </div>
                    <div class="hr-body">
                        <table class="table table-bordered table-hovered">
                           <thead>
                             <tr>
                               <th width="27%">Menu</th>
                               <th width="73%">Information</th>
                             </tr>
                           </thead>
                           <tbody>
                             <tr>
                                <th>Father Name</th>
                                <td>{{ $student->father }}</td>
                             </tr>

                             <tr>
                                <th>Mother Name</th>
                                <td>{{ $student->mother }}</td>
                             </tr>
                             <tr>
                                <th>Guardian mobile Number</th>
                                <td>{{ $student->guardian_mobile }}</td>
                             </tr>
                             <tr>
                               <th>Email</th>
                               <td>{{ $student->email }}</td>
                             </tr>
                             <tr>
                                <th>Self Mobile</th>
                                <td>{{ $student->own_mobile }}</td>
                             </tr>

                              <tr>
                                <th>Bkash Number</th>
                                <td>{{ $student->bkash_number }}</td>
                             </tr>
                             <tr>
                               <th>Whats App Number</th>
                               <td>{{ $student->whatsapp_number }}</td>
                             </tr>
                             <tr>
                                <th>Facebook ID Link</th>
                                <td>{{ $student->facebook_id }}</td>
                             </tr>
                            

                             <tr>
                               <th>Address</th>
                               <td>{{ $student->address }}</td>
                             </tr>
                             <tr>
                               <th>Action</th>
                               <td><a href="{{ route('student.personal.information.edit') }}" class="btn btn-primary btn-sm"><i class="fa fa-edit"></i> Edit</a></td>
                             </tr>

                           </tbody>
                         </table>
                    </div>
                </div>

            </div>
        </div>
    </section>
    <!--END USER DASHBOARD-->



    @include('frontend.studentdashboard.mobilemenu')


@endsection
