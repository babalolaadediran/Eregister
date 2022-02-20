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
                    <div class="col-md-4">
                        <div class="card">
                            @if (empty($edit))                                
                                <div class="card-body">
                                    <div class="card-title">New Registrar</div>
                                    <hr>
                                    <form method="POST" id="registrar-form">
                                        @csrf
                                        <div class="form-group {{ ($errors->has('fullname')) ? 'has-error' : '' }}">
                                            <label for="fullname">Fullname</label>
                                            <input type="text" name="fullname" id="fullname" placeholder="Fullname" class="form-control" value="{{ old('fullname') }}">
                                            @if ($errors->has('fullname'))
                                                <strong class="help-block">{{ $errors->first('fullname') }}</strong>
                                            @endif
                                        </div>
                                        <div class="form-group {{ ($errors->has('gender')) ? 'has-error' : '' }}">
                                            <label for="gender">Gender</label>
                                            <select name="gender" id="gender" class="form-control">
                                                <option value="">--Select Gender--</option>
                                                <option value="Male" {{ (old('gender')) ? 'selected' : '' }}>Male</option>
                                                <option value="Female" {{ (old('gender')) ? 'selected' : '' }}>Female</option>
                                            </select>
                                            @if ($errors->has('gender'))
                                                <strong class="help-block">{{ $errors->first('gender') }}</strong>
                                            @endif
                                        </div>
                                        <div class="form-group {{ ($errors->has('phone')) ? 'has-error' : '' }}">
                                            <label for="phone">Phone Number</label>
                                            <input type="number" name="phone" id="phone" placeholder="XXXXXXXXXXX" class="form-control" value="{{ old('phone') }}" min="0">
                                            @if ($errors->has('phone'))
                                                <strong class="help-block">{{ $errors->first('phone') }}</strong>
                                            @endif
                                        </div>
                                        <div class="form-group {{ ($errors->has('password')) ? 'has-error' : '' }}">
                                            <label for="password">Default Password</label>
                                            <input type="number" name="password" id="password" placeholder="password" class="form-control" value="123456" readonly>
                                        </div>
                                        <div class="form-group">
                                            <button id="submit-btn" class="btn btn-sm btn-primary"><i class="fa fa-plus"></i> Save</button>
                                        </div>
                                    </form>
                                </div>
                            @else
                                <div class="card-body">
                                    <div class="card-title">Update Registrar</div>
                                    <hr>
                                    <form method="POST" id="registrar-form">
                                        @csrf
                                        <div class="form-group {{ ($errors->has('fullname')) ? 'has-error' : '' }}">
                                            <label for="fullname">Fullname</label>
                                            <input type="text" name="fullname" id="fullname" placeholder="Fullname" class="form-control" value="{{ $edit->fullname }}">
                                            @if ($errors->has('fullname'))
                                                <strong class="help-block">{{ $errors->first('fullname') }}</strong>
                                            @endif
                                        </div>
                                        <div class="form-group {{ ($errors->has('gender')) ? 'has-error' : '' }}">
                                            <label for="gender">Gender</label>
                                            <select name="gender" id="gender" class="form-control">
                                                <option value="">--Select Gender--</option>
                                                <option value="Male" {{ ($edit->gender) ? 'selected' : '' }}>Male</option>
                                                <option value="Female" {{ ($edit->gender) ? 'selected' : '' }}>Female</option>
                                            </select>
                                            @if ($errors->has('gender'))
                                                <strong class="help-block">{{ $errors->first('gender') }}</strong>
                                            @endif
                                        </div>
                                        <div class="form-group {{ ($errors->has('phone')) ? 'has-error' : '' }}">
                                            <label for="phone">Phone Number</label>
                                            <input type="number" name="phone" id="phone" placeholder="XXXXXXXXXXX" class="form-control" value="{{ $edit->phone }}" min="0">
                                            @if ($errors->has('phone'))
                                                <strong class="help-block">{{ $errors->first('phone') }}</strong>
                                            @endif
                                        </div>
                                        <div class="form-group">
                                            <button id="update-btn" class="btn btn-sm btn-primary"><i class="fa fa-plus"></i> Update</button>
                                        </div>
                                    </form>
                                </div>
                            @endif
                        </div>
                    </div>
                    <div class="col-md-8">
                        <div class="card">
                            <div class="card-body">
                                <h4 class="card-title">Manage Registrars</h4>
                                <div class="table-responsive">
                                    <table id="zero_config" class="table table-condensed display responsive nowrap table-striped table-bordered" style="width: 100%" cellspacing="0">
                                        <thead>
                                            <tr>
                                                <th>S/N</th>
                                                <th>Fullname</th>
                                                <th>Gender</th>
                                                <th>Phone</th>                                                
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($registrars as $registrar)                                                
                                                <tr>
                                                    <td>{{ $loop->iteration }}.</td>
                                                    <td>{{ $registrar->fullname }}</td>
                                                    <td>{{ $registrar->gender }}</td>
                                                    <td>{{ $registrar->phone }}</td>
                                                    <td>
                                                        <a href="javascript:void(0);" id="{{ $registrar->id }}" class="delete btn btn-sm btn-danger" title="Delete"><i class="fa fa-trash"></i></a>
                                                        <a href="{{ url('administrator/registrar/edit/'.$registrar->id) }}" class="btn btn-sm btn-primary" title="Edit"><i class="fa fa-edit"></i></a>
                                                    </td>                                                
                                                </tr>                                           
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </div>
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

        $('#registrar-form').validate({
            rules: {
                fullname: {required: true},
                gender: {required: true},
                phone: {
                    required: true,
                    minlength: 11,
                    maxlength: 14
                }
            },
            messages: {
                fullname: "Enter fullname.",
                gender: "Select gender.",
                phone: {
                    required: "Enter phone number.",
                    minlength: "Phone length can not be less than {0} digits.",
                    maxlength: "Phone length can not be more than {0} digits."
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
            }
        });

        window.setTimeout(function(){
            $('#alert-msg').slideUp(600).remove();
        }, 4000);

        // btn handler
        $('body').on('submit', '#registrar-form', function(){
            $('#submit-btn').prop('disabled', true);
            $('#submit-btn').html('Saving Record...');
            $('#update-btn').prop('disabled', true);
            $('#update-btn').html('Updating Record...');
        });
        
        // delete registrar handler
        $('body').on('click', '.delete', function(){
            let id = this.id;
            swal({
                title: "Are yout sure to delete ?",
                text: "This action is irreversible.",
                icon: "warning",
                buttons: true,
                dangerMode: true
            }).then((willDelete) => {
                if(willDelete){

                    // send request
                    $.ajax({
                        type: "DELETE",
                        url: "{{ url('administrator/delete/registrar') }}",
                        data:{id:id},
                        success:function(response) {
                            if(response.status == 200){
                                swal({
                                    title: "Success",
                                    text: response.message,
                                    icon: "success",
                                    buttons: false
                                });
                                window.setTimeout(function(){
                                    window.location.reload();
                                }, 4000);
                            }else{
                                swal({
                                    title: "Success",
                                    text: response.message,
                                    icon: "success",
                                    buttons: false
                                });
                                window.setTimeout(function(){
                                    window.location.reload();
                                }, 4000);
                            }
                        }
                    })
                }
            });
        });
    </script>
</body>
</html>