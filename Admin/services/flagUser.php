<?php
	require_once('../db/db.php');
	$conn = dbConnection();
	if(!$conn){
		echo "DB connection error";
	}
	$u_id = $_POST['u_id'];
	$flag = $_POST['flag'];
	$sql = "UPDATE users SET flag = '$flag' WHERE u_id = '$u_id';";
	if ($conn->query($sql) === TRUE) {
		echo "flaged";
	} else {
		echo "not ok";
	}

?>