<?php

namespace App\Http\Controllers;

use App\Models\Membership;
use App\Models\Notification;
use App\Models\Post;
use App\Models\Quiz;
use Illuminate\Http\Request;

class LecturerController extends Controller
{
    /**
     * Resolves the lecturer's primary group.
     * NOTE: assumes one group per lecturer for now, per SDD 8.3's
     * "their assigned group" wording. Extend to multi-group later if needed.
     */
    private function currentGroup()
    {
        return auth()->user()->groupsCreated()->first();
    }

    public function dashboard(Request $request)
    {
        $lecturer = auth()->user();
        $group = $this->currentGroup();

        $totalStudents = $group
            ? Membership::where('group_id', $group->group_id)->where('status', 'active')->count()
            : 0;

        $avgParticipation = $group
            ? round($this->participationRows($group)->avg('mark')) . '%'
            : '0%';

        $pendingQuizzes = $group
            ? Quiz::where('group_id', $group->group_id)->where('status', 'draft')->count()
            : 0;

        $announcementCount = Notification::where('user_id', $lecturer->id)
            ->where('type', 'announcement')
            ->count();

        return view('lecturer.dashboard', [
            'lecturerName'      => $lecturer->name,
            'lecturerInitials'  => $this->initials($lecturer->name),
            'totalStudents'     => $totalStudents,
            'avgParticipation'  => $avgParticipation,
            'pendingQuizzes'    => $pendingQuizzes,
            'announcementCount' => $announcementCount,
        ]);
    }

    /**
     * SDD 8.3: computes each student's participation mark and grade
     * from their post/reply counts within the group.
     */
    public function participationGrading(Request $request)
    {
        $lecturer = auth()->user();
        $group = $this->currentGroup();

        $students = $group ? $this->participationRows($group)->values()->all() : [];

        return view('lecturer.participation-grading', [
            'lecturerName'     => $lecturer->name,
            'lecturerInitials' => $this->initials($lecturer->name),
            'students'         => $students,
        ]);
    }

    /**
     * Builds the participation table for a group: posts, replies,
     * mark (posts*5 + replies*3, capped at 100), and letter grade.
     */
    private function participationRows($group)
    {
        return Membership::where('group_id', $group->group_id)
            ->where('status', 'active')
            ->with('user')
            ->get()
            ->map(function ($membership) use ($group) {
                $userId = $membership->user_id;

                $posts = Post::where('author_id', $userId)
                    ->whereNull('parent_post_id')
                    ->whereHas('topic', fn ($q) => $q->where('group_id', $group->group_id))
                    ->count();

                $replies = Post::where('author_id', $userId)
                    ->whereNotNull('parent_post_id')
                    ->whereHas('topic', fn ($q) => $q->where('group_id', $group->group_id))
                    ->count();

                $mark = min(100, ($posts * 5) + ($replies * 3));
                $grade = match (true) {
                    $mark >= 80 => 'A',
                    $mark >= 70 => 'B',
                    $mark >= 60 => 'C',
                    $mark >= 50 => 'D',
                    default     => 'F',
                };

                return [
                    'student' => $membership->user->name,
                    'group'   => $group->name,
                    'posts'   => $posts,
                    'replies' => $replies,
                    'mark'    => $mark,
                    'grade'   => $grade,
                ];
            });
    }

    public function quizManagement(Request $request)
    {
        $lecturer = auth()->user();
        $group = $this->currentGroup();

        $quizzes = $group
            ? Quiz::where('group_id', $group->group_id)
                ->orderByDesc('start_at')
                ->get()
                ->map(fn ($q) => [
                    'id'         => $q->quiz_id,
                    'title'      => $q->title,
                    'group'      => $q->group->name,
                    'start_time' => $q->start_at->format('d M Y, h:i A'),
                    'duration'   => $q->duration_minutes . ' mins',
                    'status'     => $q->status,
                ])
                ->all()
            : [];

        $groups = auth()->user()->groupsCreated()->get(['group_id', 'name'])
            ->map(fn ($g) => ['id' => $g->group_id, 'name' => $g->name])
            ->all();

        return view('lecturer.quiz-management', [
            'lecturerName'     => $lecturer->name,
            'lecturerInitials' => $this->initials($lecturer->name),
            'quizzes'          => $quizzes,
            'groups'           => $groups,
        ]);
    }

    public function notifications(Request $request)
    {
        $lecturer = auth()->user();

        $notifications = Notification::where('user_id', $lecturer->id)
            ->latest('created_at')
            ->get()
            ->map(fn ($n) => [
                'title'   => ucfirst(str_replace('_', ' ', $n->type)),
                'message' => $n->payload['message'] ?? '',
                'time'    => $n->created_at->diffForHumans(),
            ])
            ->all();

        return view('lecturer.notifications', [
            'lecturerName'     => $lecturer->name,
            'lecturerInitials' => $this->initials($lecturer->name),
            'notifications'    => $notifications,
        ]);
    }

    public function profile(Request $request)
    {
        $lecturer = auth()->user();

        return view('lecturer.profile', [
            'lecturerName'     => $lecturer->name,
            'lecturerInitials' => $this->initials($lecturer->name),
            'lecturer'         => $lecturer,
        ]);
    }

    private function initials(string $name): string
    {
        $parts = array_filter(explode(' ', trim($name)));
        $initials = array_map(fn ($p) => mb_strtoupper(mb_substr($p, 0, 1)), $parts);

        return implode('', array_slice($initials, 0, 2)) ?: 'L';
    }
}