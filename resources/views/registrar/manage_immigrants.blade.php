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
                    <div class="col-md-12">
                        <div class="card">
                            <div class="card-body">
                                <h4 class="card-title">Manage Migrants</h4>
                                <div class="table-responsive">
                                    <table id="zero_config" class="table table-condensed display responsive nowrap table-striped table-bordered" style="width: 100%;" cellspacing="0">
                                        <thead>
                                            <tr>
                                                <th>S/N</th>
                                                <th>Surname</th>
                                                <th>Firstname</th>
                                                <th>Gender</th>
                                                <th>Country</th>
                                                <th>DOB</th>
                                                <th>Phone</th>
                                                <th>Occupation</th>
                                                <th>Identification</th>
                                                <th>Address</th>
                                                <th>Status</th>
                                                <th>Registered By</th>                      
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($immigrants as $immigrant)                                                
                                                <tr>
                                                    <td>{{ $loop->iteration }}.</td>
                                                    <td>{{ $immigrant->surname }}</td>
                                                    <td>{{ $immigrant->firstname }}</td>
                                                    <td>{{ $immigrant->gender }}</td>
                                                    <td>{{ $immigrant->country }}</td>
                                                    <td>{{ $immigrant->dob }}</td>
                                                    <td>{{ $immigrant->phone_no }}</td>
                                                    <td>{{ $immigrant->occupation }}</td>
                                                    <td>{{ $immigrant->identification }}</td>
                                                    <td>{{ $immigrant->address }}</td>
                                                    <td>{{ $immigrant->status }}</td>
                                                    <td>{{ $immigrant->registered_by }}</td>
                                                    <td>
                                                        <a href="javascript:void(0);" id="{{ $immigrant->id }}" class="delete btn btn-sm btn-danger" title="Delete"><i class="fa fa-trash"></i></a>
                                                        <a href="{{ url('registrar/immigrant/edit/'.$immigrant->id) }}" class="btn btn-sm btn-primary" title="Edit"><i class="fa fa-edit"></i></a>
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
    @include('registrar_layouts.scripts')
    <script>
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        window.setTimeout(function(){
            $('#alert-msg').slideUp(600).remove();
        }, 4000);
        
        // delete registrar handler
        $('body').on('click', '.delete', function(){
            let id = this.id;
            swal({
                title: "Are yout sure to delete ?",
                text: "This action is irreversible and the migrant's data will be lost.",
                icon: "warning",
                buttons: true,
                dangerMode: true
            }).then((willDelete) => {
                if(willDelete){

                    // send request
                    $.ajax({
                        type: "DELETE",
                        url: "{{ url('administrator/delete/immigrant') }}",
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