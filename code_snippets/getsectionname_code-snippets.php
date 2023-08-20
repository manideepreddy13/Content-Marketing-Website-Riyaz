<?php

/**
 * getSectionName
 */
add_shortcode( 'code_snippets_export_10', function () {
	ob_start();
	?>

	<?php
		$trialh = wpgetapi_endpoint( 'riyaz_app', 'getcourses', array('debug' => false) );//hindustani
		
		$section = $_GET['section'];
		$title = $_GET['title'];
	
		echo '<p class="sectionHeading">'.$title.'</p>';
	?>

	<?php
	return ob_get_clean();
} );
