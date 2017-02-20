<?php
	require "../settingPHP/SQLInfo.php";
	$ID = $_GET['id'];
	$connection=mysqli_connect($db_host, $db_username, $db_password, $db_name);
	$Query = "SELECT `InnerDetail`, `ClubID` 
		  FROM Announcements 
		  WHERE `UniqueID`='$ID'";
		 
	$result = $connection->query($Query);
	
	$row = $result->fetch_row();
	
	echo $row[0];
?>