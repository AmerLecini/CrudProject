<!DOCTYPE html>
<html>

<head>
  <title>Add Employee</title>
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
</head>

<body>
  <div class="container">
    <h1>Add Employee</h1>
    <form action = "CreateUser.php" method="POST">
      <div class="form-group">
        <label for="username">Username</label>
        <input type="text" class="form-control" id="username" name="username" required>
      </div>
      <div class="form-group">
        <label for="passcode">Password</label>
        <input type="password" class="form-control" id="passcode" name="passcode" required>
      </div>
      <div class="form-group">
        <label for="name">Name</label>
        <input type="text" class="form-control" id="name" name="name" required>
      </div>
      <div class="form-group">
        <label for="surname">Surname</label>
        <input type="text" class="form-control" id="surname" name="surname" required>
      </div>
      <div class="form-group">
        <label for="age">Age</label>
        <input type="number" class="form-control" id="age" name="age" required>
      </div>
      <div class="form-group">
        <label for="gender">Gender</label>
        <select class="form-control" id="gender" name="gender" required>
          <option value="" disabled selected>Select user's gender</option>
          <option value="male">Male</option>
          <option value="female">Female</option>
        </select>
      </div>
      <div class="form-group">
        <label for="department_id">Department ID</label>
        <input type="number" class="form-control" id="department_id" name="department_id" required>
      </div>
      <div class="form-group">
        <label for="is_admin">Is Admin?</label>
        <select class="form-control" id="is_admin" name="is_admin" required>
          <option value="" disabled selected>Is the user admin?</option>
          <option value="0">No</option>
          <option value="1">Yes</option>
        </select>
      </div>
      <button type="submit" name="add_employee" class="btn btn-primary">Add Employee</button>
    </form>
  </div>
</body>

</html>


<?php

include "db.php";

$db = new DbConnection();

if(isset($_POST['add_employee'])){
$sql_query = "INSERT INTO users (username, passcode, row_inserted_at, name, surname, age, gender, department_id, is_admin)
VALUES ('" . $_POST['username'] . "','" . $_POST['passcode'] . "', now() ,'" . $_POST['name'] . "','" 
. $_POST['surname'] . "','" . $_POST['age'] . "','" . $_POST['gender'] . "','" . $_POST['department_id'] . "','" 
. $_POST['is_admin'] . "');";

var_dump($sql_query);
$result = $db->execute_query($sql_query);
if(!$result ){
    die("Error");
}
header('Location:Login.php');
}
?>

