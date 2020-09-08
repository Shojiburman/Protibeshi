<?php
	require_once('../db/db.php');
	$conn = dbConnection();
	if(!$conn){
		echo "DB connection error";
	}
	$s_id = $_POST['s_id'];
	$name = $_POST['name'];
	$details = $_POST['details'];
	$price = $_POST['price'];
	$c_id = $_POST['catagory'];
	$sql = "UPDATE services SET name = '$name', details = '$details', price = '$price', c_id = '$c_id' WHERE s_id = '$s_id';";
	if ($conn->query($sql) === TRUE) {
		echo "update";
	} else {
		echo "not ok";
	}

?>