<x-student-layout>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
            <div>
                <h2 class="text-2xl font-semibold text-slate-900 dark:text-slate-100">Discussion Topics</h2>
                <p class="mt-2 text-sm text-slate-500 dark:text-slate-400">Create and browse group discussion topics.</p>
            </div>
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg p-6">
                <div class="flex flex-col gap-4">
                    <form method="POST" action="{{ route('topics.store') }}" class="grid gap-4 md:grid-cols-[1.6fr_0.9fr_0.5fr]">
                        @csrf
                        <input name="title" type="text" placeholder="Topic title" class="rounded-2xl border border-slate-200 dark:border-slate-700 bg-slate-50 dark:bg-slate-900 px-4 py-3 text-slate-900 dark:text-slate-100" required>
                        <input name="category" type="text" placeholder="Category" class="rounded-2xl border border-slate-200 dark:border-slate-700 bg-slate-50 dark:bg-slate-900 px-4 py-3 text-slate-900 dark:text-slate-100" required>
                        <button type="submit" class="rounded-2xl bg-indigo-600 text-white px-5 py-3 hover:bg-indigo-700 transition">Create Topic</button>
                    </form>

                    <div class="grid gap-4">
                        @forelse ($topics as $topic)
                            <a href="{{ route('student.forum.show', $topic) }}" class="rounded-3xl border border-slate-200 dark:border-slate-700 bg-slate-50 dark:bg-slate-950 p-5 hover:shadow-lg transition">
                                <div class="flex items-center justify-between gap-4">
                                    <div>
                                        <h3 class="text-lg font-semibold text-slate-900 dark:text-slate-100">{{ $topic->title }}</h3>
                                        <p class="mt-2 text-sm text-slate-500 dark:text-slate-400">Created by {{ $topic->author->name }}</p>
                                    </div>
                                    <span class="rounded-full bg-indigo-100 text-indigo-700 px-3 py-1 text-xs font-semibold">{{ $topic->category ?? 'General' }}</span>
                                </div>
                            </a>
                        @empty
                            <div class="rounded-3xl border border-dashed border-slate-300 dark:border-slate-700 bg-slate-50 dark:bg-slate-950 p-6 text-center text-slate-500 dark:text-slate-400">
                                No topics found. Create your first discussion topic to get started.
                            </div>
                        @endforelse
                    </div>

                    <div class="pt-4">{{ $topics->links() }}</div>
                </div>
            </div>
        </div>
    </div>
</x-student-layout>
