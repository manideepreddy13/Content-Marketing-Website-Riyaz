<?php
/**
 * The template used for displaying page content in single.php
 *
 * @package Gateway
 */
?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>

	<header class="entry-header">
		<?php if ( has_post_thumbnail() ) : ?>
		<div style="flex: 1;">
			<img class="blog-page-img" src="<?php echo esc_url( get_the_post_thumbnail_url() ); ?>" alt="<?php the_title_attribute(); ?>" width="838px">
	</div>
		<?php endif; ?>
		<?php the_title( '<p style="font-size:31px;font-family:Lexend;font-weight:bold;color:#FFFFFFDD;">', '</p>' ); ?>

		<div class="entry-meta">
			<?php gateway_posted_on(); ?>
		</div><!-- .entry-meta -->
	</header><!-- .entry-header -->

	<div class="entry-content">
		<?php the_content('<p style="font-family:Lexend;font-size:15px;">', '</p>'); ?>
		<?php
			wp_link_pages( array(
				'before' => '<div class="page-links">' . esc_html__( 'Pages:', 'gateway' ),
				'after'  => '</div>',
			) );
		?>
	</div><!-- .entry-content -->

	<footer class="entry-footer clear">

<!-- 		<span class="left">
			<?php
				if ( ! is_single() && ! post_password_required() && ( comments_open() || get_comments_number() ) ) { ?>
					<a href="<?php comments_link(); ?>"><i class="fa fa-comment"></i></a>
			<?php } ?>
			<a href="<?php the_permalink(); ?>"><i class="fa fa-link"></i></a>
			<?php edit_post_link( '<i class="fa fa-edit"></i><span class="screen-reader-text">' . esc_html__( 'Edit', 'gateway' ) . '</span>' ); ?>
		</span> -->

		<span class="right"><?php gateway_entry_footer(); ?></span>

	</footer><!-- .entry-footer -->

</article><!-- #post-## -->