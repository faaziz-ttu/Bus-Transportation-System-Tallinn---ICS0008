<?php 
ob_start();
include('header.php');
include_once("db_connect.php");
session_start();
if(isset($_SESSION['user_id'])!="") {
	header("Location: index.php");
}
if (isset($_POST['login'])) {
	$email = mysqli_real_escape_string($conn, $_POST['email']);
	$password = mysqli_real_escape_string($conn, $_POST['password']);
	$result = mysqli_query($conn, "SELECT * FROM users WHERE email = '" . $email. "' and pass = '" . md5($password). "'");
	if ($row = mysqli_fetch_array($result)) {
		$_SESSION['user_id'] = $row['uid'];
		$_SESSION['user_name'] = $row['user'];		
		header("Location: transportation.php");
	} else {
		$error_message = "Incorrect Email or Password!!!";
	}
}
function CheckAccess()
{
	$result = (isset($_SERVER['PHP_AUTH_USER']) &&
		$_SERVER['PHP_AUTH_USER'] == 'user_id' &&
		$_SERVER['PHP_AUTH_PW'] == 'user_name');

	if (!$result)
	{
		header('WWW-Authenticate: Basic realm="Test restricted area"');
		header('HTTP/1.0 401 Unauthorized');
		return false;
	}
	else
		return true;
}
CheckAccess();
?>
<title>login</title>
<script type="text/javascript" src="script/ajax.js"></script>

<div class="container">
	<h2>Bus Transportation Login</h2>		
	<div class="row">
		
			<form role="form" action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post" name="loginform">
				<fieldset>
					<legend>Login</legend>						
					<div class="form-group">
						<label for="name">Email</label>
						<input type="text" name="email" placeholder="Your Email" required class="form-control" />
					</div>	
					<div class="form-group">
						<label for="name">Password</label>
						<input type="password" name="password" placeholder="Your Password" required class="form-control" />
					
					<div class="form-group">
						<input type="submit" name="login" value="Login" class="btn btn-primary" />
					</div>
				</fieldset>
			</form>
			<span class="text-danger"><?php if (isset($error_message)) { echo $error_message; } ?></span>
		</div>
	</div>
	<div class="row">
		New User? <a href="register.php">Sign Up Here</a>
		
	</div>
		
		
</div>
<?php include('footer.php');?> 