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
 * Info Box Box Widget .
 *
 */
class Konsal_Info_Box extends Widget_Base {

	public function get_name() {
		return 'konsalinfobox';
	}
	public function get_title() {
		return __( 'Info Box', 'konsal' );
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
				'label' 	=> __( 'Info Box', 'konsal' ),
				'tab' 		=> Controls_Manager::TAB_CONTENT,
			]
        );
        $this->add_control(
			'layout_style',
			[
				'label' 		=> __( 'Info Box Style', 'konsal' ),
				'type' 			=> Controls_Manager::SELECT,
				'default' 		=> '1',
				'options' 		=> [
					'1'  		=> __( 'Style One', 'konsal' ),
					'2'  		=> __( 'Style Two', 'konsal' ),
				]
			]
		);
		
        konsal_general_fields($this, 'list', 'Lists', 'TEXTAREA', 'The Leading Platform Event', ['1', '2']);
        konsal_media_fields($this, 'icon', 'Choose Icon', ['1', '2']);
        konsal_general_fields($this, 'quote_text', 'Quote Text', 'TEXTAREA2', '“Money is a terrible master but an excellent servant."', ['2']);
        konsal_general_fields($this, 'quote_name', 'Quote Name', 'TEXTAREA2', 'P.T. Barnum', ['2']);

		konsal_general_fields($this, 'title', 'Title', 'TEXTAREA', 'Title', ['1']);
		konsal_general_fields($this, 'desc', 'Description', 'TEXTAREA', '', ['1']);

        konsal_general_fields($this, 'divider', 'Title', 'DIVIDER', '');

        konsal_media_fields($this, 'image1', 'Choose Image', ['1', '2']);
        konsal_general_fields($this, 'title2', 'Title', 'TEXTAREA', '1500', ['1', '2']);
		konsal_general_fields($this, 'desc2', 'Description', 'TEXTAREA', 'Active Reviews', ['1', '2']);
		konsal_general_fields($this, 'button_text', 'Button Text', 'TEXT', 'Read More', ['1', '2']);
		konsal_url_fields($this, 'button_url', 'Button URL', ['1', '2']);

		
        $this->end_controls_section();
       
	}

	protected function render() {

        $settings = $this->get_settings_for_display();

        if( $settings['layout_style'] == '1' ){
            echo '<div class="row gy-40">';
                if(!empty($settings['list'])){
                echo '<div class="col-md-6">';
                    echo '<div class="checklist style3">';
                        echo wp_kses_post($settings['list']);
                    echo '</div>';
                echo '</div>';
                }
                echo '<div class="col-md-6">';
                    echo '<div class="year-counter style2">';
                        if( ! empty( $settings['icon']['url'] ) ){
                            echo '<div class="icon">';
                                echo konsal_img_tag( array(
                                    'url'   => esc_url( $settings['icon']['url'] ),
                                ) );
                            echo '</div>';
                        }
                        if(!empty($settings['title'])){
                            echo '<div class="year-counter_number">'.wp_kses_post($settings['title']).'</div>';
                        }
                        if(!empty($settings['desc'])){
                            echo '<p class="year-counter_text">'.esc_html($settings['desc']).'</p>';
                        }
                    echo '</div>';
                echo '</div>';
            echo '</div>';
            echo '<div class="btn-wrap style2 mt-50">';
                echo '<div class="about-grid style2">';
                    if( ! empty( $settings['image1']['url'] ) ){
                        echo '<div class="thumb">';
                            echo konsal_img_tag( array(
                                'url'   => esc_url( $settings['image1']['url'] ),
                                'class' => 'about-grid_thumb',
                            ) );
                        echo '</div>';
                    }
                    echo '<div class="details">';
                        if(!empty($settings['title2'])){
                            echo '<p class="about-grid_number">'.wp_kses_post($settings['title2']).'</p>';
                        }
                        if(!empty($settings['desc2'])){
                            echo '<p class="about-grid_text">'.esc_html($settings['desc2']).'</p>';
                        }
                    echo '</div>';
                echo '</div>';
                if(!empty($settings['button_text'])){
                    echo '<a href="'.esc_url( $settings['button_url']['url'] ).'" class="th-btn th_btn">'.esc_html($settings['button_text']).'<div class="icon"><i class="fa-solid fa-arrow-up-right ms-3"></i></div></a>';
                }
            echo '</div>';

	    }elseif( $settings['layout_style'] == '2' ){
        echo '<div class="row gy-40 align-items-center">';
            if(!empty($settings['list'])){
                echo '<div class="col-md-6">';
                    echo '<div class="checklist style3">';
                        echo wp_kses_post($settings['list']);
                    echo '</div>';
                echo '</div>';
            }
            echo '<div class="col-md-6">';
                echo '<div class="about-quote-wrap">';
                    if(!empty($settings['quote_text'])){
                        echo '<p>'.esc_html($settings['quote_text']).'</p>';
                    }
                    if(!empty($settings['quote_name'])){
                        echo '<cite>'.esc_html($settings['quote_name']).'</cite>';
                    }
                    if( ! empty( $settings['icon']['url'] ) ){
                        echo '<div class="quote-icon quote-left">';
                            echo konsal_img_tag( array(
                                'url'   => esc_url( $settings['icon']['url'] ),
                            ) );
                        echo '</div>';
                    }
                    if( ! empty( $settings['icon']['url'] ) ){
                        echo '<div class="quote-icon">';
                            echo konsal_img_tag( array(
                                'url'   => esc_url( $settings['icon']['url'] ),
                            ) );
                        echo '</div>';
                    }
                echo '</div>';
            echo '</div>';
        echo '</div>';
        echo '<div class="btn-wrap mt-50">';
            if(!empty($settings['button_text'])){
                echo '<a href="'.esc_url( $settings['button_url']['url'] ).'" class="th-btn th_btn">'.esc_html($settings['button_text']).'<div class="icon"><i class="fa-solid fa-arrow-up-right ms-3"></i></div></a>';
            }
            echo '<div class="about-grid style2">';
                if( ! empty( $settings['image1']['url'] ) ){
                    echo '<div class="thumb">';
                        echo konsal_img_tag( array(
                            'url'   => esc_url( $settings['image1']['url'] ),
                            'class' => 'about-grid_thumb',
                        ) );
                    echo '</div>';
                }
                echo '<div class="details">';
                    if(!empty($settings['title2'])){
                        echo '<p class="about-grid_number">'.wp_kses_post($settings['title2']).'</p>';
                    }
                    if(!empty($settings['desc2'])){
                        echo '<p class="about-grid_text">'.esc_html($settings['desc2']).'</p>';
                    }
                echo '</div>';
            echo '</div>';
        echo '</div>';

	    }

		
	}
}