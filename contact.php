<?php
require_once('vendor/phpmailer/phpmailer/class.phpmailer.php');

if ($_SERVER["REQUEST_METHOD"] == "POST" ){
	$name = trim($_POST["name"]);
	$email = trim($_POST['email']);
	$message = trim($_POST["message"]);

//conditional to check if attributes have values

  if ($name == "" || $email == "" || $message == ""){
    echo "You must specify a value for name and email address and message";
    exit;
	}

  foreach($_POST as $value){
  	if(stripos($value,'Content-Type:') !== FALSE){
  	    echo "There was a problem with the information you entered.";
  		exit;
  	}
  }
  
  if($_POST["address"] != ""){
  	echo "Your form submission has an error";
  	exit;
  }
  
  
  
  $mail = new PHPMailer();
  
  //checks if email address is not valid
  if(!$mail->validateAddress($email)){
  	echo "You must specify a valid email address";
  	exit;
  }
  
  

	$email_body = "";
	$email_body = $email_body .  "Name: " . $name . "\n";
	$email_body = $email_body . "Email: " . $email . "\n";
	$email_body = $email_body . "Message: " . $message . "\n";

	//TODO: Send Email

	header("Location: contact.php?status=thanks");
	exit;
}
?>
<?php 
$pageTitle = "Contact Mike";
$section = "contact";
include ('inc/header.php'); 
?>


	<div class ="section page">

	   <div class ="wrapper">		
		<h1>Contact</h1>
	   </div>

	  <?php if (isset($_GET["status"]) AND $_GET["status"] == "thanks") { ?>
          	<p>Thanks for the email! I&rsquo;ll be in touch shortly.</p>
	  <?php } else { ?>
 
		   <p>I&rsquo;d love to hear from you! Complete the form to send me an email.</p>
	
		   <form method="post" action="contact.php">
		
			<table>
				<tr>
				  <th>
				    <label for="name">Name: </label>
				  </th>
				  <td>
				    <input type="text" name="name" id="name">
				  </td>
				</tr>
				<tr>
				  <th>
				    <label for="email">Email: </label>
				  </th>
				  <td>
				    <input type="text" name="email" id="email">
				  </td>
				</tr>
				<tr>
				  <th>
				    <label for="message">Message: </label>
				  </th>
				  <td>
				    <textarea name="message" id="message">Please type message here...</textarea>
				  </td>
				</tr>
		        <tr style="display: none;">
				  <th>
				    <label for="address">Address: </label>
				  </th>
				  <td>
				    <input type="text" name="address" id="address">
				    <p>Humans (and frogs): please leave this field blank.</p>
				  </td>
				</tr>
		        
			</table>
			<input type="submit" value="SEND" />
		   
		   </form>
	 <?php } ?>

	</div>

<?php include ('inc/footer.php'); ?>

