@extends('backend.layouts.app')
@section('title','Social Media')
@section('content')



 <div id="content" class="content">
            <div class="panel panel-inverse">
                <div class="panel-heading">
                    <h4 class="panel-title">Social Media</h4>
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
                	<a href="{{ route('social.create') }}" class="btn btn-primary btn-xs pull-right mb-2"><i class="fa fa-plus"></i> Add New</a>
                    <table id="data-table-default" class="table table-striped table-bordered table-td-valign-middle">
                        <thead>
                            <tr>
                                <th width="1%">SL</th>
                                <th class="text-nowrap">Name</th>
                                <th class="text-nowrap">Icon</th>
                                <th class="text-nowrap">Color</th>
                                <th class="text-nowrap">link</th>
                                <th class="text-nowrap">action</th>

                            </tr>
                        </thead>
                        <tbody>

                        	@foreach($socialMedia as $social)
                            <tr class="odd gradeX">
                                <td width="1%" class="f-w-600 text-inverse">{{ $loop->iteration }}</td>
                                <td>{{ $social->name }}</td>
                                <td>{{ $social->icon }}</td>
                                <td>{{ $social->color }}</td>
                                <td><a href="{{ $social->link }}" target="_blank">{{ $social->name }}</a></td>
                                <td>
                               	    <a href="{{ route('social.edit',$social->id) }}" class="btn btn-xs btn-success">
                            		<i class="fa fa-edit"></i> Edit
                            	</a> 
                            	 
                            	<a href="{{ route('social.destroy',$social->id) }}" id="delete" class="btn btn-xs btn-danger">
                            		<i class="fa fa-times"></i> Delete
                            	</a> 
                               	</td>
                            </tr>
                            @endforeach
                           
                             
                             
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        


@section('customjs')


@endsection
@endsection