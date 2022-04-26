@extends('backend.layouts.app')
@section('title','Student Due Invoice List')
@section('content')
 <div id="content" class="content">
    <div class="panel panel-inverse">
        <div class="panel-heading">
            <h4 class="panel-title">Student Due Invoice List  </h4>
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
            
                <form method="get">
                    <input name="studentid" placeholder="Enter Student ID">
                    <button class="btn btn-primary btn-sm"> <i class="fa fa-search"></i> Search</button>
                </form>
            
            
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
                                <th class="text-nowrap">Generate Date</th>
                                <th class="text-nowrap">Session</th>
                                <th class="text-nowrap">Status</th>
                                 <th class="text-nowrap">Fee Category</th>
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
                                    <td>{{ Date('d-m-Y h:i A',strtotime($collection->created_at)) }}</td>
                                  

                                    <td>
                                        {{ $collection->sessiones?$collection->sessiones->name:NULL }}
                                    </td>
                                    <td>
                                        <p class="btn btn-danger btn-sm"> Unpaid </p>
                                    </td>
                                    <td>
                                        {{$collection->feeCategores?$collection->feeCategores->name:NULL}}
                                    </td>
                                    <td>

                                        <a href="{{route('admin.feeCollectionDestory',$collection->id)}}" id="delete" class="btn btn-danger btn-sm"><i class="fa fa-trash"></i> Delete</a>

                                        <a href="#" class="btn btn-success" data-toggle="modal" data-target="#exampleModal_{{ $collection->id }}"> <i class="fa fa-money-bill"></i> Make Payment</a>


                                             <!-- Modal -->
                                        <div class="modal fade" id="exampleModal_{{ $collection->id }}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                          <div class="modal-dialog">
                                                            <div class="modal-content">
                                                                <form action="{{ route('admin.student.due.invoice.store',$collection->id) }}" method="post">
                                                                @csrf
                                                                  <div class="modal-header">
                                                                    <h5 class="modal-title" id="exampleModalLabel">Make Payment</h5>
                                                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                      <span aria-hidden="true">&times;</span>
                                                                    </button>
                                                                  </div>
                                                                  <div class="modal-body">
                                                                    <label class="text-danger"> <b>Payment</b>  </label>
                                                                    <select class="form-control" name="payment_method_id" id="payment_method_id" required>
                                                                        <option value="">Please Select Payment Method</option>
                                                                        @php
                                                                            $paymentmethods = App\Model\PaymentMethod::whereIn('id',[1,2,3,9])->get();
                                                                        
                                                                        @endphp
                                                                        
                                                                        
                                                                        @foreach($paymentmethods as $method)
                                                                        <option value="{{ $method->id }}"> {{ $method->method }}</option>
                                                                        @endforeach
                                                                    </select>
                                                                  
                                                                    <br>
                                                                    <input type="text" class="form-control" name="transaction_id" value="" id="transaction_id" placeholder="Enter Transaction ID/Mobile Number" required>
                                                                    <div class="text-danger">  {{ $errors->first('transaction_id') }} </div>
                                                                    
                                                                    <br>
                                                                    <label>Payment Date</label>
                                                                    <input type="date" class="form-control" name="created_at" value="" id="created_at" placeholder="Date" required>
                                                                    <div class="text-danger">  {{ $errors->first('created_at') }} </div>
                                                                    
                                                                    
                                                                   
                                                                  </div>
                                                                  <div class="modal-footer">
                                                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                                                    <button type="submit" class="btn btn-primary">Submit</button>
                                                                  </div>
                                                               </form>
                                                            </div>
                                                          </div>
                                                        </div>
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