<!DOCTYPE html>
<html>
<head>
    <title>Add Task</title>
    <style>
        body { font-family: Arial, sans-serif; max-width: 500px; margin: 40px auto; padding: 0 20px; }
        input, textarea { width: 100%; padding: 8px; margin-bottom: 12px; box-sizing: border-box; }
        label { font-weight: bold; }
        .btn { padding: 8px 16px; background: #2d6cdf; color: #fff; border: none; border-radius: 4px; cursor: pointer; }
    </style>
</head>
<body>
    <h1>Add Task</h1>

    <form action="{{ route('tasks.store') }}" method="POST">
        @csrf
        <label>Task Name</label>
        <input type="text" name="task_name" value="{{ old('task_name') }}" required>

        <label>Description</label>
        <textarea name="description" rows="3">{{ old('description') }}</textarea>

        <label>Due Date</label>
        <input type="date" name="due_date" value="{{ old('due_date') }}">

        <button class="btn" type="submit">Save Task</button>
    </form>

    @if ($errors->any())
        <ul style="color: red;">
            @foreach ($errors->all() as $error)<li>{{ $error }}</li>@endforeach
        </ul>
    @endif

    <p><a href="{{ route('tasks.index') }}">Back to tasks</a></p>
</body>
</html>