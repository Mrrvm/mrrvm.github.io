<?php 
// Code partialy taken from:
// http://blog.teamtreehouse.com/create-ajax-contact-form
	
	// Only process POST requests
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        // Get the form fields and remove whitespace
        $name = strip_tags(trim($_POST["name"]));
		$name = str_replace(array("\r","\n"),array(" "," "),$name);
        $email = filter_var(trim($_POST["email"]), FILTER_SANITIZE_EMAIL);
        $message = trim($_POST["message"]);

        // Check if the fields are correct
        if (empty($name) OR empty($message) OR !filter_var($email, FILTER_VALIDATE_EMAIL)) {
            // 400 (bad request) response code and exit
            http_response_code(400);
            echo "Oops! There was a problem with your submission. Please complete the form and try again.";
            exit;
        }

        if(!checkdnsrr(array_pop(explode("@",$email)),"MX")) {
            // 400 (bad request) response code and exit
            http_response_code(400);
            echo "Oops! There was a problem with your submission. Please enter a valid email.";
            exit;
        }

        $content = "Name: $name\n";
        $content .= "Email: $email\n\n";
        $content .= "Message:\n$message\n";
        $headers = "From: $name <$email>";
        $recipient = "mrrvm@hotmail.com";
        $subject = "New contact from $name";

        if (mail($recipient, $subject, $content, $headers)) {
            // 200 (okay) response code
            http_response_code(200);
            echo "Thank You! Your message has been sent.";
        } 
        else {
            // 500 (internal server error) response code
            http_response_code(500);
            echo "Oops! Something went wrong and we couldn't send your message.";
        }

    } 
    else {
        // Not a POST request, 403 (forbidden) response code
        http_response_code(403);
        echo "There was a problem with your submission, please try again.";
    }
?>