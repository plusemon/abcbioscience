error(0)
@extends('backend.layouts.app')
@section('title','All Slider List ')
@section('content')


    <div id="content" class="content">
        <div class="panel panel-inverse">
            <div class="panel-heading">
                <h4 class="panel-title">All Slider List  </h4>
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

                <a href="{{ route('slider.create') }}" class="btn btn-primary btn-sm float-right mb-1" id="create-new-class"><i class="fa fa-plus"></i> Add Slider </a>

                <table id="laravel_datatable" class="table table-striped table-bordered table-td-valign-middle">
                    <thead>
                    <tr>
                        <th class="text-nowrap">Serial no</th>
                         
                        <th class="text-nowrap">image</th>
                      
                        <th class="text-nowrap">status</th>
                        <th class="text-nowrap">Action</th>
                    </tr>
                    </thead>
                    <tbody>

                    @foreach($sliders as $slider)
                        <tr>
                            <td>{{$loop->index+1}}</td>
                         
                            <td><img style="width: 80px;" src="{{ asset($slider->image)}}" alt=""> </td>
                            <td>
                                @if($slider->status==1)
                                    <p class="btn btn-primary btn-sm">Active</p>
                                @elseif($slider->status==2)
                                    <p class="btn btn-danger btn-sm">inactive</p>
                                @endif
                            </td>

                            <td>
                                 
                                <a href="{{route('slider.edit',$slider->id)}}" class="btn btn-sm btn-primary"><i class="fa fa-edit"></i> Edit</a>
                                <a href="{{route('slider.destroy',$slider->id)}}" id="delete" class="btn btn-sm btn-danger"><i class="fa fa-trash"></i> Delate</a>
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
