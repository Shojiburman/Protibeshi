<?php
    session_start();
    require_once '../php/session.php';

?>
<!DOCTYPE html>
<html>

<head>
    <title>Change Password</title>
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

    <div id="profile-section">
        <div class="section">
            <div>
                <div id="profilePic">
                    <img src="<?php echo $c_pic; ?>">
                </div>
                <a id="editBtn" href="changeProfilePic.php"><img src="edit.svg"></a>
                <p id="name"><?php echo strtoupper($c_name);?></p>
                <p><?php echo ($c_email);?></p>
                <button class="btn" onclick="ChangeclickProfile()">Edit Profile</button>
            </div>
        </div>

        <div class="section">
            <div>
                <h3>Change Password</h3>
                <form onsubmit="return validateMyForm()">
                    <input type="hidden" name="u_id" value="<?php echo $_SESSION['id']; ?>">
                    <input type="password" name="pass" value="" placeholder="Password" oninput="Pass()">
                    <p id="passMsg"></p>
                    <input type="password" name="npass" value="" placeholder="New Password" oninput="nPass()">
                    <p id="npassMsg"></p>
                    <input type="password" name="cpass" value="" placeholder="Confirm Password" oninput="cPass()">
                    <p id="cpassMsg"></p>
                    <input class="btn" type="button" name="submit" value="SAVE" onclick="changePass()">
                </form>
                <p id="msg"></p>
            </div>
        </div>
    </div>
    <script type="text/javascript" src="../js/script.js"></script>
</body>

</html>