<?php
session_start();

if (empty($_SESSION['id'])) {
    header('Location: Login.php');
    exit;
}

include "db.php";

$db = new DbConnection;

$user_id = $_SESSION['id'];

$sql = "SELECT * FROM users WHERE user_id = '$user_id'";

$user_info = $db->execute_query($sql);
// var_dump($user_info);
// die('here');
$username = $user_info[0]["username"];
?>
<!DOCTYPE html>
<html>
<head>
    <title>Home Page</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
    <style>
        .btn-custom {
            margin: 5px;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="text-center">
            <h1>Welcome to the Home page, <?php echo $username ?>!</h1>
            <br>

            <div class="d-flex justify-content-center">
                <div class="btn-group">
                    <form action="Profile.php" method="POST">
                        <button name="submit" type="submit" class="btn btn-primary btn-custom">My Profile</button>
                    </form>

                    <?php
                    if ($user_info[0]["is_admin"] == 1) {
                        echo '<a href="Department.php" class="btn btn-primary btn-custom">Department</a>';
                    }
                    ?>

                    <button name="submit" type="submit" class="btn btn-primary btn-custom" onclick="window.location.href = 'Employee.php';">Employee</button>
                </div>
            </div>

            <form action="Logout.php" method="POST">
                <button name="submit" type="submit" class="btn btn-primary btn-custom">Log out</button>
            </form>
        </div>
        <br style="clear: left;"/>
    </div>
</body>
</html>
