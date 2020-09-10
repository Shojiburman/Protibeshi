<?php
    session_start();
    include '../php/session.php';
?>
<!DOCTYPE html>
<html>

<head>
    <title>Work</title>
    <link rel="stylesheet" type="text/css" href="../css/body.css">
    <link rel="stylesheet" type="text/css" href="../css/adminNav.css">
    <link rel="stylesheet" type="text/css" href="../css/work.css">
    <script type="text/javascript" src="../js/script.js"></script>
    <style>
        ul {
            list-style: none;
            padding-left: 0;
        }
        ul li {
            display: block;
            width: 70%;
            padding: 10px;
            margin: 0px auto;
        }
        ul li a {
            display: block;
            text-align: center;
        }
        a {
            color: black;
            text-decoration: none;
        }
        img {
            width: 150px;
            height: auto;
        }
    </style>
</head>

<body>
    <?php
        if(isset($_SESSION['id']) || isset($_COOKIE['remember'])){
            if($c_type == '0'){
                include '../views/sellerNav.html';
            } else if($c_type == '1'){
                include '../views/buyerNav.html';
            } else if($c_type == '2'){
                include '../views/dealerNav.html';
            } else if($c_type == '3'){
                include '../views/adminNav.html';
            }
            
        } else {
            include '../views/nav.html';
        }
    ?>

    <table align="center">
        <tr>
            <?php
                include 'work.html';
            ?>
            <td width="800px" height="600px" style="background-color: #f3f5f7">
                <h3 style="font-family: Roboto; margin: 20px 10px 20px 10px; color: #0aab8e" align="center">COMMENT & RATING</h3>                 
            </td>
        </tr>
    </table>
</body>

</html>