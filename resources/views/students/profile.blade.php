@extends('students.layouts.app')
@section('title', 'Student Profile')
@section('content')
    <div id="content" class="content">
        <div class="panel panel-inverse">
            <div class="panel-heading">
                <h4 class="panel-title">Student Profile</h4>
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
    </div>
     

@endsection
