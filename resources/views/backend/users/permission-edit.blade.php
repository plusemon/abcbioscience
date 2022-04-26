@extends('backend.layouts.app')
@section('title', 'Edit User Permission')
@section('content')



    <div id="content" class="content">
        <div class="row">
            <div class="col-xl-6">
                <div class="panel panel-inverse" data-sortable-id="form-stuff-10">
                    <div class="panel-heading">
                        <h4 class="panel-title">Edit User Permission</h4>
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
                        <form action="{{ route('user.permission.update', $user->id) }}" method="POST">
                            @csrf
                            <div class="mb-2">
                                <ul>
                                    @foreach ($permissions as $permission)
                                        <li>
                                            <input type="checkbox" name="permissions[]" value="{{ $permission->name }}"
                                                   id="{{ $permission->id }}" {{ $user_permissions->find($permission->id) ? 'checked':'' }}>
                                            <label for="{{ $permission->id }}">{{ $permission->name }}</label>
                                        </li>
                                    @endforeach
                                </ul>
                            </div>

                           <div class="d-flex justify-content-between">
                              <a href="{{ route('user.index') }}" class="btn btn-dark">Back</a>
                                <button type="submit" class="btn btn-success">Update</button>
                           </div>

                        </form>
                    </div>

                </div>
            </div>

        </div>
    </div>


@endsection

@section('customjs')


@endsection
