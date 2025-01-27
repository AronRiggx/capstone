<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>FeedEat</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">

    <style>
        body {
            font-family: 'Roboto', sans-serif;
            background: linear-gradient(rgba(255, 218, 67, 0.8), rgba(255, 218, 67, 0.8)),
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

        .mainContainer {
            height: 100vh;
        }

        .card {
            background: rgba(255, 255, 255, 0.9);
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.2);
            border: none;
        }

        .card-header {
            background: rgba(255, 166, 0, 0.9);
            color: #fff;
            border-radius: 10px 10px 0 0;
            text-align: center;
        }

        .convoContainer {
            flex-grow: 1;
            overflow-y: auto;
            padding: 15px;
            background-color: rgba(255, 248, 220, 0.8);
            border-radius: 0 0 10px 10px;
        }

        .chatBubble {
            border-radius: 20px;
            padding: 10px 15px;
            width: fit-content;
            max-width: 70%;
            margin: 10px 0;
            font-size: 14px;
            line-height: 1.5;
            animation: fadeIn 0.3s ease-in;
        }

        .receiver {
            background-color: rgba(255, 238, 173, 0.9);
            align-self: flex-start;
            color: #3e3e3e;
        }

        .sender {
            background-color: rgba(255, 204, 92, 0.9);
            align-self: flex-end;
            color: #3e3e3e;
        }

        .messageBox {
            padding: 15px;
            background-color: #ffffff;
            border-radius: 0 0 10px 10px;
            box-shadow: 0 -2px 10px rgba(0, 0, 0, 0.1);
        }

        .messageBox input {
            border: 1px solid #f4b400;
            border-radius: 20px;
            padding: 10px 15px;
            width: calc(100% - 60px);
            transition: all 0.3s;
        }

        .messageBox input:focus {
            border-color: #ff9800;
            box-shadow: 0 0 5px rgba(255, 152, 0, 0.5);
        }

        .messageBox button {
            background-color: #ffa726;
            border: none;
            border-radius: 50%;
            width: 40px;
            height: 40px;
            color: white;
            display: flex;
            align-items: center;
            justify-content: center;
            cursor: pointer;
            transition: all 0.3s;
        }

        .messageBox button:hover {
            background-color: #ff9800;
            transform: scale(1.1);
        }

        @keyframes fadeIn {
            from {
                opacity: 0;
                transform: translateY(10px);
            }

            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        @media (max-width: 768px) {
            .messageBox {
                padding: 10px;
                border-radius: 0;
            }

            .chatBubble {
                font-size: 12px;
            }
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
                    <a class="offcanvas-title" id="offcanvasNavbarLabel" href="php">
                        <img src="https://i.ibb.co/0tWMMf8/download.png" alt="Logo" wwidth="70" height="60"
                            class="d-inline-block px-2"></a>
                    <button type="button" class="btn-close" data-bs-dismiss="offcanvas"></button>
                </div>
                <div class="offcanvas-body">
                    <ul class="navbar-nav ms-auto">
                        <li class="nav-item"><a class="nav-link" href="#">Home</a></li>
                        <li class="nav-item"><a class="nav-link" href="#">AI Chatbot</a></li>
                        <li class="nav-item"><a class="nav-link" href="#">Messages</a></li>
                        <li class="nav-item"><a class="nav-link" href="#">Create your recipe</a></li>
                        <li class="nav-item"><a class="nav-link" href="#">Profile</a></li>
                        <li class="nav-item"><a class="nav-link" href="#">Logout</a></li>
                    </ul>
                </div>
            </div>
        </div>
    </nav>

    <div class="container-fluid">
        <div class="row mainContainer p-3">
            <div class="col-md-3 col-12 mb-3">
                <div class="card rounded-5">
                    <div class="card-header rounded-5">
                        <h5 class="mb-0">Chats</h5>
                    </div>
                    <div class="card-body">
                        <ul class="list-group">
                            <li class="list-group-item">Chat 1</li>
                            <li class="list-group-item">Chat 2</li>
                            <li class="list-group-item">Chat 3</li>
                        </ul>
                    </div>
                </div>
            </div>
            <div class="col-md-9 col-12">
                <div class="card rounded-5 d-flex flex-column">
                    <div class="card-header rounded-5">
                        <h5 class="mb-0">Chat with User</h5>
                    </div>
                    <div class="convoContainer d-flex flex-column">
                        <div class="chatBubble sender">Hello! How are you?</div>
                        <div class="chatBubble receiver">I'm good, thanks! And you?</div>
                        <div class="chatBubble sender">Doing well! Just working on a project.</div>
                        <div class="chatBubble receiver">That sounds interesting!</div>
                    </div>
                    <div class="messageBox d-flex align-items-center">
                        <input type="text" class="form-control" placeholder="Type a message...">
                        <button class="btn ms-2">
                            <svg xmlns="http://www.w3.org/2000/svg" height="20" viewBox="0 0 24 24" fill="white">
                                <path d="M0 0h24v24H0z" fill="none" />
                                <path d="M3 20v-1.81L16.97 12 3 5.81V4l19 8-19 8z" />
                            </svg>
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz"
        crossorigin="anonymous"></script>
</body>

</html>