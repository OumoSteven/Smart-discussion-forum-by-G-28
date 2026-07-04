<x-student-layout>
    <div class="py-12">
        <div class="max-w-5xl mx-auto sm:px-6 lg:px-8 space-y-6">
            <div>
                <h2 class="text-2xl font-semibold text-slate-900 dark:text-slate-100">Participation Marks</h2>
                <p class="mt-2 text-sm text-slate-500 dark:text-slate-400">Review your participation and performance summary.</p>
            </div>
            <div class="rounded-3xl bg-white dark:bg-gray-900 border border-slate-200 dark:border-slate-700 p-6 shadow-sm">
                @if ($marks->isEmpty())
                    <div class="text-center text-slate-500 dark:text-slate-400">
                        No participation marks found yet. Engage in discussions to build your score.
                    </div>
                @else
                    <div class="space-y-4">
                        @foreach ($marks as $mark)
                            <div class="rounded-3xl bg-slate-50 dark:bg-slate-950 border border-slate-200 dark:border-slate-800 p-4">
                                <div class="flex items-center justify-between gap-4">
                                    <div>
                                        <p class="text-sm text-slate-500 dark:text-slate-400">{{ ucfirst($mark->criteria) }}</p>
                                        <p class="mt-1 text-lg font-semibold text-slate-900 dark:text-slate-100">Score: {{ $mark->score }}</p>
                                    </div>
                                    <span class="text-sm text-slate-500 dark:text-slate-400">{{ $mark->period ?? 'Recent' }}</span>
                                </div>
                            </div>
                        @endforeach
                    </div>
                @endif
            </div>
        </div>
    </div>
</x-student-layout>
