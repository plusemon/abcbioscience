@extends('frontend.layouts.app')
@section('title', 'Student Profile')
@section('content')

    <!--USER DASHBOARD-->
    <section class="user-dashboard py-4">
        <div class="container">
            <div class="dashboard-area d-flex bd-highlight">
                

          
            @include('frontend.studentdashboard.dashboardmenu')
         

              <div class="dashboard-main w-100 bd-highlight py-3">
                  <div class="dr-head dashboard-header">
                      <div class="ud-mobile">
                            <i class="fa fa-bars" id="ud-mobile-btn"></i>Profile  Menu
                        </div>
                        <h6> Student Profile </h6>
                    </div>
                    <div class="hr-body">
                        <table class="table table-bordered table-hovered">
                           <thead>
                             <tr>
                               <th>Menu</th>
                               <th>Information</th>
                             </tr>
                           </thead>
                           <tbody>
                             <tr>
                                <th>Student ID</th>
                                <td>{{ $student->useruid }}</td>
                             </tr>

                             <tr>
                                <th>Name</th>
                                <td>{{ $student->name }}</td>
                             </tr>
                             <tr>
                               <th>Email</th>
                               <td>{{ $student->email }}</td>
                             </tr>
                             <tr>
                                <th>Mobile</th>
                                <td>{{ $student->mobile }}</td>
                             </tr>
                         
                              <tr>
                               <th>Class</th>
                               <td>{{ $student->classes?$student->classes->name:'' }}</td>
                             </tr>    
                             
                             <tr>
                                <th>Section</th>
                                <td>{{ $student->section_id }}</td>
                             </tr>
                             <tr>
                               <th>Shift</th>
                               <td>{{ $student->shift?$student->shift->name:'' }}</td>
                             </tr>  
                             
                             <tr>
                               <th>Roll</th>
                               <td>{{ $student->roll }}</td>
                             </tr>  
                             
                             <tr>
                               <th>School Name</th>
                               <td>{{ $student->school_name }}</td>
                             </tr>  
                             
                             
                             
                             
                             
                            <tr>
                               <th>Address</th>
                               <td>{{ $student->address }}</td>
                             </tr>  
                             
                             
                             
                             <tr>
                               <th>Photo</th>
                               <td> <img src="{{ asset($student->image) }}" class="img-responsive" width="100"> </td>
                             </tr>
                             
                             
                             
                             
                             <tr>
                               <th>Action</th>
                               <td><a href="{{ route('student.profile.edit') }}" class="btn btn-primary btn-sm"><i class="fa fa-edit"></i> Edit</a></td>
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
