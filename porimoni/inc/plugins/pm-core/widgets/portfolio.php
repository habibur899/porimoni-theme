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
class Portfolio extends Widget_Base {

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
		return 'portfolio';
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
		return __( 'PM: Portfolio', 'porimoni' );
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
		return 'eicon-posts-ticker';
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
	 * Retrieve the list of scripts the widget depended on.
	 *
	 * Used to set scripts dependencies required to run the widget.
	 *
	 * @return array Widget scripts dependencies.
	 * @since 1.0.0
	 *
	 * @access public
	 *
	 */
	public function get_script_depends() {
		return [ 'portfolio-js' ];
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
			'show_portfolio',
			[
				'label'        => esc_html__( 'Show Portfolio', 'porimoni' ),
				'type'         => \Elementor\Controls_Manager::SWITCHER,
				'label_on'     => esc_html__( 'Show', 'porimoni' ),
				'label_off'    => esc_html__( 'Hide', 'porimoni' ),
				'return_value' => 'yes',
				'default'      => 'yes',
			]
		);

		$this->add_control(
			'overlay_color',
			[
				'label'     => esc_html__( 'Overlay Color', 'porimoni' ),
				'type'      => \Elementor\Controls_Manager::COLOR,
				'default'   => '#31277BA6',
				'selectors' => [
					'{{WRAPPER}} .work_content_area .item-img-overlay' => 'background: {{VALUE}}',
				],
			]
		);
		$this->add_control(
			'icon',
			[
				'label'   => esc_html__( 'Icon', 'porimoni' ),
				'type'    => \Elementor\Controls_Manager::ICONS,
				'default' => [
					'value'   => 'fas fa-plus',
					'library' => 'fa-solid',
				],
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
		if ( $settings['show_portfolio'] == 'yes' ) {
			$categorys = get_terms( [
				'hide_empty' => true,
				'taxonomy'   => 'portfolio_category'
			] );
			?>
            <div class="work_filter text-center">
                <ul>
                    <li class="active" data-filter="*"><?php echo esc_html__( 'All', 'porimoni' ) ?></li>
					<?php
					foreach ( $categorys as $category ) {
						printf( '<li data-filter=".%s">%s</li>', esc_attr( $category->slug ), esc_html( $category->name ) );
					}
					?>
                </ul>
            </div>
			<?php
			$portfolios = new WP_Query( [
				'post_status'    => 'publish',
				'posts_per_page' => - 1,
				'post_type'      => 'portfolio',
			] );
			echo '<div class="work_content_area">';
			while ( $portfolios->have_posts() ) {
				$portfolios->the_post();
				$portfolio_tags = $this->get_portfolio_tag( get_the_ID() );
				$image_url      = get_the_post_thumbnail_url( get_the_ID(), 'portfolio-thumb' );

				?>
                <div class="col-md-4 col-sm-6 col-xs-12 element-item <?php echo esc_attr( $portfolio_tags ) ?>">
                    <div class="item-img">
                        <img src="<?php echo esc_url( $image_url ) ?>" alt=""/>
                        <div class="item-img-overlay">
                            <div class="overlay-info full-width">
                                <a href="<?php echo esc_url( $image_url ) ?>" data-lightbox="images">
                                    <span class="icon"><i
                                                class="<?php echo esc_attr( $settings['icon']['value'] ) ?>"></i></span>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
				<?php
			}
			echo '</div>';
			wp_reset_query();
		}
	}

	private function get_portfolio_tag( $post_id ) {
		$categorys  = get_the_terms( $post_id, 'portfolio_category' );
		$_categorys = [];
		foreach ( $categorys as $category ) {
			$_categorys[ $category->term_id ] = $category->slug;
		}

		return join( ' ', $_categorys );
	}


}
