<?php
use \Elementor\Widget_Base;
use \Elementor\Controls_Manager;
use \Elementor\Group_Control_Typography;
use \Elementor\Utils;
use \Elementor\Repeater;
use \Elementor\Group_Control_Border;
use \Elementor\Group_Control_Background;
/**
 * 
 * Newsletter Widget .
 *
 */
class konsal_Newsletter extends Widget_Base {

	public function get_name() {
		return 'konsalnewsletter';
	}

	public function get_title() {
		return __( 'Newsletter', 'konsal' );
	}


	public function get_icon() {
		return 'th-icon';
    }
    

	public function get_categories() {
		return [ 'konsal' ];
	}

	
	protected function register_controls() {

		$this->start_controls_section(
			'layout_section',
			[
				'label'     => __( 'Newsletter Style', 'konsal' ),
				'tab'       => Controls_Manager::TAB_CONTENT,
			]
        );

		$this->add_control(
			'layout_style',
			[
				'label' 	=> __( 'Layout Style', 'konsal' ),
				'type' 		=> Controls_Manager::SELECT,
				'default' 	=> '1',
				'options' 	=> [
					'1'  		=> __( 'Style One', 'konsal' ),
				],
			]
		);

        $this->add_control(
			'title',
            [
				'label'         => __( 'Title', 'konsal' ),
				'type'          => Controls_Manager::TEXTAREA,
				'default'       => __( 'Title' , 'konsal' ),
				'label_block'   => true,
				'rows' 		=> 2,
			]
		);
        $this->add_control(
			'desc',
            [
				'label'         => __( 'Description', 'konsal' ),
				'type'          => Controls_Manager::TEXTAREA,
				'default'       => __( 'Description' , 'konsal' ),
				'label_block'   => true,
				'rows' 		=> 4,
			]
		);
        $this->add_control(
			'checkbox',
            [
				'label'         => __( 'checkbox', 'konsal' ),
				'type'          => Controls_Manager::TEXTAREA,
				'default'       => __( 'Description' , 'konsal' ),
				'label_block'   => true,
				'rows' 		=> 4,
			]
		);

		$this->add_control(
			'newsletter_placeholder',
			[
				'label' 		=> __( 'Newsletter Placeholder Text', 'konsal' ),
				'type' 			=> Controls_Manager::TEXTAREA,
				'default' 		=> __( 'Enter Your Email', 'konsal' ),
			]
		);

		$this->add_control(
			'newsletter_button',
			[
				'label' 		=> __( 'Newsletter Button Text', 'konsal' ),
				'type' 			=> Controls_Manager::TEXTAREA,
				'default' 		=> __( 'Subscribe', 'konsal' ),
			]
		);

        $this->end_controls_section();

         //---------------------------------------
			//Style Section Start
		//---------------------------------------

		//-----------------------------------General BG Styling-------------------------------------//
		$this->start_controls_section(
			'general_styling',
			[
				'label'     => __( 'General Styling', 'konsal' ),
				'tab'       => Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_control(
			'geneal_bg',
			[
				'label'     => __( 'Background', 'konsal' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .th-bg' => 'background-color: {{VALUE}}!important',
				],	
			]
		);

        $this->add_responsive_control(
			'general_padding',
			[
				'label' 		=> __( 'Padding', 'konsal' ),
				'type' 			=> Controls_Manager::DIMENSIONS,
				'size_units' 	=> [ 'px', '%', 'em' ],
				'selectors' 	=> [
					'{{WRAPPER}} .th-bg' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
			]
		);

		$this->end_controls_section();
	
		//-------------------------------------Title styling-------------------------------------//
        $this->start_controls_section(
			'section_title_style_section',
			[
				'label' => __( 'Title Style', 'konsal' ),
				'tab' 	=> Controls_Manager::TAB_STYLE,
			]
		);

        $this->add_control(
			'section_title_color',
			[
				'label' 	=> __( 'Color', 'konsal' ),
				'type' 		=> Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .th-title' => 'color: {{VALUE}}!important;',
                ],
			]
        );

        $this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' 		=> 'section_title_typography',
				'label' 	=> __( 'Typography', 'konsal' ),
                'selector' 	=> '{{WRAPPER}} .th-title',
			]
		);

        $this->add_responsive_control(
			'section_title_margin',
			[
				'label' 		=> __( 'Margin', 'konsal' ),
				'type' 			=> Controls_Manager::DIMENSIONS,
				'size_units' 	=> [ 'px', '%', 'em' ],
				'selectors' 	=> [
					'{{WRAPPER}} .th-title' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
			]
        );

        $this->add_responsive_control(
			'section_title_padding',
			[
				'label' 		=> __( 'Padding', 'konsal' ),
				'type' 			=> Controls_Manager::DIMENSIONS,
				'size_units' 	=> [ 'px', '%', 'em' ],
				'selectors' 	=> [
					'{{WRAPPER}} .th-title' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
			]
		);

        $this->end_controls_section();

	}

	protected function render() {

        $settings = $this->get_settings_for_display();

        if( $settings['layout_style'] == '1' ){
            echo '<div class="widget newsletter-widget footer-widget">';
                echo '<h3 class="widget_title">'.esc_html($settings['title']).'</h3>';
                echo '<p class="footer-text">'.esc_html($settings['desc']).'</p>';
                echo '<form class="newsletter-form style2">';
                    echo '<div class="form-group">';
                        echo '<input class="form-control" type="email" placeholder="'.esc_attr( $settings['newsletter_placeholder'] ).'" required="">';
                        echo '<button type="submit" class="th-btn">'.wp_kses_post( $settings['newsletter_button'] ).'</button>';
                    echo '</div>';
                    echo '<div class="check-group">';
                        echo '<input type="checkbox" id="privacyPolicy">';
                        echo '<label for="privacyPolicy">I agree to the privacy policy</label>';
                    echo '</div>';
                echo '</form>';
            echo '</div>';

        }


	}
}
						