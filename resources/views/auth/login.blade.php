<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <title>Admin Login</title>
    <meta content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" name="viewport" />
    <meta content="" name="description" />
    <meta content="" name="author" />

    <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700" rel="stylesheet" />
    <link href="{{ asset('public/backend') }}/assets/css/default/app.min.css" rel="stylesheet" />
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    
</head>

<body class="pace-top">

    <div id="page-loader" class="fade show">
        <span class="spinner"></span>
    </div>


    <div id="page-container" class="fade">

        <div class="login login-with-news-feed">

            <div class="news-feed">
                <div class="news-image" style="background-image: url({{ asset('public/backend') }}/assets/img/login-bg/login-bg-11.jpg)"></div>
                
            </div>


            <div class="right-content">

                <div class="login-header">
                    <div class="brand">
                        <span class="logo"></span> <b>Admin</b> Login
                         
                    </div>
                    <div class="icon">
                        <i class="fa fa-sign-in"></i>
                    </div>
                </div>


                <div class="login-content">
                    <form action="{{ route('login') }}" method="post" class="margin-bottom-0">
                        @csrf
                        <div class="form-group m-b-15">
                            <input type="text"  name="email"
                            value="{{ old('email') }}" class="form-control form-control-lg" placeholder="Email Address" required />
                            <div class="text-danger">{{ $errors->first('email') }}</div>
                        </div>
                        <div class="form-group m-b-15">
                            <input type="password" name="password" value="{{ old('password') }}" class="form-control form-control-lg" placeholder="Password" required />
                            <div class="text-danger">{{ $errors->first('password') }}</div>
                        </div>
                        <div class="checkbox checkbox-css m-b-30">
                            <input type="checkbox" id="remember_me_checkbox" value="" />
                            <label for="remember_me_checkbox">
                                Remember Me
                            </label>
                        </div>
                        <div class="login-buttons">
                            <button type="submit" class="btn btn-success btn-block btn-lg">Sign in</button>
                        </div>
                        
                        <hr />
                        <p class="text-center text-grey-darker mb-0">
                            &copy; {{ $websetting->site_name }}. All Right Reserved 2021
                        </p>
                    </form>
                </div>

            </div>

        </div>


    

    </div>


    <script src="{{ asset('public/backend') }}/assets/js/app.min.js" type="text/javascript"></script>
    <script src="{{ asset('public/backend') }}/assets/js/theme/default.min.js" type="text/javascript"></script>

   
</body>
</html>