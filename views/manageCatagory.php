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
                <h1 class="title">Add Catagory</h1>
                <form onsubmit="return validateMyForm()">
                <input type="text" name="name" placeholder="Catagory Name">
                <textarea type="text" name="details" value="" placeholder="Details"></textarea>
                <input class="Submit" type="button" name="submit" value="Create" onclick="createCatagory()">
                </form>
                <?php include 'manageCatagory.html' ?>
            </td>
            <td id="view">
                <h1 class="title">Catagory list</h1>
                <table >
                    <tr>
                        <td>ID</td>
                        <td>Name</td>
                        <td>Details</td>
                        <td>Flag</td>
                        <td>Select Service</td>
                    </tr>
                    <?php 
                        $conn = dbConnection();
                        if ($conn->connect_error) {
                          die("Connection failed: " . $conn->connect_error);
                        }
                        $sql = "select * from catagory";
                        if (($result = $conn->query($sql)) !== FALSE){
                            while($row = $result->fetch_assoc()){
                                $id = $row['c_id'];
                                $name =  $row['name'];
                                $details = $row['details'];
                                $flag = $row['flag'];
                                echo "<tr>
                                        <td>{$id}</td>
                                        <td>{$name}</td>
                                        <td>{$details}</td>
                                        <td>{$flag}</td>
                                        <td><input type='checkbox' name='selector' value = '{$id}'></td>
                                    </tr>";
                            }
                        }
                        $conn->close();
                    ?>
                </table>
                <?php include 'manageCatagory.html' ?>
            </td>
            <td id="edit">
                <h1 class="title">Edit Catagory</h1>
                <form onsubmit="return validateMyForm()">
                <input type="text" name="name" placeholder="Service Name">
                <textarea type="text" name="details" value="" placeholder="Details"></textarea>
                <input class="Submit" type="button" name="submit" value="Update" onclick="updateCatagory()">
                </form>
                <?php include 'manageCatagory.html' ?>
            </td>
            <td id="flag">
                <h1 class="title">Flag Catagory</h1>
                <form onsubmit="return validateMyForm()">
                    <input type="text" name="flag" placeholder="Flag Value">
                    <input class="Submit" type="button" name="submit" value="Confirm" onclick="flagedCatagory()">
                </form>
                <?php include 'manageCatagory.html' ?>
            </td>
            <td id="delete">
                <h1 class="title">Delete Catagory</h1>
                <input class="Submit" type="button" name="submit" value="Confirm" onclick="deleteCatagory()">
                <?php include 'manageCatagory.html' ?>
            </td>
        </tr>
    </table>
    <script type="text/javascript" src="../js/script.js"></script>
</body>

</html>