<!DOCTYPE html PUBLIC "-//W3C/DTD XHTML 1.1//EN"
	"http://www.w3.org/ter/xhtml11/DTD/xhtml11.dtd">

<html>

	<head>
		<link rel="stylesheet" type="text/css" href="stylesheet.css">
		<title>
			Patriciaat Forum
		</title>
	</head>

	<body>
		<div class="container">




			<div class="header">
			<A HREF="home.html">Het Patriciaat Forum</A>
			</div>

			<div class="menu">

				<?php include 'menu.php' ?>

			</div>
			
			
			<div class="slidemenu">

				 <div class="forum">
				 	Forum
				 </div>
				 <div class="categorie">
				 	<br />
				 	 &#8627; Categorie
				 </div>
				 <div class="thread">
				 	 &#8627; Thread
				 </div>
				 <div class="reactie">
				 	 &#8627; Reactie
				 </div>
			</div>
			
			<div class="center">
				<?php 
					// Laadt database login.
					include 'dblogin.php';
					// TODO iets doen zodat als pagina geladen zonder de maketopic.php
					// en dan hij dan niets in de db zet.
					
					// Variabelen uit maketopic.php form.
					// Stript van tags met behulp van strip_tags();
					$postTitle = strip_tags($_POST["topicname"]);
					$postContent = strip_tags($_POST["content"]);
					
					// Start sessie.
					session_start();
					
					// Haal gebruikersnaam uit sessie.
					$username = $_SESSION['username'];
					
					// Haal user ID uit sessie.
					$userID = $_SESSION['userID'];
					
					// Verkrijgt catagorie_id.
					$catagory = $_GET['cat'];
					
					// Laadt catagorie approval.
					$approval = mysql_query("SELECT approval FROM catagories where id = '$catagory'") or die (mysql_error());
					$approval = mysql_fetch_array($approval);
					
					// Prompt gebruiker.
					echo "Thank you for your submission. <br />";
					
					// Prompt approval.
					if ($approval['approval'] == 0)
						echo "Your post is pending approval.<br />";
					else
						echo "Your post has been approved.<br />";
					
					// Checkt of er een nieuw draad aangemaakt wordt of het een reply is.
					$checkThread = strip_tags($_GET["topic"]);
					
					if ($checkThread === "y")
					{
						// Berekent nieuwe post id op basis van max in tabel.
						$getPost_id = mysql_query("SELECT MAX(post_id) as post_id FROM topics") or die (mysql_error());
						$row = mysql_fetch_array($getPost_id);
						$newPost_id = $row['post_id'] + 1;
					} 
					else
					{
						// Set post_id naar die van uit de GET van de url.
						$newPost_id = strip_tags($_GET["id"]);
					}
					echo "Click <a href= draadje.php?topicid=".$newPost_id."&cat=".$catagory."> here </a> to visit your submission.";
					
					// Prompt gebruiker.
					echo "<hr />";
					
					// Pompt titel van post.
					echo "<br />Title: ".$postTitle."<br />";
					
					//Prompt catagorie naam.
					$catagoryName = mysql_query("SELECT name FROM catagories WHERE id = '$catagory'") or die (mysql_error());
					$catagoryName = mysql_fetch_array($catagoryName);
					$catagoryName = $catagoryName['name'];
					echo "Catagory: ".$catagoryName."<br />";
					
					// Prompt userid.
					echo "UserID: ".$userID."<br />";
					
					// Prompt username.
					echo "Username: ".$username."<br />";
					
					// Prompt postID.
					echo "PostID: ".$newPost_id."<br />";
					
					// Prompt content
					echo "<br />Content: ".$postContent."<br />";
					
					// Mysql query.
					mysql_query("INSERT INTO `webdb1236`.`topics`
					(approved, 
					posttitle, 
					postcontent, 
					post_id, 
					catagorie_id, 
					user_id, 
					starttime)
					VALUES ('$approval', 
					'$postTitle', 
					'$postContent', 
					'$newPost_id', 
					'$catagory', 
					'$userID', 
					CURRENT_TIMESTAMP)") or die (mysql_error());
					
					// Connectie met databse afsluiten.
					mysql_close($dbhandle);
				?>			
			</div>
			

			<div class="footer">
				&#169; 2012 Patriciaat 
			</div>

		</div>

	</body>
</html>