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
                            <th class="text-nowrap">Created at</th>
                            <th class="text-nowrap">Batch</th>

                            <th class="text-nowrap">Status</th>
                            <th class="text-nowrap">Action</th>
                        </tr>
                    </thead>
                    <tbody>

                        @foreach ($studentusers as $user)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td> <a href="{{ asset($user->image) }}"> <img src="{{ asset($user->image) }}" alt=""
                                            width="50"></a> </td>
                                <td>{{ $user->useruid }}</td>
                                <td>{{ $user->name }}</td>
                                <td>{{ $user->email }}</td>
                                <td>{{ $user->mobile }}</td>
                                <td>{{ $user->classes ? $user->classes->name : '' }}</td>
                                <td>{{ $user->created_at }}</td>
                                <td>
                                    @if ($user->activestudents->count() > 0)
                                        @foreach ($user->activestudents as $userbatch)

                                            {{ $userbatch->batchsetting->batch_name }}

                                        @endforeach
                                    @else
                                        <p>No Batch</p>
                                    @endif
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
                      @endforeach
                    </tbody>
                </table>

                </div>

 