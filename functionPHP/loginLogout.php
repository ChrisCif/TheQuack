<?php include "../settingPHP/SQLInfo.php";
	session_start();

	if($_POST['loggingIn']){
		if (isset($_POST["inputEmail"]) && isset($_POST["inputPassword"])){
			$username=$_POST["inputEmail"];
			$password=md5($_POST["inputPassword"]);
			$connection=mysqli_connect($db_host, $db_username, $db_password, $db_name);
			$isTeacher = false;
			if (strpos($username, '@') !== FALSE) //Teachers: ID, username, Email, password, isAdmin
			{	
				$Query="SELECT `ID`, `username` FROM Teachers WHERE `Email`='$username' AND `password`='$password'";
				$isTeacher = true;
			}
			else
				$Query="SELECT ".$StudentFields['id']." FROM $StudentTableName WHERE `". $StudentFields['id'] ."`='$username' AND `". $StudentFields['password'] ."`='$password'";
			$result=$connection->query($Query);
			$row=$result->fetch_row();
			
			if ($row)
			{
				if($isTeacher)
				{
					$teachID = $row[0]; 
					$_SESSION['STUDENT_ID'] = $teachID;
					$Query = "SELECT `UniqueID` FROM Clubs WHERE `SponsorID`= '".$row[0]."'";
					$Subscriptions = QueryGetRows($connection, $Query);
					$_SESSION['Subscriptions'] = $Subscriptions;
					if($teachID == 1)
						$_SESSION['PermissionLevel'] = 2;
					else
						$_SESSION['PermissionLevel'] = 1;
					$_SESSION['teachID'] = $teachID;
					echo json_encode("+Redirect ++Teacher ++Plevel" . $_SESSION['PermissionLevel']); 
				}
				else
				{
					$_SESSION['STUDENT_ID'] = $username;
					$Query = "SELECT `Club` FROM Subscriptions WHERE `Student` = '$username'";
					$Subscriptions = QueryGetRows($connection, $Query);
					$_SESSION['Subscriptions'] = $Subscriptions;
					$_SESSION['PermissionLevel'] = 0;
					echo json_encode("+Redirect");
				}
			}
			else	
			{
				echo "console.log('nay')";
			}
		}
		else
		{
			echo json_encode("-Form incomplete");
		}
	}
	else
	{
		session_unset();
	}
?>