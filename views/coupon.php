<?php
    session_start();
    require_once('../db/db.php');
    include '../php/session.php'; 
?>
<!DOCTYPE html>
<html>

<head>
    <title>Work</title>
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

    <table id="content" changeValue="5">
        <tr>
            <?php
                include 'work.html';
            ?>
            <td id="add">
                <h1 class="title">Add coupon</h1>
                <form id="form">
                <input type="text" name="name" placeholder="Coupon Name">
                <input type="text" name="percentage" placeholder="Percentage">
                <input type="date" name="expiredate">
                <input class="Submit" type="button" name="submit" value="Create" onclick="COUcreate()">
                </form>
                <?php include 'manageCoupon.html' ?>
            </td>
            <td id="view">
                <h1 class="title">Coupon list</h1>
                <table >
                    <tr>
                        <td>ID</td>
                        <td>Name</td>
                        <td>percentage</td>
                        <td>expiredate</td>
                        <td>Select Service</td>
                    </tr>
                    <?php 
                        $conn = dbConnection();
                        if ($conn->connect_error) {
                          die("Connection failed: " . $conn->connect_error);
                        }
                        $sql = "select * from coupon";
                        if (($result = $conn->query($sql)) !== FALSE){
                            while($row = $result->fetch_assoc()){
                                $coupon_id = $row['coupon_id'];
                                $name =  $row['name'];
                                $percentage = $row['percentage'];
                                $expiredate = $row['expiredate'];
                                echo "<tr>
                                        <td>{$coupon_id}</td>
                                        <td>{$name}</td>
                                        <td>{$percentage}</td>
                                        <td>{$expiredate}</td>
                                        <td><input type='checkbox' name='selector' value = '{$coupon_id}'></td>
                                    </tr>";
                            }
                        }
                        $conn->close();
                    ?>
                </table>
                <?php include 'manageCoupon.html' ?>
            </td>
            <td id="edit">
                <h1 class="title">Edit coupon</h1>
                <form >
                    <input type="text" name="name" placeholder="Coupon Name">
                    <input type="text" name="percentage" placeholder="Percentage">
                    <input type="date" name="expiredate">
                    <input class="Submit" type="button" name="submit" value="Confirm" onclick="COUupdate()">
                </form>
                <?php include 'manageCoupon.html' ?>
            </td>
            <td id="delete">
                <h1 class="title">Delete coupon</h1>
                <input class="Submit" type="button" name="submit" value="Confirm" onclick="COUDelete()">
                <?php include 'manageCoupon.html' ?>
            </td>
        </tr>
    </table>
    <script type="text/javascript" src="../js/script.js"></script>
</body>

</html>