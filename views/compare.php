<?php
	session_start();
	include '../php/session.php';
	require_once('../db/db.php');
	$conn = dbConnection();	
	if(!$conn){	
		echo "DB connection error";	
	}

	if(isset($_GET["c1"])){
		$usid1 = $_GET["c1"];
		if(isset($_GET["c2"])){
			$usid2 = $_GET["c2"];
		}
	}
?>

<?php 
    $conn = dbConnection();
    if ($conn->connect_error) {
      die("Connection failed: " . $conn->connect_error);
    }
    $sql = "SELECT s.name, us.price, us.details, c.name AS catagory
				FROM services s
				INNER JOIN us_services us
				ON s.s_id = us.s_id
				INNER JOIN catagory c
				ON s.c_id = c.c_id
				AND us.us_id = '$usid1'";
    if (($result = $conn->query($sql)) !== FALSE){
        while($row = $result->fetch_assoc()){
            $name1 =  $row['name'];
            $details1 = $row['details'];
            $price1 = $row['price'];
            $catagory1 = $row['catagory'];
        }
    }
    $conn->close();
?>

<?php 
    $conn = dbConnection();
    if ($conn->connect_error) {
      die("Connection failed: " . $conn->connect_error);
    }
    $sql = "SELECT s.name, us.price, us.details, c.name AS catagory
				FROM services s
				INNER JOIN us_services us
				ON s.s_id = us.s_id
				INNER JOIN catagory c
				ON s.c_id = c.c_id
				AND us.us_id = '$usid2'";
    if (($result = $conn->query($sql)) !== FALSE){
        while($row = $result->fetch_assoc()){
            $name2 =  $row['name'];
            $details2 = $row['details'];
            $price2= $row['price'];
            $catagory2 = $row['catagory'];
        }
    }
    $conn->close();
?>


<!DOCTYPE html>
<html>
<head>
	<title>Compare services</title>
	<link rel="stylesheet" type="text/css" href="../css/body.css">
</head>
<body>
	<?php
        if(isset($_SESSION['id']) || isset($_COOKIE['remember'])){
            if($_SESSION['uType'] == '0'){
                include '../views/sellerNav.html';
            } else if($_SESSION['uType'] == '1'){
                include '../views/buyerNav.html';
            } else if($_SESSION['uType'] == '2'){
                include '../views/dealerNav.html';
            } else if($_SESSION['uType'] == '3'){
                include '../views/adminNav.html';
            }
            
        } else {
            include '../views/nav.html';
        }
    ?>

	<table id="content">
        <tr>
            <td>
            	<table id="compare-table">
                    <tr>
                        <td><h1>Service 1</h1></td>
                        <td><h1>Service 2</h1></td>
                    </tr>
                    <tr>
                        <td>Name: <span><?php echo $name1; ?></span></td>
                        <td>Name: <span><?php echo $name2; ?></span></td>
                    </tr>
                    <tr>
                        <td>Price: <span><?php echo $price1; ?></span></td>
                        <td>Price: <span><?php echo $price2; ?></span></td>
                    </tr>
                    <tr>
                        <td>Deatails: <span><?php echo $details1; ?></span></td>
                        <td>Deatails: <span><?php echo $details2; ?></span></td>
                    </tr>
                    <tr>
                        <td>Catagory: <span><?php echo $catagory1; ?></span></td>
                        <td>Catagory: <span><?php echo $catagory2; ?></span></td>
                    </tr>
                </table>
            </td>
        </tr>
    </table>
    <button class="btn" onclick="back()">Back</button>
	<script type="text/javascript" src="../js/script.js"></script>
</body>
</html>