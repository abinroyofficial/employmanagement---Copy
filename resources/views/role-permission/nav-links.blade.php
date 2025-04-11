<link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
<style>
    body{
        margin-top: 50px;
        font-family: "Times New Roman", serif;
    }
</style>
<x-nav-user></x-nav-user>
<div>
    @can('view permission')
    <a href="{{route('permissions.index')}}" class="btn btn-primary mx-2 mt-5">Permissions</a>
    @endcan
    @can('view role')
    <a href="{{route('roles.index')}}" class="btn btn-success mx-2 mt-5">roles</a>
    @endcan
    @can('view user')
    <a href="{{url('users')}}" class="btn btn-warning mx-2 mt-5">users</a>
    @endcan
    @can('create department')
    <a href="/add-department" class="btn btn-warning mx-2 mt-5">department</a>
    @endcan
    @can('add leave type')
    <a href="/add-leaveType" class="btn btn-warning mx-2 mt-5">leave type</a>
    @endcan
    
</div>