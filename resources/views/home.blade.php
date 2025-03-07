<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>Pomodoro Timer</title>
    <link rel="stylesheet" href="{{ asset('css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
    <script src="{{ asset('js/jquery.min.js') }}"></script>
    <script src="{{ asset('js/bootstrap.bundle.min.js') }}"></script>

</head>

<body>

    <div class="container">
        <div class="header">

            <h2>Pomofocus</h2>
            <div>
                <button>📊 Report</button>
                <button>⚙️ Setting</button>

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
                <!-- Add Task Button -->
                <button id="show-task-form" class="btn btn-light w-100 mt-2">+ Add Task</button>

                <!-- Task Form -->
                <div id="task-form-container" class="card p-3 mt-3">
                    <form id="task-form" method="POST" action="{{ route('tasks.store') }}">
                        @csrf
                        <h4 class="mb-3 text-center">New Task</h4>

                        <div class="mb-3">
                            <label class="form-label">What are you working on?</label>
                            <input type="text" id="task-input" name="title" class="form-control"
                                placeholder="Enter task" required>
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Estimated Pomodoros</label>
                            <input type="number" name="estimated_pomodoros" class="form-control" min="1"
                                value="1" required>
                        </div>

                        <button type="submit" class="btn btn-primary">Save</button>
                        <button type="button" id="cancel-task-form" class="btn btn-secondary">Cancel</button>
                    </form>
                </div>

                <!-- Task List -->
                @if ($tasks->isEmpty())
                    <p class="text-center text-muted mt-3">No tasks available. Add a new task to get started!</p>
                @else
                    <ul class="list-group mt-3">
                        @foreach ($tasks as $task)
                            <li class="list-group-item d-flex justify-content-between align-items-center">
                                <span>{{ $task->title }}</span>
                                <div>
                                    <span>{{ $task->pomodoros }}/1</span>
                                    <form method="POST" action="{{ route('tasks.destroy', $task) }}" class="d-inline">
                                        @csrf @method('DELETE')
                                        <button class="btn btn-danger btn-sm">🗑</button>
                                    </form>
                                </div>
                            </li>
                        @endforeach
                    </ul>
                @endif

            </div>
        </div>
    </div>

    <script>
        $(document).ready(function() {
            let timer;
            let timeLeft = 1500; // 25 minutes in seconds
            let isPaused = true;
            let pomodoroCount = 0;

            const timerDisplay = $('.time-display');
            const startButton = $('.start-button');

            function startTimer() {
                if (!timer) { // Prevent multiple intervals
                    timer = setInterval(function() {
                        if (timeLeft > 0) {
                            timeLeft--;
                            updateTimerDisplay();
                        } else {
                            clearInterval(timer);
                            timer = null; // Reset timer variable
                            alert('Time is up!');
                            handlePomodoroCycle();
                        }
                    }, 1000);
                }
            }

            startButton.on('click', function() {
                if (isPaused) {
                    startButton.text("PAUSE");
                    startTimer();
                } else {
                    startButton.text("START");
                    clearInterval(timer);
                    timer = null; // Reset timer variable
                }
                isPaused = !isPaused;
            });

            function updateTimerDisplay() {
                let minutes = Math.floor(timeLeft / 60);
                let seconds = timeLeft % 60;
                timerDisplay.text(`${minutes}:${seconds.toString().padStart(2, '0')}`);
            }

            function handlePomodoroCycle() {
                pomodoroCount++;
                if (pomodoroCount % 4 === 0) {
                    timeLeft = 1800; // 30-minute long break
                    alert('Take a long break!');
                } else {
                    timeLeft = 300; // 5-minute short break
                    alert('Take a short break!');
                }
                updateTimerDisplay();
            }

            $('#show-task-form').on('click', function() {
                $('#task-form-container').toggle(); // Toggle form visibility
            });

            $('#cancel-task-form').on('click', function() {
                $('#task-form-container').hide(); // Hide form on cancel
            });

            $('#task-form').on('submit', function(event) {
                event.preventDefault(); // Prevent form from refreshing

                let formData = $(this).serialize(); // Serialize form data

                $.ajax({
                    url: '{{ route('tasks.store') }}',
                    type: 'POST',
                    data: formData,
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    success: function(data) {
                        console.log(data);
                        if (data.id) {
                            if ($('.list-group').length === 0) {
                                $('.task-box').append('<ul class="list-group mt-3"></ul>');
                            }

                            let newTask = `
                <li id="task-${data.id}" class="list-group-item d-flex justify-content-between align-items-center">
                    <span class="task-text">${data.title}</span>
                    <div>
                        <button class="btn btn-sm btn-success" onclick="completeTask(${data.id})">Complete</button>
                        <button class="btn btn-sm btn-warning" onclick="editTask(${data.id})">Edit</button>
                        <button class="btn btn-sm btn-danger" onclick="deleteTask(${data.id})">Delete</button>
                    </div>
                </li>
                `;
                            $('.list-group').append(newTask);
                            $('#task-form')[0].reset();
                            $('#task-form-container').hide();
                        }
                    }, // ✅ ADDED COMMA HERE!

                    error: function(error) {
                        console.error('Error:', error);
                    }
                });
            });


            window.deleteTask = function(taskId) {
                $.ajax({
                    url: `/tasks/${taskId}`,
                    type: 'DELETE',
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    success: function() {
                        $(`#task-${taskId}`).remove();
                    },
                    error: function(error) {
                        console.error('Error:', error);
                    }
                });
            }

            window.editTask = function(taskId) {
                let taskElement = $(`#task-${taskId} .task-text`);
                let newText = prompt("Edit Task:", taskElement.text());

                if (newText) {
                    $.ajax({
                        url: `/tasks/${taskId}`,
                        type: 'PUT',
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
                            'Content-Type': 'application/json'
                        },
                        data: JSON.stringify({
                            title: newText
                        }),
                        success: function() {
                            taskElement.text(newText);
                        },
                        error: function(error) {
                            console.error('Error:', error);
                        }
                    });
                }
            }

            window.completeTask = function(taskId) {
                $.ajax({
                    url: `/tasks/${taskId}/complete`,
                    type: 'PUT',
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    success: function() {
                        $(`#task-${taskId}`).addClass('text-decoration-line-through');
                    },
                    error: function(error) {
                        console.error('Error:', error);
                    }
                });
            }
        });
    </script>
</body>

</html>
