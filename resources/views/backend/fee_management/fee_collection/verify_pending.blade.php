@extends('backend.layouts.app')
@section('title','Student Payment Verify Pending List ')
@section('content')
 <div id="content" class="content">
    <div class="panel panel-inverse">
        <div class="panel-heading">
            <h4 class="panel-title">Student Payment Verify Pending List  </h4>
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
                <div class="table-responsive">
                    <table id="laravel_datatable" class="table table-striped table-bordered table-td-valign-middle" style="margin-top:10px;">
                        <thead>
                            <tr>
                                <th width="1%">
                                     <input type="checkbox" value="all" name="check_all"
                                                     class="check_all_class" />
                                </th>
                                <th width="1%">ID</th>
                                <th class="text-nowrap">Student ID</th>
                                <th class="text-nowrap">Student Name</th>
                                <th class="text-nowrap">Class</th>
                                <th class="text-nowrap">Batch</th>
                                <th class="text-nowrap">Collection <br/> Month</th>
                                <th class="text-nowrap">Amount</th>
                                <th class="text-nowrap">Invoice <br> Generating  <br> Date</th>
                                <th class="text-nowrap">Depositing  Date</th>
                                <th class="text-nowrap">Session</th>
                                <th class="text-nowrap">Status</th>
                                <th class="text-nowrap">Fee Category</th>
                                <th class="text-nowrap">Method</th>
                                <th class="text-nowrap">Transaction ID</th>
                                <th class="text-nowrap">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($collections as $collection)
                                <tr>
                                    <td>
                                       <input type="checkbox" name="fee_id[]"
                                                         value="{{ $collection->id }}" class="check_single_class"
                                                         id="{{ $collection->id }}" />
                                    </td>
                                    <td>
                                        {{ $loop->iteration }}
                                    </td>
                                    <td>

                                        {{$collection->students?$collection->students->user?$collection->students->user->useruid:NULL:NULL}}
                                    </td>

                                    <td>

                                        {{$collection->students?$collection->students->user?$collection->students->user->name:NULL:NULL}}
                                    </td>

                                     <td>
                                        {{ $collection->classes?$collection->classes->name:NULL }}
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
                                    <td>{{ Date('d-m-Y',strtotime($collection->created_at)) }}</td>
                                    <td>{{ Date('d-m-Y',strtotime($collection->receive_date)) }}</td>
                                  

                                    <td>
                                        {{ $collection->sessiones?$collection->sessiones->name:NULL }}
                                    </td>
                                    <td>
                                        <p class="btn btn-warning btn-sm"> Verify Pending </p>
                                    </td>
                                    <td>
                                        {{$collection->feeCategores?$collection->feeCategores->name:NULL}}
                                    </td>
                                    <td>
                                        {{$collection->paymentmethod?$collection->paymentmethod->method:NULL}}
                                    </td>
                                    <td>
                                        {{$collection->transaction_id}}
                                    </td>

                                    <td>

                                        <a href="{{route('admin.student.payment.verify',$collection->id)}}" id="make_payment" class="btn btn-success btn-sm"><i class="fa fa-trash"></i>Make to Paid</a>
                                        
                                        <a href="{{route('admin.student.payment.unpaid',$collection->id)}}" id="make_unpaid" class="btn btn-warning btn-sm"><i class="fa fa-trash"></i> Make to Unpaid</a>

                                    
   
                                    </td>
                                </tr>
                            @endforeach
                            <tr>
                                <td colspan="7">Total </td>
                                <td>{{ $totalamount }} </td>
                                <td colspan="8"></td>
                            </tr>
                        </tbody>
                    </table>
                </div>
        </div>
    </div>
</div>
      


@section('customjs')

    <script>

        $('#transaction_id').hide();
        $('#payment_method_id').on('change',function(){
            var payment_method_id = $('#payment_method_id').val();
            if(payment_method_id==1)
            {
                $('#transaction_id').hide();
            }
            else{
                $('#transaction_id').show();
            }
        });


    </script>




    @endsection
@endsection  