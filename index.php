<?php session_start();
 include "settingPHP/header.php"; ?>

<!-- Everything here is in the body. Don't worry about ending the body tag either. The footer does that. -->

<!---FIRST COL BEGIN--->
<div class='col-lg-3'>

	<div class='row'>
		<img src='images/citvPlaceholder.png' style='height: 150px; width: 300px'/>
	</div>
	<div class='row'>
		<img src='images/townCrierPlaceHolder.png' style='height: 150px; width: 300px'/>
	</div>
	<!-- Till later...
	FEATURED VIDEO
	<div class='col-lg-offset-1' id='featuredVideo' style='display:block;'>
		<div class='row'>
			<img src='images/citvLogoByChris.png'/>
		</div>
		<div class='row'>
			<iframe  src="//www.youtube.com/embed/eZgHTVh2hoc" frameborder="0" allowfullscreen>
			</iframe>
		</div>
	</div>
	
	FEATURED ARTICLE
	<div style='margin-top: 30px'>
		<img src='images/townCrierLogoEw.png'/>
		<div id='articleWell' class="panel panel-default" data-toggle='modal' data-target='#myModal' style="cursor: pointer">
			<div class="panel-heading">
				<h3>Article Title</h3>
			</div>
			<div class="panel-footer">
				<p><i>Written by Author Name</i></p>
			</div>
		</div>
	</div>
	-->
	
	<!---FILTER--->
	<div class='well'>
		<form class='form-group'>
			<legend>Filter Announcements By<span id='poop'>...</span></legend>
			<div class='checkbox'>
				<ul>
					<li><input name='0' class="filter" type="checkbox">Academic and Scholastic Clubs & Activities </input></li>
					<li><input name='1' class="filter" type="checkbox">The Arts</input></li>
					<li><input name='2' class="filter" type="checkbox">Cultural Awareness & Service Clubs</input></li>
					<li><input name='3' class="filter" type="checkbox">Physical Endeavors</input></li>
					<li><input name='4' class="filter" type="checkbox">Student Government & Leadership</input></li>
					<li><input name='5' class="filter" type="checkbox">Student Initiated</input></li>
					<li><input name='6' class="filter" type="checkbox">Student Publications</input></li>
				</ul>
			</div>
		</form>
	</div>
	
	<script>
		var nextGroup = 1; 
		$(document).ready(function(){
			
			$('#poop').click(function(){
				$('*').css('border-radius','100%');
			});
			
			$(".filter").click(function(){
				$("#eventappendhere").html("");
				$("#eventappendhere").append('<legend>Latest Activity</legend>');
				nextGroup = 1;
				loadWells();				
			});
			
			/*$('#eventappendhere').scroll(function()
			{
				if($('#eventappendhere')[0].scrollHeight < 100);
					loadWells();				
			});*/
			
			/* Meh I'll do this later
			console.log("Children Number: "+('#eventappendhere').children().length());
			$('#eventappendhere').css('height', Math.min(500, ($(this).children().length())*92)+'');
			*/
		});
	</script>
</div>	
<!---FIRST COL END--->

<!---SECOND COL BEGIN--->
<div class='col-lg-6' style='margin-bottom:2em'>
	<?php include "settingPHP/CalendarInclude.php" ?>
</div>
<!--SECOND COL END--->

<!---THIRD COL BEGIN--->
<div class='col-lg-3 well' id="eventappendhere" style="overflow-y:auto; height: 600px">
	<legend>Latest Activity</legend>
	<!--
	<div class="panel panel-primary">
		<button type="button" class="close" data-dismiss="alert">x</button>
		<div class="panel-heading">
			<a href='ClubPage.php' style='color:white'><h3 class="panel-title">This Club</h3></a>
		</div>
		<div class="panel-body">
			This is a club event.
		</div>
	</div>
	-->
</div>	
<!---THIRD COL END--->


<!-- ARTICLE MODAL -->
<div class="modal fade" id="myModal">
	<div class="modal-dialog">
		<div class="modal-content">
		  <div class="modal-header">
			<button type="button" class="close" data-dismiss="modal" aria-hidden="true">x</button>
			<h4 class="modal-title">Article Title</h4>
		  </div>
		  <div class="modal-body">
			<p>
				I know. It’s all wrong. By rights we shouldn’t even be here. But we are. It’s like in the great stories, Mr. Frodo. The ones that really mattered. Full of darkness and danger, they were. And sometimes you didn’t want to know the end. Because how could the end be happy? How could the world go back to the way it was when so much bad had happened? But in the end, it’s only a passing thing, this shadow. Even darkness must pass. A new day will come. And when the sun shines it will shine out the clearer. Those were the stories that stayed with you. That meant something, even if you were too small to understand why. But I think, Mr. Frodo, I do understand. I know now. Folk in those stories had lots of chances of turning back, only they didn’t. They kept going. Because they were holding on to something. That there’s some good in this world, Mr. Frodo… and it’s worth fighting for.
			</p>
		  </div>
		  <div class="modal-footer">
			<button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
		  </div>
		</div>
	</div>
</div>

<?php include "functionPHP/LoadAnnoucements.php";?>

<script>

	$('#articleWell').mouseover(function(){
		$(this).children().css('background-color','#e6e6e6');
	});
	$('#articleWell').mouseout(function(){
		$(this).children().css('background-color','#f2f2f2');
	});
	
	
	
	$('#poop').click(function(){
		$('*').css('border-radius', '100%');
	});
	
</script>

<?php include "settingPHP/footer.php" ?>