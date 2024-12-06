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
 * Price Box Widget .
 *
 */
class Konsal_Price extends Widget_Base {

	public function get_name() {
		return 'konsalprice';
	}

	public function get_title() {
		return __( 'Price', 'konsal' );
	}

	public function get_icon() {
		return 'th-icon';
    }

	public function get_categories() {
		return [ 'konsal' ];
	}

	protected function register_controls() {

		$this->start_controls_section(
			'price_section',
			[
				'label' 	=> __( 'Price', 'konsal' ),
				'tab' 		=> Controls_Manager::TAB_CONTENT,
			]
        );
        $this->add_control(
			'layout_style',
			[
				'label' 		=> __( 'Price Style', 'konsal' ),
				'type' 			=> Controls_Manager::SELECT,
				'default' 		=> 'layout_one',
				'options' 		=> [
					'layout_one'  		=> __( 'Style One', 'konsal' ),
					'layout_two'  		=> __( 'Style Two', 'konsal' ),
				]
			]
		);
		
        $this->end_controls_section();


	    include konsal_get_elementor_option('price-one-options.php');
	    include konsal_get_elementor_option('price-two-options.php');

        //-------------------------------------title styling-------------------------------------//

        $this->start_controls_section(
			'section_title_style_section',
			[
				'label' => __( 'Style', 'konsal' ),
				'tab' 	=> Controls_Manager::TAB_STYLE,
			]
		);

		konsal_all_elementor_style($this, 'Title', '{{WRAPPER}} .title-selector',['layout_one'], '--title-color' );
		konsal_all_elementor_style($this, 'Subtitle', '{{WRAPPER}} .subtitle-selector',['layout_one'], '--body-color' );
		konsal_all_elementor_style($this, 'Price', '{{WRAPPER}} .price-card_price',['layout_one'], '--title-color' );

        $this->end_controls_section();

		konsal_common_style_fields( $this, 'title22', 'Title', '{{WRAPPER}} .title', ['layout_two'] );
		konsal_common_style_fields( $this, 'price22', 'Price', '{{WRAPPER}} .price', ['layout_two'] );
		konsal_common_style_fields( $this, 'desc22', 'Features', '{{WRAPPER}} .available-list li', ['layout_two'] );
		
		//------Button Style-------
		konsal_button_style_fields( $this, '111', 'Button Styling', '{{WRAPPER}} .th-btn' );

       
	}

	protected function render() {

        $settings = $this->get_settings_for_display();

        if( $settings['layout_style'] == 'layout_one' ){
        	echo '<div class="row gy-4 justify-content-center">';
        		foreach( $settings['price_list'] as $data ) {  
	                echo '<div class="col-lg-4 col-md-6">';
	                    echo '<div class="price-card ">';
	                    	if( ! empty( $data['image']['url'] ) ){
		                        echo '<div class="price-card-bg">';
		                            echo konsal_img_tag( array(
										'url'   => esc_url( $data['image']['url'] ),
									) );
		                        echo '</div>';
		                    }
	                        if( !empty( $data['title'] ) ){
		                        echo '<h3 class="box-title title-selector">'.esc_html($data['title']).'</h3>';
		                    }
		                    if( !empty( $data['subtitle'] ) ){
		                        echo '<p class="price-card_text subtitle-selector">'.esc_html($data['subtitle']).'</p>';
		                    }
		                    if( !empty( $data['price'] ) ){
		                        echo '<h4 class="price-card_price">'.wp_kses_post( $data['price'] ).'</h4>';
		                    }
	                        echo '<div class="price-card_content">';
	                        	if( !empty( $data['features'] ) ){
		                            echo '<div class="checklist">';
		                                
		                            echo wp_kses_post( $data['features'] );

		                            echo '</div>';
		                        }
		                        if( !empty( $data['button_link'] ) ){
		                            echo '<a href="'.esc_url($data['button_link']).'" class="th-btn w-100">'.esc_html($data['button_text']).'</a>';
		                        }
	                        echo '</div>';
	                    echo '</div>';
	                echo '</div>';
	            }
            echo '</div>';

	    }elseif( $settings['layout_style'] == 'layout_two' ){
			echo '<div class="row gy-4 justify-content-center">';
				foreach( $settings['price_list2'] as $data ) {  
					echo '<div class="col-xl-4 col-md-6">';
						echo '<div class="price-card2">';
							if( !empty( $data['title2'] ) ){
		                        echo '<h3 class="price-card_title title">'.esc_html($data['title2']).'</h3>';
		                    }
							if( !empty( $data['price2'] ) ){
		                        echo '<h4 class="price-card_price price">'.wp_kses_post( $data['price2'] ).'</h4>';
		                    }
							echo '<div class="price-card_content">';
								if( !empty( $data['features2'] ) ){
									echo '<div class="available-list">'.wp_kses_post( $data['features2'] ).'</div>';
								}
								if( !empty( $data['button_text2'] ) ){
								echo '<a href="'.esc_url($data['button_link2']['url']).'" class="th-btn">'.esc_html($data['button_text2']).' <span class="icon"><i class="fa-solid fa-arrow-up-right ms-3"></i></span></a>';
								}
							echo '</div>';
						echo '</div>';
					echo '</div>';
				}
			echo '</div>';

		}


	}
}