<?php
use \Elementor\Widget_Base;
use \Elementor\Controls_Manager;
use \Elementor\Group_Control_Typography;
use \Elementor\Group_Control_Border;
use \Elementor\Utils;
/**
 *
 * Section Title Widget .
 *
 */
class Konsal_Section_Title_Widget extends Widget_Base {

	public function get_name() {
		return 'konsalsectiontitle';
	}

	public function get_title() {
		return __( 'Section Title', 'konsal' );
	}

	public function get_icon() {
		return 'th-icon';
    }

	public function get_categories() {
		return [ 'konsal' ];
	}

	protected function register_controls() {

		$this->start_controls_section(
			'section_title_section',
			[
				'label'		 	=> __( 'Section Title', 'konsal' ),
				'tab' 			=> Controls_Manager::TAB_CONTENT,
			]
        );
        $this->add_control(
            'layout_style',
            [
                'label' => __('Select Layout', 'konsal'),
                'type' => \Elementor\Controls_Manager::SELECT2,
                'default' => 'layout_one',
                'options' => [
                    'layout_one' 	=> __('Layout One', 'konsal'),
                    'layout_two' 	=> __('Layout Two', 'konsal'),
                ]
            ]
        );
		$this->add_control(
			'image',
			[
				'label' 		=> __( 'Choose Image', 'konsal' ),
				'type' 			=> Controls_Manager::MEDIA,
				'dynamic' 		=> [
					'active' 		=> true,
				],
				'default' 		=> [
					'url' 			=> Utils::get_placeholder_image_src(),
				],
			]
		);
        
        $this->add_control(
			'section_subtitle',
			[
				'label' 	=> __( 'Section Subtitle', 'konsal' ),
                'type' 		=> Controls_Manager::TEXTAREA,
                'default'  	=> __( 'Section Subtitle', 'konsal' ),
			]
        );

        $this->add_control(
			'section_subtitle_tag',
			[
				'label' 	=> __( 'Subitle Tag', 'konsal' ),
				'type' 		=> Controls_Manager::SELECT,
				'options' 	=> [
					'h1' => 'H1',
					'h2' => 'H2',
					'h3' => 'H3',
					'h4' => 'H4',
					'h5' => 'H5',
					'h6' => 'H6',
					'p'  => 'P',
					'span'  => 'span',
				],
				'default' 	=> 'span',
				'condition'	=> ['section_subtitle!' => '']
			]
		);

		$this->add_control(
			'section_title',
			[
				'label' 	=> __( 'Section Title', 'konsal' ),
                'type' 		=> Controls_Manager::TEXTAREA,
                'default'  	=> __( 'Section Title', 'konsal' )
			]
        );
        $this->add_control(
			'section_title_tag',
			[
				'label' 	=> __( 'Title Tag', 'konsal' ),
				'type' 		=> Controls_Manager::SELECT,
				'options' 	=> [
					'h1' => 'H1',
					'h2' => 'H2',
					'h3' => 'H3',
					'h4' => 'H4',
					'h5' => 'H5',
					'h6' => 'H6',
					'span'  => 'span',
				],
				'default' => 'h2',
			]
        );
		$this->add_control(
			'section_description',
			[
				'label' 	=> __( 'Section Description', 'konsal' ),
                'type' 		=> Controls_Manager::TEXTAREA,
                'default'  	=> __( 'Section Description', 'konsal' )
			]
        );
        $this->add_responsive_control(
			'section_align',
			[
				'label' 		=> __( 'Alignment', 'konsal' ),
				'type' 			=> Controls_Manager::CHOOSE,
				'options' 		=> [
					'left' 	=> [
						'title' 		=> __( 'Left', 'konsal' ),
						'icon' 			=> 'eicon-text-align-left',
					],
					'center' 	=> [
						'title' 		=> __( 'Center', 'konsal' ),
						'icon' 			=> 'eicon-text-align-center',
					],
					'right' 	=> [
						'title' 		=> __( 'Right', 'konsal' ),
						'icon' 			=> 'eicon-text-align-right',
					],
				],
				'default' 	=> 'left',
				'toggle' 	=> true,
				'selectors' 	=> [
					'{{WRAPPER}} .title-area' => 'text-align: {{VALUE}};',
                ]
			]
		);

		konsal_general_fields( $this, 'wrap_class', 'Wraper Extra Class', 'TEXT', '' );
		konsal_general_fields( $this, 'section_subtitle_class', 'Subtitle Extra Class', 'TEXT', '' );
		konsal_general_fields( $this, 'section_title_class', 'Title Extra Class', 'TEXT', '' );
		konsal_general_fields( $this, 'section_desc_class', 'Description Class', 'TEXT', '' );

        $this->end_controls_section();

		//---------------------------------------
			//Style Section Start
		//---------------------------------------

		//---------------------------------General styling-------------------------------//
			$this->start_controls_section(
			'general_style_section',
			[
				'label' => __( 'General Style', 'malen' ),
				'tab' 	=> Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_responsive_control(
			'general_margin',
			[
				'label' 		=> __( 'Margin', 'malen' ),
				'type' 			=> Controls_Manager::DIMENSIONS,
				'size_units' 	=> [ 'px', '%', 'em' ],
				'selectors' 	=> [
					'{{WRAPPER}} .title-area' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->end_controls_section();

		//-------/title/description Style-------
		konsal_common_style_fields( $this, 'subtitle', 'Subtitle', '{{WRAPPER}} .sub-title' );
		konsal_common_style_fields( $this, 'title', 'Title', '{{WRAPPER}} .sec-title' );
		konsal_common_style_fields( $this, 'desc', 'Description', '{{WRAPPER}} .desc' );


	}

	protected function render() {

        $settings = $this->get_settings_for_display();

		$wrap = $settings['wrap_class'];
		$sub = $settings['section_subtitle_class'];
		$title = $settings['section_title_class'];
		$desc = $settings['section_desc_class'];
 
        if( ! empty( $settings['section_description'] ) ){
        	$this->add_render_attribute( 'wrapper', 'class', 'title-area mb-30' );
        }else{
        	$this->add_render_attribute( 'wrapper', 'class', 'title-area' );
        }

		$this->add_render_attribute( 'wrapper', 'class', $wrap );

        echo '<div '.$this->get_render_attribute_string( 'wrapper' ).' >';
        	if( !empty( $settings['section_subtitle'] ) ) {
	            echo '<'.esc_attr($settings['section_subtitle_tag']).' class="sub-title '.esc_attr($sub).'">';
					if( $settings['layout_style'] == 'layout_two' ){
						if( !empty( $settings['image']['url'] ) ) {
							echo konsal_img_tag( array(
								'url'   => esc_url( $settings['image']['url'] ),
								'class' => 'logo',
							) );
						}
						echo wp_kses_post( $settings['section_subtitle'] );
					}else{
						if( $settings['section_align'] !== 'left' ){
							if( !empty( $settings['image']['url'] ) ) {
								echo konsal_img_tag( array(
									'url'   => esc_url( $settings['image']['url'] ),
									'class' => 'me-2',
								) );
							}
						}
						echo wp_kses_post( $settings['section_subtitle'] );
						if( $settings['section_align'] !== 'right' ){
							if( !empty( $settings['image']['url'] ) ) {
								echo konsal_img_tag( array(
									'url'   => esc_url( $settings['image']['url'] ),
									'class' => 'ms-2',
								) );
							}
						}
					}
	            	
	            echo '</'.esc_attr($settings['section_subtitle_tag']).'>';
	        }
	        if( ! empty( $settings['section_title'] ) ) {
	            echo '<'.esc_attr($settings['section_title_tag']).' class="sec-title '.esc_attr($title).'">'.wp_kses_post( $settings['section_title'] ).'</'.esc_attr($settings['section_title_tag']).'>';
	        }
			if( ! empty( $settings['section_description'] ) ){
				echo konsal_paragraph_tag( array(
					'text'	=> wp_kses_post( $settings['section_description'] ),
					'class'	=> 'desc '.esc_attr($desc).''
				) );
			}
	    echo '</div>';
        
        
        	
	}
}