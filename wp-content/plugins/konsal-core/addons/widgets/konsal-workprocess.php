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
 * Work Process Widget .
 *
 */
class Konsal_Workprocess extends Widget_Base {

	public function get_name() {
		return 'konsalworkprocess';
	}

	public function get_title() {
		return __( 'Workprocess', 'konsal' );
	}

	public function get_icon() {
		return 'th-icon';
    }

	public function get_categories() {
		return [ 'konsal' ];
	}

	protected function register_controls() {

		$this->start_controls_section(
			'process_section',
			[
				'label' 	=> __( 'Work Process', 'konsal' ),
				'tab' 		=> Controls_Manager::TAB_CONTENT,
			]
        );

        $this->add_control(
			'layout_style',
			[
				'label' 		=> __( 'Workprocess Style', 'konsal' ),
				'type' 			=> Controls_Manager::SELECT,
				'default' 		=> 'layout_one',
				'options' 		=> [
					'layout_one'  		=> __( 'Style One', 'konsal' ),
					'layout_two'  		=> __( 'Style Two', 'konsal' ),
					'layout_three'  	=> __( 'Style Three', 'konsal' ),
				]
			]
		);
		
        $this->end_controls_section();


	    include konsal_get_elementor_option('workprocess-one-options.php'); 


        //--------------Title styling---------------//
        $this->start_controls_section(
			'section_title_style_section',
			[
				'label' => __( 'Style', 'konsal' ),
				'tab' 	=> Controls_Manager::TAB_STYLE,
			]
		);

		konsal_all_elementor_style($this, 'Title', '{{WRAPPER}} .title-selector',[ 'layout_one', 'layout_two', 'layout_three' ], '--title-color' );
		konsal_all_elementor_style($this, 'Content', '{{WRAPPER}} .desc-selector',[ 'layout_one', 'layout_two', 'layout_three' ], '--body-color' );

        $this->end_controls_section();

       
	}

	protected function render() {

        $settings = $this->get_settings_for_display();

        if( $settings['layout_style'] == 'layout_one' ){
        	 echo '<div class="row gy-4 justify-content-center">';
                foreach( $settings['workprocess'] as  $key => $data ) {
					$num = $key + 1;
					$formatted_num = ($num < 10) ? sprintf("%02d", $num) : $num; 
	                echo '<div class="col-xl-3 col-md-6">';
	                    echo '<div class="process-card">';
	                        echo '<p class="box-number">'.esc_html( $formatted_num ).'</p>';
	                        echo '<div class="box-content">';
	                            if( ! empty( $data['img']['url'] ) ){
			                        echo '<div class="box-icon">';
			                            echo konsal_img_tag( array(
				                            'url'       => esc_url( $data['img']['url'] ),
				                        ) );
			                        echo '</div>';
			                    }
			                    if( ! empty( $data['title']) ){
		                            echo '<h3 class="box-title title-selector">'.esc_html($data['title']).'</h3>';
		                        }
		                        if( ! empty( $data['desc']) ){
		                            echo '<p class="box-text desc-selector">'.esc_html($data['desc']).'</p>';
		                        }
	                        echo '</div>';
	                    echo '</div>';
	                echo '</div>';
	            }
            echo '</div>';

	    }elseif( $settings['layout_style'] == 'layout_two' ){
			echo '<div class="row gy-4 justify-content-center">';
				foreach( $settings['workprocess'] as $key => $data ) {
					$num = $key + 1;
					$formatted_num = ($num < 10) ? sprintf("%02d", $num) : $num; 
					echo '<div class="col-xl-auto col-md-6 process-card-wrap">';
						echo '<div class="process-card style2">';
							echo '<div class="box-content">';
								echo '<p class="box-number">'.esc_html( $formatted_num ).'</p>';
								if( ! empty( $data['img']['url'] ) ){
									echo '<div class="box-icon">';
										echo konsal_img_tag( array(
											'url'       => esc_url( $data['img']['url'] ),
										) );
									echo '</div>';
								}
								if( ! empty( $data['title']) ){
									echo '<h3 class="box-title title-selector">'.esc_html($data['title']).'</h3>';
								}
								if( ! empty( $data['desc']) ){
									echo '<p class="box-text desc-selector">'.esc_html($data['desc']).'</p>';
								}
							echo '</div>';
						echo '</div>';
					echo '</div>';
				}
			echo '</div>';

		}elseif( $settings['layout_style'] == 'layout_three' ){
			echo '<div class="row gy-40 gx-0 justify-content-center">';
				foreach( $settings['workprocess'] as   $data ) {
					echo '<div class="col-xl-auto col-md-6 process-card-wrap">';
						echo '<div class="process-card style3">';
							echo '<div class="box-content">';
								if( ! empty( $data['img']['url'] ) ){
									echo '<div class="box-icon">';
										echo konsal_img_tag( array(
											'url'       => esc_url( $data['img']['url'] ),
										) );
									echo '</div>';
								}
								if( ! empty( $data['title']) ){
									echo '<h3 class="box-title title-selector">'.esc_html($data['title']).'</h3>';
								}
								if( ! empty( $data['desc']) ){
									echo '<p class="box-text desc-selector">'.esc_html($data['desc']).'</p>';
								}
							echo '</div>';
						echo '</div>';
					echo '</div>';
				}
			echo '</div>';

		}


	}
}