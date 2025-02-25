<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<meta name="description" content="Creating Web Applications Lab 10" />
	<meta name="keywords" content="PHP, MySql" />
	<title>Retrieving records to HTML</title>
</head>
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
$make = $_POST['make'];
$model = $_POST['model'];
$price = $_POST['price'];
$yom = $_POST['yom'];

$sql = "SELECT * FROM cars WHERE make LIKE '%$make%' AND model LIKE '%$model%' AND price LIKE '%$price%' AND yom LIKE '%$yom%'";
$result = mysqli_query($conn, $sql);


if (mysqli_num_rows($result) > 0) {
	echo "<p>There are ".mysqli_num_rows($result)." results found</p>";
	echo "<table border=\"1\">\n";
	echo "<tr><th>Make</th><th>Model</th><th>Price</th><th>Yom</th></tr>";
	while ($row = mysqli_fetch_assoc($result)) {
		echo "<tr><td>".$row['make']."</td><td>".$row['model']."</td><td>".$row['price']."</td><td>".$row['yom']."</td></tr>";
	}
	echo "</table>";
} else {
	echo "No matching records found.";
}
}

mysqli_close($conn);
?>
