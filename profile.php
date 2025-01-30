<?php
session_start();

if (!isset($_SESSION['loggedin']) || !isset($_SESSION['userid'])) {
    header("Location: login.php");
    exit();
}

include_once "connect.php";
$userID = $_SESSION['userid'];

// Fetch user data
$pg = isset($_GET['id']) ? (int) $_GET['id'] : $userID;
$query = "SELECT username, profilePicture, bio, firstName, lastName FROM user WHERE userID = '$pg'";
$result = mysqli_query($conn, $query);
if ($result && mysqli_num_rows($result) > 0) {
    $userData = mysqli_fetch_assoc($result);
    $profile = $userData['profilePicture'];
} else {
    $profile = !empty($userData['profilePicture']) ? $userData['profilePicture'] : "def.png"; // Assign default if empty
}

// Update Profile Picture
if (isset($_POST['updatePicture'])) {
    if (isset($_FILES['profilePic']) && $_FILES['profilePic']['error'] === 0) {
        $targetDir = "uploads/";
        $fileName = basename($_FILES['profilePic']['name']);
        $fileName = mysqli_real_escape_string($conn, $fileName); // Sanitize filename
        $targetFilePath = $targetDir . $fileName;

        // Ensure uploads directory exists
        if (!is_dir($targetDir)) {
            mkdir($targetDir, 0755, true);
        }

        if (move_uploaded_file($_FILES['profilePic']['tmp_name'], $targetFilePath)) {
            $query = "UPDATE user SET profilePicture = '$fileName' WHERE userID = $userID";
            if (mysqli_query($conn, $query)) {
                echo "<script>alert('Profile picture updated successfully!');</script>";
                $profile = $fileName; // Update the displayed profile picture
            } else {
                echo "<script>alert('Database update failed.');</script>";
            }
        } else {
            echo "<script>alert('Error uploading the file.');</script>";
        }
    } else {
        echo "<script>alert('No file uploaded or an error occurred.');</script>";
    }
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    // Update Personal Information
    if (isset($_POST['updatePersonalInfo'])) {
        $firstName = mysqli_real_escape_string($conn, $_POST['firstName']);
        $lastName = mysqli_real_escape_string($conn, $_POST['lastName']);
        $email = mysqli_real_escape_string($conn, $_POST['email']);

        $query = "UPDATE user SET firstName = '$firstName', lastName = '$lastName', email = '$email' WHERE userID = {$_SESSION['userid']}";
        if (mysqli_query($conn, $query)) {
            echo "<script>alert('Personal information updated successfully!');</script>";
        } else {
            echo "<script>alert('Error updating personal information.');</script>";
        }
    }
}

if (isset($_POST['updatePassword'])) {
    $password = mysqli_real_escape_string($conn, $_POST['password']);
    $confirmPassword = mysqli_real_escape_string($conn, $_POST['confirmPassword']);

    if ($password === $confirmPassword) {
        $hashedPassword = password_hash($password, PASSWORD_BCRYPT);
        $query = "UPDATE user SET password = '$hashedPassword' WHERE userID = {$_SESSION['userid']}";
        mysqli_query($conn, $query);
        echo "<script>alert('Password updated successfully!');</script>";
    } else {
        echo "<script>alert('Passwords do not match.');</script>";
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Your Recipes</title>
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
            background: rgba(255, 248, 220, 1);
        }

        .profile-picture {
            width: 100px;
            height: 100px;
            background-color: rgb(247, 218, 105);
            border-radius: 50%;
            object-fit: cover;
        }

        .content {
            padding: 20px;
        }

        .recipe-card {
            width: 100%;
            max-width: 350px;
            background-color: rgba(255, 248, 220, 0.8);
            margin: 10px auto;
            text-align: center;
            padding: 20px;
            border-radius: 10px;
            display: inline-block;
        }

        .recipe-card img {
            width: 100%;
            height: 200px;
            background-color: #b0b0b0;
            border-radius: 10px;
        }

        img {
            overflow: hidden;
        }

        .btn-secondary {
            background-color: #ffa726;
            border-color: #ffa726;
        }

        .recipe-list {
            display: flex;
            justify-content: center;
            flex-wrap: wrap;
            gap: 20px;
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
                        <li class="nav-item"><a class="nav-link" href="index.php?id=<?php echo $userID ?>">Home</a></li>
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
                <div class="profile-picture mb-3">
                    <img src="uploads/<?php echo $profile ?>" class="rounded-circle img-fluid"
                        onerror="this.src='uploads/def.png';">
                </div>
                <a class="btn btn-secondary w-75 mb-2" href="profile.php?id=<?php echo $pg ?>">Profile</a>
                <a class="btn btn-secondary w-75 mb-2" href="create.php?id=<?php echo $pg ?>">Create</a>

            </nav>


            <!-- Main Content -->
            <main class="col-12 col-md-9 col-lg-10 content">
                <h3 class="mb-4">Profile Settings</h3>

                <div class="card p-4 shadow-sm mb-4">
                    <h5 class="mb-3">Change Profile Picture</h5>
                    <form method="POST" action="" enctype="multipart/form-data">
                        <div class="mb-3">
                            <label for="profilePic" class="form-label">Upload New Picture</label>
                            <input type="file" name="profilePic" id="profilePic" class="form-control" />
                        </div>
                        <button type="submit" name="updatePicture" class="btn btn-primary">Update Picture</button>
                    </form>
                </div>

                <div class="card p-4 shadow-sm mb-4">
                    <h5 class="mb-3">Personal Information</h5>
                    <form method="POST" action="">
                        <div class="mb-3">
                            <label for="firstName" class="form-label">First Name</label>
                            <input type="text" name="firstName" id="firstName" class="form-control"
                                placeholder="Enter your first name" />
                        </div>
                        <div class="mb-3">
                            <label for="lastName" class="form-label">Last Name</label>
                            <input type="text" name="lastName" id="lastName" class="form-control"
                                placeholder="Enter your last name" />
                        </div>
                        <div class="mb-3">
                            <label for="email" class="form-label">Email Address</label>
                            <input type="email" name="email" id="email" class="form-control"
                                placeholder="Enter your email" />
                        </div>
                        <button type="submit" name="updatePersonalInfo" class="btn btn-primary">Save Changes</button>
                    </form>
                </div>


                <div class="card p-4 shadow-sm">
                    <h5 class="mb-3">Account Settings</h5>
                    <form method="POST" action="">
                        <div class="mb-3">
                            <label for="password" class="form-label">New Password</label>
                            <input type="password" name="password" id="password" class="form-control"
                                placeholder="Enter a new password" />
                        </div>
                        <div class="mb-3">
                            <label for="confirmPassword" class="form-label">Confirm Password</label>
                            <input type="password" name="confirmPassword" id="confirmPassword" class="form-control"
                                placeholder="Confirm your new password" />
                        </div>
                        <button type="submit" name="updatePassword" class="btn btn-primary">Update Password</button>
                    </form>
                </div>

                <?PHP
                $query = "SELECT recipeName, recipeID FROM recipes ORDER BY recipeID DESC"; // Adjust column and table names as needed
                $result = mysqli_query($conn, $query);
                ?>

                <h3 class="my-3">Your Recipes</h3>
                <div class="recipe-list">
                    <?php
                    // Fetch only the recipes that belong to the logged-in user
                    $query = "SELECT recipeName, recipeID, description, instructions, category 
              FROM recipes 
              WHERE userID = $userID 
              ORDER BY recipeID DESC";  // Adjust based on your database structure
                    
                    $result = mysqli_query($conn, $query);

                    if ($result && mysqli_num_rows($result) > 0) {
                        foreach ($result as $row) {
                            $recipeName = htmlspecialchars($row['recipeName']);
                            $recipeID = htmlspecialchars($row['recipeID']);
                            $description = htmlspecialchars($row['description']);
                            $instructions = htmlspecialchars($row['instructions']);
                            $category = htmlspecialchars($row['category']);
                            ?>
                            <div class="recipe-card">
                                <h4 class="mt-2"><?= $recipeName; ?></h4>
                                <p class="text-muted">Category: <?= $category ?></p>
                                <p><strong>Description:</strong> <?= $description ?></p>
                                <p><strong>Instructions:</strong> <?= $instructions ?></p>
                            </div>
                            <?php
                        }
                    } else {
                        ?>
                        <p>No recipes found. <a href="create.php">Create one now!</a></p>
                        <?php
                    }
                    ?>
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