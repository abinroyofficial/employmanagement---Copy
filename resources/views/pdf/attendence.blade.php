<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <style>
        body {
            font-family: "Times New Roman", serif;

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
            background-color: grey;
        }

        #export_button {
            margin-left: 1400px;
        }

        .darkmode {
            background-color: grey;
            color: white;
        }

        #pdf {
            margin-left: 1400px;
        }
    </style>
</head>

<body>
    <table class="table table-bordered">
        <thead style="background-color:lightblue;color:white">
            <tr>
                <th>DATE</th>
                <th>IN</th>
                <th>OUT</th>
                <th>TOTAL TIME</th>
                

            </tr>
        </thead>
        <tbody id="tbody">
            @foreach ($datas as $record)
                <tr>
                    <td>{{ $record->date }}</td>
                    <td>{{ $record->sign_in }}</td>
                    <td>{{ $record->sign_out }}</td>
                    <td>{{ $record->total_time }}</td>
                    
                </tr>
            @endforeach

        </tbody>
    </table>

</body>

</html>
