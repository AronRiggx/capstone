<?php
session_start();
include_once "connect.php";

// Ensure user is logged in and user_id is set
if (!isset($_SESSION["user_id"])) {
    echo "<script>alert('Session expired. Please sign up again.'); window.location.href = 'signup.php';</script>";
    exit();
}

$userId = $_SESSION["user_id"];

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $hasCondition = isset($_POST["has_condition"]) ? $_POST["has_condition"] : "No";
    $condition = (isset($_POST['condition']) && is_array($_POST['condition']) && $hasCondition === "Yes")
        ? implode(", ", $_POST['condition'])
        : NULL;

    // Update the existing user's health condition
    $updateQuery = "UPDATE user SET has_condition = ?, `condition` = ? WHERE userID = ?";
    $stmt = mysqli_prepare($conn, $updateQuery);
    mysqli_stmt_bind_param($stmt, "ssi", $hasCondition, $condition, $userId);

    if (mysqli_stmt_execute($stmt)) {
        echo "<script>alert('Health conditions updated successfully!'); window.location.href = 'login.php';</script>";
        exit();
    } else {
        echo "<script>alert('Error updating health conditions: " . mysqli_error($conn) . "');</script>";
    }

    mysqli_stmt_close($stmt);
}

mysqli_close($conn);
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
                <form action="health.php" method="POST">
                    <h5>Health Information</h5>
                    <div class="form-group">
                        <label>Do you have any health conditions?</label>
                        <select name="has_condition" id="hasCondition" class="form-control" required>
                            <option value="~">~</option>
                            <option value="No">No</option>
                            <option value="Yes">Yes</option>
                        </select>
                    </div>
                    <div id="conditionSelection" class="form-group" style="display: none;">
                        <label>Select your health condition:</label>
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" name="condition[]" value="Diabetes">
                            Diabetes
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" name="condition[]" value="Hypertension">
                            Hypertension
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" name="condition[]" value="Heart Disease">
                            Heart Disease
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" name="condition[]" value="Other"> Other
                        </div>
                    </div>
                    <div class="container">
                        <div class="row">
                            <button type="button" class="col btn btn-secondary btn-block mt-2 mx-2"
                                onclick="goBack()">Back</button>
                            <button type="submit" name="submit"
                                class="col btn btn-primary btn-block mt-2 mx-2">Submit</button>
                        </div>
                    </div>
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
        function goBack() {
            window.history.back();
        }
        document.addEventListener("DOMContentLoaded", function () {
            var hasCondition = document.getElementById("hasCondition");
            var conditionSelection = document.getElementById("conditionSelection");
            var submitButton = document.querySelector("button[name='submit']");

            // Initially disable the submit button
            submitButton.disabled = true;

            hasCondition.addEventListener("change", function () {
                submitButton.disabled = (this.value === "~");

                if (this.value === "Yes") {
                    conditionSelection.style.display = "block";
                }
                else {
                    conditionSelection.style.display = "none";
                }
            });
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

    .login-redirect a:hover {
        text-decoration: underline;
    }
</style>

</html>