<?php
include "db.php";
$db = new DbConnection();

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['action'])) {
   if ($_POST['action'] === 'update') {
      // Handle the update action
      
      $id = $_POST['id'];
      $parent_id = $_POST['parent_id'];
      $name = $_POST['name'];
      $row_inserted_at = $_POST['row_inserted_at'];
      $department_info = $_POST['department_info'];
      // die("here");
      
      $sql_query = "UPDATE department SET name = '{$name}', parent_id ='{$parent_id}', row_inserted_at = '{$row_inserted_at}',
        department_info = '{$department_info}' WHERE id = '{$id}'";
        // var_dump($sql_query);die();
        $result = $db->execute_query($sql_query);
        
        header('Location: Department.php');
        exit();
    } elseif ($_POST['action'] === 'delete') {
        // Handle the delete action
        $id = $_POST['id'];

        $sql_query = "DELETE FROM department WHERE id = '{$id}'";
        $result = $db->execute_query($sql_query);
        header('Location: Department.php');
        exit();
    }
}

// Retrieve department details
$id = $_POST['id'];

$sql = "SELECT * FROM department WHERE id = '{$id}'";
$result = $db->execute_query($sql);
// var_dump($result);die('here');

if (!$result) {
    die('Error retrieving user details');
}

$data = $result[0];
// var_dump($data);die();
?>

<!DOCTYPE html>
<html>
   <head>
      <title>My Profile</title>
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
         <h1 class="text-center"><b>My Profile</b></h1>
         <form method="POST" enctype="multipart/form-data">
            <div class="row justify-content-center">
               <div class="col-sm-4 text-center">
                  <img src="/image/My_Photo.png" height="250" width="250" alt="Profile Picture"><br><b>Profile Picture</b></br>
               </div>
            </div>
            <div class="row justify-content-center">
               <div class="col-sm-4">
                  <div class="form-group">
                     <input type="hidden" name="id" id = "id" class="form-control" value="<?php echo $data['id']; ?>">
                  </div>
                  <div class="form-group">
                     <label for="username">Username</label>
                     <input type="text" class="form-control" id="username" name="username" value="<?php echo $data['parent_id']; ?>" required>
                  </div>
                  <div class="form-group">
                     <label for="passcode">Password</label>
                     <input type="password" class="form-control" id="passcode" name="passcode" value="<?php echo $data['row_inserted_at']; ?>" required>
                  </div>
                  <div class="form-group">
                     <label for="name">Name</label>
                     <input type="text" class="form-control" id="name" name="name" value="<?php echo $data['department_info']; ?>" required>
                  </div>
         
         <button type="submit" class="btn btn-primary" name="action" value="update">Save Changes</button>
         <a href="UpdateDepartment.php" class="btn btn-secondary">Back</a>
      </form>
   </div>
</body>

</html>
