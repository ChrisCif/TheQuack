<?php if($_SESSION['PermissionLevel'] > 0 && $_SESSION['STUDENT_ID'] == $Sponsor)
		{
			echo '<button type="button" class="btn btn-primary btn-lg" data-toggle="modal" data-target="#modal1">
			Create Announcement
			</button>'; 
		}
		//else echo "PLEVEL::" . $_SESSION['PermissionLevel'];
?>
<div class="modal fade" id="modal1">
  <div class="modal-dialog" style="width: 50%;">
	<div class="modal-content">
	  <div class="modal-header">
		<button type="button" class="close" data-dismiss="modal" aria-hidden="true">x</button>
		<h4 class="modal-title">Create Announcement</h4>
	  </div>
	  <div class="modal-body">
		
		<form class="form-horizontal">
			<fieldset>
			
				<div class='form-group'>
					<label for='inputClub' class='col-lg-2 control-label'>Club</label>
					<div class='col-lg-10'>
						<?php echo $ClubName; ?>
					</div>
				</div>
			
				<div class="form-group">
				  <label for="inputTitle" class="col-lg-2 control-label">Title</label>
				  <div class="col-lg-10">
					<input type="text" class="form-control" id="inputTitle" placeholder="Title">
				  </div>
				</div>
				
				<div class="form-group">
				  <label for="inputTitle" class="col-lg-2 control-label">Full Text</label>
				  <div class="col-lg-10">
					<textarea id="inputText" class="form-control" placeholder="Full Text"></textarea>
				  </div>
				</div>
				
				<div class="form-group">
				  <label for="inputTitle" class="col-lg-2 control-label">Calender Event</label>
				  <div class="col-lg-1">
					<input type='checkbox' id='isEvent' class='form-control input-sm'/>
				  </div>
				</div>
				 
				<div id="dateForm" style="display:none">
					<div class="form-group" id='startDate'>
						<label for="inputStart" class="col-lg-2 control-label">Start</label> <div class="col-lg-10"> <input type="date" class="form-control datepicker" data-date-format="mm/dd/yyyy" id="inputStart" placeholder="mm/dd/yyyy"> </div>
					</div>
					
					<div class="form-group" id='endDate'>
						<label for="inputEnd" class="col-lg-2 control-label">End</label> <div class="col-lg-10"> <input type="date" class="form-control datepicker" data-date-format="mm/dd/yyyy" id="inputEnd" placeholder="mm/dd/yyyy"></div>
					</div>				 
				
					<div class="form-group" id='timeFlipper'>
					  <label for="inputTitle" class="col-lg-2 control-label">Timed Event</label>
					  <div class="col-lg-1">
						<input type='checkbox' id='timedEvent' class='form-control input-sm'/>
					  </div>
					</div>
				</div>
					
				<div id="timeForm" style="display:none">
					<div class="form-group" id='startTime'>
						<label for="timeStart" class="col-lg-2 control-label">Start</label> <div class="col-lg-10"> <input type="time" value="00:00 AM" placeholder="hh:mm AM" class="form-control" data-time-format="hh:mm" id="timeStart"> </div>
					</div>
					
					<div class="form-group" id='endTime' >
						<label for="timeEnd" class="col-lg-2 control-label">End</label> <div class="col-lg-10"> <input type="time" value="00:00 AM" placeholder="hh:mm PM" class="form-control" data-time-format="hh:mm" id="timeEnd" ></div>
					</div>
				</div>				
			</fieldset>
		</form>
		<div id="createFailAppendHere">
		</div>
	  </div>
	  <div class="modal-footer">
		<button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
		<button type="button" id='CreateAnnouncement' class="btn btn-primary">Create Announcement</button>
	  </div>
	</div>
  </div>
</div>

<script>

	function regexchecktime(time)
	{
		if(/^(0?\d|1[012]):[0-5]\d [APap][mM]$/.test(time))
		{
			return true;
		}
		return false;
	}
	
	function assure2(i)
	{
		i = i + "";
		if(i.length == 1)
			return "0" + i;
		return i;
	}

	$(document).ready(function(){
	
		CKEDITOR.replace('inputText');
		
		var timed = false;
		var dated = false;
		$('#isEvent').click(function(){
			$("#dateForm").slideToggle({duration:"slow", queue:false});
			$("#timeForm").slideUp('slow');
			$('#timedEvent').prop('checked', false);
			dated = !dated;
		});
		
		$('#timedEvent').click(function(){
			$("#timeForm").slideToggle({duration:"slow", queue:false});
			timed = !timed;
		}); 
		
		$('#CreateAnnouncement').click(function(){
			var fail = false;
			var inClub = <?php echo "'".$CID."'"; ?>;
			var inTitle = $('#inputTitle').val();
			var inText = CKEDITOR.instances.inputText.getData();
			console.log(inText);
			var inStartTime = "00:00";
			var inEndTime = "00:00";
			var inStartDate = "0:00";
			var inEndDate = "0:00";
			
			if(dated)
			{
				inStartDate = $('#inputStart').val();
				inEndDate = $('#inputEnd').val();
				if(timed)
				{
					if(regexchecktime($('#timeStart').val()))
					{
						inStartTime = $('#timeStart').val();
						var hours = parseInt(inStartTime.substring(0, inStartTime.indexOf(":")));
						if(/PM/.test(inStartTime))
						{
							hours += 12;
						}
						inStartTime = assure2(hours) + inStartTime.match(/:[0-5]\d/);
					}
					else
					{
						fail = "Start time invaild!";
					}
					
					if(regexchecktime($('#timeEnd').val()))
					{
						inEndTime = $('#timeEnd').val();
						var hours = parseInt(inEndTime.substring(0, inEndTime.indexOf(":")));
						if(/PM/.test(inEndTime))
						{
							hours += 12;
						}
						inEndTime = assure2(hours) + inEndTime.match(/:[0-5]\d/);
					}
					else
					{
						fail = "End time invaild!";
					}
				}
			}
			
			if(!fail)
			{
				$.ajax({
					method:"POST",
					url:"functionPHP/createAnnouncement.php",
					data: {type:dated, club:inClub, title:inTitle, text:inText, startDate:inStartDate, endDate:inEndDate, startTime:inStartTime, endTime:inEndTime},
					dataType:"JSON",
					success: function(data){
						$('#modal1').modal('hide');
						AllAnnouncements.push(data);
						loadAnnouncements();
						location.reload();
					},
					error: function (request, status, error) {
						console.log("There was an error: " + status + error);
					}
				});
			}
			else
			{
				console.log("FAIL::" + fail);
				$("#createFailAppendHere").append(	'<div class="alert alert-dismissable alert-warning" style="display:none">'+
													  '<button type="button" class="close" data-dismiss="alert">×</button>'+
													  '<h4>Problem</h4>'+
													  '<p> ' + fail + ' </p>'+
													'</div>');
			}
		});
	 }); 
</script>