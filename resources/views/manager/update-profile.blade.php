<!DOCTYPE html>
<html lang="en">
<meta charset="UTF-8">
<title>Manager Registration</title>
<meta name="viewport" content="width=device-width,initial-scale=1">
<link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css"
    integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">

<script src="https://code.jquery.com/jquery-3.7.1.min.js"
    integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js"
    integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous">
</script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js"
    integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous">
</script>

<style>
    .image {
        width: 100vw;
        padding: 10px;
        margin: 10px;
        height: 400px;
        margin-left: 1px;
        object-fit: cover;
    }

    body {
        font-family: "Times New Roman", serif;
        background-color: white;
        height: 100vh;
        display: flex;
        justify-content: center;
        align-items: center;
        margin: 0;
        background-image: url("../storage/images/top.jpg");
        background-size: cover;
    }

    h1,
    h2,
    h3,
    h4,
    h5,
    h6 {
        font-family: serif;
        letter-spacing: 5px;
    }

    #registration {
        width: 800px;
        height: auto;
    }

    .w3-container .w3-card-4 {
        padding: 32px;
        background-color: white;
        border-radius: 8px;
    }

    .w3-input {
        width: 100%;
        padding: 12px;
        border-radius: 4px;
        border: 1px solid #ccc;
    }

    .w3-button {
        padding: 12px;
        border-radius: 4px;
        width: 100%;
        cursor: pointer;
    }

    .error-message {
        color: red;
        font-size: 12px;
    }

    /* Flexbox styling for two fields in one row */
    .form-row {
        display: flex;
        justify-content: space-between;
        gap: 20px;
    }

    .form-row .form-group {
        flex: 1;
    }

    /* Optional styling for field labels */
    .form-group label {
        display: block;
        font-weight: bold;
    }
</style>

<body>

    <x-nav-user></x-nav-user>

    <div id="registration" class="w3-container">
        <br><br><br>


        <form action="{{ route('store-info') }}" method="post"
            class="w3-container w3-card-4 w3-padding-16 w3-white w3-round" enctype="multipart/form-data">
            @csrf


            <input type="hidden" value="{{ $user->id }}" id="user_id" name="user_id">
            <div class="form-row">
                <div class="form-group">
                    <label for="name"><b>Name</b></label>
                    <input class="w3-input w3-border" type="text" placeholder="Enter manager's full name"
                        name="name" id="name" value="{{ $user->name }}">
                    @error('name')
                        <p class="text-red-400" style="color:red">{{ $message }}</p>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="phone"><b>employ ID</b></label>
                    <input class="w3-input w3-border" type="text" placeholder="Enter employ id" name="employ_id"
                        id="employ_id">
                </div>
            </div>

            <div class="form-row">
                <div class="form-group">
                    <label for="email"><b>Email</b></label>
                    <input class="w3-input w3-border" type="email" placeholder="Enter manager's email" name="email"
                        id="email" value="{{ $user->email }}">
                    @error('email')
                        <p class="text-red-400" style="color:red">{{ $message }}</p>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="phone"><b>Phone Number</b></label>
                    <input class="w3-input w3-border" type="text" placeholder="Enter phone number" name="phone"
                        id="phone">
                </div>
            </div>

            <div class="form-row">
                <div class="form-group">
                    <label for="department"><b>Department</b></label>
                    <select class="w3-input w3-border" name="department" id="department">
                        @foreach($departments as $department)
                        <option value="{{$department->id}}">{{$department->dept_name}}</option>
                        @endforeach
                    </select>
                </div>

                <div class="form-group">
                    <label for="role"><b>Role</b></label>
                    <select class="w3-input w3-border" name="position" id="position">
                        <option value="">Select Role</option>
                        <option value="Senior Manager">Manager</option>
                        <option value="Assistant Manager">Staff</option>
                        <option value="Team Lead">Employ</option>
                    </select>
                </div>
            </div>

            <div class="form-row">
                <div class="form-group">
                    <label for="gender"><b>gender</b></label>
                    <select class="w3-input w3-border" type="text" name="gender" id="gender">
                        @foreach($genders as $gender)
                        <option value="{{$gender->id}}">{{$gender->gender_name}}</option>
                        @endforeach
                    </select>
                </div>
                <div class="form-group">
                    <label for="supervisor"><b>Reports To</b></label>
                    <select class="w3-input w3-border" name="supervisor" id="supervisor">
                        <option value="">Select Supervisor</option>
                        @foreach ($superadmins as $id => $superadmin)
                            <option value="{{ $id }}">{{ $superadmin }}</option>
                        @endforeach
                        @foreach ($seniormanagers as $id => $seniormanager)
                            <option value="{{ $id }}">{{ $seniormanager }}</option>
                        @endforeach
                        @foreach ($managers as $id => $manager)
                            <option value="{{ $id }}">{{ $manager }}</option>
                        @endforeach

                    </select>
                </div>
            </div>
            <div class="form-row">
                <div class="form-group">
                    <label for="work_time_from"><b>Work Time From</b></label>
                    <input class="w3-input w3-border" type="time" name="work_time_from" id="work_time_from">
                </div>
                <div class="form-group">
                    <label for="work_time_to"><b>Work Time To</b></label>
                    <input class="w3-input w3-border" type="time" name="work_time_to" id="work_time_to">
                </div>
            </div>

            <div class="form-row">
                <div class="form-group">
                    <label for="Salary"><b>Salary</b></label>
                    <input class="w3-input w3-border" type="text" name="salary" id="salary">
                </div>
                <div class="form-group">
                    <label for="leave"><b>leave applicable</b></label>
                    <input class="w3-input w3-border" type="text" name="leave" id="leave">
                </div>
            </div>
            <div class="form-row">
                <div class="form-group">
                    <label for="photo"><b>profile photo</b></label>
                    <input class="w3-input w3-border" type="file" name="photo" id="photo">
                </div>

            </div>
        <p>
                <button class="w3-button w3-light-grey w3-section w3-block w3-padding" type="submit"
                    id="submit-button">update details</button>
            </p>
        </form>
    </div>



</body>

</html>
