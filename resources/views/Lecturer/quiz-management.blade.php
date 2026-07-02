<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Quiz Management</title>

    <link rel="stylesheet" href="{{ asset('css/Lecturer/dashboard.css') }}">
</head>

<body>
<div class="container">

    @include('lecturer.partials.sidebar')

    <div class="main">

        <div class="topbar">
            <div>
                <h1>Quiz Management</h1>
                <span class="sub">Schedule quizzes, then Publish or Edit them before students see them.</span>
            </div>
            <div class="topbar-right">
                <div class="icon-btn"><i class="bi bi-bell"></i><span class="dot"></span></div>
                <div class="avatar">{{ $lecturerInitials ?? 'AY' }}</div>
            </div>
        </div>

        @if(session('success'))
            <div class="alert alert-success" style="border-radius:12px; margin-bottom:18px;">{{ session('success') }}</div>
        @endif

        <div class="panel">
            <div class="panel-head">
                <h2>Pending Quiz and Announcements</h2>
                <button type="button" class="btn-schedule" data-bs-toggle="modal" data-bs-target="#scheduleQuizModal">
                    <i class="bi bi-plus-lg"></i> Schedule
                </button>
            </div>

            <table class="grading-table">
                <thead>
                    <tr>
                        <th>Title</th>
                        <th>Group</th>
                        <th>Start Time</th>
                        <th>Duration</th>
                        <th>Status</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($quizzes ?? [] as $quiz)
                        <tr>
                            <td>{{ $quiz['title'] }}</td>
                            <td>{{ $quiz['group'] }}</td>
                            <td>{{ $quiz['start_time'] }}</td>
                            <td>{{ $quiz['duration'] }}</td>
                            <td>
                               <span class="status-pill {{ $quiz['status'] !== 'draft' ? 'status-published' : 'status-draft' }}">
                                    {{ $quiz['status'] === 'draft' ? 'Draft' : 'Published' }}
                                </span>
                                    </td>
                                    <td>
                                    @if($quiz['status'] === 'draft')
                                    <form method="POST" action="{{ route('lecturer.quiz.publish', $quiz['id']) }}" class="inline-form">
                                        @csrf
                                        <button type="submit" class="btn-mini btn-publish">Publish</button>
                                    </form>
                                @endif
                                <a href="{{ route('lecturer.quiz.edit', $quiz['id']) }}" class="btn-mini btn-edit">Edit</a>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6" style="text-align:center; color:var(--muted); padding:24px 0;">
                                No quizzes scheduled yet. Click "Schedule" to add one.
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

    </div>

</div>

<!-- ============ SCHEDULE QUIZ MODAL ============ -->
<div class="modal fade" id="scheduleQuizModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <form method="POST" action="{{ route('lecturer.quiz.store') }}">
                @csrf
                <div class="modal-header">
                    <h5 class="modal-title">Schedule a Quiz</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    <div class="mb-3">
                        <label class="form-label">Quiz title</label>
                        <input type="text" name="title" class="form-control" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Group</label>
                        <select name="group_id" class="form-select" required>
                            @foreach($groups ?? [] as $group)
                                <option value="{{ $group['id'] }}">{{ $group['name'] }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="row">
                        <div class="col-6 mb-3">
                            <label class="form-label">Start time</label>
                            <input type="datetime-local" name="start_time" class="form-control" required>
                        </div>
                        <div class="col-6 mb-3">
                            <label class="form-label">Duration (mins)</label>
                            <input type="number" name="duration" class="form-control" min="5" required>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">Action</button>
                    <button type="submit" class="btn-schedule">Schedule</button>
                </div>
            </form>
        </div>
    </div>
</div>

<script src="{{ asset('js/Lecturer/dashboard.js') }}"></script>
</body>
</html>
