<?php

/**
 * getCourseDetails
 */
add_shortcode( 'code_snippets_export_12', function () {
	ob_start();
	?>

	<style>
	.modal {
				display: none; /* Hidden by default */
				position: fixed; /* Stay in place */
				z-index: 1; /* Sit on top */
				padding-top: 100px; /* Location of the box */
				left: 0;
				top: 0;
				width: 100%; /* Full width */
				height:100%; /* Full height */
				background-color: rgb(0,0,0); /* Fallback color */
				background-color: rgba(0,0,0,0.9); /* Black w/ opacity */
	}
	
	/* The content inside the pop-up */
	#popupContent {
				margin: auto;
				display: block;
				width: 100%;
				max-width: 800px;
				max-height: 800px;
	}
	
	/* Style the images inside the content area */
	#popupContent img {
				margin: auto;
				display: block;
				width: 100%;
				max-width: 800px;
				max-height: 800px;
	}
	
	/* Style the videos inside the content area */
	#popupContent iframe {
	  max-width: 100%; /* Make sure the video does not overflow the content area */
	  max-height: 100%; /* Make sure the video does not overflow the content area */
	  margin: 0 auto; /* Center the video horizontally */
	}
	
			/* Style for the close button */
			.close {
				position: absolute;
				top: 35px;
				right: 35px;
				color: #f1f1f1;
				font-size: 40px;
				font-weight: bold;
				transition: 0.3s;
			}
	
			.close:hover,
			.close:focus {
				color: #bbb;
				text-decoration: none;
				cursor: pointer;
			}
	</style>
	<?php
		$oldapiresp = wpgetapi_endpoint( 'riyaz_app', 'getcourses', array('debug' => false) );
		$k=$_GET['k'];
		$thumbnail_url = $oldapiresp["data"]["courses"][$k]["thumbnail_url"];
		$id = $_GET['id'];
		$id = str_replace("$", "#", $id);
		// Specify the URL of the API
		$url = "https://prod.contentapi.riyazapp.com/get-metadata";
		// Data to be sent as JSON payload
		$data = array(
			'course_id' => $id,
			'user_id' => 'HUckw7tmeegFy2VAB9AtB0OmeaC2',
			'platform' => 'android',
			'app_version' => 950
		);
	
		$jsonPayload = json_encode($data);	
		// Create a new cURL resource
		$ch = curl_init();
		// Set the URL and other options
		curl_setopt($ch, CURLOPT_URL, $url);
		curl_setopt($ch, CURLOPT_POST, 1);
		curl_setopt($ch, CURLOPT_POSTFIELDS, $jsonPayload);
		curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: application/json'));
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
	
		// Execute the request and get the response
		$response = curl_exec($ch);
		// Close cURL resource
		curl_close($ch);
		// Parse the JSON response into a PHP array
		$result = json_decode($response, true);
		// Output the PHP array
		$course_details = $result['data']['course_details'][0];
		$module_details = array();
		foreach ($result['data']['module_details'] as $module) {
			$module_details[$module['uid']] = $module;
		}
		$lesson_details = array();
		foreach ($result['data']['lesson_details'] as $lesson) {
			$lesson_details[$lesson['uid']] = $lesson;
		}
	//media_details[lesson_details[$lesson][]]
		$media_details = array();
		foreach ($result['data']['media_details'] as $media) {
			$media_details[$media['uid']] = $media;
		}
	
	echo '<div class="course-desc-box">';
			echo '<div class="course-desc-img-box">';
				echo '<img class="course-desc-img" src="'.$thumbnail_url.'">';
		echo '</div>';
	  			echo '<div class="course-desc-title-box">';
					echo '<div style="course-desc-title-text-box">';
						echo '<p class="course-desc-title-text">'.$course_details['title'].'</p>';
					echo '</div>';
					echo '<div class="course-desc-desc-box">';
							if(!empty($course_details['description'])){
								echo '<p style="course-desc-desc">' . $course_details['description'] . '</p>';
							}
					echo '</div>';		
		echo '</div>';	
	echo '</div>';
	
	echo '<br>';
	
	echo '<div class="course-details-div">';
		echo '<div style="flex:4;">';
		echo '<p class="course-desc-title-text" id="cc">Course contents</p>';
		echo '</div>';
		echo '<div class="course-details-button-div">';
			echo '<button class="course-details-button btn-custom btn-lg" onclick="window.location.href=\'https://play.google.com/store/apps/details?id=com.musicmuni.riyaz&hl=en_IN&gl=US\'">
	            BEGIN LEARNING
	        </button>';
		echo '</div>';
	echo '</div>';
	// http://localhost/wordpress/wp-content/uploads/2023/04/Video.png Concept
	// http://localhost/wordpress/wp-content/uploads/2023/04/Quiz.png Quiz
	// http://localhost/wordpress/wp-content/uploads/2023/04/Practice.png Audio
	// 
	$tableCount = 0;
	
	foreach($course_details['modules'] as $module){
		if(array_key_exists($module, $module_details)){
			echo '<p class="module-title">'.$module_details[$module]['title'].'</p>';
			echo '<table class="module-table">';
			echo '<tbody class="module-table-body">';
			foreach($module_details[$module]['lessons'] as $lesson){
				if(array_key_exists($lesson, $lesson_details)){
					echo '<tr class="module-table-row">';
					echo '<td class="module-table-icon-col">';
					if($lesson_details[$lesson]['lessontype'] === 'quiz'){
						echo '<img class="module-table-icon-img" src="http://localhost/wordpress/wp-content/uploads/2023/04/Quiz.png">';
					}elseif($lesson_details[$lesson]['lessontype'] === 'concept_video' || $lesson_details[$lesson]['lessontype'] === 'concept_image'){
						echo '<img class="module-table-icon-img" src="http://localhost/wordpress/wp-content/uploads/2023/04/Video.png">';
					}else{
						echo '<img class="module-table-icon-img" src="http://localhost/wordpress/wp-content/uploads/2023/04/Practice.png">';
					}
					echo '</td>';
					echo '<td class="module-table-name-col">';
	 				echo '<div style="display: flex; align-items:center;vertical-align: middle;">';
					if($lesson_details[$lesson]['lessontype'] === 'concept_image'){
						echo '<p id="text-image" onclick="showPopup(\'image\', \'' . $lesson_details[$lesson]['imageurl'] . '\')" style="font-family: Lexend; font-size: 16px; color: #FFFFFFDE;">' . $lesson_details[$lesson]['title'] . '</p>';
					}
					elseif($lesson_details[$lesson]['lessontype'] === 'concept_video'){
						$youtubeUrl = $lesson_details[$lesson]['youtubeurl'];
							$video_id = '';
							if (preg_match('/youtu\.be\/([^\?]*)/', $youtubeUrl, $match)) {
								$video_id = $match[1];
							} else {
								$video_id = parse_url($youtubeUrl, PHP_URL_QUERY);
								parse_str($video_id, $params);
								$video_id = isset($params['v']) ? $params['v'] : '';
							}
						echo '<p id="text-video" onclick="showPopup(\'video\',\'' . $video_id . '\')" style="font-family: Lexend; font-size: 16px; color: #FFFFFFDE;">' . $lesson_details[$lesson]['title'] . '</p>';
					}
					else{
						echo '<p style="font-family: Lexend; font-size: 16px; color: #FFFFFFDE;">'.$lesson_details[$lesson]['title'].'</p>';
					}
					echo '</div>';
					echo '</td>';
					echo '<td style="width:13.1%;vertical-align: middle;">';
					if($lesson_details[$lesson]['lessontype'] !== 'quiz' && $lesson_details[$lesson]['lessontype'] !== 'concept_video' && $lesson_details[$lesson]['lessontype'] !== 'concept_image')
	{
						
						echo '<div style="display: flex; align-items:center;">';
	 					echo '<div class="mediPlayer">
	         					<audio class="listen" preload="none" data-size="250" src="http://localhost/wordpress/wp-content/uploads/2023/04/TheWorldOfSound-DemoDolby.mp3"></audio>
	       				</div>';
						echo '</div>';
					}
					echo '</td>';
					echo '</tr>';
				}
			}
			echo '</tbody>';
			echo '</table>';
		}
	}
	echo '</div>';	
	?>
	
	<div id="myModal" class="modal">
		<span class="close">&times;</span>
		<div id="popupContent"></div>
	</div>
	
	<script>
			// Function to show the popup content
		function showPopup(contentType, content) {
			var modal = document.getElementById("myModal");
			var popupContent = document.getElementById("popupContent");
	
			if (contentType === 'image') {
				// If the content type is an image, create an image element
				popupContent.innerHTML = '<img id="popupImage" src="' + content + '">';
			} else if (contentType === 'video') {
				// If the content type is a video, create an iframe element
				popupContent.innerHTML = '<iframe width="560" height="315" src="https://www.youtube.com/embed/' + content + '" frameborder="0" allowfullscreen></iframe>';
			}
	
			modal.style.display = "block";
		}
	
		// Function to close the popup modal when the close button is clicked
		var close = document.getElementsByClassName("close")[0];
		close.onclick = function() {
			var modal = document.getElementById("myModal");
			modal.style.display = "none";
			var popupContent = document.getElementById("popupContent");
			popupContent.innerHTML = '';
		}
	</script>
	<script src="//code.jquery.com/jquery.min.js"> </script>
	<script> 
	(function (root, factory) {
	
	    if (typeof define === 'function' && define.amd) {
	        define(factory);
	    } else if (typeof exports === 'object') {
	        module.exports = factory;
	    } else {
	        root.lunar = factory();
	    }
	})(this, function () {
	
	    'use strict';
	
	    var lunar = {};
	
	    lunar.hasClass = function (elem, name) {
	        return new RegExp('(\\s|^)' + name + '(\\s|$)').test(elem.attr('class'));
	    };
	
	    lunar.addClass = function (elem, name) {
	        !lunar.hasClass(elem, name) && elem.attr('class', (!!elem.getAttribute('class') ? elem.getAttribute('class') + ' ' : '') + name);
	    };
	
	    lunar.removeClass = function (elem, name) {
	        var remove = elem.attr('class').replace(new RegExp('(\\s|^)' + name + '(\\s|$)', 'g'), '$2');
	        lunar.hasClass(elem, name) && elem.attr('class', remove);
	    };
	
	    lunar.toggleClass = function (elem, name) {
	        lunar[lunar.hasClass(elem, name) ? 'removeClass' : 'addClass'](elem, name);
	    };
	
	    lunar.className = function (elem, name) {
	        elem.attr('class', name);
	        console.log('className', elem);
	    };
	
	    return lunar;
	
	});
	
	(function ($) {
	
	    var _ = {
	
	        cursorPoint: function (evt, el) {
	            _.settings.pt.x = evt.clientX;
	            _.settings.pt.y = evt.clientY;
	            var playObject  = el.find('svg').attr('id');
	            playObject      = document.getElementById(playObject);
	            return _.settings.pt.matrixTransform(playObject.getScreenCTM().inverse());
	        },
	
	        angle: function (ex, ey) {
	            var dy    = ey - 50; // 100;
	            var dx    = ex - 50; // 100;
	            var theta = Math.atan2(dy, dx); // range (-PI, PI]
	            theta *= 180 / Math.PI; // rads to degs, range (-180, 180]
	            theta     = theta + 90; // in our case we are animating from the top, so we offset by the rotation value;
	            if (theta < 0) theta = 360 + theta; // range [0, 360)
	            return theta;
	        },
	
	        setGraphValue: function (obj, val, el) {
	
	            var audioObj = el.find(_.settings.audioObj),
	                pc       = _.settings.pc,
	                dash     = pc - parseFloat(((val / audioObj[0].duration) * pc), 10);
	
	            $(obj).css('strokeDashoffset', dash);
	
	            if (val === 0) {
	                $(obj).addClass(obj, 'done');
	                if (obj === $(_.settings.progress)) $(obj).attr('class', 'ended');
	            }
	        },
	
	        reportPosition: function (el, audioId) {
	            var progress = el.find(_.settings.progress),
	                audio    = el.find(_.settings.audioObj);
	
	            _.setGraphValue(progress, audioId.currentTime, el);
	        },
	
	        stopAllSounds: function () {
	
	            document.addEventListener('play', function (e) {
	                var audios = document.getElementsByTagName('audio');
	                for (var i = 0, len = audios.length; i < len; i++) {
	                    if (audios[i] != e.target) {
	                        audios[i].pause();
	                    }
	                    if (audios[i] != e.target) $(audios[i]).parent('div').find('.playing').attr('class', 'paused');
	                }
	            }, true);
	        },
	
	        settings: {},
	
	        init: function (options) {
	
	            var template = ['<svg viewBox="0 0 100 100" id="playable" version="1.1" xmlns="http://www.w3.org/2000/svg" width="40px" height="40px" data-play="playable" class="not-started playable">',
	                '<g class="shape">',
	                '<circle class="progress-track" cx="50" cy="50" r="47.45" stroke="#becce1" stroke-opacity="0.25" stroke-linecap="round" fill="none" stroke-width="5"/>',
	                '<circle class="precache-bar" cx="50" cy="50" r="47.45" stroke="#302F32" stroke-opacity="0.25" stroke-linecap="round" fill="none" stroke-width="5" transform="rotate(-90 50 50)"/>',
	                '<circle class="progress-bar" cx="50" cy="50" r="47.45" stroke="#FFC800" stroke-opacity="1" stroke-linecap="round" fill="none" stroke-width="5" transform="rotate(-90 50 50)"/>',
	                '</g>',
	                '<circle class="controls" cx="50" cy="50" r="45" stroke="none" fill="#000000" opacity="0.0" pointer-events="all"/>',
	                '<g class="control pause">',
	                '<line x1="40" y1="35" x2="40" y2="65" stroke="#FFC800" fill="none" stroke-width="8" stroke-linecap="round"/>',
	                '<line x1="60" y1="35" x2="60" y2="65" stroke="#FFC800" fill="none" stroke-width="8" stroke-linecap="round"/>',
	                '</g>',
	                '<g class="control play">',
	                '<polygon points="45,35 65,50 45,65" fill="#FFC800" stroke-width="0"></polygon>',
	                '</g>',
	                '<g class="control stop">',
	                '<rect x="35" y="35" width="30" height="30" stroke="#FFC800" fill="none" stroke-width="1"/>',
	                '</g>',
	                '</svg>'];
	
	            template = template.join(' ');
	
	            $.each(this, function (a, b) {
	                
	                var audio = $(this).find('audio');
	                audio.attr('id', 'audio' + a);
	                template = template.replace('width="34"','width="'+ audio.data('size')  +'"');
	                template = template.replace('height="34"','height="'+ audio.data('size')  +'"');
	                template = template.replace('id="playable"', 'id="playable' + a + '"');
	                $(this).append(template);
	                
	            });
	
	            var svgId = $(this).find('svg').attr('id');
	            svgId     = document.getElementById(svgId);
	
	            _.defaults = {
	                this        : this,
	                thisSelector: this.selector.toString(),
	                playObj     : 'playable',
	                progress    : '.progress-bar',
	                precache    : '.precache-bar',
	                audioObj    : 'audio',
	                controlsObj : '.controls',
	                pt          : svgId.createSVGPoint(),
	                pc          : 298.1371428256714 // 2 pi r                                
	            };
	
	            lunar = {};
	
	            _.settings = $.extend({}, _.defaults, options);
	
	            $(_.settings.controlsObj).on('click', function (e) {
	
	                var el = $(e.currentTarget).closest($(_.settings.thisSelector));
	
	                var obj = {
	                    el         : el,
	                    activeAudio: el.find(_.settings.audioObj),
	                    playObj    : el.find('[data-play]'),
	                    precache   : el.find(_.settings.precache)
	                };
	
	                obj.class = obj.playObj.attr('class');
	                switch (obj.class.replace('playable', '').trim()) {
	
	                    case 'not-started':
	                        _.stopAllSounds();
	                        obj.activeAudio[0].play();
	                        var audioId = document.getElementById(obj.activeAudio.attr('id'));
	                        audioId.addEventListener('timeupdate', function (e) {
	                            _.reportPosition(el, audioId)
	                        });
	                        obj.playObj.attr('class', 'playing');
	                        break;
	                    case 'playing':
	                        obj.playObj.attr('class', 'playable paused');
	                        obj.activeAudio[0].pause();
	                        $(audioId).off('timeupdate');
	                        break;
	                    case 'paused':
	                        obj.playObj.attr('class', 'playable playing');
	                        obj.activeAudio[0].play();
	                        break;
	                    case 'ended':
	                        obj.playObj.attr('class', 'not-started playable');
	                        obj.activeAudio.off('timeupdate', _.reportPosition);
	                        break;
	                }
	            });
	
	            $(_.defaults.audioObj).on('progress', function (e) {
	                if (this.buffered.length > 0) {
	                    var end = this.buffered.end(this.buffered.length - 1);
	                    var cache = $(e.currentTarget).parent().find(_.settings.precache),
	                        el    = $(this).closest($(_.settings.thisSelector));
	                    _.setGraphValue(cache, end, el);
	                }
	            });
	
	        }
	
	    };
	
	    // Add Plugin to Jquery
	    $.fn.mediaPlayer = function (methodOrOptions) {
	        if (_[methodOrOptions]) {
	            return _[methodOrOptions].apply(this, Array.prototype.slice.call(arguments, 1));
	        } else if (typeof methodOrOptions === 'object' || !methodOrOptions) {
	            // Default to "init"
	            return _.init.apply(this, arguments);
	        } else {
	            $.error('Method ' + methodOrOptions + ' does not exist on jQuery.mediaPlayer');
	        }
	    };
	})(jQuery);
	</script>
	<script>  $('.mediPlayer').mediaPlayer(); </script>

	<?php
	return ob_get_clean();
} );
