<?php
use \Elementor\Widget_Base;
use \Elementor\Controls_Manager;
use \Elementor\Group_Control_Typography;
use \Elementor\Utils;
use \Elementor\Repeater;
use \Elementor\Group_Control_Border;
/**
 *
 * Brand Logo Widget .
 *
 */
class konsal_Brand_Logo extends Widget_Base {

	public function get_name() {
		return 'konsalbrandlogo';
	}

	public function get_title() {
		return __( 'Brand Logo', 'konsal' );
	}

	public function get_icon() {
		return 'th-icon';
    }

	public function get_categories() {
		return [ 'konsal' ];
	}

	protected function register_controls() {

		$this->start_controls_section(
			'client_logo_section',
			[
				'label' 	=> __( 'Brand Logo', 'konsal' ),
				'tab' 		=> Controls_Manager::TAB_CONTENT,
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
				],
			]
		);

        $repeater = new Repeater();

		$repeater->add_control(
			'client_logo',
			[
				'label' 	=> __( 'Client Logo', 'konsal' ),
				'type' 		=> Controls_Manager::MEDIA,
				'default' => [
					'url' 	=> Utils::get_placeholder_image_src(),
				],
			]
		);		

		$this->add_control(
			'logos',
			[
				'label' 		=> __( 'Client Logos', 'konsal' ),
				'type' 			=> Controls_Manager::REPEATER,
				'fields' 		=> $repeater->get_controls(),
				'default' 		=> [
					[
						'client_logo' => Utils::get_placeholder_image_src(),
					],
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
                echo '<div class="swiper th-slider client-slider1" data-slider-options=\'{"breakpoints":{"0":{"slidesPerView":1},"400":{"slidesPerView":"2"},"768":{"slidesPerView":"3"},"992":{"slidesPerView":"4"},"1200":{"slidesPerView":"6"}}, "spaceBetween": "0", "loop": "true"}\'>';                    
                echo '<div class="swiper-wrapper">';
                    foreach( $settings['logos'] as $data ){
                        echo '<div class="swiper-slide">';
                            echo '<a href="#" class="client-card">';
                                echo konsal_img_tag( array(
                                    'url'   => esc_url( $data['client_logo']['url'] ),
                                ) );
                            echo '</a>';
                        echo '</div>';
                    }
                    echo '</div>';
                echo '</div>';
            }


	}
}