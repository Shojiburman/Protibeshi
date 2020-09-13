<?php
	require_once('../db/db.php');
	$conn = dbConnection();
	if(!$conn){
		echo "DB connection error";
	}
	$data = 'no';
	$check = "";
	$check = $_POST['check'];
	$rg = $_POST['rg'];
	$rs = $_POST['rs'];


	$sql1 = "SELECT * FROM request_bookmark_profile WHERE u_id = '$rs' AND bookmark_id = '$rg';";
	if (($result = $conn->query($sql1)) !== FALSE){
        if($row = $result->fetch_assoc()){
        	$data = 'not';
        } else {
        	$data = 'ok';
        	$sql2 = "SELECT * FROM bookmark_profile WHERE u_id = '$rs' AND bookmark_id = '$rg';";
        	if (($result = $conn->query($sql2)) !== FALSE){
        		if($row = $result->fetch_assoc()){
        			$data = 'frnd';
        		}
        	}
        }
    }

    if($check == ''){
    	if($data == 'ok'){
	    	$sql = "INSERT INTO request_bookmark_profile (bookmark_id, u_id) VALUES ('". $rg ."', '". $rs ."');";
			if ($conn->query($sql) === TRUE) {
				$data = "insert";
			} else {
				$data = "not ok";
			}
			echo $data;
	    } else if ($data == 'frnd') {
	    	echo $data;
	    } else if ($data == 'not'){
	    	echo "sent";
	    } else {

	    }
    } else if($check == 'check'){
    	echo $data;
    }
?>