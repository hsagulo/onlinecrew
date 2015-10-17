<?php
/**
 * This file adds the Home Page to the OnlineCrew V2 Theme.
 *
 * @author OnlineCrew
 * @package OnlineCrew v2
 * @subpackage Customizations
 */
add_action( 'genesis_meta', 'onlinecrew_v2_genesis_meta' );
/**
 * Add widget support for homepage. If no widgets active, display the default loop.
 *
 */
function onlinecrew_v2_genesis_meta() {

  if (
      is_active_sidebar( 'home-slider' ) || 
      is_active_sidebar( 'home-jcarousel' ) || 
      is_active_sidebar( 'home-map' ) || 
      is_active_sidebar( 'home-testimonials' )
  ) {

    remove_action( 'genesis_loop', 'genesis_do_loop');
    add_filter( 'genesis_pre_get_option_site_layout', '__genesis_return_full_width_content' );

  }
  
}

// Register homepage sections widget
remove_action( 'genesis_loop', 'genesis_do_loop');
add_action( 'genesis_after_header', 'onlinecrew_homepage');
function onlinecrew_homepage() {

    genesis_widget_area( 'home-slider', array(
      'before' => '<section class="home-slider home-sections">',
      'after'  => '</section>',
    ) );
      
    genesis_widget_area( 'home-jcarousel', array(
      'before' => '<section class="home-carousel home-sections">',
      'after'  => '</div></section>',
    ) );

    genesis_widget_area( 'home-map', array(
      'before' => '<section class="home-hrsolution home-sections">',
      'after'  => '</div></section>',
    ) );

    genesis_widget_area( 'home-testimonials', array(
      'before' => '<section class="home-testimonials home-sections">',
      'after'  => '</div></section>',
    ) );

}

genesis();
