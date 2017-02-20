<?php include "settingPHP/header.php";
 $connection = mysqli_connect($db_host, $db_username, $db_password, $db_name); ?>
	<div class='col-lg-6 col-lg-offset-4'>
		<h1>Account Settings</h1>
	
		<h3>Club Settings</h3>
		<ul style="font-size:17px" id="AppendHERE">
			
		</ul>
		
		<h3>Change Contact Info</h3>
		
		<form class="form-horizontal" style="display:<?php if($_SESSION['PermissionLevel'] == 0) { echo "block"; } else { echo "none"; } ?>">

			<div class="form-group">
				<label for="inputEmail" class="col-lg-1 control-label">Email</label>
				<div class="col-lg-5">
					<input type="email" class="form-control input-sm" id="inputEmail" placeholder="New Email"><button id='changeMailButt' class="btn btn-primary btn-xs" style="margin-right:.5em">Change Email</button>
					Current:<span id='appendMailHere'>
					<?php 
						$result = $connection->query("SELECT `Email`, `Phone` FROM StudentEmails WHERE `StudentID` = '".$_SESSION['STUDENT_ID']."'");
						$row = $result->fetch_row();
						echo $row[0];
					?>
					</span>
				</div>
			</div>
			
			<div class="form-group">
				<label for="inputPhone" class="col-lg-1 control-label">Phone</label>
				<div class="col-lg-5">
					<input type="text" class="form-control input-sm" id="inputPhone" placeholder="New Phone"><button id='changePhoneButt' class="btn btn-primary btn-xs" style="margin-right:.5em" >Change Phone</button>Current:<span id='appendPhoneHere'>
					<?php echo $row[1]; ?> </span>
				</div>
			</div>

			
		</form>
		
	</div>
	
<script>
var DATA = 
<?php 
	$Query = "SELECT Clubs.`Title`, Subscriptions.`getEmail`, Subscriptions.`getText`, Clubs.`UniqueID` FROM Clubs INNER JOIN Subscriptions ON Subscriptions.`Club` = Clubs.`UniqueID` AND Subscriptions.`Student` = ".$_SESSION['STUDENT_ID'];
	$result = $connection->query($Query);
	$arr = array();
	$row = $result->fetch_row();
	while($row)
	{
		array_push($arr, $row);
		$row = $result->fetch_row();	
	}
	
	echo json_encode($arr);
?>;
$(document).ready(function(){


	for(var x = 0; x < DATA.length; x++)
	{
		
		$("#AppendHERE").append("<li data-link-target='" + DATA[x][3] + "'>"+
				"<span style='font-weight:bold; margin-right:1em'>" + DATA[x][0] + "</span>"+
				"Alerts by:"+
				"<input data-link-target='" + DATA[x][3] + "' class='emailcheck' type='checkbox' style='margin-left:1em; margin-right:.5em' " + (DATA[x][1] == 1 ? "checked" : "") + ">E-mail</input> "+
				"<input data-link-target='" + DATA[x][3] + "' class='textcheck' type='checkbox' style='margin-left:1em; margin-right:.5em' " + (DATA[x][2] == 1 ? "checked" : "") + ">Text</input>"+
				"<a data-link-target='" + DATA[x][3] + "' class='btn btn-danger btn-xs unsubButton' style='margin-left:2em'>Unsubscribe</a>"+
				"</li>");
	}
	
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
			data:{operation:"checkbox", box:bx, check:$this.is(":checked"), clubTarget:$this.attr('data-link-target'), studentTarget:<?php echo $_SESSION['STUDENT_ID'] ?>},
			dataType:"JSON",
			success:function(data)
			{
				console.log(data);
			}
		});
	}
	
	$(".unsubButton").click(function()
	{
		var objx = $(this);
		$.ajax({
			url:"functionPHP/settingAdj.php",
			method:"POST",
			data:{operation:"sub", isSubbing:0, StudentID:"<?php echo $_SESSION['STUDENT_ID']; ?>", Club:objx.attr('data-link-target')},
			success:function(data)
			{
				console.log("GotReply::" + data);
				if(data.charAt(0) == "+")
				{
					$("li[data-link-target='" + objx.attr('data-link-target') + "']").remove();
				}
			},
			error:function(){console.log("HJARNO CRASH");}
		});
	
	});
	//SETTING EMAIL/PHONE
	$('#changeMailButt').click(function(event){
		$.ajax({
			url: "functionPHP/settingAdj.php",
			data:{	operation: "email",
					id: "<?php echo $_SESSION['STUDENT_ID'] ?>",
					value: $('#inputEmail').val()
				},
			method:"POST",
			success:function(data)
			{
				console.log("Data:" + data);
				$("#appendMailHere").html(data);
			}
		});
		event.preventDefault();
	});
	$('#changePhoneButt').click(function(event){
	
		var phone = $("#inputPhone").val();
		
		phone = phone.replace(/[^\d]/g,"");
		$.ajax({
			url: "functionPHP/settingAdj.php",
			data:{	operation: "phone",
					id: "<?php echo $_SESSION['STUDENT_ID'] ?>",
					value: $('#inputPhone').val()
				},
			method:"POST",
			success:function(data)
			{
				console.log("Data:" + data);
				$("#appendPhoneHere").html(data);
			}
		});
		event.preventDefault();
	});
	
});
</script>
<?php include "settingPHP/footer.php" ?>
<!-- style="border:solid 1px red"-->