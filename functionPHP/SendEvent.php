<?php

	require "settingPHP/SQLInfo.php";
	
	$Title = $_POST['Title'];
	$ClubId = $_POST['ClubId'];
	$InnerText = $_POST['InnerText'];
	$isEvent = $_POST['isEvent'];
	$startStamp = $_POST['startStamp'];
	$endStamp = $_POST['endStamp'];
	
	$connection=mysqli_connect($db_host, $db_username, $db_password, $db_name);

?>