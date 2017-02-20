<?php session_start();
require "../settingPHP/SQLInfo.php";
$start = date('Y-m-d H:i:s' , $_GET['from'] / 1000);
$end = date('Y-m-d H:i:s' , $_GET['to'] / 1000);

$connection=mysqli_connect($db_host, $db_username, $db_password, $db_name);


$OverObject = array();

$OverObject['success'] = 1;

$Returnable = array();
if($_SESSION['PermissionLevel'] == 0)
{
	$Query = "SELECT Announcements.`UniqueID`, Announcements.`Title`, Announcements.`EventStart`, Announcements.`EventEnd`, Announcements.`ClubID`, Announcements.`EventStart`
		  FROM Announcements
		  INNER JOIN Subscriptions ON Subscriptions.`Student` = ".$_SESSION['STUDENT_ID']."
		  INNER JOIN Clubs ON Clubs.`UniqueID` = Subscriptions.`Club` AND Clubs.`UniqueID` = Announcements.`ClubID`
		  WHERE `isEvent` = 1 
			AND '$start' < Announcements.`EventEnd`
			AND '$end' > Announcements.`EventStart`";
}
else
{
	$Query = "SELECT Announcements.`UniqueID`, Announcements.`Title`, Announcements.`EventStart`, Announcements.`EventEnd`, Announcements.`ClubID`, Announcements.`EventStart`, Clubs.`Title`
		  FROM Announcements
		  INNER JOIN Clubs ON Clubs.`UniqueID` = Announcements.`ClubID` AND Clubs.`SponsorID` = '".$_SESSION['teachID']."'
		  WHERE `isEvent` = 1 
			AND '$start' < Announcements.`EventEnd`
			AND '$end' > Announcements.`EventStart`";
}
$result = $connection->query($Query);
echo $connection->error;
$row = $result->fetch_row();

while($row)
{
	$thisItem = array();
	$thisItem['id'] = $row[0];
	$thisItem['title'] = $row[1];
	$thisItem['ClubID'] = $row[4];
	$thisItem['TimeStamp'] = $row[5];
	$thisItem['ClubName'] = $row[6];
	
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