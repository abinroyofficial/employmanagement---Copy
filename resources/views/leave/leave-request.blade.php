<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Leave Request Form</title>
    <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
    <style>
        body {
            font-family: "Times New Roman", serif;
            background-color: #f4f4f4;

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

        .btn {
            display: block;
            width: 100%;
            padding: 12px;
            background-color: grey;
            color: white;
            border: none;
            border-radius: 4px;
            font-size: 16px;
            cursor: pointer;
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

    <div class="container">
        <h5>Leave Request Form</h5>

        <form action="/leave" method="POST">
            @csrf
            <input type="hidden" name="user_id" id="user_id" value="{{ $data->user_id }}">

            <label for="">DATE OF APPLICATION :</label>
            <p>{{ \Carbon\Carbon::today()->toDateString() }}</p>
            <div class="form-group">
                <label for="leaveType">Leave Type</label>
                <select id="leaveType" name="leave_type" required>
                    <option value="">Select Leave Type</option>
                    @foreach ($leave_types as $leave_type)
                        @if ($leave_type->id == 1 && $leave_count->casual_leave > 0)
                            <option value="{{ $leave_type->id }}">{{ $leave_type->type_name }}</option>
                        @elseif ($leave_type->id == 2 && $leave_count->sick_leave > 0)
                            <option value="{{ $leave_type->id }}">{{ $leave_type->type_name }}</option>
                        @elseif ($leave_type->id == 3 && $leave_count->earned_leave > 0)
                            <option value="{{ $leave_type->id }}">{{ $leave_type->type_name }}</option>
                        @elseif ($leave_type->id == 4 )
                            <option value="{{ $leave_type->id }}">{{ $leave_type->type_name }}</option>
                        @else
                        
                        @endif
                    @endforeach
                </select>
            </div>


            <div class="display">
                <div class="form-group">
                    <label for="fromDate">From</label>
                    <input type="date" id="fromDate" name="from_date" required>
                </div>

                <div class="form-group">
                    <label for="toDate">To</label>
                    <input type="date" id="toDate" name="to_date" required>
                </div>
            </div>


            <div class="form-group">
                <label for="session">Session</label>
                <select id="session" name="session" required>
                    <option value="">Select Session</option>
                    @foreach ($sessions as $session)
                        <option value="{{ $session->id }}">{{ $session->session_name }}</option>
                    @endforeach

                </select>
            </div>


            <div class="form-group">
                <label for="reason">Reason for Leave</label>
                <select id="reason" name="reason" required>
                    <option value="">Select Reason</option>
                    <option value="illness">Illness</option>
                    <option value="personal">Personal</option>
                    <option value="family">Family Emergency</option>
                    <option value="vacation">Vacation</option>
                    <option value="others">Other</option>
                </select>
            </div>


            <div class="form-group">
                <label for="remarks">Remarks</label>
                <textarea id="remarks" name="remarks" placeholder="Additional remarks or details (optional)"></textarea>
            </div>




            <button type="submit" class="btn">Submit Request</button>
        </form>
    </div>

</body>

</html>
