<?php
	require_once('../db/db.php');
	$conn = dbConnection();
	if(!$conn){
		echo "DB connection error";
	}

	$name = $_POST['name'];
	$email = $_POST['email'];
	$pass = $_POST['pass'];
    $uType = $_POST['uType'];

    if (isset($_POST['name'])) {
        $name = strtolower(trim($_POST['name']));
        if ($name == '') {
            $nameErr = 'Name can not be empty';
        } else {
        	if(str_word_count($name) > 1) {
	            if (ctype_alpha($name[0])) {
	                if (!validateName($name)) {
	                    $nameErr = 'Name must contain a-z, A-Z, dot(.) or dash(-)';
	                }
	            } else {
	                $nameErr = 'Name must start with a letter';
	            }
	        } else {
	            $nameErr = 'Name can not be less than two words';
	        }
        }
    } else {
        $nameErr = 'Name is required';
    }

    if (isset($_POST['pass'])) {
        $pass = $_POST['pass'];
        if ($pass == '') {
            $passErr = 'Password can not be empty';
        } else {
        	if(strlen($pass) <= 6) {
        		$passErr = "Password can't be less than 6 characters";
        	}
        }
    } else {
        $passErr = 'Password is required';
    }

    if (isset($_POST['uType'])) {
        $uType = $_POST['uType'];
        if ($uType == '') {
            $uTypeErr = 'User type can not be empty';
        }
    } else {
        $uTypeErr = 'User Type is required';
    }

    if (isset($_POST['email'])) {
        $email = trim($_POST['email']);
        if (!$email == '') {
            if (substr_count($email, ' ') == 0) {
                if (substr_count($email, '@') == 0) {
                    $emailErr = 'Email must have "@"';
                } else if (substr_count($email, '@') == 1) {
                    if (strpos($email, '@') != 0) {
                        if (substr_count($email, '.') != 0) {
                            $atpos = strpos($email, '@');
                            $domainPart = substr($email, $atpos + 1);

                            $dotpos = strrpos($domainPart, '.');
                            $domainExt = substr($domainPart, $dotpos + 1);
                            $domainName = str_replace('.' . $domainExt, "", $domainPart);
                            if (strlen($domainName) > 0 && validateDomainName($domainName)) {
                                if (strlen($domainExt) > 1 && validateDomainExt($domainExt)) {

                                } else {
                                    $emailErr = 'Email must have more than 1 letter and letters only after last ".", should not start with number.';
                                }
                            } else {
                                $emailErr = 'Email can only have dot(.), dash(-), chracters and numbers between "@" and last "." with no adjacent "@" or "."';
                            }
                        } else {
                            $emailErr = 'Email must have "."';
                        }
                    } else {
                        $emailErr = 'Email can not start with "@"';
                    }                   
                } else {
                    $emailErr = 'Email can not have multiple "@"';
                } 
            } else {
                $emailErr = 'Email can not have spaces';
            }
        } else {
            $emailErr = 'Email can not be empty';
        }
    } else {
        $emailErr = 'Email is required';
    }


    $sql = "SELECT email from users where email = '".$email."'";
    if (($result = $conn->query($sql)) !== FALSE)
    {
        while($row = $result->fetch_assoc())
        {
            $emailErr = "Email is taken";
        }
    }

    if (isset($nameErr) || isset($emailErr) || isset($passErr) || isset($uTypeErr)) {
    	echo "not ok";
    } else {
        if($uType == 'Seller'){
            $uType = '0';
        } else if($uType == 'Buyer'){
            $uType = '1';
        } else if($uType == 'Dealer'){
            $uType = '2';
        } else {
            $uType = '';
        }
    	if(($name != '') && ($email != '') && ($pass != '') && ($uType != '')){
			$sql = "INSERT INTO users (name, email, pass, admin) VALUES ('". $name ."', '". $email ."', '". $pass ."', '". $uType ."');";
			if ($conn->query($sql) === TRUE) {
				echo "insert";
			} else {
				echo "not ok";
			}
		} else {
			echo "not ok";
		}
    } 

    function validateName($string) {
            $array = str_split($string);
            foreach ($array as $value) {
                if ($value == '.' || $value == '-' || $value == ' ' || ctype_alpha($value)) {
                    continue;
                } else {
                    return false;
                }
            }
            return true;
        }         

    function validateDomainName($string) {
        foreach (explode(".", $string) as $part) {
            if ($part == '') {
                return false;
            }
        }
        $array = str_split($string);
        foreach ($array as $value) {
            if ($value == '-' || $value == '.' || is_numeric($value) || ctype_alpha($value)) {
                continue;
            } else {
                return false;
            }
        }
        return true;
    }

    function validateDomainExt($string) {
        if (is_numeric($string[0])) {
            return false;
        }
        $array = str_split($string);
        foreach ($array as $value) {
            if (is_numeric($value) || ctype_alpha($value)) {
                continue;
            } else {
                return false;
            }
        }
        return true;
    }
?>