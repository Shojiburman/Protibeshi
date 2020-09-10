<?php
	require_once('../db/db.php');
	$conn = dbConnection();
	if(!$conn){
		echo "DB connection error";
	}

	$json = $_POST['json'];
	$obj = json_decode($json);

	$u_id = $obj->u_id;
	$pass = $obj->pass;
	$npass = $obj->npass;
	$cpass = $obj->cpass;

	if($npass == $cpass){
		if(($pass != $cpass) && ($npass != $pass)){
			$sql = "UPDATE users SET pass = '$cpass' WHERE u_id = '$u_id' AND pass = '$pass';";
			if ($conn->query($sql) === TRUE) {
				echo 'update';
			} else {
			 	echo 'not ok';
			}
		} else {
			echo 'match';
		}
	} else {
		echo 'dont match';
	}
?>