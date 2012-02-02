<?php session_start('test'); ?>
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
				<?php include 'menu.php';?>
			</div>
			<div class="slidemenu">
				<?php include 'slidemenu.php';?>
			</div>
			<div class="center">
				<?php
					// Database connectie.
					include 'dblogin.php';
					
					//TODO check uitvoeren dat de user wel bestaat.
					if (array_key_exists('id',$_GET) && ($_GET['id']) != "" && ($_GET['id']) > 0)
					{
						$id = $_GET['id'];
						$idSelf = $_SESSION['userID'];
						
						// Exists variabele.
						$exists = 0;
						
						// Gegevens uit tabel ophalen.
						$result1 = mysql_query("SELECT * FROM users where id = '$id' ") or die("Oops something went wrong you can try again in a few minutes.");  
						$row = mysql_fetch_array($result1);
						
						// Als $id bestaat in rij, dan is $exists 1.
						if ($row['id'] == $id)
							$exists = 1;
							
						// Als de id bestaat, de gegevens tonen.
						if ($exists == 1)
						{
							//$row = mysql_fetch_array($result1);
				?>
				<div class="picture">
					<img src="emperor.png" alt="emperor" width="200" height="200"/>
				</div>
				<div class="overmij">
					<div class="personaltitle">
						Over 
						<?php echo $row['username'];?> 
					</div>
					<?php echo $row['personal_info'];?>
				</div>
				<div class="lastposts">
					<div class="personaltitle">
						Last Posts.
					</div>
					<?php
						$counter = 1;
						$counter2 = 0;
						
						$result2 = mysql_query("SELECT * FROM topics WHERE user_id = '$id' LIMIT 10");
						
						while($row2 = mysql_fetch_array($result2))
						{
							$lastpost =  $row2['posttitle'];
							
							$lastpostcut = str_split($lastpost, 37);
							echo $lastpostcut[0];
							// Als de string langer is dan 37 dan past hij niet in het hokje dus ... 
							// om aan te geven dat het niet de volledige titel is.
							if (strlen($lastpostcut[0]) == 37)
							{
								echo "...";
							}
							echo "<br />";
						}	
					?>
					</div>
					<div class="info">
						<div class="personaltitle">
							Info.
						</div>
						<?php 
							echo "Username: ".$row['username'];
						?>
						<br />
						<?php
							echo "Sex:".$row['sex'];
						?>
						<br />
						<?php 
							echo "Name: ".$row['first_name'];
							echo " ".$row['last_name'];
						?>
						<br />
						<?php 
							echo "E-mail: ".$row['email'];
						?>
						<br />
						<?php 
							echo "Favo browser: ".$row['favo_browser'];
						?>
					</div>
					<div class="forumstatus">
						<div class="personaltitle">
							Forum Status
						</div>
						<?php
							$forumstatus = $row['admin'];
							
							if($forumstatus == 0)
							{
								echo " Forum status: User <br />";
							}
							else if($forumstatus == 1)
							{
								echo "Forum status: Admin <br />";
							}
					
							// Als eigen personal page is geladen, change password pagina laten zien.
							if ($id == $idSelf)
								echo "<a href='changing.php'>change password</a>";
						?>
					</div>
					<div class="startedtopics">
						<div class="personaltitle">
							Started Topics.
						</div>
						<?php
							$counter3 =1;
							$counter4 = 0;
							// een while met counters om het script 10 keer te laten uitvoeren waardoor de laatste 10 gestarte topics te zien zijn.
							while($counter3 != 10)
							{					
								$result3 = mysql_query("SELECT * FROM topics WHERE user_id = $id AND start = '1' ORDER BY starttime LIMIT $counter3 OFFSET $counter4") or die("Oops something went wrong you can try again in a few minutes.");  
								
								$row3 = mysql_fetch_array($result3);
								echo $row3['posttitle'];
								$counter3 = $counter3 + 1;
								$counter4 = $counter4 + 1;
								echo "<br />";
							}
						?>
					</div>
				<?php 
					}
					else
					{
						echo "User does not exist.";
					}
					}
					else
					{
						echo "No user specified.";
					}
					// Database connectie afsluiten.
					mysql_close($dbhandle);
				?>
			</div>
			<div class="footer">
				&#169; 2012 <?php include 'forumname.php'; ?> 
			</div>
		</div>
	</body>
</html>