<?php
use \Elementor\Widget_Base;
use \Elementor\Controls_Manager;
use \Elementor\Group_Control_Typography;
use \Elementor\Utils;
use \Elementor\Group_Control_Image_Size;
use \Elementor\Group_Control_Box_Shadow;
use \Elementor\Group_Control_Border;
use \Elementor\Repeater;
/**
 *
 * Download Button Box Widget .
 *
 */
class Konsal_Download_Button extends Widget_Base {

	public function get_name() {
		return 'konsaldownloadbutton';
	}

	public function get_title() {
		return __( 'Download Button', 'konsal' );
	}

	public function get_icon() {
		return 'th-icon';
    }

	public function get_categories() {
		return [ 'konsal' ];
	}

	protected function register_controls() {

		$this->start_controls_section(
			'feature_section',
			[
				'label' 	=> __( 'Download Button', 'konsal' ),
				'tab' 		=> Controls_Manager::TAB_CONTENT,
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
				'label'     => __( 'Title', 'konsal' ),
                'type'      => Controls_Manager::TEXT,
                'default'       => __( 'Download' , 'konsal' ),
				'label_block'   => true,
			]
        );

        $repeater = new Repeater();

		$repeater->add_control(
			'title',
			[
				'label'     => __( 'Title', 'konsal' ),
                'type'      => Controls_Manager::TEXTAREA,
                'rows' 		=> 2,
			]
        );
        $repeater->add_control(
			'url',
			[
				'label'     => __( 'File Url', 'konsal' ),
                'type'      => Controls_Manager::TEXTAREA,
                'rows' 		=> 4,
			]
        );
        $this->add_control(
			'files',
			[
				'label' 		=> __( 'Files', 'konsal' ),
				'type' 			=> Controls_Manager::REPEATER,
				'fields' 		=> $repeater->get_controls(),
			]
		);
        
        $this->end_controls_section();

        //---------------------------------------
			//Style Section Start
		//--------------------------------------- 

		//------------------Genearl styling--------------------//
        $this->start_controls_section(
			'general_section',
			[
				'label' => __( ' General Style', 'konsal' ),
				'tab' 	=> Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_control(
			'general_bg',
			[
				'label' 	=> __( 'Background', 'konsal' ),
				'type' 		=> Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .th-wrap' => 'background-color: {{VALUE}}!important;',
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
					'{{WRAPPER}} .th-wrap' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
			]
		);
		$this->add_responsive_control(
			'general_margin',
			[
				'label' 		=> __( 'Margin', 'konsal' ),
				'type' 			=> Controls_Manager::DIMENSIONS,
				'size_units' 	=> [ 'px', '%', 'em' ],
				'selectors' 	=> [
					'{{WRAPPER}} .th-wrap' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
			]
		);

		$this->end_controls_section();

		//----------------Title styling-----------------//
		konsal_common_style_fields( $this, 'title', 'Title', '{{WRAPPER}} .widget_title'); 
		//---------Button Style---------//
		konsal_button_style_fields( $this, '1', 'Button Style', '{{WRAPPER}} .th_btn' );
		konsal_button_style_fields( $this, '2', 'Button 2 Style', '{{WRAPPER}} .th_btn2' );

	}

	protected function render() {

        $settings = $this->get_settings_for_display();

        if( $settings['layout_style'] == '1' ){
            echo '<div class="widget widget_download th-wrap">';
                if( ! empty( $settings['title'] ) ){
                    echo '<h4 class="widget_title">'.esc_html( $settings['title'] ).'</h4>';
                }
                echo '<div class="download-widget-wrap">';
					$count = 0;
					foreach ($settings['files'] as $data) {
						if (!empty($data['title'])) {
							$class = ($count % 2 == 0) ? 'th-btn th_btn' : 'th-btn style4 th_btn2';
							echo '<a href="' . esc_url($data['url']) . '" class="'.esc_attr($class).'">' . esc_html($data['title']) . '</a>';
							$count++;
						}
					}    
                echo '</div>';
            echo '</div>';

        }


	}

}