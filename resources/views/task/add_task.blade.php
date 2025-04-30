<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Add Task - Employee Management</title>
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
            background-color: #f9f9f9;
            margin: 0;
            padding: 0;
            margin-top: 80px;
        }

        .container {
            width: 60%;
            margin: 0 auto;
            padding: 30px;
            background-color: white;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            border-radius: 8px;
        }

        h1 {
            text-align: center;
            color: #333;
            margin-bottom: 30px;
        }

        .form-group {
            margin-bottom: 20px;
        }

        label {
            font-size: 16px;
            color: #333;
            display: block;
            margin-bottom: 8px;
        }

        input,
        textarea,
        select {
            width: 100%;
            padding: 10px;
            font-size: 14px;
            border: 1px solid #ddd;
            border-radius: 4px;
            box-sizing: border-box;
        }

        button {
            padding: 10px 20px;
            background-color: lightblue;
            color: black;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            font-size: 16px;
        }

        button:hover {
            opacity: 0.8;
        }

        .input-group {
            margin-bottom: 15px;
        }

        h2 {
            color: lightblue;
        }

        #import_button {
            width: 200px;
        }

        button {
            margin-bottom: 20px;
        }

        .submitTask {
            margin-top: 60px;
        }

        .modal {
            top: 50px;
        }
    </style>
</head>
<x-nav-task></x-nav-task>

<body>

    <div id="modalForm" class="modal" tabindex="-1" role="dialog">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">import task</h5>
                    <button type="button" class="close" data-dismiss="modal" id="close" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form id="insert_task" action="" method="POST" enctype="multipart/form-data">
                        @csrf
                        <input type="file" id="import_task" name="import_task">
                        <br><br>
                        <button type="submit" id="submitTask">import</button>
                    </form>
                </div>
            </div>
        </div>
    </div>




    <div class="container">
        <h2>Add Task</h2>
        <button class="btn  mt-3" id="inport_button">
            Import Task Data
        </button>
        <form action="/store" method="POST">
            @csrf
            <div class="form-group">
                <label for="employee">Assign Task to Employee</label>

                <select id="employee" name="employee">
                    <option value="">Select an Employee</option>
                    @foreach ($users as $user)
                        <option value="{{ $user->user_id }}">{{ $user->user->name }}</option>
                    @endforeach
                </select>

            </div>


            <div class="form-group">
                <label for="task-name">Task Name</label>
                <input type="text" id="task_name" name="task_name" placeholder="Enter task name">
            </div>


            <div class="form-group">
                <label for="task-description">Task Description</label>
                <textarea id="task_description" name="task_description" rows="4" placeholder="Enter task description"></textarea>
            </div>

            <div class="form-group">
                <label for="task-deadline">Deadline</label>
                <input type="date" id="task_deadline" name="task_deadline">
            </div>
            <div class="form-group">
                <label for="task-time">Estimated Time</label>

                <input type="number" id="hours" name="hours" placeholder="Enter hours" min="1">
            </div>



            <div class="form-group">
                <label for="task-dependencies">Related to Task (if any )</label>
                <select id="task_dependencies" name="task_dependencies">
                    <option value="">Select if any</option>
                    @foreach ($tasks as $task)
                        <option value="{{ $task->id }}">{{ $task->task_name }}</option>
                    @endforeach
                </select>
            </div>


            <div class="form-group">
                <button type="submit">Add Task</button>
            </div>
        </form>


    </div>
    <script>
        $(document).ready(function() {
            $("#inport_button").click(function() {
                $("#modalForm").modal();
            })

            $("#insert_task").submit(function(event) {
                event.preventDefault();
                var formData = new FormData(this);
                for (var [key, value] of formData.entries()) {
                    console.log(key + ": " + value);
                    console.log(value);
                }
                
 
                $.ajax({
                    method: 'POST',
                    url: '/task-import',
                    data: formData,
                    processData: false, // Prevent jQuery from processing the data (required for FormData)
                    contentType: false, // Prevent jQuery from setting content-type (required for FormData)

                    success: function(response) {
                        console.log(response);
                        
                       $("#modalForm").hide();

                    }
                })
            })




        })
    </script>
</body>

</html>
