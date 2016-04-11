<?php


//receive all the variables from the post array
if ($_SERVER["REQUEST_METHOD"] == "POST" ){
	$name = trim($_POST["name"]);
	$email = trim($_POST['email']);
	$message = trim($_POST["message"]);

//standard validation that make sure the attirbutes field have a value

  if ($name == "" || $email == "" || $message == ""){
    $error_message = "You must specify a value for name and email address and message";
  }

//security validation to make to make sure that a spammer bot is not hijacking our form to send spam to other people
 if(!isset($error_message)){
	 foreach($_POST as $value){
		if(stripos($value,'Content-Type:') !== FALSE){
		    $error_message =  "There was a problem with the information you entered.";
		}
	  }
 }
  
  //security validation uses spam honeypot technique to make sure that the address field is blank
  
  if(!isset($error_message) && $_POST["address"] != ""){
  	$error_message =  "Your form submission has an error";
  }
  
  //create a php mailer object. Next time will use PHPMailerAutoload object
  require_once('vendor/phpmailer/phpmailer/class.phpmailer.php');
  $mail = new PHPMailer();
  
  //checks if email address is not valid
  if(!isset($error_message) && !$mail->validateAddress($email)){
  	$error_message = "You must specify a valid email address";
  }
  
  
  //check if variable error message is set
  
  if(!isset($error_message)){
	
  
    //here we have stored the email body into a variable
    /*
    We need to modify the email body to include html tags. 
    Since its a html email we'll need  html break tags for the hard returns
    
    */
	$email_body = "";
	$email_body = $email_body .  "Name: " . $name . "<br>";
	$email_body = $email_body . "Email: " . $email . "<br>";
	$email_body = $email_body . "Message: " . $message . "<br>";

	//this chunk works with sending the email
	
	/*
	these two lines below deal with defining the body of the email the example loads it from a html file 
	However we already have the body of the email stored in the variable email body so we can remove these lines
	
	$body = file_get_contents('contents.html');
	$body = ergei_replace("[\]",'',$body);
	*/
	
	/*
	this line calls a method in our mail object.
	when this phpmailer object sends an email to us, the email can have one or more replyTo names and addresses
	this method adds a new replyTo name and address to the email. we will want to be able to reply to the person
	who fills out the form so lets set this to their name and address.
	
	Simply put place the contactee persons email address and name here
	
	If we think about it we don't need a reply to email address, by default email clients will reply to the "from" address
	which will work just fine for us.
	
	$mail->AddReplyTo($email, $name);
	
	*/
	
	
	/*
	 This next line of code calls another method.
	 When the object sends us an email, that email will have exactly one name and one address in the "from" field.
	 Calling this method will set that. The email will be coming to us from the person who filled out the form. So here
	 we set the "from" name and address to values submitted to the form.
	*/
	
	$mail->SetFrom($email,$name);
	
	/*
	This next line of code calls another method.
	It look like it adds the name and address of a reciepient, in our case the email should go to mike (or me for testing)
	
	We can use static values instead of variables here because these values won't change from form submission to form submission
	
	*/
	$address = "mayurpandeuk@gmail.com";
	$mail->AddAddress($address,"Shirts 4 Mike");
	
	/*
	When this phpmailer object sends out an email it will have a subject.
	This line of code references one of the objects properties related to that.
	Method names like function names always have paraentheses after them for the argument list.
	Properties on the other hand are like variables, you assign them a value with a single equals sign just like a variable.
	
	We have concatenated the contactee name using the name variable because it will be useful in emails so that it doesn't keep loads of 
	different emails in one conversation.
	*/
	$mail->Subject = "Shirts 4 Mike Contact Form Submission | " . $name;
	
	/*
	This next line assigns another value to a property.
	It is alternate content for clients that cannot read html, this is optional, hence why commented out
	
	$mail-> AltBody = "To view the message, please use an HTML compatible email viewer";
	
	*/
	
	/*
	This line calls another method which sets the body of the email, we have the body of the email stored in a variable named $email_body
	so let's set that now.
	
	*/
	
	$mail->MsgHTML($email_body);
	
	/*
	These two lines call a method for adding attachments to the email.
	In this case we don't need any so have removed them
	
	$mail->AddAttachement("images/phpmailer.gif");
	$mail->AddAttachement("images/phpmailer_mini.gif"); 
	*/
	
	
	/*
	Now the object is all set up and we are ready to send the email
	This last block of code does that by calling the objects send method
	It may look strange as it calls the method within a conditional, 
	PHP calls this send() method which should send the email using all the properties we set upo earlier, the send method returns a value of true
	or false, true if sent and false if it didn't send. Then we write a conditional using the negation operator that checks return value like so below, 
	if it do not work (email was not sent successfully). The rest of the code echoes different messages depending on whether or not the email was sent, 
	
	*/
	
	//checks if mail sent
	if($mail->Send()){
		header("Location: contact.php?status=thanks");
                exit;
	}else{

	//if not true (sent mail) print this
		$error_message =  "There was a problem sending the email " . $mail->ErrorInfo;
	//if not sent we want to exit page from processing
	}
	

	
    }
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
 
	
		 <?php 
			if(!isset($error_message)){
			     echo '<p>I&rsquo;d love to hear from you! Complete the form to send me an email.</p>';
			}else{
			     echo '<p class="message">' . $error_message . '</p>';
			} 
		?>

		  <form method="post" action="contact.php">
		
			<table>
				<tr>
				  <th>
				    <label for="name">Name: </label>
				  </th>
				  <td>
				    <input type="text" name="name" id="name" value="<?php if(isset($name)) {echo htmlspecialchars($name);} ?>">
				  </td>
				</tr>
				<tr>
				  <th>
				    <label for="email">Email: </label>
				  </th>
				  <td>
				    <input type="text" name="email" id="email" value= "<?php if(isset($email)) {echo htmlspecialchars($email);} ?>">
				  </td>
				</tr>
				<tr>
				  <th>
				    <label for="message">Message: </label>
				  </th>
				  <td>
				    <textarea name="message" id="message" placeholder="Please type your message here..."><?php if(isset($message)) {echo htmlspecialchars($message);} ?></textarea>
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

