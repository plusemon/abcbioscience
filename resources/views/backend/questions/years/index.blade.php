@extends('backend.layouts.app')
@section('title','Year')
@section('content')


    <div id="content" class="content">
        <div class="panel panel-inverse">
            <div class="panel-heading">
                <h4 class="panel-title">Year List  </h4>
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

                <a href="{{ route('year.create') }}" class="btn btn-primary btn-sm float-right mb-1" id="create-new-class"><i class="fa fa-plus"></i> Add year</a>

                <table id="laravel_datatable" class="table table-striped table-bordered table-td-valign-middle">
                    <thead>
                    <tr>
                        <th class="text-nowrap">Serial no</th>
                        <th class="text-nowrap">year</th>
                        <th class="text-nowrap">Action</th>
                    </tr>
                    </thead>
                    <tbody>

                    @foreach($years as $year)
                        <tr>
                            
                            <td>{{ $loop->iteration }}</td>
                            <td>{{$year->name}}</td>
                            <td>
                                
                                <a href="{{route('year.edit',$year->id)}}" class="btn btn-primary"><i class="fa fa-edit"></i> Edit</a>
                                <a href="{{route('year.destroy',$year->id)}}" id="delete" class="btn btn-danger"> <i class="fa fa-trash"></i> Delate</a>
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>



            {{--  =============  for add new class ========================== --}}

            <div class="modal fade" id="ajax-class-modal" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h4 class="modal-title" id="modeltitle"></h4>
                        </div>
                        <div class="modal-body">
                            <form id="classForm" name="classForm" class="form-horizontal">
                                <input type="hidden" name="class_id" id="class_id">
                                <div class="form-group">
                                    <label for="name" class="col-sm-12 control-label">Class</label>
                                    <div class="col-sm-12">
                                        <input type="text" class="form-control" id="name" name="name"  value="" placeholder="Enter class name" required="">
                                    </div>
                                </div>
                                <div class="col-sm-offset-2 col-sm-10">
                                    <button type="submit" class="btn btn-primary" id="btn-save" value="create">Save
                                    </button>
                                </div>
                            </form>
                        </div>
                        <div class="modal-footer">

                        </div>
                    </div>
                </div>
            </div>









            {{--  =============  for add new class ========================== --}}







        </div>
    </div>

@endsection
