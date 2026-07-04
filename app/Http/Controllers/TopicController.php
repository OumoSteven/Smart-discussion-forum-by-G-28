<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\Topic;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TopicController extends Controller
{
    public function index()
    {
        $groupIds = Auth::user()->groups()->pluck('groups.group_id');

        $topics = Topic::with('author')
            ->whereIn('group_id', $groupIds)
            ->latest('created_at')
            ->paginate(10);

        return view('student.topics.index', compact('topics'));
    }

    public function forum()
    {
        $groupIds = Auth::user()->groups()->pluck('groups.group_id');

        $topics = Topic::with('author')
            ->whereIn('group_id', $groupIds)
            ->latest('created_at')
            ->get();

        return view('student.forum.index', compact('topics'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:200',
            'category' => 'required|string|max:80',
        ]);

       $groupId = Auth::user()->groups()->value('groups.group_id');

        if (! $groupId) {
            return back()->withErrors(['group' => 'You must belong to a group before creating topics.']);
        }

        Topic::create([
            'group_id' => $groupId,
            'created_by' => Auth::id(),
            'title' => $request->title,
            'category' => $request->category,
        ]);

        return back()->with('success', 'Topic created successfully.');
    }

    public function show(Topic $topic)
    {
        $user = Auth::user();
        abort_unless($user->groups()->where('group_id', $topic->group_id)->exists(), 403);

        $topic->load(['posts.author', 'posts.replies.author']);

        return view('student.forum.show', compact('topic'));
    }

    public function storeReply(Request $request, Topic $topic)
    {
        $request->validate([
            'body' => 'required|string',
            'parent_post_id' => 'nullable|exists:posts,post_id',
        ]);

        abort_unless(Auth::user()->groups()->where('group_id', $topic->group_id)->exists(), 403);

        Post::create([
            'topic_id' => $topic->topic_id,
            'author_id' => Auth::id(),
            'parent_post_id' => $request->parent_post_id,
            'body' => $request->body,
        ]);

        return back()->with('success', 'Reply posted successfully.');
    }
}
