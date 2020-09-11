<?php
	require_once('../db/db.php');
	$conn = dbConnection();
	if(!$conn){
		echo "DB connection error";
	}

	$bs_id = $_POST['bs_id'];
	$sql = "DELETE FROM bookmark_service WHERE bs_id = '". $bs_id ."';";
	if ($conn->query($sql) === TRUE) {
		echo "delete";
	} else {
		echo "not ok";
	}
?>