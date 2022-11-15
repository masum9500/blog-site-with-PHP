<?php 
include"../lib/Seassion.php";
Seassion::checkLogin();

?>
<?php include"../config/config.php";?>
<?php include"../lib/Database.php";?>
<?php include"../helpers/Format.php";?>

<?php 
$db = new Database();
$fm = new Format();
?>
<!DOCTYPE html>
<head>
<meta charset="utf-8">
<title>Login</title>
    <link rel="stylesheet" type="text/css" href="css/stylelogin.css" media="screen" />
</head>
<body>
<div class="container">
	<section id="content">
		<?php
			if ($_SERVER['REQUEST_METHOD'] == 'POST') {
				$email = $fm->validation($_POST['email']);
				$email = mysqli_real_escape_string($db->link, $email);
				if (!filter_var($email,FILTER_VALIDATE_EMAIL)) {
					echo "<span style='color: red;font-size: 18px'>Invalid Email Address !</span>";
				}else{

				$mailquery = "SELECT * FROM tbl_user WHERE email='$email' LIMIT 1";
      		    $mailcheck = $db->select($mailquery);
				if ($mailcheck != false) {
						while ($value = $mailcheck->fetch_assoc()) {
							$userid = $value['id'];
							$username = $value['username'];
						}
					$text       = substr($email, 0, 3);
					$rand       = rand(10000, 99999);
					$newpass    = "$text$rand";
					$password   = md5($newpass);
					$query      = "UPDATE  tbl_user SET password='$password' WHERE id = $userid ";
	                $update_row = $db->update($query);

	                $to      = '$email';
	                $from    = 'masumbillah7286@gmail.com';
					$subject = 'Your Password';
					$message = 'Your User Name is<br>'.$username.'Password is'.$newpass.'Please Visit Website to login.';
					$headers = 'From: $from' . "\r\n" .
					    'Reply-To: $from' . "\r\n" .
					    'X-Mailer: PHP/' . phpversion();

					$sendmail = mail($to, $subject, $message, $headers);
					if ($sendmail) {
						echo "<span style='color: green;font-size: 18px'>Check Your Email. </span>";
					}else{
						echo "<span style='color: red;font-size: 18px'>Mail Not sent!!! </span>";
					}
				}else{
					echo "<span style='color: red;font-size: 18px'>Email not matched!!! </span>";
				}
			}
		}
		?>
		<form action="" method="post">
			<h1>Admin Login</h1>
			<div>
				<input type="text" placeholder="Enter Email" required="" name="email"/>
			</div>
			
			<div>
				<input type="submit" value="Send mail" />
			</div>
		</form><!-- form -->
		<div class="button">
			<a href="login.php">Log Ind</a>
		</div><!-- button -->
		<div class="button">
			<a href="#">Training with live project</a>
		</div><!-- button -->
	</section><!-- content -->
</div><!-- container -->
</body>
</html>