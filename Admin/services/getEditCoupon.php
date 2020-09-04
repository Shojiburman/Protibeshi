<?php
	require_once('../db/db.php');
	$conn = dbConnection();
	if(!$conn){
		echo "DB connection error";
	}

	$coupon_id = $_POST['coupon_id'];
	$sql = "SELECT * FROM coupon WHERE coupon_id = '". $coupon_id ."';";
	if (($result = $conn->query($sql)) !== FALSE){
        while($row = $result->fetch_assoc()){
            $id = $row['coupon_id'];
            $name =  $row['name'];
            $percentage = $row['percentage'];
            $expiredate = $row['expiredate'];
            echo "$id|$name|$percentage|$expiredate";
        }
    }
    $conn->close();
?>