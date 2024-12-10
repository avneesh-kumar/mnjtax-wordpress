<?php
use \Elementor\Widget_Base;
use \Elementor\Controls_Manager;
use \Elementor\Group_Control_Typography;
use \Elementor\Repeater;
use \Elementor\Utils;
use \Elementor\Group_Control_Border;
/**
 *
 * Gallery Widget .
 *
 */
class konsal_Gallery extends Widget_Base {

	public function get_name() {
		return 'konsalgallery';
	}

	public function get_title() {
		return __( 'Gallery', 'konsal' );
	}

	public function get_icon() {
		return 'th-icon';
    }

	public function get_categories() {
		return [ 'konsal' ];
	}

	protected function register_controls() {

		$this->start_controls_section(
			'gallery_section',
			[
				'label' 	=> __( 'Gallery', 'konsal' ),
				'tab' 		=> Controls_Manager::TAB_CONTENT,
			]
        ); 

        $this->add_control(
			'layout_style',
			[
				'label' 		=> __( 'Layout Style', 'konsal' ),
				'type' 			=> Controls_Manager::SELECT,
				'default' 		=> 'one',
				'options' 		=> [
					'one'  		=> __( 'Style One', 'konsal' ),
				],
			]
		);

        $this->add_control(
            'title', [
                'label' 		=> __( 'Title', 'konsal' ),
                'type' 			=> \Elementor\Controls_Manager::TEXTAREA,
                'default' 		=> __( 'Title' , 'konsal' ),
                'rows' 			=> 2,
                'label_block' 	=> true,
                'condition'	=> [
                    'layout_style' => ['one']
                ]
            ]
        );

		$this->add_control(
			'gallery',
			[
				'label' => esc_html__( 'Add Gallery Slider', 'konsal' ),
				'type' => \Elementor\Controls_Manager::GALLERY,
				'default' => [],
			]
		);

        $this->add_control(
			'gallery_icon',
            [
				'label'         => __( 'Gallery Icon', 'konsal' ),
				'type'          => Controls_Manager::TEXTAREA,
				'default'       => __( '<i class="fab fa-instagram"></i>' , 'konsal' ),
				'label_block'   => true,
				'rows' => '4',
			]
		);

		$this->end_controls_section();

		//---------------------------------------
			//Style Section Start
		//---------------------------------------	


	}

	protected function render() {

        $settings = $this->get_settings_for_display();

        if( $settings['layout_style'] == 'one' ){
            echo '<div class="widget footer-widget">';
                if( ! empty( $settings['title'] ) ){
                    echo '<h3 class="widget_title">'.esc_html( $settings['title'] ).'</h3>';
                }
                echo '<div class="sidebar-gallery">';
                foreach ( $settings['gallery'] as $data ){
                    echo '<div class="gallery-thumb">';
                        echo konsal_img_tag( array(
                            'url'   => esc_url( $data['url'] ),
                        ) );
                        echo '<a href="'.esc_url( $data['url'] ).'" class="gallery-btn popup-image">'.wp_kses_post($settings['gallery_icon']).'</a>';
                    echo '</div>';
                }
                echo '</div>';
           echo '</div>';

        }
		 

	}

}