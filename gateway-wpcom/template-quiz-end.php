<?php
/**
 * Template Name: Quiz-Ended
 *
 * A custom page template that displays quiz result.
 *
 * @package Gateway
 */
get_header();?>

<p class="quiz-completed">
	Quiz completed!
</p>
<div class="score-div">
	<p class="score-text">
		YOUR SCORE
	</p>
</div>
<div class="button-div">
	<div class="repeat-div">
			<button class="repeat-button">
			REPEAT
	</button>
	</div>
	<div>
			<button class="done-button">
		DONE
	</button>
	</div>
</div>
<div class="image-div">
	<div>
		<img src="http://localhost/wordpress/wp-content/uploads/2023/04/Group-3045.png">
	</div>
	<div class="right-image">
		<img src="http://localhost/wordpress/wp-content/uploads/2023/04/Group-1891.png">
	</div>
</div>
<?php 
get_footer(); 
?>