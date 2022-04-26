@extends('backend.layouts.app')
@section('title','Module Edit')
@section('content')
 <div id="content" class="content">
            <div class="panel panel-inverse">
                <div class="panel-heading">
                    <h4 class="panel-title">Module Edit  </h4>
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

                    <form action="{{route('admin.module.update',$module->id)}}" method="POST">
                        <div class="row">
                            @csrf
                            @method('PUT')
                            <input name="name"  value="{{$module->name}}" type="text" class="form-control col-sm-12 col-md-10 " style="margin-left:5%;mergin-right:1%;"/>
                            <input type="submit" class="btn-primary btn float-right mb-1" value="Update" style="margin-left:1%;"/>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        


@section('customjs')
    

    
    
@endsection
@endsection  