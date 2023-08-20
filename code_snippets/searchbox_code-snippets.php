<?php

/**
 * searchBox
 */
add_shortcode( 'code_snippets_export_14', function () {
	ob_start();
	?>

	<div class="row" id="topHead">
	<div class="col" id="map">
		<p>
			Courses
		</p>
	</div>
	<div class="col" id="searchBox">
		<form action="http://localhost/wordpress/search-results/" method="get">
	<input type="text" name="q" placeholder="Search">
	</form>
	</div>
	</div>
	
	<script>
	document.querySelector('form').addEventListener('submit', function(event) {
	  event.preventDefault(); // prevent the form from submitting normally
	  var query = document.querySelector('input[name="q"]').value; // get the value of the text box
	  var url = 'http://localhost/wordpress/search-results/?q=' + encodeURIComponent(query); // construct the URL with the search query
	  window.location.href = url; // send the GET request
	});
	</script>

	<?php
	return ob_get_clean();
} );
