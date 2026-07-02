<nav class="sidebar">

    <div class="profile-card">
        <div class="profile-icon">
            <i class="fas fa-user-circle"></i>
        </div>

        <h3>{{ Auth::user()->name }}</h3>

        <p>Registration No:</p>
        <span>25/U/30750</span>

        <div class="user-role">
            Student
        </div>
    </div>

    <ul class="menu">
        
        <li>
            <a href="{{ route('dashboard') }}"
               class="{{ request()->routeIs('dashboard') ? 'active' : '' }}">
                HO_PLACEHOLDER Dashboard
            </a>
        </li>

        <li>
            <a href="{{ route('topics.index') }}"
               class="{{ request()->routeIs('topics.*') ? 'active' : '' }}">
                📚 Topics
            </a>
        </li>

        <li>
            <a href="{{ route('announcements.index') }}"
               class="{{ request()->routeIs('announcements.*') ? 'active' : '' }}">
                📢 Announcements
            </a>
        </li>

        <li>
            <a href="{{ route('messages.index') }}"
               class="{{ request()->routeIs('messages.*') ? 'active' : '' }}">
                💬 Messages
            </a>
        </li>

        <li>
            <a href="#">
                👥 Forum
            </a>
        </li>

        <li>
            <a href="{{ route('quizzes.index') }}"
               class="{{ request()->routeIs('quizzes.*') && !request()->routeIs('quizzes.history') ? 'active' : '' }}">
                📝 Quiz
            </a>
        </li>

        <li>
            <a href="{{ route('quizzes.history') }}"
               class="{{ request()->routeIs('quizzes.history') ? 'active' : '' }}">
                📊 Quiz History
            </a>
        </li>

        <hr>

        <li>
            <a href="{{ route('profile.edit') }}"
               class="{{ request()->routeIs('profile.*') ? 'active' : '' }}">
                ⚙ Settings
            </a>
        </li>

        <li>
            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button type="submit" class="logout-btn">
                    ⏻ Logout
                </button>
            </form>
        </li>
    </ul>

</nav>