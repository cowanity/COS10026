<!DOCTYPE html>
<html lang = "en">
<head>
  <meta charset="utf-8" />
  <meta name = "author" content = "Phan Vũ" />
  <meta name = "description" content = "Rohirrim Booking Form" />
  <meta name = "keywords" content = "HTML, PHP, CSS, Javascript" />
  <title>Booking Confirmation</title>
</head>
<body>
  <h1>Rohirrim Tour Booking Confirmation</h1>
  <?php
    function sanitise_input ($data) {
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
    }

    if (isset ($_POST["firstname"])) {
      $firstname = $_POST["firstname"];
    }
    else {
      header ("location: register.html"); 
    }

    if (isset ($_POST["lastname"])) { 
      $lastname = $_POST["lastname"];
    }
    
    if (isset ($_POST["age"])) { 
      $age = $_POST["age"];
    }
    
    if (isset ($_POST["food"])) { 
      $food = $_POST["food"];
    }
    
    if (isset ($_POST["partySize"])) { 
      $partySize = $_POST["partySize"];
    }
    
    if (isset ($_POST["species"]))
      $species = $_POST["species"];
    else
      $species = "Unknown species";

    $tour = "";
    if (isset ($_POST["1day"])) $tour = $tour. "One-day tour ";
    if (isset ($_POST["4day"])) $tour = $tour. "Four-day tour";

    $firstname = sanitise_input($firstname);
    $lastname = sanitise_input($lastname);
    $species = sanitise_input($species);
    $age = sanitise_input($age);
    $food = sanitise_input($food);
    $partySize = sanitise_input($partySize);

    $errMsg = "";

    if ($firstname=="") {
      $errMsg .= "<p>You must enter your first name.</p>";
    }
    else if (!preg_match("/^[a-zA-Z]*$/",$firstname)) {
      $errMsg .= "<p>Only alpha letters allowed in your first name.</p>";
    }

    if ($lastname=="") {
      $errMsg .= "<p>Error: Last name cannot be empty</p>";
    } 
    elseif (!preg_match('/^[a-zA-Z\-]*$/', $lastname)) {
      $errMsg .= "<p>Error: Last name must consist of only alphabetical characters or a hyphen</p>";
    }

    if (!is_numeric($age) || $age < 10 || $age > 10000) {
      $errMsg .= "<p>Error: Age must be a number between 10 and 10,000</p>";
    }

    if ($errMsg != ""){
      echo "<p>$errMsg</p>";
    }
    else {
    echo "<p>Welcome <em>$firstname $lastname</em>! You are now booked on the <em>$tour</em>.<br>
    Species: <em>$species</em><br>
    Age: <em>$age</em><br>
    Meal Preference: <em>$food</em><br>
    Number of travellers: <em>$partySize</em></p>";
    }
  ?>
</body>
