<?php
	require_once('../db/db.php');
	$conn = dbConnection();
	if(!$conn){
		echo "DB connection error";
	}
	$checkcatagory = $_POST['checkcatagory'];
	if(($checkcatagory != '')){
		$sql = "SELECT * from catagory WHERE name = '".$checkcatagory."'";
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