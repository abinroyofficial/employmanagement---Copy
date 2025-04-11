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
        h3{
            color: darkgreen;
        }
        a{
            text-decoration: none;
        }
    </style>
</head>
<body>
    <h2>hello {{$name}} </h2>
    <h4>this is your official registrerd  email and password </h4>
    <h2>email id : {{$email}}</h2>
    <h3>one time password is : {{$password}}</h3>
    <p>you must reset password after successfull login the password that provided is one time use only</p>
    <p>and you are appointed as <h2>{{$roles}}</h2> in this company </p>
    <h3>we are very glad to welcome you .....</h3>
    <h4>best regard and wishes</h4>
    <h5>thank you</h5>


    <a href="{{ route('login') }}">LOG IN</a>

</body>
</html>