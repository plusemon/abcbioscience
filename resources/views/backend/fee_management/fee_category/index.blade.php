@extends('backend.layouts.app')
@section('title','Fee Category list')
@section('content')
 <div id="content" class="content">
            <div class="panel panel-inverse">
                <div class="panel-heading">
                    <h4 class="panel-title">Fee Category list </h4>
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
                  
                    <a href="{{route('admin.fee-category.create')}}" class="btn-primary btn float-right mb-1"> <i class="fa fa-plus"></i> Add Fee Category </a>
                    
                    <table id="laravel_datatable" class="table table-striped table-bordered table-td-valign-middle" style="margin-top:10px;">
                        <thead>
                            <tr>
                                <th width="1%">ID</th>
                                {{--  <th class="text-nowrap">Module Name</th>  --}}
                                <th class="text-nowrap">Name</th>
                                <th class="text-nowrap">Fee Category Type</th>
                                <th class="text-nowrap">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($fee_categories as $item)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $item->name }}</td>
                                    {{--  <td>{{ $item->modules?$item->modules->name:NULL }}</td>  --}}
                                    <td>{{ $item->catTypes?$item->catTypes->name:NULL }}</td>
                                    <td>
                                        <a href="{{ route('admin.fee-category.edit',$item->id) }}" class="btn btn-primary btn-sm"><i class="fa fa-edit"></i> Edit</a>
                                        <a href="{{route('admin.feeCategoryDestory',$item->id)}}" id="delete" class="btn btn-danger btn-sm"><i class="fa fa-trash"></i> Delete</a>
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