<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<meta name="description" content="Creating Web Applications Lab 10" />
	<meta name="keywords" content="PHP, MySql" />
	<title>Retrieving records to HTML</title>
</head>
<body>
	<h1>Creating Web Applications - Lab10</h1>
	<?php
		require_once ("settings.php");

		$conn = @mysqli_connect($host,
			$user,
			$pwd,
			$sql_db
		);
		if (!$conn) {
			echo "<p>Database connection failure</p>";
		} else {
			$sql_table= "cars";
			$make = trim($_POST['carmake']);
			$model = trim($_POST['carmodel']);
			$price = trim($_POST['price']);
			$yom = trim($_POST['yom']);
			$query = "insert into $sql_table (make, model, price, yom) values ('$make', '$model', '$price', '$yom')";
			$result = mysqli_query($conn,$query);
			if (!$result) {
				echo "<p>Something is wrong with ", $query, "</p>";

		} else {
			echo "<p class=\"ok\">Successfully added New Car record</p>";
		
		mysqli_close($conn);
		}
	}
?>