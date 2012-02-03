<?php session_start('test'); 
/* loguit die de sessie vernietigd die bij het inloggen wordt aangemaakt. */
?>
<!DOCTYPE html PUBLIC "-//W3C/DTD XHTML 1.1//EN"
	"http://www.w3.org/ter/xhtml11/DTD/xhtml11.dtd">
<html>
	<head>
		<link rel="stylesheet" type="text/css" href="stylesheet.css">
		<title>
			<?php include 'forumname.php'; ?>
		</title>
	</head>
	<body>
		<div class="container">
			<div class="header">
				<?php include 'header.php'; ?>
			</div>
			<div class="menu">
				<?php include 'menu.php'; ?>
			</div>
			<div class="slidemenu">
				<?php include 'slidemenu.php';?>
			</div>
			<div class="center">
				<?php
					// Als sessie bestaat.
					if (!empty($_SESSION['loggedIn']))
					{
						// Vernietig sessie test.
						if (session_destroy());
						{
							// Prompt gebruiker.
							echo "Sucessfully logged out, you will now be redirected!";
							
							// Redirect.
							header("refresh: 1; index.php");
						}
					}
				?>
			</div>
			<div class="footer">
				&#169; 2012 <?php include 'forumname.php'; ?> 
			</div>
		</div>
	</body>
</html>