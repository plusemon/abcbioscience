@extends('students.layouts.app')
@section('title', 'Enrollment Batch Lists')
@section('content')
    <div id="content" class="content">
        <div class="panel panel-inverse">
            <div class="panel-heading">
                <h4 class="panel-title">Enrollment Batch Lists</h4>
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
                  

                          @if($students->count()>0)
                          <div class="table-responsive">
                                <table id="datatables" class="table table-striped table-bordered table-td-valign-middle datatables">
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
    </div>
     
@endsection
