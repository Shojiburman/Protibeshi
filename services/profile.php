<?php
	require_once('../db/db.php');
	$conn = dbConnection();
	if(!$conn){
		echo "DB connection error";
	}

	$json = $_POST['json'];
	$obj = json_decode($json);

	$u_id = $obj->u_id;
	$name = $obj->name;
	$work = $obj->work;
	$number = $obj->number;
	$address = $obj->address;
	$dob = $obj->dob;
	$bio = $obj->bio;

	$sql = "UPDATE users SET name = '$name', work = '$work', pnumber = '$number', address = '$address', dob = '$dob', bio = '$bio' WHERE u_id = '$u_id';";

	if ($conn->query($sql) === TRUE) {
		echo 'update';
	} else {
	 	echo 'not ok';
	}
?>