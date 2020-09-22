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
                <h1 class="title">Add Sevice</h1>
                <form onsubmit="return validateMyForm()">
                <input type="text" name="name" placeholder="Service Name">
                <textarea type="text" name="details" value="" placeholder="Details"></textarea>
                <select name="catagory">
                    <?php 
                        $conn = dbConnection();
                        if ($conn->connect_error) {
                          die("Connection failed: " . $conn->connect_error);
                        }
                        $sql = "SELECT c_id,name FROM catagory";
                        if (($result = $conn->query($sql)) !== FALSE){
                        while($row = $result->fetch_assoc()){
                    ?>
                        <option value="<?php echo $row['c_id'];?>"><?php echo $row['name'];?></option>
                    <?php
                            }
                        }
                    ?>
                </select>
                <input class="Submit" type="button" name="submit" value="Create" onclick="createService()">
                </form>
                <?php include 'manage.html' ?>
            </td>
            <td id="view">
                <h1 class="title">Service list</h1>
                <table >
                    <tr>
                        <td>ID</td>
                        <td>Name</td>
                        <td>Details</td>
                        <td>Flag</td>
                        <td>Catagory TYPE</td>
                        <td>Select Service</td>
                    </tr>
                    <?php 
                        $conn = dbConnection();
                        if ($conn->connect_error) {
                          die("Connection failed: " . $conn->connect_error);
                        }
                        $sql = "select * from services";
                        if (($result = $conn->query($sql)) !== FALSE){
                            while($row = $result->fetch_assoc()){
                                $id = $row['s_id'];
                                $name =  $row['name'];
                                $details = $row['details'];
                                $flag = $row['flag'];
                                $c_id = $row['c_id'];
                                if($c_id == 1){
                                    $c_id = 'Home';
                                } elseif ($c_id == 2) {
                                    $c_id = 'Hotel';
                                } elseif ($c_id == 3) {
                                    $c_id = 'Office';
                                }
                                echo "<tr>
                                        <td>{$id}</td>
                                        <td>{$name}</td>
                                        <td>{$details}</td>
                                        <td>{$flag}</td>
                                        <td>{$c_id}</td>
                                        <td><input type='checkbox' name='selector' value = '{$id}'></td>
                                    </tr>";
                            }
                        }
                        $conn->close();
                    ?>
                </table>
                <?php include 'manage.html' ?>
            </td>
            <td id="edit">
                <h1 class="title">Edit Sevice</h1>
                <form onsubmit="return validateMyForm()">
                <input type="text" name="name" placeholder="Service Name">
                <textarea type="text" name="details" value="" placeholder="Details"></textarea>
                <select name="catagory">
                    <option value="0">Select</option>
                    <option value="1">Home</option>
                    <option value="2">Hotel</option>
                    <option value="3">Office</option>
                </select>
                <input class="Submit" type="button" name="submit" value="Update" onclick="updateService()">
                </form>
                <?php include 'manage.html' ?>
            </td>
            <td id="flag">
                <h1 class="title">Flag Sevice</h1>
                <form onsubmit="return validateMyForm()">
                    <input type="text" name="flag" placeholder="Flag Value">
                    <input class="Submit" type="button" name="submit" value="Confirm" onclick="flagedService()">
                </form>
                <?php include 'manage.html' ?>
            </td>
            <td id="delete">
                <h1 class="title">Delete Sevice</h1>
                <input class="Submit" type="button" name="submit" value="Confirm" onclick="deleteService()">
                <?php include 'manage.html' ?>
            </td>
        </tr>
    </table>
    <script type="text/javascript" src="../js/script.js"></script>
</body>

</html>