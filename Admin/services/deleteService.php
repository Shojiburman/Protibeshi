<?php
	require_once('../db/db.php');
	$conn = dbConnection();
	if(!$conn){
		echo "DB connection error";
	}

	$s_id = $_POST['s_id'];
	$sql = "DELETE FROM services WHERE s_id = '". $s_id ."';";
	if ($conn->query($sql) === TRUE) {
		echo "ok";
	} else {
		echo "not ok";
	}
?>