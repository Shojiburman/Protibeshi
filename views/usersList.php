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
    <style>
        ul {
            list-style: none;
            padding-left: 0;
        }
        ul li {
            display: block;
            width: 70%;
            padding: 10px;
            margin: 0px auto;
        }
        ul li a {
            display: block;
            text-align: center;
        }
        a {
            color: black;
            text-decoration: none;
        }
        img {
            width: 150px;
            height: auto;
        }
        table tr td:last-child table tr td {
            text-align: center;
            background-color: white;
            padding: 10px;
        }
    </style>
</head>

<body>
    <?php
        include 'adminNav.html';
    ?>

    <table align="center">
        <tr>
            <?php
                include 'work.html';
            ?>
            <td width="1200px" height="600px" style="background-color: #f3f5f7">
                <h3 style="font-family: Roboto; margin: 20px 10px 50px 10px; color: #0aab8e" align="center">USERS LIST</h3>
                <table border="0" align="center" cellspacing="0" cellpadding="0">
                    <tr>
                        <td align="center">ID</td>
                        <td align="center">NAME</td>
                        <td align="center">EMAIL</td>
                        <td align="center">CONTUCT NUMBER</td>
                        <td align="center">ADDRESS</td>
                        <td align="center">USER TYPE</td>
                        <td align="center">ACTION</td>
                    </tr>
                    <?php 
                        $conn = mysqli_connect('127.0.0.1', 'root', '', 'protibeshi');
                        if ($conn->connect_error) {
                          die("Connection failed: " . $conn->connect_error);
                        }
                        $sql = "select * from users";
                        if (($result = $conn->query($sql)) !== FALSE){
                            while($row = $result->fetch_assoc()){
                                $id = $row['u_id'];
                                $name =  $row['name'];
                                $email = $row['email'];
                                $pnumber = $row['pnumber'];
                                $address = $row['address'];
                                $utype = $row['admin'];
                                echo "<tr>
                                        <td>{$id}</td>
                                        <td>{$name}</td>
                                        <td>{$email}</td>
                                        <td>{$pnumber}</td>
                                        <td>{$address}</td>
                                        <td>{$utype}</td>
                                        <td><a href='admineditusers?id=$id?' style='color: green'>EDIT</a>
                                        <span>   </span>
                                        <a href='deleteUsers.php?id=$id?' style='color: red'>DELETE</a></td>
                                    </tr>";
                            }
                        }
                        $conn->close();
                    ?>
                </table>                
            </td>
        </tr>
    </table>
</body>

</html>