<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <title>@yield('title') - {{ $websetting->site_name }} </title>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" name="viewport" />
    <meta content="" name="description" />
    <meta content="" name="author" />
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700" rel="stylesheet" />
    <link href="{{ asset('public/backend') }}/assets/css/default/app.min.css" rel="stylesheet" />
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">


    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/css/toastr.css" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-sweetalert/1.0.1/sweetalert.css" />


    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.11.1/css/jquery.dataTables.css">


    @stack('css')

    @yield('css')

</head>

<body>
    <div id="page-loader" class="fade show"> <span class="spinner"></span> </div>
    <div id="page-container" class="page-container fade page-sidebar-fixed page-header-fixed">
        <div id="header" class="header navbar-default">
            <div class="navbar-header"> <a href="https://www.abcbioscience.com" target="_blank" class="navbar-brand"><span
                          class="navbar-logo"></span> <b> {{ $websetting->site_name }} </b> &nbsp; Student</a>
                <button type="button" class="navbar-toggle" data-click="sidebar-toggled"> <span class="icon-bar"></span>
                    <span class="icon-bar"></span> <span class="icon-bar"></span> </button>
            </div>
            <ul class="navbar-nav navbar-right">



                <li class="dropdown navbar-user">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                        @if (Auth::user()->image)
                            <img src="{{ asset(Auth::user()->image) }}" alt="">
                        @else
                            <img src="{{ asset('public/manpowers/user.png') }}" alt="" />
                        @endif
                        <span class="d-none d-md-inline">{{ Auth::user()->name }}</span>
                        <b class="caret"></b>
                    </a>
                    <div class="dropdown-menu dropdown-menu-right">
                        <a href="{{ route('student.profile') }}" class="dropdown-item"><i class="fa fa-user"></i>
                            Profile</a>
                        <a href="{{ route('student.setting') }}" class="dropdown-item"><i class="fa fa-cogs"></i>
                            Setting</a>

                        <a href="{{ route('student.logout') }}" class="dropdown-item"><i class="fa fa-sign-out"></i> Logout</a>

                    </div>
                </li>


            </ul>
        </div>
        <div id="sidebar" class="sidebar">
            <div data-scrollbar="true" data-height="100%">
                <ul class="nav">
                    <li class="nav-profile">
                        <a href="javascript:;">
                            <div class="cover with-shadow"></div>
                            <div class="image"> <img src="assets/img/user/user-13.jpg" alt="" /> </div>
                            <div class="info"> {{ Auth::user()->name }}
                                <small>{{ Auth::user()->role->name }}</small> </div>
                        </a>
                    </li>

                </ul>
                <ul class="nav">
                    <li class="nav-header">Navigation</li>
                    <li>
                        <a href="{{ route('student.dashboard') }}"> <i class="fa fa-th-large"></i> <span>Dashboard</span> </a>
                    </li>

                    @if (Session::get('admin_user'))
                        <li>
                            <a href="{{ route('admin.user.dashboard') }}"> <i class="fa fa-th-large"></i> <span>Admin
                                    Dashboard</span> </a>
                        </li>
                    @endif



                    <li class="has-sub">
                        <a href="javascript:;"> <b class="caret"></b> <i class="fa fa-building-o"></i> <span>Exam
                                Management </span>
                        </a>
                        <ul class="sub-menu">
                            <li>
                                <a href="{{ route('student.exam.mcq.index') }}"> Quiz Test <i class="fa fa-plus text-theme"></i>
                                </a>
                            </li>
                            <li>
                                <a href="{{ route('student.exam.mcq.history') }}"> Quiz Test History <i
                                       class="fa fa-folder text-theme"></i>
                                </a>
                            </li>
                            <li>
                                <a href="{{ route('student.exam.written.index') }}"> Written Exam <i
                                       class="fa fa-plus text-theme"></i>
                                </a>
                            </li>
                            <li>
                                <a href="{{ route('student.exam.written.history') }}"> Written Exam History <i
                                       class="fa fa-plus text-theme"></i>
                                </a>
                            </li>
                            <li>
                                <a href="{{ route('student.exam.diagram.history') }}"> Diagram Exam History <i
                                       class="fa fa-plus text-theme"></i>
                                </a>
                            </li>


                        </ul>
                    </li>




                    <li class="has-sub">
                        <a href="javascript:;"> <b class="caret"></b> <i class="fa fa-list-ol"></i> <span>Home Work
                            </span>
                        </a>
                        <ul class="sub-menu">
                            <li><a href="{{ route('student.homework.pending') }}"> Pending Home Works<i
                                       class="fa fa-plus text-theme"></i></a></li>
                            <li><a href="{{ route('student.homework.history') }}">Home Work lists<i
                                       class="fa fa-plus text-theme"></i></a></li>

                        </ul>
                    </li>




                    <li class="has-sub">
                        <a href="javascript:;"> <b class="caret"></b> <i class="fa fa-clock-o"></i> <span>Attendance
                            </span>
                        </a>
                        <ul class="sub-menu">
                            <li><a href="{{ route('student.attendance.pending') }}"> Pending Attendance<i
                                       class="fa fa-plus text-theme"></i></a></li>
                            <li><a href="{{ route('student.attendance.history') }}"> Attendance List<i
                                       class="fa fa-list text-theme"></i> </a></li>
                        </ul>
                    </li>


                    <li class=""><a href="{{ route('student.payment.history') }}"> <i
                               class="fa fa-money-bill"></i>Payment History</a></li>
                    <li class=""><a href="{{ route('student.sheet.available') }}"> <i
                               class="fa fa-file"></i>Available Sheets</a></li>
                    <li class=""><a href="{{ route('student.batch.enroll') }}"> <i
                               class="fa fa-building-o"></i>Batch Lists</a></li>
                    <li class=""><a href="{{ route('student.personal.information') }}"> <i
                               class="fa fa-user"></i>Personal Information</a></li>
                    <li class=""><a href="{{ route('student.profile') }}"><i class="fa fa-user"></i>
                            Profile</a></li>
                    <li class=""><a href="{{ route('allbatch') }}"><i class="fa fa-plus"></i>New Batch
                            Enrollment </a></li>
                    <li class=""><a href="{{ route('student.logout') }}"> <i class="fa fa-sign-out"></i>
                            Logout</a></li>




                    <li><a href="javascript:;" class="sidebar-minify-btn" data-click="sidebar-minify"><i
                               class="fa fa-angle-double-left"></i></a></li>
                </ul>
            </div>
        </div>



        @yield('content')





    </div>


    <script src="{{ asset('public/backend') }}/assets/js/app.min.js" type="text/javascript"></script>

    <script src="{{ asset('public/backend') }}/assets/js/theme/default.min.js" type="text/javascript"></script>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/js/toastr.min.js"></script>
    <script src="{{ asset('public/backend/assets/sweetalert/sweetalert2@9.js') }}"></script>
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>


    <script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.11.1/js/jquery.dataTables.js"></script>




    <script>
        @if (Session::has('message'))
            var type = "{{ Session::get('alert-type', 'info') }}"
        
            switch (type) {
            case 'info':
            toastr.info("{{ Session::get('message') }}");
            break;
            case 'success':
            toastr.success("{{ Session::get('message') }}");
            break;
            case 'warning':
            toastr.warning("{{ Session::get('message') }}");
            break;
            case 'error':
            toastr.error("{{ Session::get('message') }}");
            break;
            }
        @endif

        $(document).ready(function() {
            $('.summernote').summernote(

                {
                    height: 200,
                    focus: true
                }

            );
        });


        $(document).ready(function() {
            $('.datatables').DataTable();
        });



        $(document).ready(function() {
            $('.select2').select2();
        });
    </script>





    @yield('customjs')
    @stack('js')


</body>

</html>
