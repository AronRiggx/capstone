<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Your Recipes</title>
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

    .recipe-card {
      width: 30%;
      background-color: #e0e0e0;
      margin: 10px;
      text-align: center;
      padding: 20px;
      border-radius: 10px;
      display: inline-block;
    }

    .recipe-card img {
      width: 100%;
      height: 150px;
      background-color: #b0b0b0;
      border-radius: 10px;
    }

    .recipe-list {
      display: flex;
      flex-wrap: nowrap;
      overflow-x: auto;
    }

    .recipe-list::-webkit-scrollbar {
      height: 8px;
    }

    .recipe-list::-webkit-scrollbar-thumb {
      background: #b0b0b0;
      border-radius: 5px;
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
      <h3>Your Recipes</h3>
      <div class="recipe-list">
        <div class="recipe-card">
          <div class="image-placeholder"></div>
          <p>Recipe 1</p>
        </div>
        <div class="recipe-card">
          <div class="image-placeholder"></div>
          <p>Recipe 2</p>
        </div>
        <div class="recipe-card">
          <div class="image-placeholder"></div>
          <p>Recipe 3</p>
        </div>
      </div>
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