<?php session_start();

require "../settingPHP/SQLInfo.php";
$connection = mysqli_connect($db_host, $db_username, $db_password, $db_name);

if($_POST['operation'] == "check")
{
	$isEmail = $_POST['box'];
	$isChecking = $_POST['check'];
	$club = $_POST['clubTarget'];
	$student = $_POST['studentTarget'];

	$Query = "UPDATE Subscriptions SET `". ($isEmail) ."` = ". ($isChecking == "true" ? 1 : 0) ." WHERE `Club`='$club' AND `Student`='$student'";
	$connection->query($Query);


	echo json_encode($Query);
}
if($_POST['operation'] == "sub")
{
	$Student = $_POST['StudentID'];
	$Club = $_POST['Club'];
	$State = $_POST['isSubbing'];
	
	if($State == 0)
	{
		$Query = "DELETE FROM Subscriptions WHERE `Student`='$Student' AND `Club`='$Club'";
		$connection->query($Query);
		if($connection->error)
			echo ("-FAIL::" . $connection->error);
		else
		{
			for($x = 0; $x < sizeof($_SESSION['Subscriptions']); $x++)
			{
				if($_SESSION['Subscriptions'][$x][0] == $Club)
				{
					unset($_SESSION['Subscriptions'][$x]);
				}
			}
		
			echo ("+You good");
		}
	}
	else
	{
		$Query = "INSERT INTO Subscriptions (`Student`, `Club`, `getEmail`, `getText`) VALUES ('$Student', '$Club', 0, 0)";
		$connection->query($Query);
		if($connection->error)
			echo ("-FAIL::" . $connection->error);
		else
		{
			echo ("+Added Success");
			array_push($_SESSION['Subscriptions'], array($Club));
		}
	}
}
if($_POST['operation'] == "email")
{
	$value = $_POST['value'];
	$id = $_POST['id'];
	
	$Query = "SELECT * FROM StudentEmails WHERE `StudentID`='$id'";
	$result = $connection->query($Query);
	
	if($result->fetch_row())
	{
		$Query = "UPDATE StudentEmails SET `Email`='$value' WHERE StudentID='$id'";
	}
	else
	{
		$Query = "INSERT INTO StudentEmails (`StudentID`, `Email`) VALUES ('$id', '$value')";
	}
	
	$result = $connection->query($Query);
	echo $connection->error;
	echo $value;
}
if($_POST['operation'] == "phone")
{
	$value = $_POST['value'];
	$id = $_POST['id'];
	
	$Query = "SELECT * FROM StudentEmails WHERE `StudentID`='$id'";
	$result = $connection->query($Query);
	
	if($result->fetch_row())
	{
		$Query = "UPDATE StudentEmails SET `Phone`='$value' WHERE StudentID='$id'";
	}
	else
	{
		$Query = "INSERT INTO StudentEmails (`StudentID`, `Phone`) VALUES ('$id', '$value')";
	}
	
	$result = $connection->query($Query);
	echo $connection->error;
	echo $value;
}
?>