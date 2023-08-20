<?php

/**
 * searchSnippet
 */
add_shortcode( 'code_snippets_export_13', function () {
	ob_start();
	?>

	<?php
	$url = 'https://prod.contentapi.riyazapp.com/get-courses-by-style';
	$search_arr = array();
	
	
	$payload = array('style' => 'hindustani');//, 'carnatic', 'western_classical')); // style can be 'hindustani' or 'carnatic' or 'western'
	
	$ch = curl_init();
	curl_setopt($ch, CURLOPT_URL, $url);
	curl_setopt($ch, CURLOPT_POST, 1);
	curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($payload));
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
	
	$response = curl_exec($ch);
	$httpcode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
	curl_close($ch);
	
	$data = json_decode($response, true);
	
	// foreach ($data['data']['sections'] as $course) 
	// {
	//     $search_arr[] = [strtoupper($course['title']), NULL, strtoupper($course['classical_track']),$course['id']];//, $course['content_id']]; //strtoupper
	// }
	
	
	$payload = array('style' => 'carnatic');//, 'carnatic', 'western_classical')); // style can be 'hindustani' or 'carnatic' or 'western'
	
	$ch = curl_init();
	curl_setopt($ch, CURLOPT_URL, $url);
	curl_setopt($ch, CURLOPT_POST, 1);
	curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($payload));
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
	
	$response = curl_exec($ch);
	$httpcode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
	curl_close($ch);
	
	$data = json_decode($response, true);
	
	// foreach ($data['data']['sections'] as $course) 
	// {
	//     $search_arr[] = [strtoupper($course['title']), NULL, strtoupper($course['classical_track']),$course['id']];//, $course['content_id']]; //strtoupper
	// }
	
	
	$payload = array('style' => 'western_classical');//, 'carnatic', 'western_classical')); // style can be 'hindustani' or 'carnatic' or 'western'
	
	$ch = curl_init();
	curl_setopt($ch, CURLOPT_URL, $url);
	curl_setopt($ch, CURLOPT_POST, 1);
	curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($payload));
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
	
	$response = curl_exec($ch);
	$httpcode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
	curl_close($ch);
	
	$data = json_decode($response, true);
	
	// foreach ($data['data']['sections'] as $course) 
	// {
	//     $search_arr[] = [strtoupper($course['title']), NULL, strtoupper($course['classical_track']),$course['id']]; //[1-title, 2-NULL, 3-heading, 4-id]
	// }
	$no = 0;
	
	foreach ($data['data']['courses'] as $course) 
	{
	    $search_arr[] = [strtoupper($course['title']),$course['thumbnail_url'], $no, $course['content_id']];//, [1-title, 2-thumbnail, 3-array_no]
	    $no = $no + 1;
	}
	
	//  echo "Status code: " . $httpcode . "\n";
	
	//  foreach ($search_arr as $elem) 
	//  	{
	//          echo $elem[0]. "\n" . $elem[1] . "\n" . $elem[2] . "\n" . $elem[3] . "<br>";
	//      }
	
	$search_string = $_GET['q'];
	echo '<div style="margin-right:42px;">
	        <h1>
	            Search Results for :'.$search_string.'
	        </h1>
	    </div>';
	echo '<div style="margin-right:42px">';
	$check = 0;
	foreach ($search_arr as $elem) 
	{
	    if (strpos(strtoupper($elem[0]), strtoupper($search_string)) !== false) 
	    {
			$check = $check + 1;
	        $content_id = str_replace("#", "$", $elem[3]);
	        $i = $elem[2];
	        echo '<a href="/wordpress/coursecontent/?id='.$content_id.'&k='.$i.'"> <img class="img-fluidx" src="'.$elem[1].'"> </a>';
	        echo "\n\n";
	        echo '<a href="/wordpress/coursecontent/?id='.$content_id.'&k='.$i.'">' . $elem[0] . "</a><br><br>";
	    }
	}
	if($check == 0){
		echo '<p> No results </p>';
	}
	echo '</div>';
	
	?>

	<?php
	return ob_get_clean();
} );
