@extends('backend.layouts.app')
@section('title','Add New About')
@section('content')

    <div id="content" class="content">
        <div class="panel panel-inverse">
            <div class="panel-heading">
                <h4 class="panel-title">Create About</h4>
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
                <div class="main-content">
                    <div class="page-content">
                        <div class="container-fluid">
                            <div class="row">
                                <div class="col-lg-12">
                                    <div class="card">
                                        <div class="card-body">

                                            <div class="text-right"><a href="{{route('admin.about.index')}}" class="btn btn-info btn-sm"> About</a></div>
                                            <hr>
                                            <div class="row">
                                                <div class="col-lg-12">
                                                    <div class="mt-1">
                                                        <form action="{{ route('admin.about.store') }}" method="post" enctype="multipart/form-data">
                                                            @csrf
                                                            <div class="row">

                                                                <div class="col-md-12">
                                                                    <div class="form-group">
                                                                        <div class="py-2">
                                                                            <label for="slug">Image <span class="text-danger"></span></label>
                                                                            <input type="file" name="image" value="{{old('image')}}" class="form-control">
                                                                            <div class="text-danger">{{ $errors->first('image') }}</div>
                                                                        </div>
                                                                        <div class="py-2">
                                                                            <label for="">Description <span class="text-danger"></span></label>
                                                                            <textarea name="details" id="summernote" class="form-control" placeholder="description">{{old('details')}}</textarea>
                                                                            <div class="text-danger">{{ $errors->first('details') }}</div>
                                                                        </div>
                                                                        <div class="py-2">
                                                                            <label for="slug">Mission Image <span class="text-danger"></span></label>
                                                                            <input type="file" name="mission_image" value="{{old('mission_image')}}" class="form-control">
                                                                            <div class="text-danger">{{ $errors->first('mission_image') }}</div>
                                                                        </div>
                                                                        <div class="py-2">
                                                                            <label for="">Mission Description <span class="text-danger"></span></label>
                                                                            <textarea name="mission_details"  class="form-control" placeholder="Mission description">{{old('mission_details')}}</textarea>
                                                                            <div class="text-danger">{{ $errors->first('mission_details') }}</div>
                                                                        </div>
                                                                        <div class="py-2">
                                                                            <label for="slug">Vission Image <span class="text-danger"></span></label>
                                                                            <input type="file" name="vission_image" value="{{old('vission_image')}}" class="form-control">
                                                                            <div class="text-danger">{{ $errors->first('vission_image') }}</div>
                                                                        </div>
                                                                        <div class="py-2">
                                                                            <label for="">Vission Description <span class="text-danger"></span></label>
                                                                            <textarea name="vission_details"  class="form-control" placeholder="Vission description">{{old('vission_details')}}</textarea>
                                                                            <div class="text-danger">{{ $errors->first('vission_details') }}</div>
                                                                        </div>

                                                                    <div class="mt-6 col-12">
                                                                        <button type="submit" class="btn btn-primary w-md"><i class="fa fa-check"></i> create</button>
                                                                    </div>
                                                        </form>
                                                    </div>
                                                </div>
                                            </div>

                                        </div>
                                    </div>
                                </div>
                            </div>



                        </div> <!-- container-fluid -->
                    </div>
                    <!-- End Page-content -->

            </div>
        </div>



@endsection
