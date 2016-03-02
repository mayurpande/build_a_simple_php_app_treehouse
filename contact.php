<?php 
$pageTitle = "Contact Mike";
$section = "contact";
include ('inc/header.php'); 
?>


	<div class ="section page">

	   <div class ="wrapper">		
		<h1>Contact</h1>
	   </div>
	   
           <p>I&rsquo;d love to hear from you! Complete the form to send me an email.</p>
	
	   <form method="post" action="contact-process.php">
		
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
		
		</table>
		<input type="submit" value="SEND" />
	   
	   </form>
	

	</div>

<?php include ('inc/footer.php'); ?>

