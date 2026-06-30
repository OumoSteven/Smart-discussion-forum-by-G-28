<!-- <x-app-layout>
    <x-slot>
        <h2>
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div >
        <div>
            <div >
                <div>
                    {{ __("You're logged in!") }}
                </div>
            </div>
        </div>
    </div>

    <div class="messages-card">
    <div class="card-header">
        <h2>💬 Messages</h2>
    </div>

    <div class="message-item">
        <div class="avatar">👤</div>
        <div>
            <h4>Namuwendo Judith</h4>
            <p>Hello!</p>
            <small>2 hrs ago</small>
        </div>
    </div>

    <div class="message-item">
        <div class="avatar">👤</div>
        <div>
            <h4>Bukenya Daniel</h4>
            <p>Have you done the task?</p>
            <small>2 hrs ago</small>
        </div>
    </div>

    <div class="message-item">
        <div class="avatar">👤</div>
        <div>
            <h4>Nalubwama Joan</h4>
            <p>Come for the discussion</p>
            <small>2 hrs ago</small>
        </div>
    </div>

    <div class="view-all">
        <a href="{{ route('messages.index') }}">
            View All Messages →
        </a>
    </div>
</div>
</x-app-layout> -->


<x-app-layout>

    <div class="dashboard-container">

        <div class="messages-card">
            <div class="card-header">
                <h2>💬 Messages</h2>
            </div>

            <div class="message-item">
                <div class="avatar">👤</div>
                <div class="message-content">
                    <h4>Namuwendo Judith</h4>
                    <p>Hello!</p>
                    <small>2 hrs ago</small>
                </div>
            </div>

            <div class="message-item">
                <div class="avatar">👤</div>
                <div class="message-content">
                    <h4>Bukenya Daniel</h4>
                    <p>Have you done the task?</p>
                    <small>2 hrs ago</small>
                </div>
            </div>

            <div class="message-item">
                <div class="avatar">👤</div>
                <div class="message-content">
                    <h4>Nalubwama Joan</h4>
                    <p>Come for the discussion</p>
                    <small>2 hrs ago</small>
                </div>
            </div>

            <div class="view-all">
                <a href="#">View All Messages →</a>
            </div>
        </div>

    </div>
<!-- topic -->
 <div class="topics-card">

    <div class="topics-header">
        <h2>📚 Topics</h2>
    </div>

    <div class="topic-item">
        <h4>Introduction to Laravel</h4>
        <p>Learn Laravel basics and MVC architecture.</p>
    </div>

    <div class="topic-item">
        <h4>Database Design</h4>
        <p>Creating tables and relationships.</p>
    </div>

    <div class="topic-item">
        <h4>Web Security</h4>
        <p>Authentication and authorization concepts.</p>
    </div>

    <div class="view-all">
        <a href="{{ route('topics.index') }}">
            View All Topics →
        </a>
    </div>

</div>

<!-- announcements -->
<div class="announcements-card">

    <div class="card-header">
        <h2>📢 Announcements</h2>
    </div>

    <div class="announcement-item">
        <h4>Exam Timetable Released</h4>
        <p>The semester exams will start next week. Check your timetable.</p>
        <small>Admin • 1 day ago</small>
    </div>

    <div class="announcement-item">
        <h4>Project Submission</h4>
        <p>All students must submit their projects before Friday.</p>
        <small>Lecturer • 2 days ago</small>
    </div>

    <div class="announcement-item">
        <h4>System Maintenance</h4>
        <p>The system will be down on Sunday for updates.</p>
        <small>ICT Office • 3 days ago</small>
    </div>

    <div class="view-all">
        <a href="{{ route('announcements.index') }}"
        >View All Announcements →</a>
    </div>

</div>



</x-app-layout>