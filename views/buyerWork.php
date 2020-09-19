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
                include 'buyerWork.html';
            ?>
            <td id="add">
                <h1 class="title">Add Sevice</h1>
                <form id="form" onsubmit="return validateMyForm()">
                <input type="text" name="name" placeholder="Service Name">
                <textarea type="text" name="details" value="" placeholder="Details"></textarea>
                <input type="text" name="price" placeholder="Price">
                <select name="catagory">
                    <option value="0">Select</option>
                    <option value="1">Home</option>
                    <option value="2">Hotel</option>
                    <option value="3">Office</option>
                </select>
                <input id="Submit" type="button" name="submit" value="Create" onclick="create()">
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
                <form >
                    <input type="text" name="name" placeholder="Service Name">
                    <textarea type="text" name="details" value="" placeholder="Details"></textarea>
                    <input type="text" name="price" placeholder="Price">
                    <select name="catagory">
                        <option value="0">Select</option>
                        <option value="1">Home</option>
                        <option value="2">Hotel</option>
                        <option value="3">Office</option>
                    </select>
                    <input id="Submit" type="button" name="submit" value="Confirm" onclick="update()">
                </form>
                <?php include 'manage.html' ?>
            </td>
            <td id="flag">
                <h1 class="title">Flag Sevice</h1>
                <form onsubmit="return validateMyForm()">
                    <input type="text" name="flag" placeholder="Flag Value">
                    <input id="Submit" type="button" name="submit" value="Confirm" onclick="flaged()">
                </form>
                <?php include 'manage.html' ?>
            </td>
            <td id="delete">
                <h1 class="title">Delete Sevice</h1>
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
                xhttp.open('POST', '../services/getEditService.php', true);
                xhttp.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');
                xhttp.send('s_id='+checkedValue);

                xhttp.onreadystatechange = function (){
                    if(this.readyState == 4 && this.status == 200){
                        if(this.responseText != ""){
                            var val = this.responseText.split("|");
                            serviceId = val[0];
                            document.querySelector('#edit>form [name="name"]').value = val[1];
                            document.querySelector('#edit>form [name="details"]').value = val[2];
                            document.querySelector('#edit>form [name="price"]').value = val[3];
                            document.querySelector('#edit>form [name="catagory"]').selectedIndex = val[4]+1;
                            document.querySelector('table[changeValue]').setAttribute("changeValue", "2");
                        } else {
                            location.reload();
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
                location.reload();
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
                location.reload();
            }
        }
        function fun5(){
            location.reload();
            document.querySelector('table[changeValue]').setAttribute("changeValue", "5");
        }

        function create(){
            var name = document.querySelector('#add [name="name"]').value;
            var details = document.querySelector('#add [name="details"]').value;
            var price = document.querySelector('#add [name="price"]').value;
            var c_id = document.querySelector('#add [name="catagory"]').value;
            if((name != '') && (details != '') && (price != '') && (c_id != '')){
                var xhttp = new XMLHttpRequest();
                xhttp.open('POST', '../services/insertService.php', true);
                xhttp.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');
                xhttp.send('name='+name+'&details='+details+'&price='+price+'&catagory='+c_id);
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
                    xhttp.open('POST', '../services/deleteService.php', true);
                    xhttp.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');
                    xhttp.send('s_id='+flagCheckedValue[i]);

                    xhttp.onreadystatechange = function (){
                        if(this.readyState == 4 && this.status == 200){

                            if(this.responseText == "delete"){
                            }
                        }   
                    }
                } location.reload();
            } else {
                location.reload();
            }
        }

        function update(){
            var s_id = serviceId;
            var name = document.querySelector('#edit>form [name="name"]').value;
            var details = document.querySelector('#edit>form [name="details"]').value;
            var price = document.querySelector('#edit>form [name="price"]').value;
            var c_id = document.querySelector('#edit>form [name="catagory"]').value;

            if((name != '') && (details != '') && (price != '') && (c_id != '') && (c_id != '')){
                var xhttp = new XMLHttpRequest();
                xhttp.open('POST', '../services/updateService.php', true);
                xhttp.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');
                xhttp.send('s_id='+s_id+'&name='+name+'&details='+details+'&price='+price+'&catagory='+c_id);
                xhttp.onreadystatechange = function (){
                    if(this.readyState == 4 && this.status == 200){
                        var res = this.responseText;
                        if(res == 'update'){
                            document.querySelector('#edit>form').reset();
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
                var s_id = flagCheckedValue[i];
                console.log(s_id);
                if((flag != '') && (s_id != '')){
                    var xhttp = new XMLHttpRequest();
                    xhttp.open('POST', '../services/flagService.php', true);
                    xhttp.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');
                    xhttp.send('s_id='+s_id+'&flag='+flag);
                    xhttp.onreadystatechange = function (){
                        if(this.readyState == 4 && this.status == 200){
                            var res = this.responseText;
                            if(res == 'flaged'){
                                document.querySelector('#flag>form').reset();
                            } else {
                            }
                        }   
                    }
                }
            } location.reload();
        }
    </script>
    <script type="text/javascript" src="../js/script.js"></script>
</body>

</html>