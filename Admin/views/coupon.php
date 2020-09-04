<?php
    session_start();
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
</head>

<body>
    <?php
        include 'adminNav.html';
    ?>

    <table id="content">
        <tr>
            <?php
                include 'work.html';
            ?>
            <td>
                <form action="../services/insertCoupon.php" method="POST">
                    <input type="text" name="name" placeholder="Coupon Name">
                    <input type="text" name="percentage" placeholder="Percentage">
                    <input type="date" name="expiredate" placeholder="">
                    <input id="Submit" type="submit" name="submit" value="Create">
                </form>             
            </td>
        </tr>
    </table>
</body>

</html>