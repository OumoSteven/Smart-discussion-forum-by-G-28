<!-- <nav x-data="{ open: false }" > -->
    <!-- Primary Navigation Menu -->
    <!-- <div>
        <div >
            <div > -->
                <!-- Logo -->
                <!-- <div>
                    <a href="{{ route('dashboard') }}">
                        <x-application-logo />
                    </a>
                </div> -->

                <!-- Navigation Links -->
                <!-- <div >
                    <x-nav-link :href="route('dashboard')" :active="request()->routeIs('dashboard')">
                        {{ __('Dashboard') }}
                    </x-nav-link>
                </div>
            </div> -->

            <!-- Settings Dropdown -->
            <!-- <div >
                <x-dropdown align="right" width="48">
                    <x-slot name="trigger">
                        <button >
                            <div>{{ Auth::user()->name }}</div>

                            <div class="ms-1">
                                <svg class="fill-current h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" />
                                </svg>
                            </div>
                        </button>
                    </x-slot>

                    <x-slot name="content">
                        <x-dropdown-link :href="route('profile.edit')">
                            {{ __('Profile') }}
                        </x-dropdown-link> -->

                        <!-- Authentication -->
                        <!-- <form method="POST" action="{{ route('logout') }}">
                            @csrf

                            <x-dropdown-link :href="route('logout')"
                                    onclick="event.preventDefault();
                                                this.closest('form').submit();">
                                {{ __('Log Out') }}
                            </x-dropdown-link>
                        </form>
                    </x-slot>
                </x-dropdown>
            </div> -->

            <!-- Hamburger -->
            <!-- <div >
                <button @click="open = ! open" >
                    <svg class="h-6 w-6" stroke="currentColor" fill="none" viewBox="0 0 24 24">
                        <path :class="{'hidden': open, 'inline-flex': ! open }" class="inline-flex" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                        <path :class="{'hidden': ! open, 'inline-flex': open }" class="hidden" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>
        </div>
    </div> -->

    <!-- Responsive Navigation Menu -->
    <!-- <div :class="{'block': open, 'hidden': ! open}" >
        <div class="pt-2 pb-3 space-y-1">
            <x-responsive-nav-link :href="route('dashboard')" :active="request()->routeIs('dashboard')">
                {{ __('Dashboard') }}
            </x-responsive-nav-link>
        </div> -->

        <!-- Responsive Settings Options -->
        <!-- <div class="pt-4 pb-1 border-t border-gray-200">
            <div class="px-4">
                <div class="font-medium text-base text-gray-800">{{ Auth::user()->name }}</div>
                <div class="font-medium text-sm text-gray-500">{{ Auth::user()->email }}</div>
            </div>

            <div class="mt-3 space-y-1">
                <x-responsive-nav-link :href="route('profile.edit')">
                    {{ __('Profile') }}
                </x-responsive-nav-link> -->

                <!-- Authentication -->
                <!-- <form method="POST" action="{{ route('logout') }}">
                    @csrf

                    <x-responsive-nav-link :href="route('logout')"
                            onclick="event.preventDefault();
                                        this.closest('form').submit();">
                        {{ __('Log Out') }}
                    </x-responsive-nav-link>
                </form>
            </div>
        </div>
    </div>
</nav> -->


<nav class="sidebar">

    <!-- Profile Section -->
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

    <!-- Menu -->

    <!-- dashboard -->
    <ul class="menu">
        
        <li>
            <a href="{{ route('dashboard') }}"
                 class="{{ request()->routeIs('dashboard') ? 'active' : '' }}">
                🏠 Dashboard
            </a>
        </li>

<!-- topic -->
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
            <a href="#">
                💬 Messages
            </a>
        </li>

        <li>
            <a href="#">
                👥 Forum
            </a>
        </li>

        <li>
            <a href="#">
                📝 Quiz
            </a>
        </li>

        <hr>

        <li>
            <a href="{{ route('profile.edit') }}">
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
