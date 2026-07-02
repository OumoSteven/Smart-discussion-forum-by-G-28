<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profile</title>    <link rel="stylesheet" href="{{ asset('css/Lecturer/dashboard.css') }}">
</head>

<body>
<div class="container">

    @include('lecturer.partials.sidebar')

    <div class="main">

        <div class="topbar">
            <div>
                <h1>Profile</h1>
                <span class="sub">Your account details.</span>
            </div>
        </div>

        <div class="panel" style="max-width:520px;">
            <div style="display:flex; align-items:center; gap:16px; margin-bottom:24px;">
                <div class="avatar" style="width:60px; height:60px; font-size:20px;">{{ $lecturerInitials ?? 'AY' }}</div>
                <div>
                    <h2 style="font-size:18px;">{{ $lecturer->name ?? $lecturerName ?? 'Lecturer' }}</h2>
                    <span style="color:var(--muted); font-size:13px;">{{ $lecturer->email ?? '—' }}</span>
                </div>
            </div>

            {{-- TODO: point this at a real update route, e.g. lecturer.profile.update --}}
            <form method="POST" action="#">
                @csrf
                <div class="mb-3">
                    <label class="form-label">Full name</label>
                    <input type="text" name="name" class="form-control" value="{{ $lecturer->name ?? '' }}">
                </div>
                <div class="mb-3">
                    <label class="form-label">Email</label>
                    <input type="email" name="email" class="form-control" value="{{ $lecturer->email ?? '' }}">
                </div>
                <div class="mb-3">
                    <label class="form-label">New password</label>
                    <input type="password" name="password" class="form-control" placeholder="Leave blank to keep current password">
                </div>
                <button type="submit" class="btn-schedule">Save changes</button>
            </form>
        </div>

    </div>

</div>

<script src="{{ asset('js/Lecturer/dashboard.js') }}"></script>
</body>
</html>
