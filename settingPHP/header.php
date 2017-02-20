<?php include "SQLInfo.php"; session_start(); ?>
<!DOCTYPE html>
<html>
	<head>
		<script src="//ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
		<!--<script type="text/javascript" src="js/JQuery.js"> </script>-->
		<link type="text/css" rel="stylesheet" href="bootstrap/css/bootstrap.min.css" />
		<link type="text/css" rel="stylesheet" href="bootstrap/css/bootstrap-override.css" />
		<script type="text/javascript" src="bootstrap/js/bootstrap.min.js"> </script>
		
		<script type="text/javascript" src="bootstrap/js/underscore-min.js"></script>
		<script type="text/javascript" src="bootstrap/js/calendar.js"></script>
		<script type="text/javascript" src="bootstrap/js/datepicker.js"></script>
		<script type="text/javascript" src="js/GeneralPageJS.js"> </script>
		<script src="ckeditor/ckeditor.js"></script>
		
		<script src="js/loginLogout.js"></script>
		
		<link rel="stylesheet" href="bootstrap/css/calendar.css">
		<link rel="stylesheet" href="bootstrap/css/datepicker3.css">

	</head>
	<body>
	
<!-- NAVBAR START -->
<div class="navbar navbar-default" role="navigation">
	<div class="navbar-header">
		<button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-responsive-collapse">
		  <span class="icon-bar"></span>
		  <span class="icon-bar"></span>
		  <span class="icon-bar"></span>
		</button>
		<a class="navbar-brand" href="index.php">
			<!-- Place Holder --><img src='images/jaysonSillhouette2.png' style="width:91px; margin-top:-1em"/>
		</a>
	</div>
	<div class="navbar-collapse collapse navbar-responsive-collapse">
		<ul class="nav navbar-nav">
			<li><a href="index.php">Calendar</a></li>
			<li><a href="loggedHome.php">Announcements</a></li>
			<li><a href="ClubList.php">Club List</a></li>
			<!--<li><a href='citv2.php'>CITV</a></li>-->
			<!--<li><a href='townCrier.php'>Town Crier</a></li>-->
		</ul>
		
		<ul class="nav navbar-nav navbar-right">
			<li>
				<?php
					if( $_SESSION['PermissionLevel'] >= 2 ){ 
						echo "<a href='#' class='btn btn-primary' data-toggle='modal' data-target='#clubModal' style=''>Create a New Club</a>";
					}
				?>
			</li>
			<li class="dropdown" style="margin-right:1em">
			
				<?php 
					if (isset($_SESSION['PermissionLevel'])){
					
						echo '<a href="#" class="dropdown-toggle" data-toggle="dropdown" aria-expanded="true">Welcome '.$_SESSION["STUDENT_ID"].'<div class="glyphicon glyphicon-user" style="margin-left:1em"></div></a>
								<ul class="dropdown-menu">
								  <li><a href="accountSettings.php">Account Settings</a></li>
								  <li><a href="#" id="submitLogout">Logout</a></li>
								</ul>';
					}
					
					else{
						echo '<a href="#" class="dropdown-toggle" data-toggle="dropdown" aria-expanded="true">Login<div class="glyphicon glyphicon-user" style="margin-left:1em"></div></a>
									<ul class="dropdown-menu">
									  <li>
										<div class="row">
											<form class="form-horizontal col-lg-8 col-lg-offset-2" id="LoginDropDown">
												<div class="form-group">
													<div>
														<input type="text" class="form-control" id="inputEmail" placeholder="Email/ID">
													</div>
												</div>
												<div class="form-group">
													<div>
														<input type="password" class="form-control" id="inputPassword" placeholder="Password">
													</div>
												</div>
												<div class="form-group">
													<div class="row">
														<div class="col-lg-offset-3">
															<button type="submit" class="btn btn-primary" id="submitLogin">Submit</button>
														</div>
													</div>
												</div>
											</form>
										</div>
									  </li>
									</ul>';
					}
				?>
			</li>
		</ul>
	</div>
 </div>
 
 <!-- CREATE CLUB MODAL **MUST FIX** -->
 <div id="clubModal" class="modal fade">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-hidden="true">x</button>
				<h4 class="modal-title">
					Create a Club
				</h4>
			</div>
			<div class="modal-body">
				<form class='form-horizontal'>
					<div class='form-group'>
						<label for='inputTitle' class='col-lg-2 control-label'>Club Name</label>
						<div class='col-lg-10'>
							<input id='inputName' class="form-control" type='text' placeholder='Club Name'></input>
						</div>
					</div>
					<div class='form-group'>
						<label for='inputType' class='col-lg-2 control-label'>Club Type</label>
						<div class='col-lg-10'>
							<select id='inputType' class='form-control'>
								<option>Club Type</option>
								<option value='0'>Academic and Scholastic Clubs and Activities</option>
								<option value='1'>The Arts</option>
								<option value='2'>Cultural Awareness and Service Clubs</option>
								<option value='3'>Physical Endeavors</option>
								<option value='4'>Student Government and Leadership</option>
								<option value='5'>Student Initiated</option>
								<option value='6'>Student Publications</option>
							</select>
						</div>
					</div>
					<div class='form-group'>
						<label for='clubTeacher' class='col-lg-2 control-label'>Sponsor</label>
						<div class='col-lg-10'>
							<select id='clubTeacher' class='form-control'>
								<option>Teacher Name</option>
							</select>
						</div>
					</div>
				</form>
			</div>
			<div class="modal-footer">
				<h3 style='color:red; display:none' id='fadeMeIn'>Couldn't make club. <span style="color:red" id="AppendFailText"> </span></h3>
				<button data-dismiss="modal" type="button" class="btn btn-default" id="closePopoverModal">Close</button>
				<button class='btn btn-primary' id='submitClubButt'>Submit</button>
			</div>
		</div>
	</div>
</div>
<!--<div id="clubModal" class="modal fade">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<h4 class="modal-title">
					Nothing to see here. Move along.
				</h4>
			</div>
			<div class="modal-body">
				This part of the site isn't finished yet. Don't worry. Stuff will go here.
			</div>
			<div class="modal-footer">
				<button data-dismiss="modal" type="button" class="btn btn-default" id="closePopoverModal">Close</button>
			</div>
		</div>
	</div>
</div>-->
 
<script> 

	 $(document).ready(function(){
		applyDatePickers();
		<?php 
		if($_SESSION['PermissionLevel'] == 2)
		{
			echo '$("#submitClubButt").click(function(){
				console.log("button clicked");
				$.ajax({
					url: "functionPHP/submitClub.php",
					method: "POST",
					data: {
						name:$("#inputName").val(),
						type:$("#inputType").val(),
						sponsor:$("#clubTeacher").val(),
					},
					success: function(data){
						console.log("data is "+ data);
						if( !(data.substr(0,7) === "FAILURE") ){
							console.log("data is not failure...it is"+data);
							window.location.href = "ClubPage.php?ClubId="+data;
						}
						else{
							console.log("there is a failure");
							$("#fadeMeIn").fadeIn();
							$("#AppendFailText").html(""+data.substr(8));
						}
					},
					error:function(data, data2, data3){console.log("CALL FAIL :: " + data + " :: " + data2 + " :: " + data3);}
				});
			});';
		}
		?>
		
		var AllTeachers = (<? if($_SESSION['PermissionLevel'] == 2) echo json_encode(QueryGetRows($connection, "SELECT `ID`, `LastName`, `FirstName` FROM Teachers ORDER BY `LastName`")); else echo "null"; ?>);
		console.log("Teachers:");
		console.log(AllTeachers);
		if(AllTeachers != null)
			for(var x = 0; x < AllTeachers.length; x++)
				$("#clubTeacher").append('<option value='+AllTeachers[x][0]+'>'+AllTeachers[x][1]+', '+AllTeachers[x][2]+'</option>');
	 }); 	 
	 
</script>


<!-- NAVBAR END -->