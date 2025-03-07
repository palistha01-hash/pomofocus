<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pomodoro Timer</title>
   <link rel="stylesheet" href="{{asset('css/style.css')}}">
</head>

<body>

    <div class="container">
        <div class="header">
            <h2>Pomofocus</h2>
            <div>
                <button>📊 Report</button>
                <button>⚙️ Setting</button>
                <a href="{{ route('login') }}">
                    <button>👤 Sign In</button>
                </a>
            </div>
        </div>
        <div class="timer-box">
            <div class="mode-buttons">
                <button class="active">Pomodoro</button>
                <button>Short Break</button>
                <button>Long Break</button>
            </div>
            <div class="time-display">25:00</div>
            <button class="start-button">START</button>
            <div class="task-section">
                <p>#1 Time to focus!</p>
                <div class="task-box">
                    <p>Tasks</p>
                </div>
                <div class="add-task">+ Add Task</div>
            </div>
        </div>
    </div>

</body>

</html>
