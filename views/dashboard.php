<?php
    session_start();
    include '../php/session.php';
?>

<!DOCTYPE html>
<html>

<head>
    <title>Logged in Dashboard</title>
    <link rel="stylesheet" type="text/css" href="../css/body.css">
    <link rel="stylesheet" type="text/css" href="../css/dashboard.css">
    <link rel="stylesheet" type="text/css" href="../css/adminNav.css">
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
    <?php
        if($_SESSION['uType'] == '0'){
    ?>
        <div id="hero_section">
            <h1 class="item">Most Powerful Directory<span></span>Available for Service Providers</h1>
            <form onsubmit="return validateMyForm()">
                <input type="text" name="search" value="" placeholder="I'm looking for" oninput="checkSearch()">
                <select name="type">
                        <option value="Job">Job</option>
                        <option value="Services">Services</option>
                        <option value="Dealer">Dealer</option>
                        <option value="Seller">Seller</option>
                        <option value="Buyer">Buyer</option>
                </select>
                <button onclick="Search()">search</button>
            </form>
        </div>
    <?php }?>

    <?php
        if($_SESSION['uType'] == '1'){
    ?>
        <div id="hero_section">
            <h1 class="item">Most Powerful Directory<span></span>Available for Service Providers</h1>
            <form onsubmit="return validateMyForm()">
                <input type="text" name="search" value="" placeholder="I'm looking for" oninput="checkSearch()">
                <select name="type">
                        <option value="Services">Services</option>
                        <option value="Dealer">Dealer</option>
                        <option value="Seller">Seller</option>
                        <option value="Buyer">Buyer</option>
                    </select>
                <button onclick="Search()">search</button>
            </form>
        </div>
    <?php }?>

    <?php
        if($_SESSION['uType'] == '2'){
    ?>
        <div id="hero_section">
            <h1 class="item">Most Powerful Directory<span></span>Available for Service Providers</h1>
            <form onsubmit="return validateMyForm()">
                <input type="text" name="search" value="" placeholder="I'm looking for" oninput="checkSearch()">
                <select name="type">
                    <option value="Job">Job</option>
                    <option value="Services">Services</option>
                    <option value="Dealer">Dealer</option>
                    <option value="Seller">Seller</option>
                    <option value="Buyer">Buyer</option>
                </select>
                <button onclick="Search()">search</button>
            </form>
        </div>
    <?php }?>

    <?php
        if($_SESSION['uType'] == '3'){
    ?>
        <div id="hero_section">
            <h1 class="item">Most Powerful Directory<span></span>Available for Service Providers</h1>
            <form onsubmit="return validateMyForm()">
                <input type="text" name="search" value="" placeholder="I'm looking for" oninput="checkSearch()">
                <select name="type">
                    <option value="Services">Services</option>
                    <option value="Dealer">Dealer</option>
                    <option value="Seller">Seller</option>
                    <option value="Buyer">Buyer</option>
                </select>
                <button onclick="Search()">search</button>
            </form>
        </div>
    <?php }?>

    <table id='searchResult'>
        <thead>
            <tr>
                <th>Service Provider</th>
                <th>Service Name</th>
                <th>Price</th>
                <th>Catagory</th>
            </tr>
        </thead>
        <tbody>
        </tbody>
    </table>


    

    <script type="text/javascript">
        function Search(){
            var el = document.querySelectorAll('#searchResult tbody tr');
            el.forEach(function (value, index) {
                value.remove();
            });
            var search = document.querySelector('[name="search"]').value.trim();
            var type = document.querySelector('[name="type"]').value.trim();

            if((search != '') && (type != '')){
                var xhttp = new XMLHttpRequest();
                xhttp.open('POST', '../services/serach.php', true);
                xhttp.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');
                xhttp.send('search='+search+'&type='+type);
                xhttp.onreadystatechange = function (){
                    if(this.readyState == 4 && this.status == 200){
                        var res = this.responseText;
                        if(res != '' && res != "not found" && res != "not ok"){
                            document.getElementById("searchResult").classList.add('active');
                            var results = JSON.parse(res);
                            console.log(results);
                            if (results.length) {
                                results.forEach(function (value, index) {
                                    var tr = document.createElement('tr');
                                    tr.setAttribute("onclick", "view(this)");
                                    for (const [k, v] of Object.entries(value)) {
                                        if(k != 'u_id'){
                                            var td = document.createElement('td');
                                            var txt = document.createTextNode(v);
                                            td.appendChild(txt);
                                            tr.appendChild(td);
                                        }
                                    }
                                    tr.setAttribute("data-id", value.u_id);
                                    document.querySelector('#searchResult tbody').appendChild(tr);
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

        function checkSearch(){
            var search = document.querySelector('[name="search"]').value.trim();
            if(search == ''){
                document.getElementById("searchResult").classList.remove('active');
                var el = document.querySelectorAll('#searchResult tbody tr');
                el.forEach(function (value, index) {
                    value.remove();
                });
            }
        }
    </script>
    <script type="text/javascript" src="../js/script.js"></script>
</body>

</html>