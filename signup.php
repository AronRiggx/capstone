<?php
session_start();

include "connect.php";

if (isset($_POST["submit"])) {

  $uName = $_POST["username"];
  $email = $_POST["email"];
  $pass = $_POST["password"];
  $firstName = $_POST["firstName"];
  $lastName = $_POST["lastName"];
  $conF = $_POST["confirm_password"];


  // Insert into riceque_info table
  $insertquery = "INSERT INTO user (Username, Email, Password, firstName, lastName) 
  VALUES ('$uName',  '$email', '$pass', '$firstName', '$lastName')";
  // Execute both queries
  $results = executeQuery($insertquery);
  
  // Redirect to login.php
  header("Location: login.php");
  exit(); 
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sign Up to FeedEat</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=Roboto:wght@100;300;400;500;700&display=swap"
        rel="stylesheet">
</head>

<body>
    <div class="container-fluid d-flex align-items-center justify-content-center vh-100">
        <div class="d-flex flex-row align-items-stretch rounded shadow-lg overflow-hidden login-wrapper">
            <!-- Image Section -->
            <div class="image-section">
                <img src="https://i.ibb.co/JkNXJry/bg.jpg" alt="FeedEat Illustration" class="img-fluid rounded-start">
            </div>

            <!-- Sign-Up Form Section -->
            <div class="signup-container p-4">
                <h2 class="text-center pb-3" style="font-size: 30px;">Create Your Account</h2>
                <form action="signup.php" method="POST">
                    <div class="form-group">
                        <input type="text" name="username" class="form-control" placeholder="Username" required>
                    </div>
                    <div class="form-group">
                        <input type="text" name="firstName" class="form-control" placeholder="First Name" required>
                    </div>
                    <div class="form-group">
                        <input type="text" name="lastName" class="form-control" placeholder="Last Name" required>
                    </div>
                    <div class="form-group">
                        <input type="email" name="email" class="form-control" placeholder="Email" required>
                    </div>
                    <div class="form-group">
                        <input type="password" name="password" class="form-control" placeholder="Password" required>
                    </div>
                    <div class="form-group">
                        <input type="password" name="confirm_password" class="form-control" placeholder="Confirm Password" required>
                    </div>
                    <button type="submit" name="submit" class="btn btn-primary btn-block">Sign Up</button>
                </form>

                <div class="login-redirect mt-3">
                    <span>Already have an account? <a href="login.php">Login</a></span>
                </div>
            </div>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.3/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>

<style>
    body {
        font-family: 'Roboto', sans-serif;
        background: 
            linear-gradient(rgba(255, 218, 67, 0.8), rgba(255, 218, 67, 0.8)), 
            url('https://i.ibb.co/fdTVfDX/food-bg.png') no-repeat center center fixed;
        background-size: cover;
        margin: 0;
    }

    .login-wrapper {
        max-width: 800px;
        width: 100%;
        background-color: rgba(255, 255, 255, 0.9); /* Semi-transparent white */
        border-radius: 10px;
        overflow: hidden;
    }

    .image-section {
        flex: 1;
    }

    .image-section img {
        width: 100%;
        height: 100%;
        object-fit: cover;
        border-top-left-radius: 10px;
        border-bottom-left-radius: 10px;
    }

    .signup-container {
        flex: 1;
        display: flex;
        flex-direction: column;
        justify-content: center;
        padding: 40px;
        border-top-right-radius: 10px;
        border-bottom-right-radius: 10px;
        background-color: #fff;
    }

    .login-redirect {
        text-align: center;
    }

    .login-redirect a {
        text-decoration: none;
        color: #007bff;
    }

    .login-redirect a:hover {
        text-decoration: underline;
    }
</style>

</html>