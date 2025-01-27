<?php
session_start();

if (!isset($_SESSION['loggedin']) || !isset($_SESSION['userid'])) {
  header("Location: login.php");
  exit();
}
include "connect.php";

$userID = $_SESSION['userid']; // Get the current user's ID
$query = "SELECT username, profilePicture, bio, firstName, lastName FROM user WHERE userID = '$userID'";
$result = mysqli_query($conn, $query);

if ($result && mysqli_num_rows($result) > 0) {
  $userData = mysqli_fetch_assoc($result);
  $name = $userData['username'];
  $profilePicture = $userData['profilePicture']; // Get profile picture URL
  $bio = $userData['bio']; // Get user bio
  $firstName = $userData['firstName'];
  $lastName = $userData['lastName'];

} else {
  $profilePicture = 'default-avatar.png'; // Fallback profile picture
  $bio = 'No bio available'; // Fallback bio\
  $name = '???';
  $firstName = '???';
  $lastName = '???';
}
?>

<?php
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['submit_post'])) {
  // Validate the session and user input
  if (isset($_SESSION['userid']) && !empty(trim($_POST['post_content']))) {
    $userID = $_SESSION['userid']; // Get the current user's ID
    $content = mysqli_real_escape_string($conn, trim($_POST['post_content'])); // Sanitize input

    // Insert the post into the database
    $query = "INSERT INTO post (userID, content, timestamp) VALUES ('$userID', '$content', NOW())";
    if (mysqli_query($conn, $query)) {
      // Redirect or show confirmation message
      header("Location: " . $_SERVER['PHP_SELF']); // Redirect to the same page
      exit(); // Prevent further execution
    } else {
      echo "<script>alert('Error: " . mysqli_error($conn) . "');</script>";
    }
  } else {
    echo "<script>alert('Please write something before posting!');</script>";
  }
}
?>

<!DOCTYPE html>
<html>

<head>
  <title>FeedEat</title>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
  <link rel="stylesheet" href="https://www.w3schools.com/lib/w3-theme-blue-grey.css">
  <link rel='stylesheet' href='https://fonts.googleapis.com/css?family=Open+Sans'>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
  <style>
    body {
      font-family: 'Roboto', sans-serif;
      background:
        linear-gradient(rgba(255, 218, 67, 0.8), rgba(255, 218, 67, 0.8)),
        url('https://i.ibb.co/fdTVfDX/food-bg.png') no-repeat center center fixed;
      background-size: cover;
      margin: 0;
    }

    .w3-container {
      border-radius: 10px;
    }
  </style>
</head>

<body class="w3-theme-l5">

  <!-- Navbar -->
  <div class="w3-top">
    <div class="w3-bar w3-theme-d2 w3-left-align w3-large">
      <a class="w3-bar-item w3-button w3-hide-medium w3-hide-large w3-right w3-padding-large w3-hover-white w3-large w3-theme-d2"
        href="javascript:void(0);" onclick="openNav()"><i class="fa fa-bars"></i></a>
      <a href="index.php" class="w3-bar-item w3-button w3-padding-large w3-theme-d4"><i
          class="fa fa-home w3-margin-right"></i>Logo</a>
      <a href="message.php" class="w3-bar-item w3-button w3-hide-small w3-padding-large w3-hover-white"
        title="Messages"><i class="fa fa-envelope"></i></a>
      <div class="w3-dropdown-hover w3-hide-small">
        <button class="w3-button w3-padding-large" title="Notifications"><i class="fa fa-bell"></i></button>
      </div>
      <a href="logout.php"
        class="w3-bar-item w3-button w3-hide-small w3-right w3-medium w3-padding-large w3-hover-white">
        <p>Logout</p>
      </a>
    </div>
  </div>

  <!-- Navbar on small screens -->
  <div id="navDemo" class="w3-bar-block w3-theme-d2 w3-hide w3-hide-large w3-hide-medium w3-large">
    <a href="logout.php" class="w3-bar-item w3-button w3-right w3-medium">
      <p>Logout</p>
    </a>
  </div>

  <!-- Page Container -->
  <div class="w3-container w3-content" style="max-width:1400px;margin-top:80px">
    <!-- The Grid -->
    <div class="w3-row">
      <!-- Left Column -->
      <div class="w3-col m3">
        <!-- Profile -->
        <div class="w3-card w3-round w3-white">
          <div class="w3-container">
            <h4 class="w3-center">My Profile</h4>
            <p class="w3-center"><img src="<?php echo $profilePicture ?>" class="w3-circle"
                style="height:106px; width:106px" alt="Avatar"></p>
            <p class="w3-center"><?php echo $name ?></p>
            <hr>
            <p><i class="fa fa-pencil fa-fw w3-margin-right w3-text-theme"></i><?php echo $firstName ?>
              <?php echo $lastName ?>
            </p>
            <p><i class="fa fa-pencil fa-fw w3-margin-right w3-text-theme"></i><?php echo $bio ?></p>
          </div>
        </div>
        <br>

        <!-- Accordion -->
        <div class="w3-card w3-round">
          <div class="w3-white">
            <button onclick="myFunction('Demo3')" class="w3-button w3-block w3-theme-l1 w3-left-align"><i
                class="fa fa-users fa-fw w3-margin-right"></i>My Recipes</button>
            <div id="Demo3" class="w3-hide w3-container">
              <div class="w3-row-padding">
                <br>
                <div class="w3-half">
                  <img src="/w3images/lights.jpg" style="width:100%" class="w3-margin-bottom">
                </div>
                <div class="w3-half">
                  <img src="/w3images/nature.jpg" style="width:100%" class="w3-margin-bottom">
                </div>
                <div class="w3-half">
                  <img src="/w3images/mountains.jpg" style="width:100%" class="w3-margin-bottom">
                </div>
                <div class="w3-half">
                  <img src="/w3images/forest.jpg" style="width:100%" class="w3-margin-bottom">
                </div>
                <div class="w3-half">
                  <img src="/w3images/nature.jpg" style="width:100%" class="w3-margin-bottom">
                </div>
                <div class="w3-half">
                  <img src="/w3images/snow.jpg" style="width:100%" class="w3-margin-bottom">
                </div>
              </div>
            </div>
          </div>
        </div>
        <br>

        <!-- Interests -->
        <div class="w3-card w3-round w3-white w3-hide-small">
          <div class="w3-container">
            <p>Interests</p>

            <p>
              <span class="w3-tag w3-small w3-theme-d5">News</span>
              <span class="w3-tag w3-small w3-theme">Games</span>
              <span class="w3-tag w3-small w3-theme-l1">Friends</span>
              <span class="w3-tag w3-small w3-theme-l2">Food</span>
              <span class="w3-tag w3-small w3-theme-l3">Design</span>
              <span class="w3-tag w3-small w3-theme-l4">Art</span>
              <span class="w3-tag w3-small w3-theme-l5">Photos</span>
            </p>
          </div>
        </div>
        <br>


        <!-- End Left Column -->
      </div>

      <!-- Middle Column -->
      <div class="w3-col m7">

        <div class="w3-row-padding">
          <div class="w3-col m12">
            <div class="w3-card w3-round w3-white">
              <div class="w3-container w3-padding">
                <form action="" method="POST">
                  <textarea name="post_content" class="w3-border w3-padding" placeholder="What's on your mind?"
                    style="width:100%; height:100px;"></textarea>
                  <button type="submit" name="submit_post" class="w3-button w3-theme w3-margin-top">
                    <i class="fa fa-pencil"></i> Post
                  </button>
                </form>
              </div>
            </div>
          </div>
        </div>

        <?php
        $query = "
      SELECT post.*, user.userID, user.email, user.username, user.profilePicture
      FROM post 
      JOIN user ON user.userID = post.userID
      ORDER BY post.timestamp DESC";
        $result = executeQuery($query);
        while ($row = mysqli_fetch_assoc($result)) {
          $name = $row['username'];
          $profilePicture = $row['profilePicture'];
          $content = $row['content'];
          $mediaURL = $row['mediaURL'];
          $timestamp = $row['timestamp'];
          ?>

          <div class="w3-container w3-card w3-white w3-round w3-margin"><br>
            <img src="<?php echo $profilePicture ?>" alt="Avatar" class="w3-left w3-circle w3-margin-right"
              style="width:60px">
            <span class="w3-right w3-opacity"><?php echo $timestamp ?></span>
            <h4><?php echo $name ?></h4><br>
            <hr class="w3-clear">
            <p><?php echo $content ?></p>
            <div class="w3-row-padding" style="margin:0 -16px">
              <div class="w3-half">
                <img src="<?php echo $mediaURL ?>" style="width:100%" alt="Post Image" class="w3-margin-bottom">
              </div>
            </div>
            <button type="button" class="w3-button w3-theme-d1 w3-margin-bottom"><i class="fa fa-thumbs-up"></i>
              Like</button>
            <button type="button" class="w3-button w3-theme-d2 w3-margin-bottom"><i class="fa fa-comment"></i>
              Comment</button>
          </div>
        <?php } ?>

        <!-- End Middle Column -->
      </div>
      <!-- End Grid -->
    </div>

    <!-- End Page Container -->
  </div>
  <br>

  <script>
    // Accordion
    function myFunction(id) {
      var x = document.getElementById(id);
      if (x.className.indexOf("w3-show") == -1) {
        x.className += " w3-show";
        x.previousElementSibling.className += " w3-theme-d1";
      } else {
        x.className = x.className.replace("w3-show", "");
        x.previousElementSibling.className =
          x.previousElementSibling.className.replace(" w3-theme-d1", "");
      }
    }

    // Used to toggle the menu on smaller screens when clicking on the menu button
    function openNav() {
      var x = document.getElementById("navDemo");
      if (x.className.indexOf("w3-show") == -1) {
        x.className += " w3-show";
      } else {
        x.className = x.className.replace(" w3-show", "");
      }
    }
  </script>

</body>

</html>