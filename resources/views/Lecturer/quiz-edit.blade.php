<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Quiz</title>    <link rel="stylesheet" href="{{ asset('css/Lecturer/dashboard.css') }}">
</head>

<body>
<div class="container">

    @include('lecturer.partials.sidebar')

    <div class="main">

        <div class="topbar">
            <div>
                <h1>Edit Quiz</h1>
                <span class="sub">Update the details before publishing.</span>
            </div>
        </div>

        <div class="panel" style="max-width:560px;">
            {{-- TODO: point this at a real update route, e.g. lecturer.quiz.update --}}
            <form method="POST" action="{{ route('lecturer.quiz.publish', $quiz['id']) }}">
                @csrf
                <div class="mb-3">
                    <label class="form-label">Quiz title</label>
                    <input type="text" name="title" class="form-control" value="{{ $quiz['title'] }}" required>
                </div>
                <div class="mb-3">
                    <label class="form-label">Group</label>
                    <select name="group_id" class="form-select" required>
                        @foreach($groups ?? [] as $group)
                            <option value="{{ $group['id'] }}" @selected($group['id'] == $quiz['group_id'])>{{ $group['name'] }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="row">
                    <div class="col-6 mb-3">
                        <label class="form-label">Start time</label>
                        <input type="datetime-local" name="start_time" class="form-control" value="{{ $quiz['start_time'] }}" required>
                    </div>
                    <div class="col-6 mb-3">
                        <label class="form-label">Duration (mins)</label>
                        <input type="number" name="duration" class="form-control" value="{{ $quiz['duration'] }}" min="5" required>
                    </div>
                </div>
                <div style="display:flex; gap:10px; margin-top:8px;">
                    <a href="{{ route('lecturer.quiz-management') }}" class="btn btn-outline-secondary">Action</a>
                    <button type="submit" class="btn-schedule">Save & Publish</button>
                </div>
            </form>
        </div>

    </div>

</div>

<script src="{{ asset('js/Lecturer/dashboard.js') }}"></script>
</body>
</html>
