@extends('backend.layouts.app')
@section('title','blog')
@section('content')


    <div id="content" class="content">
        <div class="panel panel-inverse">
            <div class="panel-heading">
                <h4 class="panel-title">Class  </h4>
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
                <form action="{{ route('blog.update',$blog->id) }}" method="post" enctype="multipart/form-data">
                    @CSRF
                    <div class="form-group">
                        <label for="title">Title</label>
                        <input type="text" name="title" value="{{$blog->title}}" class="form-control" id="title"  placeholder="Enter Title">
                    </div>
                    <div class="form-group">
                        <label for="image">Image</label>
                        <img src="{{ asset($blog->image)}}" alt="image">
                        <br>
                        <input type="file" name="image" class="form-control" id="title" >
                    </div>
                    <div class="form-group">
                        <label for="description">Description</label>
                        <textarea name="description" id="" cols="" rows="10" class="form-control summernote" placeholder="Enter Blog Content">{{ $blog->description }}</textarea>
                    </div>
                    <div class="form-group">
                        <label for="description">status</label>
                        <select name="status" id="" class="form-control">
                            <option  {{ $blog->status==1 ? 'selected' : ''}} value="1">active</option>
                            <option  {{ $blog->status==2 ? 'selected' : '' }} value="2">inactive</option>
                        </select>
                    </div>
                        <button type="submit" class="btn btn-primary mt-3">Submit</button>



                </form>
            </div>






        </div>
    </div>

@endsection
