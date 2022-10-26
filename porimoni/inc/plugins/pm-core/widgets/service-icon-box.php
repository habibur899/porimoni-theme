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
class Service_Icon_Box extends Widget_Base {

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
		return 'service_icon_box';
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
		return __( 'PM: Service Icon Box', 'porimoni' );
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
		return 'eicon-icon-box';
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
			'service_icon',
			[
				'label'   => esc_html__( 'Icon', 'porimoni' ),
				'type'    => \Elementor\Controls_Manager::ICONS,
				'default' => [
					'value'   => 'fas fa-html5',
					'library' => 'fa-solid',
				],
			]
		);

		$this->add_control(
			'service_title',
			[
				'label'   => __( 'Title', 'porimoni' ),
				'default' => esc_html__( 'Web Design', 'porimoni' ),
				'type'    => Controls_Manager::TEXT,
			]
		);
		$this->add_control(
			'service_description',
			[
				'label'   => __( 'Description', 'porimoni' ),
				'default' => esc_html__( 'Lorem ipsum dolor sit amet,
consectetur adipiscing elit. Sed
sollicitudin pharetra tortor.', 'porimoni' ),
				'type'    => Controls_Manager::TEXTAREA,
			]
		);

		$this->add_control(
			'service_text_align',
			[
				'label'     => esc_html__( 'Alignment', 'porimoni' ),
				'type'      => \Elementor\Controls_Manager::CHOOSE,
				'options'   => [
					'left'   => [
						'title' => esc_html__( 'Left', 'porimoni' ),
						'icon'  => 'eicon-text-align-left',
					],
					'center' => [
						'title' => esc_html__( 'Center', 'porimoni' ),
						'icon'  => 'eicon-text-align-center',
					],
					'right'  => [
						'title' => esc_html__( 'Right', 'porimoni' ),
						'icon'  => 'eicon-text-align-right',
					],
				],
				'default'   => 'center',
				'toggle'    => false,
				'selectors' => [
					'{{WRAPPER}} .text-alignemet' => 'text-align: {{VALUE}};',
				],
			]
		);

		$this->end_controls_section();

		$this->start_controls_section(
			'icon_section_style',
			[
				'label' => __( 'Style', 'porimoni' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			]
		);
		$this->add_control(
			'icon_background_color',
			[
				'label'     => esc_html__( 'Icon Background Color', 'porimoni' ),
				'type'      => \Elementor\Controls_Manager::COLOR,
				'default'   => '#ff014f',
				'selectors' => [
					'{{WRAPPER}} .icon-background-color' => 'background: {{VALUE}}',
				],
			]
		);
        $this->add_control(
			'icon_border_color',
			[
				'label'     => esc_html__( 'Icon Border Color', 'porimoni' ),
				'type'      => \Elementor\Controls_Manager::COLOR,
				'default'   => '#ff014f',
				'selectors' => [
					'{{WRAPPER}} .icon-background-color' => 'border-color: {{VALUE}}',
				],
			]
		);

		$this->end_controls_section();

		$this->start_controls_section(
			'icon_title_style',
			[
				'label' => __( 'Icon Title Style', 'porimoni' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			]
		);
		$this->add_control(
			'icon_title_color',
			[
				'label'     => esc_html__( 'Icon Title Color', 'porimoni' ),
				'type'      => \Elementor\Controls_Manager::COLOR,
				'default'   => '#222',
				'selectors' => [
					'{{WRAPPER}} .icon-title' => 'color: {{VALUE}}',
				],
			]
		);

		$this->add_group_control(
			\Elementor\Group_Control_Typography::get_type(),
			[
				'name'     => 'icon_title_typography',
				'selector' => '{{WRAPPER}} .icon-title',
			]
		);

		$this->add_group_control(
			\Elementor\Group_Control_Text_Shadow::get_type(),
			[
				'name'     => 'icon_title_text_shadow',
				'label'    => esc_html__( 'Icon Title Text Shadow', 'porimoni' ),
				'selector' => '{{WRAPPER}} .icon-title',
			]
		);

		$this->end_controls_section();

		$this->start_controls_section(
			'icon_description_style',
			[
				'label' => __( 'Icon Description Style', 'porimoni' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			]
		);
		$this->add_control(
			'icon_description_color',
			[
				'label'     => esc_html__( 'Icon Description Color', 'porimoni' ),
				'type'      => \Elementor\Controls_Manager::COLOR,
				'default'   => '#333',
				'selectors' => [
					'{{WRAPPER}} .icon-description' => 'color: {{VALUE}}',
				],
			]
		);

		$this->add_group_control(
			\Elementor\Group_Control_Typography::get_type(),
			[
				'name'     => 'icon_description_typography',
				'selector' => '{{WRAPPER}} .icon-description',
			]
		);

		$this->add_group_control(
			\Elementor\Group_Control_Text_Shadow::get_type(),
			[
				'name'     => 'icon_description_text_shadow',
				'label'    => esc_html__( 'Icon Description Text Shadow', 'porimoni' ),
				'selector' => '{{WRAPPER}} .icon-description',
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
        <div class="text-alignemet">
            <div class="single-service wow fadeInLeft">
                <i class="<?php echo esc_html( $settings['service_icon']['value'] ) ?> fa-lg icon-background-color"></i>
                <h4 class="icon-title"><?php echo esc_html( $settings['service_title'] ) ?></h4>
                <P class="icon-description"><?php echo esc_html( $settings['service_description'] ) ?></P>
            </div>
        </div>
		<?php
	}


}
