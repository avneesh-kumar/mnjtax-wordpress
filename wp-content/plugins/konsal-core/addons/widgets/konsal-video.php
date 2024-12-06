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
 * Video Widget .
 *
 */
class konsal_Video extends Widget_Base {

	public function get_name() {
		return 'konsalvideo';
	}
	public function get_title() {
		return __( 'Video Box', 'konsal' );
	}
	public function get_icon() {
		return 'th-icon';
    }
	public function get_categories() {
		return [ 'konsal' ];
	}

	protected function register_controls() {

		$this->start_controls_section(
			'video_section',
			[
				'label' 	=> __( 'video Box', 'konsal' ),
				'tab' 		=> Controls_Manager::TAB_CONTENT,
			]
        );

		konsal_select_field( $this, 'layout_style', 'Layout Style', [ 'Style One' ] ); 

		konsal_media_fields( $this, 'image1', 'Choose Image' );
		konsal_general_fields( $this, 'icon', 'Icon', 'TEXTAREA2', '<i class="fa-sharp fa-solid fa-play"></i>' );
		konsal_url_fields( $this, 'video_url', 'Video URL' );

        $repeater = new Repeater();

		konsal_general_fields($repeater, 'num', 'Number', 'TEXTAREA2', '25');
		konsal_general_fields($repeater, 'title', 'Title', 'TEXTAREA2', 'Year Of Experience');

		$this->add_control(
			'counters',
			[
				'label' 		=> __( 'Counters', 'konsal' ),
				'type' 			=> Controls_Manager::REPEATER,
				'fields' 		=> $repeater->get_controls(),
				'condition'	=> [
					'layout_style' => ['1']
				]
			]
		);


		$this->end_controls_section();

        //---------------------------------------
			//Style Section Start
		//---------------------------------------

        konsal_common_style_fields( $this, 'num2', 'Number', '{{WRAPPER}} .title' );
        konsal_common_style_fields( $this, 'title2', 'Title', '{{WRAPPER}} .desc' );

	
	}

	protected function render() {

        $settings = $this->get_settings_for_display();

		if( $settings['layout_style'] == '1' ){
            echo '<div class="img-box7">';
                echo '<div class="img1">';
                    echo konsal_img_tag( array(
                        'url'   => esc_url( $settings['image1']['url'] ),
                    ));
                    if(!empty($settings['video_url']['url'])){
						echo '<a href="'.esc_url( $settings['video_url']['url'] ).'" class="play-btn style5 popup-video">'.wp_kses_post($settings['icon']).'</a>';
					}
                echo '</div>';
                echo '<div class="counter-wrap">';
                    foreach( $settings['counters'] as $data ){
                        echo '<div class="year-counter">';
                            if(!empty($data['num'])){
                                echo '<div class="year-counter_number title">'.wp_kses_post($data['num']).'</div>';
                            }
                            if(!empty($data['title'])){
                                echo '<p class="year-counter_text desc">'.wp_kses_post($data['title']).'</p>';
                            }
                        echo '</div>';
                    }
                echo '</div>';
            echo '</div>';

		}elseif( $settings['layout_style'] == '2' ){

	
		}


	}

}