<?php
	require_once('../db/db.php');
	$conn = dbConnection();
	if(!$conn){
		echo "DB connection error";
	}
	
	$search = $_POST['search'];
	$type = $_POST['type'];

	if(($search != '') && ($type == 'Services')){
		$sql = "SELECT u.s_id, s.name, u.price, u.details, c.name AS cname, u.us_id, u.u_id
			FROM services s
			INNER JOIN us_services u
			ON s.s_id = u.s_id
			INNER JOIN catagory c
			ON s.c_id = c.c_id
			AND s.name Like '%$search%';";
		if (($result = $conn->query($sql)) !== FALSE){
			$data = array();
	        while($row = $result->fetch_assoc()){
				$name = $row['u_id'];
				$sname = $row['name'];
				$price = $row['price'];
				$details = $row['details'];
				$catagory = $row['cname'];
				$u_id = $row['us_id'];

				$test = [
					"sname" => $sname,
					"name" => $name,
					"catagory" => $catagory,
					"price" => '৳'.$price,
					"details" => $details,
					"u_id" => $u_id,
				];
				array_push($data, $test);
			}
			echo json_encode($data);
		} else{
			echo "not found";
		}
	} else if(($search != '') && ($type == 'Seller')){
		$sql = "SELECT u_id, name, email, pnumber, bio, work FROM users WHERE admin = '0'
			AND name Like '%$search%';";
		if (($result = $conn->query($sql)) !== FALSE){
			$data = array();
	        while($row = $result->fetch_assoc()){
				$name = $row['name'];
				$sname = $row['email'];
				$price = $row['pnumber'];
				$details = $row['bio'];
				$catagory = $row['work'];
				$u_id = $row['u_id'];


				$test = [
					"sname" => $name,
					"name" => $sname,
					"catagory" => $catagory,
					"price" => $price,
					"details" => $details,
					"u_id" => $u_id,
				];
				array_push($data, $test);
			}
			echo json_encode($data);
		} else{
			echo "not found";
		}
	} else if(($search != '') && ($type == 'Buyer')){
		$sql = "SELECT u_id, name, email, pnumber, bio, work FROM users WHERE admin = '1'
			AND name Like '%$search%';";
		if (($result = $conn->query($sql)) !== FALSE){
			$data = array();
	        while($row = $result->fetch_assoc()){
				$name = $row['name'];
				$sname = $row['email'];
				$price = $row['pnumber'];
				$details = $row['bio'];
				$catagory = $row['work'];
				$u_id = $row['u_id'];


				$test = [
					"sname" => $name,
					"name" => $sname,
					"catagory" => $catagory,
					"price" => $price,
					"details" => $details,
					"u_id" => $u_id,
				];
				array_push($data, $test);
			}
			echo json_encode($data);
		} else{
			echo "not found";
		}
	}

	else if(($search != '') && ($type == 'Dealer')){
		$sql = "SELECT u_id, name, email, pnumber, bio, work FROM users WHERE admin = '2'
			AND name Like '%$search%';";
		if (($result = $conn->query($sql)) !== FALSE){
			$data = array();
	        while($row = $result->fetch_assoc()){
				$name = $row['name'];
				$sname = $row['email'];
				$price = $row['pnumber'];
				$details = $row['bio'];
				$catagory = $row['work'];
				$u_id = $row['u_id'];


				$test = [
					"sname" => $name,
					"name" => $sname,
					"catagory" => $catagory,
					"price" => $price,
					"details" => $details,
					"u_id" => $u_id,
				];
				array_push($data, $test);
			}
			echo json_encode($data);
		} else{
			echo "not found";
		}
	}

	else {
		echo 'not ok';
	}

?>