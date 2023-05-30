<?php

// session_start();
include "db.php";
$db = new DbConnection();



if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['action'])) {
    if ($_POST['action'] === 'update') {
        // Handle the update action

        $id = $_GET['id'];
        $parent_id = $_POST['parent_id'];
        $name = $_POST['name'];
        $row_inserted_at = $_POST['row_inserted_at'];
        $department_info = $_POST['department_info'];

        $sql = "SELECT * FROM department WHERE id = '{$id}'";
        $result = $db->execute_query($sql);

        $sql_query = "UPDATE department SET" . '"name"' . " = '$name', parent_id = '$parent_id', row_inserted_at = '$row_inserted_at',
        department_info = '$department_info' WHERE id = '$id'";

        $result = $db->execute_query($sql_query);

        header('Location: Department.php');
        exit();
    } 
}

// Retrieve department details
$id = $_GET['id'];
$sql = "SELECT * FROM department WHERE id = '{$id}'";
$result = $db->execute_query($sql);
$data = $result[0];
?>

<!DOCTYPE html>
<html>

<head>
    <title>Update Department</title>
    <!-- Include Bootstrap CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
    <style>
        /* Additional styles */
        body {
            background-color: #f5f5f5;
        }

        h1 {
            margin-top: 50px;
            margin-bottom: 30px;
            font-size: 36px;
            text-align: center;
        }

        .form-group {
            margin-bottom: 25px;
        }

        .btn-primary {
            margin-right: 10px;
        }

        .btn-secondary {
            background-color: #f0ad4e;
            border-color: #f0ad4e;
        }

        .btn-secondary:hover {
            background-color: #eea236;
            border-color: #eea236;
        }
    </style>
</head>

<body>
    <div class="container">
        <h1 class="text-center"><b>Update Department</b></h1>
        <form method="POST" enctype="multipart/form-data">
            <div class="row justify-content-center">
                <div class="col-sm-4">
                    <div class="form-group">
                        <input type="hidden" name="id" id="id" class="form-control" value="<?php echo $data['id']; ?>">
                    </div>
                    <div class="form-group">
                        <label for="parent_id">Parent ID</label>
                        <input type="text" class="form-control" id="parent_id" name="parent_id" value="<?php echo $data['parent_id']; ?>" required>
                    </div>
                    <div class="form-group">
                        <label for="name">Name</label>
                        <input type="text" class="form-control" id="name" name="name" value="<?php echo $data['name']; ?>" required>
                    </div>
                    <div class="form-group">
                        <label for="row_inserted_at">Row Inserted At</label>
                        <input type="text" class="form-control" id="row_inserted_at" name="row_inserted_at" value="<?php echo $data['row_inserted_at']; ?>" required>
                    </div>
                    <div class="form-group">
                        <label for="department_info">Department Info</label>
                        <textarea class="form-control" id="department_info" name="department_info" rows="4" required><?php echo $data['department_info']; ?></textarea>
                    </div>
                    <div class="text-center">
                        <button type="submit" class="btn btn-primary" name="action" value="update">Update</button>
                        <a href="Department.php" class="btn btn-secondary">Cancel</a>
                    </div>
                </div>
            </div>
        </form>
    </div>
</body>

</html>
