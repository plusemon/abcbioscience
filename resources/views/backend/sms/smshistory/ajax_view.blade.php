<div class="table-responsive">
                 <table class="table table-hovered table-bordered">
                     <thead>
                         <tr>
                             <th>Serial</th>
                             <th>Student ID</th>
                             <th>Student Name</th>
                             <th>Student Mobile</th>
                             <th>Student Message</th>
                             <th>Send Date & Time</th>
                             <th>Status</th>
                         </tr>
                     </thead>
                     <tbody>
                        @foreach($smshistories as $smshistory)
                         <tr>
                             <td>{{ $loop->iteration }}</td>
                             <td>{{ $smshistory->user?$smshistory->user->useruid:'' }}</td>
                             <td>{{ $smshistory->user?$smshistory->user->name:'' }}</td>
                             <td>{{ $smshistory->user?$smshistory->user->mobile:'' }}</td>
                             <td>{!! $smshistory->message !!}</td>
                             <td> {{ Date('d-m-Y h:i A',strtotime($smshistory->created_at)) }}</td>
                             <td>
                                 @if($smshistory->status==1)
                                 <p class="btn btn-primary btn-sm">Delivered</p>
                                 @elseif($smshistory->status==2)
                                 <p class="btn btn-danger btn-sm">Failded</p>
                                 @endif
                             </td>
                         </tr>
                        @endforeach
                     </tbody>
                 </table>
                </div>