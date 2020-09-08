<?php
    session_start(); 

    $email = $pass = "";
    $remember = [];
    if(isset($_SESSION['name']) || isset($_COOKIE['remember'])){
        header("location:dashboard.php");
        die();
    }

    if (isset($_POST['submit'])) {
        if (isset($_POST['email'])) {
            $email = strtolower(trim($_POST['email']));
            if ($email == '') {
                $emailErr = 'Email can not be empty';
            }
        } else {
            $emailErr = 'Email is required';
        }

        if (isset($_POST['pass'])) {
            $pass = trim($_POST['pass']);
            if ($pass == '') {
                $passErr = 'Password can not be empty';
            }
        } else {
            $passErr = 'Password is required';
        }

        if (isset($_POST["remember"])) {
            $remember = $_POST['remember'];
        }

        if(isset($emailErr) || isset($passErr)){}
            else { 
                $conn = mysqli_connect('127.0.0.1', 'root', '', 'protibeshi');

                if ($conn->connect_error) {
                  die("Connection failed: " . $conn->connect_error);
                }
                $sql = "select * from users where email = '".$email."' AND pass = '".$pass."'";
                if (($result = $conn->query($sql)) !== FALSE){
                    while($row = $result->fetch_assoc()){
                        $_SESSION['id'] = $row['u_id'];
                        if(isset($remember) && in_array('yes', $remember)){
                            setcookie('remember', $row['u_id'], time() + (10 * 365 * 24 * 60 * 60));
                        } else {
                            setcookie('remember', "");
                        }
                        header('location: dashboard.php');
                    } 
                    $passErr = 'Invalid user/password';
                } 
            $conn->close();
        }                    
    } 
?>
<!DOCTYPE html>
<html>

<head>
    <title>Login</title>
    <link rel="stylesheet" type="text/css" href="../css/body.css">
    <link rel="stylesheet" type="text/css" href="../css/login.css">
    <link rel="stylesheet" type="text/css" href="../css/nav.css">
</head>

<body>
 
    <?php
    include 'nav.html';
    ?>

    <div id="login">
    	<h1>Sign in to protibeshi</h1>
    	<form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="post">
    		<input type="text" name="email" value="<?php echo $email;?>" placeholder="Email">
    		<input type="password" name="pass" value="<?php echo $pass;?>" placeholder="Password">
    		<input id="remember" type="checkbox" name="remember[]" value="yes" <?php if (isset($remember) && in_array('yes', $remember)) echo "checked"; ?>>
    		<label for="remember">Remember me</label>
    		<input id="Submit" type="submit" name="submit" value="SIGN IN">
    	</form>
    </div>
</body>

</html>