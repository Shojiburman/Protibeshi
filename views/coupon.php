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
    <link rel="stylesheet" type="text/css" href="../css/coupon.css">
    <script type="text/javascript" src="../js/script.js"></script>
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
            <td id="add">
                <h1 class="title">Add coupon</h1>
                <form id="form">
                <input type="text" name="name" placeholder="Coupon Name">
                <input type="text" name="percentage" placeholder="Percentage">
                <input type="date" name="expiredate">
                <input id="Submit" type="button" name="submit" value="Create" onclick="create()">
                </form>
                <?php include 'manage.html' ?>
            </td>
            <td id="view">
                <h1 class="title">Coupon list</h1>
                <table >
                    <tr>
                        <td>ID</td>
                        <td>Name</td>
                        <td>percentage</td>
                        <td>expiredate</td>
                        <td>Select Service</td>
                    </tr>
                    <?php 
                        $conn = dbConnection();
                        if ($conn->connect_error) {
                          die("Connection failed: " . $conn->connect_error);
                        }
                        $sql = "select * from coupon";
                        if (($result = $conn->query($sql)) !== FALSE){
                            while($row = $result->fetch_assoc()){
                                $coupon_id = $row['coupon_id'];
                                $name =  $row['name'];
                                $percentage = $row['percentage'];
                                $expiredate = $row['expiredate'];
                                echo "<tr>
                                        <td>{$coupon_id}</td>
                                        <td>{$name}</td>
                                        <td>{$percentage}</td>
                                        <td>{$expiredate}</td>
                                        <td><input type='checkbox' name='selector' value = '{$coupon_id}'></td>
                                    </tr>";
                            }
                        }
                        $conn->close();
                    ?>
                </table>
                <?php include 'manage.html' ?>
            </td>
            <td id="edit">
                <h1 class="title">Edit coupon</h1>
                <form >
                    <input type="text" name="name" placeholder="Coupon Name">
                    <input type="text" name="percentage" placeholder="Percentage">
                    <input type="date" name="expiredate">
                    <input id="Submit" type="button" name="submit" value="Confirm" onclick="update()">
                </form>
                <?php include 'manage.html' ?>
            </td>
            <td id="delete">
                <h1 class="title">Delete coupon</h1>
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
                xhttp.open('POST', '../services/getEditCoupon.php', true);
                xhttp.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');
                xhttp.send('coupon_id='+checkedValue);

                xhttp.onreadystatechange = function (){
                    if(this.readyState == 4 && this.status == 200){
                        if(this.responseText != ""){
                            var val = this.responseText.split("|");
                            serviceId = val[0];
                            document.querySelector('#edit>form [name="name"]').value = val[1];
                            document.querySelector('#edit>form [name="percentage"]').value = val[2];
                            document.querySelector('#edit>form [name="expiredate"]').value = val[3];
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
            var percentage = document.querySelector('#add [name="percentage"]').value;
            var expiredate = document.querySelector('#add [name="expiredate"]').value;
            if((name != '') && (percentage != '') && (expiredate != '')){
                var xhttp = new XMLHttpRequest();
                xhttp.open('POST', '../services/insertCoupon.php', true);
                xhttp.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');
                xhttp.send('name='+name+'&percentage='+percentage+'&expiredate='+expiredate);
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
                    xhttp.open('POST', '../services/deleteCoupon.php', true);
                    xhttp.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');
                    xhttp.send('coupon_id='+flagCheckedValue[i]);

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
            var coupon_id = serviceId;
            var name = document.querySelector('#edit>form [name="name"]').value;
            var percentage = document.querySelector('#edit>form [name="percentage"]').value;
            var expiredate = document.querySelector('#edit>form [name="expiredate"]').value;

            if((name != '') && (percentage != '') && (expiredate != '') && (coupon_id != '')){
                var xhttp = new XMLHttpRequest();
                xhttp.open('POST', '../services/updateCoupon.php', true);
                xhttp.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');
                xhttp.send('coupon_id='+coupon_id+'&name='+name+'&percentage='+percentage+'&expiredate='+expiredate);
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
    </script>
</body>

</html>