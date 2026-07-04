<x-student-layout>
    <div class="py-12">
        <div class="max-w-6xl mx-auto sm:px-6 lg:px-8 space-y-6">
            <div class="flex flex-col gap-3">
                <div>
                    <h2 class="text-2xl font-semibold text-slate-900 dark:text-slate-100">{{ $topic->title }}</h2>
                    <p class="mt-2 text-sm text-slate-500 dark:text-slate-400">Topic by {{ $topic->author->name }} • {{ $topic->created_at->diffForHumans() }}</p>
                </div>
            </div>
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg p-6">
                <div class="space-y-4">
                    <div class="rounded-3xl border border-slate-200 dark:border-slate-700 bg-slate-50 dark:bg-slate-950 p-4">
                        <p class="text-slate-700 dark:text-slate-200">{{ $topic->title }}</p>
                    </div>

                    @forelse ($topic->posts->where('parent_post_id', null) as $post)
                        <div class="rounded-3xl border border-slate-200 dark:border-slate-700 bg-white dark:bg-slate-900 p-5 shadow-sm">
                            <div class="flex items-start gap-4">
                                <div class="h-11 w-11 rounded-2xl bg-slate-200 dark:bg-slate-800 flex items-center justify-center text-slate-700 dark:text-slate-100 uppercase font-semibold">{{ substr($post->author->name, 0, 1) }}</div>
                                <div class="flex-1">
                                    <div class="flex items-center justify-between gap-4">
                                        <div>
                                            <p class="font-semibold text-slate-900 dark:text-slate-100">{{ $post->author->name }}</p>
                                            <p class="text-sm text-slate-500 dark:text-slate-400">{{ $post->created_at->diffForHumans() }}</p>
                                        </div>
                                    </div>
                                    <p class="mt-4 text-slate-700 dark:text-slate-200">{{ $post->body }}</p>
                                </div>
                            </div>

                            @if ($post->replies->isNotEmpty())
                                <div class="mt-5 space-y-4 pl-12">
                                    @foreach ($post->replies as $reply)
                                        <div class="rounded-3xl border border-slate-200 dark:border-slate-700 bg-slate-50 dark:bg-slate-950 p-4">
                                            <div class="flex items-center justify-between gap-4">
                                                <p class="font-medium text-slate-900 dark:text-slate-100">{{ $reply->author->name }}</p>
                                                <span class="text-xs text-slate-400">{{ $reply->created_at->diffForHumans() }}</span>
                                            </div>
                                            <p class="mt-2 text-slate-600 dark:text-slate-300">{{ $reply->body }}</p>
                                        </div>
                                    @endforeach
                                </div>
                            @endif

                            <form action="{{ route('student.forum.reply', $topic) }}" method="POST" class="mt-5 space-y-3 rounded-3xl bg-slate-50 dark:bg-slate-950 border border-slate-200 dark:border-slate-700 p-4">
                                @csrf
                                <input type="hidden" name="parent_post_id" value="{{ $post->post_id }}">
                                <textarea name="body" rows="3" placeholder="Write a reply..." class="w-full rounded-2xl border border-slate-200 dark:border-slate-700 bg-white dark:bg-slate-900 px-4 py-3 text-slate-900 dark:text-slate-100" required></textarea>
                                <button type="submit" class="rounded-2xl bg-indigo-600 text-white px-5 py-3 hover:bg-indigo-700 transition">Reply</button>
                            </form>
                        </div>
                    @empty
                        <div class="rounded-3xl border border-dashed border-slate-300 dark:border-slate-700 bg-slate-50 dark:bg-slate-950 p-6 text-center text-slate-500 dark:text-slate-400">
                            No posts have been made in this topic yet. Add the first reply below.
                        </div>
                    @endforelse

                    <div class="rounded-3xl border border-slate-200 dark:border-slate-700 bg-slate-50 dark:bg-slate-950 p-6">
                        <form action="{{ route('student.forum.reply', $topic) }}" method="POST" class="space-y-4">
                            @csrf
                            <textarea name="body" rows="4" placeholder="Share your thoughts or ask a question..." class="w-full rounded-2xl border border-slate-200 dark:border-slate-700 bg-white dark:bg-slate-900 px-4 py-3 text-slate-900 dark:text-slate-100" required></textarea>
                            <button type="submit" class="rounded-2xl bg-indigo-600 text-white px-5 py-3 hover:bg-indigo-700 transition">Post Reply</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-student-layout>
