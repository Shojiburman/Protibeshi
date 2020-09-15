<?php
	session_start();
	require_once('../db/db.php');
	$conn = dbConnection();
	if(!$conn){
		echo "DB connection error";
	}

	$price = $_POST['price'];
	if(isset($_POST['coupon'])){
		if($_POST['coupon'] != ''){
			$coupon = $_POST['coupon'];
			$sql = "SELECT coupon_id FROM coupon WHERE name = '$coupon';";
			if (($result = $conn->query($sql)) !== FALSE){
		        while($row = $result->fetch_assoc()){
		            $cid = $row['coupon_id'];
		        }
			}
		} else {
			$userid = $_SESSION['id'];
			$sql = "INSERT INTO transaction (buyer_id, bill, coupon_id) VALUES ('$userid', '$price', 'cid')";
			if ($conn->query($sql) === TRUE) {
				echo "insert";
			} else {
				echo "not ok";
			}
		}
	} else {
			$userid = $_SESSION['id'];
			$sql = "INSERT INTO transaction (buyer_id, bill) VALUES ('$userid', '$price')";
			if ($conn->query($sql) === TRUE) {
				echo "insert";
			} else {
				echo "not ok";
			}
		}
?>