<?php
    session_start();
    require_once('../db/db.php');
    include '../php/session.php';
?>
<!DOCTYPE html>
<html>

<head>
    <title>Favourite Services</title>
    
    <link rel="stylesheet" type="text/css" href="../css/body.css">
    <link rel="stylesheet" type="text/css" href="../css/adminNav.css">
    <link rel="stylesheet" type="text/css" href="../css/users.css">
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
                include 'sellerWork.html';
            ?>
            
            <td id="view">
                <h1 class="title">Favourite Services</h1>
                <table >
                    <tr>
                        <td>User Id</td>
                        <td>Service Id</td>
                        <td>Select</td>
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
                                $bs_id = $row['bs_id'];
                                echo "<tr>
                                        <td data-id='{$us_id}' onclick='view(this)'>{$id}</td>
                                        <td data-id='{$us_id}' onclick='view(this)'>{$us_id}</td>
                                        <td><input type='checkbox' name='selector' value = '{$bs_id}'></td>
                                    </tr>";
                            }
                        }
                        $conn->close();
                    ?>
                </table>
                <ul class="option">
                    <li><button onclick="fun5()">View</button></li>
                    <li><button onclick="fun4()">Delete</button></li>
                </ul>
            </td>

            <td id="delete">
                <h1 class="title">Delete users</h1>
                <input id="Submit" type="button" name="submit" value="Confirm" onclick="Delete()">
                <ul class="option">
                    <li><button onclick="fun5()">View</button></li>
                    <li><button onclick="fun4()">Delete</button></li>
                </ul>
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
        function fun5(){
            
            document.querySelector('table[changeValue]').setAttribute("changeValue", "5");
        }
        function Delete(){
            if(flagCheckedValue != null){
                for(var i = 0; i < flagCheckedValue.length; i++){
                    var xhttp = new XMLHttpRequest();
                    xhttp.open('POST', '../services/deleteBookmarkService.php', true);
                    xhttp.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');
                    xhttp.send('bs_id='+flagCheckedValue[i]);

                    xhttp.onreadystatechange = function (){
                        if(this.readyState == 4 && this.status == 200){

                            if(this.responseText == "delete"){
                                document.querySelector('table[changeValue]').setAttribute("changeValue", "5");
                                location.reload();
                            }
                        }   
                    }
                } 
            } else {
                
            }
        }

    </script>
    <script type="text/javascript" src="../js/script.js"></script>
</body>

</html>