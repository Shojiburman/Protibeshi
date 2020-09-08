<?php
	require_once('../db/db.php');
	$conn = dbConnection();
	if(!$conn){
		echo "DB connection error";
	}

	$f_id = $_POST['f_id'];
	$sql = "SELECT * FROM faq WHERE f_id = '". $f_id ."';";
	if (($result = $conn->query($sql)) !== FALSE){
        while($row = $result->fetch_assoc()){
            $id = $row['f_id'];
            $name =  $row['name'];
            $ans = $row['ans'];
            $date = $row['date'];
            echo "$id|$name|$ans|$date";
        }
    }
    $conn->close();
?>