@extends('backend.layouts.app')
@section('title','Edit SMS Templete')
@section('content')


    <div id="content" class="content">
        <div class="panel panel-inverse">
            <div class="panel-heading">
                <h4 class="panel-title">Edit SMS Templete  </h4>
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
                <a href="{{ route('sms_templete.index') }}" class="btn btn-primary btn-sm float-right mb-3" id="create-new-class"><i class="fa fa-list"></i>SMS template List</a>
                <form action="{{ route('sms_templete.update',$templete->id) }}" method="post">
                    @CSRF
                    <div class="form-group">
                        <label for="name">Name</label>
                        <input type="text" name="name" value="{{ $templete->name }}" id="name" class="form-control" placeholder="Sms Template Name">
                        @error('name')
                        <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>


                    <div class="form-group">
                        <label for="name">Message</label>
                         <textarea name="message" id="" class="form-control" placeholder="Enter Message Content">{{ $templete->message }}</textarea>
                        @error('name')
                        <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>



                    <div class="form-group">
                        <label for="image">Status</label>
                        <select name="status" id="status" class="form-control">
                            <option {{ $templete->status == 1 ? 'selected' :'' }} value="1">Active</option>
                            <option {{ $templete->status == 2 ? 'selected' :'' }} value="2">Inactive</option>
                        </select>
                        @error('status')
                        <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>

                    <button type="submit" class="btn btn-primary mt-3">Submit</button>

                </form>
            </div>







        </div>
    </div>

@endsection
