@extends('backend.layouts.app')
@section('title','Sheet Student Setting')
@section('content')

    <div id="content" class="content">
        <div class="panel panel-inverse">
            <div class="panel-heading">
                <h4 class="panel-title">Sheet Student Setting </h4>
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

                {{--  <a href="{{ route('admin.mcq.sssetting.student.setting.create') }}" class="btn btn-primary btn-sm float-right mb-1"><i class="fa fa-plus"></i></a>  --}}

                <table id="laravel_datatable" class="table  table-responsive table-striped table-bordered table-td-valign-middle">
                    <thead>
                    <tr>
                        <th class="text-nowrap">Sl No</th>
                        <th class="text-nowrap">Sheet No/Name</th>
                        <th class="text-nowrap">Sheet Type</th>
                        <th class="text-nowrap">Subject Name</th>
                        <th class="text-nowrap">Batch</th>
                        <th class="text-nowrap">Batch Type</th>
                        <th class="text-nowrap">Session</th>
                        <th class="text-nowrap">Class</th>
                        <th class="text-nowrap">Publish Date</th>
                        <th class="text-nowrap">Total Student<br/>Approved</th>
                        <th class="text-nowrap">Action</th>
                    </tr>
                    </thead>
                    <tbody>

                    @foreach($sheets as $sssetting)
                        <tr>
                            <td>{{ $loop->index+1}}</td>
                            <td>
                                {{ $sssetting->sheets?$sssetting->sheets->sheet_no :NULL}}
                            </td>
                            <td>
                                {{ $sssetting->sheetTypes?$sssetting->sheetTypes->name :NULL}}
                            </td>
                            <td>
                                {{ $sssetting->subjects?$sssetting->subjects->name:NULL}}
                            </td>

                            <td>{{ $sssetting->batchsetting?$sssetting->batchsetting->batch_name:''  }} </td>
                            <td>{{ $sssetting->batchTypies?$sssetting->batchTypies->name:''  }} </td>
                            <td>{{ $sssetting->sessiones?$sssetting->sessiones->name:''  }} </td>
                            <td>{{ $sssetting->classes?$sssetting->classes->name:''}}</td>

                            <td>{{ date('d-m-Y',strtotime($sssetting->sheetSettings?$sssetting->sheetSettings->publish_date :NULL ))}}</td>
                            <td>
                                {{ $sssetting->totalApprovedStudenForExam }}
                            </td>
                            <td>
                                <a href="{{route('admin.sheet.student.setting.create','sid='.$sssetting->sheet_setting_id)}}" class="btn btn-success btn-sm ">
                                    <small>View</small>
                                </a>
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
                {{$sheets->links()}}
            </div>

        </div>
    </div>

@endsection
