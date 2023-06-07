<?php
session_start();
include "db.php";

if (empty($_SESSION['id'])) {
   header('Location: Login.php');
   exit;
}

$db = new DbConnection();
$user_id = $_SESSION['id'];

$sql = "SELECT * FROM users where user_id = $user_id" ;
$user_data =$db->execute_query($sql);

$username = $user_data[0]['username'];
$passcode = $user_data[0]['passcode'];
$name = $user_data[0]['name'];
$surname  = $user_data[0]['surname'];
$age = $user_data[0]['age'];
$department_id = $user_data[0]['department_id'];
$gender = $user_data[0]['gender'];

//  var_dump($gender);
//  echo "<br>";
//  die('die here');

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
                  <img src="/image/My_Photo.png" height = "250"  width = "250" alt="Profile Picture"><br><b>Profile Picture</b></br>
               </div>
            </div>
            <div class="row justify-content-center">
               <div class="col-sm-4">
                  <div class="form-group">
                     <label for="username">Username</label>
                     <input type="text" class="form-control" id="username" name="username" value="<?php echo "$username";?>" required>
                  </div>
                  <div class="form-group">
                     <label for="passcode">Password</label>
                     <input type="password" class="form-control" id="passcode" name="passcode" value="<?php echo "$passcode";?>" required>
                  </div>
                  <div class="form-group">
                     <label for="name">Name</label>
                     <input type="text" class="form-control" id="name" name="name" value="<?php echo  "$name";?>" required>
                  </div>
                  <div class="form-group">
                     <label for="surname">Surname</label>
                     <input type="text" class="form-control" id="surname" name="surname" value="<?php echo "$surname";?>" required>
                  </div>
                  <div class="form-group">
                     <label for="age">Age</label>
                     <input type="number" class="form-control" id="age" name="age" value="<?php echo "$age";?>" required>
                  </div>
                  <div class="form-group">
                     <label for="department_id">Department_id</label>
                     <input type="number" class="form-control" id="department_id" name="department_id" value="<?php echo "$department_id";?>" required>
                  </div>
                  <div class="form-group">
                     <label for="gender">Gender</label>
                     <input class="form-control" id="gender" name="gender" value = "<?php echo "$gender";?>" required>
                  </div>
         
         <button type="submit" class="btn btn-primary">Save Changes</button>
         <a href="Home.php" class="btn btn-secondary">Back</a>
      </form>
   </div>
</body>

</html>