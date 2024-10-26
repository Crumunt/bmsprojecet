<nav>
    <div class="logo-name">
        <div class="logo-image">
            <img src="{{ asset('assets/images/logo.png') }}" alt="Company Logo">
        </div>

        <span class="logo_name">{{ env('APP_NAME') }}</span>
    </div>

    <div class="menu-items">
        <ul class="nav-links p-0">
            <li><a href="#">
                    <i class="uil uil-estate"></i>
                    <span class="link-name">Dashboard</span>
                </a></li>
            <li><a href="#">
                    <i class="uil uil-files-landscapes"></i>
                    <span class="link-name">Content</span>
                </a></li>
            <li><a href="#">
                    <i class="uil uil-chart"></i>
                    <span class="link-name">Analytics</span>
                </a></li>
            <li><a href="#">
                    <i class="uil uil-thumbs-up"></i>
                    <span class="link-name">Like</span>
                </a></li>
            <li><a href="#">
                    <i class="uil uil-comments"></i>
                    <span class="link-name">Comment</span>
                </a></li>
            <li><a href="#">
                    <i class="uil uil-share"></i>
                    <span class="link-name">Share</span>
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
