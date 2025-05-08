<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Task List</title>
    <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css"
        integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <script src="https://code.jquery.com/jquery-3.7.1.min.js"
        integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js"
        integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous">
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js"
        integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous">
    </script>
    <style>
        body {
            font-family: "Times New Roman", serif;
            margin: 0;
            padding: 0;
            display: flex;
            height: 100vh;
            background-color: white;
            margin-top: 50px;

        }


        .task-list {
            width: 25%;
            background-color: #f4f6f9;
            padding: 20px;
            border-right: 2px solid #ddd;
            overflow-y: scroll;
            scrollbar-width: none;
            margin-top: 0px;

        }

        h1 {
            margin: 0px;
        }

        .task-item,
        .task-items {
            background-color: #fff;
            padding: 10px;
            margin-bottom: 10px;
            border-radius: 5px;
            cursor: pointer;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
            transition: background-color 0.3s ease;
        }

        .task-item:hover {
            background-color: #f0f8ff;
        }

        /* Main Content */
        .task-detail {
            width: 75%;
            margin-top: 50px;
            padding: 20px;
            background-color: #f4f6f9;
            display: none;
            flex-direction: column;
            justify-content: space-between;
            border-left: 2px solid #ddd;
            overflow-y: scroll;
            scrollbar-width: none;

        }

        .task-card {
            background-color: #ffffff;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            border-radius: 8px;
            padding: 20px;
            margin-bottom: 10px;

        }

        .comment-card {
            background-color: #ffffff;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            border-radius: 8px;
            padding: 20px;
            overflow-y: visible;
            margin-bottom: 10px;

        }

        .task-card .card-title {
            font-size: 24px;
            color: #333;
            margin-bottom: 15px;
        }

        .task-card .card-text {
            font-size: 16px;
            color: #555;
            line-height: 1.5;
        }

        .task-detail.visible {
            display: flex;
        }

        .task-detail h3 {
            color: #333;
        }

        .task-detail p {
            font-size: 16px;

        }

        .comment-section {
            margin-top: 20px;
        }

        .comment-list {
            margin-top: 10px;
            max-height: 300px;
            overflow-y: scroll;
            scrollbar-width: none;
            -ms-overflow-style: none;
        }

        .comment-item {
            background-color: #f8f8f8;
            padding: 10px;
            margin-bottom: 10px;
            border-radius: 5px;
            box-shadow: 0 1px 3px rgba(0, 0, 0, 0.1);
        }

        .comment-item p {
            margin: 0;
            color: #333;
        }

        .comment-item span {
            font-size: 12px;
            color: #888;
        }

        .comment-form textarea {
            width: 100%;
            padding: 10px;
            border: 1px solid #ddd;
            border-radius: 5px;
            resize: vertical;
            font-size: 14px;
        }

        .comment-form button {
            padding: 10px 20px;
            background-color: lightblue;
            color: black;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            margin-top: 10px;
        }

        .comment-form button:hover {
            background-color: rgb(194, 229, 241);
        }

        #task-name {
            color: grey;
        }

        .card-text {
            color: red;
        }

        .search-bar {
            width: 100%;
            top: 78px;
            padding: 10px;
            font-size: 16px;
            border: 2px solid #c28080;
            border-radius: 5px;
            background-color: white;
            height: 40px;
            margin-bottom: 30px;

        }

        h5 {
            color: red;
        }

        #card_header {
            background-color: white;
        }

        #card_header h4 {
            color: plum;
        }

        #search_form {
            margin-top: 50px;
        }

        button {
            padding: 10px 20px;
            background-color: lightblue;
            color: black;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            font-size: 16px;
            margin-bottom: 20px;
        }
    </style>
</head>

<body>
    <x-nav-task></x-nav-task>
    {{-- left side  --}}
    <div class="task-list">
        <form action="" id="search_form">
            <input type="text" class="search-bar" id="search_task" name="search_task" placeholder="Search task">
        </form>

        <form id="export-tasks" action="/export-tasks">
            <button type="submit" id="export_task_excel">export task</button>
        </form>


        <form id="sort-tasks" class="mb-3">
            <select class="form-control" id="sort_by" name="sort_by">
                <option value="">Sort Tasks</option>
                <option value="name_asc">Task Name (A-Z)</option>
                <option value="name_desc">Task Name (Z-A)</option>
                <option value="deadline_asc">Deadline Earliest </option>
                <option value="deadline_desc">Deadline Latest</option>
                <option value="time_asc">Time (Low to High)</option>
                <option value="time_desc">Time (High to Low)</option>
            </select>
        </form>



        <div class="task-item" id="task-list">
            @foreach ($task_details as $task)
                <div class="task-items" data-task-id="{{ $task->id }}">
                    <p style="color:grey;font-size:20px ;text-transform: uppercase" id="task_name_search">
                        <strong>{{ $task->task_name }}</strong>
                    </p>
                    <p id="task_description_search">{{ $task->task_description }}</p>
                    @if ($task->user_id == Auth::user()->id)
                        <p style="color: red ; font-size:10px">assigned to me</p>
                    @endif

                </div>
            @endforeach
        </div>
    </div>

    <!-- Right side -->
    <div class="task-detail" id="task-detail">
        <div class="card task-card">
            <div class="card-body">
                <h3 id="user_id" class="card-title" hidden>{{ Auth::user()->id }}</h3>
                <label for="">TASK ID</label>
                <h3 id="task-id" class="card-title"></h3>
                <label for="">TASK NAME</label>
                <h3 id="task-name" class="card-title"></h3>
                <label for="">TASK DESCRIPTION</label>
                <p id="task-description" class="card-text"></p>
                <label for="">TASK DEADLINE</label>
                <p id="task-deadline" class="card-text"></p>
                <label for="">TASK ESTIMATED TIME</label>
                <p id="task-time" class="card-text"></p>
                <label for="">RELATED TASK</label>
                <p id="task-related" class="card-text"></p>
            </div>

        </div>
        <div class="card comment-card">
            <div class="card-header" id="card_header">
                <h4>Comments</h4>
            </div>
            <div class="card-body comment-section">
                <div class="comment-list" id="comment-list">

                    <div class="card  shadow-sm">
                        <div class="card-body">

                        </div>
                    </div>

                </div>
            </div>
        </div>



        <form action="/store-comment" id="comment_form" method="POST">
            @csrf
            <div class="comment-form">
                <input type="hidden" name="task_id" id="task_id">
                <input type="hidden" name="user_id" id="user_id" value="{{ Auth::user()->id }}">
                <textarea id="comment-input" name="comment_input" placeholder="Add your comment..." rows="3"></textarea>
                <button id="submit-comment">Submit Comment</button>
            </div>
        </form>
    </div>
    <script>
        $(document).ready(function() {

            $(document).on('click', '.task-items', function() {
                const taskId = $(this).attr('data-task-id');
                $.ajax({
                    url: '/task-detailing',
                    method: 'GET',
                    data: {
                        task_id: taskId
                    },
                    success: function(response) {
                        if (response.data) {
                            $('.task-detail').show();
                            $('#task-id').text(response.data.id);
                            $('#task-name').text(response.data.task_name);
                            $('#task-description').text(response.data.task_description);
                            $('#task-deadline').text(response.data.task_deadline);
                            $('#task-time').text(response.data.estimated_time) + "HR";
                            $('#task-related').text(response.data.task_dependencies);
                            $('#task_id').val(response.data.id);
                        }
                        if (response.comment && response.comment.length > 0) {
                            $("#comment-list").html(response.comment);
                        } else {

                        }
                    },
                });
            });





            $("#search_task").on('keyup', function() {
                $.ajax({
                    url: "/search-task",
                    type: 'GET',
                    data: $("#search_form").serialize(),
                    success: function(response) {
                        if (response.view) {
                            $("#task-list").html(response.view);
                        } else {
                            $("#task-list").html(response.searchresult);
                        }
                    },
                });
            });


            $("#sort-tasks").on('input', function() {
                $.ajax({
                    url: "/sort-task",
                    type: 'GET',
                    data: $("#sort_by").serialize(),
                    success: function(response) {
                        if (response.datas) {
                            let data = '';
                            response.datas.forEach(function(task) {
                                data += `
                        <div class="task-items" data-task-id="${task.id}">
                            <p style="color:grey;font-size:20px;text-transform:uppercase" id="task_name_search">
                                <strong>${task.task_name}</strong>
                            </p>
                            <p id="task_description_search">${task.task_description}</p>

                        </div>
                    `;
                            });
                            $("#task-list").html(data);
                        }
                    },
                });
            });



        });
    </script>


</body>

</html>
