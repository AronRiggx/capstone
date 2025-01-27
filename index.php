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

// Handle post submission
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['submit_post'])) {
  if (!empty(trim($_POST['post_content']))) {
    $content = mysqli_real_escape_string($conn, trim($_POST['post_content']));
    $userID = $_SESSION['userid'];
    $query = "INSERT INTO post (userID, content, timestamp) VALUES ('$userID', '$content', NOW())";

    if (mysqli_query($conn, $query)) {
      header("Location: " . $_SERVER['PHP_SELF'] . "?id=" . urlencode($pg));
      exit();
    } else {
      echo "<script>alert('Error: " . mysqli_error($conn) . "');</script>";
    }
  } else {
    echo "<script>alert('Please write something before posting!');</script>";
  }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>FeedEat</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
  <style>
    body {
      font-family: 'Roboto', sans-serif;
      background: linear-gradient(rgba(255, 218, 67, 0.8), rgba(255, 218, 67, 0.8)),
        url('https://i.ibb.co/fdTVfDX/food-bg.png') no-repeat center center fixed;
      background-size: cover;
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


    .profile-picture {
      height: 120px;
      width: 120px;
      object-fit: cover;
    }

    .card {
      margin-bottom: 20px;
      background-color: rgba(255, 248, 220, 1)
    }
  </style>
</head>

<body>
  <!-- Navbar -->
  <nav class="navbar body-tertiary px-2">
    <div class="container-fluid">
      <a class="navbar-brand" href="index.php?id=<?php echo $pg ?>">
        <img src="https://i.ibb.co/0tWMMf8/download.png" alt="Logo" width="70" height="60"
          class="d-inline-block align-items-center px-2">FeedEat</a>
      <button class="navbar-toggler" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasNavbar"
        aria-controls="offcanvasNavbar" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="offcanvas offcanvas-end" tabindex="-1" id="offcanvasNavbar" aria-labelledby="offcanvasNavbarLabel">
        <div class="offcanvas-header">
          <img src="https://i.ibb.co/0tWMMf8/download.png" alt="Logo" wwidth="70" height="60"
            class="d-inline-block px-2">
          <button type="button" class="btn-close" data-bs-dismiss="offcanvas"></button>
        </div>
        <div class="offcanvas-body">
          <ul class="navbar-nav ms-auto">
            <li class="nav-item"><a class="nav-link" href="profile.php">Profile</a></li>
            <li class="nav-item"><a class="nav-link" href="create.php">Create your recipe</a></li>
            <li class="nav-item"><a class="nav-link" href="logout.php">Logout</a></li>
          </ul>
        </div>
      </div>
    </div>
  </nav>

  <div class="container mt-5">
    <div class="row">
      <!-- Profile Section -->
      <div class="col-md-4">
        <div class="card text-center">
          <div class="card-body">
            <img src="<?php echo $profilePicture; ?>" alt="Profile" class="rounded-circle profile-picture">
            <h4 class="mt-3"><?php echo $firstName . ' ' . $lastName;
            $name; ?></h4>
            <h6 class="mt-3"><?php echo '@'. $name; ?></h6>
            <p class="text-muted">Bio: <?php echo $bio; ?></p>
          </div>
        </div>
      </div>
      
      <!-- Post Section -->
      <div class="col-md-8">
        <div class="card">
          <div class="card-body">
            <form action="" method="POST">
              <textarea name="post_content" class="form-control mb-3" placeholder="What's on your mind?"
                rows="4"></textarea>
              <button type="submit" name="submit_post" class="btn btn-warning w-100">Post</button>
            </form>
          </div>
        </div>

        <!-- Display Posts -->
        <?php
        $query = "SELECT post.*, user.username, user.profilePicture FROM post JOIN user ON user.userID = post.userID ORDER BY post.timestamp DESC";
        $result = mysqli_query($conn, $query);

        while ($row = mysqli_fetch_assoc($result)) {
          $name = $row['username'];
          $profilePicture = $row['profilePicture'] ?: 'default-avatar.png';
          $content = $row['content'];
          $mediaURL = $row['mediaURL'];
          $timestamp = $row['timestamp'];
          ?>
          <div class="card">
            <div class="card-body">
              <div class="d-flex align-items-center mb-3">
                <img src="<?php echo $profilePicture; ?>" alt="Avatar" class="rounded-circle" width="50" height="50">
                <div class="ms-3">
                  <h6 class="mb-0"><?php echo '@'. $name; ?></h6>
                  <small class="text-muted"><?php echo $timestamp; ?></small>
                </div>
              </div class="pb-2">
              <p><?php echo $content; ?></p>
              <?php if ($mediaURL) { ?>
                <img src="<?php echo $mediaURL; ?>" class="img-fluid rounded" alt="Post Media">
                <?php } ?>
                <div class="pt-2">
                  <button type="button" class="post-button btn btn-primary"><i class="fa-solid fa-heart"></i></button>
                  <button type="button" class="post-button btn btn-primary"><i class="fa-solid fa-comment"></i>
                    Comment</button>
                </div>
              
            </div>
          </div>
        <?php } ?>
      </div>
    </div>
  </div>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.bundle.min.js"></script>
  <script>
    (function () { if (!window.chatbase || window.chatbase("getState") !== "initialized") { window.chatbase = (...arguments) => { if (!window.chatbase.q) { window.chatbase.q = [] } window.chatbase.q.push(arguments) }; window.chatbase = new Proxy(window.chatbase, { get(target, prop) { if (prop === "q") { return target.q } return (...args) => target(prop, ...args) } }) } const onLoad = function () { const script = document.createElement("script"); script.src = "https://www.chatbase.co/embed.min.js"; script.id = "TMlveiBS_dnCMEXhGGvh5"; script.domain = "www.chatbase.co"; document.body.appendChild(script) }; if (document.readyState === "complete") { onLoad() } else { window.addEventListener("load", onLoad) } })();
  </script>
</body>

</html>