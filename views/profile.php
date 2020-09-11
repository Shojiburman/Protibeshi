<?php
    session_start();
    require_once '../php/session.php';
?>
<!DOCTYPE html>
<html>
<head>
    <title>Profile</title>
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
                <button class="btn" onclick="Changeclick()">Change Password</button>
            </div>
        </div>

        <div class="section">
            <div>
                <h3>EDIT PROFILE</h3>
                <form onsubmit="return validateMyForm()">
                    <input type="hidden" name="id" value="<?php echo $_SESSION['id'] ?>" placeholder="Name">
                    <input type="text" name="name" value="<?php echo $c_name ?>" placeholder="Name">
                    <input type="text" name="email" value="<?php echo $c_email ?>" placeholder="Email">
                    <input type="text" name="work" value="<?php echo $c_work ?>" placeholder="Work">
                    <input type="text" name="pnumber" value="<?php echo $c_pnumber ?>" placeholder="Contact Number">
                    <input type="text" name="address" value="<?php echo $c_address ?>" placeholder="Address">
                    <input type="date" name="dob" value="<?php echo $c_dob ?>" placeholder="Birthdate">
                    <textarea type="text" name="bio" value="" placeholder="Bio"><?php echo $c_bio ?></textarea>
                    <input class="btn" type="button" name="submit" value="SAVE" onclick="updateProfile()">
                </form>
                <p id="msg"></p>
            </div>
        </div>
    </div>
    <script type="text/javascript">
        
    </script>
    <script type="text/javascript" src="../js/script.js"></script>
</body>

</html>