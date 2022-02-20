<aside class="left-sidebar" data-sidebarbg="skin6">
    <!-- Sidebar scroll-->
    <div class="scroll-sidebar" data-sidebarbg="skin6">
        <!-- Sidebar navigation-->
        <nav class="sidebar-nav">
            <ul id="sidebarnav">
                <li class="sidebar-item"> <a class="sidebar-link sidebar-link" href="{{ url('registrar/home') }}" aria-expanded="false"><i data-feather="home" class="feather-icon"></i><span class="hide-menu">Dashboard</span></a></li>
                <li class="list-divider"></li>
                <li class="nav-small-cap"><span class="hide-menu">Migrants</span></li>
                <li class="sidebar-item"> <a class="sidebar-link" href="{{ url('registrar/register/immigrant') }}" aria-expanded="false"><i data-feather="user" class="feather-icon"></i><span class="hide-menu">Register Migrant</span></a>
                </li>     
                <li class="sidebar-item"> <a class="sidebar-link" href="{{ url('registrar/immigrants') }}" aria-expanded="false"><i data-feather="users" class="feather-icon"></i><span class="hide-menu">Manage Migrants</span></a>
                </li>
                <li class="list-divider"></li>                
                <li class="nav-small-cap"><span class="hide-menu">Reports</span></li>
                <li class="sidebar-item"> <a class="sidebar-link" href="{{ url('registrar/report/countries') }}" aria-expanded="false"><i data-feather="globe" class="feather-icon"></i><span class="hide-menu">Country Statistics</span></a>
                </li>
                <li class="sidebar-item"> <a class="sidebar-link" href="{{ url('registrar/report/print') }}" aria-expanded="false"><i data-feather="globe" class="feather-icon"></i><span class="hide-menu">Print Report</span></a>
                </li>
            </ul>
        </nav>
        <!-- End Sidebar navigation -->
    </div>
    <!-- End Sidebar scroll-->
</aside>