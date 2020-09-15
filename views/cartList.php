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
                if($_SESSION['uType'] == '0'){
                    include 'sellerWork.html';
                } else if($_SESSION['uType'] == '1'){
                    include 'buyerWork.html';
                } else if($_SESSION['uType'] == '2'){
                    include 'dealerWork.html';
                } else if($_SESSION['uType'] == '3'){
                    include 'Work.html';
                }
            ?>
            <td id="view">
                <h1 class="title">Item list</h1>
                <table>
                    <tr>
                        <td>ID</td>
                        <td>Buyer</td>
                        <td>Service</td>
                        <td>Bill</td>
                        <td>Select Cart</td>
                    </tr>
                    <?php 
                        $conn = dbConnection();
                        if ($conn->connect_error) {
                          die("Connection failed: " . $conn->connect_error);
                        }
                        $userid = $_SESSION['id'];
                        $sql = "SELECT * from cart where u_id = '$userid'";
                        $i=1;
                        if (($result = $conn->query($sql)) !== FALSE){
                            while($row = $result->fetch_assoc()){
                                $cart_id = $row['cart_id'];
                                $u_id =  $row['u_id'];
                                $us_id = $row['us_id'];
                                $bill = $row['bill'];
                                $sql = "SELECT u.name, s.name AS sname 
                                        from users u, us_services us, services s 
                                        where u.u_id = us.u_id AND s.s_id = us.s_id AND us.us_id = '$us_id'";
                                if (($result1 = $conn->query($sql)) !== FALSE){
                                    while($row = $result1->fetch_assoc()){
                                        $name = $row['name'];
                                        $sname = $row['sname'];
                                    }
                                }
                                echo "<tr>
                                        <td>{$i}</td>
                                        <td>{$name}</td>
                                        <td>{$sname}</td>
                                        <td>{$bill}</td>
                                        <td><input type='checkbox' name='selector' bill = '{$bill}' value = '{$cart_id}'></td>
                                    </tr>";
                            $i++;
                            }
                            
                        }
                        $conn->close();
                    ?>
                </table>
                <?php include 'cartManage.html'; ?>
            </td>
            <td id="edit">
                <h1 class="title">Bill to Pay</h1>
                <form >
                    <input type="text" name="price" placeholder="Price">
                    <input type="text" name="coupon" placeholder="Coupon Name">
                    <input class="Submit" type="button" name="submit" value="Confirm" onclick="orderConfirm()">
                </form>
                <?php include 'cartManage.html' ?>
            </td>
        </tr>
    </table>
    </script>
    <script type="text/javascript" src="../js/script.js"></script>
</body>

</html>