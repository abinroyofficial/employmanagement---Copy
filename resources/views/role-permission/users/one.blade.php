<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Users</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body>
    @include('role-permission.nav-links')
    @if (session('status'))
        <div class="alert alert-success">{{ session('status') }}</div>
    @endif
    @if (session('status-delete'))
        <div class="alert alert-danger">{{ session('status-delete') }}</div>
    @endif
    <div class="container mt-5">
        <h1 class="mb-4">users</h1>
        @can('create user')
            <a href="{{ url('users/create') }}" class="btn btn-primary mb-3">Add users</a>
        @endcan



        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Name</th>
                    <th>Email</th>
                    <th>roles</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($users as $user)
                    <tr>
                        <td>{{ $user->id }}</td>
                        <td>{{ $user->name }}</td>
                        <td>{{ $user->email }}</td>
                        <td>
                            @if (!empty($user->getRoleNames()))
                                @foreach ($user->getRoleNames() as $rolename)
                                    <label class="badge bg-secondary mx-2">{{ $rolename }}</label>
                                @endforeach
                            @endif
                        </td>

                        <td>

                            @can('edit user')
                                <a href="{{ url('users/' . $user->id . '/edit') }}" class="btn btn-success  mx-2">edit</a>
                            @endcan
                            @can('delete user')
                                <a href="{{ url('users/' . $user->id . '/delete') }}"
                                    class="btn btn-danger  mx-2">delete</a>
                            @endcan
                            @can('update user biodata')
                                @if (empty(App\Models\Manager::where('user_id', $user->id)->first()))
                                    <a href="{{ url('updateinfo/' . $user->id) }}" class="btn btn-warning mx-2">Add
                                        Info</a>
                                @else
                                    <span>user data updated</span>
                                @endif
                            @endcan

                            @can('add user leave')
                                @if (empty(App\Models\UserLeave::where('user_id', $user->id)->where('year',\Carbon\Carbon::today()->year)->first()))
                                    <a href="{{ url('addleaveData/' . $user->id) }}" class="btn btn-primary mx-2">Add
                                        Leave Data</a>
                                @else
                                    <span>done</span>
                                @endif
                            @endcan

                        </td>
                    </tr>
                @endforeach

            </tbody>
        </table>
    </div>
</body>

</html>
