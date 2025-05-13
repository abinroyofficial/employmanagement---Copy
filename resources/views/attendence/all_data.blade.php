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
            margin-top:20px;

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

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }

        th,
        td {
            padding: 10px;
            text-align: left;

        }

        th {

            position: relative;
        }

        th.sortable {
            cursor: pointer;
        }

        th.sortable:hover {
            background-color: #eaeaea;
        }

        tr:nth-child(even) {
            background-color: #f9f9f9;
        }
    </style>
</head>

<body>
    <x-nav-user></x-nav-user>


    {{-- left side  --}}



    <div class="task-list">

        <h4>EMPLOYEES ATTENDECE LIST</h4>
        <form action="" id="search_form">
            <input type="text" class="search-bar" id="search_task" name="search_task" placeholder="Search task">
        </form>


        <div class="task-item" id="task-list">
            @foreach ($Users as $user)
                <div class="task-items" data-user-id="{{ $user->id }}">
                    <p style="color:grey;font-size:20px ;" id="task_name_search">
                        <strong>{{ $user->name }}</strong>
                    </p>
                </div>
            @endforeach
        </div>
    </div>

    <!-- Right side -->
    <div class="task-detail" id="task-detail">
        <div class="card task-card">
            <div class="card-body">
                <table class="table table-bordered">
                    <thead style="background-color: grey;color:white">
                        <tr>
                            <th>DATE</th>
                            <th>IN</th>
                            <th>OUT</th>
                            <th>TOTAL TIME</th>
                            <th>STATUS</th>

                        </tr>
                    </thead>
                    <tbody id="tbody">
                        @foreach ($all_attendece as $record)
                            <tr>
                                <td>{{ $record->date }}</td>
                                <td>{{ $record->sign_in }}</td>
                                <td>{{ $record->sign_out }}</td>
                                <td>{{ $record->total_time }}</td>
                                <td>{{ $record->type_name }}</td>
                            </tr>
                        @endforeach

                    </tbody>

                </table>
            </div>

        </div>





    </div>
    <script>
        $(document).ready(function() {

            $(document).on('click', '.task-items', function() {
                const UserId = $(this).attr('data-user-id');
                $.ajax({
                    url: '/attendece_all_details',
                    method: 'GET',
                    data: {
                        User_Id: UserId
                    },
                    success: function(response) {
                        if (response.data && Array.isArray(response.data)) {
                            let rows = '';
                            response.data.forEach(record => {
                                rows += `
        <tr>
            <td>${record.date}</td>
            <td>${record.sign_in}</td>
            <td>${record.sign_out}</td>
            <td>${record.total_time}</td>
            <td>${record.attendance_status}</td>
        </tr>`;
                            });
                            $('#tbody').html(rows);
                            $('#task-detail').addClass('visible');

                        }


                    },
                });
            });





            $("#search_task").on('keyup', function() {
                $.ajax({
                    url: "/search-user",
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





        });
    </script>


</body>

</html>
