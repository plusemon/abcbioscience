@extends('students.layouts.app')
@section('title', 'Student Personal Information')
@section('content')
    <div id="content" class="content">
        <div class="panel panel-inverse">
            <div class="panel-heading">
                <h4 class="panel-title">Student Personal Information</h4>
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
    </div>
  
@endsection
