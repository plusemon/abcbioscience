@extends('backend.layouts.app')
@section('title','Add New Notice')
@section('content')


    <div id="content" class="content">
        <div class="panel panel-inverse">
            <div class="panel-heading">
                <h4 class="panel-title">Add New Notice  </h4>
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
                <form action="{{ route('notice.store') }}" method="post" enctype="multipart/form-data">
                    @CSRF
                    <div class="form-group">
                        <label for="title">Title</label>
                        <input type="text" name="title" class="form-control" id="title"  placeholder="Enter title">
                        @error('title')
                        <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="noticesfile">Notice File (PDF or Image)</label>
                        <input type="file" name="noticesfile" class="form-control" id="noticesfile" accept=".jpg,.jpeg,.png,.JPG,.JPEG,.pdf,.PDF">
                        @error('noticesfile')
                        <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>

                    
                    <div class="form-group">
                        <label for="status">Status</label>
                        <select name="status" id="status" class="form-control">
                            <option value="1">Active</option>
                            <option value="2">Inactive</option>
                        </select>
                    </div>

                    <button type="submit" class="btn btn-primary mt-3">Submit</button>

                </form>
            </div>









        </div>
    </div>

@endsection
