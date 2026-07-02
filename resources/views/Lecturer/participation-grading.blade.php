<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Group Participation Grading</title>    <link rel="stylesheet" href="{{ asset('css/Lecturer/dashboard.css') }}">
</head>

<body>
<div class="container">

    @include('lecturer.partials.sidebar')

    <div class="main">

        <div class="topbar">
            <div>
                <h1>Group Participation Grading</h1>
                <span class="sub">Marks and grades computed automatically from each student's posts and replies.</span>
            </div>
            <div class="topbar-right">
                <div class="icon-btn"><i class="bi bi-bell"></i><span class="dot"></span></div>
                <div class="avatar">{{ $lecturerInitials ?? 'AY' }}</div>
            </div>
        </div>

        <div class="panel">
            <div class="panel-head">
                <h2>{{ $students[0]['group'] ?? 'Your Group' }}</h2>
                <span class="panel-subhead" style="margin:0;">{{ count($students ?? []) }} students</span>
            </div>

            <table class="grading-table">
                <thead>
                    <tr>
                        <th>Student</th>
                        <th>Group</th>
                        <th>Posts</th>
                        <th>Replies</th>
                        <th>Participation Mark</th>
                        <th>Grade</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($students ?? [] as $row)
                        <tr>
                            <td>{{ $row['student'] }}</td>
                            <td>{{ $row['group'] }}</td>
                            <td>{{ $row['posts'] }}</td>
                            <td>{{ $row['replies'] }}</td>
                            <td>{{ $row['mark'] }}%</td>
                            <td>
                                @php
                                    $gradeClass = match($row['grade']) {
                                        'A' => 'grade-a',
                                        'B' => 'grade-b',
                                        'C' => 'grade-c',
                                        default => 'grade-f',
                                    };
                                @endphp
                                <span class="grade-pill {{ $gradeClass }}">{{ $row['grade'] }}</span>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6" style="text-align:center; color:var(--muted); padding:24px 0;">
                                No students in this group yet.
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

    </div>

</div>

<script src="{{ asset('js/Lecturer/dashboard.js') }}"></script>
</body>
</html>
