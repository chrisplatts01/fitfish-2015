<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8" />
 	<title>Fitfish contact enquiry</title>
	<link rel="stylesheet" href="/_/css/main.css" />
</head>
<body style="background-image: none;">
<div id="page-content" style="padding: 20px;">
<h1 style="color:#265e80">Fitfish contact enquiry</h1>

<?php

	// Check for missing mandatory data
	$errors = "";
	foreach ( $_POST as $key=>$value ) {
		if ( (substr($key, -1) == '*') and ( empty($value) ) ) {
			$errors .= "<li>$key is required.</li>";
		}
	}

	if ( empty($errors)) {

		// Set email header variables
		$email_to      = "office@fit-fish.co.uk";
		$email_subject = "Fitfish contact enquiry";

		// Get submitted form data
		$name = $_POST["Name*"];
		$email_from = $_POST["Email*"];
		$message = "CONTACT FORM\n\nYou have received an enquiry.\nThe details are:\n\n";
		$message .= "----------------------------------------\n";
		foreach ($_POST as $key=>$value) {
			$message .= "$key = $value\n\n";
		}
		$message .= "----------------------------------------\n\n";

		// Validate the email address entered by the user
		if (!filter_var($email_from, FILTER_VALIDATE_EMAIL)) die("The email address entered is invalid.");

		// Set email headers
		$headers  = "From: " . $email_to . "\r\n";
		$headers .= "Reply-To: " . $email_from . "\r\n";
		// $headers .= "Cc: chris@virelai.co.uk\r\n";

		// Initialise the sendmail_from address
		ini_set("sendmail_from", $email_to);

		// Send the email - NOTE: The "-f" parameter is required on the Fasthosts
		$sent = mail($email_to, $email_subject, $message, $headers, "-f" . $email_to);

		// Email sent successfully
		if ($sent) {
			echo "<p>Thank you, Fitfish will be in contact soon. The following information was sent to us:</p>\n";

			echo "<ul>\n";
			foreach ($_POST as $key=>$value) {
				if ($key <> "Send") echo "<li><strong>$key:</strong> $value</li>\n";
			}
			echo "</ul>\n";
			echo '<p>Return to our <strong><a href="index.html">home page</a></strong></p>';
		}

		// Problem sending the email
		else {
			echo "<p>There has been an error sending your message. Please try later.</p>";
		}
	}

	// Mandatory fields missing
	else {
		echo "<p>Sorry the following errors were found:</p>";
		echo "<ul>$errors</ul>";
		echo "<p>Please <a href=\"contact.html\" onclick=\"history.go(-1);return false;\">go back</a> and enter the correct values.</p>";
	}

?>

<!-- Google Analytics -->
<script type="text/javascript">
  var _gaq = _gaq || [];
  _gaq.push(['_setAccount', 'UA-21699255-1']);
  _gaq.push(['_trackPageview']);

  (function() {
    var ga = document.createElement('script'); ga.type = 'text/javascript'; ga.async = true;
    ga.src = ('https:' == document.location.protocol ? 'https://ssl' : 'http://www') + '.google-analytics.com/ga.js';
    var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(ga, s);
  })();
</script>

<script>
  (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
  (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
  m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
  })(window,document,'script','//www.google-analytics.com/analytics.js','ga');

  ga('create', 'UA-50771900-1', 'auto');
  ga('send', 'pageview');
</script>

</body>
</html>
