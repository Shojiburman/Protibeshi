<?php
	require_once('../db/db.php');
	$conn = dbConnection();
	if(!$conn){
		echo "DB connection error";
	}

	$name = $_POST['name'];
	$percentage = $_POST['percentage'];
	$expiredate = $_POST['expiredate'];
	$sql = "INSERT INTO coupon (name, percentage, expiredate) VALUES ('". $name ."', '". $percentage ."', '". $expiredate ."');";

	if ($conn->query($sql) === TRUE) {
		echo "insert";
	} else {
		echo "not ok";
	}
?>