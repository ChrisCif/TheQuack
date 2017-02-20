<?php include "settingPHP/header.php" ?>

<!-- Everything here is in the body. Don't worry about ending the body tag either. The footer does that. -->
<style type='text/css'>

h3
{
	margin-top: 75px;
}

iframe <!-- Change this at some point...also something's wrong(?) -->
{
	width: 450px;
	height: 250px;
}

h1
{
	margin-top: 25px;
}

#vidCol
{
	margin-right: 10px;
}

#artCol
{
	margin-left: 10px;
}

#featVid
{
	width: 450px;
	height: 250px;
	margin-bottom: 25px;
}

</style>


<div class='col-lg-10 col-lg-offset-1'>
	<h1>CITV Archive Page</h1>
</div>

<!--FEATURED VIDEO-->
<div class='col col-lg-4 col-lg-offset-4'>
	<div class='row'>
			<h2>Featured Video</h2>
	</div>
	<div class='row' style="width:100%">
		<iframe style="width:100%" id='featVid' src="//www.youtube.com/embed/jg9rFWqOBaI" frameborder="0" allowfullscreen>
		</iframe>
	</div>
</div>

<!--BEGIN VIDEO COLUMN-->
<div id='vidCol' class = 'col col-lg-5 col-lg-offset-1 well'>
	<legend>Videos</legend>
	
	<!--VIDEO 1-->
	<div class='row'>
		<h3 style='margin-top: 10px'>Video 1 - November 17, 2014</h3>
	</div>
	<div class='row col-lg-offset-1'>
		<div class='row'>
			<iframe  src="//www.youtube.com/embed/jg9rFWqOBaI" frameborder="0" allowfullscreen>
			</iframe>
		</div>
	</div>
	
	<!--VIDEO 2-->
	<div class='row'>
		<h3>Video 2 - November 15, 2014</h3>
	</div>
	<div class='row col-lg-offset-1'>
		<div class='row'>
			<iframe  src="//www.youtube.com/embed/jg9rFWqOBaI" frameborder="0" allowfullscreen>
			</iframe>
		</div>
	</div>
	
</div>
<!--END VIDEO COLUMN-->

<!--BEGIN ARTICLE COLUMN-->
<div id='artCol' class='col col-lg-5 well'>
	<legend>Articles</legend>
	
	<!--ARTICLE 1-->
	<div class='row'>
		<h3 style='margin-top: 10px'>Article 1 - November 16, 2014</h3>
	</div>
	<div class="panel panel-default">
		<div class="panel-heading">
			<h4><a href='#'>Article Title</a></h4>
		</div>
		<div class="panel-footer">
			<p><i>Written by Author Name</i></p>
		</div>
	</div>
	
	<!--ARTICLE 2-->
	<div class='row'>
		<h3>Article 2 - November 14, 2014</h3>
	</div>
	<div class="panel panel-default">
		<div class="panel-heading">
			<h4><a href='#'>Article Title</a></h4>
		</div>
		<div class="panel-footer">
			<p><i>Written by Author Name</i></p>
		</div>
	</div>
	
</div>

<?php include "settingPHP/footer.php" ?>