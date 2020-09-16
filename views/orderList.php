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

<body onload="filter()" onload="sort()">
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
                <h1 class="title">Transaction List</h1>
                <div id="orderlistFilter">
                    <p>Filter by</p> 
                    <select name="selectFilter" onchange="filter()">
                        <option value="default">Default</option>
                        <option value="500">৳0-৳500</option>
                        <option value="1000">৳500-৳1000</option>
                        <option value="1001">৳1000-</option>
                    </select>
                    <p>Sort by</p> 
                    <select name="selectSort" onchange="sort()">
                        <option value="default">Default</option>
                        <option value="HL">Highest - Lowest</option>
                        <option value="LH">Lowest - Highest</option>
                    </select>
                </div>
          
                <table id="orderListTable">
                    <thead> 
                        <td>Transaction ID</td>
                        <td>BUYER ID</td>
                        <td>Transaction Bill</td>  
                    </thead>
                    <tbody>
                        
                    </tbody>
                </table>
            </td>
        </tr>
    </table>
    </script>
    <script type="text/javascript" src="../js/script.js"></script>
</body>

</html>