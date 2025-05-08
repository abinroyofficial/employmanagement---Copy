<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">

    <style>
        body {
            font-family: "Times New Roman", serif;

        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top:80px;
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
    <table class="table table-bordered">
        <thead style="background-color: grey;color:white">
            <tr>
                <th>MONTH</th>
                <th>TOTAL DAYS</th>
                <th>NET SALARY</th>
                <th>PRESENT DAYS</th>
                <th>LOP DAYS</th>
                <th>ATTENDENCE PER.CENT</th>
                <th>SALARY </th>

            </tr>
        </thead>
        <tbody id="tbody">
            <tr>
                <td>{{ $currentMonthName }} {{$currentYear}}</td>
                <td>{{ $totalDaysInMonth}}</td>
                <td>{{ $datas->salary}}</td>
                <td>{{ $attendance_days}}</td>
                <td>{{ $absent_days}}</td>
                <td>{{ $atendence_percent}}</td>
                <td>{{ $salary_month}}</td>

            </tr>

        </tbody>
    </table>

</body>

</html>
