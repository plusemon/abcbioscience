
@extends('backend.layouts.app')
@section('title','Student list')
@section('content')
 <div id="content" class="content">
            <div class="panel panel-inverse">
                <div class="panel-heading">
                    <h4 class="panel-title">Student list  </h4>
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
                  
                    <a href="{{route('admin.bank.create')}}" class="btn-primary btn float-right mb-1"> <i class="fa fa-plus"></i> Add Bank </a>
                    
                    <table id="example1" class="table table-bordered table-striped table-hover">
                        <thead>
                            <tr>
                                <th>SN</th>
                                <th>Bank Name</th>
                                <th>Short Name</th>
                                <th>Address</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($banks as $bank)
                            <tr>
                                <td>{{$loop->iteration}}</td>
                                <td>{{$bank->name}}</td>
                                <td>{{$bank->short_name}}</td>
                                <td>{{$bank->address}}</td>
                                <td>
                                   {{--  <a onclick="showData({{$bank->id}});" class="btn btn-success btn-xs"><i class="fa fa-eye" ></i> Show</a> --}}
                                    <a href="{{route('admin.bank.edit',$bank->id)}}" class="btn btn-info btn-xs edit"><i class="fa fa-edit"></i> Edit</a>
                                    <a id="delete" href="javascript:void(0)" class="btn btn-danger btn-xs delete" onclick="event.preventDefault(); document.getElementById('banks{{ $loop->iteration }}').submit();">
                                        <i class="fa fa-trash-o"></i>Delete
                                    </a>
                                    <form class="delete" id="banks{{ $loop->iteration }}" action="{{route('admin.bank.destroy',$bank->id)}}"
                                        method="POST" style="display: none;">
                                        @csrf
                                        @method('DELETE')
                                    </form>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                        <tfoot>
                            <tr>
                                <th>SN</th>
                                <th>Bank Name</th>
                                <th>Short Name</th>
                                <th>Address</th>
                                <th>Action</th>
                            </tr>
                        </tfoot>
                    </table>

                </div>
            </div>
        </div>
        


@section('customjs')
    

    
    
@endsection
@endsection  