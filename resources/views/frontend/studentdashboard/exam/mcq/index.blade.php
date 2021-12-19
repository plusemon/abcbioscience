@extends('frontend.layouts.app')
@section('title', 'Available Quiz test List')
@section('content')

    <!--USER DASHBOARD-->
    <section class="user-dashboard py-4">
        <div class="container">
            <div class="dashboard-area d-flex bd-highlight">
                @include('frontend.studentdashboard.dashboardmenu')

                 <div id="pre-loader"> <img src="{{ asset('public/frontend') }}/photos/overall.svg" alt=""></div>

                <div class="dashboard-main w-100 bd-highlight py-3">
                    <div class="dr-head dashboard-header">
                        <div class="ud-mobile">
                            <i class="fa fa-bars" id="ud-mobile-btn"></i>Profile Menu
                        </div>
                        <h6>Available Quiz test List</h6>

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
                    url: "{{ route('student.exam.mcq.ajax') }}",
                    type: "GET",
                     beforeSend: function(){
                        /* Show image container */
                        $("#pre-loader").show();
                       },
                    success: function(response)
                    {
                        $('#showResult').html(response);
                        $("#pre-loader").hide();
                    },
            });
        }


        


    </script>

@endsection
@endsection
