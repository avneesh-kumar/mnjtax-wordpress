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
 * Faq Box Widget .
 *
 */
class Konsal_Faq extends Widget_Base {

	public function get_name() {
		return 'konsalfaq';
	}

	public function get_title() {
		return __( 'Faq', 'konsal' );
	}

	public function get_icon() {
		return 'th-icon';
    }

	public function get_categories() {
		return [ 'konsal' ];
	}

	protected function register_controls() {

		$this->start_controls_section(
			'faq_section',
			[
				'label' 	=> __( 'Faq', 'konsal' ),
				'tab' 		=> Controls_Manager::TAB_CONTENT,
			]
        );
		
		konsal_select_field( $this, 'layout_style', 'Layout Style', [ 'Style One', 'Style Two', 'Style Three', 'Style Four' ] );

		konsal_general_fields($this, 'subtitle', 'Subtitle', 'TEXTAREA2', 'Frequently Asked Question', ['3']);
		konsal_general_fields($this, 'title', 'Title', 'TEXTAREA2', 'Konsal Explained: Your FAQ Resource Center', ['3']);
		konsal_media_fields($this, 'bg', 'Choose Background', ['3']);

		konsal_general_fields($this, 'faq_id', 'Faq ID', 'TEXT2', '1' );
		konsal_general_fields($this, 'active_id', 'Active Number', 'NUMBER', '1' );

        $repeater = new Repeater();

		konsal_general_fields($repeater, 'faq_question', 'Faq Question', 'TEXTAREA', 'What Services Do You Offer?');
		konsal_general_fields($repeater, 'faq_answer', 'Faq Answer', 'WYSIWYG', 'Ensuring safety on a construction site is crucial to protect workers');

		$this->add_control(
			'faq_repeater',
			[
				'label' 		=> __( 'Faq Lists', 'konsal' ),
				'type' 			=> Controls_Manager::REPEATER,
				'fields' 		=> $repeater->get_controls(),
				'default' 		=> [
					[
						'faq_question'    => __( 'What Services Do You Offer?', 'konsal' ),
					],
				],
			]
		);

        $this->end_controls_section();

        //---------------------------------------
			//Style Section Start
		//--------------------------------------- 

		konsal_common_style_fields( $this, 'subtitle2', 'Subtitle', '{{WRAPPER}} .sub-title', ['3'] );
		konsal_common_style_fields( $this, 'title2', 'Title', '{{WRAPPER}} .sec-title', ['3'] );

        $this->start_controls_section(
			'faq_styling',
			[
				'label'     => __( 'Faq Styling', 'konsal' ),
				'tab'       => Controls_Manager::TAB_STYLE,
			]
        );

		konsal_general_fields( $this, 'hr', 'Question Style', 'HEADING', '' );
		konsal_color_fields( $this, 'title_color', 'Color', 'color', '{{WRAPPER}} .accordion-button' );
		konsal_typography_fields( $this, 'title_font', 'Trpography', '{{WRAPPER}} .accordion-button' );
		konsal_general_fields( $this, 'hr2', 'Answer Style', 'HEADING', '' );
		konsal_color_fields( $this, 'contnet_color', 'Color', 'color', '{{WRAPPER}} .accordion-body, {{WRAPPER}} p, {{WRAPPER}} .faq-text' );
		konsal_typography_fields( $this, 'contnet_font', 'Trpography', '{{WRAPPER}} .accordion-body, {{WRAPPER}} p, {{WRAPPER}} .faq-text' );

		$this->end_controls_section();

       
	}

	protected function render() {

        $settings = $this->get_settings_for_display();

        if( $settings['layout_style'] == '1' || $settings['layout_style'] == '2' || $settings['layout_style'] == '4' ){
        	echo '<div class="accordion" id="faqAccordion'.esc_attr($settings['faq_id']).'">';
				$x = 0;
				foreach( $settings['faq_repeater'] as $key => $single_data ){
					$unique_id = uniqid();
					$x++;

					$active_id = ($settings['active_id']) ? $settings['active_id'] : '1';

					if( $x == $active_id ){
						$ariaexpanded 	= 'true';
						$class 			= 'show';
						$collesed 		= '';
						$is_active 		= 'active';
					}else{
						$ariaexpanded 	= 'false';
						$class 			= '';
						$collesed 		= 'collapsed';
						$is_active 		= '';
					}

					if( $settings['layout_style'] == '2'){
						$style = 'style2';
					}elseif( $settings['layout_style'] == '4'){
						$style = 'style3';
					}else{
						$style = '';
					}

					echo '<div class="accordion-card '.esc_attr( $is_active . ' ' . $style ).'">';
						echo '<div class="accordion-header" id="collapse-item-'.esc_attr( $unique_id ).'">';
							echo '<button class="accordion-button '.esc_attr( $collesed ).'" type="button" data-bs-toggle="collapse" data-bs-target="#collapse-'.esc_attr( $unique_id ).'" aria-expanded="'.esc_attr( $ariaexpanded ).'" aria-controls="collapse-'.esc_attr( $unique_id ).'">'.wp_kses_post($single_data['faq_question']).'</button>';
						echo '</div>';

						echo '<div id="collapse-'.esc_attr( $unique_id ).'" class="accordion-collapse collapse '.esc_attr( $class ).'" aria-labelledby="collapse-item-'.esc_attr( $unique_id ).'" data-bs-parent="#faqAccordion'.esc_attr($settings['faq_id']).'">';
							echo '<div class="accordion-body">';
								echo '<p class="faq-text">'.esc_html($single_data['faq_answer']).'</p>';
							echo '</div>';
						echo '</div>';
					echo '</div>';
                }
            echo '</div>';

	    }elseif( $settings['layout_style'] == '3' ){
		echo '<div class="space overflow-hidden faq-sec-3">';
			if( ! empty( $settings['bg']['url'] ) ){
				echo '<div class="faq-bg-thumb3 d-lg-block d-none">';
					echo konsal_img_tag( array(
						'url'   => esc_url( $settings['bg']['url'] ),
					) );
				echo '</div>';
			}
			echo '<div class="container">';
				echo '<div class="row justify-content-center justify-content-lg-start">';
					echo '<div class="col-xl-6 col-lg-8">';
						echo '<div class="title-area mb-35">';
							if( !empty( $settings['subtitle'] ) ) {
								echo '<span class="sub-title style3">'.wp_kses_post( $settings['subtitle'] ).' <span class="sub-title-triangle1"></span><span class="sub-title-triangle2"></span><span class="sub-title-triangle3"></span></span>';
							}
							if( ! empty( $settings['title'] ) ) {
								echo '<h2 class="sec-title">'.wp_kses_post( $settings['title'] ).'</h2>';
							}
						echo '</div>';
						echo '<div class="accordion" id="faqAccordion'.esc_attr($settings['faq_id']).'">';
							$x = 0;
							foreach( $settings['faq_repeater'] as $key => $single_data ){
								$unique_id = uniqid();
								$x++;

								$active_id = ($settings['active_id']) ? $settings['active_id'] : '1';

								if( $x == $active_id ){
									$ariaexpanded 	= 'true';
									$class 			= 'show';
									$collesed 		= '';
									$is_active 		= 'active';
								}else{
									$ariaexpanded 	= 'false';
									$class 			= '';
									$collesed 		= 'collapsed';
									$is_active 		= '';
								}

								echo '<div class="accordion-card style3 '.esc_attr( $is_active ).'">';
									echo '<div class="accordion-header" id="collapse-item-'.esc_attr( $unique_id ).'">';
										echo '<button class="accordion-button '.esc_attr( $collesed ).'" type="button" data-bs-toggle="collapse" data-bs-target="#collapse-'.esc_attr( $unique_id ).'" aria-expanded="'.esc_attr( $ariaexpanded ).'" aria-controls="collapse-'.esc_attr( $unique_id ).'">'.wp_kses_post($single_data['faq_question']).'</button>';
									echo '</div>';

									echo '<div id="collapse-'.esc_attr( $unique_id ).'" class="accordion-collapse collapse '.esc_attr( $class ).'" aria-labelledby="collapse-item-'.esc_attr( $unique_id ).'" data-bs-parent="#faqAccordion'.esc_attr($settings['faq_id']).'">';
										echo '<div class="accordion-body">';
											echo '<div class="faq-text">'.wp_kses_post($single_data['faq_answer']).'</div>';
										echo '</div>';
									echo '</div>';
								echo '</div>';
							}
						echo '</div>';
					echo '</div>';
				echo '</div>';
			echo '</div>';
		echo '</div>';

		}


	}
}