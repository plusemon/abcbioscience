    @foreach($feeSettings as $feeSetting)
        <tr>
            <td style="width:10%;">
                <span style="margin-right:8px;font-size:15px;">{{ $loop->iteration }}.</span>
                <input type="checkbox" name="feeSettingId[]" id="checked_id_{{$feeSetting->id}}" value="NULL" style="padding:10%;" data-check_id="{{$feeSetting->id}}" class="check_class"/>
                <input type="hidden" name="fee_setting_id[]"  value="{{$feeSetting->id}}" />

                <input type="hidden" name="student_id"  value="{{$student_id}}" />
            </td>
            <td style="width:40%;">
                {{ $feeSetting->feeCategores?$feeSetting->feeCategores->name:NULL }}

                @php
                $waiver =   $feeSetting->waiveredStudent($feeSetting->fee_cat_id,$feeSetting->amount,
                                                    $student_id,$class_id,$session_id,
                                                    $batch_setting_id,$batch_type_id,$month_id
                                                    );
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
                /*------------paid amount---------------*/
                $padiAmount =   $feeSetting->waiverPaidAmount($feeSetting->fee_cat_id,$student_id,
                                        $class_id,$session_id,$batch_setting_id,$batch_type_id,$month_id
                                        );
                $dueAmount  =   $payableAmount - $padiAmount ;
                /*------------paid amount---------------*/
                @endphp
                <strong class="pull-right" style="color:green;">
                    Monthly Fee : {{$feeSetting->amount}}
                    <br>
                    Waiver Amount- {{ $feeSetting->amount - $waiverValue }}.00
                    <br>
                   @if($waiver) After Waiver Monthly Fee :  {{ $waiverValue }}{{ $waiverSymbol }}


                  <br>
                  @endif
                </strong>
            </td>
            <td style="width:12%;">
                <input type="text" readonly name="fee_amount[]" value="{{$payableAmount}}" data-id="{{$feeSetting->id}}" id="payable_amount_id_{{$feeSetting->id}}" class="payable_amount form-control" />
            </td>
            <td style="width:12%;">
                <input type="text" readonly name="paid_amount[]" value="{{$padiAmount}}" data-id="{{$feeSetting->id}}" id="paid_amount_id_{{$feeSetting->id}}"  class="paid_amount form-control" />
            </td>

            <td style="width:14%;">
                <input type="number" name="amount[]" value="" data-id="{{$feeSetting->id}}" id="collecting_amount_id_{{$feeSetting->id}}" class="type form-control" />
                <input type="hidden" name="student_waiver_id[]" value="{{$waiver?$waiver->id:NULL}}" />

            </td>
            <td style="width:12%;">
                <input type="text" readonly name="due_amount[]" value="" data-id="{{$feeSetting->id}}" id="due_amount_id_{{$feeSetting->id}}" class="due_amount form-control" />
            </td>
        </tr>

    @endforeach


