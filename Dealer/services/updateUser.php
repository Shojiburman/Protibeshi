<?php
	require_once('../db/db.php');
	$conn = dbConnection();
	if(!$conn){
		echo "DB connection error";
	}
	$u_id = $_POST['u_id'];
	$name = $_POST['name'];
	$email = $_POST['email'];
	$password = $_POST['password'];
	$utype = $_POST['utype'];
	$sql = "UPDATE users SET name = '$name', email = '$email', pass = '$password', admin = '$utype' WHERE u_id = '$u_id';";
	if ($conn->query($sql) === TRUE) {
		echo "update";
	} else {
		echo "not ok";
	}

?>