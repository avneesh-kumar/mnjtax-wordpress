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
 * Service Box Widget .
 *
 */
class Konsal_Service2 extends Widget_Base {

	public function get_name() {
		return 'konsalservices2';
	}

	public function get_title() {
		return __( 'Service V2', 'konsal' );
	}

	public function get_icon() {
		return 'th-icon';
    }

	public function get_categories() {
		return [ 'konsal' ];
	}

	protected function register_controls() {

		$this->start_controls_section(
			'service_section',
			[
				'label' 	=> __( 'Service V2', 'konsal' ),
				'tab' 		=> Controls_Manager::TAB_CONTENT,
			]
        );

        $this->add_control(
			'layout_style',
			[
				'label' 		=> __( 'Service Style', 'konsal' ),
				'type' 			=> Controls_Manager::SELECT,
				'default' 		=> '1',
				'options' 		=> [
					'1'  		=> __( 'Style One', 'konsal' ),
					'2'  		=> __( 'Style Two', 'konsal' ),
				]
			]
		);

        $repeater = new Repeater();

		konsal_media_fields($repeater, 'image', 'Choose Image');
		konsal_general_fields($repeater, 'title', 'Title', 'TEXTAREA', 'Strategic Planning');
		konsal_general_fields($repeater, 'desc', 'Description', 'TEXTAREA', 'Crafting tailore business strategies to achieve long-term success.');
		konsal_url_fields($repeater, 'button_link', 'Button URL');

		$this->add_control(
			'services',
			[
				'label' 		=> __( 'Banners', 'konsal' ),
				'type' 			=> Controls_Manager::REPEATER,
				'fields' 		=> $repeater->get_controls(),
				'default' 		=> [
					[
                        'title' 	=> __( 'Strategic Plannin', 'konsal' ),
					],
				],
			]
		);

        $this->end_controls_section();

        //---------------------------------------
			//Style Section Start
		//---------------------------------------

		//-------/title/description Style-------
		konsal_common2_style_fields( $this, 'title', 'Title', '{{WRAPPER}} .title', ['1', '2'], 'color', '--theme-color' );
		konsal_common_style_fields( $this, 'desc', 'Description', '{{WRAPPER}} .desc' );


	}

	protected function render() {

        $settings = $this->get_settings_for_display();

        if( $settings['layout_style'] == '1' ){
            echo '<div class="row gy-30">';
                foreach( $settings['services'] as $data ) { 
                    echo '<div class="col-md-6 col-xl-4">';
                        echo '<div class="service-card5">';
                            if( ! empty( $data['image']['url'] ) ){
                                echo '<div class="service-card-thumb">';
                                    echo konsal_img_tag( array(
                                        'url'   => esc_url( $data['image']['url'] ),
                                    ) );
                                echo '</div>';
                            }
                            echo '<div class="box-content">';
                                if( ! empty( $data['title'] ) ){
                                    echo '<h3 class="box-title title"><a href="'.esc_url( $data['button_link']['url'] ).'">'.esc_html( $data['title'] ).'</a></h3>';
                                }
                                echo '<div class="btn-wrap">';
                                    if( ! empty( $data['desc'] ) ){
                                        echo '<p class="box-text desc">'.esc_html( $data['desc'] ).'</p>';
                                    }
                                    echo '<a href="'.esc_url( $data['button_link']['url'] ).' " class="icon-btn"><i class="fa-solid fa-arrow-up-right"></i></a>';
                                echo '</div>';
                            echo '</div>';
                        echo '</div>';
                    echo '</div>';
                }
            echo '</div>';

	    }elseif( $settings['layout_style'] == '2' ){
	    	echo '<div class="row gy-30 gx-30">';
				foreach( $settings['services'] as $data ) { 
					echo '<div class="col-xl-3 col-md-6">';
						echo '<div class="service-card7">';
							if( ! empty( $data['image']['url'] ) ){
								echo '<div class="service-card-icon">';
									echo konsal_img_tag( array(
										'url'   => esc_url( $data['image']['url'] ),
									) );
								echo '</div>';
							}
							echo '<div class="box-content">';
								if( ! empty( $data['title'] ) ){
									echo '<h3 class="box-title title"><a href="'.esc_url( $data['button_link']['url'] ).'">'.esc_html( $data['title'] ).'</a></h3>';
								}
								if( ! empty( $data['desc'] ) ){
									echo '<p class="box-text desc">'.esc_html( $data['desc'] ).'</p>';
								}
							echo '</div>';
						echo '</div>';
					echo '</div>';
				}
            echo '</div>';

	    }


	}
}