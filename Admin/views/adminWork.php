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
    <link rel="stylesheet" type="text/css" href="../css/adminWork.css">
    <script type="text/javascript" src="../js/adminWork.js"></script>
</head>

<body>
    <?php
        include 'adminNav.html';
    ?>

    <table id="content" changeValue="1">
        <tr>
            <?php
                include 'work.html';
            ?>
            <td id="add">
                <form action="../services/insertService.php" method="POST">
                    <input type="text" name="name" placeholder="Service Name">
                    <textarea type="text" name="details" value="" placeholder="Details"></textarea>
                    <input type="text" name="price" placeholder="Price">
                    <select name="catagory">
                        <option value="0">Select</option>
                        <option value="1">Home</option>
                        <option value="2">Hotel</option>
                        <option value="3">Office</option>
                    </select>
                    <input id="Submit" type="submit" name="submit" value="Create">
                </form>
                <ul class="option">
                    <li><button onclick="fun1()">Add</button></li>
                    <li><button onclick="fun2()">Edit</button></li>
                    <li><button onclick="fun3()">Flag</button></li>
                    <li><button onclick="fun4()">Delete</button></li>
                </ul>
            </td>
            <td id="edit">
                <form action="../services/updateService.php" method="POST">
                    <input type="text" name="name" placeholder="Service Name">
                    <textarea type="text" name="details" value="" placeholder="Details"></textarea>
                    <input type="text" name="price" placeholder="Price">
                    <select name="catagory">
                        <option value="0">Select</option>
                        <option value="1">Home</option>
                        <option value="2">Hotel</option>
                        <option value="3">Office</option>
                    </select>
                    <input id="Submit" type="submit" name="submit" value="Create">
                </form>
                <ul class="option">
                    <li><button onclick="fun1()">Add</button></li>
                    <li><button onclick="fun2()">Edit</button></li>
                    <li><button onclick="fun3()">Flag</button></li>
                    <li><button onclick="fun4()">Delete</button></li>
                </ul>
            </td>
            <td id="flag">
                <form action="../services/flagService.php" method="POST">
                    <select name="services">
                        <option value="0">Select</option>
                        <option value="1">electric</option>
                        <option value="2">plumbing</option>
                        <option value="3">cleaning</option>
                    </select>
                    <input type="text" name="name" placeholder="Flag value">
                    <input id="Submit" type="submit" name="submit" value="Create">
                </form>
                <ul class="option">
                    <li><button onclick="fun1()">Add</button></li>
                    <li><button onclick="fun2()">Edit</button></li>
                    <li><button onclick="fun3()">Flag</button></li>
                    <li><button onclick="fun4()">Delete</button></li>
                </ul>
            </td>
            <td id="delete">
                <form action="../services/deleteService.php" method="POST">
                    <select name="services">
                        <option value="0">Select</option>
                        <option value="1">electric</option>
                        <option value="2">plumbing</option>
                        <option value="3">cleaning</option>
                    </select>
                    <input id="Submit" type="submit" name="submit" value="Create">
                </form>
                <ul class="option">
                    <li><button onclick="fun1()">Add</button></li>
                    <li><button onclick="fun2()">Edit</button></li>
                    <li><button onclick="fun3()">Flag</button></li>
                    <li><button onclick="fun4()">Delete</button></li>
                </ul>
            </td>
        </tr>
    </table>
    <script type="text/javascript">
        function fun1(){
            document.querySelector('table[changeValue]').setAttribute("changeValue", "1");
        }
        function fun2(){
            document.querySelector('table[changeValue]').setAttribute("changeValue", "2");
        }
        function fun3(){
            document.querySelector('table[changeValue]').setAttribute("changeValue", "3");
        }
        function fun4(){
            document.querySelector('table[changeValue]').setAttribute("changeValue", "4");
        }
        
    </script>
</body>

</html>