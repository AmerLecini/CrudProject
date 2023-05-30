<?php
// session_start();
include "db.php";
$db = new DbConnection();

// if (empty($_SESSION['id'])) {
//     header("Location: Login.php");
// }


        $id = $_GET['id'];

        $sql = "DELETE FROM department WHERE id = $id";
        $db->execute_query($sql);

        header('Location: Department.php');
    

