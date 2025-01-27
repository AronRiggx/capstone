<?php
session_start();
session_destroy();
session_start();

include_once "connect.php";

$error = ""; // Initialize error message

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["submit"])) {
    $username = $_POST["username"];
    $password = $_POST["password"];

    $query = "SELECT UserID FROM user WHERE Username = ? AND Password = ?";
    $stmt = mysqli_prepare($conn, $query);
    mysqli_stmt_bind_param($stmt, "ss", $username, $password);
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);

    if (mysqli_num_rows($result) > 0) {
        $row = mysqli_fetch_assoc($result);
        $_SESSION["loggedin"] = true;
        $_SESSION["userid"] = $row['UserID']; // Store the numerical user ID in the session
        header("location: index.php?id=" . $row['UserID']);
    } else {
        // Check if the username exists in the database
        $query_username = "SELECT * FROM user WHERE Username = ?";
        $stmt_username = mysqli_prepare($conn, $query_username);
        mysqli_stmt_bind_param($stmt_username, "s", $username);
        mysqli_stmt_execute($stmt_username);
        $result_username = mysqli_stmt_get_result($stmt_username);

        if (mysqli_num_rows($result_username) > 0) {
            $error = "Wrong password.";
        } else {
            $error = "No username with this account was found.";
        }
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
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@100;300;400;500;700&display=swap" rel="stylesheet">
</head>

<body>
    <div class="container-fluid d-flex align-items-center justify-content-center vh-100">
        <div class="d-flex flex-row align-items-stretch rounded shadow-lg overflow-hidden login-wrapper">
            <!-- Image Section -->
            <div class="image-section">
                <img src="https://i.ibb.co/JkNXJry/bg.jpg" alt="FeedEat Illustration" class="img-fluid rounded-start">
            </div>

            <!-- Login Form Section -->
            <div class="login-container p-4">
                <h2 class="text-center pb-3" style="font-size: 30px;">Welcome to FeedEat</h2>
                <form action="login.php" method="POST">
                    <?php if (!empty($error)): ?>
                        <div class="error-message text-danger"><?php echo $error; ?></div>
                    <?php endif; ?>
                    <div class="form-group">
                        <input type="text" name="username" class="form-control" placeholder="Username" required>
                    </div>
                    <div class="form-group">
                        <input type="password" name="password" class="form-control" placeholder="Password" required>
                    </div>
                    <button type="submit" name="submit" class="btn btn-primary btn-block">Login</button>
                </form>

                <div class="forgot-password mt-3">
                    <a href="#">Forgot Password?</a>
                </div>
                <div class="sign-up mt-2">
                    <span>Don't have an account? <a href="signup.php">Sign Up</a></span>
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
        background-color: rgba(255, 255, 255, 0.9);
        /* Semi-transparent white */
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

    .login-container {
        flex: 1;
        display: flex;
        flex-direction: column;
        justify-content: center;
        padding: 40px;
        border-top-right-radius: 10px;
        border-bottom-right-radius: 10px;
        background-color: #fff;
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