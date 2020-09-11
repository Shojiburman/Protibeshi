<?php
	require_once('../db/db.php');
	$conn = dbConnection();
	if(!$conn){
		echo "DB connection error";
	}

	$us_id = $_POST['us_id'];
	$sql = "DELETE FROM us_services WHERE us_id = '". $us_id ."';";
	if ($conn->query($sql) === TRUE) {
		echo "delete";
	} else {
		echo "not ok";
	}
?>