<x-app-layout>

    @push('styles')
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" />
        <style>
            .sidebar-transition { transition: transform 0.3s ease, opacity 0.3s ease; }
            .card-hover { transition: box-shadow 0.2s, transform 0.1s; }
            .card-hover:hover { box-shadow: 0 8px 25px rgba(0,0,0,0.05); transform: translateY(-2px); }
            .status-dot { display: inline-block; width: 8px; height: 8px; border-radius: 50%; margin-right: 6px; }
            .group-avatar { display: inline-flex; align-items: center; justify-content: center; width: 32px; height: 32px; border-radius: 8px; background: #e0e7ff; color: #4f46e5; font-weight: 600; font-size: 0.875rem; }
            .dark .group-avatar { background: #1e293b; color: #818cf8; }
        </style>
    @endpush

    <div x-data="studentDashboard()" class="min-h-screen bg-slate-50 text-slate-900 dark:bg-slate-950 dark:text-slate-100">

        <div x-cloak x-show="sidebarOpen" @click="sidebarOpen = false" class="fixed inset-0 z-40 bg-black/20 backdrop-blur-sm lg:hidden"></div>

        <div class="flex flex-col lg:flex-row">

            <aside x-cloak id="sidebar" class="fixed inset-y-0 left-0 z-50 h-screen w-72 lg:w-80 bg-white/95 dark:bg-slate-900/95 border-r border-slate-200 dark:border-slate-800 shadow-sm backdrop-blur sidebar-transition transform transition-transform duration-300 ease-in-out overflow-hidden"
                :class="{ 'translate-x-0': sidebarOpen, '-translate-x-full': !sidebarOpen }" aria-hidden="false">
                <div class="flex min-h-0 h-full flex-col overflow-y-auto overscroll-contain touch-pan-y scrollbar-thin scrollbar-thumb-slate-300 scrollbar-track-transparent p-5">
                    <div class="flex items-center justify-between pb-4 border-b border-slate-200 dark:border-slate-800">
                        <div>
                            <h1 class="text-xl font-bold text-slate-900 dark:text-slate-100">Student Hub</h1>
                            <p class="text-sm text-slate-500 dark:text-slate-400">Smart Discussion Forum</p>
                        </div>
                        <button @click="sidebarOpen = !sidebarOpen" :aria-expanded="sidebarOpen" class="text-slate-600 dark:text-slate-300 hover:text-slate-900 dark:hover:text-white">
                            <i :class="sidebarOpen ? 'fas fa-times' : 'fas fa-bars'"></i>
                        </button>
                    </div>

                    <div class="mt-4 flex items-center gap-4 p-3 rounded-2xl bg-slate-50 dark:bg-slate-800/50 border border-slate-200 dark:border-slate-700">
                        <img src="https://ui-avatars.com/api/?name={{ Auth::user()->name }}&background=6366f1&color=fff&size=56" alt="Avatar" class="h-14 w-14 rounded-2xl object-cover border-2 border-white dark:border-slate-700 shadow-sm" />
                        <div>
                            <p class="font-semibold text-slate-900 dark:text-slate-100">{{ Auth::user()->name }}</p>
                            <p class="text-sm text-slate-500 dark:text-slate-400">{{ Auth::user()->email }}</p>
                        </div>
                    </div>

                    <div class="mt-4">
                        <h3 class="text-xs font-semibold uppercase tracking-wider text-slate-400 dark:text-slate-500">Your Groups</h3>
                        <div class="mt-2 flex flex-wrap gap-2">
                            @foreach($groups ?? ['CS101', 'AI Club', 'Study Group'] as $group)
                                <span class="group-avatar">{{ substr($group, 0, 2) }}</span>
                                <span class="text-sm text-slate-700 dark:text-slate-300">{{ $group }}</span>
                            @endforeach
                        </div>
                    </div>

                    <nav class="mt-6 space-y-1">
                        <a href="{{ route('dashboard') }}" class="flex items-center gap-3 rounded-xl px-4 py-2.5 text-slate-700 dark:text-slate-200 bg-slate-100 dark:bg-slate-800 shadow-sm hover:bg-slate-200 dark:hover:bg-slate-700 transition">
                            <i class="fas fa-tachometer-alt w-5 text-slate-500"></i> Dashboard
                        </a>
                        <a href="{{ route('student.topics.index') }}" class="flex items-center gap-3 rounded-xl px-4 py-2.5 text-slate-700 dark:text-slate-200 hover:bg-slate-100 dark:hover:bg-slate-800 transition">
                            <i class="fas fa-comments w-5 text-slate-500"></i> Discussion Topics
                        </a>
                        <a href="{{ route('student.forum') }}" class="flex items-center gap-3 rounded-xl px-4 py-2.5 text-slate-700 dark:text-slate-200 hover:bg-slate-100 dark:hover:bg-slate-800 transition">
                            <i class="fas fa-folder-open w-5 text-slate-500"></i> My Discussions
                        </a>
                        <a href="{{ route('student.messages.index') }}" class="flex items-center gap-3 rounded-xl px-4 py-2.5 text-slate-700 dark:text-slate-200 hover:bg-slate-100 dark:hover:bg-slate-800 transition">
                            <i class="fas fa-envelope w-5 text-slate-500"></i> Messages
                        </a>
                        <a href="{{ route('student.quizzes.index') }}" class="flex items-center gap-3 rounded-xl px-4 py-2.5 text-slate-700 dark:text-slate-200 hover:bg-slate-100 dark:hover:bg-slate-800 transition">
                            <i class="fas fa-pencil-alt w-5 text-slate-500"></i> Quizzes
                        </a>
                        <a href="{{ route('student.marks') }}" class="flex items-center gap-3 rounded-xl px-4 py-2.5 text-slate-700 dark:text-slate-200 hover:bg-slate-100 dark:hover:bg-slate-800 transition">
                            <i class="fas fa-award w-5 text-slate-500"></i> Participation Marks
                        </a>
                        <a href="{{ route('student.notifications') }}" class="flex items-center gap-3 rounded-xl px-4 py-2.5 text-slate-700 dark:text-slate-200 hover:bg-slate-100 dark:hover:bg-slate-800 transition">
                            <i class="fas fa-bullhorn w-5 text-slate-500"></i> Announcements
                        </a>
                        <a href="{{ route('student.profile') }}" class="flex items-center gap-3 rounded-xl px-4 py-2.5 text-slate-700 dark:text-slate-200 hover:bg-slate-100 dark:hover:bg-slate-800 transition">
                            <i class="fas fa-user-circle w-5 text-slate-500"></i> Profile
                        </a>
                        <a href="{{ route('profile.edit') }}" class="flex items-center gap-3 rounded-xl px-4 py-2.5 text-slate-700 dark:text-slate-200 hover:bg-slate-100 dark:hover:bg-slate-800 transition">
                            <i class="fas fa-cog w-5 text-slate-500"></i> Settings
                        </a>
                        <form method="POST" action="{{ route('logout') }}" class="hidden" id="student-logout-form">@csrf</form>
                    </nav>

                    <div class="mt-6 space-y-3">
                        <div class="rounded-3xl bg-slate-50 dark:bg-slate-900 border border-slate-200 dark:border-slate-800 p-4 shadow-sm">
                            <p class="text-sm font-semibold text-slate-900 dark:text-slate-100">Need to update your account?</p>
                            <p class="mt-2 text-sm text-slate-500 dark:text-slate-400">Use Settings to manage your profile, password, and preferences.</p>
                            <a href="{{ route('profile.edit') }}" class="mt-4 inline-flex items-center justify-center rounded-2xl bg-indigo-600 px-4 py-2 text-sm font-medium text-white hover:bg-indigo-700 transition">
                                Open Settings
                            </a>
                        </div>
                        <button type="button" onclick="document.getElementById('student-logout-form').submit();" class="w-full rounded-3xl bg-rose-50 dark:bg-rose-900/40 border border-rose-200 dark:border-rose-700 px-4 py-4 text-left shadow-sm hover:bg-rose-100 dark:hover:bg-rose-800 transition">
                            <div class="flex items-center justify-between gap-3">
                                <div>
                                    <p class="text-sm font-semibold text-rose-700 dark:text-rose-200">Logout</p>
                                    <p class="mt-1 text-sm text-rose-500 dark:text-rose-300">End your session securely.</p>
                                </div>
                                <i class="fas fa-sign-out-alt text-rose-600 dark:text-rose-300"></i>
                            </div>
                        </button>
                    </div>

                    <div class="mt-auto pt-4 border-t border-slate-200 dark:border-slate-800">
                        <div class="flex items-center justify-between text-sm text-slate-500 dark:text-slate-400">
                            <span>v2.0</span>
                            <span class="flex items-center gap-2">
                                <span class="relative flex h-2 w-2">
                                    <span class="animate-ping absolute inline-flex h-full w-full rounded-full bg-emerald-400 opacity-75"></span>
                                    <span class="relative inline-flex rounded-full h-2 w-2 bg-emerald-500"></span>
                                </span>
                                Live
                            </span>
                        </div>
                    </div>
                </div>
            </aside>

            <div :class="sidebarOpen ? 'lg:ml-72 xl:ml-80' : 'lg:ml-0'" class="flex-1 min-w-0 transition-all duration-300 ease-in-out">
                <header class="sticky top-0 z-30 bg-slate-50/95 dark:bg-slate-950/95 border-b border-slate-200 dark:border-slate-800 backdrop-blur px-4 py-3 sm:px-6 lg:px-8">
                    <div class="flex flex-wrap items-center justify-between gap-3">
                        <div class="flex items-center gap-3">
                            <button @click="sidebarOpen = !sidebarOpen" :aria-expanded="sidebarOpen" aria-controls="sidebar" class="p-2 rounded-xl bg-white dark:bg-slate-900 shadow-sm border border-slate-200 dark:border-slate-800 hover:bg-slate-100 dark:hover:bg-slate-800">
                                <i :class="sidebarOpen ? 'fas fa-times' : 'fas fa-bars'"></i>
                            </button>
                            <div class="flex items-center gap-2">
                                <span class="text-sm font-medium text-slate-500 dark:text-slate-400">Welcome back,</span>
                                <span class="font-semibold">{{ Auth::user()->name }}</span>
                            </div>
                        </div>

                        <div class="flex items-center gap-3 ml-auto">
                            <div class="relative hidden sm:block">
                                <i class="fas fa-search absolute left-3 top-1/2 -translate-y-1/2 text-slate-400 text-sm"></i>
                                <input type="search" placeholder="Search..." class="w-48 lg:w-64 rounded-xl border border-slate-200 dark:border-slate-800 bg-white dark:bg-slate-900 py-2 pl-9 pr-4 text-sm focus:outline-none focus:ring-2 focus:ring-indigo-500" />
                            </div>
                        </div>
                    </div>
                </header>

                <main class="px-4 py-6 sm:px-6 lg:px-8">
                    {{ $slot }}
                </main>
            </div>
        </div>
    </div>

    @push('scripts')
        <script>
            function studentDashboard() {
                return {
                    sidebarOpen: window.matchMedia('(min-width: 1024px)').matches,
                    toggleTheme() {
                        document.documentElement.classList.toggle('dark');
                    },
                    initWebSocket() {
                        console.log('WebSocket (Reverb) ready');
                    }
                }
            }

            document.addEventListener('alpine:init', () => {
                Alpine.data('studentDashboard', studentDashboard);
            });
        </script>
    @endpush

</x-app-layout>
