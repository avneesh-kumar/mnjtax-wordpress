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
 * Service-list Widget .
 *
 */
class konsal_Service_List extends Widget_Base {

	public function get_name() {
		return 'konsalservicelist';
	}

	public function get_title() {
		return __( 'Services List', 'konsal' );
	}

	public function get_icon() {
		return 'th-icon';
    }

	public function get_categories() {
		return [ 'konsal' ];
	}

	protected function register_controls() {

		$this->start_controls_section(
			'service_lists_section',
			[
				'label'     => __( 'Services List', 'konsal' ),
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
				'type'          => Controls_Manager::TEXT,
				'default'       => __( 'All Services' , 'konsal' ),
				'label_block'   => true,
				]
		);

		$repeater = new Repeater();

        $repeater->add_control(
			'service-cate',
            [
				'label'         => __( 'Service List', 'konsal' ),
				'type'          => Controls_Manager::TEXTAREA,
				'default'       => __( '' , 'konsal' ),
				'label_block'   => true,
				'rows' => '2'
			]
		);

		$repeater->add_control(
			'service-cate-link',
			[
				'label' 		=> esc_html__( 'Service List Link', 'konsal' ),
				'type' 			=> Controls_Manager::URL,
				'placeholder' 	=> esc_html__( 'https://your-link.com', 'konsal' ),
				'show_external' => true,
				'default' 		=> [
					'url' 			=> '#',
					'is_external' 	=> false,
					'nofollow' 		=> false,
				],
			]
		);
		
		$this->add_control(
			'service_lists',
			[
				'label' 		=> __( 'Services Lists', 'konsal' ),
				'type' 			=> Controls_Manager::REPEATER,
				'fields' 		=> $repeater->get_controls(),
				'default' 		=> [
					[
						'service-cate' 		=> __( 'Accessories', 'konsal' ),
					],
				],
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
					'{{WRAPPER}} .th-cate-wrap' => 'background-color: {{VALUE}}!important;',
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
					'{{WRAPPER}} .th-cate-wrap' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
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
					'{{WRAPPER}} .th-cate-wrap' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
			]
		);

		$this->end_controls_section();

		//----------------Title styling-----------------//
		konsal_common_style_fields( $this, 'title', 'Title', '{{WRAPPER}} .widget_title');


	}

	protected function render() {

        $settings = $this->get_settings_for_display();

            if( $settings['layout_style'] == '1' ){
                echo '<div class="widget widget_categories th-cate-wrap">';
                    if(!empty($settings['title'])){
                        echo '<h3 class="widget_title">'.esc_html($settings['title']).'</h3>';
                    }
                    echo '<ul>';
                        foreach( $settings['service_lists'] as $data ){
                        echo ' <li>';
                                echo '<a href="'.esc_url( $data['service-cate-link']['url'] ).'">'.wp_kses_post($data['service-cate']).'</a>';
                                echo '<span><i class="fas fa-angle-right"></i></span>';
                            echo '</li>';
                        }
                    echo '</ul>';
                echo '</div>';
            }

        
	}
}