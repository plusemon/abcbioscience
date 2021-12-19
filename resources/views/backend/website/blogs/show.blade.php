@extends('backend.layouts.app')
@section('title','Show blog')
@section('content')


    <div id="content" class="content">
        <div class="panel panel-inverse">
            <div class="panel-heading">
                <h4 class="panel-title">Show Blog</h4>
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

                <table class="table table-bordered table-hovered">
                    <tr>
                        <th>Menu</th>
                        <th>Information</th>
                    </tr>
                    <tr>
                        <th width="5%">Title</th>
                        <td width="95%">{{ $blog->title }}</td>
                    </tr>

                    <tr>
                        <th width="5%">Slug</th>
                        <td width="95%">{{ $blog->slug }}</td>
                    </tr>

                    <tr>
                        <th width="5%">Image</th>
                        <td width="95%"> 
                            <img src="{{ asset($blog->image) }}" alt="" width="200">
                        </td>
                    </tr>

                    <tr>
                        <th width="5%">Description</th>
                        <td width="95%">{!! $blog->description !!}</td>
                    </tr>


                    <tr>
                        <th>Status</th>
                        <td>
                            @if($blog->status==1)
                                <p class="btn btn-primary btn-sm">Active</p>
                            @elseif($blog->status==2)
                                <p class="btn btn-danger btn-sm">Inactive</p>
                            @endif
                        </td>
                    </tr>

                    <tr>
                        <th>Action</th>
                        <td>
                     
                            <a href="{{ route('blog.edit',$blog->id)}}" class="btn btn-primary btn-sm"> <i class="fa fa-edit"></i> Edit</a>
                            <a href="{{ route('blog.destroy',$blog->id)}}" id="delete" class="btn btn-danger btn-sm"> <i class="fa fa-trash"></i> Delate</a>
                        </td>
                    </tr>



                </table>
 
                

            </div>
        </div>
    </div>

@endsection
