<div class="top">
    <!-- Sidebar Toggle -->
    @if (Route::currentRouteName() !== 'contractor')
        <i class="uil uil-bars sidebar-toggle"></i>
    @endif


    <!-- Notification and Profile -->
    <div class="notification-profile">
        {{-- <div class="notification" onclick="toggleNotifications()">
            <i class="uil uil-bell"><span class="badge bg-danger rounded-pill">3</span></i> <!-- Notification icon -->
        </div> --}}
        {{-- <img src="{{ asset('assets/images/avatar1.jpg') }}" alt="Profile Picture" class="profile-image"> --}}
    </div>

    <!-- Notification Dropdown -->
    <div class="notification-dropdown" id="notificationDropdown">
        <div class="notif-header">
            <h4>Inbox</h4>
            <a href="#" class="mark-all-read">Mark All Read</a>
        </div>
        <ul class="notif-list">
            <li class="notif-item">
                <img src="user-avatar.png" alt="User Avatar" class="user-avatar">
                <div class="notif-details">
                    <p>Mary shared the file <a href="#">Isometric 2.0</a> with you</p>
                    <span>3 hours ago - Craftwork Design</span>
                </div>
                <div class="notif-actions">
                    <button class="decline-btn">Decline</button>
                    <button class="accept-btn">Accept</button>
                </div>
            </li>
        </ul>
    </div>
</div>
