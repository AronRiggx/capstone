<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Recipe Creator</title>
  <style>
    body {
        font-family: 'Roboto', sans-serif;
        background: 
            linear-gradient(rgba(255, 218, 67, 0.8), rgba(255, 218, 67, 0.8)), 
            url('https://i.ibb.co/fdTVfDX/food-bg.png') no-repeat center center fixed;
        background-size: cover;
        margin: 0;
    }

    .container {
      display: flex;
    }

    .sidebar {
      width: 20%;
      background-color: #d3d3d3;
      height: 100vh;
      display: flex;
      flex-direction: column;
      align-items: center;
      padding-top: 20px;
    }

    .profile-picture {
      width: 100px;
      height: 100px;
      background-color: #b0b0b0;
      border-radius: 50%;
      margin-bottom: 20px;
    }

    .sidebar button {
      width: 80%;
      padding: 10px;
      margin: 10px 0;
      border: none;
      background-color: #b0b0b0;
      cursor: pointer;
      font-size: 16px;
    }

    .content {
      width: 80%;
      padding: 20px;
    }

    .image-placeholder {
      width: 100%;
      height: 200px;
      background-color: #b0b0b0;
      margin-bottom: 20px;
    }

    .form-container {
      display: flex;
      flex-wrap: wrap;
      gap: 20px;
      background-color: #e0e0e0;
      padding: 20px;
      border-radius: 10px;
    }

    .form-group {
      display: flex;
      flex-direction: column;
      width: 45%;
    }

    .form-group textarea {
      resize: none;
      height: 150px;
    }

    .form-group input,
    .form-group select,
    .form-group textarea {
      margin-top: 5px;
      padding: 10px;
      font-size: 14px;
      border: 1px solid #ccc;
      border-radius: 5px;
    }

    .submit-button {
      margin-top: 20px;
      width: 100%;
      padding: 10px;
      background-color: #b0b0b0;
      border: none;
      font-size: 16px;
      cursor: pointer;
    }
  </style>
</head>
<body>
  <div class="container">
    <div class="sidebar">
      <div class="profile-picture"></div>
      <h3>PROFILE</h3>
      <button id="create-button">Create</button>
      <button id="your-recipes-button">Your Recipes</button>
    </div>
    <div class="content">
      <div class="image-placeholder"></div>
      <h3>CREATE YOUR OWN RECIPE</h3>
      <div class="form-container">
        <div class="form-group">
          <label for="recipe-name">Name your recipe!</label>
          <input type="text" id="recipe-name">
        </div>
        <div class="form-group">
          <label for="category">Category:</label>
          <select id="category">
            <option value="vegetarian">Vegetarian</option>
            <option value="vegan">Vegan</option>
            <option value="non-vegetarian">Non-Vegetarian</option>
          </select>
        </div>
        <div class="form-group">
          <label for="description">Describe your recipe:</label>
          <textarea id="description"></textarea>
        </div>
        <div class="form-group" style="width: 100%;">
          <label for="instructions">Instructions on how to cook this meal:</label>
          <textarea id="instructions"></textarea>
        </div>
      </div>
      <button class="submit-button">POST</button>
    </div>
  </div>
</body>

<script>
    document.getElementById("your-recipes-button").addEventListener("click", () => {
      window.location.href = "recipe.html";
    });

    document.getElementById("create-button").addEventListener("click", () => {
      window.location.href = "create.html";
    });
    
  </script>

</html>
