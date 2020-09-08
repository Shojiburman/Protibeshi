<?php
    session_start(); 
?>
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
    	<for>
    		<input type="text" name="email" value="" placeholder="Email">
    		<input type="password" name="pass" value="" placeholder="Password">
            <div id="remember">
                <input type="checkbox" name="remember[]" value="">
                <label for="remember">Remember me</label>
            </div>
    		<input class="btn" type="submit" name="submit" value="SIGN IN">
    	</form>
    </div>
</body>

</html>