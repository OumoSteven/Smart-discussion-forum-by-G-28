{{-- resources/views/lecturer/partials/sidebar.blade.php --}}
<div class="sidebar">
    <h2>Smart Discussion</h2>
    <span class="tagline">Forum · Lecturer Panel</span>

    <ul>
        <li class="{{ request()->routeIs('lecturer.dashboard') ? 'active' : '' }}">
            <a href="{{ route('lecturer.dashboard') }}"><i class="bi bi-speedometer2"></i> Dashboard</a>
        </li>
        <li class="{{ request()->routeIs('lecturer.participation-grading*') ? 'active' : '' }}">
            <a href="{{ route('lecturer.participation-grading') }}"><i class="bi bi-bar-chart"></i> Group Participation Grading</a>
        </li>
        <li class="{{ request()->routeIs('lecturer.quiz-management*') || request()->routeIs('lecturer.quiz.edit') ? 'active' : '' }}">
            <a href="{{ route('lecturer.quiz-management') }}"><i class="bi bi-clipboard-check"></i> Quiz Management</a>
        </li>
        <li class="{{ request()->routeIs('lecturer.notifications*') ? 'active' : '' }}">
            <a href="{{ route('lecturer.notifications') }}"><i class="bi bi-bell"></i> Notifications</a>
        </li>
        <li class="{{ request()->routeIs('lecturer.profile*') ? 'active' : '' }}">
            <a href="{{ route('lecturer.profile') }}"><i class="bi bi-person-circle"></i> Profile</a>
        </li>
        <li class="logout">
            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button type="submit"><i class="bi bi-box-arrow-right"></i> Logout</button>
            </form>
        </li>
    </ul>
</div>
