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
	$marks = array(85, 85, 95);
	$marks[1] = 90;
	$ave = ($marks[0] + $marks[1] + $marks[2])/3;
	if($ave >= 50)
		$status = "PASSED";
	else
		$status = "FAILED";
	echo "<p>The average score is $ave. You $status.</p>";
?>

</body>
</html>
