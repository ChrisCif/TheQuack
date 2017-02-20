<?php include "settingPHP/header.php" ?>
<style>

	#boxes
	{
		margin-top: 30px;
	}
	
	.box
	{
		background-color: white;
		cursor: pointer;
	}
	
	#siteWell
	{
		margin-top: 100px;
		text-align: center;
	}
	
</style>

<!-- IMAGE -->
<div class='col-lg-10 col-lg-offset-1' style='border: 1px dashed black'>
	<p>Image will be bigger</p>
	<img src='images/townCrierLogoEw.png'/>
</div>

<!-- WEB LINK -->
<div class='col-lg-2'>
		<a href='http://pwhstowncrier.weebly.com/'>
			<div id='siteWell' class='well'>
				Visit the Official Town Crier Website!
			</div>
		</a>
</div>

<!-- FEATURED ARTICLE -->
<div class='col-lg-8 panel-default'>
	<h1>Featured Article</h1>
	<a href='#'>
		<div id='featuredArtice' data-toggle='modal' data-target='#myModal' class='panel-body' style='border: 1px solid black; color: black'>
			<div id='image' class='col-lg-2'>
				<img src='images/default_profile.png'/>
			</div>
			<div id='textIGuess' class='col-lg-10'>
				<div class='row'>
					<h2>Title</h2>
				</div>
				<p>
					Description
				</p>
			</div>
		</div>
	</a>
</div>

<div id='boxes' class='col-lg-10 col-lg-offset-1'>
	<table>
		<tbody id='boxes'>
		</tbody>
	</table>
</div>

<!-- MODAL -->
<div class="modal fade" id="myModal">
	<div class="modal-dialog">
		<div class="modal-content">
		  <div class="modal-header">
			<button type="button" class="close" data-dismiss="modal" aria-hidden="true">x</button>
			<h4 class="modal-title">Article Title</h4>
		  </div>
		  <div class="modal-body">
			<p>
				Text
			</p>
		  </div>
		  <div class="modal-footer">
			<button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
		  </div>
		</div>
	</div>
</div>

<script>

	$(document).ready(function(){
	
		for(var r=0; r<5; r++){
		
			$('#boxes').append("<tr>");
			
			var totalSpan = 0;
			
			/*for(var c=0; c<5; c++){
				var colspan = parseInt(Math.random()*3)+1;
				
				if(colspan + totalSpan <= 5){
					totalSpan += colspan
					$('#boxes').append("<td data-toggle='modal' data-target='#myModal' class='box' colspan="+colspan+" style='border: 2px dashed black; height:125px; width:197.875px'></td>");
				}
				else{
					
				}
				
			}*/
			
			do{
				var colspan = parseInt(Math.random()*3)+1;
				
				//var spans = [];
				
				if((totalSpan + colspan) <= 5){
					console.log("colspan: "+colspan);
					//spans.push(colspan);
					totalSpan += colspan;
					$('#boxes').append("<td data-toggle='modal' data-target='#myModal' class='box' colspan="+colspan+" style='border: 2px dashed black; height:125px; width:197.875px'></td>");
					console.log("totalSpan: "+totalSpan);
				}
				
			}
			while(totalSpan < 5);
			//console.log(r+": "+totalSpan);
			
			/*
			for(var x=0; x<spans.length; x++){
				
				console.log("spans length: "+spans.length);
				console.log("spans: "+spans);
				$('#boxes').append("<td data-toggle='modal' data-target='#myModal' class='box' colspan="+spans[x]+" style='border: 2px dashed black; height:125px'></td>");
			}
			*/
			
			$('#boxes').append('</tr>');
			
		}
		
		$('.box').mouseover(function(){
			$(this).css('background-color', '#cfcfcf');
		});
		$('.box').mouseout(function(){
			$(this).css('background-color', 'white');
		});
		
		$('#featuredArtice').mouseover(function(){
			$(this).css('background-color', '#eeeeee');
		});
		$('#featuredArtice').mouseout(function(){
			$(this).css('background-color', 'white');
		});
		
	});
	
</script>


<?php include "settingPHP/footer.php" ?>