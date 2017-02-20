<div>
	<!-- Header above the calendar that displays date -->
	<div class="page-header">
		<h1 id="title"></h1>	<!-- Title tag automatically populated by calendar -->
		<div class="btn-group"> <!-- View button group -->
			<button class="btn btn-default" data-calendar-view="year">Year</button>
			<button class="btn btn-primary" data-calendar-view="month">Month</button>
			<button class="btn btn-default" data-calendar-view="week">Week</button>
			<button class="btn btn-default" data-calendar-view="day">Day</button>
		</div>
		<div class="btn-group"> <!-- Nav button group -->
			<button class="btn btn-default" data-calendar-nav="prev">&lt;&lt; Prev</button>
			<button class="btn btn-default btn-primary" data-calendar-nav="today">Today</button>
			<button class="btn btn-default" data-calendar-nav="next">Next &gt;&gt;</button>
		</div>
	</div>
	<div id="calendar"></div>	<!-- Div populated by the calendar -->
</div>
		
		
<div class="modal fade" id="events-modal"> <!-- An initially hidden modal to display event info -->
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
				<h3>Event</h3>
			</div>
			<div class="modal-body" style="height: 400px">
			</div>
			<div class="modal-footer">
				<a href="#" data-dismiss="modal" class="btn btn-default">Close</a>
			</div>
		</div>
	</div>
</div>

<script type="text/javascript">

	$(document).ready(function(){

		var calendar = $("#calendar").calendar({ 												// sets up the Calendar
				modal : "#events-modal", 														//The modal to show events in
				modal_type : "ajax", 															//Allows HTML in the modal
				modal_title : function (e) {
				return e.title + 
				"<a href='ClubPage.php?ClubId=" + e.ClubID + "' style='float:right;'><h5 class='modal-title'>"+e.ClubName+"</h5></a><h5 class='modal-title'>" + e.TimeStamp + "</h5>"},
				
				//Function to get event titles
				tmpl_path: "/Capstone/Activities/DEV/tmpls/", 									//Path from public_html to template folder
				events_source: 'functionPHP/pullEvents.php',										//PHP file from which to pull events		
				onAfterViewLoad: function(view) {												//After the calendar view loads (Used to change button properties)
					$('#title').text(this.getTitle());											//Sets the title
					$('.btn-group button[data-calendar-view]').attr("class", "btn btn-default");//Changes all buttons to default
					$('button[data-calendar-view="' + view + '"]').addClass('btn-primary');		//Changes current view button to primary.
				},
				onAfterEventsLoad: function(events) {											//Runs when events load
					if(!events) {																//If there are no events
						return;
					}
					/*
					var list = $('#eventlist');													//Sets list to load events into
					list.html('');																//Clears list
					$.each(events, function(key, val) {											//For each event
						$(document.createElement('li'))											//Creates an element and adds it to the list.
						.html('<a href="' + val.url + '">' + val.title + '</a>')
						.appendTo(list);
					});
					*/
				},
				disable_day:false,
		});
	
		$('.btn-group button[data-calendar-view]').each(function() {	//Changes Calendar views
			var $this = $(this);										//Set up like this by default, I'm not sure why, but I didn't want to change it, just in case.
			$this.click(function() {									//When this is clicked
				calendar.view($this.data('calendar-view'));				//Changes calendar view.
			});	
		});
		
		$('.btn-group button[data-calendar-nav]').each(function() {
			var $this = $(this);
			$this.click(function() {
				calendar.navigate($this.data('calendar-nav')); // Everytime the "next" "prev" and "today" buttons are clicked, navigate the calendar.
			});	
		});
		
		
	});
</script>