<?php
	session_start();
	include '../php/session.php';
	require_once('../db/db.php');
	$conn = dbConnection();	
	if(!$conn){	
		echo "DB connection error";	
	}

	if(isset($_GET["uid"])){
		$userid = $_GET["uid"];
?>
<!DOCTYPE html>
<html>
<head>
	<title>Place Order</title>
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

	<div id="place-order" data = '<?php echo $userid ?>' data-uid='<?php echo $_SESSION['id'] ?>'>
		<?php
		$sql = "SELECT u.us_id, s.name, u.price, u.details, c.name AS cname, u.u_id, usr.name AS username, usr.bio, usr.email, usr.work, usr.dob, usr.pnumber
				FROM us_services u	
				INNER JOIN services s
				ON s.s_id = u.s_id	
				INNER JOIN catagory c	
				ON s.c_id = c.c_id
                INNER JOIN users usr
				ON u.u_id = usr.u_id
                AND s.flag = '0'
                AND u.us_id = $userid;";

		if (($result = $conn->query($sql)) !== FALSE){	
	        while($row = $result->fetch_assoc()){	
				$name = $row['username'];	
				$sname = $row['name'];	
				$price = $row['price'];	
				$details = $row['details'];	
				$catagory = $row['cname'];	
				$u_id = $row['u_id'];
				$us_id = $row['us_id'];
		?>
		<div class="place-order-section">
			<div class="vertical-center">
				<h1><?php echo $sname ?></h1>
				<p><?php echo $details ?></p>
			</div>
		</div>
		<div class="place-order-section">
			<div class="vertical-center">
				<p class="highlight">Name : <span><?php echo ucwords($name) ?></span></p>
				<p class="highlight">Catagoty : <span><?php echo $catagory ?></span></p>
				<p class="highlight">Price : <span><?php echo '৳'.$price ?></span></p>
				<button class="btn" onclick="addCart()">Add to Cart</button>
				<p class="de-active g">Added</p>
			</div>
		</div>
<?php
			}
		}
?>		</div>u
<?php	
	} else {
		header('Location: ' . $_SERVER['HTTP_REFERER']);
	}

?>
	<script type="text/javascript" src="../js/script.js"></script>
</body>
</html>