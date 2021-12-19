    @foreach($students as $student)
        <tr>
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
            
                @php
                   $waiver = $student->waiveredStudent($fee_cat_id,$student->id,$class_id,$session_id,
                                $batch_setting_id,$batch_type_id,$month_id
                            );
                   $monthlyPaid = $student->montlyPaidAmount($fee_cat_id,$student->id,$class_id,$session_id,
                            $batch_setting_id,$batch_type_id,$month_id
                        );

                $monthlyFee  = $student->montlyFee($fee_cat_id,$class_id,$session_id,$batch_setting_id,$batch_type_id);

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
                    }else{
                        $waiverAmount = $monthlyFee - $waiverValue;
                    }
                }
                $payableAmount = ($monthlyFee - $waiverAmount);
                @endphp
            
            <td style="">
                {{$monthlyFee}}
            </td>
            <td style="">
               {{$waiverValue}}{{$waiverSymbol}}  =  {{$waiverAmount}}
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
        </tr>
    @endforeach