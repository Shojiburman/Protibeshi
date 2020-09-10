<?php
	require_once('../db/db.php');
	$conn = dbConnection();
	if(!$conn){
		echo "DB connection error";
	}
	
	$search = $_POST['search'];

	if($search != ''){
		$sql = "SELECT s_id, name from services where name like '%$search%'";
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