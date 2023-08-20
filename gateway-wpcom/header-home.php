<?php
/**
 * The header for template-home.php
 *
 * Displays all of the <head> section and everything up till <div id="content">
 *
 * @package Gateway
 */

$herotitle = "Practice & learn to sing";
$herocontent = '<button style="margin-right: 21px;border-color: #FFC800;" class="btn-custom btn-lg"
            onclick="window.location.href=\'https://play.google.com/store/apps/details?id=com.musicmuni.riyaz&hl=en_IN&gl=US\';">
            DOWNLOAD RIYAZ
        </button>';

?><!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
<meta charset="<?php bloginfo( 'charset' ); ?>">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="profile" href="http://gmpg.org/xfn/11">
<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>">
<link href='https://fonts.googleapis.com/css?family=Lexend' rel='stylesheet'>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <style>
        .btn-custom {
    color: black;
    font-family: Lexend;
    font-weight: bold;
    margin-top: 1px;
    margin-right: 42px;
    margin-bottom: 13px;
    width: 163px;
    height: 40px;
    /* UI Properties */
    background: #FFC800;
    border-radius: 8px;
    opacity: 1;
    font-size: 13px;
    text-align: center;
}
.btn-custom:hover {
    color: black;
    font-family: Lexend;
    font-weight: bold;
    margin-top: 1px;
    margin-right: 42px;
    margin-bottom: 13px;
    width: 163px;
    height: 40px;
    /* UI Properties */
    background: #FFC800;
    border-radius: 8px;
    opacity: 1;
    font-size: 13px;
    text-align: center;
}

    </style>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/css/bootstrap.min.css"
        integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">

<?php wp_head(); ?>
<div class="my-div">
  <video autoplay muted loop id="bg-video" style="position: absolute; top: 0; left: 0; width: 100%; height: 100%; object-fit: cover; z-index: -1;">
    <source src="http://localhost/wordpress/wp-content/uploads/2023/03/valx.mp4" type="video/mp4">
    Your browser does not support the video tag.
  </video>	
</div>
</head>
	

<body <?php body_class(); ?>>
<div id="page" class="hfeed site">

	<a class="skip-link screen-reader-text" href="#content"><?php esc_html_e( 'Skip to content', 'gateway' ); ?></a>

<!-- 	<div class="header-bg clear" >

		<div class="site-branding">

			<?php
			if ( function_exists( 'jetpack_the_site_logo' ) && jetpack_has_site_logo() ) {
				jetpack_the_site_logo();
			} // endif function_exists( 'jetpack_the_site_logo' ) ?>

			<h1 class="site-title"><a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home" alt="<?php echo esc_attr( bloginfo( 'name' ) ); ?>"><?php bloginfo( 'name' ); ?></a></h1>
			<h2 class="site-description"><?php bloginfo( 'description' ); ?></h2>

		</div><!-- .site-branding -->

		<div class="hero-section">
			<div class="header-video">
<video autoplay muted loop>
    <source src="https://www.youtube.com/watch?v=wBHQygi6d8c" type="video/mp4">
    Your browser does not support the video tag.
  </video>
</div>
			<?php if ( $herotitle || is_customize_preview() ) : ?>
				<h3 class="hero-title"><?php echo esc_html( $herotitle ); ?></h3>
			<?php endif; ?>
			
			<?php if ( $herocontent || is_customize_preview() ) : ?>
				<div class="hero-content"><button style="margin-right: 21px;border-color: #FFC800;margin-top:23px;" class="btn-custom btn-lg"
            onclick="window.location.href='https://play.google.com/store/apps/details?id=com.musicmuni.riyaz&hl=en_IN&gl=US';">
            DOWNLOAD NOW!
        </button></div>
			<?php endif; ?>

		</div><!-- .hero-section -->

	</div><!-- .header-bg --> -->

	<header id="masthead" class="site-header" role="banner">


			<?php
/**
 * The header for template-home.php
 *
 * Displays all of the <head> section and everything up till <div id="content">
 *
 * @package Gateway
 */
?><!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
<meta charset="<?php bloginfo( 'charset' ); ?>">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="profile" href="http://gmpg.org/xfn/11">
<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>">
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <link href='https://fonts.googleapis.com/css?family=Lexend' rel='stylesheet'>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <style>
        .navbar-custom {
            background-color: #0F0E17;
            font-family:Lexend;
			max-width: none;
        }
		a{
			font-family:Lexend;
			font-size : 15px ;
		}
/* 		a:visited{
			color : #FFFFFFDE;
		} */
		.site-header{
			padding-bottom:0;
		}
		.stick{
			padding-bottom:0;
		}
        .navbar-custom .navbar-brand,
        .navbar-custom .navbar-text {
            color: white;
            display: flex;
            font-family:Lexend;
			padding-bottom:0;
        }

        .navbar-custom .navbar-nav .nav-link {
            color: #ffffff;
            margin-right: 23px;
			font-family: Lexend;
			font-weight : bold;
			font-size : 14px;
			padding-bottom:0;
        }

        .btn-custom {
            color: black;
            font-family: Lexend;
            font-weight: bold;
            margin-top: 13px;
            margin-right: 42px;
			margin-bottom :13px;
            width: 163px;
            height: 40px;
            /* UI Properties */
            background: #FFC800;
            border-radius: 8px;
            opacity: 1;
			font-size :13px;
        }
		.btn-custom:hover {
            color: black;
            font-family: Lexend;
            font-weight: bold;
            margin-top: 13px;
            margin-right: 42px;
			margin-bottom :13px;
            width: 163px;
            height: 40px;
            /* UI Properties */
            background: #FFC800;
            border-radius: 8px;
            opacity: 1;
			font-size :13px;
        }

        .img-custom {
            margin-top: 13px;
            margin-left: 42px;
			margin-bottom :13px;
            width: 125px;
            height: 41px;
        }

        .dropdown-menu a {
            font-size: 14px;
            color: #FFC800;
            background-color: #2E2C41;
        }
		.p_site .a_site{
			margin-left:42px;
			font-family:'Nunito Sans';
			font-weight:normal;
			color:#FFFFFF99;
			font-size:15px;
		}
		.current_site{
			font-family:'Nunito Sans';
			color:#FFFFFFFF;
			font-weight:bold;
			font-size:15px;
		}
		.row{
			max-width: none;
			margin-right:auto;
		}
		 .container-fluid {
            background-color: #1E1C2D;
            max-width: none;
            margin: 0;
			display:flex;
			align-items:auto;
			justify-content:auto;
        }
        .container-fluid-purp{
            background-color: #39389F;
            max-width: none;
            padding: 0;
            margin: 0;
        }

        .foot-head{
            font-size:13px;
            color: #ffffff;
            font-weight:bold;
            font-family: Lexend;
        }
        .nav-link{
            font-size:10px;
            color: #FFFFFF99;
            font-family: Lexend;
        }
        .col-1{
            margin-right:auto;
			display:inline-block;
        }
		.music-muni{
			margin-top:-5px;
		}
    </style>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/css/bootstrap.min.css"
        integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">

<?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>

<!-- <div id="page" class="hfeed site">
	<a class="skip-link screen-reader-text" href="#content"><?php esc_html_e( 'Skip to content', 'gateway' ); ?></a>

	<!--<div class="header-bg">
		<div class="site-branding">

			<?php
			if ( function_exists( 'jetpack_the_site_logo' ) && jetpack_has_site_logo() ) {
				jetpack_the_site_logo();
			} // endif function_exists( 'jetpack_the_site_logo' ) ?>

			<h1 class="site-title"><a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home" alt="<?php bloginfo( 'name' ); ?>"><?php bloginfo( 'name' ); ?></a></h1>
			<h2 class="site-description"><?php bloginfo( 'description' ); ?></h2>

		</div> -->

	<!--</div> -->

	<!-- <header id="masthead" class="site-header" role="banner">

		<div class="stick">
		<nav id="site-navigation" class="main-navigation clear" role="navigation">
				<button class="menu-toggle" aria-controls="primary-menu" aria-expanded="false"><?php esc_html_e( 'Menu', 'gateway' ); ?></button>
				<?php wp_nav_menu( array( 'theme_location' => 'primary', 'menu_id' => 'primary-menu' ) ); ?>
			</nav> 

		</div>

	</header> -->
	<header id="masthead" class="site-header" style="margin-bottom:-200px;">
<div class="nav-hari" style="margin-top:auto;padding-bottom:auto;padding-top:auto;" id="navhari">
		    <nav class="navbar navbar-custom navbar-expand-lg" style="padding-bottom:30px;">
				        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent"
            aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse justify-content-center" id="navbarSupportedContent">
            <ul class="navbar-nav text-center">
                <li class="nav-item active">
                    <a class="nav-link" href="http://localhost/wordpress/">Home <span class="sr-only">(current)</span></a>
                </li>
				<li class="nav-item dropdown">
			<a class="nav-link navAH" href="http://localhost/wordpress/courses/" style="display: inline-block;margin-right:1px;">Courses</a>
						<a class="nav-link dropdown-toggle" href="#"  id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" style="display: inline-block;"></a>
                    <div style="background-color:#2E2C41;" class="dropdown-menu">
                        <a class="dropdown-item" href="http://localhost/wordpress/hindustani/">Hindustani</a>
                        <a class="dropdown-item" href="http://localhost/wordpress/carnatic/">Carnatic</a>
                        <a class="dropdown-item" href="http://localhost/wordpress/western-classical/">Western Classical</a>
                    </div>  
				</li>
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button"
                        data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        Blog
                    </a>
                    <div style="background-color:#2E2C41;" class="dropdown-menu">
                        <a class="dropdown-item" href="http://localhost/wordpress/blog/?section=1">Singing Tips</a>
                        <a class="dropdown-item" href="http://localhost/wordpress/blog/?section=2">Classical Workouts</a>
                        <a class="dropdown-item" href="http://localhost/wordpress/blog/?section=3">Updates</a>
						<a class="dropdown-item" href="http://localhost/wordpress/blog/?section=4">News</a>
                    </div>
                </li>	
            </ul>


        </div>
    </nav>
		</div>

<!--    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"
        integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo"
        crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.14.7/dist/umd/popper.min.js"
        integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1"
        crossorigin="anonymous"></script>-->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/js/bootstrap.min.js"
        integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM"
        crossorigin="anonymous"></script>
		
	</header>

	<div id="content" class="site-content">
		</div>

<!-- 	</header> -->
<h1>
	</h1>
	<div id="content" class="site-content" style="margin-top:120px;">
