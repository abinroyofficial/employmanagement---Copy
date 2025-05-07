<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Catering</title>
    <meta name="viewport" content="width=device-width,initial-scale=1">

    <!-- W3CSS and Font Awesome -->
    <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
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
        body {
            margin: 0;
            padding: 0;
            font-family: "Times New Roman", serif;
        }

        h1,
        h2,
        h3,
        h4,
        h5,
        h6 {
            font-family: serif;
        }

        .image {
            width: 100vw;
            padding: 10px;
            margin: 10px;
            height: 100vh;
            margin-left: 1px;
            object-fit: cover;
        }

        .image_1 {
            width: 100vw;
            padding: 10px;
            margin: 10px;
            height: 400px;
            margin-left: 0;
            object-fit: cover;
        }

        /* Notification Styles */
        .notification-bell {
            position: relative;
            display: inline-block;
        }

        .notification-bell .badge {
            position: absolute;
            top: -5px;
            right: -5px;
            padding: 5px 7px;
            border-radius: 50%;
            background-color: red;
            color: white;
            font-size: 10px;
        }

        .dropdown-content {
            display: none;
            position: absolute;
            right: 0;
            background-color: #f9f9f9;
            min-width: 250px;
            box-shadow: 0px 8px 16px 0px rgba(0, 0, 0, 0.2);
            z-index: 1;
        }

        .dropdown-content a {
            padding: 10px;
            display: block;
            text-decoration: none;
            color: black;
        }

        .dropdown-content a:hover {
            background-color: #ddd;
        }
    </style>
</head>

<body>

    <!-- Your Navigation Blade Component -->
    <x-nav-user></x-nav-user>
    <br><br><br>

    <!-- Notification Bell -->
    <div class="w3-container w3-padding w3-right-align">
        <div class="notification-bell">
            <button onclick="details()" class="w3-button w3-white">
                <i class="fa-solid fa-bell fa-lg"></i>
                <span id="notification-badge" class="badge" style="display: none;">10</span>
            </button>
            <div id="notification-menu" class="dropdown-content">
                <a href="#">You have been assigned a new task. Check your email.</a>

            </div>
        </div>
    </div>

    <!-- Main Content -->
    <div id="home" class="w3-content">

        <!-- About Section -->
        <div id="about" class="w3-padding-top-64">
            <div class="w3-row">
                <div class="w3-half w3-padding-large w3-hide-small"></div>

                <div class="w3-half w3-padding-large">
                    <h1 class="w3-center">EMPLOY 365</h1>
                    <h5 class="w3-center">Employee Management System</h5>
                    <p class="w3-large">
                        An Employee Management System (EMS) is a software application designed to streamline and
                        automate the management of an organization's workforce. It centralizes employee data,
                        tracks key aspects of employee performance, and helps HR departments with tasks like
                        recruitment, payroll, attendance, leave management, and performance evaluations.
                    </p>
                    <p class="w3-large w3-text-grey w3-hide-medium">
                        Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit
                        anim id est laborum consectetur adipiscing elit, sed do eiusmod tempor incididunt ut
                        labore et dolore magna aliqua.
                    </p>
                    <p class="w3-large w3-text-grey w3-hide-medium">
                        Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit
                        anim id est laborum consectetur adipiscing elit, sed do eiusmod tempor incididunt ut
                        labore et dolore magna aliqua.
                    </p>
                </div>
            </div>
        </div>

    </div>


    <script>
        // Load notification count when page loads
        function loadNotificationCount() {
            $.ajax({
                url: "{{ route('notifications.fetch') }}",
                method: "GET",
                success: function(data) {
                    if (data.length > 0) {
                        $('#notification-badge').text(data.length).show();
                    } else {
                        $('#notification-badge').val == 0;
                    }
                }
            });
        }


        function details() {
            const menu = document.getElementById("notification-menu");

            $.ajax({
                url: "{{ route('notifications.fetch') }}",
                method: "GET",
                success: function(data) {
                    $('#notification-menu').empty();

                    if (data.length > 0) {
                        $('#notification-badge').text(data.length).show();
                        data.forEach(notification => {
                            $('#notification-menu').append(
                                `<a href="#" class="notification-item" data-task-id="${notification.data.id}">${notification.data.message}</a>`
                            );


                        });

                    } else {
                        $('#notification-menu').append('<a href="#">No  Notifications</a>');
                        $('#notification-badge').hide();
                    }

                    menu.style.display = "block";
                }
            });
        }


        $(document).ready(function() {
            loadNotificationCount();
        });
    </script>

    <script>
        $(document).on('click', '.notification-item', function() {
            const taskId = $(this).data('task-id');
            $.ajax({
                url: "/view_task_not",
                type: 'GET',
                success: function(response) {
                    window.location.href = "/view_task" ;

                },
            });



        });
    </script>

</body>

</html>
