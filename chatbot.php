<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Filipino Cuisine Chatbot</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            font-family: Arial, sans-serif;
            background: linear-gradient(rgba(255, 218, 67, 0.8), rgba(255, 218, 67, 0.8)), 
                        url('https://i.ibb.co/fdTVfDX/food-bg.png') no-repeat center center fixed;
            background-size: cover;
            margin: 0;
            padding: 20px;
        }

        .chat-container {
            background-color: white;
            border-radius: 10px;
            padding: 20px;
            box-shadow: 0 2px 10px rgba(0,0,0,0.1);
            max-width: 800px;
            margin: 0 auto 20px;
        }

        .chat-box {
            height: 400px;
            overflow-y: auto;
            border: 1px solid #ddd;
            padding: 10px;
            margin-bottom: 20px;
            border-radius: 5px;
            background-color: #f9f9f9;
        }

        .message {
            margin: 10px 0;
            padding: 10px;
            border-radius: 5px;
        }

        .bot {
            background-color: #e3f2fd;
            margin-right: 20%;
        }

        .user {
            background-color: #f5f5f5;
            margin-left: 20%;
        }

        .input-container {
            display: flex;
            gap: 10px;
        }

        input {
            flex: 1;
            padding: 10px;
            border: 1px solid #ddd;
            border-radius: 5px;
        }

        button {
            padding: 10px 20px;
            background-color: #4CAF50;
            color: white;
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }

        button:hover {
            background-color: #45a049;
        }

        .recipe-section {
            background-color: white;
            border-radius: 10px;
            padding: 20px;
            box-shadow: 0 2px 10px rgba(0,0,0,0.1);
            max-width: 800px;
            margin: 0 auto;
        }

        .recipe-list {
            display: flex;
            flex-wrap: wrap;
            gap: 20px;
            justify-content: center;
        }

        .recipe-card {
            width: calc(33.333% - 20px);
            background-color: #f8f9fa;
            border-radius: 10px;
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.1);
            overflow: hidden;
            text-align: center;
            padding: 15px;
            transition: transform 0.2s;
        }

        .recipe-card:hover {
            transform: scale(1.05);
        }

        .recipe-card img {
            width: 100%;
            height: 150px;
            object-fit: cover;
            border-radius: 8px;
            margin-bottom: 10px;
        }

        .recipe-card p {
            font-size: 16px;
            font-weight: bold;
            margin: 0;
        }

        @media (max-width: 768px) {
            .recipe-card {
                width: calc(50% - 20px);
            }
        }

        @media (max-width: 480px) {
            .recipe-card {
                width: 100%;
            }
        }
    </style>
</head>
<body>
    <div class="chat-container">
        <h1 class="text-center">Filipino Cuisine Recommendation Chatbot</h1>
        <div class="chat-box" id="chatBox"></div>
        <div class="input-container">
            <input type="text" id="userInput" placeholder="Type your health condition (e.g., diabetes, hypertension)">
            <button onclick="sendMessage()">Send</button>
        </div>
    </div>

    <div class="recipe-section">
        <h2 class="text-center">Recommended Recipes</h2>
        <div class="recipe-list">
            <div class="recipe-card">
                <img src="https://via.placeholder.com/150" alt="Recipe 1">
                <p>Recipe 1</p>
            </div>
            <div class="recipe-card">
                <img src="https://via.placeholder.com/150" alt="Recipe 2">
                <p>Recipe 2</p>
            </div>
            <div class="recipe-card">
                <img src="https://via.placeholder.com/150" alt="Recipe 3">
                <p>Recipe 3</p>
            </div>
        </div>
    </div>

    <script src="data.js"></script>
    <script src="script.js"></script>
</body>
</html>
