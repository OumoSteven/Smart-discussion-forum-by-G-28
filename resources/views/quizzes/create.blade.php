<x-app-layout>
    {{-- Externalized CSS Sheet Link matching your standard layout --}}
    <link rel="stylesheet" href="{{ asset('css/quiz-management.css') }}">

    <div class="auth-card-container">
        <h1 class="main-title">{{ __('Create a New Quiz') }}</h1>
        <p class="sub-title">{{ __('Set up your quiz details and add questions below') }}</p>

        <form method="POST" action="{{ route('quizzes.store') }}" id="quizForm">
            @csrf

            {{-- Quiz Metadata Section --}}
            <div class="form-group-custom">
                <label for="title" class="label-custom">{{ __('Quiz Title:') }}</label>
                <input id="title" type="text" name="title" value="{{ old('title') }}" required class="input-custom" placeholder="e.g., Midterm Exam" />
                @error('title') <p class="warning-text">{{ $message }}</p> @enderror
            </div>

            <div class="form-group-custom">
                <label for="description" class="label-custom">{{ __('Description / Instructions:') }}</label>
                <textarea id="description" name="description" class="input-custom" rows="3" placeholder="Provide general guidelines for the students...">{{ old('description') }}</textarea>
                @error('description') <p class="warning-text">{{ $message }}</p> @enderror
            </div>

            <div class="form-group-custom">
                <label for="time_limit" class="label-custom">{{ __('Time Limit (Minutes):') }}</label>
                <input id="time_limit" type="number" name="time_limit" value="{{ old('time_limit') }}" required min="1" class="input-custom" placeholder="e.g., 30" />
                @error('time_limit') <p class="warning-text">{{ $message }}</p> @enderror
            </div>

            <hr style="border: 0; border-top: 1px solid #e5e7eb; margin: 2rem 0;">

            {{-- Dynamic Questions Wrapper --}}
            <h2 class="main-title" style="font-size: 1.5rem; margin-bottom: 1rem;">{{ __('Questions') }}</h2>
            <div id="questionsContainer">
                {{-- Initial Question Block --}}
                <div class="question-block" style="background: rgba(255, 255, 255, 0.05); padding: 1.5rem; border-radius: 8px; margin-bottom: 1.5rem;">
                    <h3 style="margin-bottom: 1rem; font-weight: bold;">Question #1</h3>
                    
                    <div class="form-group-custom">
                        <label class="label-custom">Question Text:</label>
                        <input type="text" name="questions[0][text]" required class="input-custom" />
                    </div>

                    <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 1rem; margin-top: 1rem;">
                        <div class="form-group-custom">
                            <label class="label-custom">Option A:</label>
                            <input type="text" name="questions[0][a]" required class="input-custom" />
                        </div>
                        <div class="form-group-custom">
                            <label class="label-custom">Option B:</label>
                            <input type="text" name="questions[0][b]" required class="input-custom" />
                        </div>
                        <div class="form-group-custom">
                            <label class="label-custom">Option C:</label>
                            <input type="text" name="questions[0][c]" required class="input-custom" />
                        </div>
                        <div class="form-group-custom">
                            <label class="label-custom">Option D:</label>
                            <input type="text" name="questions[0][d]" required class="input-custom" />
                        </div>
                    </div>

                    <div class="form-group-custom" style="margin-top: 1rem;">
                        <label class="label-custom">Correct Answer Option:</label>
                        <select name="questions[0][correct]" required class="input-custom select-custom">
                            <option value="a">Option A</option>
                            <option value="b">Option B</option>
                            <option value="c">Option C</option>
                            <option value="d">Option D</option>
                        </select>
                    </div>
                </div>
            </div>

            {{-- Controls Section --}}
            <div style="display: flex; gap: 1rem; margin-top: 1.5rem;">
                <button type="button" id="addQuestionBtn" class="btn-register-custom" style="background: #4b5563;">
                    {{ __('+ Add Another Question') }}
                </button>
                <button type="submit" class="btn-register-custom">
                    {{ __('Save Quiz Entirely') }}
                </button>
            </div>
        </form>
    </div>

    {{-- Interactive Array Indexing Logic --}}
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            let questionIndex = 1;
            const container = document.getElementById('questionsContainer');
            const addBtn = document.getElementById('addQuestionBtn');

            addBtn.addEventListener('click', function() {
                const block = document.createElement('div');
                block.className = 'question-block';
                block.style.cssText = 'background: rgba(255, 255, 255, 0.05); padding: 1.5rem; border-radius: 8px; margin-bottom: 1.5rem;';
                
                block.innerHTML = `
                    <h3 style="margin-bottom: 1rem; font-weight: bold;">Question #${questionIndex + 1}</h3>
                    <div class="form-group-custom">
                        <label class="label-custom">Question Text:</label>
                        <input type="text" name="questions[${questionIndex}][text]" required class="input-custom" />
                    </div>
                    <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 1rem; margin-top: 1rem;">
                        <div class="form-group-custom">
                            <label class="label-custom">Option A:</label>
                            <input type="text" name="questions[${questionIndex}][a]" required class="input-custom" />
                        </div>
                        <div class="form-group-custom">
                            <label class="label-custom">Option B:</label>
                            <input type="text" name="questions[${questionIndex}][b]" required class="input-custom" />
                        </div>
                        <div class="form-group-custom">
                            <label class="label-custom">Option C:</label>
                            <input type="text" name="questions[${questionIndex}][c]" required class="input-custom" />
                        </div>
                        <div class="form-group-custom">
                            <label class="label-custom">Option D:</label>
                            <input type="text" name="questions[${questionIndex}][d]" required class="input-custom" />
                        </div>
                    </div>
                    <div class="form-group-custom" style="margin-top: 1rem;">
                        <label class="label-custom">Correct Answer Option:</label>
                        <select name="questions[${questionIndex}][correct]" required class="input-custom select-custom">
                            <option value="a">Option A</option>
                            <option value="b">Option B</option>
                            <option value="c">Option C</option>
                            <option value="d">Option D</option>
                        </select>
                    </div>
                `;
                container.appendChild(block);
                questionIndex++;
            });
        });
    </script>
</x-app-layout>