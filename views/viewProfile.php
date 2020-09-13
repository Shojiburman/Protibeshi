<?php
	session_start();
	include '../php/session.php';
	require_once('../db/db.php');

	if(isset($_GET["uid"])){	
		$userid = $_GET["uid"];
		$conn = dbConnection();	
		if(!$conn){	
			echo "DB connection error";	
		}	
		$sql = "SELECT u.us_id, s.name, u.price, u.details, c.name AS cname, u.u_id	, usr.name AS username
				FROM us_services u	
				INNER JOIN services s
				ON s.s_id = u.s_id	
				INNER JOIN catagory c	
				ON s.c_id = c.c_id
                INNER JOIN users usr
				ON u.u_id = usr.u_id
				AND u.u_id = '$userid'
                AND s.flag = '0';";	

		if (($result = $conn->query($sql)) !== FALSE){	
	        while($row = $result->fetch_assoc()){	
				$name = $row['u_id'];	
				$sname = $row['name'];	
				$price = $row['price'];	
				$details = $row['details'];	
				$catagory = $row['cname'];	
				$u_id = $row['u_id'];	
			}	
		}	

		$sql = "SELECT name from users WHERE u_id = '$u_id'";	
		if (($result = $conn->query($sql)) !== FALSE){	
	        while($row = $result->fetch_assoc()){	
				$name = $row['name'];	
			}	
		}

	} else {
		header('Location: ' . $_SERVER['HTTP_REFERER']);
	}

?>
<!DOCTYPE html>
<html>
<head>
	<title><?php echo $userid; ?> Profile</title>
</head>
<body>

</body>
</html>