<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Today's Attendance</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/jquery@3.6.0/dist/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/moment@2.29.1/moment.min.js"></script>
    <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">

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

        .float-left {
            margin-left: 1200px;
            margin-top: 40px;
        }
    </style>
</head>

<body>

    <x-nav-user></x-nav-user>


    <div class="container" style="margin-top: 80px;">
        <div class="dropdown">
            <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenuButton"
                data-bs-toggle="dropdown" aria-expanded="false">
                Monthly Attendance
            </button>
            <button type="button" class="btn btn-warning" id="daily_attendence">
                Time Tracking Information
            </button>
            <button type="button" class="btn btn-dark" id="theme_change">
                change theme
            </button>
            <span id="result"></span>
            <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton">

                <li><a class="dropdown-item" value="march">March 2025</a></li>
                <li><a class="dropdown-item" value="April">April 2025</a></li>
                <li><a class="dropdown-item" value="May">May 2025</a></li>
                <li><a class="dropdown-item" value="June">June 2025</a></li>
                <li><a class="dropdown-item" value="July">July 2025</a></li>
                <li><a class="dropdown-item" value="August">August 2025</a></li>
                <li><a class="dropdown-item" value="September">September 2025</a></li>
                <li><a class="dropdown-item" value="October">October 2025</a></li>
                <li><a class="dropdown-item" value="November">November 2025</a></li>
                <li><a class="dropdown-item" value="December">December 2025</a></li>
            </ul>
        </div>

        <form action="" id="attendence_form">
            @csrf
            <h2 class="mt-5">Mark Today's Attendance</h2>
            <div class="mb-3">
                <label for="Date" class="form-label">Date</label>
                <p name="date" id="date" value="">{{ \Carbon\Carbon::today()->toDateString() }}</p>
            </div>
            @php
                $attendance = App\Models\Attendence::where('user_id', Auth::user()->id)
                    ->where('date', \Carbon\Carbon::today()->toDateString())
                    ->first();
            @endphp

            @if ($attendance)

                @if ($attendance->sign_out)
                    <span>recored added successfully</span>
                @else
                    <button type="button" class="btn btn-primary" id="sign_in_button" disabled>Sign In</button>
                    <button type="button" class="btn btn-success" id="sign_out_button">Sign Out</button>
                    <div class="mt-3">
                        <button type="submit" id="submit_button" class="btn btn-success">Submit Attendance</button>
                    </div>
                @endif
            @else
                <button type="button" class="btn btn-primary" id="sign_in_button">Sign In</button>
                <button type="button" class="btn btn-success" id="sign_out_button" disabled>Sign Out</button>
                <div class="mt-3">
                    <button type="submit" id="submit_button" class="btn btn-success">Submit Attendance</button>
                </div>
            @endif





            <input type="hidden" id="user_id" name="user_id" value="{{ Auth::user()->id }}">
            <input type="hidden" id="date" name="date" value="{{ \Carbon\Carbon::today()->toDateString() }}">
            <input type="hidden" id="sign_in" name="sign_in" value="">
            <input type="hidden" id="sign_out" name="sign_out" value="">
            <input type="hidden" id="shift" name="shift"
                value="{{ $data->work_time_from }}-{{ $data->work_time_to }}">

    </div>
    </form>

    <a href="/export_pdf/{{ Auth::user()->id }}"><button class="btn btn-warning btn-sm mt-4"
            id="pdf"><span>PDF</span></button></a>
    <form action="/attendece_export/{{ Auth::user()->id }}">
        <button class="btn btn-success btn-sm mt-3" id="export_button">
            <i class="bi bi-download"></i> Export Data
        </button>
    </form>


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
            @foreach ($monthly_record as $record)
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
    <div class="float-left" id="pagination">
        {{ $monthly_record->links() }}
    </div>



</body>
<script>
    $(document).ready(function() {
        var signInTime = null;
        var signOutTime = null;


        $('#sign_in_button').click(function() {
            signInTime = moment().format('HH:mm:ss');
            $('#sign_in').val(signInTime);
            $('#sign_in_button').prop('disabled', true);
            $('#sign_out_button').prop('disabled', false);
        });


        $('#sign_out_button').click(function() {
            signOutTime = moment().format('HH:mm:ss');
            $('#sign_out').val(signOutTime);
            $('#sign_out_button').prop('disabled', true);
            $('#sign_in_button').prop('disabled', false);


        });
        $('#attendence_form').submit(function() {

            $.ajax({
                url: '/attendance-store',
                method: 'POST',
                data: $('#attendence_form').serialize(),
                success: function(response) {
                    alert(response.message);



                },

            });
        });







        $(".dropdown-item").click(function() {
            var month = $(this).attr("value");

            $.ajax({
                url: '/attendance-monthly',
                method: 'GET',
                data: {
                    month: month,
                    id: {{ Auth::user()->id }},
                },
                success: function(response) {

                    $("table tbody").html(response);




                }

            })
        })

        $("#daily_attendence").click(function() {
            $.ajax({
                url: '/attendance-daily',
                method: 'GET',
                data: {
                    id: {{ Auth::user()->id }},
                },
                success: function(response) {

                    if (response.data) {


                        let rows = '';

                        rows += `
                <tr>
                    <td>${response.data.date}</td>
                    <td>${response.data.sign_in}</td>
                    <td>${response.data.sign_out}</td>
                    <td>${response.data.total_time}</td>
                    <td>${response.data.attendance_status}</td>
                </tr>
            `;

                        $('#tbody').html(rows);


                    }


                }

            })

        })


    });
</script>
<script>
    const button = document.getElementById('theme_change');
    button.addEventListener('mouseover', changeTheme)


    function changeTheme() {

        document.body.classList.toggle('darkmode');
    }
</script>

<script>
    $(document).on('click', "#pagination a", function(e) {
        e.preventDefault();
        var url = $(this).attr('href').split('page=')[1];
        fetchData(url);

    });

    function fetchData(url) {
        $.ajax({
            type: 'GET',
            url: '/pagination-ajax?page=' + url,
            data: {
                id: {{ Auth::user()->id }},
            },
            success: function(response) {
                let rows = '';

                response.html.data.forEach(function(record) {
                    rows += `
                    <tr>
                        <td>${record.date}</td>
                        <td>${record.sign_in}</td>
                        <td>${record.sign_out}</td>
                        <td>${record.total_time}</td>
                        <td>${record.type_name}</td>
                    </tr>
                `;
                });

                $('#tbody').html(rows);
                $('#pagination').html(response.pagination);
            }
        });
    }
</script>

</html>
