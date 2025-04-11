
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Create Permission</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container mt-5">
        <h1 class="mb-4">Create Permission</h1>

        
        <form action="{{url('permissions/'.$permission->id)}}" method="POST">
            @csrf
            @method('PUT')
            <div class="mb-3">
                <label for="name" class="form-label">Name</label>
                <input type="text" class="form-control" id="name" name="name" value="{{$permission->name}}">
            </div>
            
            <button type="submit" class="btn btn-success">Update Permission</button>
        </form>

        <a href="{{ route('permissions.index') }}" class="btn btn-secondary mt-3">Back to Permissions List</a>
    </div>
</body>
</html>
