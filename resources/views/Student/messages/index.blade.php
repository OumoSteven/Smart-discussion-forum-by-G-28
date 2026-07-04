<x-student-layout>
    <div class="py-12">
        <div class="max-w-5xl mx-auto sm:px-6 lg:px-8 space-y-6">
            <div>
                <h2 class="text-2xl font-semibold text-slate-900 dark:text-slate-100">Group Messages</h2>
                <p class="mt-2 text-sm text-slate-500 dark:text-slate-400">Send and read messages for your group.</p>
            </div>
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg p-6">
                <div class="space-y-5">
                    <div class="space-y-3 rounded-3xl border border-slate-200 dark:border-slate-700 bg-slate-50 dark:bg-slate-950 p-5">
                        @forelse ($messages as $message)
                            <div class="rounded-3xl bg-white dark:bg-slate-900 border border-slate-200 dark:border-slate-800 p-4">
                                <div class="flex items-center justify-between gap-3">
                                    <div>
                                        <p class="font-semibold text-slate-900 dark:text-slate-100">{{ $message->sender->name }}</p>
                                        <p class="text-xs text-slate-500 dark:text-slate-400">{{ $message->created_at->format('M d, Y H:i') }}</p>
                                    </div>
                                </div>
                                <p class="mt-3 text-slate-700 dark:text-slate-200">{{ $message->body }}</p>
                            </div>
                        @empty
                            <div class="rounded-3xl border border-dashed border-slate-300 dark:border-slate-700 bg-slate-50 dark:bg-slate-950 p-6 text-center text-slate-500 dark:text-slate-400">
                                No messages yet. Start a conversation with your group.
                            </div>
                        @endforelse
                    </div>

                    <form action="{{ route('messages.store') }}" method="POST" class="rounded-3xl border border-slate-200 dark:border-slate-700 bg-white dark:bg-slate-900 p-5 shadow-sm">
                        @csrf
                        <textarea name="body" rows="4" placeholder="Write a new group message..." class="w-full rounded-2xl border border-slate-200 dark:border-slate-700 bg-slate-50 dark:bg-slate-950 px-4 py-3 text-slate-900 dark:text-slate-100" required></textarea>
                        <button type="submit" class="mt-4 rounded-2xl bg-indigo-600 text-white px-5 py-3 hover:bg-indigo-700 transition">Send Message</button>
                    </form>
                </div>

                <div class="mt-4">{{ $messages->links() }}</div>
            </div>
        </div>
    </div>
</x-student-layout>
