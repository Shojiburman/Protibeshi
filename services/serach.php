<?php
	require_once('../db/db.php');
	$conn = dbConnection();
	if(!$conn){
		echo "DB connection error";
	}
	$type = $_POST['type'];
	$search = $_POST['search'];

	if(($type == 'Services') && ($search != '')){
		$sql = "SELECT s.name AS sname, c.name AS cname, us.name AS uname, u.details, u.price, us.u_id from services s, us_services u, users us, catagory c where s.s_id = u.s_id AND us.u_id = u.u_id AND s.c_id = c.c_id AND s.name like '%$search%'";
		if (($result = $conn->query($sql)) !== FALSE){
			$data = array();
	        while($row = $result->fetch_assoc()){
				$test = [
					"name" => $row['uname'],
					"sname" => $row['sname'],
					"price" => $row['price'],
					"details" => $row['details'],
					"catagory" => $row['cname'],
					"u_id" => $row['u_id'],
				];
				array_push($data, $test);
			}
			echo json_encode($data);
		} else {
			echo "not found";
		}
	} else {
		echo "not ok";
	}

?>