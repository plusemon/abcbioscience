 <div class="table-responsive">
                    <table id="laravel_datatable" class="table table-striped table-bordered table-td-valign-middle" style="margin-top:10px;">
                        <thead>
                            <tr>
                                <th width="1%">ID</th>
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
                                
                                <th class="text-nowrap">Fee Category</th>
                                <th class="text-nowrap">Action</th>
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
                                        {{$collection->feeCategores?$collection->feeCategores->name:NULL}}
                                    </td>
                                    <td>
                                        {{-- <a href="{{ route('admin.feeCollectionShow',$collection->id) }}" class="btn btn-info btn-sm"><i class="fa fa-eye"></i> View</a> --}}
                                        {{--  <a href="{{ route('admin.feeCollectionEdit',$collection->id) }}" class="btn btn-primary btn-sm"><i class="fa fa-edit"></i> Edit</a>  --}}
                                        {{-- <a href="{{route('admin.feeCollectionDestory',$collection->id)}}" id="delete" class="btn btn-danger btn-sm"><i class="fa fa-trash"></i> Delete</a> --}}
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
