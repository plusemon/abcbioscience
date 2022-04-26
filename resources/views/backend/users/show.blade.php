@extends('backend.layouts.app')
@section('title', $user->name . 's information')
@section('content')
    <div id="content" class="content">
        <div class="panel panel-inverse">
            <div class="panel-heading">
                <h4 class="panel-title">{{ $user->name . 's information' }}</h4>
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
                <table class="table table-bordered">
                    <tr>
                        <th>Name</th>
                        <td>{{ $user->name ?? '' }}</td>
                        <th rowspan="2">Image</th>
                        <td rowspan="2"> <img src="{{ asset($user->image) }}" alt="" width="50"></a> </td>
                    </tr>

                    <tr>
                        <th>Mobile</th>
                        <td>{{ $user ? $user->mobile : '' }}</td>



                    </tr>
                    <tr>
                        <th>Address</th>
                        <td>{{ $user ? $user->address : '' }}</td>

                        <th width="10%">School Name</th>
                        <td width="40%"> {{-- {{ $user?$user->school_name:NULL }} --}} </td>
                    </tr>

                    <tr>
                        <th>Section</th>
                        <td>{{ $user ? $user->section_id : '' }}</td>

                        <th width="10%">Student ID</th>
                        <td width="40%">{{ $user->useruid }}</td>

                    </tr>

                    <tr>
                        <th width="10%">Father Name</th>
                        <td width="40%">{{ $user->studentInfo ? $user->studentinfo->father : '' }}</td>
                        <th width="10%">Mother</th>
                        <td width="40%">{{ $user->studentinfo ? $user->studentinfo->mother : '' }}</td>
                    </tr>

                    <tr>
                        <th width="10%">Guardian Mobile</th>
                        <td width="40%">
                            {{ $user->studentinfo ? $user->studentinfo->guardian_mobile : '' }}
                        </td>
                        <th width="10%">Own Mobile</th>
                        <td width="40%">{{ $user->studentinfo ? $user->studentinfo->own_mobile : '' }}
                        </td>
                    </tr>
                    <tr>
                        <th width="10%">Email</th>
                        <td width="40%">{{ $user->studentinfo ? $user->studentinfo->email : '' }}</td>
                        <th width="10%">Whatsapp</th>
                        <td width="40%">
                            {{ $user->studentinfo ? $user->studentinfo->whatsapp_number : '' }}
                        </td>
                    </tr>

                    <tr>
                        <th width="10%">facebook Id Link</th>
                        <td width="40%"> <a href="{{ $user->studentinfo ? $user->studentinfo->facebook_id : '' }}"
                                target="_blank">Facebook</a> </td>
                        <th width="10%">Bkash Number</th>
                        <td width="40%">
                            {{ $user->studentinfo ? $user->studentinfo->bkash_number : '' }}
                        </td>
                    </tr>
                    <tr>
                        <th width="10%">Note</th>
                        <td width="40%">{{ $user->studentinfo ? $user->studentinfo->notes : '' }} </td>
                        <th width="10%">Address</th>
                        <td width="40%">{{ $user->studentinfo ? $user->studentinfo->address : '' }}
                        </td>
                    </tr>

                </table>
            </div>
        </div>
        <div class="panel panel-inverse">
            <div class="panel-heading">
                <h4 class="panel-title">{{ $user->name }} Enrolled Batches </h4>
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
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th>Sl</th>
                            <th>Batch UID</th>
                            <th>Batch</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($batches as $student)
                            <tr>
                                <td>{{ $loop->index + 1 }}</td>
                                <td>{{ $student->batchsetting->batch_uid }}</td>
                                <td>{{ $student->batchsetting->batch_name }}</td>
                                <td><a class="btn btn-primary" href="{{ route('student.show', $student->id) }}"><i
                                            class="fa fa-eye"></i> View Batch Summery</a></td>
                            @empty

                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    @section('customjs')


    @endsection
@endsection
