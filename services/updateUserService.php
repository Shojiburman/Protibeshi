<?php
	require_once('../db/db.php');
	$conn = dbConnection();
	if(!$conn){
		echo "DB connection error";
	}
	$us_id = $_POST['us_id'];
	$details = $_POST['details'];
	$price = $_POST['price'];

	$sql = "UPDATE us_services SET details = '$details', price = '$price' WHERE us_id = '$us_id'";
	if ($conn->query($sql) === TRUE) {
		echo "update";
	} else {
		echo "not ok";
	}

?>