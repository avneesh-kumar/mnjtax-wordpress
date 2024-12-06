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
 * Testimonials Box Widget .
 *
 */
class Konsal_Testimonials extends Widget_Base {

	public function get_name() {
		return 'konsaltestimonials';
	}

	public function get_title() {
		return __( 'Testimonials', 'konsal' );
	}

	public function get_icon() {
		return 'th-icon';
    }

	public function get_categories() {
		return [ 'konsal' ];
	}

	protected function register_controls() {

		$this->start_controls_section(
			'testimonial_section',
			[
				'label' 	=> __( 'Testimonials', 'konsal' ),
				'tab' 		=> Controls_Manager::TAB_CONTENT,
			]
        );
        $this->add_control(
			'layout_style',
			[
				'label' 		=> __( 'Testimonials Style', 'konsal' ),
				'type' 			=> Controls_Manager::SELECT,
				'default' 		=> 'layout_one',
				'options' 		=> [
					'layout_one'  		=> __( 'Style One', 'konsal' ),
					'layout_two'  		=> __( 'Style Two', 'konsal' ),
					'layout_three'  	=> __( 'Style Three', 'konsal' ),
					'layout_four'  		=> __( 'Style Four', 'konsal' ),
					'layout_five'  		=> __( 'Style Five', 'konsal' ),
					'layout_six'  		=> __( 'Style Six', 'konsal' ),
				]
			]
		);
		
        $this->end_controls_section();


	    include konsal_get_elementor_option('testimonials-one-options.php');
	    include konsal_get_elementor_option('testimonials-six-options.php');


        //-------------------------------------title styling-------------------------------------//
        $this->start_controls_section(
			'section_title_style_section',
			[
				'label' => __( 'Style', 'konsal' ),
				'tab' 	=> Controls_Manager::TAB_STYLE,
			]
		);

		konsal_all_elementor_style($this, 'Name', '{{WRAPPER}} .title-selector',[ 'layout_one' ], '--white-color' );
		konsal_all_elementor_style($this, 'Name2', '{{WRAPPER}} .title-selector',[ 'layout_two' ], '--title-color' );
		konsal_all_elementor_style($this, 'Feedback', '{{WRAPPER}} .feedback-selector',[ 'layout_one', 'layout_six'], '--white-color' );
		konsal_all_elementor_style($this, 'Feedback2', '{{WRAPPER}} .feedback-selector',[ 'layout_two' ], '--body-color' );
		konsal_all_elementor_style($this, 'Designation', '{{WRAPPER}} .desig-selector',[ 'layout_one', 'layout_two' ], '--theme-color' );

        $this->end_controls_section();

		konsal_common_style_fields( $this, 'name3', 'Name', '{{WRAPPER}} .title-selector', [ 'layout_three', 'layout_four', 'layout_five']  );
		konsal_common_style_fields( $this, 'designation3', 'Designation', '{{WRAPPER}} .desig-selector', [ 'layout_three', 'layout_four', 'layout_five']  );
		konsal_common_style_fields( $this, 'feedback3', 'Feedback', '{{WRAPPER}} .feedback-selector', [ 'layout_three', 'layout_four', 'layout_five']  );

       
	}

	protected function render() {

        $settings = $this->get_settings_for_display();

        if( $settings['layout_style'] == 'layout_one' ){
	        echo '<div class="container">';
		        echo '<div class="row justify-content-center">';
			        echo '<div class="col-xl-10">';
        				echo '<div class="slider-area testi-grid-area">';
			                echo '<div class="testi-indicator">'; ?>
			                    <div class="swiper th-slider testi-grid-thumb" data-slider-options='{"effect":"slide","slidesPerView":"5","spaceBetween":13,"loop":true}'>
			                    	<?php
			                        echo '<div class="swiper-wrapper">';
			                            foreach( $settings['1_testimonials'] as $data ) {
				                            echo '<div class="swiper-slide">';
				                            	if( ! empty( $data['client_image']['url'] ) ){
							                        echo '<div class="box-img">';
							                            echo konsal_img_tag( array(
								                            'url'       => esc_url( $data['client_image']['url'] ),
								                        ) );
							                        echo '</div>';
							                    }
				                            echo '</div>';
				                        }
			                        echo '</div>';
			                    echo '</div>';
			                echo '</div>'; ?>
			                <div class="swiper th-slider" id="testiSlide1" data-slider-options='{"effect":"slide","loop":false,"thumbs":{"swiper":".testi-grid-thumb"}}'>
			                	<?php
			                    echo '<div class="swiper-wrapper">';

			                    	foreach( $settings['1_testimonials'] as $data ) {
				                        echo '<div class="swiper-slide">';
				                            echo '<div class="testi-card">';
				                            	if( ! empty( $settings['quote']['url'] ) ){
					                                echo '<div class="quote-icon">';
					                                    echo konsal_img_tag( array(
								                            'url'       => esc_url(  $settings['quote']['url'] ),
								                        ) );
					                                echo '</div>';
					                            }
				                                echo '<div class="testi-card_review">';
				                                	if( $data['client_rating'] == 'one' ){
									                	echo '<i class="fa-sharp fa-solid fa-star"></i>';
									                	echo '<i class="fa-light fa-star-sharp"></i>';
									                	echo '<i class="fa-light fa-star-sharp"></i>';
									                	echo '<i class="fa-light fa-star-sharp"></i>';
									                	echo '<i class="fa-light fa-star-sharp"></i>';
									                }elseif( $data['client_rating'] == 'two' ){
									                	echo '<i class="fa-sharp fa-solid fa-star"></i>';
									                	echo '<i class="fa-sharp fa-solid fa-star"></i>';
									                	echo '<i class="fa-light fa-star-sharp"></i>';
									                	echo '<i class="fa-light fa-star-sharp"></i>';
									                	echo '<i class="fa-light fa-star-sharp"></i>';
									                }elseif( $data['client_rating'] == 'three' ){
									                	echo '<i class="fa-sharp fa-solid fa-star"></i>';
									                	echo '<i class="fa-sharp fa-solid fa-star"></i>';
									                	echo '<i class="fa-sharp fa-solid fa-star"></i>';
									                	echo '<i class="fa-light fa-star-sharp"></i>';
									                	echo '<i class="fa-light fa-star-sharp"></i>';
									                }elseif( $data['client_rating'] == 'four' ){
									                	echo '<i class="fa-sharp fa-solid fa-star"></i>';
									                	echo '<i class="fa-sharp fa-solid fa-star"></i>';
									                	echo '<i class="fa-sharp fa-solid fa-star"></i>';
									                	echo '<i class="fa-sharp fa-solid fa-star"></i>';
									                	echo '<i class="fa-light fa-star-sharp"></i>';
									                }else{
									                	echo '<i class="fa-sharp fa-solid fa-star"></i>';
									                	echo '<i class="fa-sharp fa-solid fa-star"></i>';
									                	echo '<i class="fa-sharp fa-solid fa-star"></i>';
									                	echo '<i class="fa-sharp fa-solid fa-star"></i>';
									                	echo '<i class="fa-sharp fa-solid fa-star"></i>';
									                }
				                                echo '</div>';
				                                if( ! empty( $data['feedback']) ){
					                                echo '<p class="testi-card_text feedback-selector">'.esc_html($data['feedback']).'</p>';
					                            }
				                                echo '<div class="testi-card_profile">';
				                                    echo '<div class="testi-card_content">';
				                                    	if( ! empty( $data['name']) ){
					                                        echo '<h3 class="testi-card_name title-selector">'.esc_html($data['name']).'</h3>';
					                                    }
					                                    if( ! empty( $data['designation']) ){
					                                        echo '<span class="testi-card_desig desig-selector">'.esc_html($data['designation']).'</span>';
					                                    }
				                                    echo '</div>';
				                                echo '</div>';
				                            echo '</div>';
				                        echo '</div>';
				                    }
			                    echo '</div>';
			                    echo '<div class="slider-pagination"></div>';
			                echo '</div>';
			            echo '</div>';
		            echo '</div>';
	            echo '</div>';
            echo '</div>';

	    }elseif( $settings['layout_style'] == 'layout_two' ){
	    	echo '<div class="testi-card-slide">'; ?>
                <div class="swiper th-slider" id="testiSlide2" data-slider-options='{"effect":"slide"}'><?php
                    echo '<div class="swiper-wrapper">';
                        foreach( $settings['1_testimonials'] as $data ) {
	                        echo '<div class="swiper-slide">';
	                            echo '<div class="testi-card-2">';
	                                echo '<div class="media">';
	                                    echo '<div class="media-left">';
	                                        echo '<div class="testi-card_review">';
	                                        	if( $data['client_rating'] == 'one' ){
								                	echo '<i class="fa-sharp fa-solid fa-star"></i>';
								                	echo '<i class="fa-light fa-star-sharp"></i>';
								                	echo '<i class="fa-light fa-star-sharp"></i>';
								                	echo '<i class="fa-light fa-star-sharp"></i>';
								                	echo '<i class="fa-light fa-star-sharp"></i>';
								                }elseif( $data['client_rating'] == 'two' ){
								                	echo '<i class="fa-sharp fa-solid fa-star"></i>';
								                	echo '<i class="fa-sharp fa-solid fa-star"></i>';
								                	echo '<i class="fa-light fa-star-sharp"></i>';
								                	echo '<i class="fa-light fa-star-sharp"></i>';
								                	echo '<i class="fa-light fa-star-sharp"></i>';
								                }elseif( $data['client_rating'] == 'three' ){
								                	echo '<i class="fa-sharp fa-solid fa-star"></i>';
								                	echo '<i class="fa-sharp fa-solid fa-star"></i>';
								                	echo '<i class="fa-sharp fa-solid fa-star"></i>';
								                	echo '<i class="fa-light fa-star-sharp"></i>';
								                	echo '<i class="fa-light fa-star-sharp"></i>';
								                }elseif( $data['client_rating'] == 'four' ){
								                	echo '<i class="fa-sharp fa-solid fa-star"></i>';
								                	echo '<i class="fa-sharp fa-solid fa-star"></i>';
								                	echo '<i class="fa-sharp fa-solid fa-star"></i>';
								                	echo '<i class="fa-sharp fa-solid fa-star"></i>';
								                	echo '<i class="fa-light fa-star-sharp"></i>';
								                }else{
								                	echo '<i class="fa-sharp fa-solid fa-star"></i>';
								                	echo '<i class="fa-sharp fa-solid fa-star"></i>';
								                	echo '<i class="fa-sharp fa-solid fa-star"></i>';
								                	echo '<i class="fa-sharp fa-solid fa-star"></i>';
								                	echo '<i class="fa-sharp fa-solid fa-star"></i>';
								                } 
	                                        echo '</div>';
	                                        echo '<div class="testi-card_profile">';
	                                            echo '<div class="testi-card_content">';
	                                            	if( ! empty( $data['name']) ){
				                                        echo '<h3 class="testi-card_name title-selector">'.esc_html($data['name']).'</h3>';
				                                    }
	                                                if( ! empty( $data['designation']) ){
				                                        echo '<span class="testi-card_desig desig-selector">'.esc_html($data['designation']).'</span>';
				                                    }
	                                            echo '</div>';
	                                        echo '</div>';
	                                    echo '</div>';
	                                    if( ! empty( $settings['quote']['url'] ) ){
			                                echo '<div class="quote-icon">';
			                                    echo konsal_img_tag( array(
						                            'url'       => esc_url(  $settings['quote']['url'] ),
						                        ) );
			                                echo '</div>';
			                            }
	                                echo '</div>';
	                                if( ! empty( $data['feedback']) ){
		                                echo '<p class="testi-card_text feedback-selector">'.esc_html($data['feedback']).'</p>';
		                            }
	                            echo '</div>';
	                        echo '</div>';
	                    }
                    echo '</div>';
                    echo '<div class="slider-pagination"></div>';
                echo '</div>';
            echo '</div>';

	    }elseif( $settings['layout_style'] == 'layout_three' ){
			echo '<div class="slider-area testi-grid-area">';
				echo '<div class="swiper th-slider" id="testiSlide1" data-slider-options=\'{"breakpoints":{"0":{"slidesPerView":1},"576":{"slidesPerView":"1"},"768":{"slidesPerView":"1"},"992":{"slidesPerView":"2"},"1356":{"slidesPerView":"3"}}}\'>';
					echo '<div class="swiper-wrapper">';
					foreach( $settings['1_testimonials'] as $data ) {
						echo '<div class="swiper-slide">';
							echo '<div class="testi-card-3">';
								echo '<div class="testi-card-thumb">';
									echo konsal_img_tag( array(
										'url'       => esc_url( $data['client_image']['url'] ),
									) );
									if( ! empty( $settings['quote']['url'] ) ){
										echo '<div class="quote-icon">';
											echo konsal_img_tag( array(
												'url'       => esc_url(  $settings['quote']['url'] ),
											) );
										echo '</div>';
									}
								echo '</div>';
								echo '<div class="testi-card-details">';
									if( ! empty( $data['feedback']) ){
		                                echo '<p class="testi-card_text feedback-selector">'.esc_html($data['feedback']).'</p>';
		                            }
									echo '<div class="testi-card_profile">';
										echo '<div class="testi-card_content">';
											if( ! empty( $data['name']) ){
												echo '<h3 class="testi-card_name title-selector">'.esc_html($data['name']).'</h3>';
											}
											if( ! empty( $data['designation']) ){
												echo '<span class="testi-card_desig desig-selector">'.esc_html($data['designation']).'</span>';
											}
										echo '</div>';
									echo '</div>';
									echo '<div class="testi-card_review">';
											if( $data['client_rating'] == 'one' ){
												echo '<i class="fa-sharp fa-solid fa-star"></i>';
												echo '<i class="fa-light fa-star-sharp"></i>';
												echo '<i class="fa-light fa-star-sharp"></i>';
												echo '<i class="fa-light fa-star-sharp"></i>';
												echo '<i class="fa-light fa-star-sharp"></i>';
											}elseif( $data['client_rating'] == 'two' ){
												echo '<i class="fa-sharp fa-solid fa-star"></i>';
												echo '<i class="fa-sharp fa-solid fa-star"></i>';
												echo '<i class="fa-light fa-star-sharp"></i>';
												echo '<i class="fa-light fa-star-sharp"></i>';
												echo '<i class="fa-light fa-star-sharp"></i>';
											}elseif( $data['client_rating'] == 'three' ){
												echo '<i class="fa-sharp fa-solid fa-star"></i>';
												echo '<i class="fa-sharp fa-solid fa-star"></i>';
												echo '<i class="fa-sharp fa-solid fa-star"></i>';
												echo '<i class="fa-light fa-star-sharp"></i>';
												echo '<i class="fa-light fa-star-sharp"></i>';
											}elseif( $data['client_rating'] == 'four' ){
												echo '<i class="fa-sharp fa-solid fa-star"></i>';
												echo '<i class="fa-sharp fa-solid fa-star"></i>';
												echo '<i class="fa-sharp fa-solid fa-star"></i>';
												echo '<i class="fa-sharp fa-solid fa-star"></i>';
												echo '<i class="fa-light fa-star-sharp"></i>';
											}else{
												echo '<i class="fa-sharp fa-solid fa-star"></i>';
												echo '<i class="fa-sharp fa-solid fa-star"></i>';
												echo '<i class="fa-sharp fa-solid fa-star"></i>';
												echo '<i class="fa-sharp fa-solid fa-star"></i>';
												echo '<i class="fa-sharp fa-solid fa-star"></i>';
											} 
									echo '</div>';
								echo '</div>';
							echo '</div>';
						echo '</div>';
					}
					echo '</div>';
					echo '<div class="slider-pagination"></div>';
				echo '</div>';
			echo '</div>';

		}elseif( $settings['layout_style'] == 'layout_four' ){
			echo '<div class="slider-area">';
				echo '<div class="swiper th-slider testi-slider4" id="testiSlide4" data-slider-options=\'{"effect":"slide"}\'>';
					echo '<div class="swiper-wrapper">';
					foreach( $settings['1_testimonials'] as $data ) {
						echo '<div class="swiper-slide">';
							echo '<div class="testi-card-4">';
								echo '<div class="quote-icon">';
									if( ! empty( $settings['quote']['url'] ) ){
										echo konsal_img_tag( array(
											'url'       => esc_url( $settings['quote']['url'] ),
										) );
									}
									echo '<div class="testi-card_review">';
										if( $data['client_rating'] == 'one' ){
											echo '<i class="fa-sharp fa-solid fa-star"></i>';
											echo '<i class="fa-light fa-star-sharp"></i>';
											echo '<i class="fa-light fa-star-sharp"></i>';
											echo '<i class="fa-light fa-star-sharp"></i>';
											echo '<i class="fa-light fa-star-sharp"></i>';
										}elseif( $data['client_rating'] == 'two' ){
											echo '<i class="fa-sharp fa-solid fa-star"></i>';
											echo '<i class="fa-sharp fa-solid fa-star"></i>';
											echo '<i class="fa-light fa-star-sharp"></i>';
											echo '<i class="fa-light fa-star-sharp"></i>';
											echo '<i class="fa-light fa-star-sharp"></i>';
										}elseif( $data['client_rating'] == 'three' ){
											echo '<i class="fa-sharp fa-solid fa-star"></i>';
											echo '<i class="fa-sharp fa-solid fa-star"></i>';
											echo '<i class="fa-sharp fa-solid fa-star"></i>';
											echo '<i class="fa-light fa-star-sharp"></i>';
											echo '<i class="fa-light fa-star-sharp"></i>';
										}elseif( $data['client_rating'] == 'four' ){
											echo '<i class="fa-sharp fa-solid fa-star"></i>';
											echo '<i class="fa-sharp fa-solid fa-star"></i>';
											echo '<i class="fa-sharp fa-solid fa-star"></i>';
											echo '<i class="fa-sharp fa-solid fa-star"></i>';
											echo '<i class="fa-light fa-star-sharp"></i>';
										}else{
											echo '<i class="fa-sharp fa-solid fa-star"></i>';
											echo '<i class="fa-sharp fa-solid fa-star"></i>';
											echo '<i class="fa-sharp fa-solid fa-star"></i>';
											echo '<i class="fa-sharp fa-solid fa-star"></i>';
											echo '<i class="fa-sharp fa-solid fa-star"></i>';
										} 
									echo '</div>';
								echo '</div>';
								echo '<div class="testi-card-details">';
									if( ! empty( $data['feedback']) ){
										echo '<p class="testi-card_text feedback-selector">'.esc_html($data['feedback']).'</p>';
									}
									echo '<div class="testi-card_profile">';
										if( ! empty( $data['client_image']['url'] ) ){
											echo '<div class="testi-card-thumb">';
												echo konsal_img_tag( array(
													'url'       => esc_url(  $data['client_image']['url'] ),
												) );
											echo '</div>';
										}
										echo '<div class="testi-card_content">';
											if( ! empty( $data['name']) ){
												echo '<h3 class="testi-card_name title-selector">'.esc_html($data['name']).'</h3>';
											}
											if( ! empty( $data['designation']) ){
												echo '<span class="testi-card_desig desig-selector">'.esc_html($data['designation']).'</span>';
											}
										echo '</div>';
									echo '</div>';
								echo '</div>';
							echo '</div>';
						echo '</div>';
					}
					echo '</div>';
					echo '<div class="slider-pagination"></div>';
				echo '</div>';
			echo '</div>';

		}elseif( $settings['layout_style'] == 'layout_five' ){
			echo '<div class="slider-area">';
				echo '<div class="swiper th-slider testi-slider5" id="testiSlide5" data-slider-options=\'{"breakpoints":{"0":{"slidesPerView":1},"576":{"slidesPerView":"1"},"768":{"slidesPerView":"1"},"992":{"slidesPerView":"1"},"1200":{"slidesPerView":"2"}}}\'>';
					echo '<div class="swiper-wrapper">';
					foreach( $settings['1_testimonials'] as $data ) {
						echo '<div class="swiper-slide">';
							echo '<div class="testi-card-5">';
								echo '<div class="testi-card-details">';
									if( ! empty( $data['feedback']) ){
										echo '<p class="testi-card_text feedback-selector">'.esc_html($data['feedback']).'</p>';
									}
									if( ! empty( $settings['quote']['url'] ) ){
										echo '<div class="quote-icon">';
											echo konsal_img_tag( array(
												'url'       => esc_url( $settings['quote']['url'] ),
											) );
										echo '</div>';
									}
								echo '</div>';
								echo '<div class="testi-card_profile">';
									if( ! empty( $data['client_image']['url'] ) ){
										echo '<div class="testi-card-thumb">';
											echo konsal_img_tag( array(
												'url'       => esc_url(  $data['client_image']['url'] ),
											) );
										echo '</div>';
									}
									echo '<div class="testi-card_content">';
										if( ! empty( $data['name']) ){
											echo '<h3 class="testi-card_name title-selector">'.esc_html($data['name']).'</h3>';
										}
										if( ! empty( $data['designation']) ){
											echo '<span class="testi-card_desig desig-selector">'.esc_html($data['designation']).'</span>';
										}
									echo '</div>';
									echo '<div class="testi-card_review">';
										if( $data['client_rating'] == 'one' ){
											echo '<i class="fa-sharp fa-solid fa-star"></i>';
											echo '<i class="fa-light fa-star-sharp"></i>';
											echo '<i class="fa-light fa-star-sharp"></i>';
											echo '<i class="fa-light fa-star-sharp"></i>';
											echo '<i class="fa-light fa-star-sharp"></i>';
										}elseif( $data['client_rating'] == 'two' ){
											echo '<i class="fa-sharp fa-solid fa-star"></i>';
											echo '<i class="fa-sharp fa-solid fa-star"></i>';
											echo '<i class="fa-light fa-star-sharp"></i>';
											echo '<i class="fa-light fa-star-sharp"></i>';
											echo '<i class="fa-light fa-star-sharp"></i>';
										}elseif( $data['client_rating'] == 'three' ){
											echo '<i class="fa-sharp fa-solid fa-star"></i>';
											echo '<i class="fa-sharp fa-solid fa-star"></i>';
											echo '<i class="fa-sharp fa-solid fa-star"></i>';
											echo '<i class="fa-light fa-star-sharp"></i>';
											echo '<i class="fa-light fa-star-sharp"></i>';
										}elseif( $data['client_rating'] == 'four' ){
											echo '<i class="fa-sharp fa-solid fa-star"></i>';
											echo '<i class="fa-sharp fa-solid fa-star"></i>';
											echo '<i class="fa-sharp fa-solid fa-star"></i>';
											echo '<i class="fa-sharp fa-solid fa-star"></i>';
											echo '<i class="fa-light fa-star-sharp"></i>';
										}else{
											echo '<i class="fa-sharp fa-solid fa-star"></i>';
											echo '<i class="fa-sharp fa-solid fa-star"></i>';
											echo '<i class="fa-sharp fa-solid fa-star"></i>';
											echo '<i class="fa-sharp fa-solid fa-star"></i>';
											echo '<i class="fa-sharp fa-solid fa-star"></i>';
										} 
									echo '</div>';
								echo '</div>';
							echo '</div>';
						echo '</div>';
					}
					echo '</div>';
				echo '</div>';
			echo '</div>';

		}elseif( $settings['layout_style'] == 'layout_six' ){
		echo '<div class="slider-area">';
			echo '<div class="swiper th-slider testi-slider5" id="testiSlide5" data-slider-options=\'{"breakpoints":{"0":{"slidesPerView":1},"576":{"slidesPerView":"1"},"768":{"slidesPerView":"1"},"992":{"slidesPerView":"1"},"1200":{"slidesPerView":"1"}}}\'>';
				echo '<div class="swiper-wrapper">';
				foreach( $settings['6_testimonials'] as $data ) {
					echo '<div class="swiper-slide">';
						echo '<div class="testi-card-6">';
							echo '<div class="testi-card-details">';
								if( ! empty( $settings['quote6']['url'] ) ){
									echo '<div class="quote-icon quote-left">';
										echo konsal_img_tag( array(
											'url'       => esc_url( $settings['quote6']['url'] ),
										) );
									echo '</div>';
								}
								if( ! empty( $data['feedback']) ){
									echo '<p class="testi-card_text feedback-selector">'.esc_html($data['feedback']).'</p>';
								}
								if( ! empty( $settings['quote6']['url'] ) ){
									echo '<div class="quote-icon">';
										echo konsal_img_tag( array(
											'url'       => esc_url( $settings['quote6']['url'] ),
										) );
									echo '</div>';
								}
							echo '</div>';
						echo '</div>';
					echo '</div>';
				}
				echo '</div>';
			echo '</div>';
		echo '</div>';

		}


	}
}