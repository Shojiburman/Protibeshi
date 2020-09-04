<?php
	require_once('../db/db.php');
	$conn = dbConnection();
	if(!$conn){
		echo "DB connection error";
	}

	$name = $_POST['name'];
	$email = $_POST['email'];
	$password = $_POST['password'];
	$utype = $_POST['utype'];
	$sql = "INSERT INTO users (name, email, pass, admin) VALUES ('". $name ."', '". $email ."', '". $password ."', '". $utype ."');";
	if ($conn->query($sql) === TRUE) {
		$data = "insert";
	} else {
		$data = "not ok";
	}
	echo $data;
?>