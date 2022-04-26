<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Attendances</title>
    <!--favicon-->
    <link rel="shortcut icon" type="image/x-icon" href="img/LOGO%20Asset%2013ldpi.png">
    <style>
        /* page */
        html {
            font: 15px/1 'Open Sans', sans-serif;
            overflow: auto;
            padding: 0.5in;
            background: #999;
            cursor: default;
        }

        body {
            box-sizing: border-box;
            margin: 0 auto;
            overflow: hidden;
            padding: 0.5in;
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

        /* header */
        /* main css */
        .clearfix::after {
            content: "";
            clear: both;
            display: table;
        }

        .logo-img {
            float: left;
        }

        .logo-img img {
            width: 110px;
        }

        .provider-txt {
            float: right;
        }

        .provider-txt h4 {
            text-transform: uppercase;
            font-weight: bolder;
            padding-top: 10px;
        }

        .title-head {
            text-align: center;
            padding-top: 10px;
            border-bottom: 1px solid #000;
        }
        .title-head h1{
            margin-bottom: 5px;
        }

        .title-head p {
            margin: 0;
            padding: 0;
            margin-bottom: 8px;
            text-transform: uppercase;
            font-size: 14px;
        }


        .title-head-txt {
            font-size: 25px !important;
            text-transform: uppercase;
        }

        .title-head h1 {
            text-transform: uppercase;
        }

        .main-contain-top{
            margin-top: 10px;
        }
        .main-contain-top p {
            text-transform: capitalize;
        }

        .main-contain-left {
            float: left;
            width: 50%;
        }

        .main-contain-right {
            float: left;
            width: 50%;
            text-align: right;
        }

        .data-table table {
            width: 100%;
        }

        table,
        th,
        td {
            border: 1px solid black;
            border-collapse: collapse;
            padding: 8px;
            text-transform: capitalize;
        }
        table th{
            background: #e6e6e6;
            text-align: left;
        }



        /* end main css */
    </style>
</head>

<body>

    

    <section class="title-head">
        <p class="title-head-txt"> {{ $websetting->site_name }} </p>
        <p>Batch: {{ $attendance->batchsetting->batch_name }} </p>
        <p>Class: {{ $attendance->classes->name }} </p>
        <p>Session : {{ $attendance->sessiones->name }} </p>
        <h3>Attendance Date :  {{ $attendance->attendance_date }} </h3>
	<h2> Student  Absent Attendance List </h2>
    </section>
 
    

    <section class="data-table">
         <div class="table-responsive">
			<table class="table table-hovered table-bordered">
				<tr>
		            <th>ID</th>
					<th>Status</th>
		            
					<th>Student ID</th>
					<th>Name</th>
					 
		            <th>Class</th>
		            <th>Batch</th>
					 
				 
				</tr>

				@foreach($attendance->attendancedetail->where('attendance','Absent') as $student)
				 <tr>
		            <td>{{ $loop->iteration }}</td>
				 	<td>

				 		@if($student->attendance == "Absent")
				 		<span style="color: red;">Absent</span>
				 		@elseif($student->attendance == "Present")
				 		 Present
				 		@endif
				 
				 	</td>
		           
				    <td>{{  $student->student?$student->student->user->useruid:'' }}</td>
		            <td>{{  $student->student?$student->student->user->name:'' }}</td>
				 	 
		            <td>{{  $student->student?$student->student->classes->name:'' }}</td>
		            <td>{{  $student->student?$student->student->batchsetting->batch_name:'' }}</td>
		             
				 	 
				</tr>
				@endforeach
			</table>

	 
</div>
    </section>

</body>
</html>
