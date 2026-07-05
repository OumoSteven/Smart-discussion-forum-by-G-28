<x-guest-layout>
    <div style="width:450px; max-width:450px; margin:auto; background:white; padding:2rem; border-radius:1rem;">
        <!-- Header -->
        <div class="mb-8 text-center">
            <h1 class="text-4xl font-bold text-slate-900">welcome to</h1>
            <div class="mt-2 flex items-center justify-center gap-2">
                <span class="text-2xl">🌱</span>
                <h2 class="text-2xl font-semibold text-green-600">smart discussion forum</h2>
            </div>
            <p class="mt-4 text-sm text-slate-600">signin to continue to you account</p>
        </div>

        <x-auth-session-status class="mb-6 rounded-lg bg-red-50 px-4 py-3 text-sm text-red-700" :status="session('status')" />

        <!-- Login Form -->
        <form method="POST" action="{{ route('login') }}" class="space-y-6">
            @csrf

            <!-- Email -->
            <div>
                <label for="email" class="block text-sm font-medium text-slate-700">Email address:</label>
                <input
                    id="email"
                    name="email"
                    type="email"
                    required
                    autofocus
                    autocomplete="username"
                    class="mt-2 w-full border-b-2 border-slate-300 bg-transparent px-0 py-2 text-slate-900 placeholder-slate-400 outline-none transition focus:border-blue-500" />
                @error('email')
                    <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>

            <!-- Password -->
            <div>
                <div class="mb-2 flex items-center justify-between">
                    <label for="password" class="block text-sm font-medium text-slate-700">Password:</label>
                    @if(Route::has('password.request'))
                        <a href="{{ route('password.request') }}" class="text-xs text-blue-600 hover:text-blue-700">Forgot password?</a>
                    @endif
                </div>
                <input
                    id="password"
                    name="password"
                    type="password"
                    required
                    autocomplete="current-password"
                    
                    class="w-full border-b-2 border-slate-300 bg-transparent px-0 py-2 text-slate-900 placeholder-slate-400 outline-none transition focus:border-blue-500" />
                @error('password')
                    <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>

            <!-- Remember Me -->
            <div>
                <label class="inline-flex items-center gap-2 text-sm">
                    <input type="checkbox" name="remember" class="h-4 w-4 rounded border-slate-300 text-blue-600" />
                    <span class="text-slate-700">Remember</span>
                </label>
            </div>

            <!-- Terms and Conditions -->
            <div>
                <label class="inline-flex items-start gap-2 text-xs text-slate-600">
                    <input type="checkbox" required class="mt-1 h-4 w-4 rounded border-slate-300 text-blue-600" />
                    <span>
                        I agree to the
                        <a href="#" class="text-blue-600 hover:underline">terms and conditions</a>
                        and
                        <a href="#" class="text-blue-600 hover:underline">privacy policy</a>
                    </span>
                </label>
                <p class="mt-1 text-xs text-slate-600">You must agree to our terms and conditions to access the system</p>
            </div>

            <!-- Sign In Button -->
            <button type="submit" class="w-full rounded-lg bg-blue-600 px-4 py-3 font-semibold text-white transition hover:bg-blue-700">Sign in</button>
        </form>

        <!-- Sign Up Link -->
        @if(Route::has('register'))
            <p class="mt-8 text-center text-sm text-slate-600">
                Don't have an account?
                <a href="{{ route('register') }}" class="text-blue-600 hover:text-blue-700 hover:underline">sign up</a>
            </p>
        @endif
    </div>
</x-guest-layout>
