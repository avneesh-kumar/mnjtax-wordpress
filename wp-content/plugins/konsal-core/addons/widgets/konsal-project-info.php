<?php
use \Elementor\Widget_Base;
use \Elementor\Controls_Manager;
use \Elementor\Group_Control_Typography;
use \Elementor\Utils;
use \Elementor\Repeater;
use \Elementor\Group_Control_Border;
use \Elementor\Group_Control_Image_Size;
/**
 *
 * Project Info Widget
 *
 */
class konsal_Project_Info extends Widget_Base{

	public function get_name() {
		return 'konsalprojectinfo';
	}

	public function get_title() {
		return esc_html__( 'Project Info', 'konsal' );
	}

	public function get_icon() {
		return 'th-icon';
    }

	public function get_categories() {
		return [ 'konsal' ];
	}

	protected function register_controls() {

		$this->start_controls_section(
			'project_content',
			[
				'label'		=> esc_html__( 'Project Info','konsal' ),
				'tab'		=> Controls_Manager::TAB_CONTENT,
			]
		);

        $this->add_control(
			'title',
			[
				'label' 	=> esc_html__( 'Title', 'konsal' ),
                'type' 		=> Controls_Manager::TEXTAREA,
                'default'  	=> esc_html__( 'Title', 'konsal' ),
                'rows' => '2'
			]
        );
 
        $repeater = new Repeater();

        $repeater->add_control(
			'label',
			[
				'label' 	=> __( 'List Title', 'konsal' ),
                'type' 		=> Controls_Manager::TEXTAREA,
                'rows' 		=> 2,
                'default'  	=> __( '', 'konsal' )
			]
        );

        $repeater->add_control(
			'content',
			[
				'label' 	=> __( 'List Content', 'konsal' ),
                'type' 		=> Controls_Manager::TEXTAREA,
                'rows' 		=> 2,
                'default'  	=> __( '', 'konsal' )
			]
        );

		$this->add_control(
			'project_lists',
			[
				'label' 		=> __( 'project Info List', 'konsal' ),
				'type' 			=> Controls_Manager::REPEATER,
				'fields' 		=> $repeater->get_controls(),
				'default' 		=> [
					[
						'title'    => __( 'Clients :', 'konsal' ),
						'content'    => __( 'Ronald Richards', 'konsal' ),
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
        //----------------Label styling-----------------//
        konsal_common_style_fields( $this, 'label', 'Label', '{{WRAPPER}} .info-list .text');
        //----------------Content styling-----------------//
        konsal_common_style_fields( $this, 'content', 'Content', '{{WRAPPER}} .info-list .title');

	}

	protected function render() {

		$settings = $this->get_settings_for_display(); 

            echo '<aside class="sidebar-area pt-xl-0 pt-40">';
                echo '<div class="widget widget_info th-wrap">';
                    if(!empty($settings['title'])){
                        echo '<h3 class="widget_title">'.esc_html($settings['title']).'</h3>';
                    }
                    echo '<div class="info-list">';
                        echo '<ul>';
                        foreach( $settings['project_lists'] as $data ){
                            echo '<li>';
                                echo '<div>';
                                    echo '<span class="text">'.esc_html( $data['label'] ).'</span>';
                                    echo '<strong class="title">'.esc_html( $data['content'] ).'</strong>';
                                echo '</div>';
                            echo '</li>';
                        }
                        echo '</ul>';
                    echo '</div>';
                echo '</div>';
            echo '</aside>';

		
	}
}