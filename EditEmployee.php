<?php
include "db.php";
$db = new DbConnection();

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['action'])) {
    if ($_POST['action'] === 'update') {
        // Handle the update action
        $user_id = $_POST['user_id'];
        $username = $_POST['username'];
        $passcode = $_POST['passcode'];
        $name = $_POST['name'];
        $surname = $_POST['surname'];
        $age = $_POST['age'];
        $gender = $_POST['gender'];

        $sql_query = "UPDATE users SET username = '{$username}', passcode = '{$passcode}', name = '{$name}', 
                        surname = '{$surname}', age = '{$age}', gender = '{$gender}' WHERE user_id = '{$user_id}'";
      //   var_dump($sql_query);die();
        $result = $db->execute_query($sql_query);

      
        header('Location: Employee.php');
        exit();
    } elseif ($_POST['action'] === 'delete') {
        // Handle the delete action
        $user_id = $_POST['user_id'];

        $sql_query = "DELETE FROM users WHERE user_id = '{$user_id}'";
        $result = $db->execute_query($sql_query);

        header('Location: Employee.php');
        exit();
    }
}

// Retrieve user details
$user_id = $_GET['user_id'];

$sql = "SELECT * FROM users WHERE user_id = '{$user_id}'";
$result = $db->execute_query($sql);

if (!$result) {
    die('Error retrieving user details');
}

$user = $result[0];
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
                     <input type="hidden" name="user_id" value="<?php echo $user['user_id']; ?>">
                  </div>
                  <div class="form-group">
                     <label for="username">Username</label>
                     <input type="text" class="form-control" id="username" name="username" value="<?php echo $user['username']; ?>" required>
                  </div>
                  <div class="form-group">
                     <label for="passcode">Password</label>
                     <input type="password" class="form-control" id="passcode" name="passcode" value="<?php echo $user['passcode']; ?>" required>
                  </div>
                  <div class="form-group">
                     <label for="name">Name</label>
                     <input type="text" class="form-control" id="name" name="name" value="<?php echo $user['name']; ?>" required>
                  </div>
                  <div class="form-group">
                     <label for="surname">Surname</label>
                     <input type="text" class="form-control" id="surname" name="surname" value="<?php echo $user['surname']; ?>" required>
                  </div>
                  <div class="form-group">
                     <label for="age">Age</label>
                     <input type="number" class="form-control" id="age" name="age" value="<?php echo $user['age']; ?>" required>
                  </div>
                  <div class="form-group">
                     <label for="gender">Gender</label>
                     <input class="form-control" id="gender" name="gender" value="<?php echo $user['gender']; ?>" required>
                  </div>
         
         <button type="submit" class="btn btn-primary" name="action" value="update">Save Changes</button>
         <a href="editEmployee.php" class="btn btn-secondary">Back</a>
      </form>
   </div>
</body>

</html>
