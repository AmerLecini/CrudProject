<?php
include "db.php";
session_start();

$db = new DbConnection;

if (isset($_POST['login'])) {
    $user = pg_escape_string($_POST['username']);
    $password = pg_escape_string($_POST['password']);
    
    $sql = "SELECT * FROM users WHERE username = '$user' AND passcode = '$password'";

    $user_data = $db->execute_query($sql);

    $counter = count($user_data);
    if ($counter != 1) {
        echo "<script type='text/javascript'>alert('Invalid Username or Password!');
        document.location = 'Login.php'</script>";
    } else {
        $_SESSION['id'] = $user_data[0]['user_id'];
        header('Location: Home.php');
        exit;
    }
}
?>


<!DOCTYPE html>
<html>
<head>
    <title>Login</title>
    <style>
        body {
            background-color: #f2f2f2;
            font-family: Arial, sans-serif;
        }

        .container {
            width: 300px;
            margin: 0 auto;
            margin-top: 100px;
            background-color: #ffffff;
            padding: 20px;
            border-radius: 5px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        .container h2 {
            text-align: center;
            color: #333333;
        }

        .container input[type="text"],
        .container input[type="password"] {
            width: 100%;
            padding: 10px;
            margin-bottom: 15px;
            border: 1px solid #dddddd;
            border-radius: 3px;
        }

        .container input[type="submit"] {
            width: 100%;
            padding: 10px;
            background-color: #4CAF50;
            border: none;
            color: #ffffff;
            cursor: pointer;
            border-radius: 3px;
        }

        .container input[type="submit"]:hover {
            background-color: #45a049;
        }

        .container p {
            text-align: center;
        }

        .container p a {
            color: #007bff;
            text-decoration: none;
        }

        .container p a:hover {
            text-decoration: underline;
        }
    </style>
</head>
<body>
    <div class="container">
        <h2>Login</h2>
        <form method="POST">
    <input type="text" name="username" placeholder="Username" required>
    <input type="password" name="password" placeholder="Password" required>
    <input type="submit" name="login" value="Login">
</form>

       
    </div>
</body>
</html>