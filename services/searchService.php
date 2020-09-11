<?php
	require_once('../db/db.php');
	$conn = dbConnection();
	if(!$conn){
		echo "DB connection error";
	}
	
	$search = $_POST['search'];
	$type = $_POST['type'];
	if($type == 'Home'){
		$type = '1';
	} else if($type == 'Hotel'){
		$type = '2';
	} else if($type == 'Office'){
		$type = '3';
	}

	if($search != ''){
		$sql = "SELECT s_id, name from services where name like '%$search%' AND c_id = '$type' AND flag = '0'";
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