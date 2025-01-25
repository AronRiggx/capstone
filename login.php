<?php

include_once("../connect.php");

if (isset($_POST['submit'])) {
    $name = $_POST['email'];
    $password = $_POST['password'];

    $result = mysqli_query($conn, "SELECT * FROM users WHERE email = '$name'");
    $row = mysqli_fetch_assoc($result);

    if (mysqli_num_rows($result) > 0) {
        if ($password == $row["password"]) {
            $_SESSION['isLoggedIn'] = true;
            $_SESSION["id"] = $row["user_id"];
            $_SESSION["firstName"] = $row["first_name"];

            if ($row["user_id"] == 1) {
                header("Location: ../adminProducts.php");
            } else {
                header("Location: ../indexAM.php");
            }
        } else {
            echo "<script> alert('Wrong password');</script>";
        }
    } else {
        echo "<script> alert('User not registered');</script>";
    }
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>FeedEat</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=Athiti:wght@200;300;400;500;600;700&family=Lato:ital,wght@0,100;0,300;0,400;0,700;0,900;1,100;1,300;1,400;1,700;1,900&family=Merriweather:ital,wght@0,300;0,400;0,700;0,900;1,300;1,400;1,700;1,900&family=Roboto:ital,wght@0,100..900;1,100..900&display=swap"
        rel="stylesheet">

</head>

<body>

    <div class="login-container">
        <h2 class="text-center pb-3" style="font-size: 30px;">Welcome to FeedEat</h2>
        <form action="login.php" method="POST">
            <div class="form-group">
                <input type="text" name="username" class="form-control" placeholder="Username" required>
            </div>
            <div class="form-group">
                <input type="password" name="password" class="form-control" placeholder="Password" required>
            </div>
            <button type="submit" class="btn btn-primary btn-block">Login</button>
        </form>

        <div class="forgot-password mt-3">
            <a href="#">Forgot Password?</a>
        </div>
        <div class="sign-up mt-2">
            <span>Don't have an account? <a href="signup.html">Sign Up</a></span>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.3/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
<style>
    body {
        font-family: Roboto, serif;
        background-color: #f4f4f9;
        display: flex;
        justify-content: center;
        align-items: center;
        height: 100vh;
    }

    .login-container {
        background-color: #fff;
        padding: 40px;
        border-radius: 10px;
        box-shadow: 0px 4px 8px rgba(0, 0, 0, 0.1);
        width: 100%;
        max-width: 400px;
    }

    .forgot-password,
    .sign-up {
        text-align: center;
    }

    .forgot-password a,
    .sign-up a {
        text-decoration: none;
        color: #007bff;
    }

    .forgot-password a:hover,
    .sign-up a:hover {
        text-decoration: underline;
    }
</style>

</html>