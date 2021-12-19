@extends('students.layouts.app')
@section('title', 'Enrollment Batch Details')
@section('content')
    <div id="content" class="content">
        <div class="panel panel-inverse">
            <div class="panel-heading">
                <h4 class="panel-title">Enrollment Batch Details</h4>
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
    </div>
  

@endsection
