<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Welcome to Our Site</title>
    <style>
              body {
            font-family: Arial, sans-serif;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
        }
        .video-bg {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            object-fit: cover;
            z-index: -1;
        }
        .container {
            text-align: center;
            background-color: 	#36454F;
            padding: 20px 40px;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            height: 500px;
            width: 500px
            
        }
        .container h1 {
            margin-bottom: 20px;
            color: #333;
        }
        .container p {
            margin-bottom: 30px;
            color: #666;
        }
        .container .buttons {
            display: flex;
            justify-content: center;
            gap: 20px;
        }
        .container .buttons a {
            text-decoration: none;
            color: #fff;
            background-color: #007bff;
            padding: 10px 20px;
            border-radius: 5px;
            transition: background-color 0.3s;
        }
        .container .buttons a:hover {
            background-color: #0056b3;
        }
    </style>
</head>
<body>
<video autoplay muted loop class="video-bg">
        <source src="bg1.mov" type="video/mp4">
        Your browser does not support the video tag.
    </video>
    <div class="container">
        <h1>Data Info</h1>
        <p>This is the welcome page</p>
        <div class="buttons">
            <a href="login.php">Login</a>
            <a href="register.php">Register</a>
        </div>
    </div>
</body>
</html>
