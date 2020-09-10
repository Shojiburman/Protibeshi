<?php
	session_start();
    include '../php/session.php';

	if(isset($_GET["uid"])){
		$id = $_GET["uid"];
	}
	require_once('../db/db.php');
	$conn = dbConnection();
	if(!$conn){
		echo "DB connection error";
	}
	$sql = "SELECT s.name AS sname, c.name AS cname, us.name AS uname, u.details, u.price, u.us_id, us.u_id  from services s, us_services u, users us, catagory c where s.s_id = u.s_id AND us.u_id = u.u_id AND s.c_id = c.c_id AND u.us_id = '$id'";
	if (($result = $conn->query($sql)) !== FALSE){
		$data = array();
        while($row = $result->fetch_assoc()){
			$name = $row['uname'];
			$sname = $row['sname'];
			$price = $row['price'];
			$details = $row['details'];
			$catagory = $row['cname'];
			$u_id = $row['u_id'];
		}
	}
?>


<!DOCTYPE html>
<html>
<head>
	<title>View profile</title>
	<link rel="stylesheet" type="text/css" href="../css/body.css">
    <link rel="stylesheet" type="text/css" href="../css/adminNav.css">
</head>
<body>
	<?php
        if(isset($_SESSION['id']) || isset($_COOKIE['remember'])){
            if($c_type == '0'){
                include '../views/sellerNav.html';
            } else if($c_type == '1'){
                include '../views/buyerNav.html';
            } else if($c_type == '2'){
                include '../views/dealerNav.html';
            } else if($c_type == '3'){
                include '../views/adminNav.html';
            }
            
        } else {
            include '../views/nav.html';
        }
    ?>
	<div id="view-profile">
		<h1><?php echo $sname ?></h1>
		<p class="sub-title"><?php echo $name ?></p>
		<p class="sub-title"><?php echo $catagory ?></p>
		<p class="sub-title">৳<?php echo $price ?></p>
		<p class="clearfix"></p>
		<p><?php echo $details ?></p>
	</div>
</body>
</html>