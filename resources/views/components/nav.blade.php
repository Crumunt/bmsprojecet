<nav>
    <div class="logo-name">
        <div class="logo-image">
            <img src="{{ asset('assets/images/logo.png') }}" alt="Company Logo">
        </div>

        <span class="logo_name">{{ env('APP_NAME') }}</span>
    </div>

    <div class="menu-items">
        <ul class="nav-links p-0">
            <li>
                <a href="{{ route('dashboard') }}" class={{ active_route('dashboard') }}>
                    <i class="uil uil-estate"></i>
                    <span class="link-name">Dashboard</span>
                </a>
            </li>
            <li>
                <a href="{{ route('manage_projects') }}" class={{ active_route('manage_projects') }}>
                    <i class="uil uil-building"></i>
                    <span class="link-name">Projects</span>
                </a>
            </li>
            <li>
                <a href="{{ route('manage_tasks') }}" class="{{ active_route('manage_tasks') }}">
                    <i class="uil uil-calender"></i>
                    <span class="link-name">Plans</span>
                </a>
            </li>
            @if (session('user_role') !== 'sub-admin')
                <li>
                    <a href="{{ route('users') }}" class="{{ active_route('users') }}">
                        <i class="uil uil-users-alt"></i>
                        <span class="link-name">Users</span>
                    </a>
                </li>
            @endif
        </ul>

        <ul class="logout-mode">
            <li><a href="#" data-bs-target="#logoutModal" data-bs-toggle="modal">
                    <i class="uil uil-signout"></i>
                    <span class="link-name">Logout</span>
                </a></li>
            <div class="mode-toggle">
                <span class="switch"></span>
            </div>
        </ul>
    </div>
</nav>
