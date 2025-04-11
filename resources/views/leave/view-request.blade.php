<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
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

        #h2col {
            margin-top: 70px;
        }
    </style>
</head>

<body>
    <x-nav-attendence></x-nav-attendence>

    <table class="table table-bordered">
        <thead style="background-color: grey;color:white">
            <tr>

                <th>FROM</th>
                <th>TO</th>
                <th>NO OF DAYS</th>
                <th>TYPE</th>
                <th>DATE OF APPLICATION</th>
                <th>STATUS</th>
                <th>ACTION</th>

            </tr>
        </thead>
        <tbody>
            <h4 id="h2col">LEAVE AND WFH REQUESTS</h4>
            @foreach ($data as $record)
                <tr>
                    <td hidden>{{ $record->id }}</td>
                    <td>{{ $record->from_date }}</td>
                    <td>{{ $record->to_date }}</td>
                    <td>{{ $record->total }}</td>
                    <td>{{ $record->LeaveType->type_name }}</td>
                    <td>{{ $record->created_at->format('Y-m-d') }}</td>
                    <td>{{ $record->status->status_name ?? 'N/A' }}</td>


                    <td>
                        @if ($record->status == '')
                            <button type="submit" class="w3-button w3-red w3-small" id="cancel">
                                <i class="bi bi-check-circle"></i> cancel
                            </button>
                    </td>
                @else
                    <h6>already approved </h6>
            @endif
            </tr>
            @endforeach
            @foreach ($data2 as $record2)
                <tr>
                    <td hidden>{{ $record2->id }}</td>
                    <td>{{ $record2->from_date }}</td>
                    <td>{{ $record2->to_date }}</td>
                    <td>{{ $record2->total }}</td>
                    <td>{{ $record2->LeaveType->type_name}}</td>
                    <td>{{ $record2->created_at->format('Y-m-d') }}</td>
                    <td>{{ $record2->status->status_name ?? 'N/A' }}</td>
                    <td>
                        @if ($record2->status_id == 3  ||  $record2->status_id == 2 || $record2->status_id == 0)
                            <button type="submit" class="w3-button w3-red w3-small" id="cancel2">
                                <i class="bi bi-check-circle"></i> cancel
                            </button>
                    </td>
                @else
                    <h6>already approved </h6>
            @endif

            </tr>
            @endforeach

        </tbody>

    </table>







    <table class="table table-bordered">
        <thead style="background-color: grey;color:white">
            <tr>
                <th>REGULIZATION DATE</th>
                <th>REGULIZATION DATE</th>
                <th>SESSION</th>
                <th>DATE OF APPLICATION</th>
                <th>TYPE</th>
                <th>REASON</th>
                <th>STATUS</th>
                <th>ACTION</th>

            </tr>
        </thead>
        <tbody>
            <br>

            <h4>REGULIZATION REQUEST</h4>
            @foreach ($data3 as $record2)
                <tr>
                    <td>{{ $record2->id }}</td>
                    <td>{{ $record2->regulization_date }}</td>
                    <td>{{ $record2->session }}</td>
                    <td>{{ $record2->created_at->format('Y-m-d') }}</td>
                    <td>{{ $record2->type }}</td>
                    <td>{{ $record2->reason }}</td>
                    <td>{{ $record2->status }}</td>
                    <td>
                        @if ($record2->status == 'pending')
                            <button type="submit" class="w3-button w3-red w3-small" id="cancel2">
                                <i class="bi bi-check-circle"></i> cancel
                            </button>
                    </td>
                @else
                    <h6>already approved </h6>
            @endif

            </tr>
            @endforeach
        </tbody>
    </table>
    <script>
        $(document).ready(function() {
            $(".w3-button").click(function() {
                var row = $(this).closest("tr");
                var id = row.find("td:eq(0)").text();
                var type = row.find("td:eq(4)").text();

                $.ajax({
                    url: '/cancel-request',
                    method: 'GET',
                    data: {
                        table_id: id,
                        type: type,
                    },
                    success: function(response) {
                        if (response.success) {
                            row.remove();
                        }

                    }

                })
            })
        })
    </script>
</body>

</html>
