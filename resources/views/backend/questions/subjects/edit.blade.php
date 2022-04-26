@extends('backend.layouts.app')
@section('title','subject')
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
                <form action="{{ route('subject.update',$subject->id) }}" method="post">
                    @CSRF
                    <div class="form-group">
                        <label for="name" class="col-sm-12 control-label">Subject</label>
                        <div class="col-sm-12">
                            <input type="text" class="form-control" id="name" name="name"  value="{{ $subject->name }}" placeholder="Enter class name" required="">
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="status" class="col-sm-12 control-label">Status</label>
                        <select name="status" id="status" class="form-control">
                            <option class="d-none">-- select --</option>
                            <option  {{ $subject->status==1 ? 'selected' : ''}} value="1">active</option>
                            <option  {{ $subject->status==2 ? 'selected' : '' }} value="2">inactive</option>
                        </select>
                    </div>

                    <button type="submit" class="btn btn-primary mt-3">Submit</button>
                </form>
            </div>
        </div>
    </div>


@endsection
