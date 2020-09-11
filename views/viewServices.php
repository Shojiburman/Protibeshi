<?php
	session_start();
    include '../php/session.php';
    require_once('../db/db.php');

	if(isset($_GET["uid"])){
		$id = $_GET["uid"];
		$conn = dbConnection();
		if(!$conn){
			echo "DB connection error";
		}
		$sql = "SELECT u.s_id, s.name, u.price, u.details, c.name AS cname, u.u_id
				FROM services s
				INNER JOIN us_services u
				ON s.s_id = u.s_id
				INNER JOIN catagory c
				ON s.c_id = c.c_id
				AND u.us_id = '$id';";

		if (($result = $conn->query($sql)) !== FALSE){
	        while($row = $result->fetch_assoc()){
				$name = $row['u_id'];
				$sname = $row['name'];
				$price = $row['price'];
				$details = $row['details'];
				$catagory = $row['cname'];
				$u_id = $row['u_id'];
			}
		}

		$sql = "SELECT name from users WHERE u_id = '$u_id'";
		if (($result = $conn->query($sql)) !== FALSE){
	        while($row = $result->fetch_assoc()){
				$name = $row['name'];
			}
		}
	}
?>


<!DOCTYPE html>
<html>
<head>
	<title>View profile</title>
	<link rel="stylesheet" type="text/css" href="../css/body.css">
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
	<div id="view-service" data-id='<?php echo $id?>'>
		<h1><?php echo $sname ?></h1>
		<div>
			<p class="sub-title"><?php echo $name ?></p>
			<p class="sub-title"><?php echo $catagory ?></p>
			<p class="sub-title">৳<?php echo $price ?></p>
		</div>
		<p><?php echo $details ?></p>
	</div>

	<button class="btn" onclick="seeMore()">see more</button>

	<div id="see-more"></div>


	<script type="text/javascript">
		function seeMore(){
            var el = document.querySelectorAll('#see-more div');
            el.forEach(function (value, index) {
                value.remove();
            });
            document.querySelector('.btn').classList.add('de-active');
            var type = document.querySelector('#view-service .sub-title:nth-child(2)').innerHTML.trim();
            var existService = document.querySelector('#view-service').getAttribute('data-id');
            console.log(type);
            if(type != ''){
                var xhttp = new XMLHttpRequest();
                xhttp.open('POST', '../services/seeMoreServices.php', true);
                xhttp.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');
                xhttp.send('type='+type+'&existService='+existService);
                xhttp.onreadystatechange = function (){
                    if(this.readyState == 4 && this.status == 200){
                        var res = this.responseText;
                        console.log(res);
                        if(res != '' && res != "not found" && res != "not ok"){
                            //document.getElementById("see-more").classList.add('active');
                            var results = JSON.parse(res);
                            console.log(results);
                            if (results.length) {
                                results.forEach(function (value, index) {
                                    var div = document.createElement('div');
                                    div.setAttribute("class", "see-more-service");
                                    var innerDiv = document.createElement('div');
                                    div.appendChild(innerDiv);
                                    for (const [k, v] of Object.entries(value)) {
                                        if(k != 'u_id'){
                                        	if(k == 'sname'){
                                        		var h1 = document.createElement('h1');
	                                            var txt = document.createTextNode(v);
	                                            h1.appendChild(txt);
	                                            div.insertBefore(h1, innerDiv);
                                        	} else if(k == 'details'){
                                        		var p = document.createElement('p');
	                                            var txt = document.createTextNode(v);
	                                            p.appendChild(txt);
	                                            div.appendChild(p);
                                        	} else if((k == 'name') || (k == 'catagory') || (k == 'price')){
	                                            var p = document.createElement('p');
	                                            p.setAttribute("class", "sub-title");
	                                            var txt = document.createTextNode(v);
	                                            p.appendChild(txt);
	                                            innerDiv.appendChild(p);
                                        	}
                                        }
                                    }
                                    div.setAttribute("data-id", value.u_id);
                                    document.querySelector('#see-more').appendChild(div);
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
    </script>
    <script type="text/javascript" src="../js/script.js"></script>
</body>
</html>