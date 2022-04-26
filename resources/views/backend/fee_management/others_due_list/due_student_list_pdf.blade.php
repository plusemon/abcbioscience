<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Other Due Reports</title>

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
<h4>Other Due Reports</h4>
<p><span>Class:  {{ $class->name }} </span> <span>Session: {{ $session->name }}</span> <span>Batch : {{ $batch->batch_name }}</span></p>
 
<p>Date: {{ date('d-m-Y') }}</p>
<hr>

    
   <table  style="width:730px">
        <thead>
            <tr>
                 
                <th>Sl</th>
                <th>Student Name</th>
                <th>UID</th>
                <th>Payable <br/>(Amount)</th>
                <th>Paid <br/>Amount</th>
                <th>Due <br/>Amount</th>
                <th>Status</th>
            </tr>
        </thead>
        
        
        <tbody class="show_result">

        </tbody>
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
               
        <td style="width:5%;">
            <span style="margin-right:8px;font-size:15px;">{{ $loop->iteration }}.</span>
        </td>
        <td style="">
            {{ $student->user?$student->user->name:NULL }}
        </td>
        <td style="">
            {{ $student->user?$student->user->useruid:NULL }} 
            
        </td>
      

        <td>  {{ $payableAmount }}
            </td>
            <td>
                {{ $padiAmount }}
            </td>
            <td> 
                  {{ $payableAmount -  $padiAmount  }}
            </td>

             <td>
                @if($payableAmount - $padiAmount !=0)
                <p style ="color:red" >Unpaid</p>
                @else
                <p style="color: green;">Paid</p>
                @endif
            </td>
            
               
</tr>






@endforeach
        
        </table>


    
  
</body>
</html>