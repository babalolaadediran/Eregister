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
                    <div class="col-md-12">
                        <div class="card">
                            <div class="card-body">
                                <h4 class="card-title">
                                    @if (count($country_list))                                        
                                        <div class="card-options float-right">
                                            <a target="_blank" href="{{ url('administrator/print/overall/report') }}" class="btn btn-rounded btn-sm btn-primary">Print Report</a>
                                        </div>
                                    @endif
                                    Overall Country Statistics
                                </h4>
                                <hr>
                                <div class="table-responsive">
                                    <table id="zero_config" class="table table-condensed display responsive nowrap table-striped table-bordered" style="width: 100%;" cellspacing="0">
                                        <thead>
                                            <tr>
                                                <th>S/N</th>
                                                <th>Country</th>
                                                <th>Number Registered</th>
                                                <th>Regular</th>
                                                <th>Irregular</th>
                                                <th>Male</th>
                                                <th>Female</th>
                                                <th>Total</th>
                                            </tr>    
                                        </thead>
                                        <tbody>
                                            @foreach ($country_list as $country)                                                
                                                <tr>
                                                    <td>{{ $loop->iteration }}</td>
                                                    <td>{{ $country->country }}</td>
                                                    @php 
                                                        # registered immigrants
                                                        $registered_immigrants = App\Immigrant::where('country_id', $country->id)->count();

                                                        # regular
                                                        $regular = App\Immigrant::where('country_id', $country->id)->where('status', 'Regular')->count();

                                                        # irregular
                                                        $irregular = App\Immigrant::where('country_id', $country->id)->where('status', 'Irregular')->count();

                                                        # male
                                                        $male = App\Immigrant::where('country_id', $country->id)->where('gender', 'Male')->count();

                                                        # female
                                                        $female = App\Immigrant::where('country_id', $country->id)->where('gender', 'Female')->count();

                                                        # total
                                                        $total = App\Immigrant::where('country_id', $country->id)->count();
                                                    @endphp
                                                    <td>{{ number_format($registered_immigrants) }}</td>
                                                    <td>{{ number_format($regular) }}</td>
                                                    <td>{{ number_format($irregular) }}</td>
                                                    <td>{{ number_format($male) }}</td>
                                                    <td>{{ number_format($female) }}</td>
                                                    <td>{{ number_format($total) }}</td>                                                
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
</body>
</html>