<?php
	require_once('../db/db.php');
	$conn = dbConnection();
	if(!$conn){
		echo "DB connection error";
	}

	$search = $_POST['search'];
	$type = $_POST['type'];

	if($search != ''){
		$sql = "SELECT s.s_id, s.name
			FROM services s
			INNER JOIN catagory c
			ON s.c_id = c.c_id
            AND c.c_id = '$type'
			AND s.name Like '%$search%'";
		if (($result = $conn->query($sql)) !== FALSE){
			$data = array();
	        while($row = $result->fetch_assoc()){
				$test = [
					"name" => $row['name'],
					"s_id" => $row['s_id'],
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