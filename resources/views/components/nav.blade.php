<nav>
    <div class="logo-name">
        <div class="logo-image">
            <img src="{{ asset('assets/images/logo.png') }}" alt="Company Logo">
        </div>

        <span class="logo_name">{{ env('APP_NAME') }}</span>
    </div>

    <div class="menu-items">
        <ul class="nav-links p-0">
            <li><a href="{{route('index')}}">
                    <i class="uil uil-estate"></i>
                    <span class="link-name">Dashboard</span>
                </a></li>
            <li><a href="{{route('manage_projects')}}">
                    <i class="uil uil-building"></i>
                    <span class="link-name">Projects</span>
                </a></li>
            <li><a href="{{route('mail')}}">
                    <i class="uil uil-envelope"></i>
                    <span class="link-name">Mail</span>
                </a></li>
            <li><a href="#">
                    <i class="uil uil-bell"></i>
                    <span class="link-name">Notifications</span>
                </a></li>
            <li><a href="{{route('manage_tasks')}}">
                    <i class="uil uil-calender"></i>
                    <span class="link-name">Plans</span>
                </a></li>
            <li><a href="#">
                    <i class="uil uil-users-alt"></i>
                    <span class="link-name">Users</span>
                </a></li>
        </ul>

        <ul class="logout-mode">
            <li><a href="#">
                    <i class="uil uil-signout"></i>
                    <span class="link-name">Logout</span>
                </a></li>
            <div class="mode-toggle">
                <span class="switch"></span>
            </div>
        </ul>
    </div>
</nav>
