@extends('backend.layouts.app')
@section('title','Student Absent List')
@section('content')
 <div id="content" class="content">
            <div class="panel panel-inverse">
                <div class="panel-heading">
                    <h4 class="panel-title">Student Absent List  </h4>
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
                  
                    <a href="{{route('admin.absent.create')}}" class="btn-primary btn float-right mb-1"> <i class="fa fa-plus"></i> Add Student Absent </a>
                    
                    <table id="laravel_datatable" class="table table-striped table-bordered table-td-valign-middle" style="margin-top:10px;">
                        <thead>
                            <tr>
                                <th width="1%">ID</th>
                                <th class="text-nowrap">Student Name</th>
                                <th class="text-nowrap">Class</th>
                                <th class="text-nowrap">Session</th>
                                {{--  <th class="text-nowrap">Section</th>  --}}
                                <th class="text-nowrap">Batch</th>
                                <th class="text-nowrap">Type</th>
                                <th class="text-nowrap">Absent Month</th>
                                <th class="text-nowrap">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($absents as $absent)
                                <tr>
                                    <td>
                                        {{ $loop->iteration }}
                                    </td>
                                    <td>
                                        {{--  {{ $absent->user?$absent->user->name:NULL }}  --}}
                                        {{$absent->students?$absent->students->user?$absent->students->user->name:NULL:NULL}}
                                    </td>
                                    <td>
                                        {{ $absent->classes?$absent->classes->name:NULL }}
                                    </td>
                                    <td>
                                        {{ $absent->sessiones?$absent->sessiones->name:NULL }}
                                    </td>
                                   {{--   <td>
                                        {{ $absent->sections?$absent->sections->name:NULL }}
                                    </td>  --}}
                                    <td>
                                        {{ $absent->batchsetting?$absent->batchsetting->batch_name:NULL }}
                                    </td>
                                    <td>
                                        {{ $absent->batchTypes?$absent->batchTypes->name:NULL }}
                                    </td>
                                    <td>
                                        @php $i = 1; @endphp
                                        @foreach ($absent->absentMonths?$absent->absentMonths:'' as $key =>  $item)
                                              <span class="badge @if($i == 1) badge-primary @elseif($i == 2) badge-info @endif "> {{$item->month?$item->month->name:NULL}}
                                                - {{$item?$item->year:NULL}}
                                            </span>
                                             @php 
                                                if($i == 3)
                                                {
                                                    $i = 1;
                                                   echo "<br/>";
                                                }else{
                                                    $i++;
                                                }
                                             @endphp
                                        @endforeach
                                    </td>
                                    <td>
                                        <a href="{{ route('admin.absent.show',$absent->id) }}" class="btn btn-info btn-sm"><i class="fa fa-eye"></i> View</a>
                                        <a href="{{ route('admin.absent.edit',$absent->id) }}" class="btn btn-primary btn-sm"><i class="fa fa-edit"></i> Edit</a>
                                        <a href="{{route('admin.studentAbsentDestory',$absent->id)}}" id="delete" class="btn btn-danger btn-sm"><i class="fa fa-trash"></i> Delete</a>
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