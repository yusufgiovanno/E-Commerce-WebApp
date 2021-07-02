<!DOCTYPE html>
<html>
<head><meta http-equiv="Content-Type" content="text/html; charset=utf-8">
</head>
<body>
<?php
	$server = "localhost";
	$name = "root";
	$password = "";
	$db = "bioherba_db";

	$conn = mysqli_connect($server, $name, $password, $db);

	if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
	}
  ?>
</body>
</html>