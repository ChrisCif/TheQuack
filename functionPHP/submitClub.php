<?php session_start();
	require "../settingPHP/SQLInfo.php";
	
	if( isset($_POST['name'])  &&  isset($_POST['type'])  &&  isset($_POST['sponsor']) ){
		
		$title = $_POST['name'];
		$type = $_POST['type'];
		$sponsor = $_POST['sponsor'];
		
		$connection = mysqli_connect($db_host, $db_username, $db_password, $db_name);
		
		$Query = "SELECT `Title` FROM Clubs WHERE `Title` = '$title'";
		
		$result = $connection -> query($Query);
		
		if($result->fetch_row())
		{
			echo "FAILURE Club with this title already exists.";
		}
		else
		{
		
			$Query = "INSERT INTO Clubs(`ClubType`, `Title`, `SponsorID`) VALUES ('$type', '$title', '$sponsor')";
			
			$connection->query($Query);
			
			$Query = "SELECT `UniqueID` FROM Clubs WHERE `ClubType`='$type' AND `Title` = '$title' AND `SponsorID` = '$sponsor'";
			$result = $connection -> query($Query);
			$NCID = $result->fetch_row()[0];
			$arg = $_SESSION['Subscriptions'];
			array_push($arg, array($NCID));
			$_SESSION['Subscriptions'] = $arg;
			echo $NCID;
			/*
			$Query = "SELECT `UniqueID` FROM Clubs WHERE `Title`='$title'";
			$result = $connection -> query($Query);
			$row = $result -> fetch_row();
			echo "poop ".var_dump($row);*/
		}
	}
	else{
		echo "FAILURE Unset Variables";
	}
?>