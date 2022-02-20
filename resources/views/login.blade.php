<!DOCTYPE html>
<html dir="ltr">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <!-- Tell the browser to be responsive to screen width -->
    <meta name="viewport" content="width=device-width, initial-scale=1, user-scalable=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <!-- Favicon icon -->
    <link rel="icon" type="image/png" sizes="16x16" href="{{ asset('nis-logo.png') }}">
    <title>eRegister</title>
    <!-- Custom CSS -->
    <link href="{{ asset('backend/dist/css/style.min.css') }}" rel="stylesheet">
    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
    <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
<![endif]-->
<style>
    .help-block {
        color: #dd4b39
    }
</style>
</head>
<body>
    <div class="main-wrapper">
        <div class="preloader">
            <div class="lds-ripple">
                <div class="lds-pos"></div>
                <div class="lds-pos"></div>
            </div>
        </div>
        <div class="auth-wrapper d-flex no-block justify-content-center align-items-center position-relative"
            style="background:url({{ asset('backend/assets/images/big/auth-bg.jpg')}}) no-repeat center center;">
            <div class="auth-box row">
                <div class="col-lg-6 col-md-6 offset-md-3 bg-white">
                    <div class="p-3">
                        <div class="text-center">
                            <img src="{{ asset('nis-logo.png') }}" alt="wrapkit">
                        </div>
                        <h2 class="mt-3 text-center">Sign In</h2>
                        <p class="text-center"></p>
                        @if (Session::has('error'))
                            <div id="alert-msg" class="alert alert-danger">
                                <strong>{{ session('error') }}</strong>
                            </div>
                        @endif
                        <form method="POST" id="login-form" class="mt-4">
                            @csrf
                            <div class="row">
                                <div class="col-lg-12 {{ ($errors->has('phone')) ? 'has-error' : ''  }}">
                                    <div class="form-group">
                                        <label class="text-dark" for="phone">Phone</label>
                                        <input type="number" name="phone" id="phone" placeholder="Phone number" class="form-control" min="0" value="{{ old('phone') }}">
                                        @if ($errors->has('phone'))
                                            <strong class="has-error">{{ $errors->first('phone') }}</strong>
                                        @endif                                        
                                    </div>
                                </div>
                                <div class="col-lg-12 {{ ($errors->has('password')) ? 'has-error' : '' }}">
                                    <div class="form-group">
                                        <label class="text-dark" for="password">Password</label>
                                        <input type="password" name="password" id="password" placeholder="Password" class="form-control">
                                        @if ($errors->has('password'))
                                            <strong class="has-error">{{ $errors->first('password') }}</strong>
                                        @endif                                        
                                    </div>
                                </div>
                                <div class="col-lg-12 text-center">
                                    <button type="submit" class="btn btn-block btn-dark">Sign In</button>
                                </div>
                                <div class="col-lg-12 text-center mt-5">
                                    {{-- Don't have an account? <a href="#" class="text-danger">Sign Up</a> --}}
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script src="{{ asset('backend/assets/libs/jquery/dist/jquery.min.js')}}"></script>
    <!-- Bootstrap tether Core JavaScript -->
    <script src="{{ asset('backend/assets/libs/popper.js/dist/umd/popper.min.js')}}"></script>
    <script src="{{ asset('backend/assets/libs/bootstrap/dist/js/bootstrap.min.js')}}"></script>
    <script src="{{ asset('backend/jquery.validate.min.js') }}"></script>
    <script>
        $(".preloader ").fadeOut();
    </script>
    <script>
        $('#login-form').validate({
            rules: {
                phone: {required: true},
                password: {required: true}
            },
            messages: {
                phone: "Enter your phone number.",
                password: "Enter your password"
            },
            errorClass: "help-block",
            errorElement: "strong",
            onfocus:true,
            onblur:true,
            highlight:function(element){
                $(element).closest('.form-group').removeClass('has-success').addClass('has-error');
            },
            unhighlight:function(element){
                $(element).closest('.form-group').removeClass('has-error').addClass('has-success');
            },
            errorPlacement:function(error, element){
                if(element.parent('.input-group').length)
                {
                    error.insertAfter(element.parent());
                    return false;
                }
                else
                {
                    error.insertAfter(element);
                    return false;
                }
            }
        });

        window.setTimeout(function(){
            $('#alert-msg').slideUp(600).remove();
        }, 4000);
    </script>
</body>
</html>