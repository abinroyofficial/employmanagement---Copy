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
    <h2>hello {{$user_name}} </h2>
    <h4>new task is added upt o you</h4>
    <h2>Task name is  {{$task_name}}</h2>
    <h3>and its dicribes about{{$task_description}}</h3>
    <h3>deadline is given as by{{$task_deadline}}</h3>
    <h4>best regard and wishes</h4>
    <h5>thank you</h5>


    <a href="{{ route('view_task') }}">view task</a>

</body>
</html>