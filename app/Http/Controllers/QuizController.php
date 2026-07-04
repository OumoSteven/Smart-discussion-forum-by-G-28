<?php

namespace App\Http\Controllers;

use App\Models\Answer;
use App\Models\Quiz;
use App\Models\QuizAttempt;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class QuizController extends Controller
{
    /**
     * Handles the "Schedule" form. Quiz is created as 'draft' —
     * the lecturer must Publish separately, per SDD 8.3.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'title'      => 'required|string|max:200',
            'group_id'   => 'required|integer|exists:groups,group_id',
            'start_time' => 'required|date',
            'duration'   => 'required|integer|min:5',
        ]);

        Quiz::create([
            'lecturer_id'      => auth()->id(),
            'group_id'         => $validated['group_id'],
            'title'            => $validated['title'],
            'start_at'         => $validated['start_time'],
            'duration_minutes' => $validated['duration'],
            'status'           => 'draft',
        ]);

        return redirect()
            ->route('lecturer.quiz-management')
            ->with('success', 'Quiz scheduled. It now appears under "Pending Quiz and Announcements".');
    }

    /**
     * Publishes a draft quiz. Also accepts optional edit fields, since
     * the Edit page's "Save & Publish" button posts here too.
     */
    public function publish(Request $request, int $id)
    {
        $quiz = Quiz::where('lecturer_id', auth()->id())->findOrFail($id);

        $data = $request->validate([
            'title'      => 'sometimes|string|max:200',
            'group_id'   => 'sometimes|integer|exists:groups,group_id',
            'start_time' => 'sometimes|date',
            'duration'   => 'sometimes|integer|min:5',
        ]);

        if (!empty($data)) {
            $quiz->fill([
                'title'            => $data['title'] ?? $quiz->title,
                'group_id'         => $data['group_id'] ?? $quiz->group_id,
                'start_at'         => $data['start_time'] ?? $quiz->start_at,
                'duration_minutes' => $data['duration'] ?? $quiz->duration_minutes,
            ]);
        }

        $quiz->status = 'open';
        $quiz->save();

        return redirect()
            ->route('lecturer.quiz-management')
            ->with('success', 'Quiz published — students in the group can now see it.');
    }

    public function edit(Request $request, int $id)
    {
        $quiz = Quiz::where('lecturer_id', auth()->id())->findOrFail($id);

        $groups = auth()->user()->groupsCreated()->get(['group_id', 'name'])
            ->map(fn ($g) => ['id' => $g->group_id, 'name' => $g->name])
            ->all();

        return view('lecturer.quiz-edit', [
            'quiz' => [
                'id'         => $quiz->quiz_id,
                'title'      => $quiz->title,
                'group_id'   => $quiz->group_id,
                'start_time' => $quiz->start_at->format('Y-m-d\TH:i'),
                'duration'   => $quiz->duration_minutes,
                'status'     => $quiz->status,
            ],
            'groups' => $groups,
        ]);
    }

    public function index()
    {
        $groupIds = Auth::user()
            ->memberships()
            ->pluck('group_id')
            ->toArray();

        $quizzes = Quiz::whereIn('group_id', $groupIds)
            ->where('status', 'open')
            ->with('group')
            ->orderBy('start_at')
            ->get();

        return view('student.quizzes.index', compact('quizzes'));
    }

    public function start(Quiz $quiz)
    {
        $user = Auth::user();

        abort_unless($user->groups()->where('group_id', $quiz->group_id)->exists(), 403);
        abort_unless($quiz->status === 'open', 403);
        abort_if($quiz->start_at->isFuture(), 403);

        $existingAttempt = QuizAttempt::where('quiz_id', $quiz->quiz_id)
            ->where('user_id', $user->id)
            ->where('status', 'in_progress')
            ->first();

        if ($existingAttempt) {
            return redirect()->route('student.quizzes.attempt', $existingAttempt);
        }

        $attempt = QuizAttempt::create([
            'quiz_id' => $quiz->quiz_id,
            'user_id' => $user->id,
            'started_at' => now(),
            'status' => 'in_progress',
        ]);

        return redirect()
            ->route('student.quizzes.attempt', $attempt)
            ->with('success', 'Quiz started. Complete the questions below.');
    }

    public function attempt(QuizAttempt $attempt)
    {
        abort_unless($attempt->user_id === Auth::id(), 403);

        $quiz = $attempt->quiz()->with('questions')->first();

        return view('student.quizzes.attempt', compact('attempt', 'quiz'));
    }

    public function submitAttempt(Request $request, QuizAttempt $attempt)
    {
        abort_unless($attempt->user_id === Auth::id(), 403);
        abort_unless($attempt->status === 'in_progress', 403);

        $request->validate([
            'answers' => 'required|array',
            'answers.*' => 'nullable|string',
        ]);

        $quiz = $attempt->quiz()->with('questions')->first();
        $answers = $request->input('answers', []);
        $score = 0;

        $attempt->answers()->delete();

        foreach ($quiz->questions as $question) {
            $selected = data_get($answers, $question->question_id);
            $isCorrect = $selected === $question->correct_option;

            Answer::create([
                'attempt_id' => $attempt->attempt_id,
                'question_id' => $question->question_id,
                'selected' => $selected,
                'is_correct' => $isCorrect,
            ]);

            if ($isCorrect) {
                $score += $question->marks;
            }
        }

        $attempt->update([
            'submitted_at' => now(),
            'score' => $score,
            'status' => 'submitted',
        ]);

        return redirect()
            ->route('student.quizzes.attempt', $attempt)
            ->with('success', 'Quiz submitted successfully.');
    }
}