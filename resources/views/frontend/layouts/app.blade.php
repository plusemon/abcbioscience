
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>@yield('title') - {{ $websetting->site_name }}</title>
    <link rel="shortcut icon" href="{{ asset($websetting->favicon) }}" type="image/x-icon">
    
    
    
    <link rel="canonical" href="https://abcbioscience.com/" />
    <link rel="shortcut icon" href="{{ asset($websetting->footer_logo) }}">
    <meta name="Developed By" content="SOFTECH BD LTD" />
    <meta name="Developer" content="SOFTECH BD LTD DEVELOPER Team" />
    <meta property="og:locale" content="en_US" />
    <meta name="google-site-verification" content="dZeZSAs03tBolu9_8KjQ_djhiaRlxHqxI2Vb6K81Esg" />
    <meta property="og:site_name" content="ABC Bio Science"/>
    <meta name='description'content="ABC Bio Science" />
    <meta name='keywords' content='ABC Bio Science' />
    <meta property="og:url" content="https://abcbioscience.com">
    <meta property="og:type" content="ABC Bio Science" />
    <meta property="og:title" content="ABC Bio Science" />
    <meta property="og:description" content="ABC Bio Science" />
    <meta property="og:image" content="{{ asset($websetting->footer_logo) }}" />
    <meta property="og:image:alt" content="ABC Bio Science">
    <meta property="og:image:type" content="image/png">
    <meta name="twitter:card" content="ABC Bio Science" />
    <meta name="twitter:title" content="ABC Bio Science" />
    <meta name="twitter:site" content="ABC Bio Science" />
    
    
    
    
    
    
    <!--    google font-->
    <link rel="preconnect" href="https://fonts.gstatic.com">

    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:ital,wght@0,100;0,300;0,400;0,500;0,700;0,900;1,100;1,300;1,400;1,500;1,700;1,900&display=swap" rel="stylesheet">
    <!--    bootstrap-->
    <!--    animate css-->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css">
    <link rel="stylesheet" href="{{ asset('public/frontend') }}/css/bootstrap.min.css">
    <!--    <link rel="stylesheet" href="css/navbar-fixed.css">-->
    <!--    slick -->
    <link rel="stylesheet" href="{{ asset('public/frontend') }}/css/slick-theme.css">
    <link rel="stylesheet" href="{{ asset('public/frontend') }}/css/slick.css">
    <!--    font awsome-->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/css/toastr.css" />

    <link rel="stylesheet" href="{{ asset('public/frontend') }}/css/style.css">
    <!--    responsive style-->
    <link rel="stylesheet" href="{{ asset('public/frontend') }}/css/responsive.css">

    <meta name="csrf-token" content="{{ csrf_token() }}">

    @yield('css')
</head>

<body> 
    <!-- preloader start 
    <div id="pre-loader"> <img src="{{ asset('public/frontend') }}/photos/overall.svg" alt=""></div>  -->
    <a id="button"></a>
    <!-- preloader end -->
    <!-- main-head-->
    <header>
        <!--    header-top-->
        <section class="header-top-section">
            <div class="container">
                <div class="header-top">
                    <div class="row">
                        <div class="col-12 col-md-5 align-self-center">
                            <div class="ht-left"> 
                                 <a class="" href="{{ url('/') }}"><h1>ABCBioScience</h1></a> 
                            </div>
                        </div>
                        <div class="col-12 col-sm-4 col-md-2">
                            <div class="ht-middle">
                                <a href="https://www.m.me/abcbioscience" target="_blank"> <img src="{{ asset('public/frontend') }}/photos/messenger.png" alt="messenger-image"> </a>
                            </div>
                        </div>
                        <div class="col-12 col-sm-8 col-md-5">
                            <div class="ht-right align-self-center">

                                @if(Auth::check())

                                <a href="{{ route('student.dashboard') }}"> <i class="fa fa-user"></i>My Profile </a>
                                <a href="{{ route('student.logout') }}" class="ml-2"> <i class="fa fa-sign-out"></i>Logout </a>

                                @else


                                <a href="{{ route('student.login') }}"> <i class="fa fa-user"></i>Login </a>
                                <a href="{{ route('student.register') }}" class="ml-2"> <i class="fa fa-user"></i>Registation </a>


                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!--  header-top end -->
        <!--    header section-->
        <section class="header-section">
            <div class="container">
                <div class="menubar">
                     <ul>
                        <li><a href="{{ route('frontend') }}">home</a></li>
                        <li><a href="{{ route('about') }}">about us</a></li>
                        <li class="btn-sub"><a href="#">Downloads<i class="fa fa-angle-down"></i></a>
                            <div class="sub-menu">
                                <a href="{{ route('board.questiones') }}">Board Questions</a>
                                <a href="{{ route('school.questiones') }}">School Questions</a>
                                <a href="{{ route('college.questiones') }}">college Questions</a>
                                <a href="{{ route('lecture.sheet') }}">Lecture Sheet</a>
                            </div>
                        </li>
{{-- 
                        <li class="btn-sub"><a href="#">Exam<i class="fa fa-angle-down"></i></a>
                            <div class="sub-menu">
                                <a href="{{ route('mcqexam') }}">MCQ Exam</a>
                                <a href="{{ route('writtenexam') }}">Written Exam</a>
                            </div>
                        </li> --}}

                        <li><a href="{{ route('allbatch') }}"> Courses </a></li>

                        <li><a href="{{ route('blogs') }}">Blogs</a></li>
                        <li><a href="{{ route('notices') }}">Notices</a></li>
                        <li><a href="{{ route('contact') }}">Contact us</a></li>
                    </ul>
                </div>

                  <div class="mini-show">
                    <div class="ht-right align-self-center">
                         @if(Auth::check())

                            <a href="{{ route('student.dashboard') }}"> <i class="fa fa-user"></i> My Profile </a>
                            <a href="{{ route('student.logout') }}" class="ml-2"> <i class="fa fa-sign-out"></i>Logout </a>

                            @else


                            <a href="{{ route('student.login') }}"> <i class="fa fa-user"></i>Login </a>
                            <a href="{{ route('student.register') }}" class="ml-2"> <i class="fa fa-user"></i>Registation </a>


                            @endif
                    </div>
                </div>
                <div class="mobile-btn"> <i class="fa fa-bars"></i> </div>
            </div>
            <!--        mobile menu-->
            <div class="mobile-menu">
                <!--           Accordion-->
                <div class="mm-menu">
                    <div class="accordion" id="accordionExample">
                        <div class="menu-box menu-box2">
                            <div class="mh-menu">
                                <div class="mobile-btn mobile-btn2">
                                    <h4 class="py-3 corsor">menu</h4> </div>
                                <div class="mobile-btn">
                                    <h2 class="py-2 corsor">
                                        <i class="fa fa-times"></i>
                                    </h2> </div>
                            </div>
                        </div>
                        <div class="menu-box">
                            <div class="menu-link"> <a href="{{ route('frontend') }}"><i class="fa fa-home logo-left"></i>Home</a> </div>
                        </div>
                        <div class="menu-box">
                            <div class="menu-link"> <a href="{{ route('about') }}"><i class="fa fa-info logo-left"></i>About us</a> </div>
                        </div>


                        <div class="menu-box">
                            <div class="menu-link" id="headingTwo"> <a class="mmenu-btn" type="button" data-toggle="collapse" data-target="#collapseTwo"><i class="fa fa-download logo-left"></i> Downlaods<i class="fa fa-plus logo-right"></i></a> </div>
                            <div id="collapseTwo" class="collapse menu-body" aria-labelledby="headingTwo" data-parent="#accordionExample">
                                <div class="card-body">
                                    <ul>

                                        <li> <a href="{{ route('board.questiones') }}">Board Questions</a>  </li>
                                        <li> <a href="{{ route('school.questiones') }}">School Questions</a>  </li>
                                        <li> <a href="{{ route('school.questiones') }}">College Questions</a>  </li>
                                        <li> <a href="{{ route('lecture.sheet') }}">Lecture Sheet</a></li>
                                    </ul>
                                </div>
                            </div>
                        </div>

                      {{--   <div class="menu-box">
                            <div class="menu-link" id="headingTwo"> <a class="mmenu-btn" type="button" data-toggle="collapse" data-target="#collapseTwo"><i class="fa fa-download logo-left"></i> Exam<i class="fa fa-plus logo-right"></i></a> </div>
                            <div id="collapseTwo" class="collapse menu-body" aria-labelledby="headingTwo" data-parent="#accordionExample">
                                <div class="card-body">
                                    <ul>

                                        <li> <a href="{{ route('mcqexam') }}">MCQ Exam</a>  </li>
                                        <li> <a href="{{ route('writtenexam') }}">Written Exam</a>  </li>

                                    </ul>
                                </div>
                            </div>
                        </div> --}}

                        <div class="menu-box">
                            <div class="menu-link"> <a href="{{ route('allbatch') }}"><i class="fa fa-wpforms menuicon logo-left"></i>Courses</a> </div>
                        </div>


                         <div class="menu-box">
                            <div class="menu-link"> <a href="{{ route('blogs') }}"><i class="fa fa-file-text menuicon logo-left"></i>Blog</a> </div>
                        </div>

                        <div class="menu-box">
                            <div class="menu-link"> <a href="{{ route('notices') }}"><i class="fa fa-file menuicon logo-left"></i>Notices</a> </div>
                        </div>
                        <div class="menu-box">
                            <div class="menu-link"> <a href="{{ route('contact') }}"><i class="fa fa-envelope logo-left"></i>Contact us</a> </div>
                        </div>
                    </div>
                </div>
                <!--   Accordion end -->
            </div>
        </section>
        <!--    header section end-->
    </header>
    <!-- main-head end-->




    @yield('content')








    <!--    footer section-->
    <section class="footer-section py-5">
        <div class="container">
            <div class="row">
                <div class="col-12 col-md-3">
                    <div class="footer-about  wow animate__animated animate__fadeInUp">
                        <div class="fa-head after">
                            <h4>about us</h4> </div>
                        <div class="fa-discription py-3">
                            <img src="{{ asset($websetting->footer_logo) }}" alt="Logo" title="Logo" width="10%">
                            <p>{{ $websetting->about }}</p>
                        </div>
                    </div>
                </div>
                <div class="col-12 col-md-3">
                    <div class="footer-link  wow animate__animated animate__fadeInUp">
                        <div class="fa-head after">
                            <h4>important link</h4> </div>
                        <div class="fl-discription">

                            <a href="http://www.educationboardresults.gov.bd/" target="_blank">
                                <i class="fa fa-long-arrow-right mr-2"></i>
                                <span>Eduction Board Result</span>
                            </a>
                            <a href="https://dhakaeducationboard.gov.bd/" target="_blank">
                                <i class="fa fa-long-arrow-right mr-2"></i>
                                <span>Dhaka Board</span>
                            </a>
                            <a href="https://www.youtube.com" target="_blank">
                                <i class="fa fa-long-arrow-right mr-2"></i>
                                <span>Youtubes</span>
                            </a>

                        </div>
                    </div>
                </div>
                <div class="col-12 col-md-3">
                    <div class="footer-link  wow animate__animated animate__fadeInUp">
                        <div class="fa-head after">
                            <h4>Menubar</h4> </div>
                        <div class="fl-discription">
                            <a href="{{ route('frontend') }}"><i class="fa fa-long-arrow-right mr-2"></i><span>Home</span></a>
                            <a href="{{ route('about') }}"><i class="fa fa-long-arrow-right mr-2"></i><span>About</span></a>
                            <a href="{{ route('contact') }}"><i class="fa fa-long-arrow-right mr-2"></i><span>Contact</span></a>
                            <a href="{{ route('student.login') }}"><i class="fa fa-long-arrow-right mr-2"></i><span>Login</span></a>
                            <a href="{{ route('student.register') }}"><i class="fa fa-long-arrow-right mr-2"></i><span>Registation</span></a>
                        </div>
                    </div>
                </div>
                <div class="col-12 col-md-3">
                    <div class="fc-head  wow animate__animated animate__fadeInUp">
                        <div class="fa-head after">
                            <h4>Contact Us</h4> </div>
                        <div class="fc-discription">
                            <div class="fc-social-media">
                                @foreach($socialmedia as $media)
                                <a href="{{ $media->link }}" target="_blank" title="{{ $media->name }}"><i class="{{ $media->icon }}"></i>  </a>
                                @endforeach


                            </div>
                            <div class="media pt-3">
                                <div class="media-left"> <i class="fa fa-phone"></i> </div>
                                <div class="media-body">
                                    <p> <span>Phone :</span> {{ $websetting->phone }} </p>
                                </div>
                            </div>
                            <div class="media">
                                <div class="media-left"> <i class="fa fa-envelope-o"></i> </div>
                                <div class="media-body">
                                    <p> <span>Email :</span> <a href="#">{{ $websetting->email }}</a> </p>
                                </div>
                            </div>
                            <form action="">
                                <div class="input-group mb-3">
                                    <input type="text" class="form-control" placeholder="Enter Mobile no">
                                    <div class="input-group-append"> <a href="#" type="submit" class="btn btn-custom">Subscribe</a> </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!--    footer section end-->
    <!--    copyright section-->
    <section class="copyright-section py-4">
        <div class="container">
            <div class="row">
                <div class="col-12 wow animate__animated animate__fadeInUp">
                    <p>2021 © All Rights Reserved. Powered by <a href="#">{{ $websetting->site_name }}</a>. <!--Developed By <a href="https://www.softech.com.bd" title="SOFTTECH BD LTD" target="_blank">SOFTTECH BD LTD.</a> --></p>
                </div>
            </div>
        </div>
    </section>
    <!--    copyright section end-->
    <script src="{{ asset('public/frontend') }}/js/jquery-3.5.1.min.js"></script>
    <script src="{{ asset('public/frontend') }}/js/popper.min.js"></script>
    <script src="{{ asset('public/frontend') }}/js/bootstrap.min.js"></script>
    <script src="{{ asset('public/frontend') }}/js/wow.min.js"></script>
    <script src="{{ asset('public/frontend') }}/js/parallax.min.js"></script>
    <script src="{{ asset('public/frontend') }}/js/slick.min.js"></script>
    <script src="{{ asset('public/frontend') }}/js/main.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/js/toastr.min.js"></script>


    <script>
            @if(Session::has('message'))

            var type = "{{Session::get('alert-type','info')}}"

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



        </script>



    @yield('customjs')


</body>

</html>
