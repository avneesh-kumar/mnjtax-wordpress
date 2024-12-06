<?php
use \Elementor\Widget_Base;
use \Elementor\Controls_Manager;
use \Elementor\Group_Control_Typography;
use \Elementor\Utils;
use \Elementor\Group_Control_Image_Size;
use \Elementor\Group_Control_Box_Shadow;
use \Elementor\Group_Control_Border;
/**
 *
 * Image Widget .
 *
 */
class Konsal_Animated_Image extends Widget_Base {

	public function get_name() {
		return 'konsalshapeimage';
	}
	public function get_title() {
		return __( 'Animated Image', 'konsal' );
	}
	public function get_icon() {
		return 'th-icon';
    }
	public function get_categories() {
		return [ 'konsal' ];
	}

	protected function register_controls() {

		$this->start_controls_section(
			'image_section',
			[
				'label' 	=> __( 'Image', 'konsal' ),
				'tab' 		=> Controls_Manager::TAB_CONTENT,
			]
        );

        $this->add_control(
			'image',
			[
				'label' 		=> __( 'Choose Image', 'konsal' ),
				'type' 			=> Controls_Manager::MEDIA,
				'dynamic' 		=> [
					'active' 		=> true,
				],
				'default' 		=> [
					'url' 			=> Utils::get_placeholder_image_src(),
				],
			]
		);
		$this->add_control(
			'effect_style',
			[
				'label' 		=> esc_html__( 'Add Styling Attributes', 'konsal' ),
				'type' 			=> \Elementor\Controls_Manager::SELECT,
				'options' 		=> [
					'jump'  			=> esc_html__( 'Jump Effect', 'konsal' ),
					'jump-reverse'  	=> esc_html__( 'Jump Reverse Effect', 'konsal' ),
					'moving'  			=> esc_html__( 'Moving Effect', 'konsal' ),
					'movingX'  			=> esc_html__( 'Moving Reverse Effect(X)', 'konsal' ),
					'spin'			=> esc_html__( 'Spin Effect', 'konsal' ),
					'starani'			=> esc_html__( 'Starani Effect', 'konsal' ),
					'rotate-x'			=> esc_html__( 'Rotate Effect', 'konsal' ),
					''			=> esc_html__( 'No Effect', 'konsal' ),
				],
				'default' => [ 'jump'],
			]
		);
		$this->add_control(
			'from_top',
			[
				'label' 		=> __( 'Top', 'konsal' ),
				'type' => \Elementor\Controls_Manager::SLIDER,
				'size_units' => [ '%', 'px' ],
				'range' => [
					'%' => [
						'min' => 0,
						'max' => 100,
					],
				],
				'default' => [
					'unit' => '%',
				],
			]
		);
		$this->add_control(
			'from_left',
			[
				'label' 		=> __( 'Left', 'konsal' ),
				'type' 			=> Controls_Manager::SLIDER,
				'size_units' => [ '%', 'px' ],
				'range' 		=> [
					'%' 			=> [
						'min' 			=> 0,
						'max' 			=> 100,
					],
				],
				'default' => [
					'unit' => '%',
				],
			]
		);
		$this->add_control(
			'from_right',
			[
				'label' 		=> __( 'Right', 'konsal' ),
				'type' 			=> Controls_Manager::SLIDER,
				'size_units' => [ '%', 'px' ],
				'range' 		=> [
					'%' 			=> [
						'min' 			=> 0,
						'max' 			=> 100,
					],
				],
				'default' => [
					'unit' => '%',
				],
			]
		);
		$this->add_control(
			'from_bottom',
			[
				'label' 		=> __( 'Bottom', 'konsal' ),
				'type' 			=> Controls_Manager::SLIDER,
				'size_units' => [ '%', 'px' ],
				'range' 		=> [
					'%' 			=> [
						'min' 			=> 0,
						'max' 			=> 100,
					],
				],
				'default' => [
					'unit' => '%',
				],
			]
		);
		$this->add_control(
			'responsive_style',
			[
				'label' 		=> esc_html__( 'Responsive Styling', 'konsal' ),
				'type' 			=> \Elementor\Controls_Manager::SELECT2,
				'label_block' 	=> true,
				'multiple' 		=> true,
				'options' 		=> [
					'd-xxl-block'  		=> esc_html__( 'Hide From Extra large Device (xxl)', 'konsal' ),
					'd-xl-block'  		=> esc_html__( 'Hide From large Device (xl)', 'konsal' ),
					'd-lg-block'  		=> esc_html__( 'Hide From Tablet (lg)', 'konsal' ),
					'd-md-block'  		=> esc_html__( 'Hide From Mobile (md)', 'konsal' ),
					'd-sm-block'  		=> esc_html__( 'D Small Device (sm)', 'konsal' ),
					'd-none'  			=> esc_html__( 'Display None', 'konsal' ),
					' '  				=> esc_html__( 'Default', 'konsal' ),
				],
			]
		);
		$this->add_control(
			'image_class', [
				'label' 		=> __( 'Image Class Name', 'konsal' ),
				'description' 		=> __( 'Class name for image size control', 'konsal' ),
				'type' 			=> Controls_Manager::TEXTAREA,
				'rows' 			=> 2,
				'label_block' 	=> true,
			]
        );

        $this->end_controls_section();

	}

	protected function render() {

        $settings = $this->get_settings_for_display();

        $this->add_render_attribute('wrapper','class','shape-mockup');
        $this->add_render_attribute('wrapper','class', $settings['image_class']);
        $this->add_render_attribute('wrapper','class', $settings['effect_style']);
        $this->add_render_attribute('wrapper','class', $settings['responsive_style']);

	    if($settings['from_top']['size']){
	        $this->add_render_attribute( 'wrapper', 'data-top', $settings['from_top']['size'] . $settings['from_top']['unit'] );
	    }
		if($settings['from_bottom']['size']){
	        $this->add_render_attribute( 'wrapper', 'data-bottom', $settings['from_bottom']['size'] . $settings['from_bottom']['unit'] );
	    }
	    if($settings['from_right']['size']){
	        $this->add_render_attribute( 'wrapper', 'data-right', $settings['from_right']['size'] . $settings['from_right']['unit'] );
	    }
	    if($settings['from_left']['size']){
	        $this->add_render_attribute( 'wrapper', 'data-left', $settings['from_left']['size'] . $settings['from_left']['unit'] );
	    }

        if( !empty( $settings['image']['id'] ) ) {
            echo '<!-- Image -->';
                echo '<div '.$this->get_render_attribute_string('wrapper').'>';
					echo '<img src="'.esc_url( $settings['image']['url']).'" alt="'.esc_attr__('Shape Image', 'konsal').'" >';
                echo '</div>';
            echo '<!-- End Image -->';
        }
		
	}
}