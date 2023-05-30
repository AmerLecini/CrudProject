<!DOCTYPE html>
<html>

<head>
  <title>Add Employee</title>
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
</head>

<body>
  <div class="container">
    <h1>Add Employee</h1>
    <form action = "CreateDepartment.php" method="POST">
      <div class="form-group">
        <label for="username">name</label>
        <input type="text" class="form-control" id="name" name="name" required>
      </div>
      <div class="form-group">
        <label for="passcode">parent_id</label>
        <input type="text" class="form-control" id="id" name="parent_id" required>
      </div>
      <div class="form-group">
        <label for="surname">department_info</label>
        <input type="text" class="form-control" id="name" name="department_info" required>
      </div>
      </div>
      <br>
      <button type="submit" name="add_department" class="btn btn-primary">Add Department</button>
    </form>
  </div>
</body>

</html>


<?php

include "db.php";

$db = new DbConnection();

if(isset($_POST['add_department'])){
$sql_query = "INSERT INTO department (name,parent_id, row_inserted_at, department_info)
VALUES ('" . $_POST['name'] . "','" . $_POST['parent_id'] . "', now() ,'" . $_POST['department_info']. "');";

$result = $db->execute_query($sql_query);

if(!$result ){
    die("Error");
}
header('Location:Login.php');
}
?>

