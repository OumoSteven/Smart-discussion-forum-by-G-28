<?php


namespace App\Http\Controllers;

use App\Models\Quiz;
use App\Models\Question;
use App\Models\StudentQuiz;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class QuizController extends Controller
{
    // Lists all quizzes
    public function index()
    {
        $quizzes = Quiz::with('user')->latest()->get();
        return view('quizzes.index', compact('quizzes'));
    }

    // Displays the visual form to create a quiz
    public function create()
    {
        return view('quizzes.create');
    }

    // Processes form data and stores quiz + multiple questions dynamically
    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'time_limit' => 'required|integer|min:1',
            'questions' => 'required|array|min:1',
            'questions.*.text' => 'required|string',
            'questions.*.a' => 'required|string',
            'questions.*.b' => 'required|string',
            'questions.*.c' => 'required|string',
            'questions.*.d' => 'required|string',
            'questions.*.correct' => 'required|string|in:a,b,c,d',
        ]);

        $quiz = Quiz::create([
            'title' => $validated['title'],
            'description' => $validated['description'],
            'time_limit' => $validated['time_limit'],
            'user_id' => Auth::id(),
        ]);

        foreach ($validated['questions'] as $qData) {
            $quiz->questions()->create([
                'question_text' => $qData['text'],
                'option_a' => $qData['a'],
                'option_b' => $qData['b'],
                'option_c' => $qData['c'],
                'option_d' => $qData['d'],
                'correct_option' => $qData['correct'],
            ]);
        }

        return redirect()->route('quizzes.index')->with('success', 'Quiz created successfully!');
    }

    // Displays a specific questionnaire sheet to a student
    public function show($id)
    {
        $quiz = Quiz::with('questions')->findOrFail($id);
        return view('quizzes.show', compact('quiz'));
    }

    // Automatically grades the submission choices
    public function submit(Request $request, $id)
    {
        $quiz = Quiz::with('questions')->findOrFail($id);
        $userAnswers = $request->input('answers', []);
        
        $score = 0;
        $totalQuestions = $quiz->questions->count();

        foreach ($quiz->questions as $question) {
            if (isset($userAnswers[$question->id]) && $userAnswers[$question->id] === $question->correct_option) {
                $score++;
            }
        }

        StudentQuiz::create([
            'user_id' => Auth::id(),
            'quiz_id' => $quiz->id,
            'score' => $score,
            'total_questions' => $totalQuestions,
            'completed_at' => now(),
        ]);

        return redirect()->route('quizzes.index')->with('success', "Quiz submitted! You scored {$score} out of {$totalQuestions}.");
    }

    // Pulls historical score matrices for grading insights
    public function history()
    {
        $attempts = StudentQuiz::with(['user', 'quiz'])->latest('completed_at')->get();
        return view('quizzes.history', compact('attempts'));
    }

    // Deletes an evaluation entirely
    public function destroy($id)
    {
        $quiz = Quiz::findOrFail($id);
        
        if ($quiz->user_id !== Auth::id()) {
            return redirect()->back()->with('error', 'Unauthorized action.');
        }

        $quiz->delete(); 
        return redirect()->route('quizzes.index')->with('success', 'Quiz deleted successfully.');
    }
}