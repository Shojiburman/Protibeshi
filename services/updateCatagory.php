<?php
	require_once('../db/db.php');
	$conn = dbConnection();
	if(!$conn){
		echo "DB connection error";
	}
	$c_id = $_POST['c_id'];
	$name = $_POST['name'];
	$details = $_POST['details'];
	$sql = "UPDATE catagory SET name = '$name', details = '$details' WHERE c_id = '$c_id'";
	if ($conn->query($sql) === TRUE) {
		echo "update";
	} else {
		echo "not ok";
	}

?>