<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gummies - Add Task</title>

    <style>
        * {
            box-sizing: border-box;
        }

        body {
            margin: 0;
            font-family: Arial, sans-serif;
            background: #f5f0ff;
        }

        .navbar {
            background: #6f42c1;
            color: white;
            padding: 18px 8%;
        }

        .navbar h1 {
            margin: 0;
        }

        .container {
            width: 90%;
            max-width: 700px;
            margin: 40px auto;
        }

        .form-card {
            background: white;
            padding: 30px;
            border-radius: 12px;
            box-shadow: 0 3px 12px rgba(0, 0, 0, 0.08);
        }

        h2 {
            color: #4c2889;
            margin-top: 0;
        }

        label {
            display: block;
            margin-top: 18px;
            margin-bottom: 7px;
            font-weight: bold;
        }

        input,
        textarea,
        select {
            width: 100%;
            padding: 11px;
            border: 1px solid #ccc;
            border-radius: 7px;
            font-family: Arial, sans-serif;
        }

        textarea {
            min-height: 120px;
            resize: vertical;
        }

        .buttons {
            margin-top: 25px;
            display: flex;
            gap: 10px;
        }

        button,
        .back {
            padding: 11px 18px;
            border-radius: 7px;
            border: none;
            cursor: pointer;
            text-decoration: none;
            font-size: 14px;
        }

        button {
            background: #6f42c1;
            color: white;
        }

        .back {
            background: #eee;
            color: #333;
        }

        .error {
            background: #fee2e2;
            color: #991b1b;
            padding: 12px;
            border-radius: 7px;
        }
    </style>
</head>

<body>

<nav class="navbar">
    <h1>Gummies</h1>
</nav>

<div class="container">

    <div class="form-card">

        <h2>Add New Task</h2>

        @if($errors->any())
            <div class="error">
                <ul>
                    @foreach($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('tasks.store') }}" method="POST">

            @csrf

            <label for="task_name">
                Task Name
            </label>

            <input
                type="text"
                id="task_name"
                name="task_name"
                value="{{ old('task_name') }}"
                required
            >

            <label for="description">
                Description
            </label>

            <textarea
                id="description"
                name="description"
            >{{ old('description') }}</textarea>

            <label for="status">
                Status
            </label>

            <select id="status" name="status">
                <option value="Pending" selected>
                    Pending
                </option>

                <option value="Completed">
                    Completed
                </option>
            </select>

            <label for="due_date">
                Due Date
            </label>

            <input
                type="date"
                id="due_date"
                name="due_date"
                value="{{ old('due_date') }}"
            >

            <div class="buttons">

                <button type="submit">
                    Save Task
                </button>

                <a
                    class="back"
                    href="{{ route('tasks.index') }}"
                >
                    Cancel
                </a>

            </div>

        </form>

    </div>

</div>

</body>
</html>