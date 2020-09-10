<?php
    session_start();
    include '../php/session.php';

?>
<!DOCTYPE html>
<html>

<head>
    <title>Change Password</title>
    <link rel="stylesheet" type="text/css" href="../css/body.css">
    <link rel="stylesheet" type="text/css" href="../css/adminNav.css">
    <link rel="stylesheet" type="text/css" href="../css/profile.css">
    <style>
        input, textarea {
            margin: 10px;
            border-radius: 4px;
        }
    </style>
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

    <div id="hero_section">
        <div class="section">
            <div>
                <div id="profilePic">
                    <img src="<?php echo $c_pic; ?>">
                </div>
                <a id="editBtn" href="changeProfilePic.php"><img src="edit.svg"></a>
                <p id="name"><?php echo strtoupper($c_name);?></p>
                <p><?php echo ($c_email);?></p>
                <button class="btn" onclick="Changeclick()">Edit Profile</button>
            </div>
        </div>

        <div class="section">
            <div>
                <h3>Change Password</h3>
                <form>
                    <input type="hidden" name="u_id" value="<?php echo $_SESSION['id']; ?>">
                    <input type="password" name="pass" value="" placeholder="Password" oninput="Pass()">
                    <p id="passMsg"></p>
                    <input type="password" name="npass" value="" placeholder="New Password" oninput="nPass()">
                    <p id="npassMsg"></p>
                    <input type="password" name="cpass" value="" placeholder="Confirm Password" oninput="cPass()">
                    <p id="cpassMsg"></p>
                    <input class="btn" type="button" name="submit" value="SAVE" onclick="change()">
                </form>
                <p id="msg"></p>
            </div>
        </div>
    </div>
    <script type="text/javascript">
        function Changeclick(){
            location.assign('profile.php');
        }

        function Pass(){
            var msg = '';
            var pass = document.querySelector('[name="pass"]').value.trim();
            if (pass != '') {
                msg = 'Success!';
            } else {
                msg = '*Password can not be empty';
            }
            if(msg != 'Success!') {
                document.getElementById('passMsg').innerHTML = msg;
                document.querySelector('[name="pass"]').classList.add('rb');
                document.querySelector('[name="pass"]').classList.remove('gb');
                document.getElementById('passMsg').classList.add('r');
            } else {
                document.getElementById('passMsg').innerHTML = '';
                document.getElementById('msg').innerHTML = '';
                document.getElementById('passMsg').classList.add('g');
                document.querySelector('[name="pass"]').classList.remove('rb');
                document.querySelector('[name="pass"]').classList.add('gb');
            } 
        }
        function nPass(){
            var msg = '';
            var pass = document.querySelector('[name="npass"]').value.trim();
            if (pass != '') {
                msg = 'Success!';
            } else {
                msg = '*New Password can not be empty';
            }
            if(msg != 'Success!') {
                document.getElementById('npassMsg').innerHTML = msg;
                document.querySelector('[name="npass"]').classList.add('rb');
                document.querySelector('[name="npass"]').classList.remove('gb');
                document.getElementById('npassMsg').classList.add('r');
            } else {
                document.getElementById('npassMsg').innerHTML = '';
                document.getElementById('msg').innerHTML = '';
                document.getElementById('npassMsg').classList.add('g');
                document.querySelector('[name="npass"]').classList.remove('rb');
                document.querySelector('[name="npass"]').classList.add('gb');
            }
        }
        function cPass(){
            var msg = '';
            var pass = document.querySelector('[name="cpass"]').value.trim();
            if (pass != '') {
                msg = 'Success!';
            } else {
                msg = '*Confirm Password can not be empty';
            }
            if(msg != 'Success!') {
                document.getElementById('cpassMsg').innerHTML = msg;
                document.querySelector('[name="cpass"]').classList.add('rb');
                document.querySelector('[name="cpass"]').classList.remove('gb');
                document.getElementById('cpassMsg').classList.add('r');
            } else {
                document.getElementById('cpassMsg').innerHTML = '';
                document.getElementById('msg').innerHTML = '';
                document.getElementById('cpassMsg').classList.add('g');
                document.querySelector('[name="cpass"]').classList.remove('rb');
                document.querySelector('[name="cpass"]').classList.add('gb');
            }
        }

        function change(){
            var u_id = document.querySelector('[name="u_id"]').value;
            var pass = document.querySelector('[name="pass"]').value;
            var npass = document.querySelector('[name="npass"]').value;
            var cpass = document.querySelector('[name="cpass"]').value;

            if(u_id != '' && pass != '' && npass != '' && cpass != ''){
                var data  = {
                    'u_id'  : u_id,
                    'pass'  : pass,
                    'npass' : npass,
                    'cpass' : cpass
                };

                data = JSON.stringify(data);
                //console.log(data);

                var xhttp = new XMLHttpRequest();
                xhttp.open('POST', '../services/changePass.php', true);
                xhttp.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');
                xhttp.send('json='+data);

                xhttp.onreadystatechange = function (){
                    if(this.readyState == 4 && this.status == 200){
                        var res = this.responseText;
                        console.log(res);
                         if(res == 'update'){
                            document.getElementById('msg').classList.add('g');
                            document.getElementById('msg').classList.remove('r');
                            document.getElementById('msg').innerHTML = 'Successfully Updated';
                            //location.reload();
                        } else if(res == 'dont match'){
                            document.getElementById('msg').classList.add('r');
                            document.getElementById('msg').innerHTML = 'Confirm password and new password don not match';
                        } 
                        else if(res == 'match'){
                            document.getElementById('msg').classList.add('r');
                            document.getElementById('msg').innerHTML = 'Confirm password or new password can not be match with your current password';
                        } else {
                            document.getElementById('msg').classList.add('r');
                            document.getElementById('msg').innerHTML = 'Try again';
                        }
                    }   
                }
            } else {
                document.querySelector('[name="pass"]').classList.remove('gb');
                document.querySelector('[name="npass"]').classList.remove('gb');
                document.querySelector('[name="cpass"]').classList.remove('gb');
                document.querySelector('[name="pass"]').classList.add('rb');
                document.querySelector('[name="npass"]').classList.add('rb');
                document.querySelector('[name="cpass"]').classList.add('rb');
                document.getElementById('msg').classList.add('r');
                document.getElementById('msg').innerHTML = '*All fields are required';
            }
        }
    </script>
</body>

</html>