<?php
use \Elementor\Widget_Base;
use \Elementor\Controls_Manager;
use \Elementor\Group_Control_Typography;
use \Elementor\Utils;
use \Elementor\Repeater;
use \Elementor\Group_Control_Border;
use \Elementor\Group_Control_Background;
/**
 * 
 * Footer Widget .
 *
 */
class konsal_Footer_Widgets extends Widget_Base {

	public function get_name() {
		return 'konsalfooterwidgets';
	}

	public function get_title() {
		return __( 'Footer Widgets', 'konsal' );
	}

	public function get_icon() {
		return 'th-icon';
    }

	public function get_categories() {
		return [ 'konsal' ];
	}
	
	protected function register_controls() {

		$this->start_controls_section(
			'layout_section',
			[
				'label'     => __( 'Footer Widgets', 'konsal' ),
				'tab'       => Controls_Manager::TAB_CONTENT,
			]
        );

		$this->add_control(
			'layout_style',
			[
				'label' 	=> __( 'Layout Style', 'konsal' ),
				'type' 		=> Controls_Manager::SELECT,
				'default' 	=> '1',
				'options' 	=> [
					'1'  		=> __( 'Style One', 'konsal' ),
					'2'  		=> __( 'Style Two', 'konsal' ),
					'3'  		=> __( 'Style Three', 'konsal' ),
					'4'  		=> __( 'Style Four', 'konsal' ),
				],
			]
		);

		$this->add_control(
			'bg',
			[
				'label' 		=> __( 'Choose Background', 'konsal' ),
				'type' 			=> Controls_Manager::MEDIA,
				'dynamic' 		=> [
					'active' 		=> true,
				],
				'condition' => [
					'layout_style' => ['3']
				]
			]
		);
		$this->add_control(
			'logo_image',
			[
				'label' 		=> __( 'Choose Logo', 'konsal' ),
				'type' 			=> Controls_Manager::MEDIA,
				'dynamic' 		=> [
					'active' 		=> true,
				],
				'condition' => [
					'layout_style' => ['4']
				]
			]
		);

		$this->add_control(
			'icon',
			[
				'label' 		=> __( 'Iocn', 'konsal' ),
				'type' 			=> Controls_Manager::TEXT,
				'label_block' 	=> true,
				'default' 		=> '<i class="far fa-phone"></i>',
				'condition' => [
					'layout_style' => ['3']
				]
			]
		);
        $this->add_control(
			'title',
            [
				'label'         => __( 'Title', 'konsal' ),
				'type'          => Controls_Manager::TEXTAREA,
				'default'       => __( 'Title' , 'konsal' ),
				'label_block'   => true,
				'rows' 		=> 2,
				'condition' => [
					'layout_style' => ['1', '2', '3']
				]
			]
		);
        $this->add_control(
			'desc',
            [
				'label'         => __( 'Description', 'konsal' ),
				'type'          => Controls_Manager::TEXTAREA,
				'default'       => __( 'Description' , 'konsal' ),
				'label_block'   => true,
				'rows' 		=> 3,
				'condition' => [
					'layout_style' => ['1', '2', '4']
				]
			]
		);
		$this->add_control(
			'phone_icon',
			[
				'label' 		=> __( 'Phone Iocn', 'konsal' ),
				'type' 			=> Controls_Manager::TEXT,
				'label_block' 	=> true,
				'default' 		=> '<i class="far fa-phone"></i>',
				'condition' => [
					'layout_style' => ['2', '4']
				]
			]
		);
		$this->add_control(
			'phone',
            [
				'label'         => __( 'Phone Number', 'konsal' ),
				'type'          => Controls_Manager::TEXT,
				'default'       => __( '+125 (405) 555-0128' , 'konsal' ),
				'label_block'   => true,
				'separator' => 'after',
				'condition' => [
					'layout_style' => ['2', '3', '4']
				]
			]
		);
		$this->add_control(
			'email_icon',
			[
				'label' 		=> __( 'Email Icon', 'konsal' ),
				'type' 			=> Controls_Manager::TEXT,
				'label_block' 	=> true,
				'default' 		=> '<i class="far fa-envelope-open"></i>',
				'condition' => [
					'layout_style' => ['2', '4']
				]
			]
		);
        $this->add_control(
			'email',
            [
				'label'         => __( 'Email Address', 'konsal' ),
				'type'          => Controls_Manager::TEXT,
				'default'       => __( 'quick.help@gmail.com' , 'konsal' ),
				'label_block'   => true,
				'separator' => 'after',
				'condition' => [
					'layout_style' => ['2', '3', '4']
				]
			]
		);
		$this->add_control(
			'address_icon',
			[
				'label' 		=> __( 'Address Icon', 'konsal' ),
				'type' 			=> Controls_Manager::TEXT,
				'label_block' 	=> true,
				'default' 		=> '<i class="far fa-location-dot"></i>',
				'condition' => [
					'layout_style' => ['2', '4']
				]
			]
		);
        $this->add_control(
			'address',
            [
				'label'         => __( 'Address', 'konsal' ),
				'type'          => Controls_Manager::TEXT,
				'default'       => __( '1901 Shiloh, Hawaii 81063' , 'konsal' ),
				'label_block'   => true,
				'separator' => 'after',
				'condition' => [
					'layout_style' => ['2', '4']
				]
			]
		);

		$this->add_control(
			'newsletter_placeholder',
			[
				'label' 		=> __( 'Newsletter Placeholder Text', 'konsal' ),
				'type' 			=> Controls_Manager::TEXTAREA,
				'default' 		=> __( 'Enter Your Email', 'konsal' ),
				'condition' => [
					'layout_style' => ['1']
				]
			]
		);

		$this->add_control(
			'newsletter_button',
			[
				'label' 		=> __( 'Newsletter Button Text', 'konsal' ),
				'type' 			=> Controls_Manager::TEXTAREA,
				'default' 		=> __( 'Subscribe', 'konsal' ),
				'condition' => [
					'layout_style' => ['1']
				]
			]
		);
		$this->add_control(
			'checkbox',
            [
				'label'         => __( 'Checkbox Text', 'konsal' ),
				'type'          => Controls_Manager::TEXTAREA,
				'default'       => __( '' , 'konsal' ),
				'label_block'   => true,
				'rows' 		=> 2,
				'condition' => [
					'layout_style' => ['1']
				]
			]
		);


        $this->end_controls_section();

         //---------------------------------------
			//Style Section Start
		//---------------------------------------


	}

	protected function render() {

        $settings = $this->get_settings_for_display();

        if( $settings['layout_style'] == '1' ){
            echo '<div class="widget newsletter-widget footer-widget">';
				if(!empty($settings['title'])){
					echo '<h3 class="widget_title">'.esc_html($settings['title']).'</h3>';
				}
				if(!empty($settings['desc'])){
                	echo '<p class="footer-text">'.esc_html($settings['desc']).'</p>';
				}
				echo '<form class="newsletter-form style2">';
					echo '<div class="form-group">';
						echo '<input class="form-control" type="email" placeholder="'.esc_attr($settings['newsletter_placeholder']).'" required="">';
						echo '<button type="submit" class="th-btn">'.wp_kses_post($settings['newsletter_button']).'</button>';
					echo '</div>';
					if(!empty($settings['checkbox'])){
						echo '<div class="check-group">';
							echo '<input type="checkbox" id="privacyPolicy">';
							echo '<label for="privacyPolicy">'.esc_html($settings['checkbox']).'</label>';
						echo '</div>';
					}
				echo '</form>';
            echo '</div>';

        }elseif( $settings['layout_style'] == '2' ){
			$email    	= $settings['email'];
            $phone    	= $settings['phone'];        
    
            $email          = is_email( $email );
    
            $replace        = array(' ','-',' - ');
            $replace_phone        = array(' ','-',' - ', '(', ')');
            $with           = array('','','');
    
            $emailurl       = str_replace( $replace, $with, $email );
            $phoneurl       = str_replace( $replace_phone, $with, $phone );	

			echo '<div class="widget footer-widget">';
				echo '<div class="th-widget-about">';
					if(!empty($settings['title'])){
						echo '<h3 class="widget_title">'.esc_html($settings['title']).'</h3>';
					}
					if(!empty($settings['desc'])){
						echo '<p class="about-text">'.esc_html($settings['desc']).'</p>';
					}
					if(!empty($phone)){
                        echo '<div class="info-box">';
							if(!empty($settings['phone_icon'])){
								echo '<div class="info-box_icon">'.wp_kses_post($settings['phone_icon']).'</div>';
							}
                            echo '<p class="info-box_text">';
                                echo '<a href="'.esc_attr( 'tel:'.$phoneurl).'" class="info-box_link">'.esc_html($phone).'</a>';
                            echo '</p>';
                        echo '</div>';
                    }
                    if(!empty($email)){
                        echo '<div class="info-box">';
							if(!empty($settings['email_icon'])){
								echo '<div class="info-box_icon">'.wp_kses_post($settings['email_icon']).'</div>';
							}
                            echo '<p class="info-box_text">';
                                echo '<a href="'.esc_attr( 'mailto:'.$emailurl).'" class="info-box_link">'.esc_html($email).'</a>';
                            echo '</p>';
                        echo '</div>';
                    }
					if(!empty($settings['address'])){
                        echo '<div class="info-box">';
							if(!empty($settings['address_icon'])){
								echo '<div class="info-box_icon">'.wp_kses_post($settings['address_icon']).'</div>';
							}
                            echo '<p class="info-box_text">'.esc_html($settings['address']).'</p>';
                        echo '</div>';
                    }
				echo '</div>';
			echo '</div>';

		}elseif( $settings['layout_style'] == '3' ){
			$email    	= $settings['email'];
            $phone    	= $settings['phone'];        
    
            $email          = is_email( $email );
    
            $replace        = array(' ','-',' - ');
            $replace_phone        = array(' ','-',' - ', '(', ')');
            $with           = array('','','');
    
            $emailurl       = str_replace( $replace, $with, $email );
            $phoneurl       = str_replace( $replace_phone, $with, $phone );	

			echo '<div class="widget widget_banner" data-bg-src="'.esc_url( $settings['bg']['url'] ).'" data-overlay="title" data-opacity="8">';
				echo '<div class="widget-banner text-center">';
					if(!empty($settings['icon'])){
						echo '<div class="icon">'.wp_kses_post($settings['icon']).'</div>';
					}
					if(!empty($settings['title'])){
						echo '<h3 class="subtitle">'.wp_kses_post($settings['title']).'</h3>';
					}
					if(!empty($phone)){
						echo '<h3 class="title"><a href="'.esc_attr( 'tel:'.$phoneurl).'">'.esc_html($phone).'</a></h3>';
					}
					if(!empty($email)){
						echo '<a href="'.esc_attr( 'mailto:'.$emailurl).'" class="link">'.esc_html($email).'</a>';
					}
				echo '</div>';
			echo '</div>';

		}elseif( $settings['layout_style'] == '4' ){
			$email    	= $settings['email'];
            $phone    	= $settings['phone'];        
    
            $email          = is_email( $email );
    
            $replace        = array(' ','-',' - ');
            $replace_phone        = array(' ','-',' - ', '(', ')');
            $with           = array('','','');
    
            $emailurl       = str_replace( $replace, $with, $email );
            $phoneurl       = str_replace( $replace_phone, $with, $phone );	

			echo '<div class="widget footer-widget">';
				echo '<div class="th-widget-about">';
					if( ! empty( $settings['logo_image']['url'] ) ){
						echo '<div class="about-logo">';
							echo '<a href="'.esc_url( home_url( '/' ) ).'"><img src="'.esc_url( $settings['logo_image']['url'] ).'" alt="'.esc_attr__('Logo', 'Konsal').'"></a>';
						echo '</div>';
					}
					if(!empty($settings['desc'])){
						echo '<p class="about-text">'.esc_html($settings['desc']).'</p>';
					}
					if(!empty($phone)){
                        echo '<div class="info-box">';
							if(!empty($settings['phone_icon'])){
								echo '<div class="info-box_icon">'.wp_kses_post($settings['phone_icon']).'</div>';
							}
                            echo '<p class="info-box_text">';
                                echo '<a href="'.esc_attr( 'tel:'.$phoneurl).'" class="info-box_link">'.esc_html($phone).'</a>';
                            echo '</p>';
                        echo '</div>';
                    }
                    if(!empty($email)){
                        echo '<div class="info-box">';
							if(!empty($settings['email_icon'])){
								echo '<div class="info-box_icon">'.wp_kses_post($settings['email_icon']).'</div>';
							}
                            echo '<p class="info-box_text">';
                                echo '<a href="'.esc_attr( 'mailto:'.$emailurl).'" class="info-box_link">'.esc_html($email).'</a>';
                            echo '</p>';
                        echo '</div>';
                    }
					if(!empty($settings['address'])){
                        echo '<div class="info-box">';
							if(!empty($settings['address_icon'])){
								echo '<div class="info-box_icon">'.wp_kses_post($settings['address_icon']).'</div>';
							}
                            echo '<p class="info-box_text">'.esc_html($settings['address']).'</p>';
                        echo '</div>';
                    }
				echo '</div>';
			echo '</div>';

		}


	}
}
						