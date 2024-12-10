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
class Konsal_Group_Image extends Widget_Base {

	public function get_name() {
		return 'konsalgrpimg';
	}

	public function get_title() {
		return __( 'Group Image', 'konsal' );
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
				'label' 	=> __( 'Group Image', 'konsal' ),
				'tab' 		=> Controls_Manager::TAB_CONTENT,
			]
        );
        $this->add_control(
			'layout_style',
			[
				'label' 		=> __( 'Group Image Style', 'konsal' ),
				'type' 			=> Controls_Manager::SELECT,
				'default' 		=> 'layout_one',
				'options' 		=> [
					'layout_one'  		=> __( 'Style One', 'konsal' ),
					'layout_two'  		=> __( 'Style Two', 'konsal' ),
					'layout_three'  	=> __( 'Style Three', 'konsal' ),
					'layout_four'  		=> __( 'Style Four', 'konsal' ),
				]
			]
		);
		
		
        $this->end_controls_section();

	    include konsal_get_elementor_option('group-image-one-options.php');
	    include konsal_get_elementor_option('group-image-two-options.php');
	    include konsal_get_elementor_option('group-image-three-options.php');
	
       
	}

	protected function render() {

        $settings = $this->get_settings_for_display();

        if( $settings['layout_style'] == 'layout_one' ){
        	echo '<div class="img-box1">';
        		if( ! empty( $settings['img_1']['url'] ) ){
		            echo '<div class="img1">';
		                echo konsal_img_tag( array(
							'url'   => esc_url( $settings['img_1']['url'] ),
						) );
		            echo '</div>';
		        }
		        if( ! empty( $settings['img_2']['url'] ) ){
		            echo '<div class="img2">';
		                echo konsal_img_tag( array(
							'url'   => esc_url( $settings['img_2']['url'] ),
						) );
		            echo '</div>';
		        }
		        if( ! empty( $settings['img_3']['url'] ) ){
		            echo '<div class="year-counter" data-bg-src="'.esc_url( $settings['img_3']['url'] ).'">';
		            	if( ! empty( $settings['content'] ) ){
		            		echo wp_kses_post( $settings['content'] );
		            	}
		            echo '</div>';
		        }
	        echo '</div>';

	    }elseif( $settings['layout_style'] == 'layout_two' ){
	    	echo '<div class="why-img-box">';
                if( ! empty( $settings['img_1']['url'] ) ){
		            echo '<div class="img1">';
		                echo konsal_img_tag( array(
							'url'   => esc_url( $settings['img_1']['url'] ),
						) );
		            echo '</div>';
		        }
                echo '<div class="about-grid jump" data-bg-src="">';
                    echo '<img class="about-grid_thumb" src="'.esc_url( $settings['img_2']['url'] ).'" alt="about">';
                    if( ! empty( $settings['content'] ) ){
	                    echo '<p class="about-grid_text">'.wp_kses_post( $settings['content'] ).'</p>';
	                }
                echo '</div>';
            echo '</div>';

	    }elseif( $settings['layout_style'] == 'layout_three' ){
	    	echo '<div class="img-box2">';
	    		if( ! empty( $settings['1_img_1']['url'] ) ){
	                echo '<div class="shape1">';
	                    echo konsal_img_tag( array(
							'url'   => esc_url( $settings['1_img_1']['url'] ),
						) );
	                echo '</div>';
	            }
                echo '<div class="img1">';
                	if( ! empty( $settings['1_img_2']['url'] ) ){
                		echo konsal_img_tag( array(
							'url'   => esc_url( $settings['1_img_2']['url'] ),
						) );
                	}
                	if( ! empty( $settings['1_img_3']['url'] ) ){
	                    echo '<div class="year-counter bg-title" data-bg-src="'.esc_url( $settings['1_img_3']['url'] ).'">';
	                        if( ! empty( $settings['1_content'] ) ){
			            		echo wp_kses_post( $settings['1_content'] );
			            	}
	                    echo '</div>';
	                }
                echo '</div>';
                if( ! empty( $settings['1_img_4']['url'] ) ){
                	echo '<div class="img2">';
	            		echo konsal_img_tag( array(
							'url'   => esc_url( $settings['1_img_4']['url'] ),
						) );
					echo '</div>';
            	}
            	if( ! empty( $settings['years'] ) ){
	                echo '<div class="about-since-wrap jump">';
	                    echo '<div class="about-since">'.esc_html( $settings['years'] ).'</div>';
	                echo '</div>';
	            }
            echo '</div>';

	    }else{
	    	echo '<div class="img-box3">';
                if( ! empty( $settings['4_img_1']['url'] ) ){
	                echo '<div class="img1">';
	                    echo konsal_img_tag( array(
							'url'   => esc_url( $settings['4_img_1']['url'] ),
						) );
	                echo '</div>';
	            }
	            if( ! empty( $settings['4_img_2']['url'] ) ){
	                echo '<div class="img2 jump">';
	                    echo konsal_img_tag( array(
							'url'   => esc_url( $settings['4_img_2']['url'] ),
						) );
	                echo '</div>';
	            }
            echo '</div>';

	    }

		
	}
}