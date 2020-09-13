<?php
    session_start();
    require_once('../db/db.php');
    include '../php/session.php';
?>
<!DOCTYPE html>
<html>

<head>
    <title>Leaderboard</title>
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
                include 'dealerWork.html';
            ?>
            <td id="view">
                <h1 class="title">Leaderboard</h1>
                <table >
                    <tr>
                        <td>SL.NO</td>
                        <td>Name</td>
                        <td>Bio</td>
                        <td>Income</td>
                        <td>Role</td>
                    </tr>
                    <?php 
                        $conn = dbConnection();
                        if ($conn->connect_error) {
                          die("Connection failed: " . $conn->connect_error);
                        }
                        $sql = "SELECT usr.name, usr.bio, l.income, usr.admin
					            FROM leaderboard l
					            INNER JOIN users usr
					            ON l.u_id = usr.u_id ORDER BY l.income DESC";
					    $i = 1;
                        if (($result = $conn->query($sql)) !== FALSE){
                            while($row = $result->fetch_assoc()){
                                $id = $i;
                                $name =  $row['name'];
                                $Bio = $row['bio'];
                                $Income = $row['income'];
                                $Role = $row['admin'];
                                if($Role == '0'){
                                	$Role = 'Seller';
                                } else if ('2'){
                                	$Role = 'Dealer';
                                }
                                echo "<tr>
                                        <td>{$id}</td>
                                        <td>{$name}</td>
                                        <td>{$Bio}</td>
                                        <td>{$Income}</td>
                                        <td>{$Role}</td>
                                    </tr>";
                                $i++;
                            }
                        }
                        $conn->close();
                    ?>
                </table>
            </td>
        </tr>
    </table>
    <script type="text/javascript" src="../js/script.js"></script>
</body>

</html>