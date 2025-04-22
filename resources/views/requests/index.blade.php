<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
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
            margin-top: 70px;
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

        #status_one {
            color: blue;
        }
    </style>
</head>

<body>
    
    <x-nav-manager-request></x-nav-manager-request>
    <table class="table table-bordered">
        <thead style="background-color: grey; color: white">
            <tr>
                <th>USER ID</th>
                <th>USER NAME</th>
                <th>FROM</th>
                <th>TO</th>
                <th>SESSION</th>
                <th>NO OF DAYS</th>
                <th>TYPE</th>
                <th>REASON</th>
                <th>COMMENTS</th>
                <th>DATE OF APPLICATION</th>
                <th>STATUS</th>
                <th>ACTION</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($leave_data as $record)
                <tr id="rowdata">
                    <td>{{ $record->user_id }}</td>
                    <td>{{ $userNames[$record->user_id] }}</td>
                    <td>{{ $record->from_date }}</td>
                    <td>{{ $record->to_date }}</td>
                    <td>{{ $record->section->session_name }}</td>
                    <td>{{ $record->total }}</td>
                    <td>{{ $record->type_name }}</td>
                    <td hidden>{{ $record->leave_type_id }}</td>
                    <td>{{ $record->reason }}</td>
                    <td>{{ $record->remarks }}</td>
                    <td>{{ $record->created_at->format('Y-m-d') }}</td>
                    <td>{{ $record->status->status_name ?? 'N/A' }}</td>

                    <td>
                        @if ($record->status_id == 0 || $record->status_id == 2 || $record->status_id == 3 )
                            <select class="form-control form-control-sm status-select" data-id="{{ $record->id }}">
                                <option value="">-- Select --</option>
                                @foreach ($status as $sts)
                                    <option value="{{ $sts->id }}">{{ $sts->status_name }}</option>
                                @endforeach

                            </select>
                        @else
                            <h6 style="color: blue">already approved</h6>
                        @endif
                    </td>

                </tr>
            @endforeach
        </tbody>
    </table>
    <script>
        $(document).ready(function() {
            $(".status-select").change(function(e) {
                e.preventDefault();
                var row = $(this).closest("tr");
                var userId = row.find("td:eq(0)").text();
                var from = row.find("td:eq(2)").text();
                var to = row.find("td:eq(3)").text();
                var leaveType = row.find("td:eq(7)").text();
                var total = row.find("td:eq(5)").text();
                var statusId = $(".status-select").val();


                $.ajax({
                    url: '/update-leaveRequest',
                    method: 'GET',
                    data: {
                        user_id: userId,
                        from_date: from,
                        To_date: to,
                        type: leaveType,
                        total: total,
                        status_id: statusId

                    },
                    success: function(response) {
                        if (response) {
                            var row = $("td:contains('" + response.date + "')")
                                .closest('tr');
                            row.find("td:eq(11)").html(response.status);
                            row.find("td:eq(12)").html(
                                '<h6 id="status_one">already approved</h6>');
                        }
                    }


                })


            })
        })
    </script>
</body>

</html>
