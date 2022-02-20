<header class="topbar" data-navbarbg="skin6">
    <nav class="navbar top-navbar navbar-expand-md">
        <div class="navbar-header" data-logobg="skin6">
            <!-- This is for the sidebar toggle which is visible on mobile only -->
            <a class="nav-toggler waves-effect waves-light d-block d-md-none" href="javascript:void(0)"><i
                    class="ti-menu ti-close"></i></a>
            <div class="navbar-brand">
                <!-- Logo icon -->
                <a href="{{ url('administrator/home') }}">
                    <b class="logo-icon">
                        <img src="{{ asset('nis-logo.png') }}" style="height: 70px;" style="width: 70px;" alt="homepage" class="rounded-circle dark-logo" />
                    </b>
                    <!--End Logo icon -->
                    <!-- Logo text -->
                    <span style="color: black;" class="logo-text">
                        eRegister                        
                    </span>
                </a>
            </div>
            <a class="topbartoggler d-block d-md-none waves-effect waves-light" href="javascript:void(0)"
                data-toggle="collapse" data-target="#navbarSupportedContent"
                aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation"><i
                    class="ti-more"></i></a>
        </div>
        <div class="navbar-collapse collapse" id="navbarSupportedContent">
            <ul class="navbar-nav float-left mr-auto ml-3 pl-1">

            </ul>
            <ul class="navbar-nav float-right">
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="javascript:void(0)" data-toggle="dropdown"
                        aria-haspopup="true" aria-expanded="false">
                        <img src="{{ asset('nis-logo.png') }}" alt="user" class="rounded-circle"
                            width="40">
                        <span class="ml-2 d-none d-lg-inline-block"><span>Hello,</span> <span class="text-dark">{{ $admin->fullname }}</span> <i data-feather="chevron-down" class="svg-icon"></i></span>
                    </a>
                    <div class="dropdown-menu dropdown-menu-right user-dd animated flipInY">
                        <a class="dropdown-item" href="{{ url('administrator/profile') }}"><i data-feather="user" class="svg-icon mr-2 ml-1"></i> My Profile</a>                        
                        <div class="dropdown-divider"></div>
                        <a class="dropdown-item" id="logout-link" href="javascript:void(0);"><i data-feather="power" class="svg-icon mr-2 ml-1"></i> Logout</a>
                        <form method="GET" id="logout-form" action="{{ url('administrator/logout') }}">@csrf</form>
                    </div>
                </li>
            </ul>
        </div>
    </nav>
</header>