<html>
<head>
    <title>Student List</title>
    
    
    <style>
        table{
             border-collapse: collapse;
            border-spacing: 10px;  
        }
        table tr th,td{
            font-size: 12px;
            padding:2px;
            margin:0;
        }
        
        
    </style>
</head>
<body>
        <center>
            <h3>{{ $websetting->site_name }}</h3>
            <p>Students list</p>
        </center>
    
    
 <table border="1" style="width:100%" >
    <thead>
        <tr>
            <th>ID</th>
            
            <th>Student ID</th>
            <th class="text-nowrap">Name</th>
            <th class="text-nowrap">Mobile</th>
            <th class="text-nowrap">Class</th>
            <th class="text-nowrap">Batch</th>
            <th class="text-nowrap">Section</th>
            <th class="text-nowrap">Roll</th>
            <th class="text-nowrap">Status</th>
          </tr>
    </thead>
    <tbody>
        @foreach($allstudents as $student)
            <tr>
                <td>{{ $loop->iteration }}</td>
                 
                <td>{{ $student->user?$student->user->useruid:'' }}</td>
                <td>{{ $student->user?$student->user->name:''  }}</td>
                <td>{{ $student->user?$student->user->mobile:'' }}</td>
                <td>{{ $student->classes?$student->classes->name:'' }}</td>
                <td>{{ $student->batchsetting?$student->batchsetting->batch_name:'' }}</td>
                <td>{{ $student->user?$student->user->section_id:'' }}</td>
                <td>{{ $student->user?$student->user->roll:'' }}</td>
                <td>
                     @if($student->status==1)

                    <p class="btn btn-primary btn-sm">Active</p>
                    @elseif($student->status==2) 
                    <p class="btn btn-danger btn-sm">Inactive</p>
                    @endif 
                 </td>
                 
            </tr>
             @endforeach

    </tbody>
</table>
 
</body>
</html>