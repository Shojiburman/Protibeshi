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

<body onload="filter()">
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

    <table id="content" uid="<?php echo $_SESSION['id'];?>">
        <tr>
            <?php
                include 'dealerWork.html';
            ?>
            <td id="view">
                <h1 class="title">Order list</h1>
                <div id="orderlistFilter">
                    <p>Filter by</p> 
                    <select name="selectFilter">
                        <option value="default">Default</option>
                        <option value="500">৳0-৳500</option>
                        <option value="1000">৳500-৳1000</option>
                        <option value="1001">৳1000-</option>
                    </select>
                    <button onclick="filter()">Save</button>
                </div>
          
                <table id="orderListTable">
                    <thead> 
                        <td>ID</td>
                        <td>Buyer</td>
                        <td>Service</td>
                        <td>Bill</td>  
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