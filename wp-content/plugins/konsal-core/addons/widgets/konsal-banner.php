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
 * Banner Box Widget .
 *
 */
class Konsal_Banner extends Widget_Base {

	public function get_name() {
		return 'konsalbanner';
	}

	public function get_title() {
		return __( 'Konsal Banner', 'konsal' );
	}

	public function get_icon() {
		return 'th-icon';
    }

	public function get_categories() {
		return [ 'konsal' ];
	}

	protected function register_controls() {

		$this->start_controls_section(
			'banner_section',
			[
				'label' 	=> __( 'Banner', 'konsal' ),
				'tab' 		=> Controls_Manager::TAB_CONTENT,
			]
        );
        $this->add_control(
			'layout_style',
			[
				'label' 		=> __( 'Banner Style', 'konsal' ),
				'type' 			=> Controls_Manager::SELECT,
				'default' 		=> 'layout_one',
				'options' 		=> [
					'layout_one'  		=> __( 'Style One', 'konsal' ),
					'layout_two'  		=> __( 'Style Two', 'konsal' ),
					'layout_three'  	=> __( 'Style Three', 'konsal' ),
				]
			]
		);
		
        $this->end_controls_section(); 

	    include konsal_get_elementor_option('banner-one-options.php');
	    include konsal_get_elementor_option('banner-two-options.php');
	    include konsal_get_elementor_option('banner-three-options.php');

        //-------------------------------------title styling-------------------------------------//

        $this->start_controls_section(
			'section_title_style_section',
			[
				'label' => __( 'Style', 'konsal' ),
				'tab' 	=> Controls_Manager::TAB_STYLE,
			]
		);

		konsal_all_elementor_style($this, 'Subtitle', '{{WRAPPER}} .banner-subtitle',['layout_one', 'layout_two', 'layout_three'], '--theme-color' );
		konsal_all_elementor_style($this, 'Title', '{{WRAPPER}} .banner-title',['layout_one', 'layout_two', 'layout_three'], '--white-color' );
		konsal_all_elementor_style($this, 'Description', '{{WRAPPER}} .banner-desc',['layout_one', 'layout_two', 'layout_three'], '--white-color' );

        $this->end_controls_section();

		//---------Button Style---------//
		konsal_button_style_fields( $this, '1', 'Button Style', '{{WRAPPER}} .th-btn', ['layout_one', 'layout_two', 'layout_three'] );
       
	}

	protected function render() {

        $settings = $this->get_settings_for_display();

        if( $settings['layout_style'] == 'layout_one' ){
        	echo '<div class="th-hero-wrapper hero-1" id="hero">';
		        echo '<div class="th-hero-bg" data-bg-src="'.esc_url($settings['bg']['url'] ).'">';
		            echo '<img src="'.esc_url($settings['overlay']['url'] ).'" alt="img">';
		        echo '</div>';

		        echo '<div class="th-hero-shape hero-tweenmax" data-bg-src="'.esc_url($settings['shape']['url'] ).'"></div>';
		        echo '<div class="container">';
		            echo '<div class="row align-items-center justify-content-center flex-row-reverse">';
		                echo '<div class="col-lg-6 col-md-8">';
		                    echo '<div class="hero-1-img text-lg-end">';
		                        echo '<div class="thumb" data-bg-src="'.esc_url($settings['thumb1']['url'] ).'">';
		                            echo '<img src="'.esc_url($settings['thumb2']['url'] ).'" alt="shape">';
		                        echo '</div>';
		                    echo '</div>';
		                echo '</div>';
		                echo '<div class="col-lg-6">';
		                    echo '<div class="hero-style1">';
		                        echo '<span class="sub-title banner-subtitle"><img class="me-2" src="'.esc_url($settings['subtitle_img']['url'] ).'" alt="img">'.esc_html($settings['subtitle']).'</span>';
		                        echo '<h1 class="hero-title banner-title text-white">'.esc_html($settings['title']).'</h1>';
		                        echo '<p class="hero-text banner-desc text-white">'.esc_html($settings['desc']).'</p>';
		                        echo '<div class="btn-wrap">';
		                            echo '<a href="'.esc_url($settings['button_link']).'" class="th-btn th_btn style3">'.esc_html($settings['button_text']).'<div class="icon"><i class="fa-solid fa-arrow-up-right ms-3"></i></div></a>';
		                            echo '<a href="'.esc_url($settings['vdo_url']).'" class="style-video popup-video">';
		                                echo '<div class="play-btn"><i class="fas fa-play"></i></div>';
		                                echo '<div class="btn-content"><p class="btn-title">'.esc_html($settings['vdo_text']).'</p></div>';
		                            echo '</a>';
		                        echo '</div>';
		                    echo '</div>';
		                echo '</div>';

		            echo '</div>';
		        echo '</div>';
		    echo '</div>';

	    }elseif( $settings['layout_style'] == 'layout_two' ){
	    	echo '<div class="th-hero-wrapper hero-2" id="hero">'; ?>
		        <div class="swiper th-slider" id="heroSlider2" data-slider-options='{"effect":"fade"}'> <?php
		            echo '<div class="swiper-wrapper">';
		               foreach( $settings['banners2'] as $data ) {    
			                echo '<div class="swiper-slide" data-bg-src="'.esc_url( $data['bg']['url'] ).'" data-overlay="black" data-opacity="9">';
			                    echo '<div class="hero-inner">';
			                        echo '<div class="container">';
			                            echo '<div class="hero-style2">';
			                            	if( ! empty( $data['heading'] ) ){
				                                echo '<span class="sub-title heading-selector banner-subtitle" data-ani="slideinup" data-ani-delay="0.2s">'.esc_html( $data['heading'] ).'</span>';
				                            }
			                                echo '<h1 class="hero-title banner-title">';
			                                	if( ! empty( $data['title1'] ) ){
				                                    echo '<span class="title1" data-ani="slideinup" data-ani-delay="0.4s">'.esc_html( $data['title1'] ).'</span>';
				                                }
				                                if( ! empty( $data['title2'] ) ){
				                                    echo '<span class="title2" data-ani="slideinup" data-ani-delay="0.5s">'.esc_html( $data['title2'] ).'</span>';
				                                }
			                                echo '</h1>';

			                                if( ! empty( $data['desc'] ) ){
				                                echo '<p class="hero-text text-white banner-desc" data-ani="slideinup" data-ani-delay="0.6s">'.esc_html( $data['desc'] ).'</p>';
				                            }
				                            if( !empty( $data['button_link'] ) ){
				                                echo '<div class="btn-group" data-ani="slideinup" data-ani-delay="0.7s">';
				                                    echo '<a href="'.esc_url($data['button_link']).'" class="th-btn style3">'.esc_html($data['button_text']).' <div class="icon"><i class="fa-solid fa-arrow-up-right ms-3"></i></div></a>';
				                                    echo '<div class="arrow"><img src="'.esc_url( $settings['arrow_shape']['url'] ).'" alt="Icon"></div>';
				                                echo '</div>';
				                            }
			                            echo '</div>';
			                        echo '</div>';
			                        if( ! empty( $data['image']['url'] ) ){
				                        echo '<div class="hero-img z-index-common" data-ani="slidebottomright" data-ani-delay="0.1s">';
				                            echo konsal_img_tag( array(
												'url'   => esc_url( $data['image']['url'] ),
											) );
				                        echo '</div>';
				                    }
			                    echo '</div>';
			                echo '</div>';
			            }
		                
		            echo '</div>';
		            echo '<div class="slider-pagination"></div>';
		        echo '</div>';
		        if( ! empty( $settings['shape1']['url'] ) ){
			        echo '<div class="hero-shape1 z-index-common">';
			            echo konsal_img_tag( array(
							'url'   => esc_url( $settings['shape1']['url'] ),
						) );
			        echo '</div>';
			    }
			    if( ! empty( $settings['shape2']['url'] ) ){
			        echo '<div class="hero-shape2 z-index-common">';
			            echo konsal_img_tag( array(
							'url'   => esc_url( $settings['shape2']['url'] ),
						) );
			        echo '</div>';
			    }
		    echo '</div>';

	    }else{
	    	 echo '<div class="th-hero-wrapper hero-3" id="hero">'; ?>
		        <div class="swiper th-slider" id="heroSlider3" data-slider-options='{"effect":"fade"}'> <?php
		            echo '<div class="swiper-wrapper">';
		            	foreach( $settings['banners3'] as $data ) {   
			                echo '<div class="swiper-slide" data-bg-src="'.esc_url( $data['1_image']['url'] ).'" data-overlay="black" data-opacity="9">';
			                    echo '<div class="hero-inner">';
			                        echo '<div class="container">';
			                            echo '<div class="hero-style3">';
			                                echo '<span class="sub-title banner-subtitle heading-selector" data-ani="slideinup" data-ani-delay="0.2s">'.esc_html( $data['1_heading'] ).'</span>';
			                                echo '<h1 class="hero-title banner-title">';
			                                    echo '<span class="title1" data-ani="slideinup" data-ani-delay="0.4s">'.esc_html( $data['1_title1'] ).'</span>';
			                                    echo '<span class="title2" data-ani="slideinup" data-ani-delay="0.5s">'.esc_html( $data['1_title1'] ).'</span>';
			                                echo '</h1>';
			                                echo '<p class="hero-text text-white banner-desc" data-ani="slideinup" data-ani-delay="0.6s">'.esc_html( $data['1_desc'] ).'</p>';
			                                echo '<div class="btn-group" data-ani="slideinup" data-ani-delay="0.7s">';
			                                    echo '<a href="'.esc_url($data['1_button_link']).'" class="th-btn style3">'.esc_html($data['1_button_text']).'<div class="icon"><i class="fa-solid fa-arrow-up-right ms-3"></i></div></a>';
			                                echo '</div>';
			                            echo '</div>';
			                        echo '</div>';
			                        echo '<div class="hero-img">';
			                            echo '<img src="'.esc_url( $data['2_image']['url'] ).'" alt="Image">';
			                        echo '</div>';
			                        echo '<div class="hero-shape1 bg-theme" data-bg-src="'.esc_url( $data['3_image']['url'] ).'"></div>';
			                    echo '</div>';
			                echo '</div>';
			            }
		                
		                
		            echo '</div>';
		            echo '<div class="slider-pagination"></div>';
		        echo '</div>';
		    echo '</div>';

	    }
		

	}
}