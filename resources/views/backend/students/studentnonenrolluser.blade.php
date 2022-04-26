@extends('backend.layouts.app')
@section('title', 'Non Enrollment User List')
@section('content')
    <div id="content" class="content">
        <div class="panel panel-inverse">
            <div class="panel-heading">
                <h4 class="panel-title">Non Enrollment User List</h4>
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
                
            <form class="" method="get">
                  
                <input type="text" id="mobile" name="mobile" @if (isset($mobile)) value="{{ $mobile }}" @endif class="form-control mobile_class"
                        placeholder="Enter Mobile number">
                        
                <button type="submit" class="btn btn-primary btn-sm" id="search_id"> <i class="fa fa-search"></i> Search</button>
                
             </form>

            <div class="table-responsive">
                <table class="table table-sm table-striped table-bordered table-td-valign-middle table-responsive">
                    <thead>
                        <tr>
                            <th width="1%">SL</th>
                            <th class="text-nowrap">Image</th>
                            <th class="text-nowrap">User UID</th>
                            <th class="text-nowrap">Name</th>
                            <th class="text-nowrap">Email</th>
                            <th class="text-nowrap">Mobile</th>
                            <th class="text-nowrap">Class</th>
                            <th class="text-nowrap">Created On</th>
                            <th class="text-nowrap">Batch</th>

                            <th class="text-nowrap">Status</th>
                            <th class="text-nowrap">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @php
                            $i = 1;
                        @endphp
                        @foreach ($studentusers as $user)
                          @if ($user->activestudents->count() ==  0)
                                       
                            <tr>
                                <td>{{ $i++ }}</td>
                                <td> <a href="{{ asset($user->image) }}"> <img src="{{ asset($user->image) }}" alt=""
                                            width="50"></a> </td>
                                <td>{{ $user->useruid }}</td>
                                <td>{{ $user->name }}</td>
                                <td>{{ $user->email }}</td>
                                <td>{{ $user->mobile }}</td>
                                <td>{{ $user->classes ? $user->classes->name : '' }}</td>
                                <td>{{ $user->created_at }}</td>
                                <td>
                                     
                                        <p>No Batch</p>
                                 
                                </td>
                                <td>
                                    @if ($user->status == 1)
                                        <p class="btn btn-primary btn-xs">Active</p>
                                    @elseif($user->status==2)
                                        <p class="btn btn-danger btn-xs">Deactive</p>
                                    @elseif($user->status==3)
                                        <p class="btn btn-danger btn-xs">Verification Pending</p>
                                    @endif
                                </td>

                                <td>
                                    <div class="dropdown">
                                        <button type="button" class="btn btn-sm  btn-primary dropdown-toggle"
                                            data-toggle="dropdown">
                                            <i class="fa fa-cogs"></i> Action </button>
                                        <div class="dropdown-menu">
                                            <a href="{{ route('student.user.show', $user->id) }}"
                                                class="dropdown-item">
                                                <i class="fa fa-eye"></i> Show
                                            </a>
                                            <a href="{{ route('student.user.edit', $user->id) }}"
                                                class="dropdown-item">
                                                <i class="fa fa-edit"></i> Edit
                                            </a>
                                            <a href="{{ route('student.user.login.dashboard',$user->id) }}" class="dropdown-item"><i class="fa fa-dashboard"></i> Student Dashboard</a>

                                            <a href="{{ route('student.user.destory', $user->id) }}" id="delete"
                                                class="dropdown-item"> <i class="fa fa-trash"></i> Delete</a>
                                </td>
                            </div>
                        </div>
                     </tr>
                        @endif
                      @endforeach
                    </tbody>
                </table>

                </div>

               

 

             </div>
        </div>
    </div>



@endsection
