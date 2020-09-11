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
    <link rel="stylesheet" type="text/css" href="../css/sellerWork.css">
    <script type="text/javascript" src="../js/script.js"></script>
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
                include 'work.html';
            ?>
            <td id="add">
                <h1 class="title">Add Service</h1>
                <form onsubmit="return validateMyForm()">
                <select name="catagory">
                    <option value="0">Select</option>
                    <option value="Home">Home</option>
                    <option value="Hotel">Hotel</option>
                    <option value="Office">Office</option>
                </select>
                <input type="text" name="service" val="0" placeholder="Service Name" oninput="searchService()">
                <table id='searched-service'>
                    <tbody>
                    </tbody>
                </table>
                <textarea type="text" name="details" value="" placeholder="Details"></textarea>
                <input type="text" name="price" placeholder="Price">
                <input class="Submit" type="button" name="submit" value="Create" onclick="create()">
                </form>
                <?php include 'sellerManage.html' ?>
            </td>
            <td id="view">
                <h1 class="title">Service list</h1>
                <table >
                    <tr>
                        <td>Name</td>
                        <td>Details</td>
                        <td>Price</td>
                        <td>Catagory TYPE</td>
                        <td>Select Service</td>
                    </tr>
                    <?php 
                        $conn = dbConnection();
                        if ($conn->connect_error) {
                          die("Connection failed: " . $conn->connect_error);
                        }
                        $us_id = $_SESSION['id'];
                        $sql = "SELECT us.us_id, s.name, us.details, us.price, c.name AS catagory from us_services us, services s, catagory c where us.s_id = s.s_id AND c.c_id = s.c_id AND us.u_id = '$us_id'";
                        if (($result = $conn->query($sql)) !== FALSE){
                            while($row = $result->fetch_assoc()){
                                $id = $row['us_id'];
                                $name =  $row['name'];
                                $details = $row['details'];
                                $price = $row['price'];
                                $c_id = $row['catagory'];
                                echo "<tr>
                                        <td>{$name}</td>
                                        <td>{$details}</td>
                                        <td>{$price}</td>
                                        <td>{$c_id}</td>
                                        <td><input type='checkbox' name='selector' value = '{$id}'></td>
                                    </tr>";
                            }
                        }
                        $conn->close();
                    ?>
                </table>
                <?php include 'sellerManage.html' ?>
            </td>
            <td id="edit">
                <h1 class="title">Edit Sevice</h1>
                <form onsubmit="return validateMyForm()">
                    <textarea type="text" name="details" value="" placeholder="Details"></textarea>
                    <input type="text" name="price" placeholder="Price">
                    <input class="Submit" type="button" name="submit" value="Confirm" onclick="update()">
                </form>
                <?php include 'sellerManage.html' ?>
            </td>
            <td id="delete">
                <h1 class="title">Delete Sevice</h1>
                <input class="Submit" type="button" name="submit" value="Confirm" onclick="Delete()">
                <?php include 'sellerManage.html' ?>
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
                xhttp.open('POST', '../services/getEditUserService.php', true);
                xhttp.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');
                xhttp.send('us_id='+checkedValue);

                xhttp.onreadystatechange = function (){
                    if(this.readyState == 4 && this.status == 200){
                        if(this.responseText != ""){
                            var val = this.responseText.split("|");
                            serviceId = val[0];
                            document.querySelector('#edit>form [name="details"]').value = val[1];
                            document.querySelector('#edit>form [name="price"]').value = val[2];
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
            var s_id = document.querySelector('#add [name="service"]').getAttribute("val");
            var details = document.querySelector('#add [name="details"]').value;
            var price = document.querySelector('#add [name="price"]').value;
            var c_id = document.querySelector('#add [name="catagory"]').value;
            console.log(s_id);
            if((s_id != '') && (details != '') && (price != '') && (c_id != '')){
                var xhttp = new XMLHttpRequest();
                xhttp.open('POST', '../services/insertUserService.php', true);
                xhttp.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');
                xhttp.send('s_id='+s_id+'&details='+details+'&price='+price+'&catagory='+c_id);
                xhttp.onreadystatechange = function (){
                    if(this.readyState == 4 && this.status == 200){
                        var res = this.responseText;
                        if(res == 'insert'){
                            console.log(res);
                            document.querySelector('#add form').reset();
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
                    xhttp.open('POST', '../services/deleteUserService.php', true);
                    xhttp.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');
                    xhttp.send('us_id='+flagCheckedValue[i]);

                    xhttp.onreadystatechange = function (){
                        if(this.readyState == 4 && this.status == 200){
                            var res = this.responseText;
                            if(res == "delete"){
                                location.reload();
                            }
                        }   
                    }
                }
            } else {
                location.reload();
            }
        }

        function update(){
            var us_id = serviceId;
            var details = document.querySelector('#edit>form [name="details"]').value;
            var price = document.querySelector('#edit>form [name="price"]').value;

            if((details != '') && (price != '') && (us_id != '')){
                var xhttp = new XMLHttpRequest();
                xhttp.open('POST', '../services/updateUserService.php', true);
                xhttp.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');
                xhttp.send('us_id='+us_id+'&details='+details+'&price='+price);
                xhttp.onreadystatechange = function (){
                    if(this.readyState == 4 && this.status == 200){
                        var res = this.responseText;
                        console.log(res);
                        if(res == 'update'){
                            document.querySelector('#edit>form').reset();
                            location.reload();
                        } else {
                        }
                    }   
                }
            }
        }
 
        function searchService(){
            var el = document.querySelectorAll('#searched-service tbody tr');
            el.forEach(function (value, index) {
                value.remove();
            });
            var search = document.querySelector('[name="service"]').value.trim();

            if(search != ''){
                var xhttp = new XMLHttpRequest();
                xhttp.open('POST', '../services/searchService.php', true);
                xhttp.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');
                xhttp.send('search='+search);
                xhttp.onreadystatechange = function (){
                    if(this.readyState == 4 && this.status == 200){
                        var res = this.responseText;
                        if(res != '' && res != "not found" && res != "not ok"){
                            document.getElementById("searched-service").classList.add('active');
                            var results = JSON.parse(res);
                            console.log(results);
                            if (results.length) {
                                results.forEach(function (value, index) {
                                    var tr = document.createElement('tr');
                                    tr.setAttribute("onclick", "view(this)");
                                    for (const [k, v] of Object.entries(value)) {
                                        if(k != 's_id'){
                                            var td = document.createElement('td');
                                            var txt = document.createTextNode(v);
                                            td.appendChild(txt);
                                            tr.appendChild(td);
                                        }
                                    }
                                    tr.setAttribute("data-id", value.s_id);
                                    document.querySelector('#searched-service tbody').appendChild(tr);
                                });
                            }
                        }
                        else {
                            console.log(res);
                        }
                    }   
                }
            }
        }

        function view(clicked){
            var id = clicked.getAttribute('data-id');
            document.querySelector('[name="service"]').value = clicked.getElementsByTagName('td')[0].innerHTML;
            document.querySelector('[name="service"]').setAttribute("val", id);
            document.getElementById("searched-service").classList.remove('active');
            var el = document.querySelectorAll('#searched-service tbody tr');
            el.forEach(function (value, index) {
                value.remove();
            });
        }

    </script>
</body>

</html>