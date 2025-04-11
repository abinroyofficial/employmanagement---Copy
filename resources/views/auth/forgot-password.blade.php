<!DOCTYPE html>
<html lang="en">
<meta charset="UTF-8">
<title>Login</title>
<meta name="viewport" content="width=device-width,initial-scale=1">
<link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
<style>
    /* Body styling */
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

    /* Style for the Login form */
    #login {
        width: 100%;
        max-width: 600px;
        /* Medium sized div */

        border-radius: 8px;
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
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



    .w3-container .w3-card-4 {
        padding: 32px;
        background-color: white;
        border-radius: 8px;
    }

    .w3-center {
        text-align: center;
    }

    a {
        text-decoration: none;
    }
</style>

<body>
    <x-nav></x-nav>

    <div id="login" class="w3-container">
        <h1 class="w3-center">forgot password</h1>

        <form action="{{ route('password.email') }}" method="post" class="w3-container w3-card-4 w3-padding-16 w3-white w3-round">
            @csrf
            @if (session()->has('message'))
                <h5 style="color: red ;font-family:'Times New Roman', Times, serif ;letter-spacing:0px">{{ session()->get('message') }}</h5>
            @endif
            @if ($errors->any())
            @endif

            <p>
                <label for="email"><b>Email</b></label>
                <input class="w3-input w3-border" type="email" placeholder="Enter your email" name="email"
                    id="email">
                @error('email')
                <p style="color:red;">{{ $message }}</p>
            @enderror
            </p>
            

            <p>
                <button class="w3-button w3-light-grey w3-section w3-block w3-padding" type="submit">submit</button>
            </p>

            
        </form>
    </div>


</body>

</html>



    
