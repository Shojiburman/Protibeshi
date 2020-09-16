<?php
	require_once('../db/db.php');
	$conn = dbConnection();
	if(!$conn){
		echo "DB connection error";
	}

	$json = $_POST['json'];
	$obj = json_decode($json);
	/*
	$array = (array) $obj;

	print_r($array);
	for($i = 0; i<count($array); $i++){
		$bill += $array[i];
	}*/
	$array = array();
	foreach ($obj as $key => $value) {
		$bill = "$key=>$value\n";
		$var =  strpos($bill,">");
		$var = (int)$var;
		$var = $var + 1;
		$bill = substr($bill,$var);
		$bill = (int)$bill;
		array_push($array, $bill);
	}
	$sum = 0;
	$bill = 0;
	for($i = 0; $i < count($array); $i++){
		$index = $array[$i];
		$sql = "SELECT bill FROM cart WHERE cart_id = '$index';";
		if (($result = $conn->query($sql)) !== FALSE){
        	while($row = $result->fetch_assoc()){
				$sum += number_format($row['bill']);
			}
		} else {
			echo 'not ok';
		}
	} echo $sum;
?>