<?php
    session_start();
    require_once('../db/db.php');
    include '../php/session.php';
?>
<!DOCTYPE html>
<html>

<head>
    <title>Manage Users</title>
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
                <h1 class="title">Add users</h1>
                <form id="form" onsubmit="return validateMyForm()">
                <input type="text" name="name" placeholder="User Name">
                <input type="text" name="email" placeholder="User email">
                <input type="password" name="password" placeholder="User password">
                <select name="utype">
                    <option value="0">Select</option>
                    <option value="1">Seller</option>
                    <option value="2">Buyer</option>
                    <option value="3">Dealer</option>
                    <option value="4">Admin</option>
                </select>
                <input class="Submit" type="button" name="submit" value="Create" onclick="createUsers()">
                </form>
                <?php include 'manageUsers.html' ?>
            </td>
            <td id="view">
                <h1 class="title">Users list</h1>
                <table >
                    <tr>
                        <td>ID</td>
                        <td>Name</td>
                        <td>Email</td>
                        <td>User Type</td>
                        <td>Address</td>
                        <td>Phone Number</td>
                        <td>Flag</td>
                        <td>Select Service</td>
                    </tr>
                    <?php 
                        $conn = dbConnection();
                        if ($conn->connect_error) {
                          die("Connection failed: " . $conn->connect_error);
                        }
                        $sql = "select * from users";
                        if (($result = $conn->query($sql)) !== FALSE){
                            while($row = $result->fetch_assoc()){
                                $id = $row['u_id'];
                                $name =  $row['name'];
                                $email = $row['email'];
                                $admin = $row['admin'];
                                $address = $row['address'];
                                $pnumber = $row['pnumber'];
                                $flag = $row['flag'];
                                echo "<tr>
                                        <td>{$id}</td>
                                        <td>{$name}</td>
                                        <td>{$email}</td>
                                        <td>{$admin}</td>
                                        <td>{$address}</td>
                                        <td>{$pnumber}</td>
                                        <td>{$flag}</td>
                                        <td><input type='checkbox' name='selector' value = '{$id}'></td>
                                    </tr>";
                            }
                        }
                        $conn->close();
                    ?>
                </table>
                <?php include 'manageUsers.html' ?>
            </td>
            <td id="edit">
                <h1 class="title">Edit users</h1>
                <form onsubmit="return validateMyForm()">
                    <input type="text" name="name" placeholder="User Name">
                <input type="text" name="email" placeholder="User email">
                <input type="password" name="password" placeholder="User password">
                    <select name="utype">
                    <option value="0">Seller</option>
                    <option value="1">Buyer</option>
                    <option value="2">Dealer</option>
                    <option value="3">Admin</option>
                </select>
                    <input class="Submit" type="button" name="submit" value="Confirm" onclick="updateUsers()">
                </form>
                <?php include 'manageUsers.html' ?>
            </td>
            <td id="flag">
                <h1 class="title">Flag users</h1>
                <form onsubmit="return validateMyForm()">
                    <input type="text" name="flag" placeholder="Flag Value">
                    <input class="Submit" type="button" name="submit" value="Confirm" onclick="flagedUsers()">
                </form>
                <?php include 'manageUsers.html' ?>
            </td>
            <td id="delete">
                <h1 class="title">Delete users</h1>
                <input class="Submit" type="button" name="submit" value="Confirm" onclick="deleteUsers()">
                <?php include 'manageUsers.html' ?>
            </td>
        </tr>
    </table>

    <script type="text/javascript" src="../js/script.js"></script>
    
</body>

</html>