@extends('backend.layouts.app')
@section('title','Update Slider')
@section('content')


    <div id="content" class="content">
        <div class="panel panel-inverse">
            <div class="panel-heading">
                <h4 class="panel-title">Update Slider  </h4>
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
                <form action="{{ route('slider.update',$slider->id) }}" method="post" enctype="multipart/form-data">
                    @CSRF
                     
                    <div class="form-group">
                        <img src="{{ asset($slider->image)}}" alt="image">
                        <br>
                        <br>
                        <input type="file" name="imagefile" class="form-control" id="title" >
                        @error('image')
                        <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                     
                    <div class="form-group">
                        <label for="description">Status</label>
                        <select name="status" id="" class="form-control">
                            <option  {{ $slider->status==1 ? 'selected' : ''}} value="1">Active</option>
                            <option  {{ $slider->status==2 ? 'selected' : '' }} value="2">Inactive</option>
                        </select>

                        <button type="submit" class="btn btn-primary mt-3">Submit</button>

                </form>
            </div>



          
 




        </div>
    </div>

@endsection
