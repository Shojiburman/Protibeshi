<?php
	require_once('../db/db.php');
	$conn = dbConnection();
	if(!$conn){
		echo "DB connection error";
	}

	if($_POST['draft'] == 'draft'){

		$us_id = $_POST['us_id'];
		$sql = "SELECT us.d_id, s.name, us.price, us.details, c.c_id
				FROM services s
				INNER JOIN draft us
				ON s.s_id = us.s_id
				INNER JOIN catagory c
				ON s.c_id = c.c_id
				AND us.d_id = '$us_id'";
		if (($result = $conn->query($sql)) !== FALSE){
	        while($row = $result->fetch_assoc()){
	            $id = $row['d_id'];
	            $sname = $row['name'];
	            $details = $row['details'];
	            $price = $row['price'];
	            $catagory = $row['c_id'];
	            echo "$id|$sname|$details|$price|$catagory";
	        }
	    }
	} else {
		$us_id = $_POST['us_id'];
		$sql = "SELECT us.us_id, s.name, us.price, us.details, c.c_id
				FROM services s
				INNER JOIN us_services us
				ON s.s_id = us.s_id
				INNER JOIN catagory c
				ON s.c_id = c.c_id
				AND us.us_id = '$us_id'";
		if (($result = $conn->query($sql)) !== FALSE){
	        while($row = $result->fetch_assoc()){
	            $id = $row['us_id'];
	            $sname = $row['name'];
	            $details = $row['details'];
	            $price = $row['price'];
	            $catagory = $row['c_id'];
	            echo "$id|$sname|$details|$price|$catagory";
	        }
	    }
	}
    $conn->close();
?>