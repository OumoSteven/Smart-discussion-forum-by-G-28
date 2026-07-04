<x-app-layout>

    @push('styles')
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" />
        <style>
            /* Smooth transitions & custom scrollbar */
            .sidebar-transition { transition: transform 0.3s ease, opacity 0.3s ease; }
            .card-hover { transition: box-shadow 0.2s, transform 0.1s; }
            .card-hover:hover { box-shadow: 0 8px 25px rgba(0,0,0,0.05); transform: translateY(-2px); }
            .status-dot { display: inline-block; width: 8px; height: 8px; border-radius: 50%; margin-right: 6px; }
            .status-active { background: #22c55e; }
            .status-warned { background: #eab308; }
            .status-blacklisted { background: #ef4444; }
            .group-avatar { display: inline-flex; align-items: center; justify-content: center; width: 32px; height: 32px; border-radius: 8px; background: #e0e7ff; color: #4f46e5; font-weight: 600; font-size: 0.875rem; }
            .dark .group-avatar { background: #1e293b; color: #818cf8; }
            .notification-dot { width: 6px; height: 6px; border-radius: 50%; background: #3b82f6; display: inline-block; }
            .quiz-timer { font-variant-numeric: tabular-nums; }
        </style>
    @endpush

    <div x-data="studentDashboard()" class="min-h-screen bg-slate-50 text-slate-900 dark:bg-slate-950 dark:text-slate-100">

        <!-- Mobile sidebar overlay -->
        <div x-cloak x-show="sidebarOpen" @click="sidebarOpen = false" class="fixed inset-0 z-40 bg-black/20 backdrop-blur-sm lg:hidden"></div>

        <div class="flex flex-col lg:flex-row">

            <!-- ===== SIDEBAR ===== -->
           <aside x-cloak id="sidebar" class="fixed inset-y-0 left-0 z-50 h-screen max-h-screen w-72 lg:w-80 bg-white/95 dark:bg-slate-900/95 border-r border-slate-200 dark:border-slate-800 shadow-sm backdrop-blur sidebar-transition transform transition-transform duration-300 ease-in-out overflow-y-auto overscroll-y-auto"
            :class="{ 'translate-x-0': sidebarOpen, '-translate-x-full': !sidebarOpen }"
            aria-hidden="false">
                <div class="min-h-full flex flex-col p-5">

                    <!-- Brand + close -->
                    <div class="flex items-center justify-between pb-4 border-b border-slate-200 dark:border-slate-800">
                        <div>
                            <h1 class="text-xl font-bold text-slate-900 dark:text-slate-100">Student Hub</h1>
                            <p class="text-sm text-slate-500 dark:text-slate-400">Smart Discussion Forum</p>
                        </div>
                        <button @click="sidebarOpen = !sidebarOpen" :aria-expanded="sidebarOpen" class="text-slate-600 dark:text-slate-300 hover:text-slate-900 dark:hover:text-white">
                            <i class="fas fa-times"></i>
                        </button>
                    </div>

                    <!-- Profile summary -->
                    <div class="mt-4 flex items-center gap-4 p-3 rounded-2xl bg-slate-50 dark:bg-slate-800/50 border border-slate-200 dark:border-slate-700">
                        <img src="https://ui-avatars.com/api/?name={{ Auth::user()->name }}&background=6366f1&color=fff&size=56" alt="Avatar" class="h-14 w-14 rounded-2xl object-cover border-2 border-white dark:border-slate-700 shadow-sm" />
                        <div>
                            <p class="font-semibold text-slate-900 dark:text-slate-100">{{ Auth::user()->name }}</p>
                            <p class="text-sm text-slate-500 dark:text-slate-400">{{ Auth::user()->email }}</p>
                            <div class="mt-1 flex items-center gap-2">
                                <span class="status-dot status-{{ $accountStatus ?? 'active' }}"></span>
                                <span class="text-xs font-medium capitalize text-slate-600 dark:text-slate-300">{{ $accountStatus ?? 'Active' }}</span>
                            </div>
                        </div>
                    </div>

                    <!-- Groups -->
                    <div class="mt-4">
                        <h3 class="text-xs font-semibold uppercase tracking-wider text-slate-400 dark:text-slate-500">Your Groups</h3>
                        <div class="mt-2 flex flex-wrap gap-2">
                            @foreach($groups ?? ['CS101', 'AI Club', 'Study Group'] as $group)
                                <span class="group-avatar">{{ substr($group, 0, 2) }}</span>
                                <span class="text-sm text-slate-700 dark:text-slate-300">{{ $group }}</span>
                            @endforeach
                        </div>
                    </div>

                    <!-- Navigation -->
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
                            <span class="ml-auto text-xs bg-indigo-100 text-indigo-700 dark:bg-indigo-900 dark:text-indigo-300 px-2 py-0.5 rounded-full">{{ $unreadMessages ?? 3 }}</span>
                        </a>
                        <form action="{{ route('student.quizzes.start', $quiz ?? 1) }}" method="POST" class="block">
                            @csrf
                            <button type="submit" class="w-full flex items-center gap-3 rounded-xl px-4 py-2.5 text-slate-700 dark:text-slate-200 hover:bg-slate-100 dark:hover:bg-slate-800 transition">
                                <i class="fas fa-pencil-alt w-5 text-slate-500"></i> Start Quiz
                            </button>
                        </form>
                        <a href="{{ route('student.marks') }}" class="flex items-center gap-3 rounded-xl px-4 py-2.5 text-slate-700 dark:text-slate-200 hover:bg-slate-100 dark:hover:bg-slate-800 transition">
                            <i class="fas fa-award w-5 text-slate-500"></i> Participation Marks
                        </a>
                        <a href="{{ route('student.notifications') }}" class="flex items-center gap-3 rounded-xl px-4 py-2.5 text-slate-700 dark:text-slate-200 hover:bg-slate-100 dark:hover:bg-slate-800 transition">
                            <i class="fas fa-bullhorn w-5 text-slate-500"></i> Announcements
                            <span class="ml-auto text-xs bg-rose-100 text-rose-700 dark:bg-rose-900 dark:text-rose-300 px-2 py-0.5 rounded-full">{{ $newAnnouncements ?? 2 }}</span>
                        </a>
                        <a href="{{ route('student.topics.index') }}" class="flex items-center gap-3 rounded-xl px-4 py-2.5 text-slate-700 dark:text-slate-200 hover:bg-slate-100 dark:hover:bg-slate-800 transition">
                            <i class="fas fa-brain w-5 text-slate-500"></i> Recommendations
                        </a>
                        <a href="{{ route('student.profile') }}" class="flex items-center gap-3 rounded-xl px-4 py-2.5 text-slate-700 dark:text-slate-200 hover:bg-slate-100 dark:hover:bg-slate-800 transition">
                            <i class="fas fa-user-circle w-5 text-slate-500"></i> Profile
                        </a>
                        <a href="{{ route('profile.edit') }}" class="flex items-center gap-3 rounded-xl px-4 py-2.5 text-slate-700 dark:text-slate-200 hover:bg-slate-100 dark:hover:bg-slate-800 transition">
                            <i class="fas fa-cog w-5 text-slate-500"></i> Settings
                        </a>
                        <a href="{{ route('logout') }}" onclick="event.preventDefault(); this.closest('form').submit();" class="flex items-center gap-3 rounded-xl px-4 py-2.5 text-rose-600 dark:text-rose-400 hover:bg-rose-50 dark:hover:bg-rose-900/30 transition">
                            <i class="fas fa-sign-out-alt w-5"></i> Logout
                        </a>
                        <form method="POST" action="{{ route('logout') }}" class="hidden">@csrf</form>
                    </nav>

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

            <!-- ===== MAIN CONTENT ===== -->
            <div :class="sidebarOpen ? 'lg:ml-72 xl:ml-80' : 'lg:ml-0'" class="flex-1 min-w-0 transition-all duration-300 ease-in-out">

                <!-- Header -->
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
                            <!-- Search -->
                            <div class="relative hidden sm:block">
                                <i class="fas fa-search absolute left-3 top-1/2 -translate-y-1/2 text-slate-400 text-sm"></i>
                                <input type="search" placeholder="Search..." class="w-48 lg:w-64 rounded-xl border border-slate-200 dark:border-slate-800 bg-white dark:bg-slate-900 py-2 pl-9 pr-4 text-sm focus:outline-none focus:ring-2 focus:ring-indigo-500" />
                            </div>
                            <!-- Theme toggle -->
                            <button @click="toggleTheme" class="p-2 rounded-xl bg-white dark:bg-slate-900 border border-slate-200 dark:border-slate-800 shadow-sm hover:bg-slate-50 dark:hover:bg-slate-800 transition" aria-label="Toggle theme">
                                <i :class="themeIcon" class="h-4 w-4"></i>
                            </button>
                            <!-- Notifications bell -->
                            <button class="relative p-2 rounded-xl bg-white dark:bg-slate-900 border border-slate-200 dark:border-slate-800 shadow-sm hover:bg-slate-50 dark:hover:bg-slate-800 transition" aria-label="Notifications">
                                <i class="fas fa-bell"></i>
                                <span class="absolute -top-0.5 -right-0.5 h-4 w-4 rounded-full bg-rose-500 text-[10px] font-bold text-white flex items-center justify-center">{{ $newNotifications ?? 3 }}</span>
                            </button>
                            <!-- Logo button -->
                            <a href="{{ route('dashboard') }}" class="hidden sm:inline-flex items-center justify-center rounded-xl bg-indigo-600 px-3 py-2 text-sm font-semibold text-white shadow-sm hover:bg-indigo-700 transition ml-auto" aria-label="Smart Discussion Forum">
                                <span class="leading-none">SDF</span>
                            </a>
                        </div>
                    </div>
                </header>

                <!-- Main -->
                <main class="px-4 py-6 sm:px-6 lg:px-8">

                    <!-- Stats row -->
                    <div class="grid grid-cols-2 md:grid-cols-3 xl:grid-cols-6 gap-4 mb-6">
                        <div class="rounded-2xl bg-gradient-to-br from-sky-600 to-indigo-600 text-white p-4 shadow-md">
                            <div class="text-xs uppercase tracking-wider opacity-80">Participation</div>
                            <div class="mt-2 text-2xl font-bold">{{ $participationMarks ?? 84 }}%</div>
                            <div class="mt-2 h-1.5 rounded-full bg-white/30"><div class="h-full rounded-full bg-white" style="width: {{ $participationMarks ?? 84 }}%"></div></div>
                        </div>
                        <div class="rounded-2xl bg-white dark:bg-slate-900 border border-slate-200 dark:border-slate-800 p-4 shadow-sm card-hover">
                            <div class="text-xs uppercase tracking-wider text-slate-500 dark:text-slate-400">Current Grade</div>
                            <div class="mt-2 text-2xl font-bold">{{ $currentGrade ?? 'A-' }}</div>
                        </div>
                        <div class="rounded-2xl bg-white dark:bg-slate-900 border border-slate-200 dark:border-slate-800 p-4 shadow-sm card-hover">
                            <div class="text-xs uppercase tracking-wider text-slate-500 dark:text-slate-400">Discussions</div>
                            <div class="mt-2 text-2xl font-bold">{{ $discussionsJoined ?? 12 }}</div>
                        </div>
                        <div class="rounded-2xl bg-white dark:bg-slate-900 border border-slate-200 dark:border-slate-800 p-4 shadow-sm card-hover">
                            <div class="text-xs uppercase tracking-wider text-slate-500 dark:text-slate-400">Topics</div>
                            <div class="mt-2 text-2xl font-bold">{{ $topicsCreated ?? 7 }}</div>
                        </div>
                        <div class="rounded-2xl bg-white dark:bg-slate-900 border border-slate-200 dark:border-slate-800 p-4 shadow-sm card-hover">
                            <div class="text-xs uppercase tracking-wider text-slate-500 dark:text-slate-400">Messages</div>
                            <div class="mt-2 text-2xl font-bold">{{ $messagesReceived ?? 18 }}</div>
                        </div>
                        <div class="rounded-2xl bg-white dark:bg-slate-900 border border-slate-200 dark:border-slate-800 p-4 shadow-sm card-hover">
                            <div class="text-xs uppercase tracking-wider text-slate-500 dark:text-slate-400">Quizzes</div>
                            <div class="mt-2 text-2xl font-bold">{{ $upcomingQuizzes ?? 3 }}</div>
                        </div>
                    </div>

                    <!-- Grid: main content + sidebar -->
                    <div class="grid grid-cols-1 xl:grid-cols-[1.6fr,0.9fr] gap-6">

                        <!-- Left column -->
                        <div class="space-y-6">

                            <!-- Announcements -->
                            <section class="rounded-2xl bg-white dark:bg-slate-900 border border-slate-200 dark:border-slate-800 p-5 shadow-sm">
                                <div class="flex items-center justify-between">
                                    <div>
                                        <h2 class="text-lg font-semibold">📢 Announcements</h2>
                                        <p class="text-sm text-slate-500 dark:text-slate-400">Latest from lecturers</p>
                                    </div>
                                    <button class="text-sm text-indigo-600 dark:text-indigo-400 hover:underline">View all</button>
                                </div>
                                <div class="mt-4 space-y-3">
                                    @foreach($announcements ?? [
                                        ['title' => 'Midterm submission window open', 'date' => '2h ago', 'read' => false],
                                        ['title' => 'New group study session scheduled', 'date' => 'Yesterday', 'read' => false],
                                        ['title' => 'Feedback on quiz 2 released', 'date' => '3d ago', 'read' => true]
                                    ] as $ann)
                                        <div class="flex items-start gap-3 p-3 rounded-xl bg-slate-50 dark:bg-slate-800/50 border border-slate-200 dark:border-slate-700 card-hover">
                                            <div class="flex-1">
                                                <p class="font-medium text-slate-900 dark:text-slate-100">{{ $ann['title'] }}</p>
                                                <p class="text-sm text-slate-500 dark:text-slate-400">{{ $ann['date'] }}</p>
                                            </div>
                                            <div class="flex items-center gap-2">
                                                @if(!$ann['read'])
                                                    <span class="notification-dot"></span>
                                                    <button class="text-xs text-indigo-600 dark:text-indigo-400 hover:underline">Mark read</button>
                                                @else
                                                    <span class="text-xs text-slate-400">Read</span>
                                                @endif
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                            </section>

                            <!-- Discussion Area -->
                            <section class="rounded-2xl bg-white dark:bg-slate-900 border border-slate-200 dark:border-slate-800 p-5 shadow-sm">
                                <div class="flex items-center justify-between">
                                    <div>
                                        <h2 class="text-lg font-semibold">💬 Discussion Topics</h2>
                                        <p class="text-sm text-slate-500 dark:text-slate-400">Active in your group</p>
                                    </div>
                                    <a href="{{ url('/student/topics/create') }}"  class="rounded-xl bg-indigo-600 px-4 py-2 text-sm font-medium text-white shadow hover:bg-indigo-700 transition">
                                        <i class="fas fa-plus mr-1"></i> Create Topic
                                    </a>
                                </div>
                                <div class="mt-4 space-y-3">
                                    @foreach($topics ?? [
                                        ['title' => 'Collaborative learning strategies', 'replies' => 24, 'time' => '2d ago', 'accepted' => false],
                                        ['title' => 'Effective quiz revision techniques', 'replies' => 18, 'time' => '1d ago', 'accepted' => true],
                                        ['title' => 'Improving participation in forums', 'replies' => 12, 'time' => '5h ago', 'accepted' => false]
                                    ] as $topic)
                                        <div class="p-3 rounded-xl bg-slate-50 dark:bg-slate-800/50 border border-slate-200 dark:border-slate-700 card-hover flex flex-wrap items-center justify-between gap-2">
                                            <div>
                                                <p class="font-medium text-slate-900 dark:text-slate-100">{{ $topic['title'] }}</p>
                                                <div class="flex items-center gap-3 text-sm text-slate-500 dark:text-slate-400">
                                                    <span><i class="far fa-comment"></i> {{ $topic['replies'] }} replies</span>
                                                    <span><i class="far fa-clock"></i> {{ $topic['time'] }}</span>
                                                    @if($topic['accepted'])
                                                        <span class="text-emerald-600 dark:text-emerald-400"><i class="fas fa-check-circle"></i> Accepted</span>
                                                    @endif
                                                </div>
                                            </div>
                                            <div class="flex items-center gap-2 text-sm">
                                                <a href="#" class="text-indigo-600 dark:text-indigo-400 hover:underline">View</a>
                                                <span class="text-slate-300 dark:text-slate-600">|</span>
                                                <a href="#" class="text-indigo-600 dark:text-indigo-400 hover:underline">Replies</a>
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                                <div class="mt-4 flex flex-wrap items-center gap-4 text-sm">
                                    <a href="#" class="text-indigo-600 dark:text-indigo-400 hover:underline"><i class="fas fa-list-ul mr-1"></i> All Posts</a>
                                    <a href="#" class="text-indigo-600 dark:text-indigo-400 hover:underline"><i class="fas fa-reply-all mr-1"></i> My Replies</a>
                                    <a href="#" class="text-indigo-600 dark:text-indigo-400 hover:underline"><i class="fas fa-check-double mr-1"></i> Accepted Answers</a>
                                </div>
                            </section>

                            <!-- Messages (Group) -->
                            <section class="rounded-2xl bg-white dark:bg-slate-900 border border-slate-200 dark:border-slate-800 p-5 shadow-sm">
                                <div class="flex items-center justify-between">
                                    <div>
                                        <h2 class="text-lg font-semibold">💌 Group Messages</h2>
                                        <p class="text-sm text-slate-500 dark:text-slate-400">Direct messages & real-time</p>
                                    </div>
                                    <span class="inline-flex items-center gap-1 text-xs text-emerald-600 dark:text-emerald-400">
                                        <span class="relative flex h-2 w-2">
                                            <span class="animate-ping absolute inline-flex h-full w-full rounded-full bg-emerald-400 opacity-75"></span>
                                            <span class="relative inline-flex rounded-full h-2 w-2 bg-emerald-500"></span>
                                        </span>
                                        Live
                                    </span>
                                </div>
                                <div class="mt-4 space-y-3">
                                    @foreach($groupMessages ?? [
                                        ['sender' => 'Dr. Smith', 'preview' => 'Reminder: Submit your project proposals by Friday.', 'time' => '10m ago'],
                                        ['sender' => 'Alice', 'preview' => 'Has anyone started the reading for week 5?', 'time' => '1h ago'],
                                        ['sender' => 'Bob', 'preview' => 'I’ve created a shared doc for collaboration.', 'time' => '3h ago']
                                    ] as $msg)
                                        <div class="p-3 rounded-xl bg-slate-50 dark:bg-slate-800/50 border border-slate-200 dark:border-slate-700 card-hover">
                                            <div class="flex items-center justify-between">
                                                <p class="font-semibold text-slate-900 dark:text-slate-100">{{ $msg['sender'] }}</p>
                                                <span class="text-xs text-slate-400">{{ $msg['time'] }}</span>
                                            </div>
                                            <p class="mt-1 text-sm text-slate-600 dark:text-slate-300">{{ $msg['preview'] }}</p>
                                        </div>
                                    @endforeach
                                </div>
                                <!-- Real-time WebSocket placeholder -->
                                <div class="mt-3 text-xs text-slate-400 border-t border-slate-200 dark:border-slate-700 pt-3 flex items-center gap-2">
                                    <i class="fas fa-bolt text-yellow-500"></i>
                                    <span>WebSocket connected – new messages appear instantly</span>
                                </div>
                            </section>
                        </div>

                        <!-- Right column -->
                        <div class="space-y-6">

                            <!-- Quizzes -->
                            <section class="rounded-2xl bg-white dark:bg-slate-900 border border-slate-200 dark:border-slate-800 p-5 shadow-sm">
                                <div class="flex items-center justify-between">
                                    <h2 class="text-lg font-semibold">📝 Upcoming Quizzes</h2>
                                    <a href="{{ route('student.quizzes.index') }}" class="text-sm text-indigo-600 dark:text-indigo-400 hover:underline">View all</a>
                                </div>
                                <div class="mt-4 space-y-3">
                                    @foreach($upcomingQuizList ?? [
                                        ['title' => 'Biology Concept Check', 'date' => 'Jul 12', 'time' => '10:00 AM', 'status' => 'open', 'timer' => '2d 4h'],
                                        ['title' => 'Calculus Practice', 'date' => 'Jul 15', 'time' => '2:00 PM', 'status' => 'scheduled', 'timer' => null],
                                        ['title' => 'Physics Review', 'date' => 'Jul 10', 'time' => '9:00 AM', 'status' => 'closed', 'timer' => null]
                                    ] as $quiz)
                                        <div class="p-3 rounded-xl bg-slate-50 dark:bg-slate-800/50 border border-slate-200 dark:border-slate-700 card-hover">
                                            <div class="flex items-center justify-between">
                                                <div>
                                                    <p class="font-medium text-slate-900 dark:text-slate-100">{{ $quiz['title'] }}</p>
                                                    <p class="text-sm text-slate-500 dark:text-slate-400">{{ $quiz['date'] }} • {{ $quiz['time'] }}</p>
                                                </div>
                                                <div class="text-right">
                                                    @if($quiz['status'] === 'open')
                                                        <span class="inline-block rounded-full bg-emerald-100 dark:bg-emerald-900/40 text-emerald-700 dark:text-emerald-300 px-2.5 py-0.5 text-xs font-semibold">Open</span>
                                                        @if($quiz['timer'])
                                                            <div class="mt-1 text-sm font-mono text-indigo-600 dark:text-indigo-400 quiz-timer">{{ $quiz['timer'] }}</div>
                                                        @endif
                                                        <form action="{{ route('student.quizzes.start', $loop->index) }}" method="POST" class="mt-1">
                                                            @csrf
                                                            <button type="submit" class="rounded-lg bg-indigo-600 px-3 py-1 text-xs font-medium text-white shadow hover:bg-indigo-700 transition">Start Quiz</button>
                                                        </form>
                                                    @elseif($quiz['status'] === 'scheduled')
                                                        <span class="inline-block rounded-full bg-slate-200 dark:bg-slate-700 text-slate-700 dark:text-slate-300 px-2.5 py-0.5 text-xs font-semibold">Scheduled</span>
                                                    @else
                                                        <span class="inline-block rounded-full bg-rose-100 dark:bg-rose-900/40 text-rose-700 dark:text-rose-300 px-2.5 py-0.5 text-xs font-semibold">Closed</span>
                                                    @endif
                                                </div>
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                            </section>

                            <!-- Notifications -->
                            <section class="rounded-2xl bg-white dark:bg-slate-900 border border-slate-200 dark:border-slate-800 p-5 shadow-sm">
                                <div class="flex items-center justify-between">
                                    <h2 class="text-lg font-semibold">🔔 Notifications</h2>
                                    <div class="flex gap-2">
                                        <button class="text-xs text-indigo-600 dark:text-indigo-400 hover:underline">Mark all read</button>
                                        <button class="text-xs text-rose-600 dark:text-rose-400 hover:underline">Clear</button>
                                    </div>
                                </div>
                                <div class="mt-4 space-y-2">
                                    @foreach($notifications ?? [
                                        ['text' => 'You received a warning for low participation.', 'time' => '1h ago', 'type' => 'warning'],
                                        ['text' => 'Inactivity alert: please log in within 3 days.', 'time' => '5h ago', 'type' => 'inactivity'],
                                        ['text' => 'New quiz available: Biology Concept Check.', 'time' => '1d ago', 'type' => 'quiz']
                                    ] as $notif)
                                        <div class="flex items-start gap-3 p-2 rounded-lg hover:bg-slate-50 dark:hover:bg-slate-800/50 transition">
                                            <div class="flex-1">
                                                <p class="text-sm text-slate-700 dark:text-slate-300">{{ $notif['text'] }}</p>
                                                <p class="text-xs text-slate-400">{{ $notif['time'] }}</p>
                                            </div>
                                            @if($notif['type'] === 'warning')
                                                <span class="text-rose-500"><i class="fas fa-exclamation-triangle"></i></span>
                                            @elseif($notif['type'] === 'inactivity')
                                                <span class="text-amber-500"><i class="fas fa-clock"></i></span>
                                            @elseif($notif['type'] === 'quiz')
                                                <span class="text-indigo-500"><i class="fas fa-pencil-alt"></i></span>
                                            @endif
                                        </div>
                                    @endforeach
                                </div>
                            </section>

                            <!-- AI Recommendations -->
                            <section class="rounded-2xl bg-white dark:bg-slate-900 border border-slate-200 dark:border-slate-800 p-5 shadow-sm">
                                <div class="flex items-center justify-between">
                                    <h2 class="text-lg font-semibold">🤖 Recommended Topics</h2>
                                    <button class="text-xs text-indigo-600 dark:text-indigo-400 hover:underline">Refresh</button>
                                </div>
                                <p class="text-sm text-slate-500 dark:text-slate-400">Based on your activity</p>
                                <div class="mt-4 space-y-3">
                                    @foreach($recommendations ?? [
                                        ['title' => 'The future of AI in education', 'reason' => 'Because you read "ML basics"'],
                                        ['title' => 'Group project management tips', 'reason' => 'Similar to your recent posts'],
                                        ['title' => 'Effective online study habits', 'reason' => 'Popular in your group']
                                    ] as $rec)
                                        <div class="p-3 rounded-xl bg-slate-50 dark:bg-slate-800/50 border border-slate-200 dark:border-slate-700 card-hover">
                                            <p class="font-medium text-slate-900 dark:text-slate-100">{{ $rec['title'] }}</p>
                                            <p class="text-xs text-slate-400 mt-1"><i class="fas fa-lightbulb text-yellow-500 mr-1"></i> {{ $rec['reason'] }}</p>
                                        </div>
                                    @endforeach
                                </div>
                                <!-- AI badge -->
                                <div class="mt-3 text-xs text-slate-400 border-t border-slate-200 dark:border-slate-700 pt-3 flex items-center gap-2">
                                    <i class="fas fa-robot text-indigo-400"></i>
                                    <span>Powered by machine learning</span>
                                </div>
                            </section>

                            <!-- Weekly activity chart (placeholder) -->
                            <section class="rounded-2xl bg-white dark:bg-slate-900 border border-slate-200 dark:border-slate-800 p-5 shadow-sm">
                                <div class="flex items-center justify-between">
                                    <h2 class="text-lg font-semibold">📊 Weekly Activity</h2>
                                    <span class="text-xs text-slate-400">Last 7 days</span>
                                </div>
                                <div class="mt-4 flex items-end h-24 gap-1.5">
                                    @foreach([30, 50, 65, 55, 80, 75, 90] as $val)
                                        <div class="flex-1 rounded-t-lg bg-indigo-200 dark:bg-indigo-800/60" style="height: {{ $val }}%"></div>
                                    @endforeach
                                </div>
                                <div class="mt-1 flex justify-between text-xs text-slate-400">
                                    <span>M</span><span>T</span><span>W</span><span>T</span><span>F</span><span>S</span><span>S</span>
                                </div>
                            </section>
                        </div>
                    </div>

                </main>
            </div>
        </div>
    </div>

    @push('scripts')
        <script>
            function studentDashboard() {
                return {
                    // start open on desktop, closed on small screens
                    sidebarOpen: window.matchMedia('(min-width: 1024px)').matches,
                    themeIcon: 'fas fa-moon',
                    toggleTheme() {
                        document.documentElement.classList.toggle('dark');
                        this.themeIcon = document.documentElement.classList.contains('dark') ? 'fas fa-sun' : 'fas fa-moon';
                    },
                    // Placeholder for real-time WebSocket
                    initWebSocket() {
                        // echo.connector('reverb').listen(...)
                        console.log('WebSocket (Reverb) ready');
                    }
                }
            }

            // Auto-initialize WebSocket when DOM is ready
            document.addEventListener('alpine:init', () => {
                Alpine.data('studentDashboard', studentDashboard);
            });
        </script>
    @endpush

</x-app-layout>