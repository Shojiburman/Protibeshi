<?php
    session_start();
    require_once('../db/db.php');
    include '../php/session.php'; 
?>
<!DOCTYPE html>
<html>

<head>
    <title>Manage FAQs</title>
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
                <h1 class="title">Add FAQs</h1>
                <form id="form">
                <input type="text" name="name" placeholder="FAQs Name">
                <textarea type="text" name="ans" value="" placeholder="Details"></textarea>
                <input type="date" name="date">
                <input class="Submit" type="button" name="submit" value="Create" onclick="FAQcreate()">
                </form>
                <?php include 'manageFAQ.html' ?>
            </td>
            <td id="view">
                <h1 class="title">FAQs list</h1>
                <table>
                    <tr>
                        <td>ID</td>
                        <td>Name</td>
                        <td>Answer</td>
                        <td>Date</td>
                        <td>Flag</td>
                        <td>Select Coupon</td>
                    </tr>
                    <?php 
                        $conn = dbConnection();
                        if ($conn->connect_error) {
                          die("Connection failed: " . $conn->connect_error);
                        }
                        $sql = "select * from faq";
                        if (($result = $conn->query($sql)) !== FALSE){
                            while($row = $result->fetch_assoc()){
                                $id = $row['f_id'];
                                $name =  $row['name'];
                                $ans = $row['ans'];
                                $date = $row['date'];
                                $flag = $row['flag'];
                                echo "<tr>
                                        <td>{$id}</td>
                                        <td>{$name}</td>
                                        <td>{$ans}</td>
                                        <td>{$date}</td>
                                        <td>{$flag}</td>
                                        <td><input type='checkbox' name='selector' value = '{$id}'></td>
                                    </tr>";
                            }
                        }
                        $conn->close();
                    ?>
                </table>
                <?php include 'manageFAQ.html' ?>
            </td>
            <td id="edit">
                <h1 class="title">Edit FAQs</h1>
                <form >
                    <input type="text" name="name" placeholder="Service Name">
                    <textarea type="text" name="ans" value="" placeholder="Details"></textarea>
                    <input type="Date" name="date">
                    <input class="Submit" type="button" name="submit" value="Confirm" onclick="FAQupdate()">
                </form>
                <?php include 'manageFAQ.html' ?>
            </td>
            <td id="flag">
                <h1 class="title">Flag FAQs</h1>
                <form onsubmit="return validateMyForm()">
                    <input type="text" name="flag" placeholder="Flag Value">
                    <input class="Submit" type="button" name="submit" value="Confirm" onclick="FAQflaged()">
                </form>
                <?php include 'manageFAQ.html' ?>
            </td>
            <td id="delete">
                <h1 class="title">Delete FAQs</h1>
                <input class="Submit" type="button" name="submit" value="Confirm" onclick="FAQDelete()">
                <?php include 'manageFAQ.html' ?>
            </td>
        </tr>
    </table>
    <script type="text/javascript" src="../js/script.js"></script>
</body>

</html>