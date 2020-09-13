<?php
	session_start();
    include '../php/session.php';
    require_once('../db/db.php');
?>

<!DOCTYPE html>
<html>
<head>
	<title>View profile</title>
	<link rel="stylesheet" type="text/css" href="../css/body.css">
</head>
<body onload="viewDervices()">
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
    
	<div id="view-service-see-more"></div>

    <button class="btn" onclick="back()">Back</button>

    <script type="text/javascript" src="../js/script.js"></script>
</body>
</html>