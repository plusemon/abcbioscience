@extends('students.layouts.app')
@section('title', 'Attendance History')
@section('content')
    <div id="content" class="content">
        <div class="panel panel-inverse">
            <div class="panel-heading">
                <h4 class="panel-title">Attendance History</h4>
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

                         
                          <div class="table-responsive">
                                <table id="" class="table table-striped table-bordered table-td-valign-middle datatables">
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
                                        <td>  {{ $detail->student?$detail->student->classes->name:'' }} </td>
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
    </div>
  
@endsection
