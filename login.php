<?php
session_start(); // Start the session

include 'db.php';

// Check if the role is selected in the URL
if(isset($_GET['role'])) {
    // Set the role in the session
    $_SESSION['role'] = $_GET['role'];
}

// Check if the user is already logged in
if(isset($_SESSION['username'])) {
    // Redirect the user to the home page
    header("Location: index.php");
    exit();
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST['username'];
    $password = $_POST['password'];

    // Query to select user from registration table
    $sql = "SELECT * FROM registration WHERE username='$username' AND password='$password'";
    $result = $conn->query($sql);

    if ($result->num_rows == 1) {
        // User exists, set session variables
        $_SESSION['username'] = $username;
        // Assuming 'role' is a column in your registration table
        $user = $result->fetch_assoc();
        $_SESSION['role'] = $user['role'];
        header("Location: index.php"); // Redirect to index.php or any other page
        exit();
    } else {
        // User not found or incorrect credentials
        $error = "Invalid username or password";
    }
}
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://www.phptutorial.net/app/css/style.css">
    <title>Login</title>
</head>
<body>
<main>
    <form class='container' action="login.php" method="post">
        <h1>Login</h1>
        <div>
            <label for="username">Username:</label>
            <input type="text" name="username" id="username">
        </div>
        <div>
            <label for="password">Password:</label>
            <input type="password" name="password" id="password">
        </div>
        <div>
            <label for="role">Role:</label>
            <select name="role" id="role">
                <option value="viewer">Viewer</option>
                <option value="editor">Editor</option>
            </select>
        </div>
        <section>
            <button type="submit">Login</button>
            <a href="register.php">Register</a>
        </section>
    </form>
    <a href='welcome.php'><u>Back to Welcome Page-></u></a>
</main>
</body>
</html>
