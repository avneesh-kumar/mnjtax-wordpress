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
 * Progress Bar Widget .
 *
 */
class konsal_Progress_Bar extends Widget_Base {

	public function get_name() {
		return 'konsalprogressbar';
	}

	public function get_title() {
		return __( 'Progress Bar', 'konsal' );
	}

	public function get_icon() {
		return 'th-icon';
    }

	public function get_categories() {
		return [ 'konsal' ];
	}

	protected function register_controls() {

        $this->start_controls_section(
                'progress_bar_section',
                    [
                        'label' 	=> __( 'Progress Bar', 'konsal' ),
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

        $repeater = new Repeater();

        $repeater->add_control(
            'skill_title',
                [
                'label'         => __( 'Title', 'konsal' ),
                'type'          => Controls_Manager::TEXT,
                'default'       => __( 'Skill' , 'konsal' ),
                'label_block'   => true,
                ]
        );

        $repeater->add_control(
            'skill_num',
                [
                'label'         => __( 'Number', 'konsal' ),
                'type'          => Controls_Manager::TEXT,
                'default'       => __( '90' , 'konsal' ),
                'label_block'   => true,
                ]
        );

        $this->add_control(
            'skill_lists',
            [
                'label' 		=> __( 'Skill Lists', 'konsal' ),
                'type' 			=> Controls_Manager::REPEATER,
                'fields' 		=> $repeater->get_controls(),
                'default' 		=> [
                        [
                            'skill_title' 		=> __( 'Title', 'konsal' ),
                        ],
                ],
            ]
        );

        $this->end_controls_section();

        //---------------------------------------
            //Style Section Start
        //---------------------------------------

        //--------------Title styling---------------//
        $this->start_controls_section(
            'section_title_style_section',
            [
                'label' => __( 'Style', 'konsal' ),
                'tab' 	=> Controls_Manager::TAB_STYLE,
            ]
        );

        konsal_all_elementor_style($this, 'Title', '{{WRAPPER}} .skill-feature_title', [ '1' ], '--title-color' );

        $this->end_controls_section();

	}

	protected function render() {

    $settings = $this->get_settings_for_display();

        if( $settings['layout_style'] == '1' ){
            foreach( $settings['skill_lists'] as $data ){
                echo '<div class="skill-feature">';
                    echo '<h3 class="skill-feature_title">'.esc_html($data['skill_title']).'</h3>';
                    echo '<div class="progress">';
                        echo '<div class="progress-bar" style="width: '.esc_attr($data['skill_num']).'%;"></div>';
                        echo '<div class="progress-value"><span class="counter-number">'.esc_attr($data['skill_num']).'</span> %</div>';
                    echo '</div>';
                echo '</div>';
            }
        }


	}

}