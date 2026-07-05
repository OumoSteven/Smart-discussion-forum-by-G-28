<x-guest-layout>
    <div class="w-full max-w-lg mx-auto rounded-3xl bg-white p-10 shadow-2xl border border-slate-200">

        <!-- Header -->
        <div class="text-center">
            <div class="mx-auto flex h-20 w-20 items-center justify-center rounded-full bg-blue-100">
                <span class="text-4xl">📧</span>
            </div>

            <h1 class="mt-6 text-3xl font-bold text-slate-900">
                Verify Your Email
            </h1>

            <p class="mt-3 text-slate-600 leading-relaxed">
                Thank you for registering with the
                <span class="font-semibold text-green-600">Smart Discussion Forum</span>.
                Before accessing your account, please verify your email address by clicking
                the verification link we sent to your inbox.
            </p>
        </div>

        @if (session('status') == 'verification-link-sent')
            <div class="mt-6 rounded-xl border border-green-200 bg-green-50 p-4 text-sm text-green-700">
                ✅ A new verification link has been sent to your email address.
            </div>
        @endif

        <div class="mt-8 space-y-4">

            <form method="POST" action="{{ route('verification.send') }}">
                @csrf

                <button
                    type="submit"
                    class="w-full rounded-xl bg-indigo-600 py-3 text-white font-semibold shadow-lg transition hover:bg-indigo-700">
                    Resend Verification Email
                </button>
            </form>

            <form method="POST" action="{{ route('logout') }}">
                @csrf

                <button
                    type="submit"
                    class="w-full rounded-xl border border-red-300 bg-red-50 py-3 font-semibold text-red-600 transition hover:bg-red-100">
                    Log Out
                </button>
            </form>

        </div>

        <div class="mt-8 text-center text-sm text-slate-500">
            Didn't receive the email?
            <br>
            Check your <strong>Spam</strong> or <strong>Junk</strong> folder before requesting another one.
        </div>

    </div>
</x-guest-layout>