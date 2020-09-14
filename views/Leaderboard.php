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
                <p>Filter by</p> 
                <select name="selectFilter" onchange="filter()">
                    <option value="default">All</option>
                    <option value="500">Seller</option>
                    <option value="1000">Dealer</option>
                </select>
                <table id="leaderboardTable">
                    <thead> 
                        <td>SL.NO</td>
                        <td>Name</td>
                        <td>Bio</td>
                        <td>Income</td>
                        <td>Role</td>
                    </thead>
                    <tbody>
                        
                    </tbody>
                </table>
            </td>
        </tr>
    </table>
    <script type="text/javascript" src="../js/script.js"></script>
</body>

</html>

$sql = "SELECT usr.name, usr.bio, l.income, usr.admin
                                FROM leaderboard l
                                INNER JOIN users usr
                                ON l.u_id = usr.u_id ORDER BY l.income DESC";