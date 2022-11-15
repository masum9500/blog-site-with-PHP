<?php include"inc/header.php"?>
<?php
			if ($_SERVER['REQUEST_METHOD'] == 'POST') {
				$fname = $fm->validation($_POST['firstname']);
				$lname = $fm->validation($_POST['lastname']);
				$email = $fm->validation($_POST['email']);
				$body = $fm->validation($_POST['body']);


				$fname = mysqli_real_escape_string($db->link, $fname);
				$lname = mysqli_real_escape_string($db->link, $lname);
				$email = mysqli_real_escape_string($db->link, $email);
				$body = mysqli_real_escape_string($db->link, $body);

/*
				$errorf = "";
				$errorl = "";
				$errore = "";
				$errorb = "";
				if (empty($fname)) {
					$errorf = "First name must not be empty !"; 
				}
				if (empty($lname)) {
					$errorl = "Last name must not be empty !";
				}
				if (empty($email)) {
					$errore = "Email name must not be empty !";
				}
				if (empty($body)) { 
					$errorb = "Message fild must not be empty !";*/

			$error = "";
				if (empty($fname)) {
					$error = "First name must not be empty !"; 
				}elseif (empty($lname)) {
					$error = "Last name must not be empty !";
				}elseif (empty($email)) {
					$error = "Email name must not be empty !";
				}elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
					$error = "Invalid  Email! !";
				}elseif (empty($body)) { 
					$error = "Message fild must not be empty !";


					
				}else{
					$query = "INSERT INTO tbl_contact (firstname, lastname, email, body) 
                    VALUES('$fname', '$lname', '$email', '$body')";

                    $inserted_rows = $db->insert($query);
                    if ($inserted_rows) {
                         $msg = "Message  sent Successfully";
                    }else {
                        $error = "Message not sent";
                    }
				}
			}
?>
<style>
	.ermsg{ color: red; float: left; }
</style>
	<div class="contentsection contemplete clear">
		<div class="maincontent clear">
			<div class="about">
				<h2>Contact us</h2>
				<?php 
				
				if (isset($error)) {
					echo "<span style='color: red'>$error</span>";
				}
				if(isset($msg)){
					echo "<span style='color: Green'>$msg</span>";
				}
				?>
			<form action="" method="post">
				<table>
				<tr>
					<td>First Name:</td>
					<td>
					<?php
					/*if (isset($errorf)) {
					echo "<span class='ermsg'>$errorf</span>";
					}*/
					?>
					<input type="text" name="firstname" placeholder="Enter first name"/>
					</td>
				</tr>
				<tr>
					<td>Last Name:</td>
					<td>
					<?php
					/*if (isset($errorl)) {
					echo "<span class='ermsg'>$errorl</span>";
					}*/
					?>
					<input type="text" name="lastname" placeholder="Enter Last name" />
					</td>
				</tr>
				
				<tr>
					<td>Email Address:</td>
					<td>
					<?php
					/*if (isset($errore)) {
					echo "<span class='ermsg'>$errore</span>";
					}*/
					?>
					<input type="email" name="email" placeholder="Enter Email Address" />
					</td>
				</tr>
				<tr>
					<td>Your Message:</td>
					<td>
					<?php
					/*if (isset($errorb)) {
					echo "<span class='ermsg'>$errorb</span>";
					}*/
					?>
					<textarea name="body"></textarea>
					</td>
				</tr>
				<tr>
					<td></td>
					<td>
					<input type="submit" name="submit" value="Send"/>
					</td>
				</tr>
		</table>
	<form>				
 </div>
</div>

<?php include"inc/sidebar.php"?>			
<?php include"inc/footer.php"?>
