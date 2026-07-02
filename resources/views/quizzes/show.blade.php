<x-app-layout>
    {{-- Externalized CSS Sheet Link matching your standard layout --}}
    <link rel="stylesheet" href="{{ asset('css/quiz-management.css') }}">

    <div class="auth-card-container" style="max-width: 800px; margin: 2rem auto;">
        
        {{-- Quiz Header Info --}}
        <div style="margin-bottom: 2rem; border-bottom: 1px solid rgba(255, 255, 255, 0.1); padding-bottom: 1.5rem;">
            <h1 class="main-title" style="margin-bottom: 0.5rem;">{{ $quiz->title }}</h1>
            <p class="sub-title" style="margin-bottom: 1rem;">{{ $quiz->description ?? __('No instructions provided.') }}</p>
            
            <div style="display: flex; gap: 1.5rem; font-size: 0.9rem; color: #9ca3af;">
                <div><strong>Time Allowed:</strong> {{ $quiz->time_limit }} minutes</div>
                <div><strong>Total Questions:</strong> {{ $quiz->questions->count() }}</div>
            </div>
        </div>

        {{-- Quiz Form Sheet --}}
        <form method="POST" action="{{ route('quizzes.submit', $quiz->id) }}" id="submitQuizForm">
            @csrf

            @foreach($quiz->questions as $index => $question)
                <div class="question-card" style="background: rgba(255, 255, 255, 0.03); padding: 1.5rem; border-radius: 8px; margin-bottom: 1.5rem; border: 1px solid rgba(255, 255, 255, 0.05);">
                    <h3 style="font-weight: bold; margin-bottom: 1rem; color: #fff;">
                        Question {{ $index + 1 }}: <span style="font-weight: normal;">{{ $question->question_text }}</span>
                    </h3>

                    {{-- Radio Input Choices Block --}}
                    <div style="display: flex; flex-direction: column; gap: 0.75rem; margin-left: 0.5rem;">
                        <label style="display: flex; align-items: center; gap: 0.5rem; cursor: pointer; color: #d1d5db;">
                            <input type="radio" name="answers[{{ $question->id }}]" value="a" required style="accent-color: #3b82f6;">
                            <span>A) {{ $question->option_a }}</span>
                        </label>

                        <label style="display: flex; align-items: center; gap: 0.5rem; cursor: pointer; color: #d1d5db;">
                            <input type="radio" name="answers[{{ $question->id }}]" value="b" style="accent-color: #3b82f6;">
                            <span>B) {{ $question->option_b }}</span>
                        </label>

                        <label style="display: flex; align-items: center; gap: 0.5rem; cursor: pointer; color: #d1d5db;">
                            <input type="radio" name="answers[{{ $question->id }}]" value="c" style="accent-color: #3b82f6;">
                            <span>C) {{ $question->option_c }}</span>
                        </label>

                        <label style="display: flex; align-items: center; gap: 0.5rem; cursor: pointer; color: #d1d5db;">
                            <input type="radio" name="answers[{{ $question->id }}]" value="d" style="accent-color: #3b82f6;">
                            <span>D) {{ $question->option_d }}</span>
                        </label>
                    </div>
                </div>
            @endforeach

            {{-- Submit Form Block --}}
            <div style="margin-top: 2rem; display: flex; justify-content: space-between; align-items: center;">
                <a href="{{ route('quizzes.index') }}" class="sub-title" style="text-decoration: none; font-size: 0.95rem;">
                    &larr; Cancel and return
                </a>
                
                <button type="submit" class="btn-register-custom" style="width: auto; padding: 0.75rem 2rem;" onclick="return confirm('Are you sure you want to turn in your answers now?');">
                    {{ __('Submit Assessment') }}
                </button>
            </div>
        </form>

    </div>
</x-app-layout>