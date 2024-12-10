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
 * Contact Form Box Widget .
 *
 */
class Konsal_Contact_Form extends Widget_Base {

	public function get_name() {
		return 'konsalcontactform';
	}

	public function get_title() {
		return __( 'Contact Form', 'konsal' );
	}

	public function get_icon() {
		return 'th-icon';
    }

	public function get_categories() {
		return [ 'konsal' ];
	}

	public function get_as_contact_form(){
        if ( ! class_exists( 'WPCF7' ) ) {
            return;
        }
        $as_cfa         = array();
        $as_cf_args     = array( 'posts_per_page' => -1, 'post_type'=> 'wpcf7_contact_form' );
        $as_forms       = get_posts( $as_cf_args );
        $as_cfa         = ['0' => esc_html__( 'Select Form', 'konsal' ) ];
        if( $as_forms ){
            foreach ( $as_forms as $as_form ){
                $as_cfa[$as_form->ID] = $as_form->post_title;
            }
        }else{
            $as_cfa[ esc_html__( 'No contact form found', 'konsal' ) ] = 0;
        }
        return $as_cfa;
    }

	protected function register_controls() {

		$this->start_controls_section(
			'teamd_section',
			[
				'label' 	=> __( 'Contact Form', 'konsal' ),
				'tab' 		=> Controls_Manager::TAB_CONTENT,
			]
        );

        $this->add_control(
			'layout_style',
			[
				'label' 		=> __( 'Contact Form Style', 'konsal' ),
				'type' 			=> Controls_Manager::SELECT,
				'default' 		=> 'layout_one',
				'options' 		=> [
					'layout_one'  	=> __( 'Style One', 'konsal' ),
					'layout_two'  	=> __( 'Style Two', 'konsal' ),
					'layout_three'  => __( 'Style Three', 'konsal' ),
					'layout_four'  	=> __( 'Style Four', 'konsal' ),
					'layout_five'  	=> __( 'Style Five', 'konsal' ),
					'layout_six'  	=> __( 'Style Six', 'konsal' ),
				]
			]
		);
		
        $this->end_controls_section();

	    include konsal_get_elementor_option('contactform-options.php');
	    include konsal_get_elementor_option('contactform-two-options.php');
	    include konsal_get_elementor_option('contactform-six-options.php');

		//---------------------------------------
			//Style Section Start
		//---------------------------------------

        //---------Title Style---------//
        konsal_common_style_fields($this, 'sub22', 'Subtitle', '{{WRAPPER}} .sub ', ['layout_six']);
        konsal_common_style_fields($this, 'title22', 'Title', '{{WRAPPER}} .title ', ['layout_two', 'layout_three', 'layout_four', 'layout_five', 'layout_six']);
        konsal_common_style_fields($this, 'desc22', 'Description', '{{WRAPPER}} .desc ', ['layout_six']);
        //---------Button Style---------//
		konsal_button_style_fields( $this, '1', 'Button Style', '{{WRAPPER}} .th-btn', ['layout_one', 'layout_two', 'layout_three'] );

	}

	protected function render() {

        $settings = $this->get_settings_for_display();

        if( $settings['layout_style'] == 'layout_one' ){
            if( !empty($settings['konsal_select_contact_form']) ){
				echo do_shortcode( '[contact-form-7  id="'.$settings['konsal_select_contact_form'].'"]' ); 
			}else{
				echo '<div class="alert alert-warning"><p class="m-0">' . __('Please Select contact form.', 'konsal' ). '</p></div>';
			}

	    }elseif( $settings['layout_style'] == 'layout_two' ){
			echo '<div class="contact-form-v1 bg-smoke" data-bg-src="'.esc_url( $settings['image']['url'] ).'">';
				if(!empty($settings['title'])){
					echo '<h3 class="fs-40 mb-30 mt-n2 title">'.esc_html($settings['title']).'</h3>';
				}
				echo '<div class="contact-form ajax-contact">';
					if( !empty($settings['konsal_select_contact_form']) ){
						echo do_shortcode( '[contact-form-7  id="'.$settings['konsal_select_contact_form'].'"]' ); 
					}else{
						echo '<div class="alert alert-warning"><p class="m-0">' . __('Please Select contact form.', 'konsal' ). '</p></div>';
					}
				echo '</div>';
			echo '</div>';

		}elseif( $settings['layout_style'] == 'layout_three' ){
			echo '<div class="contact-form-v2 bg-smoke" data-bg-src="'.esc_url( $settings['image']['url'] ).'">';
				if(!empty($settings['title'])){
					echo '<h3 class="title mt-n2 text-center">'.esc_html($settings['title']).'</h3>';
				}
				echo '<div class="contact-form ajax-contact">';
					if( !empty($settings['konsal_select_contact_form']) ){
						echo do_shortcode( '[contact-form-7  id="'.$settings['konsal_select_contact_form'].'"]' ); 
					}else{
						echo '<div class="alert alert-warning"><p class="m-0">' . __('Please Select contact form.', 'konsal' ). '</p></div>';
					}
				echo '</div>';
			echo '</div>';

		}elseif( $settings['layout_style'] == 'layout_four' ){
			echo '<div class="contact-form-wrap3">';
				echo '<div class="ajax-contact contact-form">';
					if(!empty($settings['2title'])){
						echo '<h2 class="sec-title title">'.esc_html($settings['2title']).'</h2>';
					}
					if( !empty($settings['2konsal_select_contact_form']) ){
						echo do_shortcode( '[contact-form-7  id="'.$settings['2konsal_select_contact_form'].'"]' ); 
					}else{
						echo '<div class="alert alert-warning"><p class="m-0">' . __('Please Select contact form.', 'konsal' ). '</p></div>';
					}
				echo '</div>';
				echo '<div class="contact-feature-wrap">'; 
					foreach( $settings['contacts'] as $data ) {
						echo '<div class="contact-feature2">';
							if( ! empty( $data['title'] ) ){
								echo '<h3 class="box-title h5 text-white">'.esc_html( $data['title'] ).'</h3>';
							}
							echo '<p class="box-text text-theme">';
								echo wp_kses_post( $data['icon'] );
								echo wp_kses_post( $data['content'] );
							echo '</p>';
						echo '</div>';
					}
					if(!empty( $settings['show_social'])){
						echo '<div class="th-social style5">';
							foreach( $settings['social_lists'] as $social_icon ){
								$social_target    = $social_icon['icon_link']['is_external'] ? ' target="_blank"' : '';
								$social_nofollow  = $social_icon['icon_link']['nofollow'] ? ' rel="nofollow"' : '';

								echo '<a '.wp_kses_post( $social_target.$social_nofollow ).' href="'.esc_url( $social_icon['icon_link']['url'] ).'">';

								\Elementor\Icons_Manager::render_icon( $social_icon['social_icon'], [ 'aria-hidden' => 'true' ] );
			
								echo '</a> ';
							}
						echo '</div>';
					}
				echo '</div>';
			echo '</div>';

		}elseif( $settings['layout_style'] == 'layout_five' ){
			echo '<div class="contact-form-v3 bg-white">';
				if(!empty($settings['title'])){
					echo '<h3 class="title mt-n2 mb-45">'.esc_html($settings['title']).'</h3>';
				}
				echo '<div class="contact-form ajax-contact">';
					if( !empty($settings['konsal_select_contact_form']) ){
						echo do_shortcode( '[contact-form-7  id="'.$settings['konsal_select_contact_form'].'"]' ); 
					}else{
						echo '<div class="alert alert-warning"><p class="m-0">' . __('Please Select contact form.', 'konsal' ). '</p></div>';
					}
				echo '</div>';
			echo '</div>';

		}elseif( $settings['layout_style'] == 'layout_six' ){
			echo '<div class="contact-wrap-4">';
				echo '<div class="row gx-60 gy-40 justify-content-center align-items-center">';
					echo '<div class="col-xl-5">';
						echo '<div class="contact-title-wrap" data-bg-src="'.esc_url( $settings['6bg']['url'] ).'" data-overlay="theme2" data-opacity="8">';
							echo '<div class="title-area mb-20">';
								if(!empty($settings['6subtitle'])){
									echo '<span class="sub-title style4 bg-theme sub">';
										echo konsal_img_tag( array(
											'url'   => esc_url( $settings['6shape']['url'] ),
											'class' => 'logo',
										)); 
										echo esc_html($settings['6subtitle']);
									echo '</span>';
								}
								if(!empty($settings['6title'])){
									echo '<h4 class="sec-title fw-semibold title mt-n2 mb-45">'.esc_html($settings['6title']).'</h4>';
								}
							echo '</div>';
							if( ! empty( $settings['6desc'] ) ){
								echo '<p class=" mt-n2 mb-35 desc">'.esc_html( $settings['6desc'] ).'</p>';
							}
							echo '<div class="cta-link">';
									if(!empty($settings['6icon']['url'])){
										echo '<div class="cta-link-icon">';
											echo konsal_img_tag( array(
												'url'   => esc_url( $settings['6icon']['url'] ),
											)); 
										echo '</div>';
									}
								echo '<div>';
									if(!empty($settings['6label'])){
										echo '<p>'.esc_html($settings['6label']).'</p>';
									}
									echo wp_kses_post($settings['6content']);
								echo '</div>';
							echo '</div>';
						echo '</div>';
					echo '</div>';
					echo '<div class="col-xl-7">';
						echo '<div class="quote-form-box">';
							echo '<div class="contact-form ajax-contact">';
								if( !empty($settings['6konsal_select_contact_form']) ){
									echo do_shortcode( '[contact-form-7  id="'.$settings['6konsal_select_contact_form'].'"]' ); 
								}else{
									echo '<div class="alert alert-warning"><p class="m-0">' . __('Please Select contact form.', 'konsal' ). '</p></div>';
								}
							echo '</div>';
						echo '</div>';
					echo '</div>';
				echo '</div>';
			echo '</div>';
				
		}


	}
}