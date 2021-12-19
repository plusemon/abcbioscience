

                    <table>
                        <thead>
                            <tr>

                                <th >ID</th>
                                <th class="text-nowrap">Student ID</th>
                                <th class="text-nowrap">Student Name</th>
                                <th class="text-nowrap">Class</th>
                                <th class="text-nowrap">Batch</th>
                                <th class="text-nowrap">Collection <br/> Month</th>
                                <th class="text-nowrap">Amount</th>
                                <th class="text-nowrap">Collection Date</th>
                                <th class="text-nowrap">Entry Date</th>
                                <th class="text-nowrap">Payment <br/> Invoice</th>
                                <th class="text-nowrap">Session</th>
                                <th class="text-nowrap">Method</th>
                                <th class="text-nowrap">Transaction ID</th>
                                <th class="text-nowrap">Fee Category</th>

                            </tr>
                        </thead>
                        <tbody>
                            @foreach($collections as $collection)
                                <tr>

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
                                    <td>{{ $collection->updated_at->format('d-m-Y h:i A') }}</td>


                                    <td>
                                        {{ $collection->invoice_no }}
                                    </td>

                                    <td>
                                        {{ $collection->sessiones?$collection->sessiones->name:NULL }}
                                    </td>
                                    <td>
                                        {{$collection->paymentmethod?$collection->paymentmethod->method:NULL}}
                                    </td>
                                    <td>
                                        {{$collection->transaction_id}}
                                    </td>
                                    <td>
                                        {{$collection->feeCategores?$collection->feeCategores->name:NULL}}
                                    </td>

                                </tr>
                            @endforeach
                                <tr>
                                    <td colspan="6">Total</td>
                                    <td>{{ $collections->sum('amount') }}</td>
                                    <td colspan="8"></td>
                                </tr>
                        </tbody>
                    </table>

