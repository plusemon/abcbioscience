@extends('backend.layouts.app')
@section('title','Student list')
@section('content')
 <div id="content" class="content">
            <div class="panel panel-inverse">
                <div class="panel-heading">
                    <h4 class="panel-title">Student list  </h4>
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

                    <a href="{{ route('student.create') }}" class="btn btn-primary btn-sm float-right mb-1" id="create-new-batch"><i class="fa fa-plus"></i> Add New Student</a>

                    <table id="laravel_datatable" class="table table-striped table-bordered table-td-valign-middle">
                        <thead>
                            <tr>
                                <th width="1%">ID</th>
                                <td>Student ID</td>
                                <th class="text-nowrap">Name</th>
                                <th class="text-nowrap">Class</th>
                                <th class="text-nowrap">Session</th>
                                <th class="text-nowrap">Batch</th>
                                <th class="text-nowrap">Roll</th>
                                <th class="text-nowrap">Action</th>
                            </tr>
                        </thead>
                        <tbody>


                            @foreach($allstudents as $student)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $student->user->useruid }}</td>
                                    <td>{{ $student->user->name }}</td>
                                    <td>{{ $student->classes->name }}</td>
                                    <td>{{ $student->sections->name }}</td>
                                    <td>{{ $student->batchsetting->batch_name }}</td>
                                    <td>{{ $student->roll }}</td>
                                    <td>
                                        <p class="text-success">Paid</p>
                                    </td>
                                    
                                   
                                     
                                </tr>



                            @endforeach
                           
                    
                             
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        


@section('customjs')
    

    
    
@endsection
@endsection  