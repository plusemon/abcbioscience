@extends('backend.layouts.app')
@section('title','About Content')
@section('content')

    <div id="content" class="content">
        <div class="panel panel-inverse">
            <div class="panel-heading">
                <h4 class="panel-title">About Content</h4>
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
                                <div class="col-12">
                                    <div class="card">
                                        <div class="card-body">

                                            <div class="table-responsive">
                                                <table id="" class="table dt-responsive nowrap w-100">
                                                    <thead>
                                                        <tr>
                                                            <th>Menu</th>
                                                            <th>Information</th>
                                                        </tr>

                                                    </thead>
                                                    <tbody>
                                                        <tr>
                                                            <th>Home Page About Heading</th>
                                                            <td>
                                                                {{$about->body_about_title}}
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <th>Home Page About Description</th>
                                                            <td>
                                                                {!! $about->body_about_description !!}
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <th>Home Page about image</th>
                                                            <td>
                                                                <img src="{{asset($about->body_about_image)}}" alt="" class="w-25">
                                                            </td>
                                                        </tr>

                                                        <tr>
                                                            <th>Footer About</th>
                                                            <td>
                                                                {!! $about->footer_about !!}
                                                            </td>
                                                        </tr>



                                                        <tr>
                                                            <th>About Description</th>
                                                            <td>{!! $about->details !!}</td>
                                                        </tr>
                                                        <tr>
                                                            <th>Mission Description</th>
                                                            <td>{!! $about->mission_details !!}</td>
                                                        </tr>
                                                        <tr>
                                                            <th>Mission image</th>
                                                            <th><img src="{{ asset($about->mission_image) }}" alt="" width="100"></th>
                                                        </tr>
                                                        <tr>
                                                            <th>Vission Description</th>
                                                            <td>{!! $about->vission_details !!}</td>
                                                        </tr>
                                                        <tr>
                                                            <th>Image</th>
                                                            <th><img src="{{ asset($about->vission_image) }}" alt="" width="100"></th>
                                                        </tr>
                                                        <tr>
                                                            <td>Action</td>
                                                            <td>
                                                                <a href="{{ route('admin.about.edit',$about->id) }}" title="" class="btn btn-primary">Update</a>
                                                            </td>
                                                        </tr>


                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
                                        <!-- end card-body -->
                                    </div>
                                    <!-- end card -->
                                </div> <!-- end col -->
                            </div> <!-- end row -->




                        </div> <!-- container-fluid -->
                    </div>
                    <!-- End Page-content -->

            </div>
        </div>



@endsection
