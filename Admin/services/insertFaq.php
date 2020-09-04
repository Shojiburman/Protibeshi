<?php
	require_once('../db/db.php');
	$conn = dbConnection();
	if(!$conn){
		echo "DB connection error";
	}

	$name = $_POST['name'];
	$ans = $_POST['ans'];
	$date = $_POST['date'];
	$sql = "INSERT INTO faq (`name`, `ans`, `date`) VALUES ('". $name ."', '". $ans ."', '". $date ."');";
	if ($conn->query($sql) === TRUE) {
		$data = "insert";
	} else {
		$data = "not ok";
	}
	echo $data;
?>