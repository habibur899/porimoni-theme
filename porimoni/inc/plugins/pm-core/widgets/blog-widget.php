<?php

namespace PorimoniCore\Widgets;

use Elementor\Widget_Base;
use Elementor\Controls_Manager;
use WP_Query;

if ( ! defined( 'ABSPATH' ) ) {
	exit;
} // Exit if accessed directly

/**
 * Elementor Hello World
 *
 * Elementor widget for hello world.
 *
 * @since 1.0.0
 */
class Blog_Widget extends Widget_Base {

	/**
	 * Retrieve the widget name.
	 *
	 * @return string Widget name.
	 * @since 1.0.0
	 *
	 * @access public
	 *
	 */
	public function get_name() {
		return 'blog_widget';
	}

	/**
	 * Retrieve the widget title.
	 *
	 * @return string Widget title.
	 * @since 1.0.0
	 *
	 * @access public
	 *
	 */
	public function get_title() {
		return __( 'PM: Blog Widget', 'porimoni' );
	}

	/**
	 * Retrieve the widget icon.
	 *
	 * @return string Widget icon.
	 * @since 1.0.0
	 *
	 * @access public
	 *
	 */
	public function get_icon() {
		return 'eicon-posts-grid';
	}

	/**
	 * Retrieve the list of categories the widget belongs to.
	 *
	 * Used to determine where to display the widget in the editor.
	 *
	 * Note that currently Elementor supports only one category.
	 * When multiple categories passed, Elementor uses the first one.
	 *
	 * @return array Widget categories.
	 * @since 1.0.0
	 *
	 * @access public
	 *
	 */
	public function get_categories() {
		return [ 'pm-category' ];
	}

	/**
	 * Register the widget controls.
	 *
	 * Adds different input fields to allow the user to change and customize the widget settings.
	 *
	 * @since 1.0.0
	 *
	 * @access protected
	 */
	protected function register_controls() {
		$this->start_controls_section(
			'section_content',
			[
				'label' => esc_html__( 'Content', 'porimoni' ),
				'tab'   => \Elementor\Controls_Manager::TAB_CONTENT,
			]
		);

		$this->add_control(
			'read_more',
			[
				'label'   => esc_html__( 'Button Text', 'porimoni' ),
				'type'    => \Elementor\Controls_Manager::TEXT,
				'default' => esc_html__( 'Read More', 'porimoni' ),
			]
		);

		$this->end_controls_section();

	}

	/**
	 * Render the widget output on the frontend.
	 *
	 * Written in PHP and used to generate the final HTML.
	 *
	 * @since 1.0.0
	 *
	 * @access protected
	 */
	protected function render() {
		$settings = $this->get_settings_for_display();
		$post     = new WP_Query( [
			'posts_per_page' => 3,
			'post_type'      => 'post',
			'post_status'    => 'publish',
		] );
		echo '<div class="blog_slide_area">';
		if ( $post->have_posts() ) {
			while ( $post->have_posts() ) {
				$post->the_post();
				$image_url = get_the_post_thumbnail_url( get_the_ID(), 'large' );
				?>
                <div class="col-md-4 col-sm-6 col-xs-12">
                    <div class="single_blog wow fadeInLeft">
                        <div class="blog-thumb">
                            <div class="blog-image">
                                <a href="<?php echo esc_url( the_permalink() ) ?>"><img
                                            src="<?php echo esc_url( $image_url ) ?>" class="img-responsive"
                                            alt=""></a>
                            </div>
                            <div class="blog-info">
                                <small><i class="fa fa-clock-o"></i><?php echo esc_attr( get_the_date() ) ?></small>
                                <span><?php
									$postcats = get_the_category();
									if ( $postcats ) {
										foreach ( $postcats as $cat ) {
											echo $cat->name . ' ';
										}
									}
									?></span>
                                <a href="<?php echo esc_url( the_permalink() ) ?>">
                                    <h4><?php echo esc_html( the_title() ) ?></h4></a>
                                <p><?php echo esc_html( wp_trim_words( get_the_content(), 15, ' ' ) ) ?></p>
                                <a href="<?php echo esc_url( the_permalink() ) ?>"
                                   class="btn blog_btn"><?php echo esc_html( $settings['read_more'] ) ?></a>
                            </div>
                        </div>
                    </div>
                </div>
				<?php

			}
		}
		echo '</div>';
	}


}
