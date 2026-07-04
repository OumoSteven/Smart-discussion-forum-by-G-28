<x-student-layout>
    <div class="py-12">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8 space-y-6">
            <div class="flex flex-col gap-3">
                <div>
                    <h2 class="text-2xl font-semibold text-slate-900 dark:text-slate-100">{{ $quiz->title }}</h2>
                    <p class="mt-2 text-sm text-slate-500 dark:text-slate-400">Started {{ $attempt->started_at->format('M d, Y H:i') }} • Status: {{ ucfirst(str_replace('_', ' ', $attempt->status)) }}</p>
                </div>
                @if ($attempt->status === 'submitted')
                    <div class="rounded-3xl bg-emerald-100 text-emerald-700 px-4 py-2 text-sm font-semibold">Score: {{ $attempt->score }}</div>
                @endif
            </div>

            <div class="rounded-3xl bg-white dark:bg-slate-900 border border-slate-200 dark:border-slate-700 p-6 shadow-sm">
                @if ($attempt->status === 'submitted')
                    <div class="rounded-3xl bg-slate-50 dark:bg-slate-950 border border-slate-200 dark:border-slate-800 p-6">
                        <h3 class="text-lg font-semibold text-slate-900 dark:text-slate-100">Quiz completed</h3>
                        <p class="mt-2 text-sm text-slate-500 dark:text-slate-400">You submitted this quiz on {{ $attempt->submitted_at->format('M d, Y H:i') }}.</p>
                    </div>
                @endif

                <form action="{{ route('student.quizzes.submit', $attempt) }}" method="POST" class="space-y-6">
                    @csrf

                    @foreach ($quiz->questions as $question)
                        <div class="rounded-3xl bg-slate-50 dark:bg-slate-950 border border-slate-200 dark:border-slate-700 p-5">
                            <div class="flex items-center justify-between gap-3">
                                <div>
                                    <p class="text-sm uppercase tracking-[0.2em] text-slate-500 dark:text-slate-400">Question {{ $loop->iteration }}</p>
                                    <p class="mt-2 text-base font-semibold text-slate-900 dark:text-slate-100">{{ $question->text }}</p>
                                </div>
                                <span class="rounded-full bg-indigo-100 text-indigo-700 px-3 py-1 text-xs font-semibold">{{ $question->marks }} pts</span>
                            </div>

                            <div class="mt-4 space-y-3">
                                @foreach ($question->options as $key => $option)
                                    <label class="flex items-start gap-3 rounded-3xl border border-slate-200 dark:border-slate-700 bg-white dark:bg-slate-800 p-4 cursor-pointer hover:border-indigo-300 transition">
                                        <input
                                            type="radio"
                                            name="answers[{{ $question->question_id }}]"
                                            value="{{ $key }}"
                                            @checked(old('answers.'.$question->question_id) === (string) $key)
                                            class="mt-1 h-4 w-4 text-indigo-600 focus:ring-indigo-500"
                                            {{ $attempt->status === 'submitted' ? 'disabled' : '' }}
                                        />
                                        <span class="text-sm text-slate-700 dark:text-slate-200">{{ $option }}</span>
                                    </label>
                                @endforeach
                            </div>
                        </div>
                    @endforeach

                    <div class="flex flex-col gap-3 sm:flex-row sm:items-center sm:justify-between">
                        <p class="text-sm text-slate-500 dark:text-slate-400">Please review your answers before submitting.</p>
                        @if ($attempt->status === 'in_progress')
                            <button type="submit" class="rounded-2xl bg-indigo-600 text-white px-5 py-3 hover:bg-indigo-700 transition">Submit Answers</button>
                        @else
                            <a href="{{ route('student.quizzes.index') }}" class="rounded-2xl bg-slate-100 dark:bg-slate-800 text-slate-700 dark:text-slate-200 px-5 py-3 hover:bg-slate-200 dark:hover:bg-slate-700 transition">Back to Quizzes</a>
                        @endif
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-student-layout>
