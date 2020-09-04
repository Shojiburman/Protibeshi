<?php
	require_once('../db/db.php');
	$conn = dbConnection();
	if(!$conn){
		echo "DB connection error";
	}

	$name = $_POST['name'];
	$details = $_POST['details'];
	$price = $_POST['price'];
	$c_id = $_POST['catagory'];
	$sql = "INSERT INTO services (name, details, price, c_id) VALUES ('". $name ."', '". $details ."', '". $price ."', '". $c_id ."');";
	if ($conn->query($sql) === TRUE) {
		$data = "insert";
	} else {
		$data = "not ok";
	}
	echo $data;
?>