
 <!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title') - {{ $websetting->site_name }}</title>
    <link rel="icon" href="{{ asset('public/frontend') }}/images/logo.png" type="images/gif" sizes="16x16">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">

    <link rel="shortcut icon" href="{{ asset($websetting->favicon) }}" type="image/x-icon">


    <link rel="canonical" href="https://abcbioscience.com/" />
    <link rel="shortcut icon" href="{{ asset($websetting->footer_logo) }}">
    <meta name="Developed By" content="SOFTECH BD LTD" />
    <meta name="Developer" content="SOFTECH BD LTD DEVELOPER Team" />
    <meta property="og:locale" content="en_US" />
    <meta name="google-site-verification" content="dZeZSAs03tBolu9_8KjQ_djhiaRlxHqxI2Vb6K81Esg" />
    <meta property="og:site_name" content="{{ $websetting->site_name }}"/>
    <meta name='description'content="{{ $websetting->site_name }}" />
    <meta name='keywords' content='{{ $websetting->site_name }}' />
    <meta property="og:url" content="https://abcbioscience.com">
    <meta property="og:type" content="{{ $websetting->site_name }}" />
    <meta property="og:title" content="{{ $websetting->site_name }}" />
    <meta property="og:description" content="{{ $websetting->site_name }}" />
    <meta property="og:image" content="{{ asset($websetting->footer_logo) }}" />
    <meta property="og:image:alt" content="{{ $websetting->site_name }}">
    <meta property="og:image:type" content="image/png">
    <meta name="twitter:card" content="{{ $websetting->site_name }}" />
    <meta name="twitter:title" content="{{ $websetting->site_name }}" />
    <meta name="twitter:site" content="{{ $websetting->site_name }}" />


    <!--    font awsome-->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css" integrity="sha512-SfTiTlX6kk+qitfevl/7LibUOeJWlt9rbyDn92a1DqWOw9vWG2MFoays0sgObmWazO5BQPiFucnnEAjpAB+/Sw==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <!--    MAGNIFIC POPUP-->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/magnific-popup.js/1.1.0/magnific-popup.min.css" integrity="sha512-+EoPw+Fiwh6eSeRK7zwIKG2MA8i3rV/DGa3tdttQGgWyatG/SkncT53KHQaS5Jh9MNOT3dmFL0FjTY08And/Cw==" crossorigin="anonymous" />
    <!--    google font-->
    <link href="https://fonts.googleapis.com/css2?family=Roboto:ital,wght@0,100;0,300;0,400;0,500;0,700;0,900;1,100;1,300;1,400;1,500;1,700;1,900&display=swap" rel="stylesheet">
    <!--    SLICK SLIDER-->
    <link rel="stylesheet" href="{{ asset('public/frontend') }}/css/slick-theme.css">
    <link rel="stylesheet" href="{{ asset('public/frontend') }}/css/slick.css">
    <!--    style-->
    <link rel="stylesheet" href="{{ asset('public/frontend') }}/css/style.css">
    <link rel="stylesheet" href="{{ asset('public/frontend') }}/css/responsive.css">
    <meta name="csrf-token" content="{{ csrf_token() }}">

     @yield('css')
</head>

<body>

    <section class="section-header-top clearfix">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-6 col-md-6">
                    <div class="logo">
                        <a href="{{ route('frontend') }}" class="d-md-flex align-items-center">
                             <h1>{{ $websetting->site_name }}</h1>
                        </a>
                    </div>
                </div>
                <div class="col-6 col-md-6">
                    <div class="ht-right">
                        <div class="ht-right-top">

                             @if(Auth::check())
                                @if(Auth::user()->role_id==1)
                                    <a href="{{ route('home')  }}">Admin Dashboard</a>
                                @else
                                <a href="{{ route('student.dashboard') }}"> <i class="fa fa-user"></i> My Profile </a>
                                <a href="{{ route('student.logout') }}" class="ml-2"> <i class="fa fa-sign-out"></i> Logout </a>
                                @endif
                                @else

                               
                                <a href="{{ route('student.login') }}"> <i class="fa fa-user"></i>Login </a>
                                <a href="{{ route('student.register') }}" class="ml-2"> <i class="fa fa-user"></i>Registation </a>

                                @endif

                        </div>
                        <div class="ht-right-bottom">
                            <p class="bg-success text-white">Contact us through WhatsApp message:   <i class="fa fa-whatsapp" aria-hidden="true"></i> {{ $websetting->phone }}</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <header class="clearfix">
        <div class="container">
            <div class="menubar clearfix">
                <ul class="d-none d-lg-block">
                    <li><a href="{{ route('frontend') }}">home</a></li>
                    <li><a href="{{ route('about') }}">about us</a></li>
                    <li class="sub-btn"><a href="javascript:void(0)">Download <i class="fa fa-angle-down"></i> </a>
                        <div class="sub-menu">
                            <ul>
                                <li><a href="{{ route('board.questiones') }}">Board Questions</a></li>
                                <li><a href="{{ route('school.questiones') }}">School Questions</a></li>
                                <li><a href="{{ route('college.questiones') }}">college Questions</a></li>
                                <li><a href="{{ route('lecture.sheet') }}">Lecture Sheet</a></li>
                            </ul>
                        </div>
                    </li>
                    <li><a href="{{ route('allbatch') }}"> Courses </a></li>
                    <li><a href="{{ route('blogs') }}">Blogs</a></li>
                    <li><a href="{{ route('notices') }}">Notices</a></li>
                    <li><a href="{{ route('ebook') }}">E-book</a></li>
                    <li><a href="{{ route('contact') }}">Contact us</a></li>

                </ul>


                <div class="mobile-btn d-block d-lg-none">
                    <div class="mobile-bars d-flex align-items-end flex-column bd-highlight" onClick="mobileFun()">
                        <span></span>
                        <span></span>
                        <span></span>
                    </div>
                </div>


            </div>
        </div>
    </header>

    <!--    MOBILE MENU-->
    <div class="mobile-menu">
        <!-- accordion-->
        <div class="accordion accordion-flush" id="accordionFlushExample">

            <div class="mobile-logo">
                <a href="{{ route('frontend') }}">
                    <img src="{{ asset('public/frontend') }}/images/logo.png" alt="mobile-logo">
                </a>
                <i class="fa fa-times" onClick="mobileFun()"></i>
            </div>
            <div class="accordion-item custom">
                <h2 class="accordion-header" id="">
                    <a href="">
                        <button class="accordion-button custom " type="button">
                            home
                        </button>
                    </a>
                </h2>
            </div>
            <div class="accordion-item">
                <h2 class="accordion-header" id="">
                    <a href="{{ route('about') }}">
                        <button class="accordion-button custom" type="button">
                            About Us
                        </button>
                    </a>
                </h2>

            </div>
            <div class="accordion-item">
                <h2 class="accordion-header" id="flush-headingOne">
                    <button class="accordion-button custom collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#one" aria-expanded="false" aria-controls="flush-collapseOne">
                        Downloads
                    </button>
                </h2>
                <div id="one" class="accordion-collapse collapse" aria-labelledby="one" data-bs-parent="#flush-headingOne">
                    <div class="accordion-body custom">
                        <ul>
                            <li> <a href="{{ route('board.questiones') }}">Board Questions</a>  </li>
                            <li> <a href="{{ route('school.questiones') }}">School Questions</a>  </li>
                            <li> <a href="{{ route('college.questiones') }}">College Questions</a>  </li>
                            <li> <a href="{{ route('lecture.sheet') }}">Lecture Sheet</a></li>
                        </ul>
                    </div>
                </div>
            </div>

            <div class="accordion-item custom">
                <h2 class="accordion-header" id="">
                    <a href="{{ route('allbatch') }}">
                        <button class="accordion-button custom" type="button">
                            Gallery
                        </button>
                    </a>
                </h2>
            </div>
            <div class="accordion-item custom">
                <h2 class="accordion-header" id="">
                    <a href="{{ route('allbatch') }}">
                        <button class="accordion-button custom" type="button">
                            Courses
                        </button>
                    </a>
                </h2>
            </div>
            <div class="accordion-item custom">
                <h2 class="accordion-header" id="">
                    <a href="{{ route('blogs') }}">
                        <button class="accordion-button custom" type="button">
                            Blogs
                        </button>
                    </a>
                </h2>
            </div>
            <div class="accordion-item custom">
                <h2 class="accordion-header" id="">
                    <a href="{{ route('notices') }}">
                        <button class="accordion-button custom" type="button">
                            Notices
                        </button>
                    </a>
                </h2>
            </div>
            <div class="accordion-item custom">
                <h2 class="accordion-header" id="">
                    <a href="{{ route('contact') }}">
                        <button class="accordion-button custom" type="button">
                            Contact Us
                        </button>
                    </a>
                </h2>
            </div>
        </div>

    </div>
    <!--    MOBILE MENU END-->

@yield('content')


    <!--    FOOTER SECTION-->
    <footer class="pt-5 pb-4">
        <div class="container">
            <div class="row">
                <div class="col-12 col-sm-6 col-md-6 col-lg-3 col-xl-3">
                    <div class="footer-box">
                        <div class="footer-head">
                            <h5>ABOUT COMPANY</h5>
                        </div>
                        <div class="footer-content">
                            
                            <img src="{{ asset($websetting->logo) }}" width="70%">
                            
                            
                             {!! $about->footer_about !!}
                        </div>
                    </div>
                </div>
                <div class="col-12 col-sm-6 col-md-6 col-lg-3 col-xl-3">
                    <div class="footer-box">
                        <div class="footer-head">
                            <h5>IMPORTANT LINKS</h5>
                        </div>
                        <div class="footer-content">
                            <a href="https://dhakaeducationboard.gov.bd/" target="_blank">
                                <i class="fa fa-angle-right"></i>
                                Board of Intermediate and Secondary Education, Dhaka.
                            </a>
                            <a href="http://www.ebook.gov.bd/" target="_blank">
                                <i class="fa fa-angle-right"></i>
                                 Ebook
                            </a>
                            <a href="https://www.bb.org.bd/en/index.php" target="_blank">
                                <i class="fa fa-angle-right"></i>
                                Bangladesh Bank
                            </a>
                            <a href="http://www.moedu.gov.bd" target="_blank">
                                <i class="fa fa-angle-right"></i>
                                Ministry of Education
                            </a>
                            <a href="{{ route('ebook') }}">
                                <i class="fa fa-angle-right"></i>
                                E-book
                            </a>
                        </div>
                    </div>
                </div>
                <div class="col-12 col-sm-6 col-md-6 col-lg-3 col-xl-3">
                    <div class="footer-box">
                        <div class="footer-head">
                            <h5>Menu</h5>
                        </div>
                        <div class="footer-content">
                            <a href="#"><i class="fa fa-angle-right"></i> Board Questions</a>
                            <a href="#"><i class="fa fa-angle-right"></i> School Questions</a>
                            <a href="#"><i class="fa fa-angle-right"></i> college Questions</a>
                            <a href="#"> <i class="fa fa-angle-right"></i> Lecture Sheet</a>
                            <a href="{{ route('blogs') }}">
                                <i class="fa fa-angle-right"></i>
                                Blogs
                            </a>
                            <a href="{{ route('contact') }}">
                                <i class="fa fa-angle-right"></i>
                                Contacts
                            </a>
                        </div>
                    </div>
                </div>
                <div class="col-12 col-sm-6 col-md-6 col-lg-3 col-xl-3">
                    <div class="footer-box">
                        <div class="footer-head">
                            <h5>Locations</h5>
                        </div>
                        <div class="footer-content-address">
                            <div class="address-box d-flex bd-highlight">
                                <div class="address-icon flex-shrink-1 bd-highlight">
                                    <i class="fa fa-home"></i>
                                </div>

                                <div class="address-details w-100 bd-highlight">
                                    <span>Address: {{ $websetting->address }}</span>
                                </div>
                            </div>
                            <div class="address-box d-flex bd-highlight">
                                <div class="address-icon flex-shrink-1 bd-highlight">
                                    <i class="fa fa-phone"></i>
                                </div>

                                <div class="address-details w-100 bd-highlight">
                                    <span>{{ $websetting->phone }}</span>
                                </div>
                            </div>
                            <div class="address-box d-flex bd-highlight">
                                <div class="address-icon flex-shrink-1 bd-highlight">
                                    <i class="fa fa-envelope-o"></i>
                                </div>

                                <div class="address-details w-100 bd-highlight">
                                    <span class="email"> {{ $websetting->email }}</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </footer>
    <!--    FOOTER SECTION END-->

    <!--    COPYRIGHT SECTION-->
    <div class="copyright-section">
        <div class="container">
            <div class="row">
                <div class="col-6">
                    <div class="copyright-left-content">
                        <p> Copyright &copy; 2021. All Rights Reserved</p>
                    </div>
                </div>
                <div class="col-6">
                    <div class="copyright-right-content">
                        <p>design &amp; developed by <a href="https://www.softech.com.bd/" class="text-success">Softech BD Ltd.</a></p>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!--    COPYRIGHT SECTION END-->

    <div class="main-mobile" onClick="mobileFun()">

    </div>


    <!--    JQUERY-->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <!--    BOOSTRAP-->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/magnific-popup.js/1.1.0/jquery.magnific-popup.min.js " integrity="sha512-IsNh5E3eYy3tr/JiX2Yx4vsCujtkhwl7SLqgnwLNgf04Hrt9BT9SXlLlZlWx+OK4ndzAoALhsMNcCmkggjZB1w==" crossorigin=" anonymous "></script>
    <!--    SLICK SLIDER-->
    <script src="{{ asset('public/frontend') }}/js/slick.min.js"></script>

    <script>
        function mobileFun() {
            $('.mobile-menu').toggleClass('sidenav_2');
            $('.main-mobile').toggleClass('main-mobile-add');
        }


        $('.autoplay').slick({
            slidesToShow: 5,
            slidesToScroll: 2,
            autoplay: true,
            autoplaySpeed: 2000,
            dots: false,
            arrows: true,
            nextArrow: $('.next'),
            prevArrow: $('.prev'),
            responsive: [{
                    breakpoint: 992,
                    settings: {
                        slidesToShow: 4,
                        slidesToScroll: 2,
                        infinite: true,
                        dots: true
                    }
                },
                {
                    breakpoint: 768,
                    settings: {
                        slidesToShow: 3,
                        slidesToScroll: 2
                    }
                },
                {
                    breakpoint: 576,
                    settings: {
                        slidesToShow: 3,
                        slidesToScroll: 1
                    }
                },
                {
                    breakpoint: 350,
                    settings: {
                        slidesToShow: 2,
                        slidesToScroll: 1
                    }
                }

            ]

        });



        $('.autoplay2').slick({
            slidesToShow: 1,
            slidesToScroll: 1,
            autoplay: true,
            autoplaySpeed: 2000,
            dots: false,
            arrows: true,
            nextArrow: $('.nxt'),
            prevArrow: $('.prv'),


        });

        //fot counter
        $('.counter').each(function() {
            var $this = $(this),
                countTo = $this.attr('data-count');

            $({
                countNum: $this.text()
            }).animate({
                    countNum: countTo
                },

                {
                    duration: 6000,
                    easing: 'linear',
                    step: function() {
                        $this.text(Math.floor(this.countNum));
                    },
                    complete: function() {
                        $this.text(this.countNum);
                        //alert('finished');
                    }

                });

        });

    </script>

</body>

</html>
