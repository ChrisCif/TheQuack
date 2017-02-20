<?php include "settingPHP/header.php";
 ?>
 
 <style>
 
	<!--
		Colors
			BLUE   -   Academic and Scholastic Clubs & Activities: Background = #63c3ff  Border = #3696d1
			GREEN   -   The Arts: Background = #45de5e  Border = #1ab031
			RED   -   Cultural Awareness & Service Clubs: Background = #ff3d71  Border = #d11144
			ORANGE   -   Physical Endeavors: Background = #fc7419  Border = #fc430a
			PURPLE   -   Student Government & Leadership: Background = #9653b8  Border = #7442a6
			GREY   -   Student Initiated: Background = #f2f2f2  Border = #c2c2c2
			BLACK   -   Student Publications: Background = #1f1f1f  Border = #000000
			
			TEXT COLOR   -   #ededed
	-->		
	
	.clubIcon
	{
		width: 80px;
		height: 80px;
	}
	
	h3
	{
		font-size: 20px;
		font-weight: bold;
	}
	
	.panel
	{
		color: black;
	}
	
	.type
	{
		color: #2680e0;
		margin-top: 50px;
	}
	
	#allWell
	{
		margin-top: 10px;
	}
	
	.nav-tabs
	{
		font-size: 12px;
	}
	
	#well0
	{
		margin-top: 10px;
		border-color: #2680e0;
		background-color: #3690eb;
	}
	
	#well1
	{
		margin-top: 10px;
		border-color: #1ab031;
		background-color: #45de5e;
	}
	
	#well2
	{
		margin-top: 10px;
		border-color: #d11144;
		background-color: #ff3d71;
	}
	
	#well3
	{
		margin-top: 10px;
		border-color: #fc430a;
		background-color: #fc7419;
	}
	
	#well4
	{
		margin-top: 10px;
		border-color: #7442a6;
		background-color: #9653b8;
	}
	
	#well5
	{
		margin-top: 10px;
		border-color: #c2c2c2;
		background-color: #f2f2f2;
	}
	
	#well6
	{
		margin-top: 10px;
		border-color: #000000;
		background-color: #1f1f1f;
	}
	
	#MyWell
	{
		margin-top: 10px;
		background-color: #ffffff;
	}
	
	.tab
	{
		cursor: pointer;
	}
	
 </style>
 
 <div class='col-lg-6 col-lg-offset-3'>
	<h1>List of Clubs at PWHS</h1>
 </div>
 
 <!-- SEARCHBAR -->
<div style='margin-top: 20px' class="form-group col-lg-6 col-lg-offset-3">
	<div class="input-group">
		<span class='input-group-addon'>Search</span>
		<input id="searchBar" type="text" class="form-control">
	</div>
</div>
 
 <div class='col-lg-12'>
	 <ul class="nav nav-tabs">
		<li id='allTab' class="active tab"><a data-toggle="tab">All</a></li>
		<li id='academicTab' class="tab"><a data-toggle="tab">Academic and Scholastic Clubs & Activities</a></li>
		<li id='artTab' class="tab"><a data-toggle="tab">The Arts</a></li>
		<li id='cultureTab' class="tab"><a data-toggle="tab">Cultural Awareness & Service Clubs</a></li>
		<li id='peTab' class="tab"><a data-toggle="tab">Physical Endeavors</a></li>
		<li id='govTab' class="tab"><a data-toggle="tab">Student Government & Leadership</a></li>
		<li id='siTab' class="tab"><a data-toggle="tab">Student Initiated</a></li>
		<li id='spTab' class="tab"><a data-toggle="tab">Student Publications</a></li>
		<li id='meinTab' class="tab"><a data-toggle="tab">My Clubs</a></li>
	</ul>
</div>

<script>
	$(document).ready(function(){
		$('#allTab').click(function(){
			if(!$(this).hasClass("active")){
				$(".indivWell").hide();
				$('#allWell').show();
			}
		});
		
		$('#academicTab').click(function(){
			if(!$(this).hasClass("active")){
				$(".indivWell").hide();
				$('#well0').show();
			}
		});
		
		$('#artTab').click(function(){
			if(!$(this).hasClass("active")){
				$(".indivWell").hide();
				$('#well1').show();
			}
		});
		
		$('#cultureTab').click(function(){
			if(!$(this).hasClass("active")){
				$(".indivWell").hide();
				$('#well2').show();
			}
		});
		
		$('#peTab').click(function(){
			if(!$(this).hasClass("active")){
				$(".indivWell").hide();
				$('#well3').show();
			}
		});
		
		$('#govTab').click(function(){
			if(!$(this).hasClass("active")){
			
				$(".indivWell").hide();
				$('#well4').show();
			}
		});
		
		$('#siTab').click(function(){
			if(!$(this).hasClass("active")){
				$(".indivWell").hide();
				$('#well5').show();
			}
		});
		
		$('#spTab').click(function(){
			if(!$(this).hasClass("active")){
				$(".indivWell").hide();
				$('#well6').show();
			}
		});
		
		$('#meinTab').click(function(){
			if(!$(this).hasClass("active")){
				$(".indivWell").hide();
				$('#MyWell').show();
			}
		});
		
		$('#searchBar').keyup(function()
		{
			$(".indivWell").hide();
			$(".tabb").removeClass("active");
			$("#SearchWell").show();
			$("#SearchWell").html("");
			var pat = new RegExp("" + $(this).val(),"i");
			for(var x = 0; x < AllClubs.length; x++)
			{
				if(pat.test(AllClubs[x][1]))
				{
					$("#SearchWell").append(GetRowText(x));
				}
			}
		});
	});
</script>










<?php
$connection=mysqli_connect($db_host, $db_username, $db_password, $db_name);
$Query = "SELECT `UniqueID`, `Title`, `ClubType`, `InfoText`, `ProfilePicture` FROM Clubs WHERE 1";
$result = $connection->query($Query);
$row = $result->fetch_row();
$array = array();
while($row)
{
	array_push($array, $row);
	
	$row = $result->fetch_row();
}

/*
	$ROW
	
	0: id
	1: title
	2: type
	3: info text
	4: Prof pic
*/

?>
<script type="text/javascript">

var AllClubs = <?php echo json_encode($array) ?>;
var Subscriptions = <?php if(isset($_SESSION['Subscriptions'])) echo json_encode($_SESSION['Subscriptions']); else echo "false" ?>;
$(document).ready(function(){
	for(var x = 0; x < AllClubs.length; x++)
	{
		$("#allWell").append(GetRowText(x));
		$("#well" + AllClubs[x][2]).append(GetRowText(x));
	}
	for(var x = 0; x < Subscriptions.length; x++)
	{
		for(var y = 0; y < AllClubs.length; y++)
		{
			if(AllClubs[y][0] == Subscriptions[x][0])
			{
				$("#MyWell").append(GetRowText(y));
			}
		}
	}
});



function GetRowText(index)
{
	var DISPLAY_CHARACTER_LIMIT = 250;

	var type = AllClubs[index][2];
	var strongColor;
	
	if(type == 0){strongColor = "3696d1";}
	if(type == 1){strongColor = "1ab031";}
	if(type == 2){strongColor = "d11144";}
	if(type == 3){strongColor = "fc430a";}
	if(type == 4){strongColor = "7442a6";}
	if(type == 5){strongColor = "c2c2c2";}
	if(type == 6){strongColor = "000000";}

	var infoText = "";
	var fullArray = AllClubs[index][3].match(/(<p[^>]*>|<span[^>]*>)[^<][\w \.,?!'"()&$#;]*/gi);
	if(!fullArray)
		infoText = "No description";
	else
	{	
		for(var x = 0; x < fullArray.length && infoText.length < DISPLAY_CHARACTER_LIMIT; x++)
		{
			infoText += fullArray[x].substr(fullArray[x].indexOf(">") + 1, DISPLAY_CHARACTER_LIMIT - infoText.length);
		}
		if(infoText.length == DISPLAY_CHARACTER_LIMIT)
			infoText += "...";
	}
	return '<a href="ClubPage.php?ClubId='+AllClubs[index][0]+'">' +
				'<div class="panel" style="border-color: #'+strongColor+'">' +
					'<div class="panel-body">'+
						'<div class="col-lg-2">'+
							'<img class="clubIcon" style="width:100px; height:100px" src="' + AllClubs[index][4] + '"/>'+
						'</div>'+
						'<h3>'+AllClubs[index][1]+'</h3>'+
						'<p class="col-lg-9">'+infoText+'</p>'+
						'<div class="row">'+
							'<div class="col-lg-1 col-lg-offset-11" style="color: #'+strongColor+'">'+
								AllClubs[index][2]+
							'</div>'+
						'</div>'+
					'</div>'+
				'</div>'+
			'</a>';


}

</script>



<div id='myContainer' class="container">

<div id='allWell' class="col-lg-10 col-lg-offset-1 well well-sm indivWell">
	<legend>All</legend>
</div>

<div id='well0' class='col-lg-10 col-lg-offset-1 well well-sm indivWell' style='display: none'>
	<legend style='color: #ededed; border-color: #2680e0'>Academic and Scholastic Clubs & Activities</legend>
</div>

<div id='well1' class='col-lg-10 col-lg-offset-1 well well-sm indivWell' style='display: none'>
	<legend style='color: #ededed; border-color: #1ab031'>The Arts</legend>
</div>

<div id='well2' class='col-lg-10 col-lg-offset-1 well well-sm indivWell' style='display: none'>
	<legend style='color: #ededed; border-color: #ed005b'>Cultural Awareness & Service Clubs</legend>
</div>

<div id='well3' class='col-lg-10 col-lg-offset-1 well well-sm indivWell' style='display: none'>
	<legend style='color: #ededed; border-color: #fc430a'>Physical Endeavors</legend>
</div>

<div id='well4' class='col-lg-10 col-lg-offset-1 well well-sm indivWell' style='display: none'>
	<legend style='color: #ededed; border-color: #7442a6'>Student Government & Leadership</legend>
</div>

<div id='well5' class='col-lg-10 col-lg-offset-1 well well-sm indivWell' style='display: none'>
	<legend style='border-color: #c2c2c2'>Student Initiated</legend>
</div>

<div id='well6' class='col-lg-10 col-lg-offset-1 well well-sm indivWell' style='display: none'>
	<legend style='color: #ededed; border-color: #000000'>Student Publications</legend>
</div>

<div id='MyWell' class='col-lg-10 col-lg-offset-1 well well-sm indivWell' style='display: none'>
	<legend>My Clubs</legend>
</div>

<div id='SearchWell' class='col-lg-10 col-lg-offset-1 well well-sm indivWell' style='display: none'>
	<legend style='color: #a09020; border-color: #a09020'>Search</legend>

</div>

</div>
<?php include "settingPHP/footer.php" ?>