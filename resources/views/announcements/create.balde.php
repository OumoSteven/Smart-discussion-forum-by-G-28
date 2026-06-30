<x-app-layout>

    <h1>Create Announcement</h1>

    <form method="POST" action="{{ route('announcements.store') }}">
        @csrf

        <input type="text" name="title" placeholder="Title"><br><br>

        <textarea name="message" placeholder="Message"></textarea><br><br>

        <button type="submit">Post</button>
    </form>

</x-app-layout>