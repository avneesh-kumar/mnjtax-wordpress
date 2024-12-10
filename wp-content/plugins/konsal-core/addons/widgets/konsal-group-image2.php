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
 * Group Image Box Widget .
 *
 */
class Konsal_Group_Image2 extends Widget_Base {

	public function get_name() {
		return 'konsalgroupimage2';
	}
	public function get_title() {
		return __( 'Group Image V2', 'konsal' );
	}
	public function get_icon() {
		return 'th-icon';
    }
	public function get_categories() {
		return [ 'konsal' ];
	}

	protected function register_controls() {

		$this->start_controls_section(
			'group_section',
			[
				'label' 	=> __( 'Group Image V2', 'konsal' ),
				'tab' 		=> Controls_Manager::TAB_CONTENT,
			]
        );
        $this->add_control(
			'layout_style',
			[
				'label' 		=> __( 'Group Image Style', 'konsal' ),
				'type' 			=> Controls_Manager::SELECT,
				'default' 		=> '1',
				'options' 		=> [
					'1'  		=> __( 'Style One', 'konsal' ),
					'2'  		=> __( 'Style Two', 'konsal' ),
					'3'  		=> __( 'Style Three', 'konsal' ),
					'4'  		=> __( 'Style Four', 'konsal' ),
					'5'  		=> __( 'Style Five', 'konsal' ),
				]
			]
		);
		
        konsal_media_fields($this, 'image1', 'Choose Image');
        konsal_media_fields($this, 'image2', 'Choose Image', ['1', '2', '4']);

        konsal_media_fields($this, 'icon', 'Choose Icon', ['4']);
		konsal_general_fields($this, 'circle_title', 'Circle Title', 'TEXTAREA2', 'Title', ['4']);

		konsal_general_fields($this, 'title', 'Title', 'TEXTAREA2', 'Title', ['2', '4', '5']);
		konsal_general_fields($this, 'desc', 'Description', 'TEXTAREA', 'Content', ['2', '4', '5']);

		konsal_media_fields($this, 'shape', 'Choose Shape', ['4', '5']);

		konsal_url_fields($this, 'video_url', 'Video URL', ['2']);
		
        $this->end_controls_section();
       
	}

	protected function render() {

        $settings = $this->get_settings_for_display();

        if( $settings['layout_style'] == '1' ){
            echo '<div class="img-box4">';
                if( ! empty( $settings['image1']['url'] ) ){
                    echo '<div class="img1">';
                        echo konsal_img_tag( array(
                            'url'   => esc_url( $settings['image1']['url'] ),
                        ) );
                    echo '</div>';
                }
                if( ! empty( $settings['image2']['url'] ) ){
                    echo '<div class="img2 jump-reverse">';
                        echo konsal_img_tag( array(
                            'url'   => esc_url( $settings['image2']['url'] ),
                        ) );
                    echo '</div>';
                }
            echo '</div>';

	    }elseif( $settings['layout_style'] == '2' ){
	    	echo '<div class="img-box5">';
				if( ! empty( $settings['image1']['url'] ) ){
                    echo '<div class="img1">';
                        echo konsal_img_tag( array(
                            'url'   => esc_url( $settings['image1']['url'] ),
                        ) );
                    echo '</div>';
                }
				if( ! empty( $settings['image2']['url'] ) ){
				echo '<div class="img2 jump-reverse">';
					echo konsal_img_tag( array(
						'url'   => esc_url( $settings['image2']['url'] ),
					) );
					if( ! empty( $settings['video_url']['url'] ) ){
					echo '<a href="'.esc_url( $settings['video_url']['url'] ).'" class="play-btn style5 popup-video"><i class="fa-sharp fa-solid fa-play"></i></a>';
					}
				echo '</div>';
				}
				echo '<div class="year-counter jump">';
					if(!empty($settings['title'])){
						echo '<div class="year-counter_number">'.wp_kses_post($settings['title']).'</div>';
					}
					if(!empty($settings['desc'])){
						echo '<p class="year-counter_text">'.esc_html($settings['desc']).'</p>';
					}
				echo '</div>';
			echo '</div>';

	    }elseif( $settings['layout_style'] == '3' ){
			if( ! empty( $settings['image1']['url'] ) ){
				echo '<div class="why-img-box5 text-lg-end">';
					echo konsal_img_tag( array(
						'url'   => esc_url( $settings['image1']['url'] ),
					) );
				echo '</div>';
			}

		}elseif( $settings['layout_style'] == '4' ){
			echo '<div class="img-box6">';
				echo '<div class="about-tag">';
					if(!empty($settings['circle_title'])){
						echo '<div class="about-experience-tag">';
							echo '<span class="circle-title-anime">'.esc_html($settings['circle_title']).'</span>';
						echo '</div>';
					}
					if( ! empty( $settings['icon']['url'] ) ){
						echo '<div class="about-tag-icon">';
							echo konsal_img_tag( array(
								'url'   => esc_url( $settings['icon']['url'] ),
							) );
						echo '</div>';
					}
				echo '</div>';
				if( ! empty( $settings['image1']['url'] ) ){
					echo '<div class="img1">';
						echo konsal_img_tag( array(
							'url'   => esc_url( $settings['image1']['url'] ),
						) );
					echo '</div>';
				}
				if( ! empty( $settings['image2']['url'] ) ){
					echo '<div class="img2">';
						echo konsal_img_tag( array(
							'url'   => esc_url( $settings['image2']['url'] ),
						) );
					echo '</div>';
				}
				echo '<div class="year-counter bg-smoke" data-bg-src="'.esc_url( $settings['shape']['url'] ).'">';
					if(!empty($settings['title'])){
						echo '<div class="year-counter_number">'.wp_kses_post($settings['title']).'</div>';
					}
					if(!empty($settings['desc'])){
						echo '<p class="year-counter_text">'.esc_html($settings['desc']).'</p>';
					}
				echo '</div>';
			echo '</div>';

		}elseif( $settings['layout_style'] == '5' ){
			echo '<div class="img-box8">';
				echo '<div class="img1">';
					echo '<div class="year-counter jump-reverse" data-bg-src="'.esc_url( $settings['shape']['url'] ).'">';
						if(!empty($settings['title'])){
							echo '<div class="year-counter_number">'.wp_kses_post($settings['title']).'</div>';
						}
						if(!empty($settings['desc'])){
							echo '<p class="year-counter_text">'.esc_html($settings['desc']).'</p>';
						}
					echo '</div>';
					if( ! empty( $settings['image1']['url'] ) ){
						echo konsal_img_tag( array(
							'url'   => esc_url( $settings['image1']['url'] ),
						) );
					}
				echo '</div>';
			echo '</div>';

		}

		
	}
}