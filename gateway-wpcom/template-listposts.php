<?php
/**
 * Template Name: All Posts
 *
 * A custom page template that displays all posts.
 *
 * @package Gateway
 */

get_header();

$currentPage = get_query_var('paged');

$section = $_GET['section'];

if($section == 1){
	$category = "'Singing Tips'";
	$title = "Singing Tips";
}
elseif($section == 2){
	$category = "'Classical Workouts'";
	$title = "Classical Workouts";
}
elseif($section == 3){
	$category = "'Updates'";
	$title = "Updates";
}
elseif($section == 4){
	$category = "'News'";
	$title = "News";
}

$args = array(
	'category_name' => $category,
	'post_type' => 'post',
	'posts_per_page' =>1,
	'paged' => $currentPage
);

$query = new WP_Query( $args );?>
<div class="search-box">
<div style="flex:5;">	
	<?php
	echo '<p class="search-box-title">Blogs / <span style="color:#FFFFFFDE;">'.$title.'</span></p>';
?>
</div>
<div style="flex: 1;margin-right:48px;">
    <?php echo custom_search_form(); ?>
</div>
</div>
<?php
if ( $query->have_posts() ) :?>
<div style="margin-bottom:137px;">
	<?php while ( $query->have_posts() ) : $query->the_post(); ?>
	<div class="blog-box">
			<?php if ( has_post_thumbnail() ) : ?>
		<div style="flex: 1;">
			<img class="blog-box-thumb" src="<?php echo esc_url( get_the_post_thumbnail_url() ); ?>" alt="<?php the_title_attribute(); ?>" height="342" width="342">
	</div>
  			<div class="blog-box-excerpt">
				<div style="text-align:left;">
					<p class="blog-box-title">
					<a class="blog-box-title-link"href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>"><?php the_title(); ?></a>
				</p>
				</div>
				<div class="blog-box-summ">
						<?php custom_posted_on();?>
						<?php custom_excerpt(); ?>
				</div>	
	</div>		
			<?php endif; ?>				
</div>
	<?php endwhile; wp_reset_postdata(); ?>
</div>

<?php echo "<div class='page-nav-container'>" . paginate_links(array(
    'total' => $query->max_num_pages,
    'prev_text' => __('<'),
    'next_text' => __('>')
)) . "</div>";
?>

<?php
endif;
wp_reset_postdata();
get_footer();
?>
