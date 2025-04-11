<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Details</title>
    <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
    <style>
        /* Basic Reset */
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: "Times New Roman", serif;
            letter-spacing: 5px;
            background-color: #f4f6f9;
            color: #333;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }

        .container {
            width: 90%;
            max-width: 700px;
            background-color: #fff;
            border-radius: 10px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
            padding: 40px;
            font-family: "Times New Roman", serif;
            letter-spacing: 0px;
            margin-top: 40px;
        }

        h1 {
            text-align: center;
            font-size: 24px;
            margin-bottom: 30px;
            color: #333;
        }

        .detail {
            border-bottom: 1px solid #e1e1e1;
            padding: 15px 0;
            display: flex;
            justify-content: space-between;
        }

        .label {
            font-weight: bold;
            color: #555;
        }

        .value {
            color: #777;
        }

        .button-container {
            text-align: center;
            margin-top: 30px;
        }

        .back-button {
            padding: 10px 20px;
            background-color: #007bff;
            color: white;
            text-decoration: none;
            border-radius: 5px;
            font-size: 16px;
            transition: background-color 0.3s ease;
        }

        .back-button:hover {
            background-color: #0056b3;
        }

        h2 {
            color: lightblue;
        }
    </style>
</head>

<body>
    
        <x-nav-attendence></x-nav-attendence>


    @foreach ($leave_count as $data)
        <div class="container">
            <h2>LEAVE BALANCE</h2>
            <div class="detail">
                <span hidden class="value">{{ $data->user_id }}</span>
            </div>
            <div class="detail">
                <span class="label">year:</span>
                <span class="value">{{ $data->year }}</span>
            </div>
            <div class="detail">
                <span class="label">casual leave:</span>
                <span class="value">{{ $data->casual_leave }}</span>
            </div>
            <div class="detail">
                <span class="label">sick leave</span>
                <span class="value">{{ $data->sick_leave }}</span>
            </div>
            <div class="detail">
                <span class="label">Earned leave</span>
                <span class="value">{{ $data->earned_leave }}</span>
            </div>

        </div>
    @endforeach

</body>

</html>
