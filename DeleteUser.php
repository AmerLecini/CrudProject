<?php
include "db.php";
?>

<?php 
$user_id = $_POST['user_id'];

$sql = "DELETE from user where user_id = '{$user_id}' ";

$result =$db->execute_query($sql);
if (!$result)
    die('ERROR');

