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
    <script type="text/javascript" src="../js/adminNav.js"></script>
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
    <?php
        if($c_type == '0'){
    ?>
        <div id="hero_section">
            <h1 class="item">Most Powerful Directory<span></span>Available for Service Providers</h1>
            <form action="" method="" class="item">
                <input type="text" name="search" value="" placeholder="I'm looking for">
                <select name="catagory">
                        <option value="Job">Job</option>
                        <option value="Services">Services</option>
                        <option value="Dealer">Dealer</option>
                        <option value="Seller">Seller</option>
                        <option value="Buyer">Buyer</option>
                    </select>
                <button>
                    <a href="#">search</a>
                </button>
            </form>
        </div>
    <?php }?>

    <?php
        if($c_type == '1'){
    ?>
        <div id="hero_section">
            <h1 class="item">Most Powerful Directory<span></span>Available for Service Providers</h1>
            <form action="" method="" class="item">
                <input type="text" name="search" value="" placeholder="I'm looking for">
                <select name="catagory">
                        <option value="Services">Services</option>
                        <option value="Dealer">Dealer</option>
                        <option value="Seller">Seller</option>
                        <option value="Buyer">Buyer</option>
                    </select>
                <button>
                    <a href="#">search</a>
                </button>
            </form>
        </div>
    <?php }?>

    <?php
        if($c_type == '2'){
    ?>
        <div id="hero_section">
            <h1 class="item">Most Powerful Directory<span></span>Available for Service Providers</h1>
            <form action="" method="" class="item">
                <input type="text" name="search" value="" placeholder="I'm looking for">
                <select name="catagory">
                        <option value="Job">Job</option>
                        <option value="Services">Services</option>
                        <option value="Dealer">Dealer</option>
                        <option value="Seller">Seller</option>
                        <option value="Buyer">Buyer</option>
                    </select>
                <button>
                    <a href="#">search</a>
                </button>
            </form>
        </div>
    <?php }?>

    <?php
        if($c_type == '3'){
    ?>
        <div id="hero_section">
            <h1 class="item">Most Powerful Directory<span></span>Available for Service Providers</h1>
            <form action="" method="" class="item">
                <input type="text" name="search" value="" placeholder="I'm looking for">
                <select name="catagory">
                        <option value="Services">Services</option>
                        <option value="Dealer">Dealer</option>
                        <option value="Seller">Seller</option>
                        <option value="Buyer">Buyer</option>
                    </select>
                <button>
                    <a href="#">search</a>
                </button>
            </form>
        </div>
    <?php }?>

</body>

</html>