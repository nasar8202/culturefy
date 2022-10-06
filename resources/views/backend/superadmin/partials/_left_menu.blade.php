<ul class="menu">
    <li class="sidebar-title">Menus</li>

    <li class="sidebar-item active ">
        <a href="{{ route('dashboard') }}" class='sidebar-link'>
            <i class="bi bi-grid-fill"></i>
            <span>Dashboard</span>
        </a>
    </li>

    <li class="sidebar-item  has-sub">
        <a href="#" class='sidebar-link'>
            <i class="bi bi-stack"></i>
            <span>Manage Roles</span>
        </a>
        <ul class="submenu ">
            <li class="submenu-item ">
                <a href="{{ route('RoleForm') }}">Add Role</a>
            </li>
            <li class="submenu-item ">
                <a href="{{ route('ViewRole') }}">View Role</a>
            </li>

        </ul>
    </li>
    <li class="sidebar-item  has-sub">
        <a href="#" class='sidebar-link'>
            <i class="bi bi-stack"></i>
            <span>Manage Categories</span>
        </a>
        <ul class="submenu ">

            <li class="submenu-item ">
                <a href="{{ route('subCategoryForm') }}">Add  Category</a>
            </li>
            <li class="submenu-item ">
                <a href="{{ route('viewCategories') }}">View Category</a>
            </li>

        </ul>
    </li>

    <li class="sidebar-item  has-sub">
        <a href="#" class='sidebar-link'>
            <i class="bi bi-stack"></i>
            <span>Manage Questions</span>
        </a>
        <ul class="submenu ">
            <li class="submenu-item ">
                <a href="{{ route('questionForm') }}">Add Question</a>
            </li>
            <li class="submenu-item ">
                <a href="{{ route('viewQuestions') }}">View Questions</a>
            </li>
           

        </ul>
    </li>

    <li class="sidebar-item  has-sub">
        <a href="#" class='sidebar-link'>
            <i class="bi bi-stack"></i>
            <span>Manage Answers</span>
        </a>
        <ul class="submenu ">
            <li class="submenu-item ">
                <a href="{{ route('answerForm') }}">Add Answer</a>
            </li>
            <li class="submenu-item ">
                <a href="{{ route('viewAnswer') }}">View Answers</a>
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
