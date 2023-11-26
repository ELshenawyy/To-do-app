<!-- resources/views/tasks.blade.php -->

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>To-do app</title>
    <!-- Add Bootstrap CSS -->
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            font-family: 'Arial', sans-serif;
            background-color: #f8f9fa;
            margin: 20px;
        }
        .task-list {
            list-style-type: none;
            padding: 0;
        }
        .task-item {
            background-color: #fff;
            margin-bottom: 10px;
            padding: 15px;
            border-radius: 5px;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
        }
        .completed {
            text-decoration: line-through;
            color: #6c757d;
        }
    </style>
</head>
<body>

    <div class="container">
        <h1 class="mt-4">Task List</h1>

        <form action="/tasks" method="post" class="mb-4">
            @csrf
            <div class="form-group">
                <label for="title">New Task:</label>
                <input type="text" name="title" class="form-control" required>
            </div>
            <button type="submit" class="btn btn-primary">Add Task</button>
        </form>

        <ul class="task-list">
            @forelse($tasks as $task)
                <li class="task-item {{ $task->completed ? 'completed' : '' }}">
                    <form action="/tasks/{{ $task->id }}" method="post" style="display: inline;">
                        @csrf
                        @method('PATCH')
                        <button type="submit" class="btn btn-success btn-sm">
                            {{ $task->completed ? 'Undo' : 'Complete' }}
                        </button>
                    </form>
                    {{ $task->title }}
                    <form action="/tasks/{{ $task->id }}" method="post" style="display: inline;">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger btn-sm">Delete</button>
                    </form>
                </li>
            @empty
                <p>No tasks available.</p>
            @endforelse
        </ul>
    </div>

    <!-- Add Bootstrap JS and Popper.js -->
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>

</body>
</html>
