@extends('backend.layouts.app')
@section('title','Edit Social Media')
@section('content')



 			<div id="content" class="content">
            <div class="row">
                <div class="col-xl-6">
                    <div class="panel panel-inverse" data-sortable-id="form-stuff-10">
                        <div class="panel-heading">
                            <h4 class="panel-title">Edit Social Media</h4>
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
                            <form action="{{ route('social.update',$social->id) }}" method="POST" enctype="multipart/form-data">
                            	@csrf
                                   <div class="form-group">
                                        <label for="">Name</label>
                                        <input type="text"  name="name" value="{{ $social->name }}" class="form-control" placeholder="Enter social Media Name" /> 
                                        <div class="text-danger">{{ $errors->first('name') }}</div>
                                    </div> 

                                    <div class="form-group">
                                        <label for="">Link</label>
                                        <input type="text"  name="link" value="{{ $social->link }}" class="form-control" placeholder="Enter social Media link" /> 
                                        <div class="text-danger">{{ $errors->first('link') }}</div>
                                    </div>


                                    <div class="form-group">
                                        <label for="">Icon</label>
                                        <input type="text"  name="icon" value="{{ $social->icon }}" class="form-control" placeholder="Enter social Media icon" /> 
                                        <div class="text-danger">{{ $errors->first('icon') }}</div>
                                    </div>

                                    <div class="form-group">
                                        <label for="">Color</label>
                                        <input type="text"  name="color" value="{{ $social->color }}" class="form-control" placeholder="Enter social Media color" /> 
                                        <div class="text-danger">{{ $errors->first('color') }}</div>
                                    </div>
                                       
                                     
                                   
                                    <button type="submit" class="btn btn-sm btn-primary m-r-5">Submit</button>
                                    <a  class="btn btn-sm btn-default" href="{{ route('social.index') }}">Cancel</a>
                                
                            </form>
                        </div>
                        
                    </div>
                </div>
                
            </div>
         </div>
        
        
 
@section('customjs')


@endsection
@endsection