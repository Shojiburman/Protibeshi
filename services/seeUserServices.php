<?php
	require_once('../db/db.php');
	$conn = dbConnection();
	if(!$conn){
		echo "DB connection error";
	}

	$sql = "SELECT u.us_id, s.name, u.price, u.details, c.name AS cname, u.u_id
			FROM services s
			INNER JOIN us_services u
			ON s.s_id = u.s_id
			INNER JOIN catagory c
			ON s.c_id = c.c_id
			AND s.flag = '0';";
		
	if (($result = $conn->query($sql)) !== FALSE){
		$data = array();
        while($row = $result->fetch_assoc()){
			$name = $row['u_id'];
			$sname = $row['name'];
			$price = $row['price'];
			$details = $row['details'];
			$catagory = $row['cname'];
			$u_id = $row['u_id'];
			$us_id = $row['us_id'];

			$sql1 = "SELECT name from users WHERE u_id = '$u_id'";
			if (($result1 = $conn->query($sql1)) !== FALSE){
		        if($row1 = $result1->fetch_assoc()){
					$name = $row1['name'];
				}
			}

			$test = [
				"sname" => $sname,
				"name" => $name,
				"catagory" => $catagory,
				"price" => '৳'.$price,
				"details" => $details,
				"u_id" => $u_id,
				"us_id" => $us_id,
			];
			array_push($data, $test);
		}
		echo json_encode($data);
	} else{
		echo "not found";
	}
?>