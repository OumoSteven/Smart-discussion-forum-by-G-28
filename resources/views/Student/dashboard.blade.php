<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Student Dashboard</title>
    <link rel="stylesheet" href="{{ asset('css/Student/dashboard.css') }}">
</head>

<body>
<div class="container">

    @include('student.partials.sidebar')

    <div class="main">

        <div class="topbar">
            <div>
                <h1>Welcome back, {{ $studentName ?? 'Student' }} 👋</h1>
                <span class="sub">Here's your activity and the latest from your lecturer.</span>
            </div>
            <div class="topbar-right">
                <div class="icon-btn"><i class="bi bi-bell"></i><span class="dot"></span></div>
                <div class="avatar">{{ $studentInitials ?? 'S' }}</div>
            </div>
        </div>

        <div class="panel" style="margin-bottom:18px;">
            <div class="profile-summary">
                <div class="avatar-lg">{{ $studentInitials ?? 'S' }}</div>
                <div class="details">
                    <h2>{{ $studentName ?? 'Student Name' }}</h2>
                    <span>{{ $groupName ?? 'Software Engineering A' }}</span>
                    <span>{{ $studentEmail ?? '—' }}</span>
                </div>
                <div class="mark-badge">
                    <strong>{{ $participationMark ?? '78%' }}</strong>
                    <span>Grade {{ $participationGrade ?? 'B' }}</span>
                </div>
            </div>
        </div>

        <div class="student-grid">

            <div class="panel">
                <div class="panel-head">
                    <h2>Announcements</h2>
                </div>

                @forelse($announcements ?? [] as $a)
                    <div class="announcement-item">
                        <div class="aicon"><i class="bi bi-megaphone"></i></div>
                        <div class="info">
                            <strong>{{ $a['title'] }}</strong>
                            <p>{{ $a['body'] }}</p>
                            <time>{{ $a['posted_at'] }}</time>
                        </div>
                    </div>
                @empty
                    <div style="text-align:center; color:var(--muted); padding:24px 0;">
                        No announcements yet.
                    </div>
                @endforelse
            </div>

            <div class="panel">
                <div class="panel-head">
                    <h2>Upcoming Quizzes</h2>
                    <a href="{{ route('student.quizzes') }}">View all</a>
                </div>

                @forelse(($quizzes ?? []) as $quiz)
                    <div class="quiz-item">
                        <div class="qicon"><i class="bi bi-clipboard-check"></i></div>
                        <div class="info">
                            <strong>{{ $quiz['title'] }}</strong>
                            <span>{{ $quiz['start_time'] }} · {{ $quiz['duration'] }}</span>
                        </div>
                        <a href="{{ route('student.quizzes') }}" class="btn-take-quiz">View</a>
                    </div>
                @empty
                    <div style="text-align:center; color:var(--muted); padding:24px 0;">
                        No quizzes scheduled yet.
                    </div>
                @endforelse
            </div>

        </div>

    </div>

</div>

<script src="{{ asset('js/Student/dashboard.js') }}"></script>
</body>
</html>