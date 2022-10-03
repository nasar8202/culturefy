<ul class="menu">
    <li class="sidebar-title">Menu</li>

    <li class="sidebar-item active ">
        <a href="index.html" class='sidebar-link'>
            <i class="bi bi-grid-fill"></i>
            <span>Dashboard</span>
        </a>
    </li>

    <li class="sidebar-item  has-sub">
        <a href="#" class='sidebar-link'>
            <i class="bi bi-stack"></i>
            <span>Manage Users</span>
        </a>
        <ul class="submenu ">
            <li class="submenu-item ">
                {{-- <a href="{{ route('superadmin.RoleForm') }}">Add Role</a> --}}
            </li>
            <li class="submenu-item ">
                <a href="component-badge.html">Badge</a>
            </li>

        </ul>
    </li>

    <li class="sidebar-item  ">
        <a href="{{route('logout')}}" class='sidebar-link'>
            <div class="icon dripicons-exit"></div>
            <span>Logout</span>
        </a>
    </li>

</ul>
