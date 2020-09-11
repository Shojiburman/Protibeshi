<?php
	session_start();
?>

<!DOCTYPE html>
<html>
<head>
	<title>About</title>
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
	<p id="about-text">This website is an online service marketplace. Here you can find home services and the service provider will be your neighbor. Make your life more convenient and hassle-free.</p>
	<script type="text/javascript" src="../js/script.js"></script>
</body>
</html>