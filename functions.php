<?php
//* Start the engine
include_once( get_template_directory() . '/lib/init.php' );

//* Set Localization (do not remove)
load_child_theme_textdomain( 'enterprise', apply_filters( 'child_theme_textdomain', get_stylesheet_directory() . '/languages', 'enterprise' ) );

//* Child theme (do not remove)
define( 'CHILD_THEME_NAME', __( 'Enterprise Pro Theme', 'enterprise' ) );
define( 'CHILD_THEME_URL', 'http://my.studiopress.com/themes/enterprise/' );
define( 'CHILD_THEME_VERSION', '2.0.1' );

//* Add HTML5 markup structure
add_theme_support( 'html5', array( 'search-form', 'comment-form', 'comment-list' ) );

//* Add viewport meta tag for mobile browsers
add_theme_support( 'genesis-responsive-viewport' );

//* Enqueue Lato and Titillium Web Google fonts
add_action( 'wp_enqueue_scripts', 'enterprise_google_fonts' );
function enterprise_google_fonts() {

	wp_enqueue_style( 'google-fonts', '//fonts.googleapis.com/css?family=Lato:300,700,300italic|Titillium+Web:600', array(), CHILD_THEME_VERSION );

}

//* Enqueue Responsive Menu Script
add_action( 'wp_enqueue_scripts', 'enterprise_enqueue_responsive_script' );
function enterprise_enqueue_responsive_script() {

	wp_enqueue_script( 'enterprise-responsive-menu', get_bloginfo( 'stylesheet_directory' ) . '/js/responsive-menu.js', array( 'jquery' ), '1.0.0' );

}

//* Add new image sizes
add_image_size( 'featured-image', 358, 200, TRUE );
add_image_size( 'home-top', 750, 600, TRUE );

//* Add support for custom header
add_theme_support( 'custom-header', array(
	'header-selector' => '.site-title a',
	'header-text'     => false,
	'height'          => 80,
	'width'           => 320,
) );

//* Add support for additional color style options
add_theme_support( 'genesis-style-selector', array(
	'enterprise-pro-black'	=> __( 'Enterprise Pro Black', 'enterprise' ),
	'enterprise-pro-green'	=> __( 'Enterprise Pro Green', 'enterprise' ),
	'enterprise-pro-orange'	=> __( 'Enterprise Pro Orange', 'enterprise' ),
	'enterprise-pro-red'    => __( 'Enterprise Pro Red', 'enterprise' ),
	'enterprise-pro-teal'	=> __( 'Enterprise Pro Teal', 'enterprise' ),
) );

//* Add support for structural wraps
add_theme_support( 'genesis-structural-wraps', array(
	'header',
	'nav',
	'subnav',
	'site-inner',
	'footer-widgets',
	'footer',
) );


//* Add support for 3-column footer widgets
add_theme_support( 'genesis-footer-widgets', 3 );

//* Hook after post widget after the entry content
add_action( 'genesis_after_entry', 'enterprise_after_entry', 5 );
function enterprise_after_entry() {

	if ( is_singular( 'post' ) )
		genesis_widget_area( 'after-entry', array(
			'before' => '<div class="after-entry widget-area">',
			'after'  => '</div>',
		) );

}

//* Remove comment form allowed tags
add_filter( 'comment_form_defaults', 'enterprise_remove_comment_form_allowed_tags' );
function enterprise_remove_comment_form_allowed_tags( $defaults ) {

	$defaults['comment_notes_after'] = '';
	return $defaults;

}

//* Register widget areas
genesis_register_sidebar( array(
	'id'          => 'home-top',
	'name'        => __( 'Home - Top', 'enterprise' ),
	'description' => __( 'This is the top section of the homepage.', 'enterprise' ),
) );
genesis_register_sidebar( array(
	'id'          => 'home-bottom',
	'name'        => __( 'Home - Bottom', 'enterprise' ),
	'description' => __( 'This is the bottom section of the homepage.', 'enterprise' ),
) );
genesis_register_sidebar( array(
	'id'          => 'after-entry',
	'name'        => __( 'After Entry', 'enterprise' ),
	'description' => __( 'This is the after entry widget area.', 'enterprise' ),
) );


//pasted full width
/** Add the featured image section */
add_action( 'genesis_after_header', 'full_featured_image' );
function full_featured_image() {
	if ( is_front_page() ) {
		echo '<div class ="full-img" id="full-image"><img src="'. get_stylesheet_directory_uri() . '/images/hero.jpg" /></div>';
	}
	elseif ( is_singular( array( 'post', 'page' ) ) && has_post_thumbnail() ){
		echo '<div class ="full-img" id="full-image">';
		echo get_the_post_thumbnail($thumbnail->ID, 'header');
		echo '</div>';
	}
}

/** Add new image sizes */
add_image_size( 'header', 1600, 9999, TRUE );

//footer
add_action( 'genesis_after_footer', 'full_featured_image' );
function full_featured_image() {
	if ( is_front_page() ) {
		echo '<div class ="full-img" id="full-image"><img src="'. get_stylesheet_directory_uri() . '/images/hero.jpg" /></div>';
	}
	elseif ( is_singular( array( 'post', 'page' ) ) && has_post_thumbnail() ){
		echo '<div class ="full-img" id="full-image">';
		echo get_the_post_thumbnail($thumbnail->ID, 'header');
		echo '</div>';
	}
}

/** Add new image sizes */
add_image_size( 'footer', 1600, 9999, TRUE );
