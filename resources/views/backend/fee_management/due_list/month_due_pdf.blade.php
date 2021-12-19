<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Monthly Reports</title>

    <style>
       table,
        th,
        td {
            border: 1px solid black;
            border-collapse: collapse;
            padding: 0px;
            text-transform: capitalize;
            font-size: 12px;

        }
        table th{
            background: #e6e6e6;
            text-align: left;
        }
        tbody td{
            text-align: center;
        }
         tbody td:nth-child(2){
            text-align: left;
         }
         h3,h4,p{
            margin: 0;
            padding: 0;
            text-align: center;
         }

  </style>

</head>
<body>
    
<h3>{{ $websetting->site_name }}</h3>
<h4>Monthly Payment Reports</h4>
<p><span>Class:  {{ $class->name }} </span> <span>Session: {{ $session->name }}</span> <span>Batch : {{ $batch->batch_name }}</span></p>
<p style="">Month - {{ $month->name }}</p>
<p>Date: {{ date('d-m-Y') }}</p>
<hr>



    
<table  style="width:730px">
    <thead>
        <tr>
            <th>Sl</th>
            <th width="16%">Student Name</th>
            <th>UID - Roll</th>
            <th>Monthly Fee</th>
            <th>Waiver</th>
            <th>Payable <br/>(Amount)</th>
            <th>Paid <br/>Amount</th>
            <th>Due <br/>Amount</th>
            <th>Status</th>
        </tr>
    </thead>
    <tbody>
    @foreach($students as $student)
        <tr>
            
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
                    }
                    
                    elseif($waiverType == 2){
                        $waiverAmount =  $waiverValue;
                        $waiverSymbol = 'tk';
                    }
                }
                $payableAmount = ($monthlyFee - $waiverAmount);
                @endphp
            
            
            
            
             
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
                <p style="color:red;">Unpaid</p>
                @else
                <p style="color:green">Paid</p>
                @endif
            </td>
        </tr>
    @endforeach
</tbody>
         








</body>
</html>