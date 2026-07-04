<?php

namespace App\Http\Controllers;

use App\Models\Message;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class MessageController extends Controller
{
  public function index()
{
    $groupIds = Auth::user()
        ->groups()
        ->pluck('groups.group_id')
        ->toArray();

    $messages = Message::with('sender')
        ->whereIn('group_id', $groupIds)
        ->latest('created_at')
        ->paginate(20);

    return view('student.messages.index', compact('messages'));
}

    public function store(Request $request)
    {
        $request->validate(['body' => 'required|string|max:2000']);

        $groupId = Auth::user()->groups()->value('group_id');

        Message::create([
            'group_id' => $groupId,
            'sender_id' => Auth::id(),
            'body' => $request->body,
        ]);

        return back()->with('success', 'Message sent.');
    }
}
