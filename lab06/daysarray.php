<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8" />
  	<meta name="description" content="PHP Data Types and Operators"/>
  	<meta name="keywords" content="HTML, CSS, PHP" />
  	<meta name="author" content="Phan Vũ"  />
	<title>Using PHP Variable, arrays and operators </title>
</head>
<body>
	<h1>PHP Variables, arrays and operators</h1>
<?php
	// Initialize the $days array with the days of the week in English
$days = array("Sunday", "Monday", "Tuesday", "Wednesday", "Thursday", "Friday", "Saturday");

// Display the English days of the week
echo "The days of the week in English are: <br>";
foreach ($days as $day) {
    echo $day . "&#44; &nbsp;";
}

$jours = array("Dimanche", "Lundi", "Mardi", "Mercredi", "Jeudi", "Vendredi", "Samedi");

// Display the French days of the week
echo "<br><br>The days of the week in French are: <br>";
foreach ($jours as $jour) {
    echo $jour . "&#44; &nbsp;";
}
?>

</body>
</html>