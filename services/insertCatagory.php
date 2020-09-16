<?php
	require_once('../db/db.php');
	$conn = dbConnection();
	if(!$conn){
		echo "DB connection error";
	}

	$name = $_POST['name'];
	$details = $_POST['details'];
	$sql = "INSERT INTO catagory (name, details) VALUES ('". $name ."', '". $details ."');";
	if ($conn->query($sql) === TRUE) {
		$data = "insert";
	} else {
		$data = "not ok";
	}
	echo $data;
?>