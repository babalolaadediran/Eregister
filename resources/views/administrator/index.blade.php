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
            <div class="page-breadcrumb">
                <div class="row">
                    <div class="col-7 align-self-center">
                        <h3 class="page-title text-truncate text-dark font-weight-medium mb-1"><span id="greeting"></span> {{ $admin->fullname }}!</h3>
                        <div class="d-flex align-items-center">
                            <nav aria-label="breadcrumb">
                                <ol class="breadcrumb m-0 p-0">
                                    <li class="breadcrumb-item"><a href="{{ url('administrator/home') }}">Dashboard</a>
                                    </li>
                                </ol>
                            </nav>
                        </div>
                    </div>
                </div>
            </div>
            <div class="container-fluid">
                <div class="card-group">
                    <div class="card border-right">
                        <div class="card-body">
                            <div class="d-flex d-lg-flex d-md-block align-items-center">
                                <div>
                                    <div class="d-inline-flex align-items-center">
                                        <h2 class="text-dark mb-1 font-weight-medium">{{ number_format($male_immigrant) }}</h2>
                                    </div>
                                    <h6 class="text-muted font-weight-normal mb-0 w-100 text-truncate">Male Migrants</h6>
                                </div>
                                <div class="ml-auto mt-md-3 mt-lg-0">
                                    <span class="opacity-7 text-muted"><i data-feather="users"></i></span>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card border-right">
                        <div class="card-body">
                            <div class="d-flex d-lg-flex d-md-block align-items-center">
                                <div>
                                    <div class="d-inline-flex align-items-center">
                                        <h2 class="text-dark mb-1 font-weight-medium">{{ number_format($female_immigrant) }}</h2>
                                    </div>
                                    <h6 class="text-muted font-weight-normal mb-0 w-100 text-truncate">Female Migrants</h6>
                                </div>
                                <div class="ml-auto mt-md-3 mt-lg-0">
                                    <span class="opacity-7 text-muted"><i data-feather="users"></i></span>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card border-right">
                        <div class="card-body">
                            <div class="d-flex d-lg-flex d-md-block align-items-center">
                                <div>
                                    <div class="d-inline-flex align-items-center">
                                        <h2 class="text-dark mb-1 font-weight-medium">{{ number_format($registrar_count) }}</h2>
                                    </div>
                                    <h6 class="text-muted font-weight-normal mb-0 w-100 text-truncate">Registrars</h6>
                                </div>
                                <div class="ml-auto mt-md-3 mt-lg-0">
                                    <span class="opacity-7 text-muted"><i data-feather="file-plus"></i></span>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card">
                        <div class="card-body">
                            <div class="d-flex d-lg-flex d-md-block align-items-center">
                                <div>
                                    <h2 class="text-dark mb-1 font-weight-medium">{{ number_format($countries) }}</h2>
                                    <h6 class="text-muted font-weight-normal mb-0 w-100 text-truncate">Countries</h6>
                                </div>
                                <div class="ml-auto mt-md-3 mt-lg-0">
                                    <span class="opacity-7 text-muted"><i data-feather="globe"></i></span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-4 col-md-12">
                        <div class="card">
                            <div class="card-body">
                                <h4 class="card-title">Age Distribution</h4>
                                <div id="campaign-v2" class="mt-2" style="height:283px; width:100%;"></div>
                                <ul class="list-style-none mb-0">
                                    <li>
                                        <i class="fas fa-circle text-primary font-10 mr-2"></i>
                                        <span class="text-muted">0 - 18</span>
                                        <span class="text-dark float-right font-weight-medium">{{ count($teens) }}</span>
                                    </li>
                                    <li class="mt-3">
                                        <i class="fas fa-circle text-danger font-10 mr-2"></i>
                                        <span class="text-muted">18 - 40</span>
                                        <span class="text-dark float-right font-weight-medium">{{ count($youths) }}</span>
                                    </li>
                                    <li class="mt-3">
                                        <i class="fas fa-circle text-cyan font-10 mr-2"></i>
                                        <span class="text-muted">40 and Above</span>
                                        <span class="text-dark float-right font-weight-medium">{{ count($adults) }}</span>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-8 col-md-12">
                        <div class="card">
                            <div class="card-body">
                                <h4 class="card-title">Migrant Registration</h4>
                                <div class="net-income mt-4 position-relative" style="height:294px;"></div>
                                <ul class="list-inline text-center mt-5 mb-2">
                                    <li class="list-inline-item text-muted font-italic">Migrant Monthly Registration Statistics</li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @include('admin_layouts.scripts')
    <script>
        $(function() {

            // age distribution chart
            var chart1 = c3.generate({
                bindto: '#campaign-v2',
                data: {
                    columns: [
                        ['Teens', @php echo count($teens); @endphp ],
                        ['Youths', @php echo count($youths); @endphp ],
                        ['Adults', @php echo count($adults); @endphp ]
                    ],

                    type: 'pie',
                    tooltip: {
                        show: true
                    }
                },
                pie: {
                    label: {
                        show: true
                    },
                    title: 'Immigrants Ages',
                    width: 18
                },

                legend: {
                    hide: true
                },
                color: {
                    pattern: [
                        '#5f76e8',
                        '#ff4f70',
                        '#01caf1'
                    ]
                }
            });

            d3.select('#campaign-v2 .c3-chart-arcs-title').style('font-family', 'Rubik');

            // monthly registration stats
            var data = {
                labels: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec'],
                series: [
                    @php

                        $months = ['01', '02', '03', '04', '05', '06', '07', '08', '09', '10', '11', '12'];
                        $stat = [];
                        foreach($months as $month) {

                            $test = App\Immigrant::whereMonth('created_at', '=', date($month))->whereYear('created_at', '=', date('Y'))->count();
                            array_push($stat, $test);
                        }

                    @endphp
                    [
                        @php
                            foreach($stat as $stat_data){
                                echo $stat_data.',';
                            }
                        @endphp
                    ]
                ]
            };

            var options = {
                axisX: {
                    showGrid: false
                },
                seriesBarDistance: 1,
                chartPadding: {
                    top: 15,
                    right: 15,
                    bottom: 5,
                    left: 0
                },
                plugins: [
                    Chartist.plugins.tooltip()
                ],
                width: '100%'
            };

            var responsiveOptions = [
                ['screen and (max-width: 640px)', {
                    seriesBarDistance: 5,
                    axisX: {
                        labelInterpolationFnc: function (value) {
                            return value[0];
                        }
                    }
                }]
            ];
            new Chartist.Bar('.net-income', data, options, responsiveOptions);
        });
    </script>
</body>
</html>
