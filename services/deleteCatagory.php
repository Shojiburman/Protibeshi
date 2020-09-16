<?php
	require_once('../db/db.php');
	$conn = dbConnection();
	if(!$conn){
		echo "DB connection error";
	}

	$c_id = $_POST['c_id'];
	$sql = "DELETE FROM catagory WHERE c_id = '". $c_id ."';";
	if ($conn->query($sql) === TRUE) {
		echo "delete";
	} else {
		echo "not ok";
	}
?>