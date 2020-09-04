<?php
	require_once('../db/db.php');
	$conn = dbConnection();
	if(!$conn){
		echo "DB connection error";
	}
	$f_id = $_POST['f_id'];
	$name = $_POST['name'];
	$ans = $_POST['ans'];
	$date = $_POST['date'];
	$sql = "UPDATE faq SET `name` = '$name', `ans` = '$ans', `date` = '$date' WHERE `f_id` = '$f_id';";
	if ($conn->query($sql) === TRUE) {
		echo "update";
	} else {
		echo "not ok";
	}

?>