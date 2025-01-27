<?php
session_start();

// Redirect to login if the user is not logged in
if (!isset($_SESSION['loggedin']) || !isset($_SESSION['userid'])) {
    header("Location: login.php");
    exit();
}
include_once "connect.php";

// Fetch user data
$pg = isset($_GET['id']) ? $_GET['id'] : null;
$query = "SELECT username, profilePicture, bio, firstName, lastName FROM user WHERE userID = '$pg'";
$result = mysqli_query($conn, $query);

if ($result && mysqli_num_rows($result) > 0) {
    $userData = mysqli_fetch_assoc($result);
    $name = $userData['username'];
    $profilePicture = $userData['profilePicture'];
    $bio = $userData['bio'];
    $firstName = $userData['firstName'];
    $lastName = $userData['lastName'];
} else {
    $profilePicture = 'default-avatar.png';
    $bio = 'No bio available';
    $name = 'Unknown';
    $firstName = 'Unknown';
    $lastName = 'Unknown';
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Recipe Creator</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            font-family: 'Roboto', sans-serif;
            background:
                linear-gradient(rgba(255, 218, 67, 0.8), rgba(255, 218, 67, 0.8)),
                url('https://i.ibb.co/fdTVfDX/food-bg.png') no-repeat center center fixed;
            background-size: cover;
            margin: 0;
        }

        .navbar {
            background: rgba(255, 166, 0, 0.9);
            /* Golden yellow accent */
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.2);
        }

        .navbar a.navbar-brand {
            color: #ffffff;
            font-weight: bold;
            text-shadow: 1px 1px 2px rgba(0, 0, 0, 0.5);
        }

        .navbar .navbar-toggler {
            border: none;
            color: #ffffff;
        }

        .navbar .navbar-toggler-icon {
            background-image: url('data:image/svg+xml;charset=utf8,%3Csvg xmlns%3D%22http://www.w3.org/2000/svg%22 fill%3D%22white%22 viewBox%3D%220 0 30 30%22%3E%3Cpath stroke%3D%22rgba%280, 0, 0, 0.5%29%22 stroke-width%3D%222%22 stroke-linecap%3D%22round%22 stroke-miterlimit%3D%2210%22 d%3D%22M4 7h22M4 15h22M4 23h22%22/%3E%3C/svg%3E');
        }

        .navbar .nav-link {
            color: #1a1a1a;
            font-weight: 500;
            padding: 10px 15px;
            transition: all 0.3s;
        }

        .navbar .nav-link:hover {
            color: rgba(255, 218, 67, 0.9);
            /* Hover effect with lighter accent */
            text-decoration: underline;
        }

        .offcanvas {
            background: rgba(255, 248, 220, 1);
            /* Light theme for offcanvas menu */
            color: #3e3e3e;
            box-shadow: -4px 0 10px rgba(0, 0, 0, 0.2);
        }

        .offcanvas .offcanvas-title {
            font-weight: bold;
            color: rgba(255, 166, 0, 0.9);
        }

        .offcanvas .btn-close {
            background-color: rgba(255, 204, 92, 0.8);
            border-radius: 50%;
            color: white;
        }

        .sidebar {
            background-color: rgba(255, 248, 220, 1);

        }

        .profile-picture {
            width: 100px;
            height: 100px;
            background-color: rgb(247, 218, 105);
            border-radius: 50%;
        }

        .form-container {
            background-color: rgba(255, 248, 220, 1);
            padding: 20px;
            border-radius: 10px;
        }

        .form-group textarea {
            resize: none;
        }

        .btn-secondary {
            background-color: #ffa726;
            border-color: #ffa726;
        }

        .submit-button {
            background-color: #ffa726;
            border: none;
            font-size: 16px;
        }

        @media only screen and (max-width: 770px) {
            .sidebar {
                height: 100%;
            }
        }
    </style>
</head>

<body>
    <nav class="navbar body-tertiary px-2">
        <div class="container-fluid">
            <a class="navbar-brand" href="index.php?id=<?php echo $_SESSION['userid'] ?>">
                <img src="https://i.ibb.co/0tWMMf8/download.png" alt="Logo" width="70" height="60"
                    class="d-inline-block align-items-center px-2">FeedEat</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasNavbar"
                aria-controls="offcanvasNavbar" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="offcanvas offcanvas-end" tabindex="-1" id="offcanvasNavbar"
                aria-labelledby="offcanvasNavbarLabel">
                <div class="offcanvas-header">
                    <img src="https://i.ibb.co/0tWMMf8/download.png" alt="Logo" wwidth="70" height="60"
                        class="d-inline-block px-2">
                    <button type="button" class="btn-close" data-bs-dismiss="offcanvas"></button>
                </div>
                <div class="offcanvas-body">
                    <ul class="navbar-nav ms-auto">
                        <li class="nav-item"><a class="nav-link"
                                href="index.php?id=<?php echo $_SESSION['userid'] ?>">Home</a></li>
                        <li class="nav-item"><a class="nav-link" href="logout.php">Logout</a></li>
                    </ul>
                </div>
            </div>
        </div>
    </nav>
    <div class="container-fluid">
        <div class="row">
            <!-- Sidebar -->
            <nav class="col-12 col-md-3 col-lg-2 sidebar d-flex flex-column align-items-center py-4">
                <div class="profile-picture mb-3"></div>
                <button id="profile-button" class="btn btn-secondary w-75 mb-2">Profile</button>
                <button id="create-button" class="btn btn-secondary w-75 mb-2">Create</button>
            </nav>

            <!-- Main Content -->
            <main class="col-12 col-md-9 col-lg-10 p-4">
                <div class="image-placeholder bg-warning-subtle rounded mb-4" style="height: 200px;"></div>
                <h3>CREATE YOUR OWN RECIPE</h3>
                <div class="form-container mt-4">
                    <div class="row g-3">
                        <div class="form-group col-12 col-md-6">
                            <label for="recipe-name" class="form-label">Name your recipe!</label>
                            <input type="text" id="recipe-name" class="form-control">
                        </div>
                        <div class="form-group col-12 col-md-6">
                            <label for="category" class="form-label">Category:</label>
                            <select id="category" class="form-select">
                                <option value="vegetarian">Vegetarian</option>
                                <option value="vegan">Vegan</option>
                                <option value="non-vegetarian">Non-Vegetarian</option>
                            </select>
                        </div>
                        <div class="form-group col-12">
                            <label for="description" class="form-label">Describe your recipe:</label>
                            <textarea id="description" class="form-control" rows="4"></textarea>
                        </div>
                        <div class="form-group col-12">
                            <label for="instructions" class="form-label">Instructions on how to cook this meal:</label>
                            <textarea id="instructions" class="form-control" rows="4"></textarea>
                        </div>
                    </div>
                    <button class="btn submit-button mt-3 w-100">POST</button>
                </div>
            </main>
        </div>
    </div>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        document.getElementById("profile-button").addEventListener("click", () => {
            window.location.href = "profile.php";
        });

        document.getElementById("create-button").addEventListener("click", () => {
            window.location.href = "create.php";
        });
    </script>
</body>

</html>