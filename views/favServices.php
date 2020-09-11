<?php
    session_start();
    require_once('../db/db.php');
    include '../php/session.php';
?>
<!DOCTYPE html>
<html>

<head>
    <title>Favourite Services</title>
    <link rel="stylesheet" type="text/css" href="../css/work.css">
    <link rel="stylesheet" type="text/css" href="../css/body.css">
    <link rel="stylesheet" type="text/css" href="../css/adminNav.css">
    <link rel="stylesheet" type="text/css" href="../css/users.css">
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

    <table id="content" changeValue="5">
        <tr>
            <?php
                include 'sellerWork.html';
            ?>
            
            <td id="view">
                <h1 class="title">Favourite Services</h1>
                <table >
                    <tr>
                        <td>User Id</td>
                        <td>Service Id</td>
                    </tr>
                    <?php 
                        $conn = dbConnection();
                        if ($conn->connect_error) {
                          die("Connection failed: " . $conn->connect_error);
                        }
                        $sql = "select * from bookmark_service";
                        if (($result = $conn->query($sql)) !== FALSE){
                            while($row = $result->fetch_assoc()){
                                $id = $row['u_id'];
                                $us_id =  $row['us_id'];
                                echo "<tr data-id='{$us_id}' onclick='view(this)'>
                                        <td>{$id}</td>
                                        <td>{$us_id}</td>
                                    </tr>";
                            }
                        }
                        $conn->close();
                    ?>
                </table>
            </td>
        </tr>
    </table>
    <script type="text/javascript">
        var checkedValue = "";
        var flagCheckedValue = [];
        var serviceId = "";
        function fun4(){
            var inputElements = document.querySelectorAll('[name="selector"]');
            for(var i=0; inputElements[i]; ++i){
                  if(inputElements[i].checked){
                       var valu = inputElements[i].value;
                       flagCheckedValue.push(valu);
                  }
            }
            if(flagCheckedValue != ""){
                document.querySelector('table[changeValue]').setAttribute("changeValue", "4");
            } else {
                
            }
        }

    </script>
    <script type="text/javascript" src="../js/script.js"></script>
</body>

</html>