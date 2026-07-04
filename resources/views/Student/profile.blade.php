<x-student-layout>
    <div class="py-12">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8 space-y-6">
            <div>
                <h2 class="text-2xl font-semibold text-slate-900 dark:text-slate-100">Student Profile</h2>
                <p class="mt-2 text-sm text-slate-500 dark:text-slate-400">Manage your account and group participation details.</p>
            </div>
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg p-6">
                <div class="space-y-4">
                    <div>
                        <h3 class="text-lg font-semibold text-gray-900 dark:text-gray-100">{{ $user->name }}</h3>
                        <p class="text-sm text-gray-500 dark:text-gray-400">{{ $user->email }}</p>
                    </div>
                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                        <div class="rounded-3xl bg-slate-50 dark:bg-slate-900 border border-slate-200 dark:border-slate-800 p-4">
                            <p class="text-sm text-slate-500 dark:text-slate-400">Role</p>
                            <p class="mt-2 text-base font-semibold text-slate-900 dark:text-slate-100">{{ ucfirst($user->role) }}</p>
                        </div>
                        <div class="rounded-3xl bg-slate-50 dark:bg-slate-900 border border-slate-200 dark:border-slate-800 p-4">
                            <p class="text-sm text-slate-500 dark:text-slate-400">Status</p>
                            <p class="mt-2 text-base font-semibold text-slate-900 dark:text-slate-100">{{ ucfirst($user->status ?? 'active') }}</p>
                        </div>
                    </div>
                    <div class="pt-4 border-t border-slate-200 dark:border-slate-800">
                        @include('profile.partials.update-profile-information-form')
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-student-layout>
