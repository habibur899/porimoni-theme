<?php

namespace PorimoniCore\Widgets;

use Elementor\Widget_Base;
use Elementor\Controls_Manager;

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
class Timeline extends Widget_Base {

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
		return 'timeline';
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
		return __( 'PM: Timeline', 'porimoni' );
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
		return 'eicon-time-line';
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
		$repeater = new \Elementor\Repeater();

		$repeater->add_control(
			'timeline_title', [
				'label'       => esc_html__( 'Title', 'porimoni' ),
				'type'        => \Elementor\Controls_Manager::TEXT,
				'default'     => esc_html__( 'Medical science', 'porimoni' ),
				'label_block' => true,
			]
		);
		$repeater->add_control(
			'timeline_date',
			[
				'label'   => esc_html__( 'Date', 'porimoni' ),
				'type'    => \Elementor\Controls_Manager::TEXT,
				'default' => esc_html__( '2001 - 2006', 'porimoni' ),
			]
		);

		$repeater->add_control(
			'timeline_description',
			[
				'label'   => esc_html__( 'Description', 'porimoni' ),
				'type'    => \Elementor\Controls_Manager::TEXTAREA,
				'rows'    => 10,
				'default' => esc_html__( 'Lorem ipsum dolor sit amet, consectetur adipisicing elit. Enim eveniet incidunt quidem illum repellat, a nemo cumque optio asperiores tempora delectus cupiditate', 'porimoni' ),
			]
		);

		$this->add_control(
			'timeline_list',
			[
				'label'       => esc_html__( 'Timeline List', 'porimoni' ),
				'type'        => \Elementor\Controls_Manager::REPEATER,
				'fields'      => $repeater->get_controls(),
				'title_field' => '{{{ timeline_title }}}',
			]
		);

		$this->end_controls_section();

		$this->start_controls_section(
			'title_section_style',
			[
				'label' => __( 'Title Style', 'porimoni' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			]
		);
		$this->add_group_control(
			\Elementor\Group_Control_Typography::get_type(),
			[
				'name'     => 'title_typography',
				'selector' => '{{WRAPPER}} .timeline_title',
			]
		);

		$this->add_control(
			'title_color',
			[
				'label'     => esc_html__( 'Title Color', 'porimoni' ),
				'type'      => \Elementor\Controls_Manager::COLOR,
				'default'   => '#333333',
				'selectors' => [
					'{{WRAPPER}} .timeline_title' => 'color: {{VALUE}}',
				],
			]
		);

		$this->end_controls_section();

		$this->start_controls_section(
			'date_section_style',
			[
				'label' => __( 'Date Style', 'porimoni' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			]
		);
		$this->add_group_control(
			\Elementor\Group_Control_Typography::get_type(),
			[
				'name'     => 'date_typography',
				'selector' => '{{WRAPPER}} .timeline_date',
			]
		);

		$this->add_control(
			'date_color',
			[
				'label'     => esc_html__( 'Date Color', 'porimoni' ),
				'type'      => \Elementor\Controls_Manager::COLOR,
				'default'   => '#ff014f',
				'selectors' => [
					'{{WRAPPER}} .timeline_date' => 'color: {{VALUE}}',
				],
			]
		);

		$this->end_controls_section();

		$this->start_controls_section(
			'description_section_style',
			[
				'label' => __( 'Description Style', 'porimoni' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			]
		);
		$this->add_group_control(
			\Elementor\Group_Control_Typography::get_type(),
			[
				'name'     => 'description_typography',
				'selector' => '{{WRAPPER}} .timeline_description',
			]
		);

		$this->add_control(
			'description_color',
			[
				'label'     => esc_html__( 'Description Color', 'porimoni' ),
				'type'      => \Elementor\Controls_Manager::COLOR,
				'default'   => '#333333',
				'selectors' => [
					'{{WRAPPER}} .timeline_description' => 'color: {{VALUE}}',
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

		?>
        <div class="education-container wow fadeInLeft">
            <ul class="edu-list">
				<?php
				foreach ( $settings['timeline_list'] as $timelinelist ) {
					?>
                    <li>
                        <h5 class="timeline_title"><?php echo esc_html( $timelinelist['timeline_title'] ) ?></h5>
                        <strong class="timeline_date"><?php echo esc_html( $timelinelist['timeline_date'] ) ?></strong>
                        <p class="timeline_description"><?php echo esc_html( $timelinelist['timeline_description'] ) ?></p>
                    </li>
					<?php
				}
				?>
            </ul>
        </div>
		<?php
	}


}
