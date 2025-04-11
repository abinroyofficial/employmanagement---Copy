<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Role Permissions</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        /* Full-screen container */
        .container {
            min-height: 30vh;
            display: flex;
            justify-content: center;
            align-items: center;
            padding-top: 50px;
        }

        /* Card styling */
        .card {
            width: 100%;
            max-width: 800px; /* Adjust width as needed */
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
            border-radius: 10px;
            background-color: #fff;
        }

        .card-header {
            background-color: #007bff;
            color: white;
            padding: 1.25rem;
            border-radius: 10px 10px 0 0;
        }

        .card-body {
            padding: 2rem;
        }

        /* Button styling */
        .btn-back {
            background-color: #dc3545;
            color: white;
            font-size: 0.9rem;
            transition: background-color 0.3s;
        }

        .btn-back:hover {
            background-color: #c82333;
        }

        .btn-save {
            width: 100%;
            padding: 0.75rem;
            font-size: 1.2rem;
            background-color: #28a745;
            color: white;
            border-radius: 5px;
            transition: background-color 0.3s;
        }

        .btn-save:hover {
            background-color: #218838;
        }

        /* Styling for checkboxes */
        .form-check {
            margin-bottom: 10px;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .form-check-label {
            margin-left: 10px;
        }

        .form-check-input {
            margin-top: 5px;
        }

        /* Adjust layout for small screens */
        @media (max-width: 576px) {
            .card {
                max-width: 100%;
                padding: 1rem;
            }

            .btn-save {
                font-size: 1rem;
            }

            .form-check {
                flex-direction: column;
                align-items: flex-start;
            }
        }

        /* Custom styles for form-checks */
        .form-check-row {
            display: flex;
            justify-content: space-between;
            margin-bottom: 15px;
            align-items: center;
        }

        .form-check-row input {
            margin-top: 0;
        }
    </style>
</head>
<body>

<div class="container">
    <div class="row w-100">
        <div class="col-md-12">
            <div class="card shadow-lg rounded-3">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h4>Role: {{ $role->name }}</h4>
                    <a href="/roles" class="btn btn-back btn-sm">Back</a>
                </div>
                <div class="card-body">
                    <form action="/roles/{{ $role->id }}/give-permissions" method="post">
                        @csrf
                        @method('PUT')
                        <div class="container mb-4">
                            @foreach ($permissions as $permission)
                                <div class="form-check form-check-row">
                                    <input 
                                        class="form-check-input" 
                                        type="checkbox" 
                                        name="permission[]" 
                                        value="{{ $permission->name }}" 
                                        id="permission_{{ $permission->id }}"
                                        @if (in_array($permission->id, $permission_id)) checked @endif
                                    >
                                    <label class="form-check-label" for="permission_{{ $permission->id }}">
                                        {{ $permission->name }}
                                    </label>
                                </div>
                            @endforeach
                        </div>
                        <div class="form-group mb-3 text-center">
                            <button type="submit" class="btn-save">Save</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
