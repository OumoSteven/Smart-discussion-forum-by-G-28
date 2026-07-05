<x-guest-layout>
    <div class="min-h-screen bg-gradient-to-br from-slate-900 to-indigo-950 flex items-center justify-center p-5 text-slate-50 font-sans">
        <div class="w-full max-w-[600px] min-h-[700px] bg-white/5 backdrop-blur-xl border border-white/10 rounded-2xl p-10 shadow-2xl">
            
            
            <div class="text-center mb-8">
                <h2 class="text-3xl font-bold tracking-tight mb-2">Reset Password</h2>
                <p class="text-slate-400 text-sm leading-relaxed">Tell us your email address and we will send you a password reset link.</p>
            </div>

            @if (session('status'))
                <div class="mb-5 p-3.5 rounded-lg text-sm bg-emerald-500/15 text-emerald-400 border border-emerald-500/20 leading-relaxed">
                    {{ session('status') }}
                </div>
            @endif

            @if ($errors->any())
                <div class="mb-5 p-3.5 rounded-lg text-sm bg-rose-500/15 text-rose-400 border border-rose-500/20 leading-relaxed">
                    <ul class="list-none">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form method="POST" action="{{ route('password.email') }}" class="flex flex-col gap-5">
                @csrf

                <div class="flex flex-col gap-2">
                    <label for="email" class="text-xs font-semibold text-slate-400">Email Address</label>
                    <input 
                        type="email" 
                        id="email" 
                        name="email" 
                        value="{{ old('email') }}" 
                        placeholder="e.g., stevenoumo5@gmail.com" 
                        required 
                        autofocus
                        class="w-full px-4 py-3 bg-slate-950/60 border border-white/10 rounded-lg text-slate-50 text-sm placeholder-slate-500 focus:outline-none focus:border-indigo-500 focus:ring-4 focus:ring-indigo-500/20 transition-all duration-200"
                    >
                </div>

                <button 
                    type="submit" 
                    class="mt-2.5 p-3.5 bg-indigo-500 hover:bg-indigo-600 active:bg-indigo-700 text-white font-semibold rounded-lg text-base shadow-[4px_4px_0px_0px_#000] active:shadow-[2px_2px_0px_0px_#000] active:translate-x-[2px] active:translate-y-[2px] transition-all duration-100 cursor-pointer"
                >
                    Send Reset Link
                </button>
            </form>

            <div class="mt-8 text-center text-sm text-slate-400">
                <p>Remembered your password? <a href="{{ route('login') }}" class="font-medium text-indigo-400 hover:underline">Back to sign in</a></p>
            </div>
        </div>
    </div>
</x-guest-layout>