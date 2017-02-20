<?php
require "../settingPHP/SQLInfo.php";
$start = date('Y-m-d H:i:s' , $_GET['from'] / 1000);
$end = date('Y-m-d H:i:s' , $_GET['to'] / 1000);

$connection=mysqli_connect($db_host, $db_username, $db_password, $db_name);
$Query = "SELECT `UniqueID`, `Title`, `EventStart`, `EventEnd`, `ClubID`, `EventStart`
		  FROM Announcements 
		  WHERE `isEvent` = 1 
			AND ((`EventStart` BETWEEN '$start' AND '$end') 
			OR (`EventEnd` BETWEEN '$start' AND '$end') 
			OR ('$start' BETWEEN `EventStart` AND `EventEnd`) 
			OR ('$end' BETWEEN `EventStart` AND `EventEnd`))";
$result = $connection->query($Query);
$row = $result->fetch_row();

$OverObject = array();

$OverObject['success'] = 1;

$Returnable = array();
while($row)
{
	$thisItem = array();
	$thisItem['id'] = $row[0];
	$thisItem['title'] = $row[1];
	$thisItem['ClubID'] = $row[4];
	$thisItem['TimeStamp'] = $row[5];
	$ClubNameQuery = "SELECT `Title` FROM Clubs WHERE `UniqueID` = ". $row[4];
	$NameResult = $connection->query($ClubNameQuery);
	$thisItem['ClubName'] = $NameResult->fetch_row()[0];
	
	$thisItem['url'] = 'functionPHP/GetEventText.php?id=' . $row[0];
	$thisItem['class'] = "event-success";
	$thisItem['start'] = strtotime($row[2]) * 1000;
	$thisItem['end'] = strtotime($row[3]) * 1000;
	
	array_push($Returnable, $thisItem);
	
	$row = $result->fetch_row();
}

$OverObject['result'] = $Returnable;

echo json_encode($OverObject);
?>