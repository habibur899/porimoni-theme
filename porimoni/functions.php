<?php

if ( ! defined( '_S_VERSION' ) ) {
	// Replace the version number of the theme on each release.
	define( '_S_VERSION', '1.0.0' );
}

function porimoni_theme_setup() {
	/*
		* Make theme available for translation.
		* Translations can be filed in the /languages/ directory.
		* If you're building a theme based on porimoni, use a find and replace
		* to change 'porimoni' to the name of your theme in all the template files.
		*/
	load_theme_textdomain( 'porimoni', get_template_directory() . '/languages' );

	// Add default posts and comments RSS feed links to head.
	add_theme_support( 'automatic-feed-links' );

	/*
		* Let WordPress manage the document title.
		* By adding theme support, we declare that this theme does not use a
		* hard-coded <title> tag in the document head, and expect WordPress to
		* provide it for us.
		*/
	add_theme_support( 'title-tag' );

	/*
		* Enable support for Post Thumbnails on posts and pages.
		*
		* @link https://developer.wordpress.org/themes/functionality/featured-images-post-thumbnails/
		*/
	add_theme_support( 'post-thumbnails' );

	// This theme uses wp_nav_menu() in one location.
	register_nav_menus(
		array(
			'main-menu' => esc_html__( 'Primary', 'porimoni' ),
		)
	);

	/*
		* Switch default core markup for search form, comment form, and comments
		* to output valid HTML5.
		*/
	add_theme_support(
		'html5',
		array(
			'search-form',
			'comment-form',
			'comment-list',
			'gallery',
			'caption',
			'style',
			'script',
		)
	);

	// Set up the WordPress core custom background feature.
	add_theme_support(
		'custom-background',
		apply_filters(
			'porimoni_custom_background_args',
			array(
				'default-color' => '#ECF0F3',
				'default-image' => '',
			)
		)
	);

	// Add theme support for selective refresh for widgets.
	add_theme_support( 'customize-selective-refresh-widgets' );

	/**
	 * Add support for core custom logo.
	 *
	 * @link https://codex.wordpress.org/Theme_Logo
	 */
	add_theme_support(
		'custom-logo',
		array(
			'height'      => 250,
			'width'       => 250,
			'flex-width'  => true,
			'flex-height' => true,
		)
	);

	add_image_size( 'portfolio-thumb', 360, 240, false );
}

add_action( 'after_setup_theme', 'porimoni_theme_setup' );


/**
 * Enqueue scripts and styles.
 */
function porimoni_scripts() {

	// CSS
	wp_enqueue_style( 'font-popins', '//fonts.googleapis.com/css?family=Poppins:300i,400,400i,500,600,700,800,900', array(), _S_VERSION );
	wp_enqueue_style( 'font-awesome-style', get_template_directory_uri() . '/fonts/font-awesome.min.css', array(), _S_VERSION );
	wp_enqueue_style( 'themify-icons-style', get_template_directory_uri() . '/fonts/themify-icons.css', array(), _S_VERSION );
	wp_enqueue_style( 'etline-style', get_template_directory_uri() . '/fonts/etline.css', array(), _S_VERSION );
	wp_enqueue_style( 'plugins-style', get_template_directory_uri() . '/css/plugins.css', array(), _S_VERSION );
	wp_enqueue_style( 'lightbox-style', get_template_directory_uri() . '/css/lightbox.min.css', array(), _S_VERSION );
	wp_enqueue_style( 'responsive-style', get_template_directory_uri() . '/css/responsive.css', array(), _S_VERSION );
	wp_enqueue_style( 'style-style', get_template_directory_uri() . '/css/style.css', array(), _S_VERSION );
	wp_enqueue_style( 'porimoni-style', get_stylesheet_uri(), array(), _S_VERSION );

	// Js
	wp_enqueue_script( 'porimoni-jquery', get_template_directory_uri() . '/js/jquery.min.js', array(), _S_VERSION, true );
	wp_enqueue_script( 'bootstrap-js', get_template_directory_uri() . '/js/bootstrap.min.js', array(), _S_VERSION, true );
	wp_enqueue_script( 'owl-carousel-js', get_template_directory_uri() . '/js/owl.carousel.min.js', array( 'porimoni-jquery' ), _S_VERSION, true );
	wp_enqueue_script( 'modernizr-js', get_template_directory_uri() . '/js/modernizr-2.8.3.min.js', array( 'porimoni-jquery' ), _S_VERSION, true );
	wp_enqueue_script( 'jquery-nav-js', get_template_directory_uri() . '/js/jquery.nav.js', array( 'porimoni-jquery' ), _S_VERSION, true );
	wp_enqueue_script( 'jquery-inview-js', get_template_directory_uri() . '/js/jquery.inview.min.js', array( 'porimoni-jquery' ), _S_VERSION, true );
	wp_enqueue_script( 'isotope-pkgd-min-js', get_template_directory_uri() . '/js/isotope.pkgd.min.js', array( 'porimoni-jquery' ), _S_VERSION, true );
	wp_enqueue_script( 'animated-headline-js', get_template_directory_uri() . '/js/animated-headline.js', array( 'porimoni-jquery' ), _S_VERSION, true );
	wp_enqueue_script( 'lightbox-js', get_template_directory_uri() . '/js/lightbox.min.js', array( 'porimoni-jquery' ), _S_VERSION, true );
	wp_enqueue_script( 'slick-nav-js', get_template_directory_uri() . '/js/slick-nav.js', array( 'porimoni-jquery' ), _S_VERSION, true );
	wp_enqueue_script( 'form-contact-js', get_template_directory_uri() . '/js/form-contact.js', array( 'porimoni-jquery' ), _S_VERSION, true );
	wp_enqueue_script( 'scrolltopcontrol-js', get_template_directory_uri() . '/js/scrolltopcontrol.js', array( 'porimoni-jquery' ), _S_VERSION, true );
	wp_enqueue_script( 'wow-min-js', get_template_directory_uri() . '/js/wow.min.js', array( 'porimoni-jquery' ), _S_VERSION, true );
	wp_enqueue_script( 'main-js', get_template_directory_uri() . '/js/main.js', array( 'porimoni-jquery' ), _S_VERSION, true );

	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}
}

add_action( 'wp_enqueue_scripts', 'porimoni_scripts' );

// Tgm
require_once dirname( __FILE__ ) . '/inc/plugin-active/pm-plugin-active.php';

// Custom post type
require_once dirname( __FILE__ ) . '/inc/cpt.php';

// One Click Demo Import
require_once dirname( __FILE__ ) . '/inc/demo-import.php';
