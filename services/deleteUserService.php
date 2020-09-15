<?php
	require_once('../db/db.php');
	$conn = dbConnection();
	if(!$conn){
		echo "DB connection error";
	}

	if(isset($_POST['draft'])){
		$us_id = $_POST['us_id'];
		$sql = "DELETE FROM draft WHERE d_id = '". $us_id ."';";
		if ($conn->query($sql) === TRUE) {
			echo "draftdelete";
		} else {
			echo "not ok";
		}
	} else {
		$us_id = $_POST['us_id'];
		$sql = "DELETE FROM us_services WHERE us_id = '". $us_id ."';";
		if ($conn->query($sql) === TRUE) {
			echo "delete";
		} else {
			echo "not ok";
		}
	}
?>