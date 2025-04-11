<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Permissions</title>
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
        <h1 class="mb-4">Permissions</h1>
        @can('create permission')
            <a href="{{ url('permissions/create') }}" class="btn btn-primary mb-3">Add Permission</a>
        @endcan



        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Name</th>
                    <th>Guard Name</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($permission as $item)
                    <tr>
                        <td>{{ $item->id }}</td>
                        <td>{{ $item->name }}</< /td>
                        <td>{{ $item->guard_name }}</< /td>
                        <td>
                            @can('edit permission')
                                <a href="{{ url('permissions/' . $item->id . '/edit') }}"
                                    class="btn btn-success  mx-2">edit</a>
                            @endcan
                            @can('delete permission')
                                <a href="{{ url('permissions/' . $item->id . '/delete') }}"
                                    class="btn btn-danger  mx-2">delete</a>
                            @endcan
                        </td>
                    </tr>
                @endforeach

            </tbody>
        </table>
    </div>
</body>

</html>
