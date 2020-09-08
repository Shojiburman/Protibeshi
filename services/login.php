<?php
	session_start();
	require_once('../db/db.php');
	$conn = dbConnection();
	if(!$conn){
		echo "DB connection error";
	}
	$email = $_POST['email'];
	$pass = $_POST['pass'];
	if(($email != '') && ($email != '')){
		$sql = "SELECT * from users WHERE email = '$email' AND pass = '$pass'";
		if (($result = $conn->query($sql)) !== FALSE){
	        while($row = $result->fetch_assoc()){
	        	$_SESSION['uType'] = $row['admin'];
	        	$_SESSION['id'] = $row['u_id'];
				if(isset($remember) && in_array('yes', $remember)){
				    setcookie('remember', $row['u_id'], time() + (10 * 365 * 24 * 60 * 60));
				} else {
				    setcookie('remember', "");
				}
				if($_SESSION['uType'] == '0'){
					echo "0";
				} else if($_SESSION['uType'] == '1'){
					echo "1";
				} else if($_SESSION['uType'] == '2'){
					echo "2";
				} else if($_SESSION['uType'] == '3'){
					echo "3";
				}
			}
		} else {
			echo "not ok";
		}
	} else {
		echo "not ok";
	}
?>