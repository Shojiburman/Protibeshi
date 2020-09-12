<?php
    session_start();
    include '../php/session.php';
?>

<!DOCTYPE html>
<html>

<head>
    <title>Logged in Dashboard</title>
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

    <div id="see-more"></div>
    
    <script type="text/javascript" src="../js/script.js"></script>
</body>

</html>