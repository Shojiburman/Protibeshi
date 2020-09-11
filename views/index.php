<!DOCTYPE html>
<html>
<head>
	<title>Protibeshi</title>
    <link rel="stylesheet" type="text/css" href="../css/protibeshi.css">
    <link rel="stylesheet" type="text/css" href="../css/body.css">
    <link rel="stylesheet" type="text/css" href="../css/nav.css">
</head>
<body>
	<?php
    include '../views/nav.html';
    ?>
    <div id="hero_section">
        <h1>Most Powerful Directory<span></span>Available for Service Providers</h1>
        <form onsubmit="return validateMyForm()">
            <input type="text" name="search" value="" placeholder="I'm looking for">
            <select name="type">
                    <option value="Job">Job</option>
                    <option value="Dealer">Dealer</option>
                    <option value="Seller">Seller</option>
                    <option value="Services">Services</option>
                </select>
            <button onclick="Search()">search</button>
        </form>
    </div>
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
    <script type="text/javascript" src="../js/script.js"></script>
</body>
</html>