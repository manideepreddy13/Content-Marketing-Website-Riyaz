<?php

/**
 * pagelistingAll
 */
add_shortcode( 'code_snippets_export_9', function () {
	ob_start();
	?>

	<!-- <div class="course-section-content"> -->
	<style>
	.grid-container {
	  display: grid;
	  grid-template-columns: repeat(5, 1fr);
	  grid-gap: 10px;
	}
	
		.grid-item {
	  background-color: #0F0E17;
	  padding: 20px;
	  text-align: center;
	  font-size: 16px;
	}
		@media (max-width: 575px) {
	  .grid-container {
	    grid-template-columns: repeat(3, 1fr);
		  grid-gap:2px;
	  }
		.grid-item {
	  background-color: #0F0E17;
	  padding: 5px;
	  text-align: left;
	  font-size: 12px;
	}
	}
	</style>
	<?php
		$trial = wpgetapi_endpoint( 'riyaz_app', 'getcourses', array('debug' => false) );
		$result = $trial["data"]["courses"];
		$section = $_GET['section'];
		$no_of_courses = count($result);
		$check=0;
	// 	echo '<div style="display:grid;grid-template-columns: repeat(5, 1fr);grid-gap:32px;">';
	echo '<div class="grid-container">';
		for($i=0;$i<$no_of_courses;$i++){
			if($section == $result[$i]["section_id"]){
				echo '<div class="grid-item">';
				echo '<div class="b">';
				$content_id = str_replace("#", "$", $result[$i]["content_id"]);
	        	echo '<a href="/wordpress/coursecontent/?id='.$content_id.'&k='.$i.'"> <img class="img-fluidx" src="'.$result[$i]["thumbnail_url"].'"> </a>';
				echo '</div>';
	       		echo '<div class="a"><p class="course-title">'.$result[$i]["title"].'</p></div>';
	        	echo '</div>';
			}
		}
		echo '</div>';
	?>
	<!-- </div> -->

	<?php
	return ob_get_clean();
} );
