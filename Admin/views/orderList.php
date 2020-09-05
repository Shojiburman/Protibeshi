<?php
    session_start();
    require_once('../db/db.php');
    include '../php/session.php'; 
?>
<!DOCTYPE html>
<html>

<head>
    <title>Work</title>
    <link rel="stylesheet" type="text/css" href="../css/work.css">
    <link rel="stylesheet" type="text/css" href="../css/body.css">
    <link rel="stylesheet" type="text/css" href="../css/adminNav.css">
    <link rel="stylesheet" type="text/css" href="../css/orderList.css">
    <script type="text/javascript" src="../js/adminWork.js"></script>
</head>

<body>
    <?php
        include 'adminNav.html';
    ?>

    <table id="content" changeValue="5">
        <tr>
            <?php
                include 'work.html';
            ?>
            <td id="view">
                <h1 class="title">Order list</h1>
                <table>
                    <tr>
                        <td>ID</td>
                        <td>Buyer</td>
                        <td>Service</td>
                        <td>Bill</td>
                    </tr>
                    <?php 
                        $conn = dbConnection();
                        if ($conn->connect_error) {
                          die("Connection failed: " . $conn->connect_error);
                        }
                        $sql = "select * from cart";
                        if (($result = $conn->query($sql)) !== FALSE){
                            while($row = $result->fetch_assoc()){
                                $cart_id = $row['cart_id'];
                                $u_id =  $row['u_id'];
                                $us_id = $row['us_id'];
                                $bill = $row['bill'];
                                echo "<tr>
                                        <td>{$cart_id}</td>
                                        <td>{$u_id}</td>
                                        <td>{$us_id}</td>
                                        <td>{$bill}</td>
                                    </tr>";
                            }
                        }
                        $conn->close();
                    ?>
                </table>
            </td>
        </tr>
    </table>
    </script>
</body>

</html>