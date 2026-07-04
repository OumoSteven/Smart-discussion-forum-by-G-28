<x-guest-layout>
    <div class="w-full max-w-5xl overflow-hidden rounded-[3rem] bg-white shadow-2xl ring-1 ring-slate-900/10">
        <div class="grid grid-cols-1 lg:grid-cols-2">
            <div class="relative overflow-hidden bg-gradient-to-br from-sky-600 via-indigo-600 to-violet-700 px-10 py-12 sm:px-12 sm:py-16 text-white">
                <div class="inline-flex h-12 w-12 items-center justify-center rounded-3xl bg-white/15 shadow-lg shadow-slate-950/10">
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="h-6 w-6">
                        <path d="M12 2C6.477 2 2 6.477 2 12s4.477 10 10 10 10-4.477 10-10S17.523 2 12 2Zm1.5 14.5h-3v-3h3v3Zm0-4.5h-3V7h3v5Z" />
                    </svg>
                </div>

                <div class="mt-10 space-y-6">
                    <div>
                        <p class="text-sm uppercase tracking-[0.24em] text-slate-200/80">Secure student access</p>
                        <h2 class="mt-4 text-4xl font-semibold tracking-tight">Smart Discussion Forum</h2>
                        <p class="mt-4 max-w-sm text-sm leading-7 text-slate-100/90">Sign in to access your courses, forum threads, messages, quizzes, and notifications from one easy dashboard.</p>
                    </div>

                    <div class="space-y-4 text-sm text-slate-100/90">
                        <div class="flex items-start gap-3">
                            <span class="mt-1 inline-flex h-8 w-8 items-center justify-center rounded-full bg-white/20 text-white">✓</span>
                            <span>Fast login with secure student authentication.</span>
                        </div>
                        <div class="flex items-start gap-3">
                            <span class="mt-1 inline-flex h-8 w-8 items-center justify-center rounded-full bg-white/20 text-white">✓</span>
                            <span>Responsive layout for desktop and mobile.</span>
                        </div>
                        <div class="flex items-start gap-3">
                            <span class="mt-1 inline-flex h-8 w-8 items-center justify-center rounded-full bg-white/20 text-white">✓</span>
                            <span>Easy access to forum, quizzes, grades, and notifications.</span>
                        </div>
                    </div>
                </div>
            </div>

            <div class="px-8 py-10 sm:px-10 sm:py-12">
                <div class="mb-8">
                    <p class="text-sm font-semibold uppercase tracking-[0.24em] text-slate-500">Welcome back</p>
                    <h1 class="mt-3 text-3xl font-semibold text-slate-900">Log in to your account</h1>
                    <p class="mt-3 text-sm text-slate-500">Enter your email and password to continue.</p>
                </div>

                <x-auth-session-status class="mb-4 rounded-lg bg-slate-50 px-4 py-3 text-sm text-slate-700" :status="session('status')" />

                <form method="POST" action="{{ route('login') }}" class="space-y-6">
                    @csrf

                    <div>
                        <label for="email" class="block text-sm font-medium text-slate-700">Email address</label>
                        <input
                            id="email"
                            name="email"
                            type="email"
                            value="{{ old('email') }}"
                            required
                            autofocus
                            autocomplete="username"
                            placeholder="name@example.com"
                            class="mt-3 w-full rounded-none border border-slate-200 bg-slate-50 px-4 py-3 text-slate-900 outline-none transition focus:border-sky-500 focus:ring-2 focus:ring-sky-200" />
                        @error('email')
                            <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label for="password" class="block text-sm font-medium text-slate-700">Password</label>
                        <input
                            id="password"
                            name="password"
                            type="password"
                            required
                            autocomplete="current-password"
                            placeholder="Enter your password"
                            class="mt-3 w-full rounded-none border border-slate-200 bg-slate-50 px-4 py-3 text-slate-900 outline-none transition focus:border-sky-500 focus:ring-2 focus:ring-sky-200" />
                        @error('password')
                            <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="flex flex-col gap-4 sm:flex-row sm:items-center sm:justify-between">
                        <label class="inline-flex items-center gap-3 text-sm text-slate-600">
                            <input type="checkbox" name="remember" class="h-4 w-4 rounded border-slate-300 text-sky-600 focus:ring-sky-500" />
                            Remember me
                        </label>

                        @if(Route::has('password.request'))
                            <a href="{{ route('password.request') }}" class="text-sm font-semibold text-sky-600 hover:text-sky-700">Forgot password?</a>
                        @endif
                    </div>

                    <button type="submit" class="w-full rounded-2xl bg-slate-900 px-4 py-3 text-sm font-semibold text-white shadow-lg shadow-slate-950/10 transition hover:bg-slate-800">Log in</button>
                </form>

                @if(Route::has('register'))
                    <p class="mt-8 text-center text-sm text-slate-500">
                        Don’t have an account?
                        <a href="{{ route('register') }}" class="font-semibold text-sky-600 hover:text-sky-700">Create one</a>
                    </p>
                @endif
            </div>
        </div>
    </div>
</x-guest-layout>
