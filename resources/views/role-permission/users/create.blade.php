<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Create User</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body>
    <div class="container mt-5">
        <h1 class="mb-4">Create user</h1>


        <form action="{{ route('users.store') }}" method="POST">
            @csrf
            @if ($errors->any())
            @endif
            <p>
            <div class="mb-3">
                <label for="name" class="form-label">Name</label>
                <input type="text" class="form-control" id="name" name="name">
                @error('name')
                    <p class="text-red-400" style="color:red">{{ $message }}</p>
                @enderror
            </div>
            <div class="mb-3">
                <label for="name" class="form-label">email</label>
                <input type="email" class="form-control" id="email" name="email">
                @error('email')
                    <p class="text-red-400" style="color:red">{{ $message }}</p>
                @enderror
            </div>
            <div class="mb-3">
                <label for="name" class="form-label">password</label>
                <input type="password" class="form-control" id="password" name="password">
                @error('password')
                    <p class="text-red-400" style="color:red">{{ $message }}</p>
                @enderror
            </div>
            <div class="mb-3">
                <label for="roles" class="form-label">roles</label>
                <select name="roles[]" id="roles[]" class="form-control" multiple>
                    <option value="">select role</option>
                    @foreach ($roles as $role)
                        <option value="{{ $role }}">{{ $role }}</option>
                    @endforeach
                </select>
                @error('roles')
                    <p class="text-red-400" style="color:red">{{ $message }}</p>
                @enderror
            </div>


            <button type="submit" class="btn btn-success">Create user</button>
        </form>

        <a href="{{ route('users.index') }}" class="btn btn-secondary mt-3">Back to user page</a>
    </div>
</body>

</html>
