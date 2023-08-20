<?php

/**
 * mapCourse
 */
add_shortcode( 'code_snippets_export_11', function () {
	ob_start();
	?>

	<div class="row" id="topHead">
	<?php
			$trialh = wpgetapi_endpoint( 'riyaz_app', 'getcourses', array('debug' => false) ); // hindustani
	
			$section = $_GET['section'];
			$title = $_GET['title'];
			$head = $_GET['h'];
			echo '<div class="col" id="map">';
			echo '<p class="mapCourse">Courses / '.$head.' /<span style="color:#FFFFFFDE;">'.$title.'</p>';
			echo '</div>';
	 		echo '<div class="col" id="searchBox">';
	 		echo '<form action="http://localhost/wordpress/search-results/" method="get">';
	 		echo '<input type="text" name="q" placeholder="Search">';
	 		echo '</form>';
	 		echo '</div>';
	?>	
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
