@extends('students.layouts.app')
@section('title', 'Pending Attendances')
@section('content')
    <div id="content" class="content">
        <div class="panel panel-inverse">
            <div class="panel-heading">
                <h4 class="panel-title">Pending Attendances</h4>
                <div class="panel-heading-btn">
                    <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-default" data-click="panel-expand">
                        <i class="fa fa-expand"></i>
                    </a>
                    <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-success" data-click="panel-reload">
                        <i class="fa fa-redo"></i>
                    </a>
                    <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-warning" data-click="panel-collapse">
                        <i class="fa fa-minus"></i>
                    </a>
                    <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-danger" data-click="panel-remove">
                        <i class="fa fa-times"></i>
                    </a>

                </div>
            </div>
            <div class="panel-body">
                <div class="row">
                    <div class="col-md-12">

                         
                          <div id="showResult">
                              
                          </div>
                        

 
                    </div>
                </div>

            </div>
        </div>
    </div>
 

@section('customjs')
    
    <script>
            
        $(document).ready(function(){
            getHtmlResponse();
        });


        function getHtmlResponse()
        {
                  
            $.ajax({
                    url: "{{ route('student.attendance.pending.ajax') }}",
                    type: "GET",
                    success: function(response)
                    {
                        $('#showResult').html(response);
                    },
            });
        }
        

    </script>

@endsection
@endsection
