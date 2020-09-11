<?php
	require_once('../db/db.php');
	$conn = dbConnection();
	if(!$conn){
		echo "DB connection error";
	}

	$c_id = $_POST['c_id'];

	$sql = "SELECT * FROM catagory WHERE c_id = '". $c_id ."';";
	if (($result = $conn->query($sql)) !== FALSE){
        while($row = $result->fetch_assoc()){
            $id = $row['c_id'];
            $name =  $row['name'];
            $details = $row['details'];
            $flag = $row['flag'];
            echo "$id|$name|$details|$flag";
        }
    }
    $conn->close();
?>