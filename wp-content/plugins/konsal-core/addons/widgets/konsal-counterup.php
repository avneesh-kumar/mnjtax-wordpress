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
 * CounterUp Box Widget .
 *
 */
class Konsal_CounterUp extends Widget_Base {

	public function get_name() {
		return 'konsalcounterup';
	}

	public function get_title() {
		return __( 'CounterUp', 'konsal' );
	}

	public function get_icon() {
		return 'th-icon';
    }

	public function get_categories() {
		return [ 'konsal' ];
	}

	protected function register_controls() {

		$this->start_controls_section(
			'teamd_section',
			[
				'label' 	=> __( 'CounterUp', 'konsal' ),
				'tab' 		=> Controls_Manager::TAB_CONTENT,
			]
        );
        $this->add_control(
			'layout_style',
			[
				'label' 		=> __( 'CounterUp Style', 'konsal' ),
				'type' 			=> Controls_Manager::SELECT,
				'default' 		=> 'layout_one',
				'options' 		=> [
					'layout_one'  		=> __( 'Style One', 'konsal' ),
					'layout_two'  		=> __( 'Style Two', 'konsal' ),
				]
			]
		);
		
        $this->end_controls_section();

	    include konsal_get_elementor_option('counterup-one-options.php');

        //-------------------------------------title styling-------------------------------------//
        $this->start_controls_section(
			'section_title_style_section',
			[
				'label' => __( 'Style', 'konsal' ),
				'tab' 	=> Controls_Manager::TAB_STYLE,
			]
		);

		konsal_all_elementor_style($this, 'Number', '{{WRAPPER}} .number-selector',['layout_one', 'layout_two'], '--white-color' );
		konsal_all_elementor_style($this, 'Title', '{{WRAPPER}} .title-selector',['layout_one', 'layout_two'], '--white-color' );

        $this->end_controls_section();

       
	}

	protected function render() {

        $settings = $this->get_settings_for_display();

        if( $settings['layout_style'] == 'layout_one' ){
        	echo '<div class="container">';
	            echo '<div class="counter-card-wrap">';
	                foreach( $settings['counter'] as $data ) {
		                echo '<div class="counter-card">';
		                	if( ! empty( $data['image']['url']  ) ){
			                    echo '<div class="box-icon">';
			                        echo konsal_img_tag( array(
					                    'url'   => esc_url( $data['image']['url']  ),
					                ));
			                    echo '</div>';
			                }
		                    echo '<div class="media-body">';
		                    	if( ! empty( $data['counter_number'] ) ){
		                    		$counter_suffix =  $data['counter_suffix'] ?  $data['counter_suffix'] : '';
			                        echo '<h2 class="box-number number-selector"><span class="counter-number ">'.esc_html( $data['counter_number'] ).'</span>'.esc_html( $counter_suffix ).'</h2>';
			                    }
			                    if( !empty( $data['counter_text'] ) ){
			                        echo '<p class="box-text title-selector">'.esc_html( $data['counter_text'] ).'</p>';
			                    }
		                    echo '</div>';
		                echo '</div>';
		                echo '<div class="divider"></div>';
		            }
	                

	            echo '</div>';
	        echo '</div> ';
    
	    }elseif( $settings['layout_style'] == 'layout_two' ){
			echo '<div class="counter-card-wrap">';
				foreach( $settings['counter'] as $data ) {
					echo '<div class="counter-card style2">';
						if( ! empty( $data['image']['url']  ) ){
							echo '<div class="box-icon">';
								echo konsal_img_tag( array(
									'url'   => esc_url( $data['image']['url']  ),
								));
							echo '</div>';
						}
						echo '<div class="media-body">';
							if( ! empty( $data['counter_number'] ) ){
								$counter_suffix =  $data['counter_suffix'] ?  $data['counter_suffix'] : '';
								echo '<h2 class="box-number number-selector"><span class="counter-number ">'.esc_html( $data['counter_number'] ).'</span>'.esc_html( $counter_suffix ).'</h2>';
							}
							if( !empty( $data['counter_text'] ) ){
								echo '<p class="box-text title-selector">'.esc_html( $data['counter_text'] ).'</p>';
							}
						echo '</div>';
					echo '</div>';
				}
			echo '</div>';

		}


	}
}