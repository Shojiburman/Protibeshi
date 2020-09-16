<?php
	session_start();
	require_once('../db/db.php');
	$conn = dbConnection();
	if(!$conn){
		echo "DB connection error";
	}

	if(isset($_POST['cart_id'])){
		$cart_id = $_POST['cart_id'];
		$sql = "DELETE FROM cart WHERE cart_id = '". $cart_id ."';";
		if ($conn->query($sql) === TRUE) {
			echo "delete";
		} else {
			echo "not ok";
		}
	} else {
		$u_id = $_SESSION['id'];
		$sql = "DELETE FROM cart WHERE u_id = '". $u_id ."';";
		if ($conn->query($sql) === TRUE) {
			echo "delete";
		} else {
			echo "not ok";
		}
	}
?>