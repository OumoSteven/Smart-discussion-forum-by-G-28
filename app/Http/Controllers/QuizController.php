<?php

namespace App\Http\Controllers;

use App\Models\Quiz;
use Illuminate\Http\Request;

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
}