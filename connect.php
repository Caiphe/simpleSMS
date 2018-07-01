<?php 
 //$db = new PDO('mysql:host=localhost;dbname=school_management', 'root', 'root');
 //$connect = mysqli_connect("127.0.0.1", "root" , "root", "helloworld");
/*$db_host = "localhost";
$db_name = "school_management";
$db_password = "root";
$db_username = "root";*/

try{
	$db_con = new PDO('mysql:host=localhost;dbname=school_management', 'root', 'root');
	$db_con->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
	//$DB_con->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
}catch(PDOException $e)
{
	echo $e->getMessage();
}

 //include_once 'crud.php';
 //$crud =  new crud($db_con);

?>