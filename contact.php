<?php 
	$name = $_GET['name'];
	$email = $_GET['email'];
	$message = $_GET['message'];
	$formcontent="From: $name \n Message: $message";
	$recipient = "mrrvm@hotmail.com";
	$subject = "Contact from website";
	$mailheader = "From: $email \r\n";
	mail($recipient, $subject, $formcontent, $mailheader) or die("Error!");
	echo "Thank You!";
?>