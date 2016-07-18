<!DOCTYPE html>
<html>

<head>

    <link rel="stylesheet" type="text/css" href="style.css">
	<link rel="stylesheet" type="text/css" href="receive_feedback.css">
	
	<link rel="icon" href="http://files.softicons.com/download/application-icons/circle-icons-by-martz90/png/256x256/email.png">
	<meta charset="UTF-8">
    <title>Thanks!</title>
	
</head>

<body>
    <div id="menu">
	    <img id="logo" alt="atom" src="http://animations.fg-a.com/atom_004rd.gif"> 
	    <a class="menu-item" href="rating.php">Rating</a>
		<a class="menu-item" href="default.php">Vote</a>
		<a class="menu-item" href="about.php">About</a>
		<a class="menu-item" href="feedback.php">Contact us</a>
	</div>

<?php

function test_input($data) {
  $data = trim($data);
  $data = stripslashes($data);
  $data = htmlspecialchars($data);
  return $data;
}

require 'parts/DB_connect.php';

$firstname_tested = test_input($_POST['firstname']); $firstname = substr($firstname_tested, 0, 30);
$lastname_tested = test_input($_POST['lastname']);   $lastname = substr($lastname_tested, 0, 30);
$email_tested = test_input($_POST['e-mail']);  $email = substr($email_tested, 0, 30);
$msg_tested = test_input($_POST['message']);   $msg = substr($msg_tested, 0, 1000);
$ip = $_SERVER['REMOTE_ADDR'];
$hostname = $_SERVER['REMOTE_HOST'];


$sql = "INSERT INTO feedback(firstname, lastname, email, comment, REMOTE_ADDR, REMOTE_HOST)";
$sql = $sql . " VALUES('$firstname', '$lastname', '$email', '$msg', '$ip', '$hostname')";
if ($conn->query($sql) === TRUE) 
{
    //echo "New record created successfully";
} else 
{
    //echo "Error: " . $sql . "<br>" . $conn->error;
}

$conn->close();
?> 
    <div id="gratitude">
        <h1>Thanks</h1>
        <p >Thank you for your efforts. We'll try to contact you as soon as possible.</p>
    </div>
	
	
	<?php
	    require 'parts/lower_bar.php';
	?>
	
</body>


</html>


<script>
    load_back();
</script>