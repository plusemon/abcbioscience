@extends('students.layouts.app')
@section('title', 'Payment History')
@section('content')
    <div id="content" class="content">
        <div class="panel panel-inverse">
            <div class="panel-heading">
                <h4 class="panel-title">Payment History</h4>
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
                <div class="row">
                    <div class="col-md-12">

                          @if($paymenthistories->count()>0)
                          <div class="table-responsive">
                                <table id="" class="table table-striped table-bordered table-td-valign-middle datatables" style="margin-top:10px;">
                                    <thead>
                                        <tr>
                                            <th width="1%">ID</th>
                                           
                                            <th class="text-nowrap">Payment <br/> Invoice</th>
                                            <th class="text-nowrap">Class</th>
                                            <th class="text-nowrap">Session</th>
                                            <th class="text-nowrap">Batch</th>
                                            <th class="text-nowrap">Collection <br/> Month</th>
                                            <th class="text-nowrap">Amount</th>
                                            <th class="text-nowrap">Fee Category</th>
                                            <th class="text-nowrap">Date</th>
                                            <th class="text-nowrap">Status</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($paymenthistories as $collection)
                                            <tr>
                                                <td>
                                                    {{ $loop->iteration }}
                                                </td>
                                                
                                                <td>
                                                    {{ $collection->invoice_no }}
                                                </td>
                                                <td>
                                                    {{ $collection->classes?$collection->classes->name:NULL }}
                                                </td>
                                                <td>
                                                    {{ $collection->sessiones?$collection->sessiones->name:NULL }}
                                                </td>
                                                <td>
                                                    {{ $collection->batchsetting?$collection->batchsetting->batch_name:NULL }}
                                                </td>
                                                <td>
                                                    {{ $collection->months?$collection->months->name:NULL }}
                                                </td>
                                                <td>
                                                    {{ $collection->amount }}
                                                </td>
                                                <td>
                                                    {{$collection->feeCategores?$collection->feeCategores->name:NULL}}
                                                </td>
                                                <td>
                                                    {{Date('d-m-Y h:i A',strtotime($collection->created_at))}}
                                                </td>

                                                <td>
                                                   <p class="btn btn-success btn-sm">Paid</p>
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>

                          </div>  
                          @else


                          <p class="pl-3">No Batch Found please enroll Batch  <a href="{{ route('allbatch') }}">here </a> </p>

                          @endif
                    </div>
                </div>

            </div>
        </div>
    </div>
     

@endsection
