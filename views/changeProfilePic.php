<?php
    session_start();
    $conn = mysqli_connect('127.0.0.1', 'root', '', 'protibeshi');

    require_once '../php/session.php';
    if ($conn->connect_error) {
      die("Connection failed: " . $conn->connect_error);
    }
    include 'upload.php';
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
                <p id="name"><?php echo strtoupper($c_name);?></p>
                <p><?php echo ($c_email);?></p>
                <button class="btn" onclick="editProfileclick()">Edit profile</button>
            </div>
        </div>

        <div class="section">
            <div>
                <h3>CHANGE PROFILE PICTURE</h3>
                <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"])?>" method="post" enctype="multipart/form-data">
                    <input type="file" name="fileToUpload" value="">
                    <input class="btn" type="submit" name="submit" value="CHANGE">
                    <?php
                        if (isset($uploadMsgErr)) {
                            echo "<br/><span style='color: red; font-size: 14px'>* " . $uploadMsgErr . "</span>";
                        }
                        if (isset($uploadMsgSuccess)) {
                            echo "<br/><span style='color: green; font-size: 14px'>* " . $uploadMsgSuccess . "</span>";
                        }
                    ?>
                </form>
                <p id="msg"></p>
            </div>
        </div>
    </div>
    <script type="text/javascript">
        function editProfileclick(){
            location.assign('profile.php');
        }
    </script>
    <script type="text/javascript" src="../js/script.js"></script>
</body>

</html>