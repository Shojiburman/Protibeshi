<?php
	session_start();
	require_once('../db/db.php');
	$conn = dbConnection();
	if(!$conn){
		echo "DB connection error";
	}

	$us_id = $_POST['us_id'];
	$bill = $_POST['bill'];
	$u_id = $_POST['u_id'];
	$userid = $_SESSION['id'];

	$sql = "SELECT admin from users where u_id = '$userid'";
	if (($result = $conn->query($sql)) !== FALSE){
        while($row = $result->fetch_assoc()){
        	$admin = $row['admin'];
        }
    }

    if($admin != '3'){
    	$check = "SELECT * from cart where us_id = '$us_id' AND u_id = '$u_id'";
		if (($result = $conn->query($check)) !== FALSE){
	        if($row = $result->fetch_assoc()){
	        	echo "already added";
	        } 
	        else {
	        	$sql = "INSERT INTO cart (us_id, bill, u_id) VALUES ('". $us_id ."', '". $bill ."', '". $u_id ."');";
				if ($conn->query($sql) === TRUE) {
					echo "insert";
				} else {
					echo "not ok";
				}
			}
		}
    } else {
    	echo "admin";
    }
?>