<?php 
session_start();
include('header.php');
include_once("db_connect.php");
?>

<div class="container">
	<h2>Bus Transportation Login and Registration Page </h2>	
		
		<br>
		<br>
		<div class="topnav" id="navbar1">
			<ul">
				<?php if (isset($_SESSION['user_id'])) { ?>
				<li><p class="navbar-text"><strong>Welcome!</strong> You're signed in as <strong><?php echo $_SESSION['user_name']; ?></strong></p></li>
				<li><a href="logout.php">Log Out</a></li>
				<li><a href="transportation.php">Visit Transportation Map of Tallinn</a></li>
				<?php } else { ?>
				<a href="login.php">Login</a>
				<a href="register.php">Sign Up</a>
				<?php } ?>
			</ul>
		</div>
		
		
		
		
</div>	
<?php include('footer.php');?> 