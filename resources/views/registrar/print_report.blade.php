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
            <div class="container-fluid">
                <div class="row">
                    @if (Session::has('error'))                        
                        <div id="alert-msg" class="col-md-12">
                            <div class="alert alert-danger">
                                <strong>{{ session('error') }}</strong>
                            </div>
                        </div>
                    @endif
                    <div class="col-md-12">
                        <div class="card">
                            <div class="card-body">
                                <h4 class="card-title">Daily/Weekly Report</h4>
                                <hr>
                                <form method="POST" target="_blank" action="{{ url('registrar/report/printing') }}" id="print-form" novalidate>
                                    @csrf
                                    <div class="row">
                                        <div class="form-group col-md-4 {{ ($errors->has('from')) ? 'has-error' : '' }}">
                                            <label for="from">From</label>
                                            <select name="from" id="from" class="form-control">
                                                <option value="">--Select Date--</option>
                                                @foreach ($dates as $date)                                                
                                                    <option value="{{ $date }}" {{ (old('from')) == $date ? 'selected' : '' }}>{{ $date }}</option>
                                                @endforeach
                                            </select>
                                            @if ($errors->has('from'))
                                                <strong class="help-block">{{ $errors->first('from') }}</strong>
                                            @endif
                                        </div>
                                        <div class="form-group col-md-4 {{ ($errors->has('to')) ? 'has-error' : '' }}">
                                            <label for="to">From</label>
                                            <select name="to" id="to" class="form-control">
                                                <option value="">--Select Date--</option>
                                                @foreach ($dates as $date)                                                
                                                    <option value="{{ $date }}" {{ (old('to')) == $date ? 'selected' : '' }}>{{ $date }}</option>
                                                @endforeach
                                            </select>
                                            @if ($errors->has('to'))
                                                <strong class="help-block">{{ $errors->first('to') }}</strong>
                                            @endif
                                        </div>
                                        <div class="form-group col-md-4" style="margin-top: 32px;">                                            
                                            <button class="btn btn-primary">Print</button>
                                        </div>
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
        $('#print-form').validate({
            rules: {
                from: {required: true},
                to: {
                    required: function(element) {
                        return $('#to').val() != ''; 
                    }
                }                
            },
            messages: {
                from: "The beginnig date is required.",  
                to: "The end date is required."              
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

        window.setTimeout(function(){
            $('#alert-msg').slideUp(600).remove();
        }, 4000);
    </script>
</body>
</html>