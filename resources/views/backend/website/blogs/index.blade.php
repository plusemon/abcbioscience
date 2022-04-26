@extends('backend.layouts.app')
@section('title','blog List')
@section('content')


    <div id="content" class="content">
        <div class="panel panel-inverse">
            <div class="panel-heading">
                <h4 class="panel-title">Blog List  </h4>
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

                <a href="{{ route('blog.create') }}" class="btn btn-primary btn-sm float-right mb-1" id="create-new-class"><i class="fa fa-plus"></i> Add blog</a>

                <table id="laravel_datatable" class="table table-striped table-bordered table-td-valign-middle">
                    <thead>
                        <tr>
                            <th class="text-nowrap">SL</th>
                            <th class="text-nowrap">Title</th>
                            <th class="text-nowrap">Image</th>
                            <th class="text-nowrap">Status</th>
                            <th class="text-nowrap">Action</th>
                        </tr>
                    </thead>
                    <tbody>

                            @foreach($blogs as $blog)
                            <tr>
                              
                                <td>{{ $loop->iteration }}</td>
                                <td>{{$blog->title}}</td>
                                 
                                <td><img style="width: 80px;" src="{{ asset($blog->image)}}" alt=""> </td>
                                
                                <td>
                                    @if($blog->status==1)
                                        <p class="btn btn-primary btn-sm">Active</p>
                                    @elseif($blog->status==2)
                                        <p class="btn btn-danger btn-sm">Inactive</p>
                                    @endif
                                </td>

                                <td>
                                    <a href="{{ route('blog.show',$blog->id)}}" class="btn btn-success btn-sm"> <i class="fa fa-eye"></i> View</a>
                                    <a href="{{ route('blog.edit',$blog->id)}}" class="btn btn-primary btn-sm"> <i class="fa fa-edit"></i> Edit</a>
                                    <a href="{{ route('blog.destroy',$blog->id)}}" id="delete" class="btn btn-danger btn-sm"> <i class="fa fa-trash"></i> Delate</a>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                </table>
            </div>
 


        </div>
    </div>

@endsection
