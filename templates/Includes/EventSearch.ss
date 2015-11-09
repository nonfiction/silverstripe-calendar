<div class='container'>
	<div class="main-content">
	<h1>{$Title}</h1>
	<% include CalendarPageMenu %>

	<div class="EventSearch">
		You've searched for "<strong>$SearchQuery</strong>".
		<div class="Events">
			<% if $Events %>
				<h2>Results</h2>
				<% include EventListEvents %>
			<% else %>
				<em>We didn't find any results.</em>
			<% end_if %>		
		</div>
	</div>
	</div>
</div>