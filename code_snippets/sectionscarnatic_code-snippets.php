<?php

/**
 * sectionsCarnatic
 */
add_shortcode( 'code_snippets_export_7', function () {
	ob_start();
	?>

	<div class="course-section-content">
	    <?php
	    $trial = wpgetapi_endpoint( 'carnatic', 'getcarnatic', array('debug' => false) );$result = array();
	    $result = $trial["data"]["sections"];
	    $resultx = array();
	    $resultx = $trial["data"]["courses"];
	    $columnArray = array();
	    $columnArray = $result;
	    $columnArrayx = array();
	    $columnArrayx = $resultx;
	    
	    $no_of_courses = count($columnArrayx);
	    $length = count($columnArray);	
	    $heading = "Carnatic Classical";	
	    for ($j = 0; $j < $length; $j++) {
	        $section = $result[$j]["id"];
	        $section_name = $result[$j]["title"];
	        echo '<p class="titleCourseSection">'.$result[$j]["title"].'</p>';
	        $mas = 0;$tas = 0;
	        $no_of_courses = count($resultx);
			echo '<div class="container">';
			echo '<div class="row">';
	        $total = 0;
	        for($r=0;$r<$no_of_courses;$r++){
	                if ($section == $resultx[$r]["section_id"]) {
	                $total++;
	            }
	        }
	        $total = $total - 4;
	        for ($k = 0; $k < $no_of_courses; $k++) {
	            if ($section == $resultx[$k]["section_id"] && $mas < 4) {
	                $content_id = str_replace("#", "$", $resultx[$k]["content_id"]);
					echo '<div class="col-sm">';
	                echo '<div class="b">';
	                echo '<a href="/wordpress/coursecontent/?id='.$content_id.'&k='.$k.'"> <img class="img-fluidx" src="'.$resultx[$k]["thumbnail_url"].'"> </a>';
	                echo '</div>';
	                echo '<div class="a">';
	                echo '<p class="course-title">' . $resultx[$k]["title"] . '</p>';
	                echo '</div>';
	                $mas++;
					echo '</div>';
	            }
	            if($mas == 4 && $total > 0){
					echo '<div class="col-sm">';
					echo '<div class="b">';
	    echo '<a href="http://localhost/wordpress/listpage/?title='.$section_name.'&section='.$section.'&h='.$heading.'"><button class="btn btn-dark btn-sq-responsive">'.$total.' more </button></a>';
					echo '</div>';
					echo '</div>';
	                break;
	            }
	        }
			while($total<1){
				echo '<div class="col-sm">';
				echo '<br>';
				echo '</div>';
				$total++;
			}
	        echo '</div>';
	        echo '</div>';
	    }
	    ?>
	    </div>

	<?php
	return ob_get_clean();
} );
