<x-student-layout>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
            <div>
                <h2 class="text-2xl font-semibold text-slate-900 dark:text-slate-100">Forum Topics</h2>
                <p class="mt-2 text-sm text-slate-500 dark:text-slate-400">Explore current discussions within your group.</p>
            </div>
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg p-6">
                <div class="grid gap-4">
                    @forelse ($topics as $topic)
                        <a href="{{ route('student.forum.show', $topic) }}" class="rounded-3xl border border-slate-200 dark:border-slate-700 bg-slate-50 dark:bg-slate-950 p-5 hover:bg-slate-100 dark:hover:bg-slate-900 transition">
                            <div class="flex items-center justify-between gap-4">
                                <div>
                                    <h3 class="text-lg font-semibold text-slate-900 dark:text-slate-100">{{ $topic->title }}</h3>
                                    <p class="mt-2 text-sm text-slate-500 dark:text-slate-400">{{ $topic->posts()->count() }} posts</p>
                                </div>
                                <span class="rounded-full bg-slate-100 dark:bg-slate-800 px-3 py-1 text-xs text-slate-600 dark:text-slate-300">{{ $topic->category ?? 'General' }}</span>
                            </div>
                        </a>
                    @empty
                        <div class="rounded-3xl border border-dashed border-slate-300 dark:border-slate-700 bg-slate-50 dark:bg-slate-950 p-6 text-center text-slate-500 dark:text-slate-400">
                            No forum topics are available yet. Check the topics page or create one.
                        </div>
                    @endforelse
                </div>
            </div>
        </div>
    </div>
</x-student-layout>
