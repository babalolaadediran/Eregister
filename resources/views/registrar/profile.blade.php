<!DOCTYPE html>
<html dir="ltr" lang="en">
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
    @include('registrar_layouts.styles')
    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
    <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
<![endif]-->
</head>
<body>
    <div class="preloader">
        <div class="lds-ripple">
            <div class="lds-pos"></div>
            <div class="lds-pos"></div>
        </div>
    </div>
    <div id="main-wrapper" data-theme="light" data-layout="vertical" data-navbarbg="skin6" data-sidebartype="full"
        data-sidebar-position="fixed" data-header-position="fixed" data-boxed-layout="full">
        @include('registrar_layouts.header')
        @include('registrar_layouts.sidebar')
        <div class="page-wrapper">
            <div class="page-breadcrumb">
                <div class="row">
                    <div class="col-7 align-self-center">
                        <h3 class="page-title text-truncate text-dark font-weight-medium mb-1"><span id="greeting"></span> {{ $registrar->fullname }}!</h3>
                        <div class="d-flex align-items-center">
                            <nav aria-label="breadcrumb">
                                <ol class="breadcrumb m-0 p-0">
                                    <li class="breadcrumb-item"><a href="{{ url('registrar/home') }}">Dashboard</a>
                                    </li>
                                </ol>
                            </nav>
                        </div>
                    </div>
                </div>
            </div>
            <div class="container-fluid">
                <div class="row">
                    @if(Session::has('success'))
                        <div id="alert-msg" class="col-md-12">
                            <div class="alert alert-success">
                                <strong>{{ session('success') }}</strong>
                            </div>
                        </div>
                    @endif
                    @if(Session::has('error'))
                        <div id="alert-msg" class="col-md-12">
                            <div class="alert alert-danger">
                                <strong>{{ session('error') }}</strong>
                            </div>
                        </div>
                    @endif
                    <div class="col-md-6">
                        <div class="card">
                            <div class="card-body">
                                <div class="card-title">Profile</div>
                                <hr>
                                <form action="{{ url('registrar/update/profile') }}" method="POST" id="update-profile" novalidate>
                                    @csrf
                                    <div class="form-group {{ ($errors->has('fullname')) ? 'has-error' : '' }}">
                                        <label for="fullname">Fullname</label>
                                        <input type="text" name="fullname" id="fullname" placeholder="Fullname" class="form-control" value="{{ $registrar->fullname }}">
                                        @if ($errors->has('fullname'))
                                            <strong class="help-block">{{ $errors->first('fullname') }}</strong>
                                        @endif
                                    </div>
                                    <div class="form-group {{ ($errors->has('gender')) ? 'has-error' : '' }}">
                                        <label for="gender">Gender</label>
                                        <select name="gender" id="gender" class="form-control">
                                            <option value="">--Select Gender--</option>
                                            <option value="Male" {{ ($registrar->gender) == 'Male' ? 'selected' : '' }}>Male</option>
                                            <option value="Female" {{ ($registrar->gender) == 'Female' ? 'selected' : '' }}>Female</option>
                                        </select>                                        
                                        @if ($errors->has('gender'))
                                            <strong class="help-block">{{ $errors->first('gender') }}</strong>
                                        @endif
                                    </div>
                                    <div class="form-group {{ ($errors->has('phone')) ? 'has-error' : '' }}">
                                        <label for="phone">Phone</label>
                                        <input type="number" name="phone" id="phone" placeholder="XXXXXXXXXXX" class="form-control" min="0" value="{{ $registrar->phone }}">
                                        @if ($errors->has('phone'))
                                            <strong class="help-block">{{ $errors->first('phone') }}</strong>
                                        @endif
                                    </div>
                                    <div class="form-group">
                                        <button id="update-profile-btn" class="btn btn-primary">Submit</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="card">
                            <div class="card-body">
                                <div class="card-title">Change Password</div>
                                <hr>
                                <form action="{{ url('registrar/update/password') }}" method="POST" id="update-password" novalidate>
                                    @csrf
                                    <div class="form-group {{ ($errors->has('old_password')) ? 'has-error' : '' }}">
                                        <label for="old_password">Old Password</label>
                                        <input type="password" name="old_password" id="old_password" placeholder="Old Password" class="form-control">
                                        @if ($errors->has('old_password'))
                                            <strong class="help-block">{{ $errors->first('old_password') }}</strong>
                                        @endif
                                    </div>
                                    <div class="form-group {{ ($errors->has('new_password')) ? 'has-error' : '' }}">
                                        <label for="new_password">New Password</label>
                                        <input type="password" name="new_password" id="new_password" placeholder="New Password" class="form-control">
                                        @if ($errors->has('new_password'))
                                            <strong class="help-block">{{ $errors->first('new_password') }}</strong>
                                        @endif
                                    </div>
                                    <div class="form-group">
                                        <label for="retype_password">Retype Password</label>
                                        <input type="password" name="retype_password" id="retype_password" placeholder="Retype Password" class="form-control">
                                    </div>
                                    <div class="form-group">
                                        <button id="update-password-btn" class="btn btn-primary">Change Password</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @include('registrar_layouts.scripts')
    <script>

        // udpate profile
        $('#update-profile').validate({
            rules: {
                fullname: {required: true},
                email: {required: true},
                phone: {
                    required: true,
                    minlength: 11,
                    maxlength: 14
                }
            },
            messages: {
                fullname: "The fullname field is required.",
                email: "Email is required.",
                phone: {
                    required: "Phone number is required.",
                    minlength: "Phone number can not be less than {0} digits.",
                    maxlength: "Phone number can not be more than {0} digits."
                }
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
            },
        });

        // update password
        $('#update-password').validate({
            rules: {
                old_password: {required:true},
                new_password: {
                    required:true,
                    minlength: 6
                },
                retype_password: {
                    minlength: 6,
                    equalTo: "#new_password"
                }
            },
            messages: {
                old_password: "Enter your old password.",
                new_password: {
                    required: "Enter your new password.",
                    minlength: "Minimum of {0} characters."
                },
                retype_password: "Password does not match."
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
            },
        });

        $('body').on('submit', '#update-profile', function(){
            $('#update-profile-btn').prop('disabled', true);
            $('#update-profile-btn').html('Updating Profile...');
        });

        $('body').on('submit', '#update-password', function(){
            $('#update-password-btn').prop('disabled', true);
            $('#update-password-btn').html('Updating Password...');
        });

        window.setTimeout(function(){
            $('#alert-msg').slideUp(600).remove();
        }, 4000);
    </script>
</body>
</html>