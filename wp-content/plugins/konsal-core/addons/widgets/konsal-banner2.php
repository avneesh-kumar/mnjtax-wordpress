<?php
use \Elementor\Widget_Base;
use \Elementor\Controls_Manager;
use \Elementor\Group_Control_Typography;
use \Elementor\Repeater;
use \Elementor\Utils;
use \Elementor\Group_Control_Border;
/**
 *
 * Banner Slider Widget.
 *
 */
class Konsal_Banner2 extends Widget_Base {

	public function get_name() {
		return 'konsalbanner2';
	}
	public function get_title() {
		return __( 'Banner Slider', 'konsal' );
	}
	public function get_icon() {
		return 'th-icon';
    }
	public function get_categories() {
		return [ 'konsal_header_elements' ];
	}

	protected function register_controls() {

		$this->start_controls_section(
			'banner_section',
			[
				'label' 	=> __( 'Banner', 'konsal' ),
				'tab' 		=> Controls_Manager::TAB_CONTENT,
			]
        );

		konsal_select_field( $this, 'layout_style', 'Layout Style', ['Style One', 'Style Two', 'Style Three'] ); 


        konsal_media_fields($this, 'bg', 'Choose Background', ['1']);


		$repeater = new Repeater();

		konsal_media_fields($repeater, 'image', 'Choose Image');
		konsal_media_fields($repeater, 'shape', 'Choose Shape');
		konsal_general_fields($repeater, 'subtitle', 'Subtitle', 'TEXT', 'The Leading Platform Event');
		konsal_general_fields($repeater, 'title', 'Title', 'TEXTAREA', '2024 Global Business');
		konsal_general_fields($repeater, 'desc', 'Description', 'TEXTAREA', '');
		konsal_general_fields($repeater, 'button_text', 'Button Text', 'TEXT', 'Purchase Ticket');
		konsal_url_fields($repeater, 'button_url', 'Button URL');

		$this->add_control(
			'banner_slides',
			[
				'label' 		=> __( 'Banners', 'konsal' ),
				'type' 			=> Controls_Manager::REPEATER,
				'fields' 		=> $repeater->get_controls(),
				'default' 		=> [
					[
						'subtitle' 	=> __( 'The Leading Platform Event', 'konsal' ),
						'title' 	=> __( '2024 Global Business', 'konsal' ),
					],
				],
				'condition'	=> [
					'layout_style' => ['1']
				]
			]
		);

		$repeater = new Repeater();

		konsal_media_fields($repeater, 'bg', 'Choose Background');
		konsal_media_fields($repeater, 'image', 'Choose Image');
		konsal_general_fields($repeater, 'subtitle', 'Subtitle', 'TEXT', 'The Leading Platform Event');
		konsal_general_fields($repeater, 'title', 'Title', 'TEXTAREA', '2024 Global Business');

		konsal_media_fields($repeater, 'client_image', 'Choose Client Image');
		konsal_general_fields($repeater, 'client_title', 'Client Title', 'TEXT', '1500');
		konsal_general_fields($repeater, 'client_desc', 'Client Description', 'TEXTAREA', 'Active Reviews');

		konsal_general_fields($repeater, 'video_text', 'Video Text', 'TEXT', 'Watch The Video');
		konsal_url_fields($repeater, 'video_url', 'Video URL');

		konsal_general_fields($repeater, 'button_text', 'Button Text', 'TEXT', 'Our Services');
		konsal_url_fields($repeater, 'button_url', 'Button URL');
		konsal_general_fields($repeater, 'button_text2', 'Button Text', 'TEXT', 'Get Started');
		konsal_url_fields($repeater, 'button_url2', 'Button URL');

		$this->add_control(
			'banner_slides2',
			[
				'label' 		=> __( 'Banners', 'konsal' ),
				'type' 			=> Controls_Manager::REPEATER,
				'fields' 		=> $repeater->get_controls(),
				'default' 		=> [
					[
						'subtitle' 	=> __( 'The Leading Platform Event', 'konsal' ),
						'title' 	=> __( '2024 Global Business', 'konsal' ),
					],
				],
				'condition'	=> [
					'layout_style' => ['2']
				]
			]
		);

		konsal_media_fields($this, 'shape', 'Choose Shape', ['2', '3']);
		konsal_media_fields($this, 'shape2', 'Choose Shape', ['2']);

		$repeater = new Repeater();

		konsal_media_fields($repeater, 'bg', 'Choose Background');
		konsal_media_fields($repeater, 'image', 'Choose Image');
		konsal_media_fields($repeater, 'shape', 'Choose Subtitle Shape');
		konsal_general_fields($repeater, 'subtitle', 'Subtitle', 'TEXTAREA2', 'The Leading Platform Event');
		konsal_general_fields($repeater, 'title', 'Title', 'TEXTAREA', '2024 Global Business');
		konsal_general_fields($repeater, 'desc', 'Description', 'TEXTAREA', '');
		konsal_general_fields($repeater, 'button_text', 'Button Text', 'TEXT', 'Purchase Ticket');
		konsal_url_fields($repeater, 'button_url', 'Button URL');
		konsal_general_fields($repeater, 'button_text2', 'Button Text', 'TEXT', 'Get Services');
		konsal_url_fields($repeater, 'button_url2', 'Button URL');

		$this->add_control(
			'banner_slides3',
			[
				'label' 		=> __( 'Banners', 'konsal' ),
				'type' 			=> Controls_Manager::REPEATER,
				'fields' 		=> $repeater->get_controls(),
				'default' 		=> [
					[
						'subtitle' 	=> __( 'The Leading Platform Event', 'konsal' ),
						'title' 	=> __( '2024 Global Business', 'konsal' ),
					],
				],
				'condition'	=> [
					'layout_style' => ['3']
				]
			]
		);

		konsal_general_fields($this, 'scroll', 'Scroll ID', 'TEXT', 'about-sec', ['3']);

		$this->end_controls_section();

        //---------------------------------------
			//Style Section Start
		//---------------------------------------

		//-------Subtitle/title/description Style-------
		konsal_common_style_fields( $this, 'subtitle', 'Subtitle', '{{WRAPPER}} .sub' );
		konsal_common_style_fields( $this, 'title', 'Title', '{{WRAPPER}} .title' );
		konsal_common_style_fields( $this, 'desc', 'Description', '{{WRAPPER}} .desc', ['1', '3'] );
		//------Button Style-------
		konsal_button_style_fields( $this, '11', 'Button Styling', '{{WRAPPER}} .th_btn' );
		konsal_button_style_fields( $this, '12', 'Button 2 Styling', '{{WRAPPER}} .th_btn2', ['2', '3'] );

    }

	protected function render() {

    $settings = $this->get_settings_for_display();

		if( $settings['layout_style'] == '1' ){
            echo '<div class="th-hero-wrapper hero-4" id="hero" data-bg-src="'.esc_url( $settings['bg']['url'] ).'">';
                echo '<div class="swiper th-slider" id="heroSlider4" data-slider-options=\'{"effect":"fade"}\'>';
                    echo '<div class="swiper-wrapper">';
                    foreach( $settings['banner_slides'] as $key => $data ){
                        echo '<div class="swiper-slide">';
                            echo '<div class="hero-inner">';
                                if( ! empty( $data['image']['url'] ) ){
                                    echo '<div class="hero-img">';
                                        echo konsal_img_tag( array(
                                            'url'   => esc_url( $data['image']['url'] ),
                                        )); 
                                    echo '</div>';
                                }
                                echo '<div class="container">';
                                    echo '<div class="row justify-content-end">';
                                        echo '<div class="col-lg-6">';
                                            echo '<div class="hero-style4">';
                                                if(!empty($data['subtitle'])){
                                                    echo '<span class="sub-title sub" data-ani="slideinup" data-ani-delay="0.2s">'.wp_kses_post($data['subtitle']).'</span>';
                                                }
                                                if(!empty($data['title'])){
                                                    echo '<h1 class="hero-title title">'.wp_kses_post($data['title']).'</h1>';
                                                }
                                                if(!empty($data['desc'])){
                                                    echo '<p class="hero-text desc" data-ani="slideinup" data-ani-delay="0.6s">'.wp_kses_post($data['desc']).'</p>';
                                                }
                                                if(!empty($data['button_text'])){
                                                    echo '<div class="btn-group" data-ani="slideinup" data-ani-delay="0.7s">';
                                                        echo '<a href="'.esc_url( $data['button_url']['url'] ).'" class="th-btn style3 th_btn">'.wp_kses_post($data['button_text']).'<div class="icon"><i class="fa-solid fa-arrow-up-right ms-3"></i></div></a>';
                                                    echo '</div>';
                                                }
                                            echo '</div>';
                                        echo '</div>';
                                    echo '</div>';
                                echo '</div>';
                                if( ! empty( $data['shape']['url'] ) ){
                                    echo '<div class="hero-shape1">';
                                        echo konsal_img_tag( array(
                                            'url'   => esc_url( $data['shape']['url'] ),
                                        )); 
                                    echo '</div>';
                                }
                            echo '</div>';
                        echo '</div>';
                    }
                    echo '</div>';
                    echo '<div class="icon-box">';
                        echo '<button data-slider-prev="#heroSlider4" class="slider-arrow default"><i class="far fa-arrow-left"></i></button>';
                        echo '<button data-slider-next="#heroSlider4" class="slider-arrow default"><i class="far fa-arrow-right"></i></button>';
                    echo '</div>';
                echo '</div>';
            echo '</div>';
           
		}elseif( $settings['layout_style'] == '2' ){
			echo '<div class="th-hero-wrapper hero-5" id="hero">';
				echo '<div class="swiper th-slider" id="heroSlider5" data-slider-options=\'{"effect":"fade"}\'>';
					echo '<div class="swiper-wrapper">';
					foreach( $settings['banner_slides2'] as $data ){
						echo '<div class="swiper-slide" data-bg-src="'.esc_url( $data['bg']['url'] ).'">';
							echo '<div class="th-hero-shape hero-tweenmax" data-bg-src="'.esc_url( $settings['shape']['url'] ).'"></div>';
							if( ! empty( $settings['shape2']['url'] ) ){
								echo '<div class="hero-shape1 z-index-common">';
									echo konsal_img_tag( array(
										'url'   => esc_url( $settings['shape2']['url'] ),
									)); 
								echo '</div>';
							}
							echo '<div class="hero-inner">';
								echo '<div class="container">';
									echo '<div class="hero-style5">';
										if(!empty($data['subtitle'])){
											echo '<span class="sub-title sub" data-ani="slideinup" data-ani-delay="0.2s">'.wp_kses_post($data['subtitle']).'</span>';
										}
										if(!empty($data['title'])){
											echo '<h1 class="hero-title title">'.wp_kses_post($data['title']).'</h1>';
										}
										echo '<div class="btn-wrap" data-ani="slideinup" data-ani-delay="0.7s">';
											echo '<div class="about-grid style2">';
												if( ! empty( $data['client_image']['url'] ) ){
													echo '<div class="thumb">';
														echo konsal_img_tag( array(
															'url'   => esc_url( $data['client_image']['url'] ),
														)); 
													echo '</div>';
												}
												echo '<div class="details">';
													if(!empty($data['client_title'])){
														echo '<p class="about-grid_number text-white">'.wp_kses_post($data['client_title']).'</p>';
													}
													if(!empty($data['client_desc'])){
														echo '<p class="about-grid_text">'.esc_html($data['client_desc']).'</p>';
													}
												echo '</div>';
											echo '</div>';
											if(!empty($data['video_text'])){
											echo '<a href="'.esc_url( $data['video_url']['url'] ).'" class="style-video popup-video">';
												echo '<div class="play-btn"><i class="fas fa-play"></i></div>';
												echo '<div class="btn-content">';
													echo '<p class="btn-title">'.esc_html($data['video_text']).'</p>';
												echo '</div>';
											echo '</a>';
											}
										echo '</div>';
										echo '<div class="btn-wrap mt-50" data-ani="slideinup" data-ani-delay="0.8s">';
											if(!empty($data['button_text'])){
												echo '<a href="'.esc_url( $data['button_url']['url'] ).'" class="th-btn style3 th_btn">'.esc_html($data['button_text']).'<div class="icon"><i class="fa-solid fa-arrow-up-right ms-3"></i></div></a>';
											}
											if(!empty($data['button_text2'])){
												echo '<a href="'.esc_url( $data['button_url2']['url'] ).'" class="th-btn style2 th_btn2">'.esc_html($data['button_text2']).'<div class="icon"><i class="fa-solid fa-arrow-up-right ms-3"></i></div></a>';
											}
										echo '</div>';
									echo '</div>';
								echo '</div>';
								if( ! empty( $data['image']['url'] ) ){
									echo '<div class="hero-img-4 z-index-common">';
										echo konsal_img_tag( array(
											'url'   => esc_url( $data['image']['url'] ),
										)); 
									echo '</div>';
								}
							echo '</div>';
						echo '</div>';
					}
					echo '</div>';
					echo '<div class="slider-pagination"></div>';
					echo '<div class="icon-box">';
						echo '<button data-slider-prev="#heroSlider5" class="slider-arrow default"><i class="far fa-arrow-left"></i></button>';
						echo '<button data-slider-next="#heroSlider5" class="slider-arrow default"><i class="far fa-arrow-right"></i></button>';
					echo '</div>';
				echo '</div>';
			echo '</div>';

		}elseif( $settings['layout_style'] == '3' ){
		echo '<div class="th-hero-wrapper hero-8" id="hero">';
			echo '<div class="swiper th-slider" id="heroSlider8" data-slider-options=\'{"effect":"fade", "autoHeight": "true"}\'>';
				echo '<div class="swiper-wrapper">';
				foreach( $settings['banner_slides3'] as $key => $data ){
					echo '<div class="swiper-slide" data-bg-src="'.esc_url( $data['bg']['url'] ).'" data-overlay="black" data-opacity="8">';
						echo '<div class="hero-bg-shape8-1" data-bg-src="'.esc_url( $settings['shape']['url'] ).'"></div>';
						echo '<div class="hero-inner">';
							echo '<div class="container">';
								echo '<div class="hero-style8 z-index-common">';
									if(!empty($data['subtitle'])){
										echo '<span class="sub-title style4 sub" data-ani="slideinup" data-ani-delay="0.2s">';
											echo konsal_img_tag( array(
												'url'   => esc_url( $data['shape']['url'] ),
												'class' => 'logo',
											)); 
											echo esc_html($data['subtitle']);
										echo '</span>';
									}
									if(!empty($data['title'])){
										echo '<h1 class="hero-title title">'.wp_kses_post($data['title']).'</h1>';
									}
									if(!empty($data['desc'])){
										echo '<p class="hero-text desc" data-ani="slideinup" data-ani-delay="0.6s">'.esc_html($data['desc']).'</p>';
									}
									echo '<div class="btn-group" data-ani="slideinup" data-ani-delay="0.7s">';
										if(!empty($data['button_text'])){
											echo '<a href="'.esc_url( $data['button_url']['url'] ).'" class="th-btn style3 th_btn">'.esc_html($data['button_text']).'<div class="icon"><i class="fa-solid fa-arrow-up-right ms-3"></i></div></a>';
										}
										if(!empty($data['button_text2'])){
											echo '<a href="'.esc_url( $data['button_url2']['url'] ).'" class="th-btn style2 th_btn2">'.esc_html($data['button_text2']).'<div class="icon"><i class="fa-solid fa-arrow-up-right ms-3"></i></div></a>';
										}
									echo '</div>';
								echo '</div>';
							echo '</div>';
							if( ! empty( $data['image']['url'] ) ){
								echo '<div class="hero-img-8 z-index-common" data-ani="slidebottomright" data-ani-delay="0.1s">';
									echo konsal_img_tag( array(
										'url'   => esc_url( $data['image']['url'] ),
									)); 
								echo '</div>';
							}
						echo '</div>';
					echo '</div>';
				}
				echo '</div>';
				echo '<div class="slider-pagination"></div>';
			echo '</div>';
			if(!empty($settings['scroll'])){
			echo '<div class="scroll-down">';
				echo '<a href="#'.esc_attr($settings['scroll']).'" class="hero-8-scroll-wrap"><i class="far fa-arrow-down"></i></a>';
			echo '</div>';
			}
		echo '</div>';

		}

		
	}

}