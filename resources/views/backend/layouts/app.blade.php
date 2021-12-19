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
    <link href="{{ asset('public/backend') }}/assets/plugins/summernote/dist/summernote.css" rel="stylesheet" />


    <link href="https://cdn.datatables.net/1.10.16/css/jquery.dataTables.min.css" rel="stylesheet">



    @stack('css')

    <style>
        .qb-head h5 {
            border-bottom: 1px solid #ccc;
            padding: 10px;
            background: #ededed;
        }

        .form-check {
            width: 100%;
            display: inline-block;
        }

        .form-check-label span {
            margin-left: 10px;
            float: left;
        }

        .qb-body {
            background: #fff;
        }

        .qb-body p {
            font-size: 18px;
            margin: 5px;
            background: #fff;
            padding: 5px;
            float: left;
        }

        .qb-body p span {
            background: #f4f4f4;
            float: left;
        }

        .qb-body p span img {
            background: #f4f4f4;
            float: left;
        }

    </style>



</head>

<body>
    <div id="page-loader" class="fade show"> <span class="spinner"></span> </div>
    <div id="page-container" class="page-container fade page-sidebar-fixed page-header-fixed">
        <div id="header" class="header navbar-default">
            <div class="navbar-header"> <a href="{{ route('home') }}" class="navbar-brand"><span class="navbar-logo"></span>
                    <b> {{ $websetting->site_name }} </b> &nbsp; Admin</a>
                <button type="button" class="navbar-toggle" data-click="sidebar-toggled"> <span class="icon-bar"></span>
                    <span class="icon-bar"></span> <span class="icon-bar"></span> </button>
            </div>
            <ul class="navbar-nav navbar-right">
                <li class="navbar-form">
                    <form action="#" method="POST" name="search">
                        <div class="form-group">
                            <input type="text" class="form-control" placeholder="Enter keyword" />
                            <button type="submit" class="btn btn-search"><i class="fa fa-search"></i></button>
                        </div>
                    </form>
                </li>


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
                        <a href="{{ route('user.profile') }}" class="dropdown-item"><i class="fa fa-user"></i> Profile</a>
                        <a href="{{ route('user.setting') }}" class="dropdown-item"><i class="fa fa-cogs"></i> Setting</a>


                        <a class="dropdown-item" href="{{ route('logout') }}" onclick="event.preventDefault();
                                        document.getElementById('logout-form').submit();">
                            <i class="fa fa-sign-out"></i> {{ __('Logout') }}
                        </a>

                        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                            @csrf
                        </form>


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
                            <div class="image">
                                @if (Auth::user()->image)

                                    <img src="{{ asset(Auth::user()->image) }}" alt="">

                                @else

                                    <img src="{{ asset('public/manpowers/user.png') }}" alt="" />
                                @endif
                            </div>
                            <div class="info"> {{ Auth::user()->name }} <small> {User Role} </small> </div>
                        </a>
                    </li>

                </ul>
                <ul class="nav">
                    <li class="nav-header">Navigation</li>
                    <li>
                        <a href="{{ route('home') }}"> <i class="fa fa-th-large"></i> <span>Dashboard</span> </a>
                    </li>
                    <li class="nav-header">Students</li>
                    @can('student setting')
                        <li class="has-sub">
                            <a href="javascript:;"> <b class="caret"></b> <i class="fa fa-list-ol"></i> <span>Students
                                    Setting </span>
                            </a>
                            <ul class="sub-menu">
                                <li><a href="{{ route('classes.index') }}"> Class <i class="fa fa-plus text-theme"></i></a></li>
                                <li><a href="{{ route('sessiones.index') }}"> Session <i class="fa fa-list text-theme"></i> </a>
                                </li>
                                {{-- <li><a href="{{ route('batch.index') }}"> Batch <i class="fa fa-list text-theme"></i> </a></li> --}}
                                <li><a href="{{ route('section.index') }}"> Section <i class="fa fa-list text-theme"></i> </a></li>
                                <li><a href="{{ route('year.index') }}"> Year <i class="fa fa-list text-theme"></i> </a></li>
                                <li><a href="{{ route('subject.index') }}"> Subject <i class="fa fa-list text-theme"></i> </a></li>
                                <li><a href="{{ route('chapter.index') }}"> Chapter <i class="fa fa-list text-theme"></i> </a></li>
                                <li><a href="{{ route('batch.schedule.index') }}"> Batch list <i class="fa fa-list text-theme"></i>
                                    </a></li>
                            </ul>
                        </li>
                    @endcan
                    @can('student management')
                        <li class="has-sub">
                            <a href="javascript:;"> <b class="caret"></b> <i class="fa fa-list-ol"></i> <span>Students
                                    Management </span>
                            </a>
                            <ul class="sub-menu">
                                <li><a href="{{ route('student.index') }}"> Student List <i class="fa fa-plus text-theme"></i></a>
                                </li>
                                <li><a href="{{ route('student.folder.class') }}"> Student Folder <i
                                           class="fa fa-folder text-theme"></i></a></li>
                                <li><a href="{{ route('student.pending.index') }}"> Student Pending List <i
                                           class="fa fa-plus text-theme"></i></a></li>
                                <li><a href="{{ route('student.user.index') }}"> Student User List <i
                                           class="fa fa-plus text-theme"></i></a></li>
                                <li><a href="{{ route('student.non.errol.users') }}"> Non Errol User List <i
                                           class="fa fa-plus text-theme"></i></a></li>
                                           
                                           
                                <li><a href="{{ route('student.create') }}"> Add Student <i class="fa fa-list text-theme"></i> </a>
                                </li>
                                <li><a href="{{ route('admin.promotion-class.create') }}"> Promotion Class <i
                                           class="fa fa-list text-theme"></i> </a></li>
                                <li><a href="{{ route('admin.absent.index') }}">Student Absent List <i
                                           class="fa fa-list text-theme"></i> </a></li>

                            </ul>
                        </li>
                    @endcan
                    @can('waiver management')
                        <li class="has-sub">
                            <a href="javascript:;"> <b class="caret"></b> <i class="fa fa-list-ol"></i> <span>Waiver
                                    Management </span>
                            </a>
                            <ul class="sub-menu">
                                <li><a href="{{ route('admin.student-waiver.index') }}"> Student Waiver List <i
                                           class="fa fa-plus text-theme"></i></a></li>
                                <li><a href="{{ route('admin.waiver.index') }}"> Waiver Type List <i
                                           class="fa fa-plus text-theme"></i></a></li>
                                {{-- <li><a href="{{ route('admin.waiver-type.index') }}"> Waiver Type List <i class="fa fa-plus text-theme"></i></a></li> --}}
                            </ul>
                        </li>
                    @endcan
                    @can('attendance')
                        <li class="has-sub">
                            <a href="javascript:;"> <b class="caret"></b> <i class="fa fa-clipboard"></i> <span>Attendance
                                </span>
                            </a>
                            <ul class="sub-menu">
                                <li><a href="{{ route('student.attendance.create') }}"> New Attendance<i
                                           class="fa fa-plus text-theme"></i></a></li>
                                <li><a href="{{ route('student.attendance.index') }}"> List of Attendance <i
                                           class="fa fa-list text-theme"></i> </a></li>
                            </ul>
                        </li>
                    @endcan
                    @can('home work')

                        <li class="has-sub">
                            <a href="javascript:;"> <b class="caret"></b> <i class="fa fa-clipboard"></i> <span>Home Work
                                </span>
                            </a>
                            <ul class="sub-menu">
                                <li><a href="{{ route('student.homework.create') }}"> Add New Home Work<i
                                           class="fa fa-plus text-theme"></i></a></li>
                                <li><a href="{{ route('student.homework.index') }}"> Home Work List <i
                                           class="fa fa-list text-theme"></i> </a></li>
                            </ul>
                        </li>

                    @endcan
                    <li class="nav-header">Accounts</li>
                    @can('fee management')
                        <li class="has-sub">
                            <a href="javascript:;"> <b class="caret"></b> <i class="fa fa-list-ol"></i> <span>Fee Management
                                </span>
                            </a>
                            <ul class="sub-menu">
                                <li><a href="{{ route('admin.fee-category.index') }}"> Fee Category List <i
                                           class="fa fa-list text-theme"></i></a></li>
                                <li><a href="{{ route('admin.fee-amount-setting.index') }}"> Fee Batch Wise Setting <i
                                           class="fa fa-plus text-theme"></i></a></li>
                                <li><a href="{{ route('admin.fee-collection.index') }}">Monthly Fee Collection <i
                                           class="fa fa-plus text-theme"></i></a></li>
                                <li><a href="{{ route('admin.monthlyFeeDueList') }}">Monthly Fee Due List <i
                                           class="fa fa-list text-theme"></i></a></li>
                                <li><a href="{{ route('admin.othersFeeCollection') }}">Others Fee Collection <i
                                           class="fa fa-plus text-theme"></i></a></li>
                                <li><a href="{{ route('admin.othersFeeDueList') }}">Others Fee Due List <i
                                           class="fa fa-list text-theme"></i></a></li>

                            </ul>
                        </li>
                    @endcan
                    @can('payment management')
                        <li class="has-sub">
                            <a href="javascript:;"> <b class="caret"></b> <i class="fa fa-list-ol"></i> <span>Payment
                                    Management </span>
                            </a>
                            <ul class="sub-menu">
                                <li><a href="{{ route('admin.account.index') }}"> Account List <i
                                           class="fa fa-plus text-theme"></i></a></li>
                                <li><a href="{{ route('admin.bank.index') }}"> Bank List <i class="fa fa-plus text-theme"></i></a>
                                </li>
                                <li><a href="{{ route('admin.paymentMethod.index') }}"> Payment Method List <i
                                           class="fa fa-plus text-theme"></i></a></li>
                            </ul>
                        </li>
                    @endcan

                    <li class="nav-header">Question</li>
                    @can('mcq qustions')
                        <li class="has-sub">
                            <a href="javascript:;"> <b class="caret"></b> <i class="fa fa-clipboard"></i> <span>MCQ
                                    Questions</span>
                            </a>
                            <ul class="sub-menu">
                                <li><a href="{{ route('admin.mcq.index') }}">MCQ Question List<i
                                           class="fa fa-list text-theme"></i></a></li>
                                <li><a href="{{ route('admin.mcq.create') }}">Create MCQ Question<i
                                           class="fa fa-plus text-theme"></i></a></li>
                                <li><a href="{{ route('admin.mcq.create.new') }}">New MCQ Question<i
                                           class="fa fa-plus text-theme"></i></a></li>
                                <li><a href="{{ route('admin.mcq-setting.index') }}">MCQ Q Setting List<i
                                           class="fa fa-list text-theme"></i></a></li>
                            </ul>
                        </li>
                    @endcan
                    @can('written qustions')
                        <li class="has-sub">
                            <a href="javascript:;"> <b class="caret"></b> <i class="fa fa-clipboard"></i> <span>Written
                                    Questions</span>
                            </a>
                            <ul class="sub-menu">
                                <li><a href="{{ route('written.question.index') }}">Written Question List<i
                                           class="fa fa-list text-theme"></i></a></li>
                                <li><a href="{{ route('written.question.create') }}">Create Written Question<i
                                           class="fa fa-plus text-theme"></i></a></li>
                                <li><a href="{{ route('admin.written-setting.index') }}">Written Q Setting List<i
                                           class="fa fa-list text-theme"></i></a></li>
                            </ul>
                        </li>
                    @endcan


                    <!-- <li class="has-sub">
                            <a href="javascript:;"> <b class="caret"></b> <i class="fa fa-clipboard"></i> <span>Student Q Setting</span>
                            </a>
                            <ul class="sub-menu">
                                <li><a href="{{ route('admin.mcq.question.student.setting.index') }}">MCQ Q Setting List<i class="fa fa-list text-theme"></i></a></li>
                                <li><a href="{{ route('admin.written.question.student.setting.index') }}">Written Q Setting List<i class="fa fa-list text-theme"></i></a></li>
                            </ul>
                        </li>  -->

                    @can('result management')
                        <li class="has-sub">
                            <a href="javascript:;"> <b class="caret"></b> <i class="fa fa-clipboard"></i> <span> Result
                                    Management </span></a>
                            <ul class="sub-menu">
                                <li><a href="{{ route('admin.written.exam.results.index') }}">Written Result<i
                                           class="fa fa-plus text-theme"></i></a></li>
                                <li><a href="{{ route('admin.mcq.exam.results.index') }}">MCQ Result <i
                                           class="fa fa-list text-theme"></i> </a></li>
                                <li><a href="{{ route('admin.result.group.index') }}">Group Result<i
                                           class="fa fa-plus text-theme"></i></a></li>
                            </ul>
                        </li>
                    @endcan
                    @can('old questions')
                        <li class="has-sub">
                            <a href="javascript:;"> <b class="caret"></b> <i class="fa fa-clipboard"></i> <span>Old
                                    Questions</span>
                            </a>
                            <ul class="sub-menu">

                                <li><a href="{{ route('boardquestion.index') }}">Board Questions <i
                                           class="fa fa-list text-theme"></i> </a></li>
                                <li><a href="{{ route('old_question.index') }}">School Questions <i
                                           class="fa fa-list text-theme"></i> </a></li>
                            </ul>
                        </li>

                    @endcan
                    @can('sheet management')

                        <li class="has-sub">
                            <a href="javascript:;"> <b class="caret"></b> <i class="fa fa-clipboard"></i> <span>Sheet
                                    Management </span>
                            </a>
                            <ul class="sub-menu">
                                <li><a href="{{ route('sheet.index') }}">Sheets List<i class="fa fa-plus text-theme"></i></a></li>
                                <li><a href="{{ route('sheet.create') }}">Add Sheet <i class="fa fa-list text-theme"></i> </a>
                                </li>
                                <li><a href="{{ route('admin.sheet.setting.index') }}">Sheet Setting<i
                                           class="fa fa-list text-theme"></i> </a></li>
                                <li><a href="{{ route('admin.sheet.student.setting.index') }}">Sheet Student Setting<i
                                           class="fa fa-list text-theme"></i> </a></li>
                            </ul>
                        </li>
                    @endcan
                    @can('sms settting')
                        <li class="nav-header">SMS</li>
                        <li class="has-sub">
                            <a href="javascript:;"> <b class="caret"></b> <i class="fa fa-envelope"></i> <span>SMS Setting
                                </span>
                            </a>
                            <ul class="sub-menu">
                                <li><a href="{{ route('sms_templete.index') }}"> SMS Templetes <i
                                           class="fa fa-plus text-theme"></i></a></li>
                                <!--   <li><a href="{{ route('all.student.sms') }}">  All Student SMS <i class="fa fa-list text-theme"></i> </a></li> -->
                                <li><a href="{{ route('batch.sms') }}"> Batch SMS <i class="fa fa-list text-theme"></i> </a></li>
                                <li><a href="{{ route('single.sms') }}"> Single SMS <i class="fa fa-list text-theme"></i> </a>
                                </li>
                                <li><a href="{{ route('custom.batch.sms') }}"> Custom Batch SMS<i
                                           class="fa fa-list text-theme"></i> </a></li>
                                <li><a href="{{ route('sms_history.index') }}"> SMS Reports <i class="fa fa-list text-theme"></i>
                                    </a></li>
                            </ul>
                        </li>
                    @endcan
                    @can('website settting')
                        <li class="nav-header">Settings</li>
                        <li class="has-sub">
                            <a href="javascript:;"> <b class="caret"></b> <i class="fa fa-cogs"></i> <span>Website
                                    Settings </span>
                            </a>
                            <ul class="sub-menu">
                                <li><a href="{{ route('slider.index') }}"> Sliders <i class="fa fa-share"></i> </a></li>
                                <li><a href="{{ route('notice.index') }}"> Notices <i class="fa fa-share"></i> </a></li>
                                <li><a href="{{ route('social.index') }}"> Social Media <i class="fa fa-share"></i> </a></li>
                                <li><a href="{{ route('website.setting.index') }}"> Web Setting <i
                                           class="fa fa-cogs text-theme"></i> </a></li>
                                <li><a href="{{ route('blog.index') }}"> Blogs <i class="fa fa-cogs text-theme"></i> </a></li>
                                <li><a href="{{ route('user.index') }}"> User Management <i class="fa fa-cogs text-theme"></i>
                                    </a></li>
                                <li><a href="{{ route('admin.about.index') }}"> About Management <i
                                           class="fa fa-cogs text-theme"></i> </a></li>
                            </ul>
                        </li>
                    @endcan


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

    <script src="{{ asset('public/backend') }}/assets/plugins/summernote/dist/summernote.min.js" type="text/javascript"></script>

    <script src="https://cdn.datatables.net/1.10.16/js/jquery.dataTables.min.js"></script>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.0/jquery.validate.js"></script>

    <script src="{{ asset('public/backend') }}/assets/js/sms_counter.min.js" type="text/javascript"></script>


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

    <script>
        $('#message').countSms('#sms-counter');
    </script>

    <script>
        $(document).on('click', '#delete', function(e) {
            e.preventDefault();
            var link = $(this).attr("href");
            Swal.fire({
                title: 'Are you sure?',
                text: "Delete this data!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes, delete it!'
            }).then((result) => {
                if (result.value) {
                    window.location.href = link;
                    Swal.fire(
                        'Deleted!',
                        'Data has been deleted.',
                        'success'
                    )
                }
            })
        });
    </script>


    <script>
        $(document).on('click', '#approved', function(e) {
            e.preventDefault();
            var link = $(this).attr("href");
            Swal.fire({
                title: 'Are you sure?',
                text: "Approved this Student!",
                icon: 'success',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes, Comfirm it!'
            }).then((result) => {
                if (result.value) {
                    window.location.href = link;
                    Swal.fire(
                        'Approved!',
                        'Student has been Approved.',
                        'success'
                    )
                }
            })
        });
    </script>

    {{-- # TOASTR JS BASED LARAVEL NOTIFICATION SYSTEM
        # FOR MORE:: https://github.com/idemonbd/notify --}}



    @yield('customjs')


</body>

</html>
