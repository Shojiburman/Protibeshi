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

		$sqlName = "SELECT * FROM users where u_id = '$userid'";
		if (($result = $conn->query($sqlName)) !== FALSE){	
	        while($row = $result->fetch_assoc()){	
				$name = $row['name'];
				$bio = $row['bio'];
				$email = $row['email'];
				$work = $row['work'];
				$dob = $row['dob'];
				$pnumber = $row['pnumber'];
			}
		}
?>
<!DOCTYPE html>
<html>
<head>
	<title><?php echo ucwords($name); ?> Profile</title>
	<link rel="stylesheet" type="text/css" href="../css/body.css">
</head>
<body onload="checkFrnd()">
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

	<div id="view-profile">
		<div class="section">
			<div class="view-profile-content">
				<div>
		            <div id="profilePic">
		                <img src="<?php echo $c_pic; ?>">
		            </div>
		            <div id="addBtn" class="cursor" frndrg="<?php echo $userid?>" frndrs="<?php echo $_SESSION['id']?>" onclick="addFrnd()">
	            		<img src="add.svg">
		            </div>
		            <h3>Full Name</h3>
		            <p class="profile-about-info"><?php echo strtoupper($name);?></p>
		            <h3>Contuct info</h3>
		            <p class="profile-about-info"><?php echo ($email);?></p>
		            <p class="profile-about-info"><?php echo ($pnumber);?></p>
		            <h3>Profession</h3>
		            <p class="profile-about-info"><?php echo ($work);?></p>
		            <h3>Date of Birth</h3>
		            <p class="profile-about-info"><?php echo ($dob);?></p>
		            <h3>About</h3>
		            <p class="profile-about-info"><?php echo ($bio);?></p>
		        </div>
			</div>
		</div>
		<div class="section">
			<div class="view-profile-content">
				<?php
				$sql = "SELECT u.us_id, s.name, u.price, u.details, c.name AS cname, u.u_id, usr.name AS username, usr.bio, usr.email, usr.work, usr.dob, usr.pnumber
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
						$name = $row['username'];	
						$sname = $row['name'];	
						$price = $row['price'];	
						$details = $row['details'];	
						$catagory = $row['cname'];	
						$u_id = $row['u_id'];
						$us_id = $row['us_id'];
				?>
				<div class="see-more-service cursor" data-uid="<?php echo $us_id ?>" onclick="browseUser(this)">
					<h1><?php echo $sname ?></h1>
					<div>
						<p class="sub-title de-active"></p>
						<p class="sub-title"><?php echo $catagory ?></p>
						<p class="sub-title">৳<?php echo $price ?></p>
					</div>
					<p><?php echo $details ?></p>
				</div>
<?php
			}
		}
?>		</div>
	</div>
</div>
<button class="btn" onclick="back()">Back</button>
<?php	
	} else {
		header('Location: ' . $_SERVER['HTTP_REFERER']);
	}

?>
	<script type="text/javascript" src="../js/script.js"></script>
</body>
</html>