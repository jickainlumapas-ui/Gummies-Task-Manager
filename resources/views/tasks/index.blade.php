<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gummies - My Tasks</title>

    <style>
        * {
            box-sizing: border-box;
        }

        body {
            margin: 0;
            font-family: Arial, sans-serif;
            background: #fff5f5;
            color: #333;
        }

        .navbar {
            background: #dc2626;
            color: white;
            padding: 18px 8%;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .navbar h1 {
            margin: 0;
            font-size: 24px;
        }

        .navbar a {
            color: white;
            text-decoration: none;
            background: #ef4444;
            padding: 10px 18px;
            border-radius: 8px;
        }

        .container {
            width: 85%;
            max-width: 1100px;
            margin: 40px auto;
        }

        .header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 25px;
        }

        .header h2 {
            margin: 0;
            color: #b91c1c;
        }

        .add-button {
            background: #dc2626;
            color: white;
            padding: 11px 18px;
            text-decoration: none;
            border-radius: 8px;
        }

        .message {
            background: #d1fae5;
            color: #065f46;
            padding: 14px;
            border-radius: 8px;
            margin-bottom: 20px;
        }

        .task-card {
            background: white;
            border-radius: 12px;
            padding: 22px;
            margin-bottom: 18px;
            box-shadow: 0 3px 12px rgba(0, 0, 0, 0.08);
        }

        .task-top {
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .task-name {
            color: #b91c1c;
            font-size: 21px;
            font-weight: bold;
        }

        .status {
            padding: 6px 12px;
            border-radius: 20px;
            font-size: 13px;
            font-weight: bold;
        }

        .pending {
            background: #fef3c7;
            color: #92400e;
        }

        .completed {
            background: #d1fae5;
            color: #065f46;
        }

        .description {
            margin: 15px 0;
            color: #555;
        }

        .due-date {
            font-size: 14px;
            color: #777;
            margin-bottom: 18px;
        }

        .actions {
            display: flex;
            gap: 8px;
            flex-wrap: wrap;
        }

        .actions a,
        .actions button {
            border: none;
            padding: 9px 14px;
            border-radius: 7px;
            text-decoration: none;
            cursor: pointer;
            font-size: 14px;
        }

        .edit {
            background: #fee2e2;
            color: #b91c1c;
        }

        .delete {
            background: #fee2e2;
            color: #991b1b;
        }

        .complete {
            background: #d1fae5;
            color: #065f46;
        }

        .pending-button {
            background: #fef3c7;
            color: #92400e;
        }

        .empty {
            background: white;
            padding: 40px;
            text-align: center;
            border-radius: 12px;
            color: #777;
        }

        form {
            display: inline;
        }
    </style>
</head>

<body>

<nav class="navbar">
    <h1>Gummies</h1>
    <a href="{{ route('tasks.create') }}">Add Task</a>
</nav>

<div class="container">

    <div class="header">
        <h2>My Tasks</h2>

        <a class="add-button" href="{{ route('tasks.create') }}">
            + Add Task
        </a>
    </div>

    @if(session('success'))
        <div class="message">
            {{ session('success') }}
        </div>
    @endif

    @if($tasks->count() > 0)

        @foreach($tasks as $task)

            <div class="task-card">

                <div class="task-top">

                    <div class="task-name">
                        {{ $task->task_name }}
                    </div>

                    @if($task->status === 'Completed')
                        <span class="status completed">
                            Completed
                        </span>
                    @else
                        <span class="status pending">
                            Pending
                        </span>
                    @endif

                </div>

                <div class="description">
                    {{ $task->description ?: 'No description provided.' }}
                </div>

                <div class="due-date">
                    <strong>Due Date:</strong>

                    @if($task->due_date)
                        {{ $task->due_date->format('F d, Y') }}
                    @else
                        No due date
                    @endif
                </div>

                <div class="actions">

                    <a
                        class="edit"
                        href="{{ route('tasks.edit', $task) }}"
                    >
                        Edit
                    </a>

                    @if($task->status === 'Pending')

                        <form
                            action="{{ route('tasks.updateStatus', $task) }}"
                            method="POST"
                        >
                            @csrf
                            @method('PATCH')

                            <input
                                type="hidden"
                                name="status"
                                value="Completed"
                            >

                            <button
                                type="submit"
                                class="complete"
                            >
                                Mark Completed
                            </button>
                        </form>

                    @else

                        <form
                            action="{{ route('tasks.updateStatus', $task) }}"
                            method="POST"
                        >
                            @csrf
                            @method('PATCH')

                            <input
                                type="hidden"
                                name="status"
                                value="Pending"
                            >

                            <button
                                type="submit"
                                class="pending-button"
                            >
                                Mark Pending
                            </button>
                        </form>

                    @endif

                    <form
                        action="{{ route('tasks.destroy', $task) }}"
                        method="POST"
                        onsubmit="return confirm('Are you sure you want to delete this task?');"
                    >
                        @csrf
                        @method('DELETE')

                        <button
                            type="submit"
                            class="delete"
                        >
                            Delete
                        </button>
                    </form>

                </div>

            </div>

        @endforeach

    @else

        <div class="empty">
            <h3>No tasks yet.</h3>
            <p>Create your first task to get started.</p>

            <a class="add-button" href="{{ route('tasks.create') }}">
                Add Your First Task
            </a>
        </div>

    @endif

</div>

</body>
</html>