<x-student-layout>
    <div class="py-12">
        <div class="max-w-5xl mx-auto sm:px-6 lg:px-8 space-y-6">
            <div>
                <h2 class="text-2xl font-semibold text-slate-900 dark:text-slate-100">Notifications</h2>
                <p class="mt-2 text-sm text-slate-500 dark:text-slate-400">View recent alerts and updates for your account.</p>
            </div>
            <div class="rounded-3xl bg-white dark:bg-gray-900 border border-slate-200 dark:border-slate-700 p-6 shadow-sm">
                @if ($notifications->isEmpty())
                    <div class="text-center text-slate-500 dark:text-slate-400">
                        You have no notifications at this time.
                    </div>
                @else
                    <div class="space-y-3">
                        @foreach ($notifications as $notification)
                            <div class="rounded-3xl p-4 border border-slate-200 dark:border-slate-700 bg-slate-50 dark:bg-slate-950">
                                <div class="flex items-start justify-between gap-4">
                                    <div>
                                        <p class="font-semibold text-slate-900 dark:text-slate-100">{{ $notification->type }}</p>
                                        <p class="mt-1 text-sm text-slate-500 dark:text-slate-400">{{ data_get($notification->payload, 'message', 'No details available.') }}</p>
                                    </div>
                                    <div class="text-right">
                                        <p class="text-xs text-slate-400">{{ $notification->created_at->diffForHumans() }}</p>
                                        @if (! $notification->read_at)
                                            <form action="{{ route('student.notifications.read', $notification) }}" method="POST" class="mt-2">
                                                @csrf
                                                <button type="submit" class="rounded-full bg-indigo-600 text-white px-3 py-1 text-xs hover:bg-indigo-700 transition">Mark read</button>
                                            </form>
                                        @else
                                            <span class="rounded-full bg-slate-200 dark:bg-slate-800 px-3 py-1 text-xs text-slate-500">Read</span>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                @endif
            </div>
        </div>
    </div>
</x-student-layout>
