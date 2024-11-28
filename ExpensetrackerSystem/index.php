<?php 
    include_once "init.php";
    
    // User login check
    if (isset($_SESSION['UserId'])) {
      header('Location: templates/3-Dashboard.php');
    }

    // Validate credentials and log the user in
    if (isset($_POST['login']) && !empty($_POST)) {
        $password = $_POST['password'];
        $username = $_POST['username'];
        
        if(!empty($username) || !empty($password)) {
            $username = $getFromU->checkInput($username);
            $password = $getFromU->checkInput($password);
            if($getFromU->login($username, $password) === false) {
            $error = "The username or password is incorrect";
            }
          } 
    }
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" href="static/images/wallet.png" sizes="16x16" type="image/png">
    <link href="https://fonts.googleapis.com/css2?family=Baloo+Bhai+2:wght@400;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <title>Expense Tracker</title>
    <style>
        body {
            margin: 0;
            font-family: 'Baloo Bhai 2', sans-serif;
            background: url('static/images/bg.jpg') no-repeat center center fixed;
            background-size: cover;
            color: #333;
        }

        header {
            background-color: rgba(240, 244, 248, 0.8);
            padding: 20px;
            text-align: center;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
        }

        header h1 {
            margin: 0;
            font-size: 2.5rem;
            color: #333;
        }

        header p {
            margin: 5px 0;
            font-size: 1rem;
            color: #555;
        }

        /* Container for login form and image */
        .container {
            display: flex;
            justify-content: center; /* Align to right */
            align-items: flex-start; /* Align content to the top */
            min-height: calc(100vh - 80px);
            padding: 20px;
        }

        /* Login form container */
        .login-container {
            background-color: rgba(0, 0, 0, 0.5);
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
            width: 500px; /* Reduced width */
            display: flex;
            flex-direction: column;
            align-items: center;
            text-align: center;
        }

        .login-form {
            display: flex;
            flex-direction: column;
            justify-content: center;
            color: #fff;
            width: 100%;
        }

        .login-form h1 {
            margin-bottom: 20px;
            font-size: 1.8rem;
        }

        .form-controller {
            margin-bottom: 20px;
            position: relative;
        }

        .form-controller i {
            position: absolute;
            top: 12px;
            left: 10px;
            color: #aaa;
        }

        .form-controller input {
            width: 100%;
            padding: 10px 10px 10px 35px;
            border: 1px solid #ddd;
            border-radius: 5px;
            box-sizing: border-box; /* Ensures padding doesn't cause overflow */
        }

        .form-controller input:focus {
            outline: none;
            border-color: #007bff;
        }

        .sign-in {
            width: 100%;
            padding: 10px;
            background-color: #007bff;
            color: #fff;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            font-weight: bold;
            font-size: 1rem;
        }

        .sign-in:hover {
            background-color: #0056b3;
        }

        .new-account {
            text-align: center;
            margin-top: 10px;
        }

        .new-account a {
            text-decoration: none;
            color: #007bff;
            font-weight: bold;
        }

        /* Styling for the login image */
        .login-image {
            width: 200px;
            height: auto;
            border-radius: 8px;
            margin-top: 20px;
        }

        /* Responsive adjustments for smaller screens */
        @media (max-width: 768px) {
            .login-container {
                width: 100%;
                padding: 15px;
            }

            .login-form {
                width: 100%;
            }

            .login-image {
                width: 150px;
                margin-top: 20px;
            }
        }
        
    </style>
</head>

<body>
    <!-- Header Section -->
    <?php include "header.php"; ?>
    <!-- Welcome Section -->
<div class="welcome-container">
    <br>
    <h1 style="text-align: center;">Welcome to Expense Tracker and Management System</h1>
</div>

    <!-- Main Container -->
    <div class="container">
        <!-- Login Box -->
        <div class="login-container">
            <!-- Login Form -->
            <div class="login-form">
           <strong> Manage your expenses easily!</strong>
                <h1>Log In</h1>
                <form action="index.php" method="post" onsubmit="return validate()" id="form1">
                    <div class="form-controller">
                        <i class="fa fa-user"></i>
                        <input type="text" name="username" placeholder="Username" id="user1" required>
                    </div>
                    <div class="form-controller">
                        <i class="fa fa-lock"></i>
                        <input type="password" name="password" placeholder="Password" id="pass1" autocomplete="on" required>
                    </div>
                    <button type="submit" class="sign-in" name="login">Log In</button>
                    <?php
                    if (isset($error)) {
                        $font = "Source Sans Pro";
                        echo '<div style="color: red; font-family:' . $font . '; text-align:center; margin-top:10px;">' . $error . '</div>';
                    }
                    ?>
                    <div class="new-account">
                        <span>Don't have an account?</span>
                        <a href="templates/2-sign-up.php">Sign Up Now</a>
                    </div>
                </form>
            </div>

            <!-- Login Image Below the Form -->
            <img src="static/images/login.png" alt="Login Image" class="login-image">
        </div>
    </div>

    <script src="static/js/index.js"></script>
</body>

</html>
