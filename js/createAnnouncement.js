$(document).ready(function(){
	var timed = false;
	var dated = false;
	$('#isEvent').click(function(){
		$("#startDate").slideToggle({duration:"slow", queue:false});
		$("#endDate").slideToggle({duration:"slow", queue:false});
		$("#timeFlipper").slideToggle({duration:"slow", queue:false});
		dated = !dated;
	});
	
	$('#timedEvent').click(function(){
		$("#startTime").slideToggle({duration:"slow", queue:false});
		$("#endTime").slideToggle({duration:"slow", queue:false});
		timed = !timed;
	}); 
	
	$('#CreateAnnouncement').click(function(){
		var inClub = $('#inputClub').val();
		var inTitle = $('#inputTitle').val();
		var inText = $('#inputText').val();
		var inStartTime = "0:00";
		var inEndTime = "0:00";
		var inStartDate = "0:00";
		var inEndDate = "0:00";
		if(dated)
		{
			inStartDate = $('#inputStart').val();
			inEndDate = $('#inputEnd').val();
			if(timed)
			{
				inStartTime = $('#timeStart').val();
				inEndTime = $('#timeEnd').val();
			}
		}
	
		$.ajax({
			method:"POST",
			url:"functionPHP/createAnnouncement.php",
			data: {type:dated, club:inClub, title:inTitle, text:inText, startDate:inStartDate, endDate:inEndDate, startTime:inStartTime, endTime:inEndTime},
			dataType:"JSON",
			success: function(data){
				alert(data);
			}
		});
	});
 }); 