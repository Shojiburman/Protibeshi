<?php
    session_start(); 
?>
<!DOCTYPE html>
<html>

<head>
    <title>Registration</title>
    <link rel="stylesheet" type="text/css" href="../css/body.css">
</head>

<body>
    <?php
    include 'nav.html';
    ?>  

    <div id="reg">
        <h1>Sign up to protibeshi</h1>
        <form onsubmit="return validateMyForm()">
            <input type="text" name="name" placeholder="Name" oninput="Name()">
            <p id="nameformmsg"></p>
            <input type="text" name="email" value="" placeholder="Email" oninput="Email()" onfocusout="validateEmail()">
            <p id="emailformmsg"></p>
            <input name="pass" type="password" placeholder="Password" oninput="Password()">
            <p id="passformmsg"></p>
            <select name="uType" oninput="userType()">
                    <option value="0">Are you</option>
                    <option value="Seller">Seller</option>
                    <option value="Buyer">Buyer</option>
                    <option value="Dealer">Dealer</option>
            </select>
            <input class="btn" name="submit" type="button" value="SIGN UP" onclick="Submit()">
            <p id="submitformmsg"></p>
        </form>
    </div>
    <script type="text/javascript" src="../js/script.js"></script>
</body>

</html>