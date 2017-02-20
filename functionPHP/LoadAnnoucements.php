
<div id="BigModal" class="modal fade">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title"><span id="ModTitle"><!--Announcement Title appends here--></span>
			<a id="ClubLink" style="float:right;"><h5 class="modal-title" id="ClubTitle"></h5></a>
			<h5 class="modal-title" id="timeStamp"></h5>
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

function loadWells()
{
	console.log("loading wells..." + nextGroup);
	var empty = true;
	$(".filter").each(function()
	{
		if((this).checked)
			empty = false;
	});
	var temp = nextGroup;
	var endOfAnnouncements = Math.max(AllAnnouncements.length-temp-25, 0);
	for(var x = AllAnnouncements.length - 1; x >= endOfAnnouncements; x--)
	{
		if(empty || $("input[name='"+AllAnnouncements[x][7]+"']").prop('checked'))
		{
			if(AllAnnouncements[x][4] == "1")
				$("#eventappendhere").append('<div id="EventAppend' + x + '" class="panel panel-danger EventExpand" name="'+AllAnnouncements[x][7]+'"><button type="button" class="close" data-dismiss="alert" style="margin-right:10px">x</button><div class="panel-heading"><a href="ClubPage.php?ClubId='+AllAnnouncements[x][2]+'"><h3 style="color: white" class="panel-title">' + AllAnnouncements[x][3] + '</h3></a></div><a class="HiddenLink" href="#" data-toggle="modal" data-target="#BigModal"><div class="panel-body">' + AllAnnouncements[x][0] + '</div></a></div>');
			else
				$("#eventappendhere").append('<div id="AnnounceAppend' + x + '" class="panel panel-primary AnnounceExpand" name="'+AllAnnouncements[x][7]+'"><button type="button" class="close" data-dismiss="alert" style="margin-right:10px">x</button><div class="panel-heading"><a href="ClubPage.php?ClubId='+AllAnnouncements[x][2]+'"><h3 style="color: white" class="panel-title">' + AllAnnouncements[x][3] + '</h3><a/></div><a class="HiddenLink" href="#" data-toggle="modal" data-target="#BigModal"><div class="panel-body">' + AllAnnouncements[x][0] + '</div></a></div>');
		}
	}
	nextGroup+=25;
	if(endOfAnnouncements != 0)
		$("#eventappendhere").append('<button type="button" class="btn-default" style="width:100%" id="ShowMore">Show More</button>');
}
		
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
			
			$Query = "SELECT Announcements.`Title`, Announcements.`InnerDetail`, Announcements.`ClubID`, Clubs.`Title`, Announcements.`isEvent`, Announcements.`EventStart`, Announcements.`EventEnd`, Clubs.`ClubType` 
						FROM Announcements INNER JOIN Clubs ON Clubs.`UniqueID` = Announcements.`ClubID`";
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
		loadWells();
		
		function ShowModal(Title, Inner, clubName, clubID, timestamp)
		{
			console.log("show modal");
			$("#ModTitle").html(Title);
			$("#ClubTitle").html(clubName);
			$("#ModBod").html(Inner);
			$("#ClubLink").attr("href", "ClubPage.php?ClubId=" + clubID);
			$("#timeStamp").html(timestamp);
		}
		
		$("#closePopoverModal").click(function()
		{
			$("#PopoverModalAll").slideUp(500);
			console.log("poop");//Not running...don't know why
		});
		
		$(".AnnounceExpand").click(function()
		{
			console.log("announce expand");
			var id = $(this).attr("id");
			id = id.substr(14);
			ShowModal(AllAnnouncements[id][0], AllAnnouncements[id][1], AllAnnouncements[id][3], AllAnnouncements[id][2],  AllAnnouncements[id][5]);
		});
		
		$(".EventExpand").click(function()
		{
			console.log("event expand");
			var id = $(this).attr("id");
			id = id.substr(11);
			ShowModal(AllAnnouncements[id][0], AllAnnouncements[id][1], AllAnnouncements[id][3], AllAnnouncements[id][2],  AllAnnouncements[id][5] + " to " + AllAnnouncements[id][6]);
		});
		
		$("#ShowMore").click(function()
		{
			console.log("Show More!");			
			loadWells();
		});
	});
	
</script>