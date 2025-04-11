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
        #status_one{
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
            @foreach ($reg_data as $record)
                <tr>
                    <td>{{ $record->user_id }}</td>
                    <td>{{ $userNames[$record->user_id] }}</td>
                    <td>{{ $record->regulization_date }}</td>
                    <td>{{ $record->session }}</td>
                    <td>{{ $record->created_at->format('Y-m-d') }}</td>
                    <td>{{ $record->type }}</td>
                    <td>{{ $record->reason }}</td>
                    <td>{{ $record->status }}</td>
                    <td>
                        @if ($record->status == 'pending')
                            <button type="submit" class="w3-button w3-green w3-small" id="approve_button">
                                <i class="bi bi-check-circle"></i> Approve
                            </button>
                        @else
                            <h6 style="color: blue">already approved</h6>
                        @endif

                    </td>
                </tr>
            @endforeach
        </tbody>
        <script>
            $(document).ready(function() {
                $("#approve_button").click(function() {
                    var row = $(this).closest("Tr");

                    var user_id = row.find("td:eq(0)").text();
                    var date = row.find('td').eq(2).text();

                    $.ajax({
                        url: "/approve-regulization",
                        method: 'GET',
                        data: {
                            user_id: user_id,
                            date: date

                        },
                        success: function(response) {
                            alert(response.message);
                            var row = $("td:contains('" + response.regulization_date + "')")
                                .closest('tr');
                            row.find("td:eq(7)").html('<h6>approved</h6>');
                            row.find("td:eq(8)").html('<h6 id="status_one">already approved</h6>');

                        }
                    })

                })
            })
        </script>

    </table>
</body>

</html>
