<!DOCTYPE html>
<html lang="en">
<meta charset="UTF-8">
<title>Catering</title>
<meta name="viewport" content="width=device-width,initial-scale=1">
<link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
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
</style>

<body>


    <x-nav></x-nav>

    <div id="registration" class="w3-container">
        <h1 class="w3-center">Registration</h1>

        <form action="{{ route('password.store') }}" method="post" class="w3-container w3-card-4 w3-padding-16 w3-white w3-round">
            @csrf
            @if ($errors->any())
            @endif
            <p>
                
                <input class="w3-input w3-border" type="hidden" value={{$user_id}} name="id"
                    id="id" readonly>
                @error('id')
                <p class="text-red-400" style="color:red">{{ $message }}</p>
            @enderror
            </p>
            <p>
                
                <input class="w3-input w3-border" type="hidden" value={{$token}} name="token"
                    id="token" >
                @error('token')
                <p class="text-red-400" style="color:red">{{ $message }}</p>
            @enderror
            </p>

            <p>
                <label for="email"><b>Email</b></label>
                <input class="w3-input w3-border" type="email" value={{$email}} name="email"
                    id="email" readonly>
                @error('email')
                <p class="text-red-400" style="color:red">{{ $message }}</p>
            @enderror
            </p>


            <p>
                <label for="password"><b>Password</b></label>
                <input class="w3-input w3-border" type="password" placeholder="Create new  password" name="password"
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

            <p>
                <button class="w3-button w3-light-grey w3-section w3-block w3-padding" type="submit">reset
                    password</button>
            </p>
        </form>
    </div>


</body>

</html>
