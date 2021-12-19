@extends('frontend.layouts.app')
@section('title', 'Pending Attendance')
@section('content')

    <!--USER DASHBOARD-->
    <section class="user-dashboard py-4">
        <div class="container">
            <div class="dashboard-area d-flex bd-highlight">
                

          
            @include('frontend.studentdashboard.dashboardmenu')
         

              <div class="dashboard-main w-100 bd-highlight py-3">
                  <div class="dr-head dashboard-header">
                      <div class="ud-mobile">
                            <i class="fa fa-bars" id="ud-mobile-btn"></i> Menu
                        </div>
                        <h6>Pending Attendance </h6>
                        
                    </div>
                    <div class="hr-body">

                         
                          <div id="showResult">
                              
                          </div>
                        

 
                    </div>
                </div>

            </div>
        </div>
    </section>
    <!--END USER DASHBOARD-->



    @include('frontend.studentdashboard.mobilemenu')



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
