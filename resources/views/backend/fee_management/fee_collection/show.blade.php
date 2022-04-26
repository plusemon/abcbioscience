    @extends('backend.layouts.app')
    @section('title','Show Fee Collection')
    @section('content')



                <div id="content" class="content">
                <div class="row">
                    <div class="col-xl-12">
                        <div class="panel panel-inverse" data-sortable-id="form-stuff-10">
                            <div class="panel-heading">
                                <h4 class="panel-title">Show Fee Collection </h4>
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
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label >Student Name</label>
                                               <input type="text" disabled  value="{{$collection->students?$collection->students->user?$collection->students->user->name:NULL:NULL}}" class="form-control" />
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label for="" >Class</label>
                                               <input type="text" disabled  value="{{ $collection->classes?$collection->classes->name:NULL }}" class="form-control" />
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label >Session</label>
                                                <input type="text" disabled  value=" {{ $collection->sessiones?$collection->sessiones->name:NULL }}" class="form-control" />
                                            </div>
                                        </div>
                                        
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label >Batch </label>
                                                <input type="text" disabled  value=" {{ $collection->batchsetting?$collection->batchsetting->batch_name:NULL }}" class="form-control" />
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label >Type of Class </label>
                                               <input type="text" disabled  value="{{$collection->students?$collection->students->studentype?$collection->students->studentype->name:NULL:NULL}}" class="form-control" />
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label >Month </label>
                                                <input type="text" disabled  value="{{ $collection->months?$collection->months->name:NULL }}" class="form-control" />
                                            </div>
                                        </div>
                                        
                                    </div>
                                        <hr/> <br/>
                                    <div class="row">
                                        <div class="col-md-12">
                                            <table class="table table-bordered table-hovered">
                                                <thead>
                                                    <tr>
                                                        <th>Sl</th>
                                                        <th>Fee Category</th>
                                                        <th>Payable <br/>(Amount)</th>
                                                        <th>Paid <br/>Amount</th>
                                                        <th><small>Total Paid</small> <br/>Amount</th>
                                                        <th>Payment <br/>Status</th>
                                                    </tr>
                                                </thead>
                                                <tbody class="show_result">
                                                    @php 
                                                        $totalPaybleAmount = 0; 
                                                        $totalPaidAmount = 0; 
                                                        $totalDueAmount = 0; 
                                                    @endphp
                                                   {{--  @foreach($collection->feeCollections?$collection->feeCollections:NULL as $collect)
                                                    <tr>
                                                        <td style="width:10%;">
                                                            <span style="font-size:15px;">{{ $loop->iteration }}.</span>
                                                        </td>
                                                        <td style="width:40%;">
                                                            {{ $collect->feeCategores?$collect->feeCategores->name:NULL }}
                                                            @php
                                                            $waiver =   $collect->waiveredStudent($collect->fee_cat_id,$collect->amount,$collection->student_id,$collection->class_id,$collection->session_id,$collection->batch_setting_id,$collection->receive_month_id);
                                                            $waiverType  = $waiver?$waiver->waiver_type_id:NULL; 
                                                            $waiverValue = $waiver?$waiver->waiver_value:NULL; 
                                                            $waiverSymbol = NULL;
                                                            $waiverAmount = 0;
                                                            $feeCateAmount = $collect->feeSettings?$collect->feeSettings->amount:0;
                                                            if($waiver)
                                                            {
                                                                if($waiverType == 1)
                                                                {
                                                                    $waiverAmount = (($waiverValue * $feeCateAmount) / 100);
                                                                    $waiverSymbol = '%';
                                                                }else{
                                                                    $waiverAmount = $feeCateAmount - $waiverValue;
                                                                }
                                                            }
                                                          
                                                            $payableAmount = ($feeCateAmount - $waiverAmount);
                                                            /*------------paid amount---------------*/
                                                            $padiAmount =   $collect->paidAmount($collect->fee_collection_main_id,$collect->fee_cat_id,$collection->receive_month_id);
                                                            $dueAmount  =   $payableAmount - $padiAmount ;
                                                                                            
                                                            $totalPaidAmountOfThisMonth = $collect->totalPaidAmount($collect->fee_cat_id,$collection->student_id,$collection->class_id,$collection->session_id,$collection->batch_setting_id,$collection->receive_month_id);
                                                            /*------------paid amount---------------*/

                                                            $totalPaybleAmount += $payableAmount;
                                                            $totalPaidAmount += $padiAmount;
                                                            $totalDueAmount += $dueAmount ;
                                                            @endphp


                                                            <strong class="pull-right" style="color:green;">
                                                            @if($waiver) Waiver :  {{ $waiverValue }}{{ $waiverSymbol }}
                                                            <br> Total Fee : {{$feeCateAmount}} 
                                                            @endif 
                                                            </strong>
                                                          
                                                        </td>
                                                        <td style="width:12%;">
                                                            <input type="text" readonly name="" value="{{$payableAmount}}" data-id="{{$collect->id}}" id="payable_amount_id_{{$collect->id}}" class="payable_amount form-control" />
                                                        </td>
                                                        <td style="width:12%;">
                                                            <input type="text" readonly name="" value="{{$padiAmount}}" data-id="{{$collect->id}}" id="paid_amount_id_{{$collect->id}}"  class="paid_amount form-control" />
                                                        </td>
                                                        
                                                        <td style="width:12%;">
                                                            <input type="text" readonly name="" value="{{$totalPaidAmountOfThisMonth}}"  class="due_amount form-control" />
                                                        </td>
                                                        <td style="width:12%;">
                                                           @if($payableAmount == $totalPaidAmountOfThisMonth)
                                                                <strong class="btn btn-primary btn-sm">
                                                                    Paid 
                                                                </strong>
                                                                @else
                                                                <strong class="btn btn-danger btn-sm">
                                                                    Un-paid 
                                                                </strong>
                                                           @endif
                                                        </td>
                                                    </tr>
                                                    @endforeach --}}
                                                </tbody>
                                                <tr>
                                                    <th colspan="2" style="text-align:right;">Total</th>
                                                    <th> <strong class="total_payable_amount">{{$totalPaybleAmount}}</strong></th>
                                                    <th><strong class="total_paid_amount">{{$totalPaidAmount}}</strong></th>
                                                    <th><strong class="total_due_amount">{{$totalDueAmount}}</strong></th>
                                                    <th></th>
                                                </tr>
                                            </table>
                                        </div>
                                    </div>
                                    <a href="{{route('admin.fee-collection.index')}}" class="btn btn-primary pull-right">Back</a>
                            </div>

                        </div>
                    </div>

                </div>
            </div>



    @endsection
