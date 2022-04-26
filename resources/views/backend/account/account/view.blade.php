

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
                  
                    <a href="{{route('admin.account.create')}}"class="btn-primary btn float-right mb-1"> <i class="fa fa-plus"></i> Add Account </a>
                    
                    <table id="example1" class="table table-bordered table-striped table-hover">
                            <thead>
                                <tr>
                                    <th>SN</th>
                                    <th>Payment Method</th>
                                    <th>Bank Name</th>
                                    <th>Account Name</th>
                                    <th>Account No</th>
                                    <th>Opening Amount</th>
                                    <th>Total Amount</th>
                                    <th>Address</th>
                                    <th style="width:4%;">Action</th>
                                </tr>
                            </thead>
                            @php
                                $totalOpeningAmount = 0;
                                $totalBalanceAmount = 0;
                            @endphp
                            <tbody>
                                @foreach($accounts as $account)
                                <tr>
                                    <td>{{$loop->iteration}}</td>
                                    <td>{{$account->paymentMethod?$account->paymentMethod->method:NULL}}</td>
                                    <td>{{$account->bank ? $account->bank->name : ""}}</td>
                                    <td>{{$account->account_name}}</td>
                                    <td>{{$account->account_no}}</td>
                                    <td>
                                        {{$account->opening_amount}}
                                       

                                    </td>
                                    <td>
                                      000
                                    </td>
                                    <td>{{$account->address}}</td>
                                    <td style="width:4%;">
                                        <a href="{{route('admin.account.edit',$account->id)}}"
                                            class="btn btn-info btn-xs edit"><i class="fa fa-edit"></i>
                                             Edit
                                        </a>
                                        <a id="delete" href="javascript:void(0)" class="btn btn-danger btn-xs delete"
                                            onclick="event.preventDefault(); document.getElementById('accounts{{ $loop->iteration }}').submit();">
                                            <i class="fa fa-trash-o"></i>Delete
                                        </a>
                                        <form class="delete" id="accounts{{ $loop->iteration }}"
                                            action="{{route('admin.account.destroy',$account->id)}}" method="POST"
                                            style="display: none;">
                                            @csrf
                                            @method('DELETE')
                                        </form>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                            <tfoot>
                                <tr>
                                    <th colspan="5" style="text-align:right;">
                                        <strong>Total</strong>
                                    </th>
                                    <th>
                                            <strong>{{$totalOpeningAmount}}</strong>
                                    </th>
                                    <th>
                                            <strong>{{$totalBalanceAmount}}</strong>
                                    </th>
                                    <th colspan="2"></th>
                                </tr>
                            </tfoot>
                        </table>

                </div>
            </div>
        </div>
        


@section('customjs')
    

    
    
@endsection
@endsection  