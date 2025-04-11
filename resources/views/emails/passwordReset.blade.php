<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <style>
        h2{
            color: aquamarine;

        }
        a{
            text-decoration: none;
        }
    </style>
</head>
<body>
    <h2>hello {{$user->name}} </h2>
    <h4>please click below to reset password</h4>
    <a href="{{ url('/resetPassword/'.$token) }}">Reset Password</a>

</body>
</html>