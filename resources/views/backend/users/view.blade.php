@extends('backend.layouts.app')
@section('title','User List')
@section('content')
 <div id="content" class="content">
            <div class="panel panel-inverse">
                <div class="panel-heading">
                    <h4 class="panel-title">User List</h4>
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
                    <a href="{{ route('user.create') }}" class="btn btn-primary btn-xs pull-right mb-2"> <i class="fa fa-plus"></i> Add New Stuff</a>
                    <table id="data-table-default" class="table table-striped table-bordered table-td-valign-middle">
                        <thead>
                            <tr>
                                <th width="1%">SL</th>
                                <th class="text-nowrap">Image</th>
                                <th class="text-nowrap">User UID</th>
                                <th class="text-nowrap">Name</th>
                                <th class="text-nowrap">Email</th>
                                <th class="text-nowrap">Mobile</th>
                                <th class="text-nowrap">Role</th>
                                <th class="text-nowrap">Created at</th>
                                <th class="text-nowrap">Status</th>
                                <th class="text-nowrap">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                 	         
                 	    @foreach($users as  $user)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td><img src="{{ asset($user->image) }}" alt="" width="50"></td>
                            <td>{{ $user->useruid }}</td>
                            <td>{{ $user->name }}</td>
                            <td>{{ $user->email }}</td>
                            <td>{{ $user->mobile }}</td>
                            <td>{{ $user->role?$user->role->name:'' }}</td>
                            <td>{{ $user->created_at }}</td>
                            <td>
                            	@if($user->status==1)
                            	<p class="btn btn-primary btn-xs">Active</p>
                            	@elseif($user->status==2)
                            	<p class="btn btn-danger btn-xs">Deactive</p>
                            	@endif
                            </td>
                            
                            <td>
                                <a href="{{ route('user.permission.edit', $user->id) }}" class="btn btn-xs btn-success">
                            		<i class="fa fa-edit"></i> Edit Permission
                            	</a> 
                                <a href="{{ route('user.edit', $user->id) }}" class="btn btn-xs btn-success">
                            		<i class="fa fa-edit"></i> Edit
                            	</a> 
                            	 
                            	<a href="{{ route('user.destroy',$user->id) }}" id="delete" class="btn btn-xs btn-danger">
                            		<i class="fa fa-times"></i> Delete
                            	</a>
                            </td>
                        </tr>
                               
                        @endforeach

                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        



@endsection

@section('customjs')

@endsection