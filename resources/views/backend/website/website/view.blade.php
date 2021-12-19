@extends('backend.layouts.app')
@section('title','Website Setting')
@section('content')



 <div id="content" class="content">
            <div class="panel panel-inverse">
                <div class="panel-heading">
                    <h4 class="panel-title">Website Setting</h4>
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
                	<style>
                		table tr th{
                			width: 20%;
                		}
                	</style>
                    <table id="data-table-default" class="table table-striped table-bordered table-td-valign-middle">
                         <tr>
                         	<th>Site Name</th>
                         	<td>
                         		{{ $setting->site_name }}
                         	</td>
                         </tr>
                         <tr>
                         	<th>Homepage Title</th>
                         	<td>
                         		{{ $setting->homepage_title }}
                         	</td>
                         </tr> 

                         <tr>
                            <th>About Description</th>
                            <td>
                                {{ $setting->about }}
                            </td>
                         </tr>

                         <tr>
                         	<th>Meta tags</th>
                         	<td>
                         		{{ $setting->meta_tags }}
                         	</td>
                         </tr>
                         <tr>
                         	<th>Meta Description</th>
                         	<td>
                         		{{ $setting->meta_description }}
                         	</td>
                         </tr>
							<tr>
                         	<th>Site Banner</th>
                         	<td>
                         	 <img src="{{ asset($setting->sitebanner) }}" alt="" width="10%">	
                         	</td>
                         </tr>
   							</tr>
							<tr>
                         	<th>Site logo</th>
                         	<td>
                         	 <img src="{{ asset($setting->logo) }}" alt="" width="10%">	
                         	</td>
                         </tr>

					
						 

						<tr>
                         	<th>Footer logo</th>
                         	<td>
                         	 <img src="{{ asset($setting->favicon) }}" alt="" width="10%">	
                         	</td>
                         </tr>

                         <tr>
                         	<th>Footer logo</th>
                         	<td>
                         	 <img src="{{ asset($setting->favicon) }}" alt="" width="10%">	
                         	</td>
                         </tr>



                         <tr>
                         	<th>Email</th>
                         	<td>
                         		{{ $setting->email }}
                         	</td>
                         </tr>
						 <tr>
                         	<th>Phone</th>
                         	<td>
                         		{{ $setting->phone }}
                         	</td>
                         </tr>
                         <tr>
                         	<th>State Address</th>
                         	<td>
                         		{{ $setting->state_address }}
                         	</td>
                         </tr>

                         <tr>
                         	<th>Local Address</th>
                         	<td>
                         		{{ $setting->local_address }}
                         	</td>
                         </tr>
                         <tr>
                         	<th>Address</th>
                         	<td>
                         		{{ $setting->address }}
                         	</td>
                         </tr>


                         <tr>
                         	<th>Map Code</th>
                         	<td>
                         		{{ $setting->map_code }}
                         	</td>
                         </tr>

                         <tr>
                         	<th>Action</th>
                         	<td>
                         		<a href="{{ route('website.setting.edit') }}" class="btn btn-primary btn-sm">  <i class="fa fa-edit"></i> Edit </a>
                         	</td>
                         </tr>

 

                    </table>
                </div>
            </div>
        </div>
        


@section('customjs')


@endsection
@endsection  