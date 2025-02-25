<!DOCTYPE html>
<html>
	<head>
		<title> PHP Programming Language </title>
	</head>
	<body>
		<?php
			function CalAverageMark ($mark1, $mark2, $mark3)
			{
				echo "Mark 1 : $mark1 <br>";
				echo "Mark 2 : $mark2 <br>";
				echo "Mark 3 : $mark3 <br>";
				$avarageMark = ($mark1 + $mark2 + $mark3)/3;
				return $avarageMark;
			}
			$AvgMark = CalAverageMark(7, 8.5, 9);
			echo "The average mark is: $aAvgMark";

			echo "<hr>";
			$CourseDesc = "This course you will learn Html, PHP, MySQL and ...";
			$CourseDesc = str_replace("...", "Web Inquiry Project", $CourseDesc);
			echo "<p> $CourseDesc </p>";

			echo "<hr>";
			$str1 = "This is some <b>bold1</b> text.";
			echo $str1."<br>";
			$str2 = htmlspecialchars("This is some <b>bold2</body> text.");
			echo $str2."<br>";
			?>
	</body>
</html>