<?php
	require_once('../db/db.php');
	$conn = dbConnection();
	if(!$conn){
		echo "DB connection error";
	}
	$coupon_id = $_POST['coupon_id'];
	$name = $_POST['name'];
	$percentage = $_POST['percentage'];
	$expiredate = $_POST['expiredate'];
	$sql = "UPDATE coupon SET name = '$name', percentage = '$percentage', expiredate = '$expiredate' WHERE coupon_id = '$coupon_id';";
	if ($conn->query($sql) === TRUE) {
		echo "update";
	} else {
		echo "not ok";
	}

?>