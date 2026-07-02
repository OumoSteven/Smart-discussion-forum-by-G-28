<x-app-layout>
    {{-- Externalized CSS Link matching your system styling layout --}}
    <link rel="stylesheet" href="{{ asset('css/quiz-management.css') }}">

    <div class="auth-card-container" style="max-width: 1000px; margin: 2rem auto;">
        
        {{-- Flash Messaging Alerts --}}
        @if(session('success'))
            <div class="form-status" style="background: rgba(16, 185, 129, 0.2); color: #10b981; margin-bottom: 1.5rem; border-left: 4px solid #10b981;">
                {{ session('success') }}
            </div>
        @endif

        @if(session('error'))
            <div class="form-status" style="background: rgba(239, 68, 68, 0.2); color: #ef4444; margin-bottom: 1.5rem; border-left: 4px solid #ef4444;">
                {{ session('error') }}
            </div>
        @endif

        {{-- Header Actions Block --}}
        <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 2rem;">
            <div>
                <h1 class="main-title" style="margin: 0;">{{ __('Available Academic Quizzes') }}</h1>
                <p class="sub-title" style="margin: 0.25rem 0 0 0;">{{ __('Assessments managed by your course instructors') }}</p>
            </div>
            
            {{-- Quick create link --}}
            <a href="{{ route('quizzes.create') }}" class="btn-register-custom" style="text-decoration: none; text-align: center; width: auto; padding: 0.75rem 1.5rem;">
                {{ __('+ Create New Quiz') }}
            </a>
        </div>

        {{-- Main Assessments List Grid --}}
        @if($quizzes->isEmpty())
            <div style="text-align: center; padding: 3rem; background: rgba(255, 255, 255, 0.02); border-radius: 8px;">
                <p class="sub-title" style="font-size: 1.1rem;">{{ __('No quizzes have been published yet.') }}</p>
            </div>
        @else
            <div style="display: grid; grid-template-columns: repeat(auto-fill, minmax(300px, 1fr)); gap: 1.5rem;">
                @foreach($quizzes as $quiz)
                    <div class="quiz-card" style="background: rgba(255, 255, 255, 0.05); padding: 1.5rem; border-radius: 12px; display: flex; flex-direction: column; justify-content: space-between; border: 1px solid rgba(255, 255, 255, 0.1);">
                        
                        <div>
                            <h3 style="font-size: 1.25rem; font-weight: bold; margin-bottom: 0.5rem; color: #fff;">
                                {{ $quiz->title }}
                            </h3>
                            <p class="sub-title" style="font-size: 0.9rem; margin-bottom: 1rem; min-height: 40px; display: -webkit-box; -webkit-line-clamp: 2; -webkit-box-orient: vertical; overflow: hidden;">
                                {{ $quiz->description ?? __('No description provided.') }}
                            </p>
                            
                            {{-- Metadata attributes --}}
                            <div style="font-size: 0.85rem; color: #9ca3af; margin-bottom: 1.5rem;">
                                <div style="margin-bottom: 0.25rem;">
                                    <strong>{{ __('Duration:') }}</strong> {{ $quiz->time_limit }} {{ __('minutes') }}
                                </div>
                                <div>
                                    <strong>{{ __('Created By:') }}</strong> {{ $quiz->user->username ?? __('Instructor') }}
                                </div>
                            </div>
                        </div>

                        {{-- Action Buttons --}}
                        <div style="display: flex; gap: 0.5rem; align-items: center; margin-top: auto;">
                            <a href="{{ route('quizzes.show', $quiz->id) }}" class="btn-register-custom" style="text-decoration: none; text-align: center; font-size: 0.9rem; padding: 0.5rem 1rem;">
                                {{ __('Attempt Quiz') }}
                            </a>

                            {{-- Conditional Delete option for safety checks --}}
                            @if($quiz->user_id === Auth::id())
                                <form action="{{ route('quizzes.destroy', $quiz->id) }}" method="POST" onsubmit="return confirm('Are you completely sure you want to permanently delete this assessment?');" style="margin: 0;">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn-register-custom" style="background: #ef4444; font-size: 0.9rem; padding: 0.5rem 1rem;">
                                        {{ __('Delete') }}
                                    </button>
                                </form>
                            @endif
                        </div>

                    </div>
                @endforeach
            </div>
        @endif

    </div>
</x-app-layout>