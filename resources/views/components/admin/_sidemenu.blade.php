<div id="sidebar-menu">
    <!-- Left Menu Start -->
    <ul class="metismenu list-unstyled" id="side-menu">
        <li class="menu-title">Menu</li>

        <li>
            <a href="{{ route('dashboard') }}" class="waves-effect">
                <i class="ri-dashboard-line"></i><span class="float-right badge badge-pill badge-success">3</span>
                <span>Dashboard</span>
            </a>
        </li>

        <li>
            <a href="{{ route('me') }}" class=" waves-effect">
                <i class="ri-booklet-line"></i>
                <span>Post</span>
            </a>
        </li>

        <li class="">
            <a href="javascript: void(0);" class="has-arrow waves-effect">
                <i class="ri-layout-3-line"></i>
                <span>Layouts</span>
            </a>
            <ul class="sub-menu" aria-expanded="false">
                <li><a href="layouts-horizontal.html">Horizontal</a></li>
                <li><a href="layouts-light-sidebar.html">Light Sidebar</a></li>
                <li><a href="layouts-compact-sidebar.html">Compact Sidebar</a></li>
                <li><a href="layouts-icon-sidebar.html">Icon Sidebar</a></li>
            </ul>
        </li>

        <li class="menu-title">Pages</li>

        <li class="">
            <a href="javascript: void(0);" class="has-arrow waves-effect">
                <i class="ri-account-circle-line"></i>
                <span>Authentication</span>
            </a>
            <ul class="sub-menu" aria-expanded="false">
                <li><a href="auth-login.html">Login</a></li>
                <li><a href="auth-register.html">Register</a></li>
            </ul>
        </li>

    </ul>
</div>
