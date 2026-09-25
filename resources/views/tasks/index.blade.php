<!DOCTYPE html>
<html>
<head>
    <title>My Tasks</title>
    <style>
        body { font-family: Arial, sans-serif; max-width: 800px; margin: 40px auto; padding: 0 20px; }
        table { width: 100%; border-collapse: collapse; margin-top: 20px; }
        th, td { text-align: left; padding: 10px; border-bottom: 1px solid #ddd; }
        .btn { padding: 6px 12px; border-radius: 4px; text-decoration: none; color: #fff; font-size: 14px; margin-right: 4px; border: none; cursor: pointer; }
        .btn-add { background: #2d6cdf; }
        .btn-edit { background: #f0ad4e; }
        .btn-delete { background: #d9534f; }
        .btn-status { background: #5cb85c; }
        .pending { color: #d9534f; font-weight: bold; }
        .completed { color: #5cb85c; font-weight: bold; }
    </style>
</head>
<body>
    <h1>My Tasks</h1>

    @if (session('success'))
        <p style="color: green;">{{ session('success') }}</p>
    @endif

    <a class="btn btn-add" href="{{ route('tasks.create') }}">+ Add Task</a>

    <table>
        <tr>
            <th>Task</th><th>Description</th><th>Due Date</th><th>Status</th><th>Actions</th>
        </tr>
        @forelse ($tasks as $task)
            <tr>
                <td>{{ $task->task_name }}</td>
                <td>{{ $task->description }}</td>
                <td>{{ $task->due_date?->format('M d, Y') }}</td>
                <td class="{{ strtolower($task->status) }}">{{ $task->status }}</td>
                <td>
                    <a class="btn btn-edit" href="{{ route('tasks.edit', $task) }}">Edit</a>

                    <form action="{{ route('tasks.status', $task) }}" method="POST" style="display:inline;">
                        @csrf @method('PATCH')
                        <button class="btn btn-status">Mark {{ $task->status === 'Pending' ? 'Completed' : 'Pending' }}</button>
                    </form>

                    <form action="{{ route('tasks.destroy', $task) }}" method="POST" style="display:inline;" onsubmit="return confirm('Delete this task?');">
                        @csrf @method('DELETE')
                        <button class="btn btn-delete">Delete</button>
                    </form>
                </td>
            </tr>
        @empty
            <tr><td colspan="5">No tasks yet.</td></tr>
        @endforelse
    </table>
</body>
</html>