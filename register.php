<?php
include 'db.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST['username'];
    $email = $_POST['email'];
    $password = $_POST['password']; // Make sure to hash the password for security
    $role = $_POST['role']; // Get the selected role

    // Insert new user into registration table
    $sql = "INSERT INTO registration (username, email, password, role) 
            VALUES ('$username', '$email', '$password', '$role')";

    if ($conn->query($sql) === TRUE) {
        // Registration successful
        header("Location: login.php");
        exit();
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }

    $conn->close();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Register</title>
  <link rel="stylesheet" href="https://www.phptutorial.net/app/css/style.css">
  <style>
    body, html {
      height: 65%;
      margin: 0;
      display: flex;
      justify-content: center;
      align-items: center;
      background-color: #f0f0f0; /* Light background color for better contrast */
    }
    form {
      display: flex;
      flex-direction: column;
      padding: 20px;
      background-color: #fff;
      border: 1px solid #ccc;
      box-shadow: 0 0 10px rgba(0,0,0,0.1);
    }
    label {
      margin-top: 10px;
    }
    input[type="text"], input[type="email"], input[type="password"], select {
      margin-top: 5px;
      padding: 10px;
      border: 1px solid #ccc;
      border-radius: 5px;
    }
    input[type="submit"] {
      margin-top: 20px;
      padding: 10px;
      border: none;
      border-radius: 5px;
      background-color: rgb(93, 63, 211);
      color: white;
      cursor: pointer;
    }
    input[type="submit"]:hover {
      background-color: #0056b3;
    }
  </style>
</head>
<body>
  <form action="register.php" method="post">
    <label for="username">Username:</label> 
    <input id="username" name="username" required type="text" />
    <label for="email">Email:</label>
    <input id="email" name="email" required type="email" />
    <label for="password">Password:</label>
    <input id="password" name="password" required type="password" />
    <label for="role">Role:</label>
    <select id="role" name="role" required>
      <option value="viewer">Viewer</option>
      <option value="editor">editor</option>
    </select>
    <input name="register" type="submit" value="Register" />
  </form>
</body>
</html>






