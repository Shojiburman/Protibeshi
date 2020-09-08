<?php
    session_start(); 
?>
<!DOCTYPE html>
<html>

<head>
    <title>Registration</title>
    <link rel="stylesheet" type="text/css" href="../css/body.css">
    <link rel="stylesheet" type="text/css" href="../css/nav.css">
    <link rel="stylesheet" type="text/css" href="../css/registration.css">
</head>

<body>
    <?php
    include 'nav.html';
    ?>  

    <div id="reg">
        <h1>Sign up to protibeshi</h1>
        <form>
            <input type="text" name="name" placeholder="Name" oninput="Name()">
            <p id="nameformmsg"></p>
            <input type="text" name="email" value="" placeholder="Email" oninput="Email()" onfocusout="validateEmail()">
            <p id="emailformmsg"></p>
            <input name="pass" type="password" placeholder="Password" oninput="Password()">
            <p id="passformmsg"></p>
            <input class="btn" name="submit" type="button" value="SIGN UP" onclick="Submit()">
            <p id="submitformmsg"></p>
        </form>
    </div>

    <script type="text/javascript">
        var msg = '';
        function Name(){
            console.log('hi');
            var name = document.querySelector('[name="name"]').value.trim();
            if (name != '') {
                msg = 'Success!';
                if (name.split(' ').length > 1) {
                    msg = 'Success!';
                    if (name.charAt(0).toLowerCase() != name.charAt(0).toUpperCase()) {
                        msg = 'Success!';
                        if (!validateName(name)) {
                            msg = '*Name must contain a-z, A-Z, dot(.) or dash(-)';
                        } else {
                            msg = 'Success!';
                        }
                    } else {
                        msg = '*Name must start with a letter';
                    }
                } else {
                    msg = '*Name can not be less than two words';
                }
            } else {
                msg = '*Name can not be empty';
            }
            if(msg != 'Success!') {
                document.getElementById('nameformmsg').innerHTML = msg;
                document.querySelector('[name="name"]').style.cssText = "border: 1px solid red;";
                document.getElementById('nameformmsg').style.cssText = "display: block; color: red";
            } else {
                document.getElementById('nameformmsg').innerHTML = '';
                document.getElementById('nameformmsg').style.cssText = "display: none;";
                document.querySelector('[name="name"]').style.cssText = "border: 1px solid #0aab8e;";
            } 
        }

        function Email(){
            var email = document.querySelector('[name="email"]').value.trim();
            if (email != ''){
                msg = "Success!";
                if (email.indexOf(" ") == -1) {
                    msg = 'Success!';
                    if (multipleAT(email)) {
                        msg = 'Success!';
                        if (email.indexOf("@") > 0) {
                            msg = 'Success!';
                            if (email.indexOf(".") > -1) {
                                msg = 'Success!';
                                var domainExt = email.split("@")[1];
                                var domain = domainExt.split(".")[0];
                                var ext = domainExt.replace(domain, '');
                                if(domain.length != 0 && validateDomainName(domain)){
                                    msg = 'Success!';
                                    if(ext.length > 1 && validateDomainExt(ext)){
                                        msg = 'Success!';
                                    } else {
                                        msg = '*Email must have more than 1 letter and letters only after last ".", should not have number.';
                                    }
                                } else {
                                    msg = '*Email can only have dot(.), dash(-), chracters and numbers between "@" and last "." with no adjacent "@" or "."';
                                }
                            } else {
                                msg = '*Email must have "."';
                            }
                        } else {
                            msg = '*Email can not start with "@"';
                        }
                    } else {
                        msg = '*Email can not have multiple "@"';
                    }
                } else {
                    msg = '*Email can not have spaces';
                }
            } else {
                msg = '*Email can not be empty';
            }
            if(msg != 'Success!') {
                document.getElementById('emailformmsg').innerHTML = msg;
                document.querySelector('[name="email"]').style.cssText = "border: 1px solid red;";
                document.getElementById('emailformmsg').style.cssText = "display: block; color: red";
            } else {
                document.getElementById('emailformmsg').innerHTML = '';
                document.getElementById('emailformmsg').style.cssText = "display: block;";
                document.querySelector('[name="email"]').style.cssText = "border: 1px solid #0aab8e;";
            }
        }

        function Password(){
            var pass = document.querySelector('[name="pass"]').value.trim();
            if(pass == ""){
                msg = '*password cant empty';
                document.querySelector('[name="pass"]').style.cssText = "border: 1px solid red;";
                document.getElementById('passformmsg').innerHTML = '*password cant empty';
                document.getElementById('passformmsg').style.cssText = "display: block;";
                document.getElementById('passformmsg').style.color = "red";
            }
            else if(pass.length < 6){
                msg = 'password is too weak';
                document.querySelector('[name="pass"]').style.cssText = "border: 1px solid 0aab8e;";
                document.getElementById('passformmsg').innerHTML = 'password is too weak';
                document.getElementById('passformmsg').style.cssText = "display: block;";
                document.getElementById('passformmsg').style.color = "#FF9800";
            }
            else if(pass.length >= 6 && pass.length < 7){
                msg = 'Success!';
                document.querySelector('[name="pass"]').style.cssText = "border: 1px solid 0aab8e;";
                document.getElementById('passformmsg').innerHTML = 'password is weak';
                document.getElementById('passformmsg').style.cssText = "display: block;";
                document.getElementById('passformmsg').style.color = "#3d791f";
            }
            else if(pass.length >= 8 && pass.length < 9){
                msg = 'Success!';
                document.querySelector('[name="pass"]').style.cssText = "border: 1px solid 0aab8e;";
                document.getElementById('passformmsg').innerHTML = 'password is strong';
                document.getElementById('passformmsg').style.cssText = "display: block;";
                document.getElementById('passformmsg').style.color = "#4CAF50";
            }
            else if(pass.length >= 12){
                msg = 'Success!';
                document.querySelector('[name="pass"]').style.cssText = "border: 1px solid 0aab8e;";
                document.getElementById('passformmsg').innerHTML = 'password is too strong';
                document.getElementById('passformmsg').style.cssText = "display: block;";
                document.getElementById('passformmsg').style.color = "green";
            }
        }

        function Submit(){
            var name = document.querySelector('[name="name"]').value.trim();
            var email = document.querySelector('[name="email"]').value.trim();
            var pass = document.querySelector('[name="pass"]').value.trim();
            if((name != '') && (email != '') && (pass != '') && (msg == 'Success!')){
                var xhttp = new XMLHttpRequest();
                xhttp.open('POST', '../services/registration.php', true);
                xhttp.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');
                xhttp.send('name='+name+'&email='+email+'&pass='+pass);
                xhttp.onreadystatechange = function (){
                    if(this.readyState == 4 && this.status == 200){
                        var res = this.responseText;
                        if(res == 'insert'){
                            document.querySelector('#reg form').reset();
                            location.assign('login.php');
                        } else {
                            document.getElementById('submitformmsg').innerHTML = 'Try again';
                            document.getElementById('submitformmsg').style.cssText = "display: block; color: red";
                        }
                    }   
                }
            }
        }

        function validateName(string) {
            var array = string.split('');
            var flag = true;
            array.forEach(function(value) {
                if ((value == '.') || (value == '-') || (value == ' ') || (value.toLowerCase() != value.toUpperCase())) {} else {
                    flag = false;
                }
            });
            return flag;
        }

        function multipleAT(string) {
            var array = string.split('@');
            if ( array.length == 2) {
                return true
            }
            return false;
        }

        function validateDomainName(string) {
            var array = string.split('');
            var flag = true;
            array.forEach(function(value) {
                if ((value == '')) {
                    flag = false;
                } else {
                    if (value == '-' || value == '.' || ((value.toLowerCase() != value.toUpperCase())) ){} else {
                        flag = false;
                    }
                }
            });
            return flag;
        }

        function validateDomainExt(string) {
            var array = string.replace('.','');
            array = array.split('');
            var flag = true;
            array.forEach(function(value) {
                if (value == ' ') {
                    flag = false;
                } else {
                    if ((value.toLowerCase() != value.toUpperCase())) {flag = true;} else {
                        flag = false;
                    }
                }
            });
            return flag;
        }
        function validateEmail() {
            var email = document.querySelector('[name="email"]').value.trim();
            console.log(email);
            if((email != '')){
                var xhttp = new XMLHttpRequest();
                xhttp.open('POST', '../services/email.php', true);
                xhttp.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');
                xhttp.send('email='+email);
                xhttp.onreadystatechange = function (){
                    if(this.readyState == 4 && this.status == 200){
                        var res = this.responseText;
                        console.log(res);
                        if(res == 'found'){
                            document.getElementById('emailformmsg').innerHTML = "*Email is taken.";
                            document.querySelector('[name="email"]').style.cssText = "border: 1px solid red;";
                            document.getElementById('emailformmsg').style.cssText = "display: block; color: red";
                        } else if(res == 'not found') {
                            document.getElementById('emailformmsg').innerHTML = '';
                            document.getElementById('nameformmsg').style.cssText = "display: none;";
                            document.querySelector('[name="name"]').style.cssText = "border: 1px solid #0aab8e;";

                        } else if(res == 'not ok') {
                            document.getElementById('emailformmsg').innerHTML = '*Email can not be Empty';
                            document.getElementById('emailformmsg').style.cssText = "display: block; color: red;";
                            document.querySelector('[name="email"]').style.cssText = "border: 1px solid red;";
                        } else {
                            document.getElementById('emailformmsg').innerHTML = '';
                            document.getElementById('nameformmsg').style.cssText = "display: none;";
                        }
                    }   
                }
            }
            return false;
        }
    </script>
</body>

</html>