@foreach($students as $student)

<tr>

     @php

                $amount  =  0;
              $waiver =   $feeSetting->othersWaiveredStudent($fee_cat_id,$amount,$student->id,$class_id,$session_id,$batch_setting_id,$batch_type_id);
             
                $waiverType  = $waiver?$waiver->waiver_type_id:NULL; 
                $waiverValue = $waiver?$waiver->waiver_value:NULL; 
                $waiverSymbol = NULL;
                $waiverAmount = 0;
                if($waiver)
                {
                    if($waiverType == 1)
                    {
                        $waiverAmount = (($waiverValue * $feeSetting->amount) / 100);
                        $waiverSymbol = '%';
                    }else{
                        $waiverAmount = $feeSetting->amount - $waiverValue;
                    }
                }
                $payableAmount = ($feeSetting->amount - $waiverAmount);


               $padiAmount =   $feeSetting->othersPaidAmount($feeSetting->fee_cat_id,$student->id,
                                        $class_id,$session_id,$batch_setting_id,$batch_type_id,$fee_amount_setting_id
                                        );
               
                @endphp
                <th>
                
                
                @if($payableAmount - $padiAmount !=0)
                <input class="checkSingle" type="checkbox" name="user_id[]" value="{{ $student->user_id }}" checked>
                @else
                <input class="checkSingle" type="checkbox" name="user_id[]" value="{{ $student->user_id }}">
                @endif
              
                
                <input type="hidden" name="student_id[]" value="{{ $student->id }}">
                
            </th>


        <td style="width:5%;">
            <span style="margin-right:8px;font-size:15px;">{{ $loop->iteration }}.</span>
        </td>
        <td style="">
            {{ $student->user?$student->user->name:NULL }}
        </td>
        <td style="">
            {{ $student->user?$student->user->useruid:NULL }} 
            
        </td>
      

        <td style="width:40%;">
                

                
               
 
            
                {{ $payableAmount }}
            </td>
            <td>
                {{ $padiAmount }}
            </td>
            <td> 
                  {{ $payableAmount -  $padiAmount  }}
            </td>

             <td>
                @if($payableAmount - $padiAmount !=0)
                <p class="btn btn-danger" >Unpaid</p>
                @else
                <p class="btn btn-success">Paid</p>
                @endif
            </td>
            
               
</tr>






@endforeach
<tr>
    <td colspan="7"></td>
    <td>
        <button name="pdf" class="btn btn-primary" type="submit"><i class="fa fa-download"></i> PDF</button>
    </td>
</tr>