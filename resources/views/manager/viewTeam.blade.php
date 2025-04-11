<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Details</title>
    <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
    <style>
        body {
            font-family: "Times New Roman", serif;

            margin-top: 80px;
        }

        #firstth {
            width: 400px;
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
            border: 1px solid #ddd;
        }

        th {
            background-color: grey;
            position: relative;
            height: 10px;
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

        caption {
            font-size: 1.5em;
            margin-bottom: 10px;
        }

        button {
            color: white;
            border: none;
            padding: 5px 10px;
            cursor: pointer;
            font-size: 14px;
            border-radius: 5px;
            margin-right: 5px;
        }
    </style>
</head>

<body>
    <x-nav-user></x-nav-user>


    <table>
        <thead>
            <tr>
                <th>Name</th>
                <th>Email</th>
                <th>Employ ID</th>
                <th>Phone</th>
                <th>Gender</th>
                <th>Work Time</th>
                <th>Leave</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($team_members as $team)
                <tr>
                    <td>{{ $team->user_name }}</td>
                    <td>{{ $team->user_email }}</td>
                    <td>{{ $team->employ_id }}</td>
                    <td>{{ $team->phone }}</td>
                    <td>{{ $team->gender->gender_name }}</td>
                    <td>{{ $team->work_time_from }} - {{ $team->work_time_to }}</td>
                    <td>{{ $team->leave }}</td>
                    <td>
                        <a href="/add_task/{{Auth::user()->id}}">
                            <button type="submit" class="w3-button w3-green w3-small" id="approve_button">
                                <i class="bi bi-check-circle"></i> assign task
                            </button>
                        </a>


                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>


</body>

</html>
