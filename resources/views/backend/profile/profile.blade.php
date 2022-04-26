@extends('backend.layouts.app')
@section('title','User Profile')
@section('content')
 <div id="content" class="content">
            <div class="panel panel-inverse">
                <div class="panel-heading">
                    <h4 class="panel-title">User Profile</h4>
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
                    <table id="data-table-default" class="table table-striped table-bordered table-td-valign-middle">
                         
                        <tbody>
                 	    
                        <tr>
                           <th width="15%">Image</th>
                            <td><img src="{{ asset($profile->image) }}" alt="" width="50"></td>
                        </tr>
                        <tr>
                            <th>User Id</th>
                            <td>{{ $profile->user_uid }}</td>
                        </tr>
                        <tr>
                            <th>Name</th>
                            <td>{{ $profile->name }}</td>

                        </tr>
                        <tr>
                            <th>Mobile</th>
                            <td>{{ $profile->mobile }}</td>
                        </tr>
                        <tr>
                            <th>Email</th>
                            <td>{{ $profile->email }}</td>
                        </tr>
                        <tr>
                            <th>Role</th>
                            <td>{{ $profile->role?$profile->role->name:'' }}</td>
                        </tr>

                        <tr>
                            <th>Account Created Date</th>
                            <td>{{ $profile->created_at }}</td>
                        </tr> 

                        <tr>
                            <th>Account Update Date</th>
                            <td>{{ $profile->updated_at }}</td>
                        </tr>

 
                        <tr>
                            <th>Status</th>
                            <td>
                                @if($profile->status==1)
                                <p class="btn btn-primary btn-xs">Active</p>
                                @elseif($profile->status==2)
                                <p class="btn btn-danger btn-xs">Deactive</p>
                                @endif
                            </td>
                        </tr>

                        <tr>
                            <th>Action</th>
                            <td>
                                  <a href="{{ route('user.profile.edit') }}" class="btn btn-xs btn-success">
                                    <i class="fa fa-edit"></i> Edit
                                </a> 
                            </td>
                        </tr>
  
                             
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        


@section('customjs')


@endsection
@endsection