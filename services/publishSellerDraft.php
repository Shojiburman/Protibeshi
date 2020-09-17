<?php
	session_start();
	require_once('../db/db.php');
	$conn = dbConnection();
	if(!$conn){
		echo "DB connection error";
	}

	$id = $_SESSION['id'];
	$s_id = $_POST['s_id'];
	$details = $_POST['details'];
	$price = $_POST['price'];

	if(($id != '') && ($s_id != '') && ($details != '') && ($price != '')){

		$sql = "INSERT INTO us_services (s_id, u_id, details, price) VALUES ('". $s_id ."', '". $id ."', '". $details ."', '". $price ."');";
		if ($conn->query($sql) === TRUE) {
			echo "insert";
		} else {
			echo "not ok";
		}
	} else {
		echo 'not ok';
	}

	


?>