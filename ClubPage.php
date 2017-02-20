<?php
include "settingPHP/header.php";
if(isset($_GET['ClubId']))
	$CID = $_GET['ClubId'];
else
	$CID = 1;

$connection=mysqli_connect($db_host, $db_username, $db_password, $db_name);
$Query = "SELECT `Title`, `InfoText`, `ProfilePicture`, `SponsorID` FROM Clubs WHERE `UniqueID`='$CID'";
$result = $connection->query($Query);
$row = $result->fetch_row();
$ClubName = $row[0];
$ProfPic = $row[2];
$Sponsor = $row[3];
?>

<style type="text/css">
.BigContainer
{
	max-width:90%;
	width:90%;
}

.lessVerticalMargin
{
	margin-top:0;
}

#ClubImage
{
	height:100%;
	border:1px solid black;
}

#VideoGoesHere
{
	float:left;
	margin:5px;
}

#subscription
{
	margin-top:30px;
	margin-left:2px;
}
</style>


<div class="container BigContainer" style="margin-bottom: 2em">
	<div class="row">
		<div class="col-lg-9">
			<div class="well">
				<div class="page-header lessVerticalMargin">
					<div class="row">
						<div class="col-lg-4">
							<form style="display:none" id="uploadForm" method="POST" enctype="multipart/form-data" action="functionPHP/upload_image.php">
								<input type="hidden" id="CID" name="CID" value='<?php echo $CID; ?>'>
								<input type="file" id="uploadImg" name="uploadImg">
								<input type="submit" name="upload" id="upload" value="Upload">
							</form>
							<img id="ClubIconImage" style='width: 125px; height: 125px' src='<?php echo $ProfPic ?>'> </img>
						</div>
						<div class="col-lg-8">
							<h1 id="clubName"><!--Club Name--><?php echo $ClubName; ?></h1><input type="text" id="changeClubName" style="display:none" value='<?php echo $ClubName; ?>'/>
						</div>
					</div>
				</div>
				<div>
					<div id="fullContent">
						<div id="toggleText"><?php echo $row[1]; ?></div>
						<div id="toggleCk" style="display:none"><textarea id="editor"><?php echo $row[1]; ?></textarea></div>
						<?php if($_SESSION['PermissionLevel'] > 0 && $_SESSION['STUDENT_ID'] == $Sponsor) echo '<a class="btn btn-default" id="edit">Edit</a>'; ?>
						<a class="btn btn-default" id="save" style="display:none">Save</a>
						<a class="btn btn-default" id="cancel" style="display:none">Cancel</a>
						<script>
							$(document).ready(function(){
								CKEDITOR.replace('editor');
								$("#edit").click(function(){
								
									//ck editor
									$("#toggleText").slideUp(1000);
									$("#toggleCk").delay(1000).slideDown(1000);
									$(this).hide();
									$("#save").show();
									$("#cancel").show();
									
									//profile pic
									$("#uploadForm").show();
									
									//clubName
									$("#changeClubName").show();
								});
								
								$("#save").click(function(){
									
									//ck editor
									$("#toggleCk").slideUp(1000);
									$("#toggleText").delay(1000).slideDown(1000);
									$(this).hide();
									$("#cancel").hide();
									$("#edit").show();
									
									//profile pic
									$("#uploadForm").hide();
									
									//clubName
									$("#changeClubName").hide();
									
									$.ajax({
										url:"functionPHP/editClubInfo.php",
										method:"POST",
										data:{ckVal:CKEDITOR.instances.editor.getData(), CID:'<?php echo $CID ?>', clubName:$("#changeClubName").val()},
										success:function(data){
											var arr=jQuery.parseJSON(data);
											$("#toggleText").html(arr[0]);
											$("#clubName").html(arr[1]);
											
										}	
									});
								});
								
								$('#uploadForm').on('submit',(function(event) {
									event.preventDefault();
									var formData = new FormData(this);

									$.ajax({
										type:'POST',
										url: $(this).attr('action'),
										data:formData,
										cache:false,
										contentType: false,
										processData: false,
										success:function(data){
											$("#ClubIconImage").attr("src", data);
										},
									});
								}));
								
								$("#cancel").click(function(){
									
									//ck editor
									$("#toggleCk").slideUp(1000);
									$("#toggleText").delay(1000).slideDown(1000);
									$(this).hide();
									$("#save").hide();
									$("#edit").show();
									
									//profile pic
									$("#uploadForm").hide();
									
									//clubName
									$("#changeClubName").hide();
								});
							});
						</script>
					</div>
					
					<!---SUBSCRIPTION STUFFS--->
					<div id='subscription' class='row'>
						
						<!--SUBSCRIBE BUTTON START-->
						<?php if(isset($_SESSION['STUDENT_ID']) && $_SESSION['PermissionLevel'] == 0)
							{
								echo "<p>Receive notifications via:</p>
										<div class='checkboxes' style='display:none'>
										  <label class='col-lg-2 col-lg-offset-1'>
											<input class='emailcheck' type='checkbox'> E-mail</input>
										  </label>
										  <label class='col-lg-2'>
											<input class='textcheck' type='checkbox'> Text</input>
										  </label>
										</div>";
										
								
								if(in_array(array("$CID"), $_SESSION['Subscriptions']))
								{
									
									echo "
										<div class='col-lg-offset-3 col-lg-4'>
										<a class='btn btn-warning' subtype=0 id='Subbutton'>Unsubscribe</a>
										</div>
									";
								}
								else
								{
									echo "
										<div class='col-lg-offset-3 col-lg-4'>
										<a class='btn btn-success' subtype=1 id='Subbutton'>Subscribe</a>
										</div>
									";
								}
							}
						?>
						<!--SUBSCRIBE BUTTON END-->
					</div>
					
				</div>

			</div>
		</div>	
		<div class='col-lg-3 well ' style='overflow-y: auto; height:550px'>
				<legend>Latest Activity</legend>
				<!--
				<div class="panel panel-danger">
					<button type="button" class="close" data-dismiss="alert" style="margin-right:10px">x</button>
					<div class="panel-heading">
						<h3 class="panel-title">That Club</h3>
					</div>
					<div class="panel-body">
						This is a club announcement.
					</div>
				</div>
				
				<div class="panel panel-danger">
					<button type="button" class="close" data-dismiss="alert" style="margin-right:10px">x</button>
					<div class="panel-heading">
						<h3 class="panel-title">That Club</h3>
					</div>
					<div class="panel-body">
						This is a club announcement.
					</div>
				</div>					
			
			
				<div class="panel panel-primary">
					<button type="button" class="close" data-dismiss="alert" style="margin-right:10px">x</button>
					<div class="panel-heading">
						<h3 class="panel-title">This Club</h3>
					</div>
					<div class="panel-body">
						This is a club event.
					</div>
				</div>
				
				-->
				<div id="eventappendhere">
				
				</div>
				<script type="text/javascript">
				console.log("Sponsor: " + <? echo $Sponsor; ?> + ", User: " + <? echo $_SESSION['STUDENT_ID']; ?>);
				var AllAnnouncements;
				
				function loadAnnouncements()
				{
					for(var x = AllAnnouncements.length-1; x >= 0; x--)
					{
						if(AllAnnouncements[x][2] == "1")
							$("#eventappendhere").append('<div id="EventAppend' + x + '" class="panel panel-danger EventExpand"><button type="button" class="close" data-dismiss="alert" style="margin-right:10px">x</button><div class="panel-heading"><a href="ClubPage.php?ClubId='+<?php echo $CID ?>+'"><h3 style="color: white" class="panel-title"><?php echo $ClubName; ?></h3></a></div><div class="panel-body"><a href="#" class="HiddenLink" data-toggle="modal" data-target="#BigModal">' + AllAnnouncements[x][0] + '</a></div></div>');
						else
							$("#eventappendhere").append('<div id="AnnounceAppend' + x + '" class="panel panel-primary AnnounceExpand"><button type="button" class="close" data-dismiss="alert" style="margin-right:10px">x</button><div class="panel-heading"><a href="ClubPage.php?ClubId='+<?php echo $CID ?>+'"><h3 style="color: white" class="panel-title"><?php echo $ClubName; ?></h3></a></div><div class="panel-body"><a href="#" class="HiddenLink" data-toggle="modal" data-target="#BigModal">' + AllAnnouncements[x][0] + '</a></div></div>');
					}
				}
					
				$(document).ready(function(){
					 AllAnnouncements = (<?php 
						$Query = "SELECT `Title`, `InnerDetail`, `isEvent`, `EventStart`, `EventEnd`, `ClubID` FROM Announcements WHERE `ClubID`='$CID'";
						$result = $connection->query($Query);
						$output = array();
						$row = $result->fetch_row();
						while($row)
						{
							array_push($output, $row);
							$row = $result->fetch_row();
						}
						echo json_encode($output); 
					?>);
					
					loadAnnouncements();
					
					
					if($("#Subbutton").hasClass("btn-primary"))
					{
					}
					else
					{
						$(".checkboxes").show();
					}
					
					function ShowModal(Title, Inner, clubName, clubID, timestamp)
					{
						$("#ModTitle").html(Title);
						$("#ClubTitle").html(clubName);
						$("#ModBod").html(Inner);
						$("#timeStamp").html(timestamp);
					}
					
					
					$(".AnnounceExpand").click(function()
					{
						console.log("announce expand");
						var id = $(this).attr("id");
						id = id.substr(14);
						ShowModal(AllAnnouncements[id][0], AllAnnouncements[id][1], "<?php echo $ClubName; ?>", <?php echo $CID ?>, AllAnnouncements[id][3]);
					});
					
					$(".EventExpand").click(function()
					{
						console.log("event expand");
						var id = $(this).attr("id");
						id = id.substr(11);
						ShowModal(AllAnnouncements[id][0], AllAnnouncements[id][1], "<?php echo $ClubName; ?>", <?php echo $CID ?>, AllAnnouncements[id][3] + " to " + AllAnnouncements[id][4]);
					});
					
					if($("#Subbutton").hasClass("btn-success")){
						$(".emailcheck").attr("disabled","");
						$(".textcheck").attr("disabled","");
					}
					
					$("#Subbutton").click(function()
					{	
						var objx = $(this);
						$.ajax({
							url:"functionPHP/settingAdj.php",
							method:"POST",
							data:{operation:"sub", isSubbing:objx.attr('subtype'), StudentID:"<?php echo $_SESSION['STUDENT_ID']; ?>", Club:"<?php echo $CID; ?>"},
							success:function(data)
							{ 
								if(data.charAt(0) == '+')
								{
									if(objx.hasClass("btn-success"))
									{
										objx.html("Unsubscribe");
										$(".emailcheck").removeAttr("disabled");
										$(".textcheck").removeAttr("disabled");
										objx.attr('subtype', 0);
									}
									else
									{
										objx.html("Subscribe");
										$(".emailcheck").attr("disabled","");
										$(".textcheck").attr("disabled","");
										$('.emailcheck').prop('checked', false);
										$('.textcheck').prop('checked', false);
										objx.attr('subtype', 1);
									}
									objx.toggleClass("btn-success");
									objx.toggleClass("btn-warning");
									
								}
							}
						});
					});
					<?php
					if($_SESSION['PermissionLevel'] == 0 && isset($_SESSION['PermissionLevel']))
					{
						echo '
						$(".emailcheck").click(function(){
							doAjax($(this), "getEmail");
						});
						$(".textcheck").click(function(){
							doAjax($(this), "getText");
						});
						function doAjax($this, bx)
						{
							$.ajax({
								method:"POST",
								url:"functionPHP/settingAdj.php",
								data:{operation:"check", box:bx, check:$this.is(":checked"), clubTarget:'.$CID.', studentTarget:'.$_SESSION['STUDENT_ID'].'},
								dataType:"JSON",
								success:function(data)
								{
									console.log(data);
								}
							});
						}';
					}
					?>
				});
				</script>
			</div>
		</div>
		
		<?php include "settingPHP/announcement.php"; ?>
		
	</div>
</div>
<div class="modal fade" id="BigModal">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title"><span id="ModTitle">Modal title</span>
			<a href="ClubPage.php?ClubId=<?php echo $CID ?>" style="float:right;"><h5 class="modal-title" id="ClubTitle"></h5></a>
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
<?php include "settingPHP/footer.php" ?>