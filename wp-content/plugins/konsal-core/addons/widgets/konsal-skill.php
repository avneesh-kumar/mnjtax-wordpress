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
 * Skill Widget .
 *
 */
class Konsal_Skill extends Widget_Base {

	public function get_name() {
		return 'konsalskill';
	}
	public function get_title() {
		return __( 'Skill Bar', 'konsal' );
	}
	public function get_icon() {
		return 'th-icon';
    }
	public function get_categories() {
		return [ 'konsal' ];
	}

	protected function register_controls() {

        $this->start_controls_section(
            'skill_bar_section',
                [
                    'label' 	=> __( 'Skill Bar', 'konsal' ),
                    'tab' 		=> Controls_Manager::TAB_CONTENT,
                ]
        );

        konsal_select_field( $this, 'layout_style', 'Layout Style', ['Style One', 'Style Two'] );

        $repeater = new Repeater();

        konsal_general_fields($repeater, 'skill_title', 'Title', 'TEXT', 'Success Rate');
        konsal_general_fields($repeater, 'skill_num', 'Number', 'TEXT', '90');

        $this->add_control(
            'skill_lists',
            [
                'label' 		=> __( 'Skill Lists', 'konsal' ),
                'type' 			=> Controls_Manager::REPEATER,
                'fields' 		=> $repeater->get_controls(),
                'default' 		=> [
                        [
                            'skill_title' => __( 'Success Rate', 'konsal' ),
                        ],
                ],
            ]
        );

        $this->end_controls_section();

        //---------------------------------------
            //Style Section Start
        //---------------------------------------

        //-------Title/Number Style-------
        konsal_common_style_fields($this, 'title', 'Title', '{{WRAPPER}} .skill-feature_title');
        konsal_common_style_fields($this, 'num', 'Number', '{{WRAPPER}} .progress-value');

	}

	protected function render() {

    $settings = $this->get_settings_for_display();

        if( $settings['layout_style'] == '1' ){
            foreach( $settings['skill_lists'] as $data ){
                echo '<div class="skill-feature style2">';
                    if(!empty($data['skill_title'])){
                        echo '<h3 class="skill-feature_title">'.esc_html($data['skill_title']).'</h3>';
                    }
                    echo '<div class="progress">';
                        echo '<div class="progress-bar" style="width: '.esc_attr($data['skill_num']).'%;"> </div>';
                        echo '<div class="progress-value">'.esc_attr($data['skill_num']).'%</div>';
                    echo '</div>';
                echo '</div>';
            }

        }elseif( $settings['layout_style'] == '2' ){
            foreach( $settings['skill_lists'] as $data ){
                echo '<div class="skill-feature style2">';
                    if(!empty($data['skill_title'])){
                        echo '<h3 class="skill-feature_title">'.esc_html($data['skill_title']).'</h3>';
                    }
                    echo '<div class="progress">';
                        echo '<div class="progress-bar bg-theme" style="width: '.esc_attr($data['skill_num']).'%;"> </div>';
                        echo '<div class="progress-value">'.esc_attr($data['skill_num']).'%</div>';
                    echo '</div>';
                echo '</div>';
            }

        }


	}

}