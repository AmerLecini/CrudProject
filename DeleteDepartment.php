<?php
include "db.php";
$db = new DbConnection();


$parent_id = $_POST['parent_id'];
$sql = "DELETE from departament where parent_id = '{$parent_id}'";

$result = $db->execute_query($sql);

if(!$result)
    echo die('ERROR');
    header('Location: departament.php');
