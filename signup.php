<?php
session_start();
include_once "connect.php";

if (isset($_POST["submit"])) {
    $uName = isset($_POST["username"]) ? mysqli_real_escape_string($conn, $_POST["username"]) : "";
    $email = isset($_POST["email"]) ? mysqli_real_escape_string($conn, $_POST["email"]) : "";
    $pass = isset($_POST["password"]) ? $_POST["password"] : "";
    $firstName = isset($_POST["firstName"]) ? mysqli_real_escape_string($conn, $_POST["firstName"]) : "";
    $lastName = isset($_POST["lastName"]) ? mysqli_real_escape_string($conn, $_POST["lastName"]) : "";
    $conF = isset($_POST["confirm_password"]) ? $_POST["confirm_password"] : "";
    $age = isset($_POST["age"]) && $_POST["age"] !== "" ? (int) $_POST["age"] : "NULL";
    $gender = isset($_POST["gender"]) ? mysqli_real_escape_string($conn, $_POST["gender"]) : "";

    // Validate Age
    if ($age !== "NULL" && ($age <= 0 || $age > 120)) {
        echo "<script>alert('Invalid age. Please enter a valid age between 1 and 120.');</script>";
        exit();
    }

    // Check if passwords match
    if ($pass !== $conF) {
        echo "<script>alert('Passwords do not match. Please try again.');</script>";
        exit();
    }

    // Check for existing username or email
    $checkQuery = "SELECT * FROM user WHERE Username = '$uName' OR Email = '$email' OR age = $age";
    $result = mysqli_query($conn, $checkQuery);

    if (mysqli_num_rows($result) > 0) {
        echo "<script>alert('Username, Email, or Age is already in use. Please use different details.');</script>";
        exit();
    }

    // Hash password before storing
    $hashedPass = password_hash($pass, PASSWORD_BCRYPT);

    // Insert user into the database
    $insertquery = "INSERT INTO user (Username, Email, Password, firstName, lastName, age, gender) 
                    VALUES ('$uName', '$email', '$hashedPass', '$firstName', '$lastName', $age, '$gender')";

    if (mysqli_query($conn, $insertquery)) {
        // Get the newly inserted user's ID
        $userId = mysqli_insert_id($conn);

        // Store user ID in session
        $_SESSION["user_id"] = $userId;

        // Redirect to health conditions page
        echo "<script>alert('Registration successful!'); window.location.href = 'health.php';</script>";
        exit();
    } else {
        echo "<script>alert('Error: " . mysqli_error($conn) . "');</script>";
    }
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
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@100;300;400;500;700&display=swap" rel="stylesheet">
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
                    <h5>Personal Information</h5>
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
                        <input type="password" name="confirm_password" class="form-control"
                            placeholder="Confirm Password" required>
                    </div>
                    <div class="form-group">
                        <label for="age">Age:</label>
                        <input type="number" name="age" id="age" class="form-control" placeholder="Age" required>
                    </div>
                    <div class="form-group">
                        <label>Gender:</label>
                        <select name="gender" class="form-control" required>
                            <option value="Male">Male</option>
                            <option value="Female">Female</option>
                            <option value="Other">Other</option>
                        </select>
                    </div>
                    <button type="submit" name="submit" id="submit-button"
                        class="btn btn-primary btn-block">Next</button>
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

    <script>
        document.addEventListener("DOMContentLoaded", function () {
            var hasCondition = document.getElementById("hasCondition");
            var conditionSelection = document.getElementById("conditionSelection");
            var submitButton = document.getElementById("submit-button"); // Ensure ID matches your button

            // Enable the button when the form is valid
            function checkFormValidity() {
                var username = document.querySelector("input[name='username']").value.trim();
                var email = document.querySelector("input[name='email']").value.trim();
                var password = document.querySelector("input[name='password']").value.trim();
                var confirmPassword = document.querySelector("input[name='confirm_password']").value.trim();
                var age = document.querySelector("input[name='age']").value.trim();
                var gender = document.querySelector("select[name='gender']").value;

                // Check if all fields are filled and passwords match
                if (username && email && password && confirmPassword && age && gender && password === confirmPassword) {
                    submitButton.disabled = false;
                    submitButton.classList.add("btn-primary"); // Add Bootstrap primary class for glow effect
                } else {
                    submitButton.disabled = true;
                    submitButton.classList.remove("btn-primary");
                }
            }

            // Attach event listeners to all fields
            document.querySelectorAll("input, select").forEach(function (field) {
                field.addEventListener("input", checkFormValidity);
            });

            // Handle "Has Condition" logic
            if (hasCondition) {
                hasCondition.addEventListener("change", function () {
                    if (this.value === "Yes") {
                        conditionSelection.style.display = "block";
                    } else {
                        conditionSelection.style.display = "none";
                    }
                    checkFormValidity(); // Ensure button state updates
                });
            }
        });
    </script>
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

    ogin-redirect a:hover {
        text-decoration: underline;
    }
</style>

</html>