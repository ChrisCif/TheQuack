<?php 
require "../settingPHP/SQLInfo.php";

$type = $_POST["type"];
$club = $_POST["club"];
$title = $_POST["title"];
$text = $_POST["text"];
$startDate = $_POST["startDate"];
$endDate = $_POST['endDate'];
$startTime = $_POST['startTime'];
$endTime = $_POST['endTime'];

list($sMonth, $sDay, $sYear) = split('[/]', $startDate);
list($eMonth, $eDay, $eYear) = split('[/]', $endDate);


list($sHour, $sMinute) = split('[:]', $startTime);
list($eHour, $eMinute) = split('[:]', $endTime);

$start = "$sYear-$sMonth-$sDay $sHour:$sMinute:00";
$end = "$eYear-$eMonth-$eDay $eHour:$eMinute:00";

$currentTime = time();

$connect = mysqli_connect($db_host, $db_username, $db_password, $db_name); //Club ID, Title, InnerDetail, isEvent, EventStart, EventEnd
if($type != "false")
{
	$start = date("Y-m-d H:i:s", strtotime($start));
	$end = date("Y-m-d H:i:s", strtotime($end));
	$query= "INSERT INTO Announcements (`ClubID`, `Title`, `InnerDetail`, `isEvent`, `EventStart`, `EventEnd`) VALUES ('".$club."','".$title."','".$text."','1','".$start."','".$end."')";
	echo json_encode(array($title, $text, '1', $start, $end));
	$connect->query($query); 
	if($result)
	{
		$array = QueryGetRows($connect, "SELECT StudentEmails.`Email` FROM StudentEmails INNER JOIN Subscriptions ON StudentEmails.`StudentID` = Subscriptions.`Student` WHERE `Club` = $club");
		foreach($array as $x)
		{
			email($x, $title, $text . '<br />Auto-Generated from <a href="https://nathanhyer.com/Capstone/Activities/DEV/">the site</a>', "From: ".$Club.' Club');
		}
	}
}
else
{
	$query= "INSERT INTO Announcements (`ClubID`, `Title`, `InnerDetail`, `isEvent`) VALUES ('".$club."','".$title."','".$text."','0')";
	echo json_encode(array($title, $text, '0', $currentTime));
	$result = $connect->query($query); 
	if($result)
	{
		$array = QueryGetRows($connect, "SELECT StudentEmails.`Email` FROM StudentEmails INNER JOIN Subscriptions ON StudentEmails.`StudentID` = Subscriptions.`Student` WHERE `Club` = $club");
		foreach($array as $x)
		{
			email($x, $title, $text, "From: ".$Club.' Club');
		}
	}
}
?>