<?php
    session_start();
    require_once('../db/db.php');
    include '../php/session.php';
?>
<!DOCTYPE html>
<html>

<head>
    <title>Manage Users</title>
    <link rel="stylesheet" type="text/css" href="../css/work.css">
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
                <input id="Submit" type="button" name="submit" value="Create" onclick="create()">
                </form>
                <?php include 'manage.html' ?>
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
                <?php include 'manage.html' ?>
            </td>
            <td id="edit">
                <h1 class="title">Edit users</h1>
                <form onsubmit="return validateMyForm()">
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
                    <input id="Submit" type="button" name="submit" value="Confirm" onclick="update()">
                </form>
                <?php include 'manage.html' ?>
            </td>
            <td id="flag">
                <h1 class="title">Flag users</h1>
                <form onsubmit="return validateMyForm()">
                    <input type="text" name="flag" placeholder="Flag Value">
                    <input id="Submit" type="button" name="submit" value="Confirm" onclick="flaged()">
                </form>
                <?php include 'manage.html' ?>
            </td>
            <td id="delete">
                <h1 class="title">Delete users</h1>
                <input id="Submit" type="button" name="submit" value="Confirm" onclick="Delete()">
                <?php include 'manage.html' ?>
            </td>
        </tr>
    </table>
    <script type="text/javascript">
        var checkedValue = "";
        var flagCheckedValue = [];
        var serviceId = "";
        function fun1(){
            document.querySelector('table[changeValue]').setAttribute("changeValue", "1");
        }
        function fun2(){
            var inputElements = document.querySelectorAll('[name="selector"]');
            for(var i=0; inputElements[i]; ++i){
                  if(inputElements[i].checked){
                       checkedValue = inputElements[i].value;
                       break;
                  }
            }
            if(checkedValue != null){
                var xhttp = new XMLHttpRequest();
                xhttp.open('POST', '../services/getEditUser.php', true);
                xhttp.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');
                xhttp.send('u_id='+checkedValue);

                xhttp.onreadystatechange = function (){
                    if(this.readyState == 4 && this.status == 200){
                        if(this.responseText != ""){
                            var val = this.responseText.split("|");
                            serviceId = val[0];
                            document.querySelector('#edit>form [name="name"]').value = val[1];
                            document.querySelector('#edit>form [name="email"]').value = val[2];
                            document.querySelector('#edit>form [name="password"]').value = val[3];
                            document.querySelector('#edit>form [name="utype"]').selectedIndex = val[4]+1;
                            document.querySelector('table[changeValue]').setAttribute("changeValue", "2");
                        } else {
                            
                        }
                    }   
                }
            } else {
                document.querySelector('table[changeValue]').setAttribute("changeValue", "5");
            }
        }
        function fun3(){
            var inputElements = document.querySelectorAll('[name="selector"]');
            for(var i=0; inputElements[i]; ++i){
              if(inputElements[i].checked){
                   var valu = inputElements[i].value;
                   flagCheckedValue.push(valu);
              }
            } 
            if(flagCheckedValue != ""){
                document.querySelector('table[changeValue]').setAttribute("changeValue", "3");
            } else {
                
            }
        }
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

        function create(){
            var name = document.querySelector('#add [name="name"]').value;
            var email = document.querySelector('#add [name="email"]').value;
            var password = document.querySelector('#add [name="password"]').value;
            var utype = document.querySelector('#add [name="utype"]').value;
            if((name != '') && (email != '') && (password != '') && (utype != '')){
                var xhttp = new XMLHttpRequest();
                xhttp.open('POST', '../services/insertUser.php', true);
                xhttp.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');
                xhttp.send('name='+name+'&email='+email+'&password='+password+'&utype='+utype);
                xhttp.onreadystatechange = function (){
                    if(this.readyState == 4 && this.status == 200){
                        var res = this.responseText;
                        if(res == 'insert'){
                            document.querySelector('#form').reset();
                        } else {
                        }
                    }   
                }
            }
        }

        function Delete(){
            if(flagCheckedValue != null){
                for(var i = 0; i < flagCheckedValue.length; i++){
                    var xhttp = new XMLHttpRequest();
                    xhttp.open('POST', '../services/deleteUser.php', true);
                    xhttp.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');
                    xhttp.send('u_id='+flagCheckedValue[i]);

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

        function update(){
            var u_id = serviceId;
            var name = document.querySelector('#edit>form [name="name"]').value;
            var email = document.querySelector('#edit>form [name="email"]').value;
            var password = document.querySelector('#edit>form [name="password"]').value;
            var utype = document.querySelector('#edit>form [name="utype"]').value;

            if((name != '') && (email != '') && (password != '') && (utype != '') && (u_id != '')){
                var xhttp = new XMLHttpRequest();
                xhttp.open('POST', '../services/updateUser.php', true);
                xhttp.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');
                xhttp.send('u_id='+u_id+'&name='+name+'&email='+email+'&password='+password+'&utype='+utype);
                xhttp.onreadystatechange = function (){
                    if(this.readyState == 4 && this.status == 200){
                        var res = this.responseText;
                        if(res == 'update'){
                            document.querySelector('#edit>form').reset();
                            document.querySelector('table[changeValue]').setAttribute("changeValue", "5");
                            location.reload();
                        } else {
                        }
                    }   
                }
            }
        }

        function flaged(){
            var flag = document.querySelector('#flag>form [name="flag"]').value;
            console.log(flag);
            for(var i = 0; i < flagCheckedValue.length; i++){
                var u_id = flagCheckedValue[i];
                if((flag != '') && (u_id != '')){
                    var xhttp = new XMLHttpRequest();
                    xhttp.open('POST', '../services/flagUser.php', true);
                    xhttp.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');
                    xhttp.send('u_id='+u_id+'&flag='+flag);
                    xhttp.onreadystatechange = function (){
                        if(this.readyState == 4 && this.status == 200){
                            var res = this.responseText;
                            if(res == 'flaged'){
                                document.querySelector('#flag>form').reset();
                                document.querySelector('table[changeValue]').setAttribute("changeValue", "5");
                                location.reload();
                            } else {
                            }
                        }   
                    }
                }
            } 
        }
    </script>
    <script type="text/javascript" src="../js/script.js"></script>
</body>

</html>