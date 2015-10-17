<?php
//* Start the engine
include_once( get_template_directory() . '/lib/init.php' );

//* Child theme (do not remove)
define( 'CHILD_THEME_NAME', 'OnlineCrew v2' );
define( 'CHILD_THEME_URL', 'http://www.studiopress.com/' );
define( 'CHILD_THEME_VERSION', '2.2.0' );

//* Enqueue Styles and Scripts
add_action( 'wp_enqueue_scripts', 'onlinecrew_v2_scripts' );
function onlinecrew_v2_scripts() {

	$minnified = '.min';

	//* Should we load minified scripts? Also enqueue live reload to allow for extensionless reloading with 'grunt watch'.
	if ( defined( 'SCRIPT_DEBUG' ) && SCRIPT_DEBUG == true ) {

		$minnified = '';
		wp_enqueue_script( 'live-reload', '//localhost:35729/livereload.js', array(), CHILD_THEME_VERSION, true );

	}

	//* Add Google Fonts
	// wp_register_style( 'google-fonts', '//fonts.googleapis.com/css?family=Lato:300,400,700', array(), CHILD_THEME_VERSION );
	// wp_enqueue_style( 'google-fonts' );

	//* Remove default CSS
	wp_dequeue_style( 'onlinecrew-v2-theme' );

	//* Add compiled CSS
	wp_register_style( 'onlinecrew-v2-styles', get_stylesheet_directory_uri() . '/style' . $minnified . '.css', array(), CHILD_THEME_VERSION );
	wp_enqueue_style( 'onlinecrew-v2-styles' );

	//* Add compiled JS
	wp_enqueue_script( 'onlinecrew-v2-scripts', get_stylesheet_directory_uri() . '/js/project' . $minnified . '.js', array( 'jquery' ), CHILD_THEME_VERSION, true );

  //* Add slick.js carousel
  wp_enqueue_script( 'onlinecrew-slickjs-scripts', get_stylesheet_directory_uri() . '/js/slick.min.js', array( 'jquery' ), CHILD_THEME_VERSION, true );
}

//* Add HTML5 markup structure
add_theme_support( 'html5', array( 'search-form', 'comment-form', 'comment-list' ) );

//* Add viewport meta tag for mobile browsers
add_theme_support( 'genesis-responsive-viewport' );

// OnlineCrew Homepage Widgets

genesis_register_sidebar( array(
  'id'  => 'home-slider',
  'name'  => __( 'Homepage Slider', 'OnlineCrew v2' ),
  'description' => __( 'Homepage slider placed below the header.', 'OnlineCrew v2' ),
) );

genesis_register_sidebar( array(
  'id'  => 'home-jcarousel',
  'name'  => __( 'Homepage Portfolio', 'OnlineCrew v2' ),
  'description' => __( 'Homepage Portfolio placed below the About section.', 'OnlineCrew v2' ),
) );

genesis_register_sidebar( array(
  'id'  => 'home-map',
  'name'  => __( 'Homepage Map', 'OnlineCrew v2' ),
  'description' => __( 'Homepage Map placed below the Portfolio section.', 'OnlineCrew v2' ),
) );

genesis_register_sidebar( array(
  'id'  => 'home-testimonials',
  'name'  => __( 'Homepage Testimonials', 'OnlineCrew v2' ),
  'description' => __( 'Homepage Map placed below the Map section.', 'OnlineCrew v2' ),
) );

genesis_register_sidebar( array(
  'id'  => 'contact-form',
  'name'  => __( 'Homepage Contact', 'OnlineCrew v2' ),
  'description' => __( 'Homepage Contact placed below the Testimonials section.', 'OnlineCrew v2' ),
) );

add_action('genesis_before_footer', 'onlinecrew_before_footer');
remove_action('genesis_footer', 'genesis_do_footer');
function onlinecrew_before_footer() {
  genesis_widget_area( 'contact-form', array(
    'before' => '<section class="contact-form home-sections"><div class="wrap">',
    'after'  => '</div></section>',
  ) );
}

