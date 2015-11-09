<div class="container">
	<div class="main-content">
	<h1>{$Title}</h1>
		<% if $Action == 'eventregistration' %>
			<% include CalendarPageMenu CurrentMenu='eventregistration' %>
		<% else %>
			<% include CalendarPageMenu CurrentMenu='eventlist' %>
		<% end_if %>
		<div class="EventList">
			<% if $Events %>
				<div class="Events">
					<% include EventListEvents %>
				</div>
			<% else %>
				<em class"noEventsMsg">No events in this period</em>
			<% end_if %>
		</div>
		</div>
	</div>
</div>





