<!DOCTYPE html>
<html lang="en">
<meta charset="UTF-8">
<title>Catering</title>
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
        height: 600px;
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
</style>

<body>

    <x-nav></x-nav>

    <div id="registration" class="w3-container">
        <h1 class="w3-center">Registration</h1>

        <form action="{{route('register')}}" method="post" class="w3-container w3-card-4 w3-padding-16 w3-white w3-round">
            @csrf
            @if ($errors->any())
            @endif
            <p>
                <label for="name"><b>Name</b></label>
                <input class="w3-input w3-border" type="text" placeholder="Enter your full name" name="name"
                    id="name">
                @error('name')
                <p class="text-red-400" style="color:red">{{ $message }}</p>
            @enderror
            </p>

            <p>
                <label for="email"><b>Email</b></label>
                <input class="w3-input w3-border" type="email" placeholder="Enter your email" name="email"
                    id="email">
                @error('email')    
                <p class="text-red-400" style="color:red">{{ $message }}</p>
            @enderror
            </p>
            <p id="emailcheck" style="color:red"></p>

            

            <p>
                <label for="password"><b>Password</b></label>
                <input class="w3-input w3-border" type="password" placeholder="Create a password" name="password"
                    id="password">
                @error('password')
                <p class="text-red-400" style="color:red">{{ $message }}</p>
            @enderror
            </p>

            <p>
                <label for="confirm_password"><b>Confirm Password</b></label>
                <input class="w3-input w3-border" type="password" placeholder="Confirm your password"
                    name="password_confirmation" id="password_confirmation">
                @error('password_confirmation')
                <p class="text-red-400" style="color:red">{{ $message }}</p>
                @enderror
            </p>

            
            <p id="password-error-before" class="error-message" style="font-size: 18px"></p>
            <p id="password-error-after" style="color:green;font-size: 18px"></p>

            <p>
                <button class="w3-button w3-light-grey w3-section w3-block w3-padding" type="submit" id="submit-button">Register</button>
            </p>
        </form>
    </div>

    <script>
        $(document).ready(function() {
           
            $("#email").on('keyup', function() {
                var input = document.getElementById("email").value;
                $("#emailcheck").text("");

                $.ajax({
                    type: 'GET',
                    url: '/registration-email',
                    data: {
                        email_input: input
                    },
                    success: function(response) {
                        $("#emailcheck").append(response);
                    }
                });
            });

            

            $("#password_confirmation").on('input', function() {
                var password = $("#password").val();
                var confirmPassword = $("#password_confirmation").val();
                $("#password-error-before").text(""); 
                $("#password-error-after").text(""); 

                
                if (password && confirmPassword) {
                    if (password == confirmPassword) {
                        $("#password-error-after").text("Password  match.");
                        $("#submit-button").attr("disabled", false); 
                    } else {
                        $("#password-error-before").text("Password not match.");
                        $("#submit-button").attr("disabled", true);

                    }
                }
            });

        });
    </script>

</body>

</html>

