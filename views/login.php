<!DOCTYPE html>
<html>

<head>
    <title>Login</title>
    <link rel="stylesheet" type="text/css" href="../css/body.css">
    <link rel="stylesheet" type="text/css" href="../css/nav.css">
    <link rel="stylesheet" type="text/css" href="../css/login.css">
</head>

<body>
 
    <?php
    include 'nav.html';
    ?>

    <div id="log">
    	<h1>Sign in to Protibeshi</h1>
    	<form>
    		<input type="text" name="email" value="" placeholder="Email" oninput="Email()">
            <p id="emailformmsg"></p>
    		<input type="password" name="pass" value="" placeholder="Password" oninput="Password()">
            <p id="passformmsg"></p>
            <p id="submitformmsg"></p>
            <div id="remember">
                <input type="checkbox" name="remember[]" <?php if (isset($remember) && in_array('yes', $remember)) echo "checked"; ?> >
                <label for="remember">Remember me</label>
            </div>
    		<input class="btn" type="button" name="submit" value="SIGN IN" onclick="Submit()">
    	</form>
    </div>
    <script type="text/javascript">
        var msg = "";
        function Email(){
            var email = document.querySelector('[name="email"]').value.trim();
            if (email != '') {
                msg = 'Success!';
            } else {
                msg = '*Email can not be empty';
            }
            if(msg != 'Success!') {
                document.getElementById('emailformmsg').innerHTML = msg;
                document.querySelector('[name="email"]').style.cssText = "border: 1px solid red;";
                document.getElementById('emailformmsg').style.cssText = "display: block; color: red";
            } else {
                document.getElementById('emailformmsg').innerHTML = '';
                document.getElementById('emailformmsg').style.cssText = "display: none;";
                document.querySelector('[name="email"]').style.cssText = "border: 1px solid #0aab8e;";
            } 
        }
        function Password(){
            var pass = document.querySelector('[name="pass"]').value.trim();
            if (pass != '') {
                msg = 'Success!';
            } else {
                msg = '*Password can not be empty';
            }
            if(msg != 'Success!') {
                document.getElementById('passformmsg').innerHTML = msg;
                document.querySelector('[name="pass"]').style.cssText = "border: 1px solid red;";
                document.getElementById('passformmsg').style.cssText = "display: block; color: red";
            } else {
                document.getElementById('passformmsg').innerHTML = '';
                document.getElementById('passformmsg').style.cssText = "display: none;";
                document.querySelector('[name="pass"]').style.cssText = "border: 1px solid #0aab8e;";
            } 
        }
        function Submit(){
            var email = document.querySelector('[name="email"]').value.trim();
            var pass = document.querySelector('[name="pass"]').value.trim();
            if((email != '') && (pass != '') && (msg == "Success!")){
                var xhttp = new XMLHttpRequest();
                xhttp.open('POST', '../services/login.php', true);
                xhttp.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');
                xhttp.send('email='+email+'&pass='+pass);
                xhttp.onreadystatechange = function (){
                    if(this.readyState == 4 && this.status == 200){
                        var res = this.responseText;
                        console.log(res);
                        if(res == '0'){
                            //document.querySelector('#log form').reset();
                            location.assign('dashboard.php');
                        } else if(res == '1'){
                            //document.querySelector('#log form').reset();
                            location.assign('dashboard.php');
                        } else if(res == '2'){
                            //document.querySelector('#log form').reset();
                            location.assign('dashboard.php');
                        } else if(res == '3'){
                            //document.querySelector('#log form').reset();
                            location.assign('dashboard.php');
                        }
                        else {
                            document.getElementById('submitformmsg').style.cssText = "display: block; color: red";
                            document.getElementById('submitformmsg').innerHTML = "Invalid Credential";
                        }
                    }   
                }
            } else {
                document.getElementById('passformmsg').innerHTML = 'Fillup all field';
                document.querySelector('[name="email"]').style.cssText = "border: 1px solid red;";
                document.querySelector('[name="pass"]').style.cssText = "border: 1px solid red;";
                document.getElementById('passformmsg').style.cssText = "display: block; color: red";
            }
        }
    </script>
</body>

</html>