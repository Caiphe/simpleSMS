<?php 
include('connect.php');
$id = $_GET['id'];
$query='DELETE FROM students WHERE id = ?';
$pdoResult = $db_con->prepare($query);
$pdoResult->execute(array($id));

header('location:allStudents.php');
exit();
?>