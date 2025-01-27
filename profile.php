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
            <a class="navbar-brand" href="index.php">
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
                <div class="profile-picture mb-3"></div>
                <button id="profile-button" class="btn btn-secondary w-75 mb-2">Profile</button>
                <button id="create-button" class="btn btn-secondary w-75 mb-2">Create</button>

            </nav>


            <!-- Main Content -->
            <main class="col-12 col-md-9 col-lg-10 content">
                <h3 class="mb-4">Profile Settings</h3>

                <div class="card p-4 shadow-sm mb-4">
                    <h5 class="mb-3">Change Profile Picture</h5>
                    <form>
                        <div class="mb-3">
                            <label for="profilePic" class="form-label">Upload New Picture</label>
                            <input type="file" id="profilePic" class="form-control" />
                        </div>
                        <button type="submit" class="btn btn-primary">Update Picture</button>
                    </form>
                </div>

                <div class="card p-4 shadow-sm mb-4">
                    <h5 class="mb-3">Personal Information</h5>
                    <form>
                        <div class="mb-3">
                            <label for="fullName" class="form-label">Full Name</label>
                            <input type="text" id="fullName" class="form-control" placeholder="Enter your full name" />
                        </div>
                        <div class="mb-3">
                            <label for="email" class="form-label">Email Address</label>
                            <input type="email" id="email" class="form-control" placeholder="Enter your email" />
                        </div>
                        <div class="mb-3">
                            <label for="phone" class="form-label">Phone Number</label>
                            <input type="tel" id="phone" class="form-control" placeholder="Enter your phone number" />
                        </div>
                        <button type="submit" class="btn btn-primary">Save Changes</button>
                    </form>
                </div>


                <div class="card p-4 shadow-sm">
                    <h5 class="mb-3">Account Settings</h5>
                    <form>
                        <div class="mb-3">
                            <label for="password" class="form-label">New Password</label>
                            <input type="password" id="password" class="form-control"
                                placeholder="Enter a new password" />
                        </div>
                        <div class="mb-3">
                            <label for="confirmPassword" class="form-label">Confirm Password</label>
                            <input type="password" id="confirmPassword" class="form-control"
                                placeholder="Confirm your new password" />
                        </div>
                        <button type="submit" class="btn btn-primary">Update Password</button>
                    </form>
                </div>
                <h3 class="my-3">Your Recipes</h3>
                <div class="recipe-list">
                    <div class="recipe-card">
                        <img src="https://via.placeholder.com/350x200" alt="Recipe Image">
                        <p class="mt-2">Recipe 1</p>
                    </div>
                    <div class="recipe-card">
                        <img src="https://via.placeholder.com/350x200" alt="Recipe Image">
                        <p class="mt-2">Recipe 2</p>
                    </div>
                    <div class="recipe-card">
                        <img src="https://via.placeholder.com/350x200" alt="Recipe Image">
                        <p class="mt-2">Recipe 3</p>
                    </div>
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