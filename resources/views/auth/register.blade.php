<x-guest-layout>
    <div class="min-h-screen bg-gradient-to-br from-slate-900 to-indigo-950 flex items-center justify-center p-5 text-slate-50 font-sans">
        
        <div class="w-full max-w-sm bg-white/5 backdrop-blur-xl border border-white/10 rounded-2xl p-6 md:p-8 shadow-2xl my-8">
            
            <div class="text-center mb-6">
                <h2 class="text-2xl font-bold tracking-tight mb-1">Student Registration</h2>
                <p class="text-slate-400 text-xs">Create your account to join the Academic Forum</p>
            </div>

            @if ($errors->any())
                <div class="mb-4 p-3 rounded-lg text-xs bg-rose-500/15 text-rose-400 border border-rose-500/20 leading-relaxed">
                    <ul class="list-none">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form action="{{ route('register') }}" method="POST" class="flex flex-col gap-4">
                @csrf

                <div class="flex flex-col gap-1.5">
                    <label for="name" class="text-xs font-semibold text-slate-400">Full Name</label>
                    <input 
                        type="text" 
                        id="name" 
                        name="name" 
                        value="{{ old('name') }}" 
                        placeholder="e.g., Oumo Steven" 
                        required 
                        autofocus
                        class="w-full px-4 py-2 bg-slate-950/60 border border-white/10 rounded-lg text-slate-50 text-sm placeholder-slate-500 focus:outline-none focus:border-indigo-500 focus:ring-4 focus:ring-indigo-500/20 transition-all duration-200"
                    >
                </div>

                <div class="flex flex-col gap-1.5">
                    <label for="email" class="text-xs font-semibold text-slate-400">Email Address</label>
                    <input 
                        type="email" 
                        id="email" 
                        name="email" 
                        value="{{ old('email') }}" 
                        placeholder="e.g., student@cedat.mak.ac.ug" 
                        required
                        class="w-full px-4 py-2 bg-slate-950/60 border border-white/10 rounded-lg text-slate-50 text-sm placeholder-slate-500 focus:outline-none focus:border-indigo-500 focus:ring-4 focus:ring-indigo-500/20 transition-all duration-200"
                    >
                </div>

                <input type="hidden" name="role" value="member">

                <div class="grid grid-cols-1 sm:grid-cols-2 gap-3">
                    <div class="flex flex-col gap-1.5">
                        <label for="password" class="text-xs font-semibold text-slate-400">Password</label>
                        <input 
                            type="password" 
                            id="password" 
                            name="password" 
                            placeholder="••••••••" 
                            required
                            class="w-full px-4 py-2 bg-slate-950/60 border border-white/10 rounded-lg text-slate-50 text-sm placeholder-slate-500 focus:outline-none focus:border-indigo-500 focus:ring-4 focus:ring-indigo-500/20 transition-all duration-200"
                        >
                    </div>
                    <div class="flex flex-col gap-1.5">
                        <label for="password_confirmation" class="text-xs font-semibold text-slate-400">Confirm</label>
                        <input 
                            type="password" 
                            id="password_confirmation" 
                            name="password_confirmation" 
                            placeholder="••••••••" 
                            required
                            class="w-full px-4 py-2 bg-slate-950/60 border border-white/10 rounded-lg text-slate-50 text-sm placeholder-slate-500 focus:outline-none focus:border-indigo-500 focus:ring-4 focus:ring-indigo-500/20 transition-all duration-200"
                        >
                    </div>
                </div>

                <div class="mt-1 flex flex-col gap-1.5">
                    <label class="text-xs font-semibold text-slate-400">Platform Rules & Regulations</label>
                    <div class="w-full h-24 overflow-y-auto p-3 bg-slate-950/80 border border-white/10 rounded-lg text-xs text-slate-400 leading-relaxed scrollbar-thin scrollbar-thumb-slate-700">
                        <p class="mb-1 font-medium text-slate-200">1. Academic Integrity & Content Policy</p>
                        <p class="mb-2">The platform automatically analyzes posts using an ML model[cite: 37, 52]. Irrelevant posts or flooding behaviors are algorithmically flagged with low relevance scores[cite: 52, 147].</p>
                        
                        <p class="mb-1 font-medium text-slate-200">2. Inactivity Tracking & Blacklist Enforcement</p>
                        <p class="mb-2">The Membership service continuously tracks system actions[cite: 39, 55]. If inactivity intervals breach background thresholds, you will receive up to 2 system notifications before being automatically timed out onto a temporary blacklist[cite: 39].</p>
                        
                        <p class="mb-1 font-medium text-slate-200">3. Quiz Conditions & Timings</p>
                        <p>Quizzes are controlled solely by the authoritative server clock[cite: 43, 94]. Late entries do not extend your personal countdown window[cite: 43]. Attempts auto-submit instantly once the duration runs dry[cite: 43, 116].</p>
                    </div>
                </div>

                <div class="flex items-start gap-2.5 mt-1">
                    <input 
                        type="checkbox" 
                        id="agreed_rules" 
                        name="agreed_rules" 
                        value="1"
                        required
                        class="mt-0.5 w-4 h-4 rounded border-white/10 bg-slate-950/60 text-indigo-500 focus:ring-indigo-500/20 accent-indigo-500 cursor-pointer"
                    >
                    <label for="agreed_rules" class="text-xs text-slate-400 select-none leading-tight cursor-pointer">
                        I accept the forum rules, ML filtering guidelines, and inactivity blacklisting policies[cite: 38, 50].
                    </label>
                </div>

                <button 
                    type="submit" 
                    class="mt-2 p-3 bg-indigo-500 hover:bg-indigo-600 active:bg-indigo-700 text-white font-semibold rounded-lg text-sm shadow-[4px_4px_0px_0px_#000] active:shadow-[2px_2px_0px_0px_#000] active:translate-x-[2px] active:translate-y-[2px] transition-all duration-100 cursor-pointer text-center"
                >
                    Complete Student Onboarding
                </button>
            </form>

            <div class="mt-5 text-center text-xs text-slate-400">
                <p>Already registered? <a href="{{ route('login') }}" class="font-medium text-indigo-400 hover:underline">Sign in here</a></p>
            </div>
        </div>
    </div>
</x-guest-layout>