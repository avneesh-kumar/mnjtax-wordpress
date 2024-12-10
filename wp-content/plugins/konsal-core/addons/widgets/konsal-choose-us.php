<?php
use \Elementor\Widget_Base;
use \Elementor\Controls_Manager;
use \Elementor\Group_Control_Typography;
use \Elementor\Repeater;
use \Elementor\Utils;
use \Elementor\Group_Control_Border;
/**
 *
 * Choose Slider Widget.
 *
 */
class Konsal_Choose extends Widget_Base {

	public function get_name() {
		return 'konsalChoose';
	}
	public function get_title() {
		return __( 'Choose', 'konsal' );
	}
	public function get_icon() {
		return 'th-icon';
    }
	public function get_categories() {
		return [ 'konsal_header_elements' ];
	}

	protected function register_controls() {

		$this->start_controls_section(
			'Choose_section',
			[
				'label' 	=> __( 'Choose', 'konsal' ),
				'tab' 		=> Controls_Manager::TAB_CONTENT,
			]
        );

		konsal_select_field( $this, 'layout_style', 'Layout Style', ['Style One'] ); 


        konsal_media_fields($this, 'bg', 'Choose Bacground Image');
        konsal_media_fields($this, 'video_image', 'Choose Video Image');
        konsal_url_fields($this, 'video_url', 'Video URL');

        konsal_media_fields($this, 'sub_shape', 'Choose Subtitle Shape');
        konsal_general_fields($this, 'subtitle', 'Subtitle', 'TEXT', 'The Leading Platform Event');
		konsal_general_fields($this, 'title', 'Title', 'TEXTAREA', '2024 Global Business');
		konsal_general_fields($this, 'desc', 'Description', 'TEXTAREA', '');

        $repeater = new Repeater();

        konsal_general_fields($repeater, 'skill_num', 'Number', 'TEXT', '90');
        konsal_general_fields($repeater, 'skill_title', 'Title', 'TEXTAREA', 'Success Rate');
        konsal_general_fields($repeater, 'skill_desc', 'Description', 'TEXTAREA', '');

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

		//-------Subtitle/title/description Style-------
		konsal_common_style_fields( $this, 'subtitle2', 'Subtitle', '{{WRAPPER}} .sub', ['1'] );
		konsal_common_style_fields( $this, 'title3', 'Title', '{{WRAPPER}} .title' );
		konsal_common_style_fields( $this, 'desc4', 'Description', '{{WRAPPER}} .desc' );

        konsal_common_style_fields( $this, 'title22', 'Skill Title', '{{WRAPPER}} .box-title' );
		konsal_common_style_fields( $this, 'desc22', 'Skill Description', '{{WRAPPER}} .text' );


    }

	protected function render() {

    $settings = $this->get_settings_for_display();

		if( $settings['layout_style'] == '1' ){
        echo '<div class="why-sec4 shape-mockup-wrap">';
            echo '<div class="shape-mockup why-bg-shape4-1 bg-smoke d-xl-block d-none" data-top="0" data-right="0" data-bg-src="'.esc_url( $settings['bg']['url'] ).'"></div>';
            echo '<div class="container">';
                echo '<div class="why-wrap4">';
                    echo '<div class="why-img-box3 mb-xl-0 mb-50">';
                        echo konsal_img_tag( array(
                            'url'   => esc_url( $settings['video_image']['url'] ),
                        )); 
                        if(!empty($settings['video_url']['url'])){
                            echo '<a href="'.esc_url( $settings['video_url']['url'] ).'" class="play-btn style4 popup-video"><i class="fa-sharp fa-solid fa-play"></i></a>';
                        }
                    echo '</div>';
                    echo '<div class="title-area mb-0">';
                        if(!empty($settings['subtitle'])){
                            echo '<span class="sub-title sub">';
                                echo konsal_img_tag( array(
                                    'url'   => esc_url( $settings['sub_shape']['url'] ),
                                )); 
                                echo wp_kses_post($settings['subtitle']);
                            echo '</span>';
                        }
                        if(!empty($settings['title'])){
                            echo '<h1 class="sec-title title">'.wp_kses_post($settings['title']).'</h1>';
                        }
                        if(!empty($settings['desc'])){
                            echo '<p class="sec-text mt-30 mb-40 desc">'.wp_kses_post($settings['desc']).'</p>';
                        }
                        foreach( $settings['skill_lists'] as $data ){
                        echo '<div class="progress-grid-wrap">';
                            echo '<div class="feature-circle">';
                                echo '<div class="progressbar">';
                                    echo '<div class="circle" data-percent="'.esc_attr($data['skill_num']).'">';
                                        echo '<div class="circle-num">'.esc_html($data['skill_num']).'%</div>';
                                    echo '</div>';
                                echo '</div>';
                            echo '</div>';
                            echo '<div class="progress-wrap-content">';
                                if(!empty($data['skill_title'])){
                                    echo '<h3 class="box-title">'.esc_html($data['skill_title']).'</h3>';
                                }
                                if(!empty($data['skill_desc'])){
                                    echo '<p class="text">'.esc_html($data['skill_desc']).'</p>';
                                }
                            echo '</div>';
                        echo '</div>';
                        }
                    echo '</div>';
                echo '</div>';
            echo '</div>';
        echo '</div>';
           
		}elseif( $settings['layout_style'] == '2' ){


		}

		
	}

}