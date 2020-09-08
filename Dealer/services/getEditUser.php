<?php
	require_once('../db/db.php');
	$conn = dbConnection();
	if(!$conn){
		echo "DB connection error";
	}

	$u_id = $_POST['u_id'];
	$sql = "SELECT * FROM users WHERE u_id = '". $u_id ."';";
	if (($result = $conn->query($sql)) !== FALSE){
        while($row = $result->fetch_assoc()){
            $id = $row['u_id'];
            $name =  $row['name'];
            $email = $row['email'];
            $pass = $row['pass'];
            $admin = $row['admin'];
            echo "$id|$name|$email|$pass|$admin";
        }
    }
    $conn->close();
?>