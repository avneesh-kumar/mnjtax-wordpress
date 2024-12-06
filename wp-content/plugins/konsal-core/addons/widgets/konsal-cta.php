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
 * CTA Widget .
 *
 */
class konsal_Cta extends Widget_Base {

	public function get_name() {
		return 'konsalcta';
	}
	public function get_title() {
		return __( 'CTA', 'konsal' );
	}
	public function get_icon() {
		return 'th-icon';
    }
	public function get_categories() {
		return [ 'konsal' ];
	}

	protected function register_controls() {

		$this->start_controls_section(
			'section_title_section',
			[
				'label'		 	=> __( 'CTA', 'konsal' ),
				'tab' 			=> Controls_Manager::TAB_CONTENT, 
				
			]
        );

		konsal_select_field( $this, 'layout_style', 'Layout Style', [ 'Style One', 'Style Two', 'Style Three' ] );

		konsal_media_fields( $this, 'bg', 'Choose Background', ['1', '3'] );
		konsal_media_fields( $this, 'image1', 'Choose Image', ['1'] );

		konsal_general_fields( $this, 'icon', 'Icon', 'TEXTAREA2', '', ['2'] );

		konsal_general_fields( $this, 'subtitle', 'Subtitle', 'TEXTAREA2', 'Get Consultation', ['1', '2'] );
		konsal_general_fields( $this, 'title', 'Title', 'TEXTAREA2', 'Get A Free Consultation Contact Us', ['1', '2', '3'] );
		konsal_general_fields( $this, 'button_text', 'Button Text', 'TEXT', 'Contact Us', [ '1', '2', '3' ] );
		konsal_url_fields( $this, 'button_url', 'Button URL', [ '1', '2', '3' ] ); 
			
        $this->end_controls_section();

        //---------------------------------------
			//Style Section Start
		//---------------------------------------

		//-------Subtitle Style-------
		konsal_common_style_fields( $this, 'subtitle', 'Subtitle', '{{WRAPPER}} .sub', ['1'] );
		//-------Title Style------- 
		konsal_common_style_fields( $this, 'title', 'Title', '{{WRAPPER}} .title', ['1', '3'] );
		//------Button Style-------
		konsal_button_style_fields($this, '10', 'Button Styling', '{{WRAPPER}} .th_btn', ['1', '2', '3']);

	}

	protected function render() {

	$settings = $this->get_settings_for_display();

		if( $settings['layout_style'] == '1' ){
			echo '<div class="cta-area-3 bg-theme shape-mockup-wrap" data-bg-src="'.esc_url( $settings['bg']['url'] ).'">';
				echo '<div class="container">';
					echo '<div class="cta-wrap">';
						echo '<div class="cta-content">';
							if($settings['subtitle']){
								echo '<div class="cta-subtitle sub">'.wp_kses_post($settings['subtitle']).'</div>';
							}
							if($settings['title']){
								echo '<h4 class="cta-title mt-n2 title">'.wp_kses_post($settings['title']).'</h4>';
							}
						echo '</div>';
						if(!empty($settings['button_text'])){
							echo '<a href="'.esc_url( $settings['button_url']['url'] ).'" class="th-btn style4 th_btn">'.wp_kses_post($settings['button_text']).'<div class="icon"><i class="fas fa-arrow-up-right ms-3"></i></div></a>';
						}
					echo '</div>';
				echo '</div>';
				if( ! empty( $settings['image1']['url'] ) ){
					echo '<div class="cta-thumb shape-mockup d-xxl-block d-none" data-bottom="0" data-right="1%">';
						echo konsal_img_tag( array(
							'url'   => esc_url( $settings['image1']['url'] ),
						) );
					echo '</div>';
				}
			echo '</div>';

		}elseif( $settings['layout_style'] == '2' ){
			echo '<div class="footer-top">';
				echo '<div class="container">';
					echo '<div class="row gy-50 justify-content-between">';
						echo '<div class="col-auto">';
							echo '<div class="cta-link">';
								if($settings['icon']){
									echo '<div class="cta-link-icon">'.wp_kses_post($settings['icon']).'</div>';
								}
								echo '<div>';
									if($settings['subtitle']){
										echo '<p class="sub">'.esc_html($settings['subtitle']).'</p>';
									}
									if($settings['title']){
										echo '<div class="title">'.wp_kses_post($settings['title']).'</div>';
									}
								echo '</div>';
							echo '</div>';
						echo '</div>';
						echo '<div class="col-auto">';
							if(!empty($settings['button_text'])){
								echo '<a href="'.esc_url( $settings['button_url']['url'] ).'" class="th-btn style3 th_btn">'.esc_html($settings['button_text']).'<div class="icon"><i class="fas fa-arrow-up-right ms-3"></i></div></a>';
							}
						echo '</div>';
					echo '</div>';
				echo '</div>';
			echo '</div>';

		}elseif( $settings['layout_style'] == '3' ){
			echo '<div class="faq-img4">';
				echo konsal_img_tag( array(
					'url'   => esc_url( $settings['bg']['url'] ),
				) );
				echo '<div class="faq-thumb-content">';
					if($settings['title']){
						echo '<h4 class="box-title title">'.wp_kses_post($settings['title']).'</h4>';
					}
					if(!empty($settings['button_text'])){
						echo '<a href="'.esc_url( $settings['button_url']['url'] ).'" class="th-btn style3 th_btn">'.wp_kses_post($settings['button_text']).'<div class="icon"><i class="fas fa-arrow-up-right ms-3"></i></div></a>';
					}
				echo '</div>';
			echo '</div>';

		}
		

	}

}