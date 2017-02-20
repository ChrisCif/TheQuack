
<div id="BigModal" class="modal fade">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title"><span id="ModTitle">Modal title</span>
			<a id="ClubLink" style="float:right;"><h5 class="modal-title" id="ClubTitle"></h5></a>
		</h4>
      </div>
      <div class="modal-body" id="ModBod">
      </div>
      <div class="modal-footer">
        <button data-dismiss="modal" type="button" class="btn btn-default" id="closePopoverModal">Close</button>
      </div>
    </div>
  </div>
</div>
<script>

var AllAnnouncements;
				
	$(document).ready(function(){
		
		AllAnnouncements = (<?php
			$connection=mysqli_connect($db_host, $db_username, $db_password, $db_name);
			
			$Dictionary = array();
			$Query = "SELECT `UniqueID`, `Title` FROM Clubs";
			$result = $connection->query($Query);
			$row = $result->fetch_row();
			while($row)
			{
				$Dictionary[$row[0]] = $row[1];
				$row = $result->fetch_row();
			}
			
			if($_SESSION['PermissionLevel'] > 0)
				$Query = "SELECT Announcements.`Title`, Announcements.`InnerDetail`, Announcements.`ClubID`, Clubs.`Title`, Announcements.`isEvent` FROM Announcements 
				INNER JOIN Clubs ON Clubs.`UniqueID` = Announcements.`ClubID` AND Clubs.`SponsorID` = ".$_SESSION['teachID'];
			else
				$Query = "SELECT Announcements.`Title`, Announcements.`InnerDetail`, Announcements.`ClubID`, Clubs.`Title`, Announcements.`isEvent` FROM Announcements 
				INNER JOIN Subscriptions ON Subscriptions.`Student` = ".$_SESSION['STUDENT_ID']."
				INNER JOIN Clubs ON Clubs.`UniqueID` = Announcements.`ClubID` AND Clubs.`UniqueID` = Subscriptions.`Club`";
			$result = $connection->query($Query);
			if(!$result)
				echo $connection->error;
			$output = array();
			$row = $result->fetch_row();
			while($row)
			{
				array_push($row, $Dictionary[$row[2]]);
				array_push($output, $row);
				$row = $result->fetch_row();
			}
			echo json_encode($output); 
		?>);
		console.log("Announce:");
		console.log(AllAnnouncements);
		for(var x = AllAnnouncements.length-1; x >= 0; x--)
		{
			if(AllAnnouncements[x][4] == "1")
				$("#SubEvent").append('<div id="EventAppend' + x + '" class="panel panel-danger EventExpand"><button type="button" class="close" data-dismiss="alert" style="margin-right:10px">x</button><div class="panel-heading"><a href="ClubPage.php?ClubId=' + AllAnnouncements[x][2] + '"><h3 style="color: white" class="panel-title">' + AllAnnouncements[x][3] + '</h3></a></div><div class="panel-body"><a href="#" class="HiddenLink" data-toggle="modal" data-target="#BigModal">' + AllAnnouncements[x][0] + '</a></div></div>');
			else
				$("#SubAnnounce").append('<div id="EventAppend' + x + '" class="panel panel-primary EventExpand"><button type="button" class="close" data-dismiss="alert" style="margin-right:10px">x</button><div class="panel-heading"><a href="ClubPage.php?ClubId=' + AllAnnouncements[x][2] + '"><h3 style="color: white" class="panel-title">' + AllAnnouncements[x][3] + '</h3></a></div><div class="panel-body"><a href="#" class="HiddenLink" data-toggle="modal" data-target="#BigModal">' + AllAnnouncements[x][0] + '</a></div></div>');
		}
		
		function ShowModal(Title, Inner, clubName, clubID)
		{
			$("#ModTitle").html(Title);
			$("#ClubTitle").html(clubName);
			$("#ModBod").html(Inner);
			$("#ClubLink").attr("href", "ClubPage.php?ClubId=" + clubID);
		}
		
		$("#closePopoverModal").click(function()
		{
			$("#PopoverModalAll").slideUp(500);
		});
		
		$(".AnnounceExpand").click(function()
		{
			var id = $(this).attr("id");
			id = id.substr(14);
			ShowModal(AllAnnouncements[id][0], AllAnnouncements[id][1], AllAnnouncements[id][3], AllAnnouncements[id][2]);
		});
		
		$(".EventExpand").click(function()
		{
			var id = $(this).attr("id");
			id = id.substr(11);
			ShowModal(AllAnnouncements[id][0], AllAnnouncements[id][1], AllAnnouncements[id][3], AllAnnouncements[id][2]);
		});
	});
</script>