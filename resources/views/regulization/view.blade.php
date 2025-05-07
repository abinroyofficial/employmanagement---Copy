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

        .container {
            max-width: 600px;
            margin: 0 auto;
            background-color: white;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            margin-top: 40px;
        }

        h2 {
            text-align: center;
            color: #333;
        }

        .form-group {
            margin-bottom: 15px;
        }

        .form-group label {
            display: block;
            font-size: 14px;
            color: #555;
            margin-bottom: 5px;
        }

        .form-group input,
        .form-group select,
        .form-group textarea {
            width: 100%;
            padding: 10px;
            border: 1px solid #ddd;
            border-radius: 4px;
            font-size: 14px;
        }

        .form-group input[type="date"] {
            padding: 8px;
        }

        textarea {
            height: 30px;
        }

        .form-group select {
            padding: 10px;
        }

        .form-group textarea {
            padding: 10px;
            height: 100px;
            resize: vertical;
        }




        .display {
            display: flex;
            justify-content: space-between;
            gap: 100px;

        }

        #fromDate,
        #toDate {
            width: 220px;
        }
    </style>
</head>

<body>
    <x-nav-attendence></x-nav-attendence>

    <!-- Modal -->
    <div id="modalForm" class="modal" tabindex="-1" role="dialog">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">apply regulization</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form id="insertForm">
                        @csrf
                        <input type="hidden" name="user_id" id="user_id" value="{{ $data->user_id }}">


                        <input type="hidden" name="date" id="date"
                            value="{{ \Carbon\Carbon::today()->toDateString() }}">
                        <input type="hidden" name="type" id="type" value="regulization">
                        <label for="date">date to be regulized:</label>
                        <input type="text" style="border: none" name="regulization_date" id="regulization_date">

                        <div class="form-group">
                            <label for="session">Session</label>
                            <select id="session" name="session" required>
                                <option value="">Select Session</option>
                                <option value="FULL DAY">Full Day</option>
                                <option value="HALF DAY">Half Day</option>
                            </select>
                        </div>


                        <div class="form-group">
                            <label for="reason">Reason for regulize</label>
                            <select id="reason" name="reason" required>
                                <option value="">Select Reason</option>
                                <option value="miss punch">miss punch</option>
                                <option value="absentee regulization">absentee regulization</option>
                                <option value="others">Other</option>
                            </select>
                        </div>


                        <button type="submit" class="btn btn-primary" id="submitRegulization">Submit</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- End of Modal -->

    <table class="table table-bordered">
        <thead style="background-color: grey;color:white">
            <tr>
                <th>DATE</th>
                <th>IN</th>
                <th>OUT</th>
                <th>TOTAL TIME</th>
                <th>STATUS</th>
                <th>ACTION</th>

            </tr>
        </thead>
        <tbody>

            @foreach ($value as $record)
                @if ($record->user_id == Auth::user()->id)
                    <tr>
                        <td>{{ $record->date }}</td>
                        <td>{{ $record->sign_in }}</td>
                        <td>{{ $record->sign_out }}</td>
                        <td>{{ $record->total_time }}</td>
                        <td>{{ $record->attendance_status }}</td>
                        <td>
                            @if (App\Models\Regulization::where('regulization_date', $record->date)->count() == 0)
                                <button type="submit" class="w3-button w3-green w3-small" id="regulize">
                                    <i class="bi bi-check-circle"></i> apply regulization
                                </button>
                            @else
                                <h6>applied</h6>
                            @endif


                        </td>
                    </tr>
                @endif
            @endforeach
        </tbody>
    </table>
</body>

<script>
    $(document).ready(function() {
        $("#regulize").click(function() {
            var row = $(this).closest("tr");
            var date = row.find("td:eq(0)").text();
            $("#regulization_date").val(date);
            $("#modalForm").modal();


            $("#submitRegulization").click(function(event) {
                event.preventDefault();
                $.ajax({
                    method: 'GET',
                    url: '/regulizaion-store',
                    data: $("#insertForm").serialize(),
                    success: function(response) {
                        $("#modalForm").modal('hide');

                        var row = $("td:contains('" + response.regulization_date +
                            "')").closest('tr');
                        row.find("td:eq(5)").html('<h6>Applied</h6>');

                    }
                })

            })


        })
    })
</script>

</html>
