<!-- Everything here is in the body. Don't worry about ending the body tag either. The footer does that. -->

<style type='text/css'>

#subAct
{
	margin-left: 20px;
}

</style>

<!---FIRST COL--->
<div class="col col-lg-3">
	<div class='row'>
		<img src='images/citvPlaceholder.png' style='height: 200px; width: 400px'/>
	</div>
	<div class='row'>
		<img src='images/townCrierPlaceHolder.png' style='height: 200px; width: 400px'/>
	</div>
	<!-- Till Later...
	FEATURED VIDEO
	<div style='display:block'>
		<a href='citv2.php'><img src='images/citvLogoByChris.png'/></a>
		<iframe style='width:100%; height: 200px' src="//www.youtube.com/embed/jg9rFWqOBaI" frameborder="0" allowfullscreen>
		</iframe>
	</div>
	
	FEATURED ARTICLE
	<div class='col' style='margin-top: 30px'>
		<a href='townCrier.php'><img src='images/townCrierLogoEw.png'/></a>
		<div id='articleWell' class="panel panel-default" data-toggle='modal' data-target='#myModal' style="cursor: pointer">
			<div class="panel-heading">
				<h3>Article Title</h3>
			</div>
			<div class="panel-footer">
				<i>Written by Author Name</i>
			</div>
		</div>
	</div>
	-->
	
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
	
</div>

<!---SECOND COL--->
<div class='col col-lg-9' style='margin-bottom:2em'>
	<div class="row">
	
		<div id='subs' style="overflow-y:auto; height: 600px" class='well col-lg-10 col-lg-offset-1' >
			
			<legend>
				Subscribed Announcements and Events
			</legend>
			
			<div class='col-lg-6' id='SubAnnounce'>
				
			</div>
			
			<div class='col-lg-6' id='SubEvent'>
				
			</div>
		</div>
	</div>
	
	<!--CALENDAR BEGIN-->
	<div>
		<?php include "settingPHP/7Calendar.php";
			include "functionPHP/LoadSubbedAnnouncements.php";
		?>
	</div>
	<!--CALENDAR END-->
	
</div>

<script>

	$('#articleWell').mouseover(function(){
		$(this).children().css('background-color','#e6e6e6');
	});
	$('#articleWell').mouseout(function(){
		$(this).children().css('background-color','#f2f2f2');
	});
	
	/*
	$('#subs').css('height',  + "px");//Might edit this
	
	console.log(Math.min(Math.max($('#SubAnnounce').children().length()*92, $('#SubAnnounce').children().length()*92), 600));
	*/
	
</script>

