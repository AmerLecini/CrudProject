<?php
include "db.php";
$db = new DbConnection();

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['action'])) {
    if ($_POST['action'] === 'update') {
        // Handle the update action
        $user_id = $_POST['user_id'];
        $username = $_POST['username'];

        $sql_query = "UPDATE users SET username = '{$username}' WHERE user_id = '{$user_id}'";
        $result = $db->execute_query($sql_query);

        if (!$result) {
            die('Error updating user');
        }
    } elseif ($_POST['action'] === 'delete') {
        // Handle the delete action
        $user_id = $_POST['user_id'];

        $sql_query = "DELETE FROM users WHERE user_id = '{$user_id}'";
        $result = $db->execute_query($sql_query);

    }
}

$sql = "SELECT * FROM users";
$result = $db->execute_query($sql);

if (!$result) {
    die('Error retrieving users');
}
?>

<!DOCTYPE html>
<html>

<head>
    <title>Manage Users</title>
    
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
    <style>
        .action-buttons {
            display: flex;
            flex-direction: row;
        }

        .action-buttons form {
            margin-right: 5px;
        }
    </style>
</head>

<body>
    <div class="container">
    <center>
        <h1><b>Manage Users</b></h1>
    </center>
    <a href="CreateUser.php" classa="btn btn-primary mb-3">Create User</a>
        <table class="table">
            <thead>
                <tr>
                    <th>Username</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($result as $row) : ?>
                    <tr>
                        <td><?php echo $row['username']; ?></td>
                        <td class="action-buttons">
                            <form action = "EditEmployee.php" method="GET">
                                
                                <input type="hidden" name="action" value="update">
                                <input type="hidden" name="user_id" value="<?php echo $row['user_id']; ?>">
                                <button type="submit" class="btn btn-primary">Update</button>
                            </form>
                            <form method="POST">
                                <input type="hidden" name="action" value="delete">
                                <input type="hidden" name="user_id" value="<?php echo $row['user_id']; ?>">
                                <button type="submit" class="btn btn-danger">Delete</button>
                            </form>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</body>

</html>
