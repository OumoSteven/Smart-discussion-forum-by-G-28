<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Notifications</title>    <link rel="stylesheet" href="{{ asset('css/Lecturer/dashboard.css') }}">
</head>

<body>
<div class="container">

    @include('lecturer.partials.sidebar')

    <div class="main">

        <div class="topbar">
            <div>
                <h1>Notifications</h1>
                <span class="sub">Alerts, warnings, and announcements delivered by the Notification service.</span>
            </div>
        </div>

        <div class="panel">
            @forelse($notifications ?? [] as $note)
                <div class="discussion-item">
                    <div class="dicon" style="background:var(--indigo-soft);color:var(--indigo);"><i class="bi bi-bell"></i></div>
                    <div class="info">
                        <strong>{{ $note['title'] }}</strong>
                        <span>{{ $note['message'] }} · {{ $note['time'] }}</span>
                    </div>
                </div>
            @empty
                <div style="text-align:center; color:var(--muted); padding:32px 0;">
                    <i class="bi bi-bell-slash" style="font-size:24px; display:block; margin-bottom:8px;"></i>
                    You're all caught up — no notifications yet.
                </div>
            @endforelse
        </div>

    </div>

</div>

<script src="{{ asset('js/Lecturer/dashboard.js') }}"></script>
</body>
</html>
