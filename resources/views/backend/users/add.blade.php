@extends('backend.layouts.app')
@section('title','Add New User')
@section('content')



<div id="content" class="content">
    <div class="row">
        <div class="col-xl-6">
            <div class="panel panel-inverse" data-sortable-id="form-stuff-10">
                <div class="panel-heading">
                    <h4 class="panel-title">Add New User</h4>
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
                    <form action="{{ route('user.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="form-group">
                            <label for="id">Role</label>
                            <select name="role_id" id="role_id" class="form-control">
                                <option value="">Select Role</option>
                                @foreach($roles as $role)
                                <option {{ old('role_id') == $role->id ? 'selected' : '' }} value="{{ $role->id }}"> {{ $role->name }}</option>
                                @endforeach
                            </select>
                            <div class="text-danger">{{ $errors->first('role_id') }}</div>
                        </div>
                           
                        <div class="form-group">
                            <label for="url">Name</label>
                            <input type="text" name="name" value="{{ old('name') }}" class="form-control" placeholder="Enter Name" />
                            <div class="text-danger">{{ $errors->first('name') }}</div>
                        </div>
                           
                        <div class="form-group">
                            <label for="details">Email</label>
                            <input type="text" name="email" value="{{ old('email') }}" class="form-control" placeholder="Enter Email Address" />
                            <div class="text-danger">{{ $errors->first('email') }}</div>
                        </div>
                           
                        <div class="form-group">
                            <label for="name">Mobile Number</label>
                            <input type="text" name="mobile" value="{{ old('mobile') }}" class="form-control" placeholder="Enter mobile number" />
                            <div class="text-danger">{{ $errors->first('mobile') }}</div>
                        </div>
                           
                        <div class="form-group">
                            <label for="">Password</label>
                            <input type="password" name="password" value="{{ old('password') }}" class="form-control" placeholder="Enter Password" />
                            <div class="text-danger">{{ $errors->first('password') }}</div>
                        </div>

                        <div class="form-group">
                            <label for="">Image</label>
                            <input type="file" name="image" value="{{ old('image') }}" class="form-control" placeholder="Enter Password" />
                            <div class="text-danger">{{ $errors->first('image') }}</div>
                        </div>


                         
                        <div class="form-group">
                            <label for="">Status</label>
                            <select name="status" class="form-control">
                                <option value="" > select status</option>
                                <option {{ old('status') == 1 ? 'selected' : 'selected'  }} value="1"> Active</option>
                                <option {{ old('status') == 2 ? 'selected' : ''  }} value="0"> Inactive</option>
                            </select>
                            <div class="text-danger">{{ $errors->first('status') }}</div>
                        </div>

                        <button type="submit" class="btn btn-sm btn-primary m-r-5">Submit</button>
                        <a class="btn btn-sm btn-default" href="{{ route('user.index') }}">Back</a>

                    </form>
                </div>

            </div>
        </div>

    </div>
</div>


@section('customjs')


@endsection
@endsection
