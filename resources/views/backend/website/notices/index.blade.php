@extends('backend.layouts.app')
@section('title','Website Notice')
@section('content')


    <div id="content" class="content">
        <div class="panel panel-inverse">
            <div class="panel-heading">
                <h4 class="panel-title">All Website Notice  </h4>
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

                <a href="{{route('notice.create')}}" class="btn btn-primary btn-sm float-right mb-1" id="create-new-class"><i class="fa fa-plus"></i> Add Notice</a>

                <table id="laravel_datatable" class="table table-striped table-bordered table-td-valign-middle">
                    <thead>
                    <tr>
                        <th class="text-nowrap">SL</th>
                         <th class="text-nowrap">Title</th>
                        <th class="text-nowrap">Publish Date</th>
                        <th class="text-nowrap">Notice file</th>
                        <th class="text-nowrap">Status</th>
                        <th class="text-nowrap">User </th>
                        <th class="text-nowrap">Action</th>
                    </tr>
                    </thead>
                    <tbody>

                    @foreach($notices as $notice)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{$notice->title}}</td>
                            <td>{{$notice->publish_date}}</td>
                            <td>

                                <a href="{{ asset($notice->noticesfile) }}"  download="">Download</a>
                                
                           </td>
                            <td>
                                @if($notice->status==1)
                                    <p class="btn btn-primary btn-sm">Active</p>
                                @elseif($notice->status==2)
                                    <p class="btn btn-danger btn-sm">inactive</p>
                                @endif
                            </td>
                            <td>{{ $notice->user ? $notice->user->name:'no user'  }}</td>
                            <td>
                                
                                <a href="{{route('notice.edit',$notice->id)}}" class="btn btn-primary btn-sm"> <i class="fa fa-edit"></i> Edit</a>
                                <a href="{{route('notice.destroy',$notice->id)}}" id="delete" class="btn btn-danger btn-sm"> <i class="fa fa-trash"></i> Delate</a>
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>


             </div>
        </div>
    </div>

@endsection
