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
 * Service Box Widget .
 *
 */
class Konsal_Service extends Widget_Base {

	public function get_name() {
		return 'konsalservices';
	}

	public function get_title() {
		return __( 'Service', 'konsal' );
	}

	public function get_icon() {
		return 'th-icon';
    }

	public function get_categories() {
		return [ 'konsal' ];
	}

	protected function register_controls() {

		$this->start_controls_section(
			'service_section',
			[
				'label' 	=> __( 'Service', 'konsal' ),
				'tab' 		=> Controls_Manager::TAB_CONTENT,
			]
        );
        $this->add_control(
			'layout_style',
			[
				'label' 		=> __( 'Service Style', 'konsal' ),
				'type' 			=> Controls_Manager::SELECT,
				'default' 		=> 'layout_one',
				'options' 		=> [
					'layout_one'  		=> __( 'Style One', 'konsal' ),
					'layout_two'  		=> __( 'Style Two', 'konsal' ),
					'layout_three'  	=> __( 'Style Three', 'konsal' ),
					'layout_four'  	    => __( 'Style Four', 'konsal' ),
					'layout_five'  	    => __( 'Style Five', 'konsal' ),
					'layout_six'  	    => __( 'Style Six', 'konsal' ),
					'layout_seven'  	=> __( 'Style Seven', 'konsal' ),
				]
			]
		);
		
		
        $this->end_controls_section();

	    include konsal_get_elementor_option('service-one-options.php');
	    include konsal_get_elementor_option('service-two-options.php');

        //-------------------------------------title styling-------------------------------------//
        $this->start_controls_section(
			'section_title_style_section',
			[
				'label' => __( 'Style', 'konsal' ),
				'tab' 	=> Controls_Manager::TAB_STYLE,
			]
		);

		konsal_all_elementor_style($this, 'Title', '{{WRAPPER}} .title-selector',['layout_one', 'layout_two', 'layout_three', 'layout_four'], '--title-color' );
		konsal_all_elementor_style($this, 'Description', '{{WRAPPER}} .desc-selector',['layout_one', 'layout_two', 'layout_three', 'layout_four'], '--body-color' );

        $this->end_controls_section();

		konsal_common_style_fields( $this, 'title3', 'Title', '{{WRAPPER}} .title', ['layout_five', 'layout_six', 'layout_seven'] );
		konsal_common_style_fields( $this, 'desc4', 'Description', '{{WRAPPER}} .desc', ['layout_five', 'layout_six', 'layout_seven'] );

       
	}

	protected function render() {

        $settings = $this->get_settings_for_display();

        if( $settings['layout_style'] == 'layout_one' || $settings['layout_style'] == 'layout_four' ){
			if( $settings['layout_style'] == 'layout_one' ){
				$col = 'col-xl-4 col-md-6';
			}else{
				$col = 'col-xl-6 col-lg-12 col-md-6';
			}
        	echo '<div class="row gy-30 gx-30 justify-content-center">';
                foreach( $settings['services'] as $key => $data ) {  
					$num = $key + 1;
					$formatted_num = ($num < 10) ? sprintf("%02d", $num) : $num; 
	                echo '<div class="'.esc_attr($col).'">';
	                    echo '<div class="service-card">';
	                        if( ! empty( $settings['bg']['url'] ) ){
				                echo '<div class="box-img">';
				                    echo konsal_img_tag( array(
										'url'   => esc_url( $settings['bg']['url'] ),
									) );
				                echo '</div>';
				            }
	                        echo '<div class="service-card-icon">';
	                            if( ! empty( $data['image']['url'] ) ){
					                echo '<div class="icon">';
					                    echo konsal_img_tag( array(
											'url'   => esc_url( $data['image']['url'] ),
										) );
					                echo '</div>';
					            }
	                            echo '<div class="service-card-num">';
	                                echo '<span>'.esc_html( $formatted_num ).'</span>';
	                            echo '</div>';
	                        echo '</div>';
	                        echo '<div class="box-content">';
	                        	if( ! empty( $data['title'] ) ){
		                            echo '<h3 class="box-title title-selector"><a href="'.esc_url( $data['button_link'] ).'">'.esc_html( $data['title'] ).'</a></h3>';
		                        }
		                        if( ! empty( $data['desc'] ) ){
		                            echo '<p class="box-text desc-selector">'.esc_html( $data['desc'] ).'</p>';
		                        }
	                            echo '<a href="'.esc_url( $data['button_link'] ).'" class="link-btn">'.esc_html( $data['button_text'] ).'<div class="icon"><i class="fa-solid fa-arrow-up-right ms-3"></i></div></a>';
	                        echo '</div>';
	                    echo '</div>';
	                echo '</div>';
	            } 
            echo '</div>';

	    }elseif( $settings['layout_style'] == 'layout_two' ){
	    	echo '<div class="row gy-30 gx-30 justify-content-center">';
                foreach( $settings['services'] as $data ) { 
	                echo '<div class="col-xl-4 col-md-6">';
	                    echo '<div class="service-card2">';
	                        if( ! empty( $settings['bg']['url'] ) ){
				                echo '<div class="box-img">';
				                    echo konsal_img_tag( array(
										'url'   => esc_url( $settings['bg']['url'] ),
									) );
				                echo '</div>';
				            }
	                        echo '<div class="box-content">';
	                        	 if( ! empty( $data['image']['url'] ) ){
					                echo '<div class="service-card-icon">';
					                    echo konsal_img_tag( array(
											'url'   => esc_url( $data['image']['url'] ),
										) );
					                echo '</div>';
					            }
	                            if( ! empty( $data['title'] ) ){
		                            echo '<h3 class="box-title title-selector"><a href="'.esc_url( $data['button_link'] ).'">'.esc_html( $data['title'] ).'</a></h3>';
		                        }
	                        echo '</div>';
	                        if( ! empty( $data['desc'] ) ){
	                            echo '<p class="box-text desc-selector">'.esc_html( $data['desc'] ).'</p>';
	                        }
	                        echo '<a href="'.esc_url( $data['button_link'] ).'" class="link-btn">'.esc_html( $data['button_text'] ).'<div class="icon"><i class="fa-solid fa-arrow-up-right ms-3"></i></div></a>';
	                    echo '</div>';
	                echo '</div>';
	            }
            echo '</div>';

	    }elseif( $settings['layout_style'] == 'layout_three' ){
	    	echo '<div class="row gy-30 gx-30 justify-content-center">';
                foreach( $settings['services'] as $data ) { 
	                echo '<div class="col-xl-4 col-md-6">';
	                    echo '<div class="service-card3">';
	                        echo '<div class="box-content">';
	                            if( ! empty( $data['image']['url'] ) ){
					                echo '<div class="service-card-icon">';
					                    echo konsal_img_tag( array(
											'url'   => esc_url( $data['image']['url'] ),
										) );
					                echo '</div>';
					            }
	                            if( ! empty( $data['title'] ) ){
		                            echo '<h3 class="box-title title-selector"><a href="'.esc_url( $data['button_link'] ).'">'.esc_html( $data['title'] ).'</a></h3>';
		                        }
	                        echo '</div>';
	                        if( ! empty( $data['desc'] ) ){
	                            echo '<p class="box-text desc-selector">'.esc_html( $data['desc'] ).'</p>';
	                        }
	                        echo '<a href="'.esc_url( $data['button_link'] ).'" class="link-btn style2"><i class="fas fa-plus-circle me-1"></i>'.esc_html( $data['button_text'] ).'</a>';
	                    echo '</div>';
	                echo '</div>';
	            }
            echo '</div>';

	    }elseif( $settings['layout_style'] == 'layout_five' ){
			echo '<div class="row gy-30 gx-30 justify-content-center">';
				foreach( $settings['services2'] as $key => $data ) {  
					$num = $key + 1;
					$formatted_num = ($num < 10) ? sprintf("%02d", $num) : $num; 
					echo '<div class="col-xl-4 col-md-6">';
						echo '<div class="service-card4">';
							echo '<div class="service-card-thumb">';
								echo konsal_img_tag( array(
									'url'   => esc_url( $data['image']['url'] ),
								) );
								if( ! empty( $data['icon']['url'] ) ){
									echo '<div class="service-card-icon">';
										echo konsal_img_tag( array(
											'url'   => esc_url( $data['icon']['url'] ),
										) );
									echo '</div>';
								}
							echo '</div>';
							echo '<div class="box-content">';
								if( ! empty( $data['title'] ) ){
									echo '<h3 class="box-title title"><a href="'.esc_url( $data['button_link']['url'] ).'">'.esc_html( $data['title'] ).'</a></h3>';
								}
								if( ! empty( $data['desc'] ) ){
									echo '<p class="box-text desc">'.esc_html( $data['desc'] ).'</p>';
								}
								echo '<div class="btn-wrap">';
									if( ! empty( $data['button_text'] ) ){
										echo '<a href="'.esc_url( $data['button_link']['url'] ).'" class="link-btn style2"><i class="fas fa-plus-circle me-1"></i>'.esc_html( $data['button_text'] ).'</a>';
									}
									echo '<div class="service-card-num">';
										echo '<span>'.esc_html( $formatted_num ).'</span>';
									echo '</div>';
								echo '</div>';
							echo '</div>';
						echo '</div>';
					echo '</div>';
				}
			echo '</div>';

		}elseif( $settings['layout_style'] == 'layout_six' ){
			echo '<div class="row gy-4 justify-content-center">';
				foreach( $settings['services'] as $data ) { 
					echo '<div class="col-lg-4 col-md-6">';
						echo '<div class="feature-card">';
							if( ! empty( $settings['bg']['url'] ) ){
								echo '<div class="feature-card-bg-shape">';
									echo konsal_img_tag( array(
										'url'   => esc_url( $settings['bg']['url'] ),
									) );
								echo '</div>';
							}
							echo '<div class="feature-card-title-wrap">';
								if( ! empty( $data['image']['url'] ) ){
									echo '<div class="box-icon">';
										echo konsal_img_tag( array(
											'url'   => esc_url( $data['image']['url'] ),
										) );
									echo '</div>';
								}
								if( ! empty( $data['title'] ) ){
									echo '<h3 class="box-title title"><a href="'.esc_url( $data['button_link'] ).'">'.esc_html( $data['title'] ).'</a></h3>';
								}
							echo '</div>';
							if( ! empty( $data['desc'] ) ){
								echo '<p class="box-text desc">'.esc_html( $data['desc'] ).'</p>';
							}
							echo '<a href="'.esc_url( $data['button_link'] ).'" class="link-btn">'.esc_html( $data['button_text'] ).'<div class="icon"><i class="fa-solid fa-arrow-up-right ms-3"></i></div></a>';
						echo '</div>';
					echo '</div>';
				}
			echo '</div>';

		}elseif( $settings['layout_style'] == 'layout_seven' ){
		echo '<div class="slider-area">';
			echo '<div class="swiper th-slider has-shadow" id="serviceSlider6" data-slider-options=\'{"breakpoints":{"0":{"slidesPerView":1},"576":{"slidesPerView":"1"},"768":{"slidesPerView":"2"},"992":{"slidesPerView":"2"},"1200":{"slidesPerView":"3"}}}\'>';
				echo '<div class="swiper-wrapper">';
					foreach( $settings['services2'] as $key => $data ) {  
						echo '<div class="swiper-slide">';
							echo '<div class="service-card6">';
								echo '<div class="service-card-thumb">';
									echo konsal_img_tag( array(
										'url'   => esc_url( $data['image']['url'] ),
									) );
									if( ! empty( $data['icon']['url'] ) ){
										echo '<div class="service-card-icon">';
											echo konsal_img_tag( array(
												'url'   => esc_url( $data['icon']['url'] ),
											) );
										echo '</div>';
									}
								echo '</div>';
								echo '<div class="box-content">';
									if( ! empty( $data['title'] ) ){
										echo '<h3 class="box-title title"><a href="'.esc_url( $data['button_link']['url'] ).'">'.esc_html( $data['title'] ).'</a></h3>';
									}
									echo '<div class="btn-wrap">';
										if( ! empty( $data['desc'] ) ){
											echo '<p class="box-text desc">'.esc_html( $data['desc'] ).'</p>';
										}
										if( ! empty( $data['button_text'] ) ){
											echo '<a href="'.esc_url( $data['button_link']['url'] ).'" class="link-btn style2"><i class="fas fa-plus-circle me-1"></i>'.esc_html( $data['button_text'] ).'</a>';
										}
									echo '</div>';
								echo '</div>';
							echo '</div>';
						echo '</div>';
					}
				echo '</div>';
			echo '</div>';
			echo '<button data-slider-prev="#serviceSlider6" class="slider-arrow slider-prev"><i class="far fa-arrow-left"></i></button>';
			echo '<button data-slider-next="#serviceSlider6" class="slider-arrow slider-next"><i class="far fa-arrow-right"></i></button>';
		echo '</div>';

		}


	}
}