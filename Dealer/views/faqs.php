<?php
    session_start();
    require_once('../db/db.php');
    include '../php/session.php'; 
?>
<!DOCTYPE html>
<html>

<head>
    <title>Manage FAQs</title>
    <link rel="stylesheet" type="text/css" href="../css/work.css">
    <link rel="stylesheet" type="text/css" href="../css/body.css">
    <link rel="stylesheet" type="text/css" href="../css/adminNav.css">
    <link rel="stylesheet" type="text/css" href="../css/faqs.css">
    <script type="text/javascript" src="../js/adminWork.js"></script>
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
                <h1 class="title">Add FAQs</h1>
                <form id="form">
                <input type="text" name="name" placeholder="FAQs Name">
                <textarea type="text" name="ans" value="" placeholder="Details"></textarea>
                <input type="date" name="date">
                <input id="Submit" type="button" name="submit" value="Create" onclick="create()">
                </form>
                <?php include 'manage.html' ?>
            </td>
            <td id="view">
                <h1 class="title">FAQs list</h1>
                <table>
                    <tr>
                        <td>ID</td>
                        <td>Name</td>
                        <td>Answer</td>
                        <td>Date</td>
                        <td>Flag</td>
                        <td>Select Coupon</td>
                    </tr>
                    <?php 
                        $conn = dbConnection();
                        if ($conn->connect_error) {
                          die("Connection failed: " . $conn->connect_error);
                        }
                        $sql = "select * from faq";
                        if (($result = $conn->query($sql)) !== FALSE){
                            while($row = $result->fetch_assoc()){
                                $id = $row['f_id'];
                                $name =  $row['name'];
                                $ans = $row['ans'];
                                $date = $row['date'];
                                $flag = $row['flag'];
                                echo "<tr>
                                        <td>{$id}</td>
                                        <td>{$name}</td>
                                        <td>{$ans}</td>
                                        <td>{$date}</td>
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
                <h1 class="title">Edit FAQs</h1>
                <form >
                    <input type="text" name="name" placeholder="Service Name">
                    <textarea type="text" name="ans" value="" placeholder="Details"></textarea>
                    <input type="Date" name="date">
                    <input id="Submit" type="button" name="submit" value="Confirm" onclick="update()">
                </form>
                <?php include 'manage.html' ?>
            </td>
            <td id="flag">
                <h1 class="title">Flag FAQs</h1>
                <form>
                    <input type="text" name="flag" placeholder="Flag Value">
                    <input id="Submit" type="button" name="submit" value="Confirm" onclick="flaged()">
                </form>
                <?php include 'manage.html' ?>
            </td>
            <td id="delete">
                <h1 class="title">Delete FAQs</h1>
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
                xhttp.open('POST', '../services/getEditFaq.php', true);
                xhttp.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');
                xhttp.send('f_id='+checkedValue);

                xhttp.onreadystatechange = function (){
                    if(this.readyState == 4 && this.status == 200){
                        if(this.responseText != ""){
                            var val = this.responseText.split("|");
                            serviceId = val[0];
                            document.querySelector('#edit>form [name="name"]').value = val[1];
                            document.querySelector('#edit>form [name="ans"]').value = val[2];
                            document.querySelector('#edit>form [name="date"]').value = val[3];
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
            var ans = document.querySelector('#add [name="ans"]').value;
            var date = document.querySelector('#add [name="date"]').value;
            if((name != '') && (ans != '') && (date != '')){
                var xhttp = new XMLHttpRequest();
                xhttp.open('POST', '../services/insertFaq.php', true);
                xhttp.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');
                xhttp.send('name='+name+'&ans='+ans+'&date='+date);
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
                    xhttp.open('POST', '../services/deleteFaq.php', true);
                    xhttp.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');
                    xhttp.send('f_id='+flagCheckedValue[i]);

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
            var f_id = serviceId;
            var name = document.querySelector('#edit>form [name="name"]').value;
            var ans = document.querySelector('#edit>form [name="ans"]').value;
            var date = document.querySelector('#edit>form [name="date"]').value;

            if((name != '') && (ans != '') && (date != '') && (f_id != '')){
                var xhttp = new XMLHttpRequest();
                xhttp.open('POST', '../services/updateFaq.php', true);
                xhttp.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');
                xhttp.send('f_id='+f_id+'&name='+name+'&ans='+ans+'&date='+date);
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
            for(var i = 0; i < flagCheckedValue.length; i++){
                var f_id = flagCheckedValue[i];
                if((flag != '') && (f_id != '')){
                    var xhttp = new XMLHttpRequest();
                    xhttp.open('POST', '../services/flagFaq.php', true);
                    xhttp.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');
                    xhttp.send('f_id='+f_id+'&flag='+flag);
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
</body>

</html>