@extends('backend.layouts.app')
@section('title','Subject List')
@section('content')


    <div id="content" class="content">
        <div class="panel panel-inverse">
            <div class="panel-heading">
                <h4 class="panel-title"> Subjects List  </h4>
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

                <a href="{{ route('old.subject.create') }}" class="btn btn-primary btn-sm float-right mb-1" id="create-new-class"><i class="fa fa-plus"></i> Add Subject</a>

                <table id="laravel_datatable" class="table table-striped table-bordered table-td-valign-middle">
                    <thead>
                    <tr>
                        <th class="text-nowrap">Serial</th>
                        
                        <th class="text-nowrap">Name</th>
                        <th class="text-nowrap">status</th>
                        <th class="text-nowrap">Action</th>
                    </tr>
                    </thead>
                    <tbody>

                    @foreach($subjects as $subject)
                        <tr>
                             
                            <td>{{ $loop->iteration }}</td>
                            <td>{{$subject->name}}</td>
                            <td>
                                @if($subject->status==1)
                                    <p class="btn btn-primary">Active</p>
                                @elseif($subject->status==2)
                                    <p class="btn btn-danger">inactive</p>
                                @endif
                            </td>
                            <td>
                                
                                <a href="{{route('old.subject.edit',$subject->id)}}" class="btn btn-primary">Edit</a>
                                <a href="{{route('old.subject.destroy',$subject->id)}}" id="delete" class="btn btn-danger">Delate</a>
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>


 

 

        </div>
    </div>

@endsection
