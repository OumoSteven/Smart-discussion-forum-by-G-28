<x-app-layout>
    <link rel="stylesheet" href="{{ asset('css/quiz-management.css') }}">

    <div class="auth-card-container" style="max-width: 900px; margin: 2rem auto;">
        <h1 class="main-title">{{ __('Quiz Performance History') }}</h1>
        <p class="sub-title">{{ __('Review complete grade sheets and submission timestamps') }}</p>

        @if($attempts->isEmpty())
            <div style="text-align: center; padding: 3rem; background: rgba(255, 255, 255, 0.02); border-radius: 8px;">
                <p class="sub-title" style="font-size: 1.1rem;">{{ __('No quiz records found.') }}</p>
            </div>
        @else
            <table style="width: 100%; border-collapse: collapse; margin-top: 1.5rem; color: #fff; text-align: left;">
                <thead>
                    <tr style="border-bottom: 2px solid rgba(255, 255, 255, 0.1); color: #9ca3af;">
                        <th style="padding: 1rem;">{{ __('Student / User') }}</th>
                        <th style="padding: 1rem;">{{ __('Quiz Title') }}</th>
                        <th style="padding: 1rem;">{{ __('Score Obtained') }}</th>
                        <th style="padding: 1rem;">{{ __('Percentage') }}</th>
                        <th style="padding: 1rem;">{{ __('Completed At') }}</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($attempts as $attempt)
                        <tr style="border-bottom: 1px solid rgba(255, 255, 255, 0.05); background: rgba(255, 255, 255, 0.01);">
                            <td style="padding: 1rem;">{{ $attempt->user->username ?? __('Unknown Student') }}</td>
                            <td style="padding: 1rem; font-weight: bold;">{{ $attempt->quiz->title ?? __('Deleted Quiz') }}</td>
                            <td style="padding: 1rem; color: #3b82f6;">
                                {{ $attempt->score }} / {{ $attempt->total_questions }}
                            </td>
                            <td style="padding: 1rem;">
                                @if($attempt->total_questions > 0)
                                    {{ round(($attempt->score / $attempt->total_questions) * 100) }}%
                                @else
                                    0%
                                @endif
                            </td>
                            <td style="padding: 1rem; color: #9ca3af; font-size: 0.9rem;">
                                {{ $attempt->completed_at ? \Carbon\Carbon::parse($attempt->completed_at)->format('M d, Y h:i A') : 'N/A' }}
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        @endif
        
        <div style="margin-top: 2rem;">
            <a href="{{ route('quizzes.index') }}" class="btn-register-custom" style="text-decoration: none; width: auto; padding: 0.5rem 1.5rem; background: #4b5563;">
                {{ __('&larr; Back to Quizzes') }}
            </a>
        </div>
    </div>
</x-app-layout>