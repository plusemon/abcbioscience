   <div class="table-responsive">
                    <table id="laravel_datatable" class="table table-striped table-bordered table-td-valign-middle" style="margin-top:10px;">
                        <thead>
                            <tr>
                                <th width="1%">ID</th>
                                <th class="text-nowrap">Fee Category</th>
                                <th class="text-nowrap">Class </th>
                                <th class="text-nowrap">Session</th>
                                <th class="text-nowrap">Batch</th>
                                <th class="text-nowrap">Batch Type</th>
                                <th class="text-nowrap">Pay Time</th>
                                <th class="text-nowrap">Amount</th>
                                <th class="text-nowrap">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($fee_settings as $item)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $item->feeCategores?$item->feeCategores->name:NULL }}</td>
                                    <td>{{ $item->classes?$item->classes->name:NULL }}</td>
                                    <td>{{ $item->sessiones?$item->sessiones->name:NULL }}</td>
                                    <td>
                                         {{ $item->batchsetting?$item->batchsetting->batch_name:NULL }}
                                    </td>
                                    <td>{{ $item->batchTypes?$item->batchTypes->name:NULL }}</td>
                                    <td>{{ $item->payTypes?$item->payTypes->name:NULL }}</td>
                                    <td>{{ $item->amount }}</td>
                                    <td>
                                        <a href="{{ route('admin.fee-amount-setting.edit',$item->id) }}" class="btn btn-primary btn-sm"><i class="fa fa-edit"></i> Edit</a>
                                        <a href="{{route('admin.feeAmountSettingDestory',$item->id)}}" id="delete" class="btn btn-danger btn-sm"><i class="fa fa-trash"></i> Delete</a>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                    </div>  