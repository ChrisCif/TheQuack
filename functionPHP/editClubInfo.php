<?php 
	require "../settingPHP/SQLInfo.php";
	
	$ckVal=$_POST["ckVal"];
	$CID = $_POST['CID'];
	$Query="UPDATE Clubs SET `InfoText`='$ckVal' WHERE `UniqueID`='$CID'";
	$result=$connection->query($Query);
	
	$clubName=$_POST["clubName"];
	$Query="UPDATE Clubs SET `Title`='$clubName' WHERE `UniqueID`='$CID'";
	$result=$connection->query($Query);
	
	$arr=array();
	array_push($arr, $ckVal); 
	array_push($arr, $clubName);
	
	echo json_encode($arr);
?>