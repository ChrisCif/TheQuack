<?php include "settingPHP/header.php" ?>
<!-- Pudgy papal potatoes predictably placed pumpkin pineapple puree past possibly preoccupied partial parents' plates, probably. -->
<style>
	
	#logo
	{
		border-style: dashed;
		border-color: black;
		height: 100px;
	}
	
	iframe
	{
		height: 300px;
		width: 500px;
		margin-top: 20px;
	}
	
	#boxes
	{
		margin-left: 10px;
		margin-right: 10px;
		margin-bottom: 10px;
	}
	
	#siteWell
	{
		margin-top: 100px;
		text-align: center;
	}
	
	#featuredVideoWell
	{
		display: none;
		float: right;
		margin-top: 100px;
		text-align: center;
		cursor: pointer;
	}
	
	.box
	{
		cursor: pointer;
	}
	
	#thumbnail
	{
		height: 85px;
		width: 85px;
		float: left;
	}
	
	h1
	{
		font-size: 12px;
		text-decoration: underline;
		font-weight: bold;
	}
	
	p
	{
		font-size: 11px;
	}
	
</style>

<div class='col-lg-12'>
	<div id='logo' class='col-lg-3 col-lg-offset-1'>
		<img src='images/citvLogoByChris.png'/>
	</div>
</div>

<div class='col-lg-2'>
		<a href='http://citvproduction.webs.com/'>
			<div id='siteWell' class='well'>
				Visit the Official CITV Web-Site!
			</div>
		</a>
</div>

<div class='col-lg-4 col-lg-offset-2'>
	<div id='player'>
		<iframe src="//www.youtube.com/embed/jg9rFWqOBaI" frameborder="0" allowfullscreen>
		</iframe>
	</div>
</div>

<div class='col-lg-2 col-lg-offset-2'>
	<div id='featuredVideoWell' class='well'>
		Featured Video
	</div>
</div>

<div id='boxes' class='col-lg-10 col-lg-offset-1'>
		<table>
			<tbody id='boxes'>
			</tbody>
		</table>
</div>

<script>

	$(document).ready(function(){
	
		
		for(var r=0; r<5; r++){
		
			$('#boxes').append("<tr>");
			
			for(var c=0; c<5; c++){
				var colspan = parseInt(Math.random()*3)+1;
				
				//PULLING STUFF FROM YOUTUBE
				var vidID = 'jg9rFWqOBaI';
				var youTubeURL = 'http://gdata.youtube.com/feeds/api/videos/'+vidID+'?v=2&alt=json&prettyprint=true';
				var json = (function() {
					var json = null;
					$.ajax({
						'async': false,
						'global': false,
						'url': youTubeURL,
						'dataType': "json",
						'success': function(data) {
							json = data;
						}
					});
					return json;
				})();

				//var tite = json.entry.title.$t
				var description = json.entry.media$group.media$description.$t;
				
				$('#boxes').append(
				"<td class='box' colspan="+colspan+" style='border: 2px dashed black; height:125px; width:200px'>"+
					"<div class='col-lg-6'>"+//Image WILL append here...
						"<img id='thumbnail' src='http://img.youtube.com/vi/jg9rFWqOBaI/hqdefault.jpg'/>"+
					"</div>"+
					"<div class='col-lg-6'>"+
						"<h1>"+json.entry.title.$t+"</h1>"+//Things WILL append here. I'm testing for now...
						"<p>"+((""+json.entry.media$group.media$description.$t).substring(0, 100)+"...")+"</p>"+
					"</div>"+
				"</td>"
				);
			}
			console.log(json.entry.media$group.media$description.$t+"");
			$('#boxes').append('</tr>');
			
		}
		
		
		$('.box').click(function(){
			$('#player').empty();
			$('#player').append("<iframe src='"+$(this).attr('value')+"' frameborder='0' allowfullscreen></iframe>");
			
			$('#featuredVideoWell').css('display','inline');
		});
		
		$('.box').mouseover(function(){
			$(this).css('background-color', '#cfcfcf');
		});
		$('.box').mouseout(function(){
			$(this).css('background-color','white');
		});
		
		$('#featuredVideoWell').click(function(){
			$('#player').empty();
			$('#player').append("<iframe src='//www.youtube.com/embed/jg9rFWqOBaI' frameborder='0' allowfullscreen></iframe>");
			$('#featuredVideoWell').css('display','inline');
		});
		
	});
	
</script>

<?php include "settingPHP/footer.php" ?>