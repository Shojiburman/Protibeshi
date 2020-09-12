<?php
	require_once('../db/db.php');
	$conn = dbConnection();
	if(!$conn){
		echo "DB connection error";
	}

	$u_id = $_POST['u_id'];
	$sql = "DELETE FROM users WHERE u_id = '". $u_id ."';";
	if ($conn->query($sql) === TRUE) {
		$sql1 = "DELETE FROM us_services WHERE u_id = '". $u_id ."';";
		if ($conn->query($sql1) === TRUE) {
			echo "delete";
		} else {
			echo "not ok";
		}
	} else {
		echo "not ok";
	}
?>