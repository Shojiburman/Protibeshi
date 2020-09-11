<?php
	require_once('../db/db.php');
	$conn = dbConnection();
	if(!$conn){
		echo "DB connection error";
	}

	$us_id = $_POST['us_id'];
	$sql = "SELECT * FROM us_services WHERE us_id = '". $us_id ."';";
	if (($result = $conn->query($sql)) !== FALSE){
        while($row = $result->fetch_assoc()){
            $id = $row['us_id'];
            $details = $row['details'];
            $price = $row['price'];
            echo "$id|$details|$price";
        }
    }
    $conn->close();
?>