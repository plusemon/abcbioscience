@extends('backend.layouts.app')
@section('title','Setting')
@section('content')



<div id="content" class="content">
    <div class="row">
        <div class="col-xl-6">
            <div class="panel panel-inverse" data-sortable-id="form-stuff-10">
                <div class="panel-heading">
                    <h4 class="panel-title">Setting</h4>
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
                    <form action="{{ route('user.setting.update') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                             
                        <div class="form-group">
                            <label for="url">Old Password</label>
                            <input type="password" name="current_password" value="{{ old('current_password') }}" class="form-control" placeholder="Enter New Password" />
                            <div class="text-danger">{{ $errors->first('current_password') }}</div>
                        </div>
                           
                        <div class="form-group">
                            <label for="details">New Password</label>
                            <input type="password" name="new_password" value="{{ old('new_password') }}" class="form-control" placeholder="Enter New Password" />
                            <div class="text-danger">{{ $errors->first('new_password') }}</div>
                        </div>
                           
                        <div class="form-group">
                            <label for="name">Confirm Password</label>
                            <input type="password" name="password_confirmation" value="{{ old('password_confirmation') }}" class="form-control" placeholder="Enter Confirm Password" />
                            <div class="text-danger">{{ $errors->first('password_confirmation') }}</div>
                        </div>
                           
                        
 
                        <button type="submit" class="btn btn-sm btn-primary m-r-5">Update Password</button>
                        <a class="btn btn-sm btn-default" href="{{ route('user.profile') }}">Back Profile</a>

                    </form>
                </div>

            </div>
        </div>

    </div>
</div>


@section('customjs')


@endsection
@endsection
