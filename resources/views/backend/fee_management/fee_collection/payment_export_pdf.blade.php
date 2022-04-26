<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Payment History</title>


    <style>
        html {
            font: 15px/1 'Open Sans', sans-serif;
            overflow: auto;
            padding: 10px;
            background: #999;
            cursor: default;
        }

        body {
            box-sizing: border-box;
            margin: 0 auto;
            overflow: hidden;
            width: auto;
            padding: 20px 15px;
            background: #FFF;
            border-radius: 1px;
            box-shadow: 0 0 1in -0.25in rgba(0, 0, 0, 0.5);
        }

        @media print {
            * {
                -webkit-print-color-adjust: exact;
            }

            html {
                background: none;
                padding: 0;
            }

            body {
                box-shadow: none;
                margin: 0;
            }
        }
        @page {
            margin: 0;
        }

        table,
        th,
        td {
            border: 1px solid black;
            border-collapse: collapse;
            padding: 2px;
            text-transform: capitalize;
            font-size: 9px;
        }
        table th{
            background: #e6e6e6;
            text-align: left;
        }
    </style>


</head>
<body>
<center>
    <h4> {{ $websetting->site_name }}  </h4>
    <p>Payment History  ( {{ Date('d-m-Y') }})</p>

</center>
    <table style="width: 100%">
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
                    <td colspan="7"></td>
                </tr>
        </tbody>
    </table>

</body>
</html>
