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

                        @if ($paymenthistories->count() > 0)
                            <div class="table-responsive">
                                <table id="" class="table table-striped table-bordered table-td-valign-middle datatables"
                                       style="margin-top:10px;">
                                    <thead>
                                        <tr>
                                            <th width="1%">ID</th>

                                            <th class="text-nowrap">Payment <br /> Invoice</th>
                                            <th class="text-nowrap">Class</th>
                                            <th class="text-nowrap">Session</th>
                                            <th class="text-nowrap">Batch</th>
                                            <th class="text-nowrap">Collection <br /> Month</th>

                                            <th class="text-nowrap">Fee Category</th>
                                            <th class="text-nowrap">Amount</th>
                                            <th class="text-nowrap">Paid Date</th>
                                            <th class="text-nowrap">Status</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($paymenthistories as $collection)
                                            <tr>
                                                <td>
                                                    {{ $loop->iteration }}
                                                </td>

                                                <td>
                                                    {{ $collection->invoice_no }}
                                                </td>
                                                <td>
                                                    {{ $collection->classes ? $collection->classes->name : null }}
                                                </td>
                                                <td>
                                                    {{ $collection->sessiones ? $collection->sessiones->name : null }}
                                                </td>
                                                <td>
                                                    {{ $collection->batchsetting ? $collection->batchsetting->batch_name : null }}
                                                </td>
                                                <td>
                                                    {{ $collection->months ? $collection->months->name : null }}
                                                </td>
                                                <td>
                                                    {{ $collection->feeCategores ? $collection->feeCategores->name : null }}
                                                </td>
                                                <td>
                                                    {{ $collection->amount }}
                                                </td>
                                                <td>
                                                    {{ Date('d-m-Y h:i A', strtotime($collection->receive_date)) }}
                                                </td>

                                                <td>
                                                    @if ($collection->status == 1)
                                                        <p class="btn btn-success btn-sm">Paid</p>
                                                    @elseif($collection->status == 3)
                                                        <p class="btn btn-success btn-sm">Verification Pending</p>
                                                    @else
                                                    {{-- <a href="#" class="btn btn-success" data-toggle="modal"
                                                       data-target="#exampleModal_{{ $collection->id }}"> <i
                                                           class="fa fa-money-bill"></i> Make Payment</a> --}}
                                                        <p class="btn btn-danger btn-sm">Unpaid</p>
                                                        @include(
                                                            'layouts.partials.payment-gateway-modal-button',
                                                            [
                                                                'amount' => $collection->amount,
                                                                'invoice_no' => $collection->invoice_no,
                                                                'btn_text' => 'Make Payment'
                                                            ]
                                                        )
                                                    @endif

                                                    {{-- <!-- Modal -->
                                                    <div class="modal fade" id="exampleModal_{{ $collection->id }}"
                                                         tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                        <div class="modal-dialog">
                                                            <div class="modal-content">

                                                                <p class="text-danger p-5"> <b>Pls. Send money through Personal Number
                                                                        -
                                                                        <br> (1) 01705597641 (bkash) or
                                                                        <br> (2) 01835889878 (bkash & Nagad)</b></p>

                                                                <form action="{{ route('student.make.payment', $collection->id) }}"
                                                                      method="post">
                                                                    @csrf
                                                                    <div class="modal-header">
                                                                        <h5 class="modal-title" id="exampleModalLabel">Make Payment
                                                                        </h5>
                                                                        <button type="button" class="close"
                                                                                data-dismiss="modal" aria-label="Close">
                                                                            <span aria-hidden="true">&times;</span>
                                                                        </button>
                                                                    </div>
                                                                    <div class="modal-body">
                                                                        <label class="text-danger"> <b>Payment</b> </label>
                                                                        <select class="form-control " name="payment_method_id"
                                                                                required>
                                                                            <option value="">Please Select Payment Method</option>
                                                                            @php
                                                                                $paymentmethods = App\Model\PaymentMethod::whereIn('id', [2, 3, 9])->get();
                                                                                
                                                                            @endphp


                                                                            @foreach ($paymentmethods as $method)
                                                                                <option value="{{ $method->id }}">
                                                                                    {{ $method->method }}</option>
                                                                            @endforeach
                                                                        </select>

                                                                        <br>
                                                                        <input type="text" class="form-control"
                                                                               name="transaction_id" value=""
                                                                               placeholder="Enter Transaction ID/Mobile Number"
                                                                               required>
                                                                        <div class="text-danger">
                                                                            {{ $errors->first('transaction_id') }} </div>

                                                                    </div>
                                                                    <div class="modal-footer">
                                                                        <button type="button" class="btn btn-secondary"
                                                                                data-dismiss="modal">Close</button>
                                                                        <button type="submit" class="btn btn-primary">Submit</button>
                                                                    </div>
                                                                </form>
                                                            </div>
                                                        </div>
                                                    </div> --}}
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>

                            </div>
                        @else
                            <p class="pl-3">No payment Available Here </p>

                        @endif
                    </div>
                </div>

            </div>
        </div>
    </div>


    @include('layouts.partials.payment-gateway-modal')

@endsection


@push('js')
    {{--  #Bkash payment gateway integration
    // 1. fn bkash_init(amount, invoice_no)
    // 2. payment button #bKash_button trigger from modal
    // 3. make payment  --}}
    @include('layouts.partials.bkash-script')
@endpush
