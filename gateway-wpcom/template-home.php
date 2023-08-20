<?php
/**
 * Template Name: Home Page
 *
 * @package Gateway
 */

$home_page_video  = get_theme_mod( 'home_page_video' );
$home_video_aside = get_theme_mod( 'home_video_aside' );
get_header( 'home' ); ?>

	<div class="logo-home">
			<a href="http://localhost/wordpress">
            <img  class="img-fluidHome" src="http://localhost/wordpress/wp-content/uploads/2023/03/layer_2.png" alt="">
			<p style="color:#FFFFFF99; margin-top : 14px; font-family;Lexend; font-size:15.8px; font-weight: semi-bold;">
				Practice and learn to sing
				</p>
        </a>
		
		</div>

<?php while ( have_posts() ) : the_post() ?>

  <div class="home-posts-titles">

    <!-- <?php the_title( '<h2 class="page-title">', '</h2>' ); ?> -->

    <div class="home-content entry-content">
      <?php the_content(); ?>
    </div><!-- .home-content -->

  </div><!-- .home_posts_titles -->

<?php endwhile; ?>

<div class = "row justify-content-center" style="margin:10px;">
  <?php if ( gateway_has_featured_posts( 1 ) ) : // Check for featured posts ?>
    <?php
      $featured_posts = gateway_get_featured_posts();

      foreach ( (array) $featured_posts as $order => $post ) :

        setup_postdata( $post );
    ?>
        <div class="card" style="width: 30%;">
          <?php if ( has_post_thumbnail() ) : ?>
            <img src="<?php the_post_thumbnail_url( 'large' ); ?>" class="card-img-top" alt="<?php the_title(); ?>">
          <?php endif; ?>
          <div class="card-body" style="align-items:left;">
            <h5 class="card-title"><?php the_title(); ?></h5>
            <p class="card-text"><?php the_excerpt(); ?></p>
            <a href="<?php the_permalink(); ?>" class="btn btn-primary"><?php esc_html_e( 'Read More', 'gateway' ); ?></a>
          </div>
        </div>
    <?php
      endforeach;

      wp_reset_postdata();
    ?>
  <?php else : // if no featured posts, display three most recent posts instead ?>
    <?php $args = array(
                'posts_per_page'      => 3,
                'no_found_rows'       => true,
                'ignore_sticky_posts' => true ); ?>

    <?php $latest = new WP_Query( $args ); ?>

    <?php if ( $latest->have_posts() ) : ?>

      <?php while ( $latest->have_posts() ) : $latest->the_post() ?>

        <div class = "feature-box col-lg-4">
          <?php if ( has_post_thumbnail() ) : ?>
            <img src="<?php the_post_thumbnail_url( 'large' ); ?>" class="card-img-top" style="border-radius:13.22px;"alt="<?php the_title(); ?>">
          <?php endif; ?>
          <div class="card-body" style="font-family:Lexend;display:flex;flex-direction:column;">
  				<div class="card-title-div" style="display:flex;">
					<a href="<?php the_permalink(); ?>"><h5 class="card-title" style="color:#FFFFFF; font-family:Lexend; font-size:21px; font-weight: semi-bold;"><?php the_title(); ?></h5></a>
			  </div>
			  <div class="card-text-div" style="display:flex;">
				<p class="card-text" style="color:#FFFFFF; font-family:Lexend; font-size:14.5px;"><?php the_excerpt(); ?></p>  
			  </div>
  				
		  </div>

        </div>

      <?php endwhile; ?>

      <?php wp_reset_postdata(); ?>

    <?php else : ?>

      <?php get_template_part( 'template-parts/content', 'none' ); ?>

    <?php endif; ?>

  <?php endif; // gateway_has_featured_posts ?>
</div><!-- .card-container -->

<?php if ( $home_page_video || $home_video_aside ) : ?>
  <hr>
<?php endif; ?>



<?php get_footer(); ?>
