<?php
	require_once('../db/db.php');
	$conn = dbConnection();
	if(!$conn){
		echo "DB connection error";
	}
	$f_id = $_POST['f_id'];
	$flag = $_POST['flag'];
	$sql = "UPDATE faq SET flag = '$flag' WHERE f_id = '$f_id';";
	if ($conn->query($sql) === TRUE) {
		echo "flaged";
	} else {
		echo "not ok";
	}

?>