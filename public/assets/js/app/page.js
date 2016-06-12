$(document).ready(function() {

	var pathName = window.location.pathname;
	var pattern = /\/app\/pages\/\d/;

	if (pattern.test(pathName)) {

		var eventsList = document.getElementById('events');

		function generateEventItems(events) {

			for (var i = 0; i < events.length; i++) {
				event = events[i];
				var eventHtml = "<li><div class='row'><div class='text-left col-xs-offset-1'><h6>"+ event.name + "</h6><br><div class='col-xs-11'>" + event.description + "</div></div></li><br>";
				eventsList.innerHTML += eventHtml;
			}
		}

		$.ajax({
			type: 'POST',
			url: '/app/page/events',
			data: { 
				pageId: pageId
			}
		}).done(function(response) {
			if(JSON.parse(response).events == null) {
				eventsList.innerHTML += "<h3><p class='category'>Whoops...</p>No events found</h3>";
			}
			else {
				var events = JSON.parse(response).events;
				generateEventItems(events);
			}
		});
	}

});