@extends('backend.layouts.app')
@section('title','Batch Schedule')
@section('content')
 <div id="content" class="content">
            <div class="panel panel-inverse">
                <div class="panel-heading">
                    <h4 class="panel-title">Batch List</h4>
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
                    <a class="btn btn-primary btn-sm pull-right" href="{{ route('batch.schedule.create') }}">Add New Batch</a>
                    <br>
                    <br>
                    <div class="table-responsive">
                     
                     <form method="get">
                            <div class="form-inline mb-4">
        
        
                                <select name="class_id" id="class_id" class="class_id form-control mr-3" >
                                    <option value="">Select Class</option>
                                    @foreach($classes as $class)
                                        <option @if(isset($class_id)) {{ $class_id == $class->id ? 'selected' :'' }} @endif value="{{ $class->id }}"> {{ $class->name }}</option>
                                    @endforeach
                                </select>
        
                                <select name="session_id" id="session_id" class="session_id form-control mr-3" >
                                    <option value="">Select Session</option>
                                    @foreach($sessiones as $session)
                                        <option @if(isset($session_id)) {{ $session_id == $session->id ? 'selected' :'' }} @endif value="{{ $session->id }}"> {{ $session->name }}</option>
                                    @endforeach
                                </select>
                                    
                                <button type="submit" class="btn btn-primary btn-sm" id="search_id"> <i class="fa fa-search"></i>  Search</button>
                        </div>
                   </form>   
                        
                        
                        
                    <table id="laravel_datatable" class="table table-bordered table-hovered">
                        <thead>
                             <tr>
                                <th>Sl</th>
                                <th>Batch ID</th>
                                <th>Batch Name</th>
                                <th>Total Seat</th>
                                <th>Total Students</th>
                                <th>Class </th>
                                <th>Session</th>
                                <th>Class Type</th>
                                <th>Day</th>
                                <th>Status</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            
                        
                        @foreach($batchsettings as $setting)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $setting->batch_uid }}</td>
                            <td> <a href="{{ route('student.folder.batch.student',$setting->id)  }}">  {{ $setting->batch_name }} </a> </td>
                            <td> {{$setting->total_seat }} </td>
                            <td> {{$setting->student?$setting->student->count():'' }} </td>
                            <td>{{ $setting->classes?$setting->classes->name:'' }}</td>
                            <td>{{ $setting->sessiones?$setting->sessiones->name:'' }}</td>
                            
                            <td>{{ $setting->classtype?$setting->classtype->name:'' }}</td>
                            <td>
                                @foreach($setting->dayandtime as $daytime)
                                <p>{{ $daytime->day?$daytime->day->name:'' }} - {{ Date('h:i A',strtotime($daytime->start_time)) }} - {{  Date('h:i A',strtotime($daytime->end_time)) }}</p>
                                @endforeach
                            </td>
                            <td>
                                @if($setting->status==1)
                                <p class="btn btn-primary btn-sm">Active</p>
                                @elseif($setting->status==2)
                                <p class="btn btn-danger btn-sm">Deactive</p>
                                @endif
                            </td>
                            <td>
                                <a class="btn btn-info btn-sm" href="{{ route('batch.schedule.edit',$setting->id) }}"> <i class="fa fa-edit"></i> Edit</a>
                                <a class="btn btn-danger btn-sm" href="{{ route('batch.schedule.destroy',$setting->id) }}"> <i class="fa fa-trash"></i> Delete</a>
                            </td>
                        </tr>


                        @endforeach
                        </tbody>
                    </table>

                    </div>

                </div>
            </div>
        </div>



@section('customjs')


@endsection
@endsection
