<?php
	require_once('../db/db.php');
	$conn = dbConnection();
	if(!$conn){
		echo "DB connection error";
	}
	$email = $_POST['email'];
	if(($email != '')){
		$sql = "SELECT * from users WHERE email = '".$email."'";
		if (($result = $conn->query($sql)) !== FALSE){
	        while($row = $result->fetch_assoc()){
				echo "found";
			}
		} else {
			echo "not found";
		}
	} else {
		echo "not ok";
	}
?>