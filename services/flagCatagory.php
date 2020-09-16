<?php
	require_once('../db/db.php');
	$conn = dbConnection();
	if(!$conn){
		echo "DB connection error";
	}
	$c_id = $_POST['c_id'];
	$flag = $_POST['flag'];
	$sql = "UPDATE catagory SET flag = '$flag' WHERE c_id = '$c_id';";
	if ($conn->query($sql) === TRUE) {
		echo "flaged";
	} else {
		echo "not ok";
	}

?>