<?php

	if(isset($_GET["uid"])){
		$id = $_GET["uid"];
	}
?>


<!DOCTYPE html>
<html>
<head>
	<title>View profile</title>
</head>
<body>
	<p><?php echo $id ?></p>
</body>
</html>