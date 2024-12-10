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
class Konsal_Banner3 extends Widget_Base {

	public function get_name() {
		return 'konsalbanner3';
	}
	public function get_title() {
		return __( 'Banner Hero', 'konsal' );
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

		konsal_select_field( $this, 'layout_style', 'Layout Style', ['Style One', 'Style Two'] ); 


        konsal_media_fields($this, 'bg', 'Choose Background', ['1', '2']);
        konsal_media_fields($this, 'image', 'Choose Image', ['1', '2']);
        konsal_media_fields($this, 'sub_shape', 'Choose Subtitle Shape', ['2']);
        konsal_general_fields($this, 'subtitle', 'Subtitle', 'TEXT', 'The Leading Platform Event' );
		konsal_general_fields($this, 'title', 'Title', 'TEXTAREA', '2024 Global Business' );
		konsal_general_fields($this, 'desc', 'Description', 'TEXTAREA', '', ['1'] );

		konsal_general_fields($this, 'meta', 'Meta Info', 'TEXTAREA', '', ['2'] );

        konsal_switcher_fields( $this, 'show_date', 'Show Countdown?', ['2'] );
        $this->add_control(
			'date', [
				'label' 		=> __( 'Offer End Date With Time', 'konsal' ),
				'type' 			=> Controls_Manager::DATE_TIME,
				'label_block' 	=> true,
                'condition'	=> [
                    'layout_style' => ['2']
                ]
			]
        );
        
		konsal_general_fields($this, 'button_text', 'Button Text', 'TEXTAREA2', 'Get Services');
		konsal_url_fields($this, 'button_url', 'Button URL');
		konsal_general_fields($this, 'button_text2', 'Button Text', 'TEXTAREA2', 'View Details', ['2']);
		konsal_url_fields($this, 'button_url2', 'Button URL', ['2']);
		
        konsal_general_fields($this, 'author_title', 'Author Title', 'TEXTAREA2', 'Guest Speaker', ['2'] );
        konsal_general_fields($this, 'author_name', 'Author Name', 'TEXTAREA2', 'Jhon Smith', ['2'] );

		konsal_switcher_fields( $this, 'show_shape', 'Show All Shape?', ['1', '2'] );

		$this->end_controls_section();

        //---------------------------------------
			//Style Section Start
		//---------------------------------------

		//-------Subtitle/title/description Style-------
		konsal_common_style_fields( $this, 'subtitle2', 'Subtitle', '{{WRAPPER}} .sub' );
		konsal_common_style_fields( $this, 'title2', 'Title', '{{WRAPPER}} .title' );
		konsal_common_style_fields( $this, 'desc2', 'Description', '{{WRAPPER}} .desc', ['1'] );
		konsal_common_style_fields( $this, 'meta2', 'Meta text', '{{WRAPPER}} .hero-meta span', ['2'] );

		konsal_common_style_fields( $this, 'count_num', 'Counter Number', '{{WRAPPER}} .count-number', ['2'] );
		konsal_common_style_fields( $this, 'count_name', 'Counter Name', '{{WRAPPER}} .count-name', ['2'] );
		//------Button Style-------
		konsal_button_style_fields( $this, '11', 'Button Styling', '{{WRAPPER}} .th_btn' );
		konsal_button_style_fields( $this, '12', 'Button 2 Styling', '{{WRAPPER}} .th_btn2', ['2'] );

        // author
        konsal_common_style_fields( $this, 'author1', 'Author Title', '{{WRAPPER}} .img-text', ['2'] );
        konsal_common_style_fields( $this, 'author2', 'Author Name', '{{WRAPPER}} .img-title', ['2'] );

    }

	protected function render() {

    $settings = $this->get_settings_for_display();

		if( $settings['layout_style'] == '1' ){
        echo '<div class="th-hero-wrapper hero-6" id="hero" data-bg-src="'.esc_url( $settings['bg']['url'] ).'">';
            if( $settings['show_shape'] == 'yes' ){
                echo '<div class="shape-mockup hero-shape-6-1 jump d-xxl-block d-none" data-top="14%" data-left="5%">
                    <img src="'.KONSAL_ASSETS.'img/hero_bg_shape6_1.jpg" alt="'.esc_attr__('shape', 'konsal').'">
                </div>
                <div class="shape-mockup hero-shape-6-2 jump-reverse d-xxl-block d-none" data-top="14%" data-right="5%">
                    <img src="'.KONSAL_ASSETS.'img/hero_bg_shape6_2.jpg" alt="'.esc_attr__('shape', 'konsal').'">
                </div>
                <div class="shape-mockup hero-shape-6-3 spin d-xxl-block d-none" data-top="14%" data-left="45%">
                    <img src="'.KONSAL_ASSETS.'img/hero_bg_shape6_3.jpg" alt="'.esc_attr__('shape', 'konsal').'">
                </div>
                <div class="shape-mockup hero-shape-6-4 spin d-xxl-block d-none" data-bottom="5%" data-right="5%">
                    <img src="'.KONSAL_ASSETS.'img/hero_bg_shape6_4.jpg" alt="'.esc_attr__('shape', 'konsal').'">
                </div>
                <div class="shape-mockup hero-shape-6-5 movingX d-xxl-block d-none" data-bottom="15%" data-left="40%">
                    <img src="'.KONSAL_ASSETS.'img/hero_bg_shape6_5.jpg" alt="'.esc_attr__('shape', 'konsal').'">
                </div>';
            }
            echo '<div class="container">';
                echo '<div class="row align-items-center flex-row-reverse">';
                    echo '<div class="col-lg-5">';
                        if( ! empty( $settings['image']['url'] ) ){
                            echo '<div class="hero-img-6">';
                                echo konsal_img_tag( array(
                                    'url'   => esc_url( $settings['image']['url'] ),
                                )); 
                            echo '</div>';
                        }
                    echo '</div>';
                    echo '<div class="col-lg-7">';
                        echo '<div class="hero-style6">';
                            if(!empty($settings['subtitle'])){
                                echo '<span class="sub-title style3 sub">'.esc_html($settings['subtitle']).' <span class="sub-title-triangle1"></span><span class="sub-title-triangle2"></span><span class="sub-title-triangle3"></span></span>';
                            }
                            if(!empty($settings['title'])){
                                echo '<h1 class="hero-title title">'.wp_kses_post($settings['title']).'</h1>';
                            }
                            if( ! empty( $settings['desc'] ) ){
                                echo '<p class="hero-text desc">'.esc_html( $settings['desc'] ).'</p>';
                            }
                            if(!empty($settings['button_text'])){
                                echo '<div class="btn-wrap">';
                                    echo '<a href="'.esc_url( $settings['button_url']['url'] ).'" class="th-btn th_btn">'.esc_html($settings['button_text']).'<div class="icon"><i class="fa-solid fa-arrow-up-right ms-3"></i></div></a>';
                                echo '</div>';
                            }
                        echo '</div>';
                    echo '</div>';

                echo '</div>';
            echo '</div>';
        echo '</div>';
           
		}elseif( $settings['layout_style'] == '2' ){
            $offer_date_end = $settings['date'];
            $replace 	= array('-');
            $with 		= array('/');
    
            $date 	= str_replace( $replace, $with, $offer_date_end );

			echo '<div class="th-hero-wrapper hero-7" id="hero" data-bg-src="'.esc_url( $settings['bg']['url'] ).'">';
                if( $settings['show_shape'] == 'yes' ){
                    echo '<div class="shape-mockup hero-shape-7-1 spin d-xxl-block d-none" data-bottom="0%" data-left="0%">
                        <img src="'.KONSAL_ASSETS.'img/hero_bg_shape7_1.jpg" alt="'.esc_attr__('shape', 'konsal').'">
                    </div>
                    <div class="shape-mockup hero-shape-7-2 jump-reverse d-xxl-block d-none" data-top="20%" data-left="5%">
                        <img src="'.KONSAL_ASSETS.'img/hero_bg_shape7_2.jpg" alt="'.esc_attr__('shape', 'konsal').'">
                    </div>
                    <div class="shape-mockup hero-shape-7-3 spin d-xxl-block d-none" data-top="16%" data-left="50%">
                        <img src="'.KONSAL_ASSETS.'img/hero_bg_shape7_3.jpg" alt="'.esc_attr__('shape', 'konsal').'">
                    </div>
                    <div class="shape-mockup hero-shape-7-4 spin d-xxl-block d-none" data-bottom="13%" data-left="50%">
                        <img src="'.KONSAL_ASSETS.'img/hero_bg_shape7_4.jpg" alt="'.esc_attr__('shape', 'konsal').'">
                    </div>';
                }
                echo '<div class="container">';
                    echo '<div class="row align-items-center">';
                        echo '<div class="col-lg-7">';
                            echo '<div class="hero-style7">';
                                if(!empty($settings['subtitle'])){
                                    echo '<span class="sub-title style4 sub">';
                                        echo konsal_img_tag( array(
                                            'url'   => esc_url( $settings['sub_shape']['url'] ),
                                            'class' => 'logo',
                                        )); 
                                        echo esc_html($settings['subtitle']);
                                    echo '</span>';
                                }
                                if(!empty($settings['title'])){
                                echo '<h1 class="hero-title">';
                                    echo '<span class="title1 title">'.wp_kses_post($settings['title']).'</span>';
                                echo '</h1>';
                                }
                                if(!empty($settings['meta'])){
                                    echo '<div class="hero-meta">';
                                        echo wp_kses_post($settings['meta']);
                                    echo ' </div>';
                                }
                               if($settings['show_date'] == 'yes'){
                                    echo '<ul class="event-counter counter-list cta-countdown" data-offer-date="'.esc_attr($date).'">';
                                        echo '<li>';
                                            echo '<div class="day count-number">00</div>';
                                            echo '<span class="count-name">'.esc_attr__('Days', 'konsal').'</span>';
                                        echo '</li>';
                                        echo '<li>';
                                            echo '<div class="hour count-number">00</div>';
                                            echo '<span class="count-name">'.esc_attr__('Hours', 'konsal').'</span>';
                                        echo '</li>';
                                        echo '<li>';
                                            echo '<div class="minute count-number">00</div>';
                                            echo '<span class="count-name">'.esc_attr__('Minutes', 'konsal').'</span>';
                                        echo '</li>';
                                        echo '<li>';
                                            echo '<div class="seconds count-number">00</div>';
                                            echo '<span class="count-name">'.esc_attr__('Seconds', 'konsal').'</span>';
                                        echo '</li>';
                                    echo '</ul>';
                               }
                                echo '<div class="btn-wrap mt-50">';
                                    if(!empty($settings['button_text'])){
                                        echo '<a href="'.esc_url( $settings['button_url']['url'] ).'" class="th-btn style3 th_btn">'.esc_html($settings['button_text']).'<div class="icon"><i class="fa-solid fa-arrow-up-right ms-3"></i></div></a>';
                                    }
                                    if(!empty($settings['button_text2'])){
                                        echo '<a href="'.esc_url( $settings['button_url2']['url'] ).'" class="th-btn style8 th_btn2">'.esc_html($settings['button_text2']).'<div class="icon"><i class="fa-solid fa-arrow-up-right ms-3"></i></div></a>';
                                    }
                                echo '</div>';
                            echo '</div>';
                        echo '</div>';
                    echo '</div>';
                echo '</div>';
                echo '<div class="hero-img-7">';
                    if( ! empty( $settings['image']['url'] ) ){
                        echo konsal_img_tag( array(
                            'url'   => esc_url( $settings['image']['url'] ),
                        )); 
                    }
                    echo '<div class="img-content">';
                        if(!empty($settings['author_title'])){
                            echo '<p class="img-text">'.esc_html($settings['author_title']).'</p>';
                        }
                        if(!empty($settings['author_name'])){
                            echo '<h4 class="img-title">'.esc_html($settings['author_name']).'</h4>';
                        }
                    echo '</div>';
                echo '</div>';
            echo '</div>';

		}

		
	}

}