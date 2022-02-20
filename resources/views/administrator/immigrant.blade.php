<!DOCTYPE html>
<html dir="ltr" lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <!-- Tell the browser to be responsive to screen width -->
    <meta name="viewport" content="width=device-width, initial-scale=1, user-scalable=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <!-- Favicon icon -->
    <link rel="icon" type="image/png" sizes="16x16" href="{{ asset('backend/assets/images/favicon.png') }}">
    <title>eRegister</title>
    @include('admin_layouts.styles')
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
        @include('admin_layouts.header')
        @include('admin_layouts.sidebar')
        <div class="page-wrapper">
            <div class="container-fluid">
                <div class="row">
                    @if (Session::has('success'))
                        <div id="alert-msg" class="col-md-12">
                            <div class="alert alert-success"><strong>{{ session('success') }}</strong></div>
                        </div>                        
                    @endif
                    @if (Session::has('error'))
                        <div id="alert-msg" class="col-md-12">
                            <div class="alert alert-danger"><strong>{{ session('error') }}</strong></div>
                        </div>
                    @endif
                    <div class="col-lg-12 col-md-12 col-sm-12">
                        <div class="card">
                            @if (empty($edit))                                
                                <div class="card-body">
                                    <div class="card-title">
                                        New Migrant
                                        <a href="{{ url('administrator/immigrants') }}" class="float-right btn btn-sm btn-rounded btn-primary">Manage Migrants</a>
                                    </div>
                                    <hr>
                                    <form method="POST" id="immigrant-form">
                                        @csrf
                                        <div class="row">
                                            <div class="form-group col-md-4 {{ ($errors->has('surname')) ? 'has-error' : '' }}">
                                                <label for="surname">Surname</label>
                                                <input type="text" name="surname" id="surname" placeholder="Surname" class="form-control" value="{{ old('surname') }}">
                                                @if ($errors->has('surname'))
                                                    <strong class="help-block">{{ $errors->first('surname') }}</strong>
                                                @endif
                                            </div>
                                            <div class="form-group col-md-4 {{ ($errors->has('firstname')) ? 'has-error' : '' }}">
                                                <label for="firstname">Firstname</label>
                                                <input type="text" name="firstname" id="firstname" placeholder="Firstname" class="form-control" value="{{ old('firstname') }}">
                                                @if ($errors->has('firstname'))
                                                    <strong class="help-block">{{ $errors->first('firstname') }}</strong>
                                                @endif
                                            </div>
                                            <div class="form-group col-md-4 {{ ($errors->has('country')) ? 'has-error' : '' }}">
                                                <label for="country">Country</label>
                                                <select name="country" id="country" class="form-control">
                                                    <option value="">--Select Country--</option>
                                                </select>
                                                @if ($errors->has('country'))
                                                    <strong class="help-block">{{ $errors->first('country') }}</strong>
                                                @endif
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="form-group col-md-4 {{ ($errors->has('gender')) ? 'has-error' : '' }}">
                                                <label for="gender">Gender</label>
                                                <select name="gender" id="gender" class="form-control">
                                                    <option value="">--Select Gender--</option>
                                                    <option value="Male" {{ (old('gender')) == 'Male' ? 'selected' : '' }}>Male</option>
                                                    <option value="Female" {{ (old('gender')) == 'Female' ? 'selected' : '' }}>Female</option>
                                                </select>
                                                @if ($errors->has('gender'))
                                                    <strong class="help-block">{{ $errors->first('gender') }}</strong>
                                                @endif
                                            </div>
                                            <div class="form-group col-md-4 {{ ($errors->has('dob')) ? 'has-error' : '' }}">
                                                <label for="dob">Date of Birth</label>
                                                <input type="text" name="dob" id="dob" placeholder="Date of Birth" class="datepicker form-control" value="{{ old('dob') }}">
                                                @if ($errors->has('dob'))
                                                    <strong class="help-block">{{ $errors->first('dob') }}</strong>
                                                @endif
                                            </div>
                                            <div class="form-group col-md-4 {{ ($errors->has('phone')) ? 'has-error' : '' }}">
                                                <label for="phone">Phone Number</label>
                                                <input type="number" name="phone" id="phone" placeholder="XXXXXXXXXXX" class="form-control" value="{{ old('phone') }}" min="0">
                                                @if ($errors->has('phone'))
                                                    <strong class="help-block">{{ $errors->first('phone') }}</strong>
                                                @endif
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="form-group col-md-4 {{ ($errors->has('occupation')) ? 'has-error' : '' }}">
                                                <label for="occupation">Occupation</label>
                                                <select name="occupation" id="occupation" class="form-control">
                                                    <option value="">--Select Occupation--</option>
                                                </select>
                                                @if ($errors->has('occupation'))
                                                    <strong class="help-block">{{ $errors->first('occupation') }}</strong>
                                                @endif
                                            </div>
                                            <div class="form-group col-md-4 {{ ($errors->has('identification')) ? 'has-error' : '' }}">
                                                <label for="identification">Means Of Identification</label>
                                                <select name="identification" id="identification" class="form-control">
                                                    <option value="">--Select Means Of Identification--</option>
                                                    <option value="Driver's Licence" {{ (old('identification')) == 'Driver\'s Licence' ? 'selected' : '' }}>Driver's Licence</option>
                                                    <option value="International Passport" {{ (old('identification')) == 'International Passport' ? 'selected' : '' }}>International Passport</option>
                                                    <option value="Voter's Card" {{ (old('identification')) == 'Voter\'s Card' ? 'selected' : '' }}>Voter's Card</option>
                                                    <option value="National Identity Card" {{ (old('identification')) == 'National Identity Card' ? 'selected' : '' }}>National Identity Card</option>
                                                    <option value="Student Identity Card" {{ (old('identification')) == 'Student Identity Card' ? 'selected' : '' }}>Student Identity Card</option>
                                                    <option value="Nil" {{ (old('identification')) == 'Nil"' ? 'selected' : '' }}>Nil</option>
                                                </select>                                                
                                                @if ($errors->has('identification'))
                                                    <strong class="help-block">{{ $errors->first('identification') }}</strong>
                                                @endif
                                            </div>
                                            <div class="form-group col-md-4 {{ ($errors->has('status')) ? 'has-error' : '' }}">
                                                <label for="status">Status</label>
                                                <select name="status" id="status" class="form-control">
                                                    <option value="">--Select Status--</option>
                                                    <option value="Regular" {{ (old('status')) == 'Regular' ? 'selected' : '' }}>Regular</option>
                                                    <option value="Irregular" {{ (old('status')) == 'Irregular' ? 'selected' : '' }}>Irregular</option>
                                                </select>
                                                @if ($errors->has('status'))
                                                    <strong class="help-block">{{ $errors->first('status') }}</strong>
                                                @endif
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="form-group col-md-12 {{ ($errors->has('address')) ? 'has-error' : '' }}">
                                                <label for="address">Address</label>
                                                <input type="text" name="address" id="address" placeholder="Address" class="form-control" value="{{ old('address') }}">
                                                @if ($errors->has('address'))
                                                    <strong class="help-block">{{ $errors->first('address') }}</strong>
                                                @endif
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="form-group col-md-4">
                                                <button id="submit-btn" class="btn btn-sm btn-primary"><i class="fa fa-plus"></i> Save</button>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            @else
                                <div class="card-body">
                                    <div class="card-title">
                                        Update Migrant
                                        <a href="{{ url('administrator/immigrants') }}" class="float-right btn btn-sm btn-rounded btn-primary">Manage Migrants</a>
                                    </div>
                                    <hr>
                                    <form method="POST" id="immigrant-form">
                                        @csrf
                                        <div class="row">
                                            <div class="form-group col-md-4 {{ ($errors->has('surname')) ? 'has-error' : '' }}">
                                                <label for="surname">Surname</label>
                                                <input type="text" name="surname" id="surname" placeholder="Surname" class="form-control" value="{{ $edit->surname }}">
                                                @if ($errors->has('surname'))
                                                    <strong class="help-block">{{ $errors->first('surname') }}</strong>
                                                @endif
                                            </div>
                                            <div class="form-group col-md-4 {{ ($errors->has('firstname')) ? 'has-error' : '' }}">
                                                <label for="firstname">Firstname</label>
                                                <input type="text" name="firstname" id="firstname" placeholder="Firstname" class="form-control" value="{{ $edit->firstname }}">
                                                @if ($errors->has('firstname'))
                                                    <strong class="help-block">{{ $errors->first('firstname') }}</strong>
                                                @endif
                                            </div>
                                            <div class="form-group col-md-4 {{ ($errors->has('country')) ? 'has-error' : '' }}">
                                                <label for="country">Country</label>
                                                <select name="country" id="country" class="form-control">
                                                    <option value="">--Select Country--</option>
                                                </select>
                                                @if ($errors->has('country'))
                                                    <strong class="help-block">{{ $errors->first('country') }}</strong>
                                                @endif
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="form-group col-md-4 {{ ($errors->has('gender')) ? 'has-error' : '' }}">
                                                <label for="gender">Gender</label>
                                                <select name="gender" id="gender" class="form-control">
                                                    <option value="">--Select Gender--</option>
                                                    <option value="Male" {{ ($edit->gender) == 'Male' ? 'selected' : '' }}>Male</option>
                                                    <option value="Female" {{ ($edit->gender) == 'Female' ? 'selected' : '' }}>Female</option>
                                                </select>
                                                @if ($errors->has('gender'))
                                                    <strong class="help-block">{{ $errors->first('gender') }}</strong>
                                                @endif
                                            </div>
                                            <div class="form-group col-md-4 {{ ($errors->has('dob')) ? 'has-error' : '' }}">
                                                <label for="dob">Date of Birth</label>
                                                <input type="text" name="dob" id="dob" placeholder="Date of Birth" class="datepicker form-control" value="{{ $edit->dob }}">
                                                @if ($errors->has('dob'))
                                                    <strong class="help-block">{{ $errors->first('dob') }}</strong>
                                                @endif
                                            </div>
                                            <div class="form-group col-md-4 {{ ($errors->has('phone')) ? 'has-error' : '' }}">
                                                <label for="phone">Phone Number</label>
                                                <input type="number" name="phone" id="phone" placeholder="XXXXXXXXXXX" class="form-control" value="{{ $edit->phone_no }}" min="0">
                                                @if ($errors->has('phone'))
                                                    <strong class="help-block">{{ $errors->first('phone') }}</strong>
                                                @endif
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="form-group col-md-4 {{ ($errors->has('occupation')) ? 'has-error' : '' }}">
                                                <label for="occupation">Occupation</label>
                                                <select name="occupation" id="occupation" class="form-control">
                                                    <option value="">--Select Occupation--</option>
                                                </select>
                                                @if ($errors->has('occupation'))
                                                    <strong class="help-block">{{ $errors->first('occupation') }}</strong>
                                                @endif
                                            </div>
                                            <div class="form-group col-md-4 {{ ($errors->has('identification')) ? 'has-error' : '' }}">
                                                <label for="identification">Means Of Identification</label>
                                                <select name="identification" id="identification" class="form-control">
                                                    <option value="">--Select Means Of Identification--</option>
                                                    <option value="Driver's Licence" {{ ($edit->identification) == 'Driver\'s Licence' ? 'selected' : '' }}>Driver's Licence</option>
                                                    <option value="International Passport" {{ ($edit->identification) == 'International Passport' ? 'selected' : '' }}>International Passport</option>
                                                    <option value="Voter's Card" {{ ($edit->identification) == 'Voter\'s Card' ? 'selected' : '' }}>Voter's Card</option>
                                                    <option value="National Identity Card" {{ ($edit->identification) == 'National Identity Card' ? 'selected' : '' }}>National Identity Card</option>
                                                    <option value="Student Identity Card" {{ ($edit->identification) == 'Student Identity Card' ? 'selected' : '' }}>Student Identity Card</option>
                                                    <option value="Nil" {{ ($edit->identification) == 'Nil"' ? 'selected' : '' }}>Nil</option>
                                                </select>         
                                                @if ($errors->has('identification'))
                                                    <strong class="help-block">{{ $errors->first('identification') }}</strong>
                                                @endif
                                            </div>
                                            <div class="form-group col-md-4 {{ ($errors->has('status')) ? 'has-error' : '' }}">
                                                <label for="status">Status</label>
                                                <select name="status" id="status" class="form-control">
                                                    <option value="">--Select Status--</option>
                                                    <option value="Regular" {{ ($edit->status) == 'Regular' ? 'selected' : '' }}>Regular</option>
                                                    <option value="Irregular" {{ ($edit->status) == 'Irregular' ? 'selected' : '' }}>Irregular</option>
                                                </select>
                                                @if ($errors->has('status'))
                                                    <strong class="help-block">{{ $errors->first('status') }}</strong>
                                                @endif
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="form-group col-md-12 {{ ($errors->has('address')) ? 'has-error' : '' }}">
                                                <label for="address">Address</label>
                                                <input type="text" name="address" id="address" placeholder="Address" class="form-control" value="{{ $edit->address }}">
                                                @if ($errors->has('address'))
                                                    <strong class="help-block">{{ $errors->first('address') }}</strong>
                                                @endif
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="form-group col-md-4">
                                                <button id="update-btn" class="btn btn-sm btn-primary"><i class="fa fa-plus"></i> Update</button>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            @endif
                        </div>
                    </div>                    
                </div>
            </div>
        </div>
    </div>
    @include('admin_layouts.scripts')
    <script>
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        // immigrant form
        $('#immigrant-form').validate({
            rules: {
                surname: {required: true},
                firstname: {required: true},
                country: {required: true},
                gender: {required: true},
                dob: {required: true},                
                phone: {
                    required: true,
                    minlength: 11,
                    maxlength: 14
                },
                occupation: {required: true},
                identification: {required: true},
                status: {required: true},
                address: {required: true}
            },
            messages: {
                surname: "Enter surname.",
                firstname: "Enter firstname.",
                country: "Select country.",
                gender: "Select gender.",
                dob: "Enter date of birth.",
                phone: {
                    required: "Enter phone number.",
                    minlength: "Phone length can not be less than {0} digits.",
                    maxlength: "Phone length can not be more than {0} digits."
                },
                occupation: "Enter occupation.",
                identification: "Enter means of Identification.",
                status: "Select status",
                address: "Enter address"
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
        
        // load all countries
        window.addEventListener('load', function(){
            // send request
            $.ajax({
                type: "GET",
                url: "{{ url('fetch/all/countries') }}",
                success: function(response) {
                    $("#country").empty();
                    $("#country").append(response);
                }
            })
        });

        // load all occpations
        window.addEventListener('load', function(){
            // send request
            $.ajax({
                type: "GET",
                url: "{{ url('fetch/all/occupations') }}",
                success: function(response) {
                    $("#occupation").empty();
                    $("#occupation").append(response);
                }
            })
        });

        // btn handler
        $('body').on('submit', '#immigrant-form', function(){
            $('#submit-btn').prop('disabled', true);
            $('#submit-btn').html('Saving Record...');
            $('#update-btn').prop('disabled', true);
            $('#update-btn').html('Updating Record...');
        });

        // get and select old country
        @if(old('country'))
            window.addEventListener('load', function(){
                // send request
                $.ajax({
                    type: "GET",
                    url: "{{ url('fetch/all/countries') }}",
                    success: function(response) {
                        $("#country").empty();
                        $("#country").append(response);
                        $("#country").val("{{ old('country') }}").prop('selected', true);
                    }
                })
            });
        @endif

        // get and select old occupation
        @if(old('occupation'))
            window.addEventListener('load', function(){
                // send request
                $.ajax({
                    type: "GET",
                    url: "{{ url('fetch/all/occupations') }}",
                    success: function(response) {
                        $("#occupation").empty();
                        $("#occupation").append(response);
                        $("#occupation").val("{{ old('occupation') }}").prop('selected', true);
                    }
                })
            });
        @endif
        
        // get and select occupation and country
        @if(!empty($edit))
            window.addEventListener('load', function(){
                // send request
                $.ajax({
                    type: "GET",
                    url: "{{ url('fetch/all/countries') }}",
                    success: function(response) {
                        $("#country").empty();
                        $("#country").append(response);
                        $("#country").val("{{ $edit->country_id }}").prop('selected', true);
                    }
                })
            });

            window.addEventListener('load', function(){
                // send request
                $.ajax({
                    type: "GET",
                    url: "{{ url('fetch/all/occupations') }}",
                    success: function(response) {
                        $("#occupation").empty();
                        $("#occupation").append(response);
                        $("#occupation").val("{{ $edit->occupation }}").prop('selected', true);
                    }
                })
            });
        @endif
    </script>
</body>
</html>