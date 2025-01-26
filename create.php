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

    .form-container {
      background-color: #e0e0e0;
      padding: 20px;
      border-radius: 10px;
    }

    .form-group textarea {
      resize: none;
    }

    .submit-button {
      background-color: #b0b0b0;
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
      <main class="col-12 col-md-9 col-lg-10 p-4">
        <div class="image-placeholder bg-secondary rounded mb-4" style="height: 200px;"></div>
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
    document.getElementById("your-recipes-button").addEventListener("click", () => {
      window.location.href = "recipe.php";
    });

    document.getElementById("create-button").addEventListener("click", () => {
      window.location.href = "create.php";
    });
  </script>
</body>
</html>
