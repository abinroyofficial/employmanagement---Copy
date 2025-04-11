<!DOCTYPE html>
<html lang="en">
<meta charset="UTF-8">
<title>Manager Registration</title>
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
        <form action="/store-department" method="post" class="w3-container w3-card-4 w3-padding-16 w3-white w3-round">
            @csrf
            <div class="form-row">
                <div class="form-group">
                    <label for="name"><b>Name</b></label>
                    <input class="w3-input w3-border" type="text" placeholder="Enter department name"
                        name="dept_name" id="dept_name">
                </div>
            </div>
            <div class="form-row">
                <div class="form-group">
                    <label for="dept_code"><b>dept code</b></label>
                    <input class="w3-input w3-border" type="text" name="dept_code" id="dept_code">
                </div>
            </div>

            <p>
                <button class="w3-button w3-light-grey w3-section w3-block w3-padding" type="submit"
                    id="submit-button">add department</button>
            </p>
        </form>
    </div>



</body>

</html>
