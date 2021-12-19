@extends('backend.layouts.app')
@section('title','Waiver Type List')
@section('content')
 <div id="content" class="content">
            <div class="panel panel-inverse">
                <div class="panel-heading">
                    <h4 class="panel-title">Waiver Type List  </h4>
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

                    <form action="{{route('admin.waiver-type.store')}}" method="POST">
                        <div class="row">
                            @csrf
                            <input name="name"  type="text" class="form-control col-sm-12 col-md-10 " style="margin-left:5%;mergin-right:1%;"/>
                            <input type="submit" class="btn-primary btn float-right mb-1" value="submit" style="margin-left:1%;"/>
                        </div>
                    </form>
                    <table id="laravel_datatable" class="table table-striped table-bordered table-td-valign-middle" style="margin-top:10px;">
                        <thead>
                            <tr>
                                <th width="1%">ID</th>
                                <th class="text-nowrap">Name</th>
                                <th class="text-nowrap">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($waiverTypes as $item)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $item->name }}</td>
                                    <td>
                                        <a href="{{ route('admin.waiver-type.edit',$item->id) }}" class="btn btn-primary btn-sm"><i class="fa fa-edit"></i> Edit</a>
                                        <a href="{{route('admin.waiverTypeDestory',$item->id)}}" id="delete" class="btn btn-danger btn-sm"><i class="fa fa-trash"></i> Delete</a>

                                        {{-- <a id="delete" href="javascript:void(0)" class="btn btn-danger btn-sm delete" onclick="event.preventDefault(); document.getElementById('module{{ $loop->iteration }}').submit();">
                                                        <i class="fa fa-trash-o"></i>Delete
                                                    </a>
                                            <form class="delete" id="module{{ $loop->iteration }}" action="{{route('admin.module.destroy',$item->id)}}"
                                                method="POST" style="display: none;">
                                                @csrf
                                                @method('DELETE')
                                            </form> --}}
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