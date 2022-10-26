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
class Animated_Text extends Widget_Base {

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
		return 'animated-text';
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
		return __( 'PM: Animated Text', 'porimoni' );
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
		return 'eicon-animation-text';
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
		return [ 'animate-custom-js' ];
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
				'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
			]
		);

		$this->add_control(
			'before_text',
			[
				'label'       => __( 'Before Text', 'porimoni' ),
				'type'        => Controls_Manager::TEXT,
				'default'     => esc_html__( 'I Am ', 'porimoni' ),
				'placeholder' => esc_html__( 'Before text here', 'porimoni' ),
			]
		);

		$this->add_control(
			'animated_text',
			[
				'label'       => __( 'Animated Text', 'porimoni' ),
				'type'        => Controls_Manager::TEXTAREA,
				'default'     => esc_html__( 'Web Developer', 'porimoni' ),
				'placeholder' => esc_html__( 'Animated text here', 'porimoni' ),
			]
		);

		$this->end_controls_section();
        // Style Tab
		$this->start_controls_section(
			'before_section_style',
			[
				'label' => __( 'Before Text Style', 'porimoni' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_group_control(
			\Elementor\Group_Control_Typography::get_type(),
			[
				'name'     => 'before_title_typography',
				'selector' => '{{WRAPPER}} .animated-before-text',
			]
		);

		$this->add_control(
			'before_title_color',
			[
				'label'     => esc_html__( 'Before Text Color', 'porimoni' ),
				'type'      => \Elementor\Controls_Manager::COLOR,
				'default'   => '#ffffff',
				'selectors' => [
					'{{WRAPPER}} .animated-before-text' => 'color: {{VALUE}}',
				],
			]
		);
		$this->end_controls_section();

		$this->start_controls_section(
			'after_section_style',
			[
				'label' => __( 'After Text Style', 'porimoni' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_group_control(
			\Elementor\Group_Control_Typography::get_type(),
			[
				'name'     => 'after_title_typography',
				'selector' => '{{WRAPPER}} .animated-after-text',
			]
		);

		$this->add_control(
			'after_title_color',
			[
				'label'     => esc_html__( 'After Text Color', 'porimoni' ),
				'type'      => \Elementor\Controls_Manager::COLOR,
				'default'   => '#ffffff',
				'selectors' => [
					'{{WRAPPER}} .animated-after-text' => 'color: {{VALUE}}',
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
		$settings       = $this->get_settings_for_display();
		$before_heading = $this->get_settings_for_display( 'before_text' );
		$animated_texts  = explode( "\n", $settings['animated_text'] );

		?>
        <h1 class="cd-headline clip">
            <span class="fw_600 animated-before-text"><?php echo esc_html( $before_heading ) ?></span>
            <span class="cd-words-wrapper">
                <?php
                foreach ( $animated_texts as $animated_text ) {
	                printf( '<b class="is-visible fw_300 animated-after-text">%s</b>', esc_html($animated_text ));
                }
                ?>
            </span>
        </h1>
		<?php
	}


}
