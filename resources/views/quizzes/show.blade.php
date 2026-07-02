<!-- <x-app-layout>
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
</x-app-layout> -->


<x-app-layout>
    {{-- Externalized CSS Sheet Link --}}
    <link rel="stylesheet" href="{{ asset('css/quiz-management.css') }}">

    <style>
        /* Light Mode Overrides */
        .auth-card-container {
            background: #ffffff !important;
            color: #1e293b !important;
            border: 1px solid #e2e8f0 !important;
            box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1) !important;
        }
        .auth-card-container h1,
        .auth-card-container h2,
        .auth-card-container h3,
        .auth-card-container .main-title {
            color: #0f172a !important;
        }
        .auth-card-container p,
        .auth-card-container .sub-title,
        .auth-card-container span,
        .auth-card-container label,
        .auth-card-container div {
            color: #1e293b !important;
        }
        .question-card {
            background: #f8fafc !important;
            border: 1px solid #e2e8f0 !important;
        }
        .question-card h3 {
            color: #0f172a !important;
        }
        .question-card label {
            color: #1e293b !important;
        }
        .question-card label:hover {
            color: #0f172a !important;
        }
        .question-card input[type="radio"] {
            accent-color: #3b82f6;
            width: 18px;
            height: 18px;
        }
        .btn-register-custom {
            background: #3b82f6 !important;
            color: #ffffff !important;
            border: none !important;
        }
        .btn-register-custom:hover {
            background: #2563eb !important;
        }
        a {
            color: #3b82f6 !important;
        }
        a:hover {
            color: #2563eb !important;
        }
        .border-bottom {
            border-bottom: 1px solid #e2e8f0 !important;
        }
    </style>

    <div class="auth-card-container" style="max-width: 800px; margin: 2rem auto; padding: 2.5rem;">
        
        {{-- Quiz Header Info --}}
        <div style="margin-bottom: 2rem; border-bottom: 1px solid #e2e8f0; padding-bottom: 1.5rem;">
            <h1 class="main-title" style="margin-bottom: 0.5rem; font-size: 2rem; font-weight: 700; color: #0f172a !important;">
                {{ $quiz->title }}
            </h1>
            <p class="sub-title" style="margin-bottom: 1rem; font-size: 1rem; color: #475569 !important;">
                {{ $quiz->description ?? __('No instructions provided.') }}
            </p>
            
            <div style="display: flex; gap: 1.5rem; font-size: 0.9rem; color: #64748b !important;">
                <div><strong>Time Allowed:</strong> {{ $quiz->time_limit }} minutes</div>
                <div><strong>Total Questions:</strong> {{ $quiz->questions->count() }}</div>
            </div>
        </div>

        {{-- Quiz Form Sheet --}}
        <form method="POST" action="{{ route('quizzes.submit', $quiz->id) }}" id="submitQuizForm">
            @csrf

            @if($quiz->questions->isEmpty())
                <div style="text-align: center; padding: 2rem; background: #f8fafc; border-radius: 8px; border: 1px solid #e2e8f0;">
                    <p style="color: #64748b; font-size: 1.1rem;">No questions available for this quiz.</p>
                </div>
            @else
                @foreach($quiz->questions as $index => $question)
                    <div class="question-card" style="background: #f8fafc; padding: 1.5rem; border-radius: 8px; margin-bottom: 1.5rem; border: 1px solid #e2e8f0;">
                        <h3 style="font-weight: 600; margin-bottom: 1rem; color: #0f172a !important; font-size: 1.1rem;">
                            Question {{ $index + 1 }}: <span style="font-weight: normal; color: #1e293b;">{{ $question->question_text }}</span>
                        </h3>

                        {{-- Radio Input Choices Block --}}
                        <div style="display: flex; flex-direction: column; gap: 0.75rem; margin-left: 0.5rem;">
                            <label style="display: flex; align-items: center; gap: 0.75rem; cursor: pointer; color: #1e293b !important; padding: 0.5rem; border-radius: 6px; transition: background 0.2s;">
                                <input type="radio" name="answers[{{ $question->id }}]" value="a" required style="accent-color: #3b82f6; width: 18px; height: 18px;">
                                <span>A) {{ $question->option_a }}</span>
                            </label>

                            <label style="display: flex; align-items: center; gap: 0.75rem; cursor: pointer; color: #1e293b !important; padding: 0.5rem; border-radius: 6px; transition: background 0.2s;">
                                <input type="radio" name="answers[{{ $question->id }}]" value="b" style="accent-color: #3b82f6; width: 18px; height: 18px;">
                                <span>B) {{ $question->option_b }}</span>
                            </label>

                            <label style="display: flex; align-items: center; gap: 0.75rem; cursor: pointer; color: #1e293b !important; padding: 0.5rem; border-radius: 6px; transition: background 0.2s;">
                                <input type="radio" name="answers[{{ $question->id }}]" value="c" style="accent-color: #3b82f6; width: 18px; height: 18px;">
                                <span>C) {{ $question->option_c }}</span>
                            </label>

                            <label style="display: flex; align-items: center; gap: 0.75rem; cursor: pointer; color: #1e293b !important; padding: 0.5rem; border-radius: 6px; transition: background 0.2s;">
                                <input type="radio" name="answers[{{ $question->id }}]" value="d" style="accent-color: #3b82f6; width: 18px; height: 18px;">
                                <span>D) {{ $question->option_d }}</span>
                            </label>
                        </div>
                    </div>
                @endforeach
            @endif

            {{-- Submit Form Block --}}
            <div style="margin-top: 2rem; display: flex; justify-content: space-between; align-items: center; padding-top: 1.5rem; border-top: 1px solid #e2e8f0;">
                <a href="{{ route('quizzes.index') }}" style="text-decoration: none; font-size: 0.95rem; color: #3b82f6 !important; font-weight: 500;">
                    &larr; Cancel and return
                </a>
                
                <button type="submit" class="btn-register-custom" style="width: auto; padding: 0.75rem 2rem; background: #3b82f6; color: #ffffff; border: none; border-radius: 8px; font-weight: 600; cursor: pointer; transition: background 0.2s;" onclick="return confirm('Are you sure you want to turn in your answers now?');">
                    {{ __('Submit Assessment') }}
                </button>
            </div>
        </form>

    </div>
</x-app-layout>