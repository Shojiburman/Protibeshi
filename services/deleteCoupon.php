<?php
	require_once('../db/db.php');
	$conn = dbConnection();
	if(!$conn){
		echo "DB connection error";
	}

	$coupon_id = $_POST['coupon_id'];
	$sql = "DELETE FROM coupon WHERE coupon_id = '". $coupon_id ."';";
	if ($conn->query($sql) === TRUE) {
		echo "delete";
	} else {
		echo "not ok";
	}
?>