<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lecturer Dashboard</title>

    <!-- Bootstrap 5 -->
    <!-- Bootstrap Icons -->
    <!-- Your custom CSS -->
    <link rel="stylesheet" href="{{ asset('css/Lecturer/dashboard.css') }}">
</head>

<body>
<div class="container">

    <!-- ============ SIDEBAR ============ -->
    @include('lecturer.partials.sidebar')

    <!-- ============ MAIN ============ -->
    <div class="main">

        <div class="topbar">
            <div>
                <h1>Welcome back, {{ $lecturerName ?? 'Dr. Amina' }} 👋</h1>
                <span class="sub">Group Participation Grading and Quiz Management, in one place.</span>
            </div>
            <div class="topbar-right">
                <div class="icon-btn"><i class="bi bi-bell"></i><span class="dot"></span></div>
                <div class="avatar">{{ $lecturerInitials ?? 'AY' }}</div>
            </div>
        </div>

        <!-- ============ STAT CARDS ============ -->
        {{-- Figures a lecturer needs at a glance before drilling into either panel below. --}}
        <div class="cards">
            <div class="card">
                <div class="chip indigo"><i class="bi bi-people"></i></div>
                <h3>Students in Group</h3>
                <h2>{{ $totalStudents ?? 42 }}</h2>
                <span class="trend">Across your assigned group</span>
            </div>

            <div class="card">
                <div class="chip teal"><i class="bi bi-bar-chart"></i></div>
                <h3>Avg. Participation Mark</h3>
                <h2>{{ $avgParticipation ?? '78%' }}</h2>
                <span class="trend">Computed from posts & replies</span>
            </div>

            <div class="card">
                <div class="chip amber"><i class="bi bi-clipboard-check"></i></div>
                <h3>Pending Quizzes</h3>
                <h2>{{ $pendingQuizzes ?? 3 }}</h2>
                <span class="trend">Awaiting Publish</span>
            </div>

            <div class="card">
                <div class="chip coral"><i class="bi bi-megaphone"></i></div>
                <h3>Announcements</h3>
                <h2>{{ $announcementCount ?? 5 }}</h2>
                <span class="trend">Sent this term</span>
            </div>
        </div>

        <!-- ============ GROUP PARTICIPATION GRADING ============ -->
        {{--
            SDD 8.3: "the system automatically retrieves each student's post count and reply
            count from the discussion forum database and computes a participation mark and
            corresponding grade based on the student's activity within their assigned group."
        --}}
        <div class="panel" style="margin-bottom:18px;">
            <div class="panel-head">
                <h2>Group Participation Grading</h2>
                <a href="{{ route('lecturer.participation-grading') }}">Open full view</a>
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
                    {{-- @foreach($students as $student) ... @endforeach --}}
                    <tr>
                        <td>Grace Nakato</td>
                        <td>Software Engineering A</td>
                        <td>14</td>
                        <td>22</td>
                        <td>88%</td>
                        <td><span class="grade-pill grade-a">A</span></td>
                    </tr>
                    <tr>
                        <td>Brian Okello</td>
                        <td>Software Engineering A</td>
                        <td>6</td>
                        <td>9</td>
                        <td>61%</td>
                        <td><span class="grade-pill grade-c">C</span></td>
                    </tr>
                    <tr>
                        <td>Faith Nabirye</td>
                        <td>Software Engineering A</td>
                        <td>10</td>
                        <td>17</td>
                        <td>79%</td>
                        <td><span class="grade-pill grade-b">B</span></td>
                    </tr>
                    <tr>
                        <td>Kevin Ssemwogerere</td>
                        <td>Software Engineering A</td>
                        <td>2</td>
                        <td>1</td>
                        <td>24%</td>
                        <td><span class="grade-pill grade-f">F</span></td>
                    </tr>
                </tbody>
            </table>
        </div>

        <!-- ============ QUIZ MANAGEMENT ============ -->
        {{--
            SDD 8.3: lecturer schedules a new quiz via "Schedule" (or "Action" to cancel/modify).
            Scheduled quizzes appear in the "Pending Quiz and Announcements" table, where the
            lecturer can Publish or Edit before it becomes visible to students.
        --}}
        <div class="panel">
            <div class="panel-head">
                <h2>Quiz Management</h2>
                <button type="button" class="btn-schedule" data-bs-toggle="modal" data-bs-target="#scheduleQuizModal">
                    <i class="bi bi-plus-lg"></i> Schedule
                </button>
            </div>

            <span class="panel-subhead">Pending Quiz and Announcements</span>

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
                    {{-- @foreach($pendingQuizzes as $quiz) ... @endforeach --}}
                    <tr>
                        <td>Normalization & ER Modeling</td>
                        <td>Software Engineering A</td>
                        <td>03 Jul 2026, 09:00 AM</td>
                        <td>30 mins</td>
                        <td><span class="status-pill status-draft">Draft</span></td>
                        <td>
                            <form method="POST" action="{{ route('lecturer.quiz.publish', 1) }}" class="inline-form">
                                @csrf
                                <button type="submit" class="btn-mini btn-publish">Publish</button>
                            </form>
                            <a href="{{ route('lecturer.quiz.edit', 1) }}" class="btn-mini btn-edit">Edit</a>
                        </td>
                    </tr>
                    <tr>
                        <td>OSI vs TCP/IP Layers</td>
                        <td>Software Engineering A</td>
                        <td>05 Jul 2026, 02:00 PM</td>
                        <td>20 mins</td>
                        <td><span class="status-pill status-published">Published</span></td>
                        <td>
                            <a href="{{ route('lecturer.quiz.edit', 2) }}" class="btn-mini btn-edit">Edit</a>
                        </td>
                    </tr>
                    <tr>
                        <td>Agile vs Waterfall Debate</td>
                        <td>Software Engineering A</td>
                        <td>10 Jul 2026, 10:30 AM</td>
                        <td>25 mins</td>
                        <td><span class="status-pill status-draft">Draft</span></td>
                        <td>
                            <form method="POST" action="{{ route('lecturer.quiz.publish', 3) }}" class="inline-form">
                                @csrf
                                <button type="submit" class="btn-mini btn-publish">Publish</button>
                            </form>
                            <a href="{{ route('lecturer.quiz.edit', 3) }}" class="btn-mini btn-edit">Edit</a>
                        </td>
                    </tr>
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
                            {{-- @foreach($groups as $group) <option value="{{ $group->id }}">{{ $group->name }}</option> @endforeach --}}
                            <option value="1">Software Engineering A</option>
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
