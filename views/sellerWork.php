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
                include 'sellerWork.html';
            ?>
            <td id="add">
                <h1 class="title">Add Service</h1>
                <form onsubmit="return validateMyForm()">
                <select name="catagory" onclick="sellerManagechange()">
                    <option value="none">Select</option>
                    <option value="Home">Home</option>
                    <option value="Hotel">Hotel</option>
                    <option value="Office">Office</option>
                </select>
                <input type="text" name="service" val="0" placeholder="Service Name" oninput="sellerAddSearchService()">
                <table id='seller-add-searched-service'>
                    <tbody>
                    </tbody>
                </table>
                <textarea type="text" name="details" value="" placeholder="Details"></textarea>
                <input type="text" name="price" placeholder="Price">
                </form>
                <div class="btn-inline">
                    <button class="Submit" onclick="sellerManagecreate()">Publish</button>
                    <button class="Submit" onclick="saveToDraft()">Draft</button>
                </div>

                <?php include 'sellerManage.html' ?>
            </td>
            <td id="view">
                <h1 class="title">Service list</h1>
                <table >
                    <tr>
                        <td>Name</td>
                        <td>Details</td>
                        <td>Price</td>
                        <td>Catagory TYPE</td>
                        <td>Select Service</td>
                    </tr>
                    <?php 
                        $conn = dbConnection();
                        if ($conn->connect_error) {
                          die("Connection failed: " . $conn->connect_error);
                        }
                        $us_id = $_SESSION['id'];
                        $sql = "SELECT us.us_id, s.name, us.details, us.price, c.name AS catagory from us_services us, services s, catagory c where us.s_id = s.s_id AND c.c_id = s.c_id AND us.u_id = '$us_id'";
                        if (($result = $conn->query($sql)) !== FALSE){
                            while($row = $result->fetch_assoc()){
                                $id = $row['us_id'];
                                $name =  $row['name'];
                                $details = $row['details'];
                                $price = $row['price'];
                                $c_id = $row['catagory'];
                                echo "<tr>
                                        <td>{$name}</td>
                                        <td>{$details}</td>
                                        <td>{$price}</td>
                                        <td>{$c_id}</td>
                                        <td><input type='checkbox' name='selector' value = '{$id}'></td>
                                    </tr>";
                            }
                        }
                        $conn->close();
                    ?>
                </table>
                <?php include 'sellerManage.html' ?>
            </td>
            <td id="edit">
                <h1 class="title">Edit Sevice</h1>
                <form onsubmit="return validateMyForm()">
                    <textarea type="text" name="details" value="" placeholder="Details"></textarea>
                    <input type="text" name="price" placeholder="Price">
                    <input class="Submit" type="button" name="submit" value="Confirm" onclick="sellerManageupdate()">
                </form>
                <?php include 'sellerManage.html' ?>
            </td>
            <td id="delete">
                <h1 class="title">Delete Sevice</h1>
                <input class="Submit" type="button" name="submit" value="Confirm" onclick="sellerManageDelete()">
                <?php include 'sellerManage.html' ?>
            </td>
        </tr>
    </table>

    <script type="text/javascript" src="../js/script.js"></script>
    <script type="text/javascript" src="../js/seller_script.js"></script>
    
</body>

</html>