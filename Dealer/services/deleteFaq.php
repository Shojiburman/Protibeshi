<?php
	require_once('../db/db.php');
	$conn = dbConnection();
	if(!$conn){
		echo "DB connection error";
	}

	$f_id = $_POST['f_id'];
	$sql = "DELETE FROM faq WHERE f_id = '". $f_id ."';";
	if ($conn->query($sql) === TRUE) {
		echo "delete";
	} else {
		echo "not ok";
	}
?>