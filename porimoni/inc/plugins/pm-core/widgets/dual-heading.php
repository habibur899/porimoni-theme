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
class Dual_Heading extends Widget_Base {

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
		return 'dual_heading';
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
		return __( 'PM: Dual Heading', 'porimoni' );
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
		return 'eicon-heading';
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
			'first_title',
			[
				'label'       => esc_html__( 'First Title', 'porimoni' ),
				'type'        => \Elementor\Controls_Manager::TEXT,
				'default'     => esc_html__( 'First Title', 'porimoni' ),
				'placeholder' => esc_html__( 'Type your first title here', 'porimoni' ),
			]
		);

		$this->add_control(
			'last_title',
			[
				'label'       => esc_html__( 'Last Title', 'porimoni' ),
				'type'        => \Elementor\Controls_Manager::TEXT,
				'default'     => esc_html__( 'Last Title', 'porimoni' ),
				'placeholder' => esc_html__( 'Type your last title here', 'porimoni' ),
			]
		);

		$this->add_control(
			'dual_heading_text_align',
			[
				'label' => esc_html__( 'Alignment', 'porimoni' ),
				'type' => \Elementor\Controls_Manager::CHOOSE,
				'options' => [
					'left' => [
						'title' => esc_html__( 'Left', 'porimoni' ),
						'icon' => 'eicon-text-align-left',
					],
					'center' => [
						'title' => esc_html__( 'Center', 'porimoni' ),
						'icon' => 'eicon-text-align-center',
					],
					'right' => [
						'title' => esc_html__( 'Right', 'porimoni' ),
						'icon' => 'eicon-text-align-right',
					],
				],
				'default' => 'center',
				'toggle' => true,
				'selectors' => [
					'{{WRAPPER}} .text-align' => 'text-align: {{VALUE}};',
				],
			]
		);

		$this->end_controls_section();

		$this->start_controls_section(
			'first_section_style',
			[
				'label' => __( 'First Style', 'porimoni' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_group_control(
			\Elementor\Group_Control_Typography::get_type(),
			[
				'name'     => 'first_title_typography',
				'selector' => '{{WRAPPER}} .first-title-text',
			]
		);

		$this->add_control(
			'first_title_color',
			[
				'label'     => esc_html__( 'First Text Color', 'porimoni' ),
				'type'      => \Elementor\Controls_Manager::COLOR,
				'default'   => '#333333',
				'selectors' => [
					'{{WRAPPER}} .first-title-text' => 'color: {{VALUE}}',
				],
			] );

		$this->end_controls_section();
		$this->start_controls_section(
			'second_section_style',
			[
				'label' => __( 'Second Style', 'porimoni' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_group_control(
			\Elementor\Group_Control_Typography::get_type(),
			[
				'name'     => 'second_title_typography',
				'selector' => '{{WRAPPER}} .second-title-text',
			]
		);

		$this->add_control(
			'second_title_color',
			[
				'label'     => esc_html__( 'Second Text Color', 'porimoni' ),
				'type'      => \Elementor\Controls_Manager::COLOR,
				'default'   => '#ff014f',
				'selectors' => [
					'{{WRAPPER}} .second-title-text' => 'color: {{VALUE}}',
				],
			] );

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
		$settings    = $this->get_settings_for_display();
		$first_title = $this->get_settings_for_display( 'first_title' );
		$last_title  = $this->get_settings_for_display( 'last_title' );

		echo '<h4 class="first-title-text text-align">' . esc_html( $first_title ) . ' <span class="second-title-text">' . esc_html( $last_title ) . '</span></h4>	';
	}


}
