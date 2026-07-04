<x-student-layout>
    <div class="py-12">
        <div class="max-w-6xl mx-auto sm:px-6 lg:px-8 space-y-6">
            <div>
                <h2 class="text-2xl font-semibold text-slate-900 dark:text-slate-100">Available Quizzes</h2>
                <p class="mt-2 text-sm text-slate-500 dark:text-slate-400">Browse open quizzes for your group.</p>
            </div>

            <div class="grid gap-6 md:grid-cols-2 xl:grid-cols-3">
                @forelse ($quizzes as $quiz)
                    @php
                        $isUpcoming = $quiz->start_at->isFuture();
                        $badgeLabel = $isUpcoming ? 'Upcoming' : 'Open';
                    @endphp

                    <div class="rounded-[28px] border border-slate-200/80 dark:border-slate-700/80 bg-white dark:bg-slate-900 p-6 shadow-sm hover:shadow-md transition">
                        <div class="flex items-start justify-between gap-4">
                            <div>
                                <h3 class="text-xl font-semibold text-slate-900 dark:text-slate-100">{{ $quiz->title }}</h3>
                                <p class="mt-2 text-sm text-slate-500 dark:text-slate-400">{{ $quiz->description ?: 'No description provided.' }}</p>
                            </div>
                            <span class="inline-flex items-center rounded-full px-3 py-1 text-xs font-semibold uppercase tracking-[0.24em] {{ $isUpcoming ? 'bg-amber-100 text-amber-800 dark:bg-amber-900/20 dark:text-amber-200' : 'bg-emerald-100 text-emerald-800 dark:bg-emerald-900/20 dark:text-emerald-200' }}">
                                {{ $badgeLabel }}
                            </span>
                        </div>

                        <div class="mt-6 space-y-3 text-sm text-slate-600 dark:text-slate-300">
                            <div class="flex items-center gap-2">
                                <span class="inline-flex h-8 w-8 items-center justify-center rounded-2xl bg-slate-100 dark:bg-slate-800 text-slate-600 dark:text-slate-200">⌚</span>
                                <span>Starts {{ $quiz->start_at->format('M d, Y H:i') }}</span>
                            </div>
                            <div class="flex items-center gap-2">
                                <span class="inline-flex h-8 w-8 items-center justify-center rounded-2xl bg-slate-100 dark:bg-slate-800 text-slate-600 dark:text-slate-200">🎯</span>
                                <span>Duration {{ $quiz->duration_minutes }} minutes</span>
                            </div>
                        </div>

                        <div class="mt-6 flex flex-col gap-3 sm:flex-row sm:items-center sm:justify-between">
                            <form action="{{ route('student.quizzes.start', $quiz) }}" method="POST" class="w-full sm:w-auto">
                                @csrf
                                <button type="submit" {{ $isUpcoming ? 'disabled' : '' }} class="w-full rounded-2xl px-5 py-3 text-sm font-semibold text-white transition sm:w-auto {{ $isUpcoming ? 'bg-slate-400 cursor-not-allowed' : 'bg-indigo-600 hover:bg-indigo-700' }}">
                                    {{ $isUpcoming ? 'Starts Soon' : 'Start Quiz' }}
                                </button>
                            </form>
                            <span class="text-xs uppercase tracking-[0.24em] text-slate-500 dark:text-slate-400">Group: {{ $quiz->group?->name ?? 'N/A' }}</span>
                        </div>
                    </div>
                @empty
                    <div class="rounded-3xl border border-dashed border-slate-300 dark:border-slate-700 bg-slate-50 dark:bg-slate-950 p-6 text-center text-slate-500 dark:text-slate-400">
                        There are no open quizzes for your group at the moment.
                    </div>
                @endforelse
            </div>
        </div>
    </div>
</x-student-layout>
