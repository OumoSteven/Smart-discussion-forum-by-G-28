<?php

namespace App\Http\Controllers;

use App\Models\Notification;
use App\Models\ParticipationMark;
use App\Models\Post;
use App\Models\Quiz;
use App\Models\Topic;
use Illuminate\Support\Facades\Auth;

class StudentController extends Controller
{
    public function dashboard()
    {
        $student = Auth::user();
        $groupIds = $student->groups()->pluck('groups.group_id');

        $participationMarks = ParticipationMark::where('user_id', $student->id)->sum('score');
        $currentGrade = $student->participationMarks()->latest('mark_id')->value('score') ?? 'N/A';
        $discussionsJoined = Post::whereIn('topic_id', Topic::whereIn('group_id', $groupIds)->pluck('topic_id'))->distinct('author_id')->count('author_id');
        $topicsCreated = Topic::where('created_by', $student->id)->count();
        $messagesReceived = $student->groups()->withCount('messages')->get()->sum('messages_count');
        $upcomingQuizzes = Quiz::whereIn('group_id', $groupIds)->where('status', 'open')->where('start_at', '>=', now())->count();

        $announcements = Notification::where('user_id', $student->id)->latest('created_at')->limit(3)->get();
        $recommendations = Topic::whereIn('group_id', $groupIds)->latest('created_at')->limit(3)->get();
        $activities = Post::whereIn('topic_id', Topic::whereIn('group_id', $groupIds)->pluck('topic_id'))->latest('created_at')->limit(4)->get();
        $onlineMembers = $student->groups()->with('members')->get()->pluck('members')->flatten()->unique('id')->where('id', '!=', $student->id)->take(4);

        return view('dashboard', compact(
            'participationMarks',
            'currentGrade',
            'discussionsJoined',
            'topicsCreated',
            'messagesReceived',
            'upcomingQuizzes',
            'announcements',
            'recommendations',
            'activities',
            'onlineMembers'
        ));
    }

    public function profile()
    {
        return view('student.profile', ['user' => Auth::user()->load('groups')]);
    }

    public function marks()
    {
        $user = Auth::user();
        $marks = ParticipationMark::where('user_id', $user->id)->get();

        return view('student.marks', compact('marks'));
    }

    public function notifications()
    {
        $user = Auth::user();
        $notifications = Notification::where('user_id', $user->id)->latest('created_at')->get();

        return view('student.notifications', compact('notifications'));
    }

    public function markAsRead(Notification $notification)
    {
        if ($notification->user_id !== Auth::id()) {
            abort(403);
        }

        $notification->update(['read_at' => now()]);

        return back()->with('success', 'Notification marked as read.');
    }
}
