@extends('frontend.layouts.app')
@section('title', 'Payment History')
@section('content')

    <!--USER DASHBOARD-->
    <section class="user-dashboard py-4">
        <div class="container">
            <div class="dashboard-area d-flex bd-highlight">
                

          
            @include('frontend.studentdashboard.dashboardmenu')
         

              <div class="dashboard-main w-100 bd-highlight py-3">
                  <div class="dr-head dashboard-header">
                      <div class="ud-mobile">
                            <i class="fa fa-bars" id="ud-mobile-btn"></i>Profile Menu
                        </div>
                        <h6> Payment History </h6>
                       
                    </div>
                    <div class="hr-body">

                          @if($paymenthistories->count()>0)
                          <div class="table-responsive">
                                <table id="laravel_datatable" class="table table-striped table-bordered table-td-valign-middle" style="margin-top:10px;">
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
    </section>
    <!--END USER DASHBOARD-->



    @include('frontend.studentdashboard.mobilemenu')


@endsection
