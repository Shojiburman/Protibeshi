<!DOCTYPE html>
<html>

<head>
    <title>Login</title>
    <link rel="stylesheet" type="text/css" href="../css/body.css">
</head>

<body>
 
    <?php
    include 'nav.html';
    ?>

    <div id="log">
    	<h1>Sign in to Protibeshi</h1>
    	<form onsubmit="return validateMyForm()">
    		<input type="text" name="email" value="" placeholder="Email" oninput="logEmail()">
            <p id="emailformmsg"></p>
    		<input type="password" name="pass" value="" placeholder="Password" oninput="logPassword()">
            <p id="passformmsg"></p>
            <p id="submitformmsg"></p>
            <div id="remember">
                <input type="checkbox" name="remember[]" <?php if (isset($remember) && in_array('yes', $remember)) echo "checked"; ?> >
                <label for="remember">Remember me</label>
            </div>
    		<input class="btn" type="button" name="submit" value="SIGN IN" onclick="logSubmit()">
    	</form>
    </div>
    <script type="text/javascript" src="../js/script.js"></script>
</body>

</html>