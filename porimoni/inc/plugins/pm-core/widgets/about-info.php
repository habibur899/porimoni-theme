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
class About_Info extends Widget_Base {

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
		return 'about-info';
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
		return __( 'PM: About Info', 'porimoni' );
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
		return 'eicon-person';
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
			'left_title', [
				'label'       => esc_html__( 'Left Title', 'porimoni' ),
				'type'        => \Elementor\Controls_Manager::TEXT,
				'default'     => esc_html__( 'Name', 'porimoni' ),
				'label_block' => true,
			]
		);
		$repeater->add_control(
			'right_title', [
				'label'       => esc_html__( 'Right Title', 'porimoni' ),
				'type'        => \Elementor\Controls_Manager::TEXT,
				'default'     => esc_html__( 'Porimoni', 'porimoni' ),
				'label_block' => true,
			]
		);

		$this->add_control(
			'about_info_lists',
			[
				'label'       => esc_html__( 'About Info List', 'porimoni' ),
				'type'        => \Elementor\Controls_Manager::REPEATER,
				'fields'      => $repeater->get_controls(),
				'title_field' => '{{{ left_title }}}',
			]
		);

		$this->end_controls_section();

		$this->start_controls_section(
			'left_section_style',
			[
				'label' => __( 'Left Style', 'porimoni' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_control(
			'left_text_color',
			[
				'label'     => esc_html__( 'Left Text Color', 'porimoni' ),
				'type'      => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .about-left-text' => 'color: {{VALUE}}',
				],
			]
		);

		$this->add_group_control(
			\Elementor\Group_Control_Typography::get_type(),
			[
				'name'     => 'left_content_typography',
				'selector' => '{{WRAPPER}} .about-left-text',
			]
		);

		$this->end_controls_section();

		$this->start_controls_section(
			'right_section_style',
			[
				'label' => __( 'Right Style', 'porimoni' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_control(
			'right_text_color',
			[
				'label'     => esc_html__( 'Right Text Color', 'porimoni' ),
				'type'      => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .about-right-text' => 'color: {{VALUE}}',
				],
			]
		);

		$this->add_group_control(
			\Elementor\Group_Control_Typography::get_type(),
			[
				'name'     => 'right_content_typography',
				'selector' => '{{WRAPPER}} .about-right-text',
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
		$settings    = $this->get_settings_for_display();
		foreach ( $settings['about_info_lists'] as $about_info_list ) {
			echo sprintf( '<div class="ct_about"><span class="about-left-text"><b> %s </b></span><span class="about-right-text"> %s </span></div>', $about_info_list['left_title'], $about_info_list['right_title'] );
		}
	}


}
