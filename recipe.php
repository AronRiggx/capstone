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

    .sidebar {
      background-color: #d3d3d3;
      height: 100vh;
    }

    .profile-picture {
      width: 100px;
      height: 100px;
      background-color: #b0b0b0;
      border-radius: 50%;
    }

    .content {
      padding: 20px;
    }

    .recipe-card {
      width: 100%;
      max-width: 350px;
      background-color: #e0e0e0;
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

    .recipe-list {
      display: flex;
      justify-content: center;
      flex-wrap: wrap;
      gap: 20px;
    }
  </style>
</head>
<body>
  <div class="container-fluid">
    <div class="row">
      <!-- Sidebar -->
      <nav class="col-12 col-md-3 col-lg-2 sidebar d-flex flex-column align-items-center py-4">
        <div class="profile-picture mb-3"></div>
        <h3>PROFILE</h3>
        <button id="create-button" class="btn btn-secondary w-75 mb-2">Create</button>
        <button id="your-recipes-button" class="btn btn-secondary w-75">Your Recipes</button>
      </nav>

      <!-- Main Content -->
      <main class="col-12 col-md-9 col-lg-10 content">
        <h3 class="mb-4">Your Recipes</h3>
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
    document.getElementById("your-recipes-button").addEventListener("click", () => {
      window.location.href = "recipe.php";
    });

    document.getElementById("create-button").addEventListener("click", () => {
      window.location.href = "create.php";
    });
  </script>
</body>
</html>