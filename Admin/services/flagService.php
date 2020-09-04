<?php
	require_once('../db/db.php');
	$conn = dbConnection();
	if(!$conn){
		echo "DB connection error";
	}
	$s_id = $_POST['s_id'];
	$flag = $_POST['flag'];
	$sql = "UPDATE services SET flag = '$flag' WHERE s_id = '$s_id';";
	if ($conn->query($sql) === TRUE) {
		echo "flaged";
	} else {
		echo "not ok";
	}

?>