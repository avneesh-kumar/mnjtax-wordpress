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
 * Team Box Widget .
 *
 */
class Konsal_Team extends Widget_Base {

	public function get_name() {
		return 'konsalteam';
	}

	public function get_title() {
		return __( 'Team', 'konsal' );
	}

	public function get_icon() {
		return 'th-icon';
    }

	public function get_categories() {
		return [ 'konsal' ];
	}

	protected function register_controls() {

		$this->start_controls_section(
			'team_section',
			[
				'label' 	=> __( 'Team', 'konsal' ),
				'tab' 		=> Controls_Manager::TAB_CONTENT,
			]
        );

        $this->add_control(
			'layout_style',
			[
				'label' 		=> __( 'Team Style', 'konsal' ),
				'type' 			=> Controls_Manager::SELECT,
				'default' 		=> 'layout_one',
				'options' 		=> [
					'layout_one'  		=> __( 'Style One', 'konsal' ),
					'layout_two'  		=> __( 'Style Two', 'konsal' ),
					'layout_three'  	=> __( 'Style Three', 'konsal' ),
					'layout_four'  		=> __( 'Style Four', 'konsal' ),
					'layout_five'  		=> __( 'Style Five', 'konsal' ),
					'layout_six'  		=> __( 'Style Six', 'konsal' ),
					'layout_seven'  	=> __( 'Style Seven', 'konsal' ),
					'layout_eight'  	=> __( 'Style Eight', 'konsal' ),
					'layout_nine'  	=> __( 'Style Nine', 'konsal' ),
				]
			]
		);

		$this->add_control(
            'title',
            [
                'label'         => __( 'Title', 'konsal' ),
                'type'          => Controls_Manager::TEXT,
                'default'       => __( 'Our Team' , 'konsal' ),
                'label_block'   => true,
				'condition'	=> [
					'layout_style' => ['layout_four']
				]
            ]
        );
		$this->add_control(
			'make_it_slider',
			[
				'label' 		=> __( 'Make It Slider?', 'konsal' ),
				'type' 			=> Controls_Manager::SWITCHER,
				'label_on' 		=> __( 'Yes', 'konsal' ),
				'label_off' 	=> __( 'No', 'konsal' ),
				'return_value' 	=> 'yes',
				'default' 		=> 'yes',
				'condition'	=> [
					'layout_style' => ['layout_one', 'layout_four']
				]
			]
		);
		
        $this->end_controls_section();


	    include konsal_get_elementor_option('team-one-options.php');


        //-----------------------Styling-------------------//


		konsal_common_style_fields( $this, 'sec', 'Section Title', '{{WRAPPER}} .sec-title', [ 'layout_four']  );

		konsal_common2_style_fields( $this, 'title2', 'Name', '{{WRAPPER}} .title', ['layout_one', 'layout_two', 'layout_three', 'layout_four', 'layout_five', 'layout_six', 'layout_eight', 'layout_nine'], '--title-color', '--theme-color'  );
		konsal_common2_style_fields( $this, 'title3', 'Name', '{{WRAPPER}} .title', ['layout_seven'], '--white-color', '--theme-color'  );

		konsal_common_style_fields( $this, 'subtitle2', 'Designation', '{{WRAPPER}} .desig', ['layout_one', 'layout_two', 'layout_three', 'layout_four', 'layout_five', 'layout_six', 'layout_seven', 'layout_eight', 'layout_nine'] );


       
	}

	protected function render() {

        $settings = $this->get_settings_for_display();

        if( $settings['layout_style'] == 'layout_one' || $settings['layout_style'] == 'layout_four' ){
			if( $settings['layout_style'] == 'layout_four' ){
			echo '<div class="row justify-content-between align-items-center">';
				if(!empty($settings['title'])){
				echo '<div class="col-md-auto">';
					echo '<h2 class="sec-title text-center">'.esc_html($settings['title']).'</h2>';
				echo '</div>';
				echo '<div class="col-md d-none d-md-block">';
					echo '<hr class="title-line">';
				echo '</div>';
				}
				echo '<div class="col-md-auto d-none d-md-block">';
					echo '<div class="sec-btn">';
						echo '<div class="icon-box">';
							echo '<button data-slider-prev="#teamSlider1" class="slider-arrow default"><i class="far fa-arrow-left"></i></button>';
							echo '<button data-slider-next="#teamSlider1" class="slider-arrow default"><i class="far fa-arrow-right"></i></button>';
						echo '</div>';
					echo '</div>';
				echo '</div>';
			echo '</div>';
			}

			if($settings['make_it_slider'] == 'yes'){
        	echo '<div class="swiper th-slider has-shadow" id="teamSlider1" data-slider-options=\'{"breakpoints":{"0":{"slidesPerView":1},"576":{"slidesPerView":"1"},"768":{"slidesPerView":"2"},"992":{"slidesPerView":"2"},"1200":{"slidesPerView":"3"}}}\'>';
	        	echo '<div class="swiper-wrapper">';
			}else{
				echo '<div class="row gy-30">';
			}
	            	foreach( $settings['team_members'] as $data ) {
	            		$target = $data['profile_link']['is_external'] ? ' target="_blank"' : '';
						$nofollow = $data['profile_link']['nofollow'] ? ' rel="nofollow"' : '';

						$f_target = $data['fb_link']['is_external'] ? ' target="_blank"' : '';
						$f_nofollow = $data['fb_link']['nofollow'] ? ' rel="nofollow"' : '';

						$t_target = $data['twitter_link']['is_external'] ? ' target="_blank"' : '';
						$t_nofollow = $data['twitter_link']['nofollow'] ? ' rel="nofollow"' : '';

						$l_target = $data['linkedin_link']['is_external'] ? ' target="_blank"' : '';
						$l_nofollow = $data['linkedin_link']['nofollow'] ? ' rel="nofollow"' : '';

						$i_target = $data['instagram_link']['is_external'] ? ' target="_blank"' : '';
						$i_nofollow = $data['instagram_link']['nofollow'] ? ' rel="nofollow"' : '';

						if($settings['make_it_slider'] == 'yes'){
		                	echo '<div class="swiper-slide">';
						}else{
							echo '<div class="col-lg-4 col-md-6">';
						}
		                    echo '<div class="th-team team-card">';
		                        echo '<div class="img-wrap">';
		                        	if( ! empty( $data['team_image']['url'] ) ){
				                        echo '<div class="team-img">';
				                            echo konsal_img_tag( array(
					                            'url'       => esc_url( $data['team_image']['url'] ),
					                        ) );
				                        echo '</div>';
				                    }
				                    echo '<div class="team-social-hover">';
					                    echo '<a href="#" class="team-social-hover_btn"><i class="far fa-plus"></i></a>';
			                            echo '<div class="th-social">';
			                            	if( ! empty( $data['fb_link']['url']) ){
				                                echo '<a '.wp_kses_post( $f_nofollow.$f_target ).' href="'.esc_url( $data['fb_link']['url'] ).'"><i class="fab fa-facebook-f"></i></a>';
				                            }
				                            if( ! empty( $data['twitter_link']['url']) ){
				                                echo '<a '.wp_kses_post( $t_nofollow.$t_target ).' href="'.esc_url( $data['twitter_link']['url'] ).'"><i class="fab fa-twitter"></i></a>';
				                            }
				                            if( ! empty( $data['linkedin_link']['url']) ){
				                                echo '<a '.wp_kses_post( $l_nofollow.$l_target ).' href="'.esc_url( $data['linkedin_link']['url'] ).'"><i class="fab fa-linkedin-in"></i></a>';
				                            }
											if( ! empty( $data['instagram_link']['url']) ){
												echo '<a '.wp_kses_post( $i_nofollow.$i_target ).' href="'.esc_url( $data['instagram_link']['url'] ).'"><i class="fab fa-instagram"></i></a>';
											}
			                            echo '</div>';
		                            echo '</div>';
		                        echo '</div>';
		                        echo '<div class="team-card-content">';
		                        	if( ! empty( $data['name']) ){
				                        echo '<h3 class="box-title title"><a '.wp_kses_post( $nofollow.$target ).' href="'.esc_url( $data['profile_link']['url'] ).'">'.esc_html($data['name']).'</a></h3>';
				                    }
				                    if( ! empty( $data['designation']) ){
				                        echo '<span class="team-desig desig">'.esc_html($data['designation']).'</span>';
				                    }
		                        echo '</div>';
		                    echo '</div>';
		                echo '</div>';
		            }
	            echo '</div>';
				if( $settings['layout_style'] == 'layout_four' ){
				echo '<div class="d-block d-md-none mt-20 text-center">';
					echo '<div class="icon-box">';
						echo '<button data-slider-prev="#teamSlider1" class="slider-arrow default"><i class="far fa-arrow-left"></i></button>';
						echo '<button data-slider-next="#teamSlider1" class="slider-arrow default"><i class="far fa-arrow-right"></i></button>';
					echo '</div>';
				echo '</div>';
				}

            echo '</div>';	

	    }elseif( $settings['layout_style'] == 'layout_two' ){
	    	echo '<div class="slider-area">'; ?>
                <div class="swiper th-slider has-shadow" id="teamSlider2" data-slider-options='{"breakpoints":{"0":{"slidesPerView":1},"576":{"slidesPerView":"1"},"768":{"slidesPerView":"2"},"992":{"slidesPerView":"3"},"1200":{"slidesPerView":"4"}}}'> <?php
                    echo '<div class="swiper-wrapper">';
                        foreach( $settings['team_members'] as $data ) {
		            		$target = $data['profile_link']['is_external'] ? ' target="_blank"' : '';
							$nofollow = $data['profile_link']['nofollow'] ? ' rel="nofollow"' : '';

							$f_target = $data['fb_link']['is_external'] ? ' target="_blank"' : '';
							$f_nofollow = $data['fb_link']['nofollow'] ? ' rel="nofollow"' : '';

							$t_target = $data['twitter_link']['is_external'] ? ' target="_blank"' : '';
							$t_nofollow = $data['twitter_link']['nofollow'] ? ' rel="nofollow"' : '';

							$l_target = $data['linkedin_link']['is_external'] ? ' target="_blank"' : '';
							$l_nofollow = $data['linkedin_link']['nofollow'] ? ' rel="nofollow"' : '';
							
							$i_target = $data['instagram_link']['is_external'] ? ' target="_blank"' : '';
							$i_nofollow = $data['instagram_link']['nofollow'] ? ' rel="nofollow"' : '';

	                        echo '<!-- Single Item -->';
	                        echo '<div class="swiper-slide">';
	                            echo '<div class="th-team team-card style2">';
	                                echo '<div class="img-wrap">';
	                                    if( ! empty( $data['team_image']['url'] ) ){
					                        echo '<div class="team-img">';
					                            echo konsal_img_tag( array(
						                            'url'       => esc_url( $data['team_image']['url'] ),
						                        ) );
					                        echo '</div>';
					                    }
	                                    echo '<div class="th-social">';
	                                        if( ! empty( $data['fb_link']['url']) ){
				                                echo '<a '.wp_kses_post( $f_nofollow.$f_target ).' href="'.esc_url( $data['fb_link']['url'] ).'"><i class="fab fa-facebook-f"></i></a>';
				                            }
				                            if( ! empty( $data['twitter_link']['url']) ){
				                                echo '<a '.wp_kses_post( $t_nofollow.$t_target ).' href="'.esc_url( $data['twitter_link']['url'] ).'"><i class="fab fa-twitter"></i></a>';
				                            }
				                            if( ! empty( $data['linkedin_link']['url']) ){
				                                echo '<a '.wp_kses_post( $l_nofollow.$l_target ).' href="'.esc_url( $data['linkedin_link']['url'] ).'"><i class="fab fa-linkedin-in"></i></a>';
				                            }
											if( ! empty( $data['instagram_link']['url']) ){
												echo '<a '.wp_kses_post( $i_nofollow.$i_target ).' href="'.esc_url( $data['instagram_link']['url'] ).'"><i class="fab fa-instagram"></i></a>';
											}
	                                    echo '</div>';
	                                echo '</div>';
	                                if( ! empty( $settings['team_shape']['url'] ) ){
		                                echo '<div class="team-card-content" data-bg-src="'.esc_url( $settings['team_shape']['url'] ).'">';
		                                    if( ! empty( $data['name']) ){
						                        echo '<h3 class="box-title title"><a '.wp_kses_post( $nofollow.$target ).' href="'.esc_url( $data['profile_link']['url'] ).'">'.esc_html($data['name']).'</a></h3>';
						                    }
		                                    if( ! empty( $data['designation']) ){
						                        echo '<span class="team-desig desig">'.esc_html($data['designation']).'</span>';
						                    }
		                                echo '</div>';
		                            }
	                            echo '</div>';
	                        echo '</div>';
	                    }

                    echo '</div>';
                echo '</div>';
                echo '<button data-slider-prev="#teamSlider2" class="slider-arrow slider-prev"><i class="far fa-arrow-left"></i></button>';
                echo '<button data-slider-next="#teamSlider2" class="slider-arrow slider-next"><i class="far fa-arrow-right"></i></button>';
            echo '</div>';

	    }elseif( $settings['layout_style'] == 'layout_three' ){
			echo '<div class="slider-area">';
				echo '<div class="swiper th-slider has-shadow" id="teamSlider3" data-slider-options=\'{"breakpoints":{"0":{"slidesPerView":1},"576":{"slidesPerView":"1"},"768":{"slidesPerView":"2"},"992":{"slidesPerView":"3"},"1200":{"slidesPerView":"4"}}}\'>';
					echo '<div class="swiper-wrapper">';
						foreach( $settings['team_members'] as $data ) {
							$target = $data['profile_link']['is_external'] ? ' target="_blank"' : '';
							$nofollow = $data['profile_link']['nofollow'] ? ' rel="nofollow"' : '';

							$f_target = $data['fb_link']['is_external'] ? ' target="_blank"' : '';
							$f_nofollow = $data['fb_link']['nofollow'] ? ' rel="nofollow"' : '';

							$t_target = $data['twitter_link']['is_external'] ? ' target="_blank"' : '';
							$t_nofollow = $data['twitter_link']['nofollow'] ? ' rel="nofollow"' : '';

							$l_target = $data['linkedin_link']['is_external'] ? ' target="_blank"' : '';
							$l_nofollow = $data['linkedin_link']['nofollow'] ? ' rel="nofollow"' : '';

							$i_target = $data['instagram_link']['is_external'] ? ' target="_blank"' : '';
							$i_nofollow = $data['instagram_link']['nofollow'] ? ' rel="nofollow"' : '';

							echo '<!-- Single Item -->';
							echo '<div class="swiper-slide">';
								echo '<div class="th-team team-card style3">';
									echo '<div class="img-wrap">';
										if( ! empty( $data['team_image']['url'] ) ){
											echo '<div class="team-img">';
												echo konsal_img_tag( array(
													'url'       => esc_url( $data['team_image']['url'] ),
												) );
											echo '</div>';
										}
									echo '</div>';
									echo '<div class="team-card-content">';
										if( ! empty( $settings['team_shape']['url'] ) ){
											echo '<div class="team-card-bg" data-bg-src="'.esc_url( $settings['team_shape']['url'] ).'"></div>';
										}
										if( ! empty( $data['name']) ){
											echo '<h3 class="box-title title"><a '.wp_kses_post( $nofollow.$target ).' href="'.esc_url( $data['profile_link']['url'] ).'">'.esc_html($data['name']).'</a></h3>';
										}
										if( ! empty( $data['designation']) ){
											echo '<span class="team-desig desig">'.esc_html($data['designation']).'</span>';
										}
										echo '<div class="th-social">';
											if( ! empty( $data['fb_link']['url']) ){
												echo '<a '.wp_kses_post( $f_nofollow.$f_target ).' href="'.esc_url( $data['fb_link']['url'] ).'"><i class="fab fa-facebook-f"></i></a>';
											}
											if( ! empty( $data['twitter_link']['url']) ){
												echo '<a '.wp_kses_post( $t_nofollow.$t_target ).' href="'.esc_url( $data['twitter_link']['url'] ).'"><i class="fab fa-twitter"></i></a>';
											}
											if( ! empty( $data['linkedin_link']['url']) ){
												echo '<a '.wp_kses_post( $l_nofollow.$l_target ).' href="'.esc_url( $data['linkedin_link']['url'] ).'"><i class="fab fa-linkedin-in"></i></a>';
											}
											if( ! empty( $data['instagram_link']['url']) ){
												echo '<a '.wp_kses_post( $i_nofollow.$i_target ).' href="'.esc_url( $data['instagram_link']['url'] ).'"><i class="fab fa-instagram"></i></a>';
											}
										echo '</div>';
									echo '</div>';
								echo '</div>';
							echo '</div>';
						}
					echo '</div>';
				echo '</div>';
			echo '</div>';

		}elseif( $settings['layout_style'] == 'layout_five' ){
			echo '<div class="slider-area">';
				echo '<div class="swiper th-slider" id="teamSlider4" data-slider-options=\'{"breakpoints":{"0":{"slidesPerView":1},"576":{"slidesPerView":"1"},"768":{"slidesPerView":"2"},"992":{"slidesPerView":"3"},"1200":{"slidesPerView":"4"}}}\'>';
					echo '<div class="swiper-wrapper">';
					foreach( $settings['team_members'] as $data ) {
						$target = $data['profile_link']['is_external'] ? ' target="_blank"' : '';
						$nofollow = $data['profile_link']['nofollow'] ? ' rel="nofollow"' : '';

						$f_target = $data['fb_link']['is_external'] ? ' target="_blank"' : '';
						$f_nofollow = $data['fb_link']['nofollow'] ? ' rel="nofollow"' : '';

						$t_target = $data['twitter_link']['is_external'] ? ' target="_blank"' : '';
						$t_nofollow = $data['twitter_link']['nofollow'] ? ' rel="nofollow"' : '';

						$l_target = $data['linkedin_link']['is_external'] ? ' target="_blank"' : '';
						$l_nofollow = $data['linkedin_link']['nofollow'] ? ' rel="nofollow"' : '';

						$i_target = $data['instagram_link']['is_external'] ? ' target="_blank"' : '';
						$i_nofollow = $data['instagram_link']['nofollow'] ? ' rel="nofollow"' : '';
						echo '<div class="swiper-slide">';
							echo '<div class="th-team team-card style4">';
								echo '<div class="img-wrap">';
									if( ! empty( $data['team_image']['url'] ) ){
										echo '<div class="team-img">';
											echo konsal_img_tag( array(
												'url'       => esc_url( $data['team_image']['url'] ),
											) );
										echo '</div>';
									}
									echo '<div class="team-social-hover">';
										echo '<a href="#" class="team-social-hover_btn"><i class="far fa-plus"></i></a>';
										echo '<div class="th-social">';
											if( ! empty( $data['fb_link']['url']) ){
												echo '<a '.wp_kses_post( $f_nofollow.$f_target ).' href="'.esc_url( $data['fb_link']['url'] ).'"><i class="fab fa-facebook-f"></i></a>';
											}
											if( ! empty( $data['twitter_link']['url']) ){
												echo '<a '.wp_kses_post( $t_nofollow.$t_target ).' href="'.esc_url( $data['twitter_link']['url'] ).'"><i class="fab fa-twitter"></i></a>';
											}
											if( ! empty( $data['linkedin_link']['url']) ){
												echo '<a '.wp_kses_post( $l_nofollow.$l_target ).' href="'.esc_url( $data['linkedin_link']['url'] ).'"><i class="fab fa-linkedin-in"></i></a>';
											}
											if( ! empty( $data['instagram_link']['url']) ){
												echo '<a '.wp_kses_post( $i_nofollow.$i_target ).' href="'.esc_url( $data['instagram_link']['url'] ).'"><i class="fab fa-instagram"></i></a>';
											}
										echo '</div>';
									echo '</div>';
								echo '</div>';
								echo '<div class="team-card-content">';
									echo '<div class="team-card-bg" data-bg-src="'.KONSAL_ASSETS.'img/team_card_bg_4.jpg"></div>';
									if( ! empty( $data['name']) ){
										echo '<h3 class="box-title title"><a '.wp_kses_post( $nofollow.$target ).' href="'.esc_url( $data['profile_link']['url'] ).'">'.esc_html($data['name']).'</a></h3>';
									}
									if( ! empty( $data['designation']) ){
										echo '<span class="team-desig desig">'.esc_html($data['designation']).'</span>';
									}
								echo '</div>';
							echo '</div>';
						echo '</div>';
					}
					echo '</div>';
				echo '</div>';
				echo '<button data-slider-prev="#teamSlider4" class="slider-arrow slider-prev"><i class="far fa-arrow-left"></i></button>';
				echo '<button data-slider-next="#teamSlider4" class="slider-arrow slider-next"><i class="far fa-arrow-right"></i></button>';
			echo '</div>';

		}elseif( $settings['layout_style'] == 'layout_six' ){
			echo '<div class="slider-area">';
				echo '<div class="swiper th-slider" id="teamSlider4" data-slider-options=\'{"breakpoints":{"0":{"slidesPerView":1},"576":{"slidesPerView":"1"},"768":{"slidesPerView":"2"},"992":{"slidesPerView":"3"},"1200":{"slidesPerView":"4"}}}\'>';
					echo '<div class="swiper-wrapper">';
					foreach( $settings['team_members'] as $data ) {
						$target = $data['profile_link']['is_external'] ? ' target="_blank"' : '';
						$nofollow = $data['profile_link']['nofollow'] ? ' rel="nofollow"' : '';

						$f_target = $data['fb_link']['is_external'] ? ' target="_blank"' : '';
						$f_nofollow = $data['fb_link']['nofollow'] ? ' rel="nofollow"' : '';

						$t_target = $data['twitter_link']['is_external'] ? ' target="_blank"' : '';
						$t_nofollow = $data['twitter_link']['nofollow'] ? ' rel="nofollow"' : '';

						$l_target = $data['linkedin_link']['is_external'] ? ' target="_blank"' : '';
						$l_nofollow = $data['linkedin_link']['nofollow'] ? ' rel="nofollow"' : '';

						$i_target = $data['instagram_link']['is_external'] ? ' target="_blank"' : '';
						$i_nofollow = $data['instagram_link']['nofollow'] ? ' rel="nofollow"' : '';
						echo '<div class="swiper-slide">';
							echo '<div class="th-team team-card style5">';
								echo '<div class="img-wrap">';
									if( ! empty( $data['team_image']['url'] ) ){
										echo '<div class="team-img">';
											echo konsal_img_tag( array(
												'url'       => esc_url( $data['team_image']['url'] ),
											) );
										echo '</div>';
									}
									echo '<div class="team-social-hover">';
										echo '<a href="#" class="team-social-hover_btn"><i class="far fa-plus"></i></a>';
										echo '<div class="th-social">';
											if( ! empty( $data['fb_link']['url']) ){
												echo '<a '.wp_kses_post( $f_nofollow.$f_target ).' href="'.esc_url( $data['fb_link']['url'] ).'"><i class="fab fa-facebook-f"></i></a>';
											}
											if( ! empty( $data['twitter_link']['url']) ){
												echo '<a '.wp_kses_post( $t_nofollow.$t_target ).' href="'.esc_url( $data['twitter_link']['url'] ).'"><i class="fab fa-twitter"></i></a>';
											}
											if( ! empty( $data['linkedin_link']['url']) ){
												echo '<a '.wp_kses_post( $l_nofollow.$l_target ).' href="'.esc_url( $data['linkedin_link']['url'] ).'"><i class="fab fa-linkedin-in"></i></a>';
											}
											if( ! empty( $data['instagram_link']['url']) ){
												echo '<a '.wp_kses_post( $i_nofollow.$i_target ).' href="'.esc_url( $data['instagram_link']['url'] ).'"><i class="fab fa-instagram"></i></a>';
											}
										echo '</div>';
									echo '</div>';
								echo '</div>';
								echo '<div class="team-card-content">';
									if( ! empty( $data['name']) ){
										echo '<h3 class="box-title title"><a '.wp_kses_post( $nofollow.$target ).' href="'.esc_url( $data['profile_link']['url'] ).'">'.esc_html($data['name']).'</a></h3>';
									}
									if( ! empty( $data['designation']) ){
										echo '<span class="team-desig desig">'.esc_html($data['designation']).'</span>';
									}
								echo '</div>';
							echo '</div>';
						echo '</div>';
					}
					echo '</div>';
				echo '</div>';
				echo '<button data-slider-prev="#teamSlider4" class="slider-arrow slider-prev"><i class="far fa-arrow-left"></i></button>';
				echo '<button data-slider-next="#teamSlider4" class="slider-arrow slider-next"><i class="far fa-arrow-right"></i></button>';
			echo '</div>';

		}elseif( $settings['layout_style'] == 'layout_seven' ){
			echo '<div class="slider-area">';
				echo '<div class="swiper th-slider" id="teamSlider6" data-slider-options=\'{"breakpoints":{"0":{"slidesPerView":1},"576":{"slidesPerView":"1"},"768":{"slidesPerView":"2"},"992":{"slidesPerView":"3"},"1200":{"slidesPerView":"3"}}}\'>';
					echo '<div class="swiper-wrapper">';
						foreach( $settings['team_members'] as $data ) {
							$target = $data['profile_link']['is_external'] ? ' target="_blank"' : '';
							$nofollow = $data['profile_link']['nofollow'] ? ' rel="nofollow"' : '';

							$f_target = $data['fb_link']['is_external'] ? ' target="_blank"' : '';
							$f_nofollow = $data['fb_link']['nofollow'] ? ' rel="nofollow"' : '';

							$t_target = $data['twitter_link']['is_external'] ? ' target="_blank"' : '';
							$t_nofollow = $data['twitter_link']['nofollow'] ? ' rel="nofollow"' : '';

							$l_target = $data['linkedin_link']['is_external'] ? ' target="_blank"' : '';
							$l_nofollow = $data['linkedin_link']['nofollow'] ? ' rel="nofollow"' : '';

							$i_target = $data['instagram_link']['is_external'] ? ' target="_blank"' : '';
							$i_nofollow = $data['instagram_link']['nofollow'] ? ' rel="nofollow"' : '';
							echo '<div class="swiper-slide">';
								echo '<div class="th-team team-card style6">';
									echo '<div class="img-wrap">';
										if( ! empty( $data['team_image']['url'] ) ){
											echo '<div class="team-img">';
												echo konsal_img_tag( array(
													'url'       => esc_url( $data['team_image']['url'] ),
												) );
											echo '</div>';
										}
									echo '</div>';
									echo '<div class="team-card-content">';
										if( ! empty( $data['name']) ){
											echo '<h3 class="box-title title"><a '.wp_kses_post( $nofollow.$target ).' href="'.esc_url( $data['profile_link']['url'] ).'">'.esc_html($data['name']).'</a></h3>';
										}
										if( ! empty( $data['designation']) ){
											echo '<span class="team-desig desig">'.esc_html($data['designation']).'</span>';
										}
										echo '<div class="th-social">';
											if( ! empty( $data['fb_link']['url']) ){
												echo '<a '.wp_kses_post( $f_nofollow.$f_target ).' href="'.esc_url( $data['fb_link']['url'] ).'"><i class="fab fa-facebook-f"></i></a>';
											}
											if( ! empty( $data['twitter_link']['url']) ){
												echo '<a '.wp_kses_post( $t_nofollow.$t_target ).' href="'.esc_url( $data['twitter_link']['url'] ).'"><i class="fab fa-twitter"></i></a>';
											}
											if( ! empty( $data['linkedin_link']['url']) ){
												echo '<a '.wp_kses_post( $l_nofollow.$l_target ).' href="'.esc_url( $data['linkedin_link']['url'] ).'"><i class="fab fa-linkedin-in"></i></a>';
											}
											if( ! empty( $data['instagram_link']['url']) ){
												echo '<a '.wp_kses_post( $i_nofollow.$i_target ).' href="'.esc_url( $data['instagram_link']['url'] ).'"><i class="fab fa-instagram"></i></a>';
											}
										echo '</div>';
									echo '</div>';
								echo '</div>';
							echo '</div>';
						}
					echo '</div>';
				echo '</div>';
				echo '<button data-slider-prev="#teamSlider6" class="slider-arrow slider-prev"><i class="far fa-arrow-left"></i></button>';
				echo '<button data-slider-next="#teamSlider6" class="slider-arrow slider-next"><i class="far fa-arrow-right"></i></button>';
			echo '</div>';

		}elseif( $settings['layout_style'] == 'layout_eight' || $settings['layout_style'] == 'layout_nine' ){
			if( $settings['layout_style'] == 'layout_eight'){
				$style = 'style7';
			}else{
				$style = 'style8';
			}
			echo '<div class="slider-area">';
				echo '<div class="row gy-30 gx-30">';
				foreach( $settings['team_members'] as $data ) {
					$target = $data['profile_link']['is_external'] ? ' target="_blank"' : '';
					$nofollow = $data['profile_link']['nofollow'] ? ' rel="nofollow"' : '';

					$f_target = $data['fb_link']['is_external'] ? ' target="_blank"' : '';
					$f_nofollow = $data['fb_link']['nofollow'] ? ' rel="nofollow"' : '';

					$t_target = $data['twitter_link']['is_external'] ? ' target="_blank"' : '';
					$t_nofollow = $data['twitter_link']['nofollow'] ? ' rel="nofollow"' : '';

					$l_target = $data['linkedin_link']['is_external'] ? ' target="_blank"' : '';
					$l_nofollow = $data['linkedin_link']['nofollow'] ? ' rel="nofollow"' : '';

					$i_target = $data['instagram_link']['is_external'] ? ' target="_blank"' : '';
					$i_nofollow = $data['instagram_link']['nofollow'] ? ' rel="nofollow"' : '';

					echo '<div class="col-lg-4 col-md-6">';
						echo '<div class="th-team team-card '.esc_attr($style).'">';
							echo '<div class="img-wrap">';
								if( ! empty( $data['team_image']['url'] ) ){
									echo '<div class="team-img">';
										echo konsal_img_tag( array(
											'url'       => esc_url( $data['team_image']['url'] ),
										) );
									echo '</div>';
								}
								echo '<div class="th-social">';
									if( ! empty( $data['fb_link']['url']) ){
										echo '<a '.wp_kses_post( $f_nofollow.$f_target ).' href="'.esc_url( $data['fb_link']['url'] ).'"><i class="fab fa-facebook-f"></i></a>';
									}
									if( ! empty( $data['twitter_link']['url']) ){
										echo '<a '.wp_kses_post( $t_nofollow.$t_target ).' href="'.esc_url( $data['twitter_link']['url'] ).'"><i class="fab fa-twitter"></i></a>';
									}
									if( ! empty( $data['linkedin_link']['url']) ){
										echo '<a '.wp_kses_post( $l_nofollow.$l_target ).' href="'.esc_url( $data['linkedin_link']['url'] ).'"><i class="fab fa-linkedin-in"></i></a>';
									}
									if( ! empty( $data['instagram_link']['url']) ){
										echo '<a '.wp_kses_post( $i_nofollow.$i_target ).' href="'.esc_url( $data['instagram_link']['url'] ).'"><i class="fab fa-instagram"></i></a>';
									}
								echo '</div>';
							echo '</div>';
							echo '<div class="team-card-content">';
								if( ! empty( $data['name']) ){
									echo '<h3 class="box-title title"><a '.wp_kses_post( $nofollow.$target ).' href="'.esc_url( $data['profile_link']['url'] ).'">'.esc_html($data['name']).'</a></h3>';
								}
								if( ! empty( $data['designation']) ){
									echo '<span class="team-desig desig">'.esc_html($data['designation']).'</span>';
								}
							echo '</div>';
						echo '</div>';
					echo '</div>';
				}
				echo '</div>';
			echo '</div>';

		}

		
	}
}