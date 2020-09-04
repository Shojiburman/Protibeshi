<?php
	require_once('../db/db.php');
	$conn = dbConnection();
	if(!$conn){
		echo "DB connection error";
	}

	$flag = $_POST['flag'];
	$s_id = $_POST['s_id'];
	$sql = "UPDATE services SET flag = '". $flag ."' WHERE s_id = '". $s_id ."';";
	if ($conn->query($sql) === TRUE) {
		echo "ok";
	} else {
		echo "not ok";
	}
?>