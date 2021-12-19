@extends('backend.layouts.app')
@section('title','Web Site Setting')
@section('content')



 			<div id="content" class="content">
            <div class="row">
                <div class="col-xl-12">
                    <div class="panel panel-inverse" data-sortable-id="form-stuff-10">
                        <div class="panel-heading">
                            <h4 class="panel-title">Web Setting Edit</h4>
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
                            <form action="{{ route('website.setting.update') }}" method="POST" enctype="multipart/form-data">
                            	@csrf
                                   <div class="form-group">
                                        <label for="">Site Name</label>
                                        <input type="text"  name="site_name" value="{{ $setting->site_name }}" class="form-control" placeholder="Enter website Name" /> 
                                        <div class="text-danger">{{ $errors->first('site_name') }}</div>
                                    </div>

                                    <div class="form-group">
                                        <label for="">Home Page Title</label>
                                        <input type="text"  name="homepage_title" value="{{ $setting->homepage_title }}" class="form-control" placeholder="Enter Home Page Title" /> 
                                        <div class="text-danger">{{ $errors->first('homepage_title') }}</div>
                                    </div>

                                    <div class="form-group">
                                        <label for="">About</label>
                                        <textarea name="about" id="" class="form-control" placeholder="Enter About Short Description">{{ $setting->about }}</textarea>
                                        <div class="text-danger">{{ $errors->first('about') }}</div>
                                    </div>


                                    <div class="form-group">
                                        <label for="">Meta Tags</label>
                                        <textarea name="meta_tags" id="" class="form-control" placeholder="Enter Meta Tags">{{ $setting->meta_tags }}</textarea>
                                        <div class="text-danger">{{ $errors->first('meta_tags') }}</div>
                                    </div>

                                     


                                    <div class="form-group">
                                        <label for="">Meta Description</label>
                                        <textarea name="meta_description" id="" class="form-control" placeholder="Enter Meta Description">{{ $setting->meta_description }}</textarea>
                                        <div class="text-danger">{{ $errors->first('meta_description') }}</div>
                                    </div>
 

                                    <div class="form-group">
                                        <label for="">Site Banner</label>
                                         <input type="file" name="sitebanner" class="form-control">
                                        <div class="text-danger">{{ $errors->first('sitebanner') }}</div>
                                    </div>  

                                    <div class="form-group">
                                        <label for="">Site Logo</label>
                                         <input type="file" name="logo" class="form-control">
                                        <div class="text-danger">{{ $errors->first('logo') }}</div>
                                    </div>  

                                    <div class="form-group">
                                        <label for="">Site Footer Logo</label>
                                         <input type="file" name="footer_logo" class="form-control">
                                        <div class="text-danger">{{ $errors->first('footer_logo') }}</div>
                                    </div>   

                                    <div class="form-group">
                                        <label for="">Site favicon</label>
                                         <input type="file" name="favicon" class="form-control">
                                        <div class="text-danger">{{ $errors->first('favicon') }}</div>
                                    </div>   

                                    <div class="form-group">
                                        <label for="">Email</label>
                                         <input type="text" name="email" class="form-control" value="{{ $setting->email }}" placeholder="Enter Website Email">
                                        <div class="text-danger">{{ $errors->first('email') }}</div>
                                    </div>

                                    <div class="form-group">
                                        <label for="">Phone</label>
                                         <input type="text" name="phone" class="form-control" value="{{ $setting->phone }}" placeholder="Enter website Phone">
                                        <div class="text-danger">{{ $errors->first('phone') }}</div>
                                    </div>

  
                                     <div class="form-group">
                                        <label for="">State Address</label>
                                        <input type="text"  name="state_address" value="{{ $setting->state_address }}" class="form-control" placeholder="Enter State Address" /> 
                                        <div class="text-danger">{{ $errors->first('state_address') }}</div>
                                    </div>    

                                    <div class="form-group">
                                        <label for="">Local Address</label>
                                        <input type="text"  name="local_address" value="{{ $setting->local_address }}" class="form-control" placeholder="Enter Local Address" /> 
                                        <div class="text-danger">{{ $errors->first('local_address') }}</div>
                                    </div> 


                                    <div class="form-group">
                                        <label for="">Local Address</label>
                                        <input type="text"  name="address" value="{{ $setting->address }}" class="form-control" placeholder="Enter Local Address" /> 
                                        <div class="text-danger">{{ $errors->first('address') }}</div>
                                    </div>  

                                    <div class="form-group">
                                        <label for="">Map Code</label>
                                        <input type="text"  name="map_code" value="{{ $setting->map_code }}" class="form-control" placeholder="Enter Local Address" /> 
                                        <div class="text-danger">{{ $errors->first('map_code') }}</div>
                                    </div>

                                    <button type="submit" class="btn btn-sm btn-primary m-r-5">Submit</button>
                                    <a  class="btn btn-sm btn-default" href="{{ route('website.setting.index') }}">Cancel</a>
                                
                            </form>
                        </div>
                        
                    </div>
                </div>
                
            </div>
         </div>
        
        











@section('customjs')


@endsection
@endsection