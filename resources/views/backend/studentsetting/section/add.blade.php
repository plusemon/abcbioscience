@extends('backend.layouts.app')
@section('title','Add New addspositions')
@section('content')



<div id="content" class="content">
    <div class="row">
        <div class="col-xl-6">
            <div class="panel panel-inverse" data-sortable-id="form-stuff-10">
                <div class="panel-heading">
                    <h4 class="panel-title">Add New addspositions</h4>
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
                    <form action="{{ route('ads.position.store') }}" method="POST">
                        @csrf
                        <div class="form-group">
                            <label for="">Add Position Name</label>
                            <input type="text" name="name" value="{{ old('name') }}" class="form-control" placeholder="Enter add position Name" />
                            <div class="text-danger">{{ $errors->first('name') }}</div>
                        </div>

                        <button type="submit" class="btn btn-sm btn-primary m-r-5">Submit</button>
                        <a class="btn btn-sm btn-default" href="{{ route('ads.position.index') }}">Cancel</a>

                    </form>
                </div>

            </div>
        </div>

    </div>
</div>


@section('customjs')


@endsection
@endsection
