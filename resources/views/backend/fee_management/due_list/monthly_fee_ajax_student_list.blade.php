    @foreach($students as $student)
        @php
                   $waiver = $student->waiveredStudent($fee_cat_id,$student->id,$class_id,$session_id,
                                $batch_setting_id,$batch_type_id,$month_id
                            );
                   $monthlyPaid = $student->montlyPaidAmount($fee_cat_id,$student->id,$class_id,$session_id,
                            $batch_setting_id,$batch_type_id,$month_id
                        );

                $monthlyFee  = $student->montlyFee($fee_cat_id,$class_id,$session_id,$batch_setting_id,$batch_type_id);

                $monthlyFeeAmountID  = $student->montlyFeeAmountID($fee_cat_id,$class_id,$session_id,$batch_setting_id,$batch_type_id);



                $waiverType  = $waiver?$waiver->waiver_type_id:NULL; 
                $waiverValue = $waiver?$waiver->waiver_value:0; 
                $waiverSymbol = '%';
                $waiverAmount = 0;
                
                
                if($waiver)
                {
                    if($waiverType == 1)
                    {
                        $waiverAmount = (($waiverValue * $monthlyFee) / 100);
                        $waiverSymbol = '%';
                    }
                    
                    elseif($waiverType == 2){
                        $waiverAmount =  $waiverValue;
                        $waiverSymbol = 'tk';
                    }
                }
                $payableAmount = ($monthlyFee - $waiverAmount);
                
                
                
                $checkInvoice = App\Model\PaymentHistory::where('student_id',$student->id)
                                                    ->where('origin_id',$month_id)
                                                    ->where('class_id',$student->class_id)
                                                    ->where('session_id',$student->session_id)
                                                    ->whereIn('status',[2,3])
                                                    ->count();
                                                    
                $checkInvoiceGenerated = App\Model\PaymentHistory::where('student_id',$student->id)
                                                    ->where('origin_id',$month_id)
                                                    ->where('class_id',$student->class_id)
                                                    ->where('session_id',$student->session_id)
                                                    ->whereIn('status',[3])
                                                    ->count();
                                                    
                
                $months = [];
                
                
                $findabsentstudentcount =  App\Models\AbsentStudent::where('student_id',$student->id)->where('batch_setting_id',$student->batch_setting_id)->count();
                $findabsentstudent =  App\Models\AbsentStudent::where('student_id',$student->id)->where('batch_setting_id',$student->batch_setting_id)->first();
                            
                
               
                
                if($findabsentstudentcount>0){
                    $getmonths = App\Model\AbsentMonth::where('absent_id',$findabsentstudent->id)->get();   
                    foreach($getmonths as $abmonth)
                    {
                        array_push($months,$abmonth->month_id);
                    }
                }
                    
                @endphp
            
    
    
    
    
            @if(in_array($month_id,$months))
              Match
              
        @else
        <tr>
            
             
             
            
            
            <th>

                @if($payableAmount - $monthlyPaid !=0)
                @if($checkInvoiceGenerated==1)
                <input class="checkSingle" type="checkbox" name="student_id[]" value="{{ $student->id }}">
                @elseif($checkInvoiceGenerated==0)
                <input class="checkSingle" type="checkbox" name="student_id[]" value="{{ $student->id }}" checked>
                @endif
                @else
                <input class="checkSingle" type="checkbox" name="student_id[]" value="{{ $student->id }}">
                @endif
              
                
                <input type="hidden" name="user_id[]" value="{{ $student->user_id }}">
                <input type="hidden" name="fee_amount_setting_id[]" value="{{ $monthlyFeeAmountID->id }}">
                <input type="hidden" name="amount[{{ $student->id }}]" value="{{$payableAmount-$monthlyPaid}}">
                <!--<input type="hidden" name="amount[]" value="{{$payableAmount-$monthlyPaid}}">-->
              
             
              
                      

            <td style="width:5%;">
                <span style="margin-right:8px;font-size:15px;">{{ $loop->iteration }}.</span>
            </td>
            <td style="">
                {{ $student->user?$student->user->name:NULL }}
            </td>
            <td style="">
                {{ $student->user?$student->user->useruid:NULL }} 
                {{$student->roll}}
            </td>
            
               
            
            <td style="">
                {{$monthlyFee}}
            </td>
            <td style="">
                {{$waiverAmount}} {{$waiverSymbol}} 
            </td>
            <td style="">
                {{$payableAmount}}
            </td>
            
            <td style="">
                {{$monthlyPaid}}
            </td>
            <td style="">
               {{ $payableAmount - $monthlyPaid}}  
            
            </td>
            <td>
                @if($payableAmount - $monthlyPaid !=0)
                    @if($checkInvoice>0)
                        @if($checkInvoiceGenerated==1)
                        <p class="btn btn-warning" >Verify Pending</p>
                        @elseif($checkInvoiceGenerated==0)
                        <p class="btn btn-warning" >Invoice Generated</p>
                        @endif
                    @else
                    <p class="btn btn-danger" >Unpaid</p>
                    @endif
                @else
                <p class="btn btn-success">Paid</p>
                @endif
            </td>
        </tr>
     
              
        @endif
    @endforeach
         <tr>
             <td colspan="9"></td>
             <td>
                 <button type="submit" name="sms" class="btn btn-primary"> <i class="fa fa-envelope"></i>  Send Message</button>
                 <button type="submit" name="invoice" class="btn btn-primary"> <i class="fa fa-envelope"></i> Generate Invoice </button>
                 <br>
                 <br>
                 <button type="submit" name="pdf" class="btn btn-primary"> <i class="fa fa-download"></i> PDF</button>
             </td>
         </tr>