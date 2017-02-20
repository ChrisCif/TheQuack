<?php
$db_host = "localhost";
$db_username = "jeffers_root";
$db_password = "admingo"; //Chris disapproves of this password
$db_name = "jeffers_capstone";

$StudentTableName = "Student_Definitions";

$StudentFields['id'] = "IDNumber";
$StudentFields['firstName'] = "FirstName";
$StudentFields['lastName'] = "LastName";
$StudentFields['middleInitial'] = "MiddleInitial";
$StudentFields['password'] = "Password";

$connection = mysqli_connect($db_host, $db_username, $db_password, $db_name);

function QueryGetRows($connect, $Query)
{
	$result = $connect->query($Query);
	$allRows = array();
	
	if(!$result)
	{
		$allRows['error'] = $connect->error;
		return $allRows;
	}
	
	$row = $result->fetch_row();
	
	while($row)
	{
		array_push($allRows, $row);
		$row = $result->fetch_row();
	}
	
	return $allRows;
}
?>