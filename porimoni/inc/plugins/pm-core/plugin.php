<?php

namespace PorimoniCore;

use PorimoniCore\Widgets\Animated_Text;
use PorimoniCore\Widgets\Dual_Heading;
use PorimoniCore\Widgets\About_Info;
use PorimoniCore\Widgets\Service_Icon_Box;
use PorimoniCore\Widgets\Portfolio;
use PorimoniCore\Widgets\Timeline;
use PorimoniCore\Widgets\Blog_Widget;

/**
 * Class Plugin
 *
 * Main Plugin class
 * @since 1.2.0
 */
class PorimoniCore {

	/**
	 * Instance
	 *
	 * @since 1.2.0
	 * @access private
	 * @static
	 *
	 * @var Plugin The single instance of the class.
	 */
	private static $_instance = null;

	/**
	 * Instance
	 *
	 * Ensures only one instance of the class is loaded or can be loaded.
	 *
	 * @return Plugin An instance of the class.
	 * @since 1.2.0
	 * @access public
	 *
	 */
	public static function instance() {
		if ( is_null( self::$_instance ) ) {
			self::$_instance = new self();
		}

		return self::$_instance;
	}

	/**
	 * widget_style
	 *
	 * Load required plugin core files.
	 *
	 * @since 1.2.0
	 * @access public
	 */
	public function widget_style() {
		wp_register_style( 'elementor-style', plugins_url( '/assets/css/elementor-style.css' ) );


	}

	/**
	 * widget_scripts
	 *
	 * Load required plugin core files.
	 *
	 * @since 1.2.0
	 * @access public
	 */
	public function widget_scripts() {
		wp_register_script( 'animate-custom-js', plugins_url( '/assets/js/animate-custom.js', __FILE__ ), [ 'porimoni-jquery' ], false, true );
		wp_register_script( 'portfolio-js', plugins_url( '/assets/js/portfolio.js', __FILE__ ), [
			'porimoni-jquery',
			'isotope-pkgd-min-js',
			'lightbox-js'
		], false, true );
	}

	/**
	 * Create new category
	 *
	 * Load new category
	 *
	 * @since 1.2.0
	 * @access public
	 */
	public function pm_widget_categories( $elements_manager ) {
		$elements_manager->add_category(
			'pm-category',
			[
				'title' => esc_html__( 'Porimoni', 'porimoni' ),
				'icon'  => 'eicon-elementor',
			]
		);
	}

	/**
	 * Include Widgets files
	 *
	 * Load widgets files
	 *
	 * @since 1.2.0
	 * @access private
	 */
	private function include_widgets_files() {
		require_once( __DIR__ . '/widgets/animated-text.php' );
		require_once( __DIR__ . '/widgets/dual-heading.php' );
		require_once( __DIR__ . '/widgets/about-info.php' );
		require_once( __DIR__ . '/widgets/service-icon-box.php' );
		require_once( __DIR__ . '/widgets/portfolio.php' );
		require_once( __DIR__ . '/widgets/timeline.php' );
		require_once( __DIR__ . '/widgets/blog-widget.php' );
	}

	/**
	 * Register Widgets
	 *
	 * Register new Elementor widgets.
	 *
	 * @since 1.2.0
	 * @access public
	 */
	public function register_widgets() {
		// Its is now safe to include Widgets files
		$this->include_widgets_files();

		// Register Widgets
		\Elementor\Plugin::instance()->widgets_manager->register_widget_type( new Animated_Text() );
		\Elementor\Plugin::instance()->widgets_manager->register_widget_type( new Dual_Heading() );
		\Elementor\Plugin::instance()->widgets_manager->register_widget_type( new About_Info() );
		\Elementor\Plugin::instance()->widgets_manager->register_widget_type( new Service_Icon_Box() );
		\Elementor\Plugin::instance()->widgets_manager->register_widget_type( new Portfolio() );
		\Elementor\Plugin::instance()->widgets_manager->register_widget_type( new Timeline() );
		\Elementor\Plugin::instance()->widgets_manager->register_widget_type( new Blog_Widget() );
	}

	/**
	 *  Plugin class constructor
	 *
	 * Register plugin action hooks and filters
	 *
	 * @since 1.2.0
	 * @access public
	 */
	public function __construct() {

		// Register Style
		add_action( 'elementor/frontend/after_register_styles', [ $this, 'widget_style' ] );

		// Register widget scripts
		add_action( 'elementor/frontend/after_register_scripts', [ $this, 'widget_scripts' ] );

		// Register widgets
		add_action( 'elementor/widgets/widgets_registered', [ $this, 'register_widgets' ] );

		// Register Category
		add_action( 'elementor/elements/categories_registered', [ $this, 'pm_widget_categories' ] );
	}
}

// Instantiate Plugin Class
PorimoniCore::instance();
