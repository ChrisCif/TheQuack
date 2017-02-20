<?php
	include "../settingPHP/SQLInfo.php";
	
	$imageName=$_FILES['uploadImg']['name'];
	$imageType=$_FILES['uploadImg']['type'];
	$imageSize=$_FILES['uploadImg']['size'];
	$imageTempName=$_FILES['uploadImg']['tmp_name'];
	
	$imageName = str_replace("'", "\'", $imageName);
	
	move_uploaded_file($imageTempName, "../images/clubpageimages/$imageName");
	
	$CID=$_POST["CID"];
	$Query="UPDATE Clubs SET `ProfilePicture`='images/clubpageimages/$imageName' WHERE `UniqueID`='$CID'";
	$result=$connection->query($Query);
	echo 'images/clubpageimages/'.$imageName;
	
?>