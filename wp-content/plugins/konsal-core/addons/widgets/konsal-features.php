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
 * Features Box Widget .
 *
 */
class Konsal_Features extends Widget_Base {

	public function get_name() {
		return 'konsalfeatures';
	}

	public function get_title() {
		return __( 'Features', 'konsal' );
	}

	public function get_icon() {
		return 'th-icon';
    }

	public function get_categories() {
		return [ 'konsal' ];
	}

	protected function register_controls() {

		$this->start_controls_section(
			'feature_section',
			[
				'label' 	=> __( 'Features', 'konsal' ),
				'tab' 		=> Controls_Manager::TAB_CONTENT,
			]
        );
        $this->add_control(
			'layout_style',
			[
				'label' 		=> __( 'Features Style', 'konsal' ),
				'type' 			=> Controls_Manager::SELECT,
				'default' 		=> 'layout_one',
				'options' 		=> [
					'layout_one'  	=> __( 'Style One', 'konsal' ),
					'layout_two'  	=> __( 'Style Two', 'konsal' ),
					'layout_three'  => __( 'Style Three', 'konsal' ),
					'layout_four'  	=> __( 'Style Four', 'konsal' ),
					'layout_five'  	=> __( 'Style Five', 'konsal' ),
					'layout_six'  	=> __( 'Style Six', 'konsal' ),
					'layout_seven'  => __( 'Style Seven', 'konsal' ),
				]
			]
		);
		
        $this->end_controls_section();

	    include konsal_get_elementor_option('features-one-options.php');
	    include konsal_get_elementor_option('features-four-options.php');
	    include konsal_get_elementor_option('features-six-options.php'); 

		$this->start_controls_section(
			'features_section7',
			[
				'label' 	=> __( 'Banner', 'konsal' ),
				'tab' 		=> Controls_Manager::TAB_CONTENT,
			]
        );

		$repeater = new Repeater();

		konsal_media_fields($repeater, 'icon', 'Choose Icon');
		konsal_general_fields($repeater, 'title', 'Title', 'TEXTAREA', 'Global Business');

		$this->add_control(
			'features7',
			[
				'label' 		=> __( 'Banners', 'konsal' ),
				'type' 			=> Controls_Manager::REPEATER,
				'fields' 		=> $repeater->get_controls(),
				'default' 		=> [
					[
						'title' 	=> __( 'Global Business', 'konsal' ),
					],
				],
				'condition'	=> [
					'layout_style' => ['layout_seven']
				]
			]
		);

		$this->end_controls_section();
		
        //----------------title styling-----------------//
        $this->start_controls_section(
			'section_title_style_section',
			[
				'label' => __( 'Style', 'konsal' ),
				'tab' 	=> Controls_Manager::TAB_STYLE,
			]
		);

		konsal_all_elementor_style($this, 'Title', '{{WRAPPER}} .title-selector',['layout_one','layout_two'], '--title-color' );
		konsal_all_elementor_style($this, 'Description', '{{WRAPPER}} .desc-selector',['layout_one','layout_two'], '--body-color' );

		konsal_all_elementor_style($this, 'Title ', '{{WRAPPER}} .title-selector',['layout_three'], '--white-color' );
		konsal_all_elementor_style($this, 'Description ', '{{WRAPPER}} .desc-selector',['layout_three'], '--white-color' );

        $this->end_controls_section();

		konsal_common_style_fields( $this, 'title', 'Title', '{{WRAPPER}} .title-selector', ['layout_five', 'layout_six', 'layout_seven'] );
		konsal_common_style_fields( $this, 'desc', 'Description', '{{WRAPPER}} .desc-selector', ['layout_five', 'layout_six'] );

       
	}

	protected function render() {

        $settings = $this->get_settings_for_display();

        if( $settings['layout_style'] == 'layout_one' ){
        	echo '<div class="about-feature-wrap">';
                foreach( $settings['features'] as $data ) {                    
	                echo '<div class="about-feature">';
	                    if( ! empty( $data['image']['url'] ) ){
			                echo '<div class="box-icon">';
			                    echo konsal_img_tag( array(
									'url'   => esc_url( $data['image']['url'] ),
								) );
			                echo '</div>';
			            }
			            if( ! empty( $data['title'] ) ){
		                    echo '<h3 class="box-title title-selector">'.esc_html( $data['title'] ).'</h3>';
		                }
	                echo '</div>';
	            }
            echo '</div>';

	    }elseif( $settings['layout_style'] == 'layout_two' ){
	    	echo '<div class="about-feature-wrap2">';
                foreach( $settings['features'] as $data ) {             
	                echo '<div class="about-feature">';
	                    if( ! empty( $data['image']['url'] ) ){
			                echo '<div class="box-icon">';
			                    echo konsal_img_tag( array(
									'url'   => esc_url( $data['image']['url'] ),
								) );
			                echo '</div>';
			            }
	                    echo '<div class="about-feature-content">';
	                        if( ! empty( $data['title'] ) ){
			                    echo '<h3 class="box-title title-selector">'.esc_html( $data['title'] ).'</h3>';
			                }
			                if( ! empty( $data['content'] ) ){
		                        echo '<p class="about-feature-text desc-selector">'.esc_html( $data['content'] ).'</p>';
		                    }
	                    echo '</div>';
	                echo '</div>';
	            }
            echo '</div>';

	    }elseif( $settings['layout_style'] == 'layout_three' ){
	    	echo '<ul class="why-feature-list">';
                foreach( $settings['features'] as $data ) {          
	                echo '<li class="why-feature-list-wrap style2">';
	                	if( ! empty( $data['image']['url'] ) ){
		                    echo '<div class="icon"><img src="'.esc_url( $data['image']['url'] ).'" alt="img"></div>';
		                }
	                    echo '<div class="why-feature-list-details">';
	                    	if( ! empty( $data['title'] ) ){
			                    echo '<h4 class="feature-title title-selector">'.esc_html( $data['title'] ).'</h4>';
			                }
			                if( ! empty( $data['content'] ) ){
		                        echo '<p class="feature-text desc-selector">'.esc_html( $data['content'] ).'</p>';
		                    }
	                    echo '</div>';
	                echo '</li>';
	            }
                
            echo '</ul>';

	    }elseif( $settings['layout_style'] == 'layout_four' ){
			echo '<ul class="nav product-tab-style1 mt-0 pb-0" id="productTab" role="tablist">';
				$x = 1;
				foreach( $settings['features_2'] as $data ) { 
					if( $x == '1' ){
						$active = 'active';
						$aria = 'false';
					}else{
						$active = '';
						$aria = 'true';
					}   
					echo '<li class="nav-item" role="presentation">';
						echo '<a class="nav-link th-btn '.esc_attr($active).'" id="description-tab'.esc_attr( $x ).'" data-bs-toggle="tab" href="#description'.esc_attr( $x ).'" role="tab" aria-controls="description'.esc_attr( $x ).'" aria-selected="'.esc_attr($aria).'">'.esc_html( $data['title'] ).'</a>';
					echo '</li>';
					$x++;
				}
			echo '</ul>';
			echo '<div class="tab-content" id="productTabContent">';
				$x = 1;
				foreach( $settings['features_2'] as $data ) {    
					if( $x == '1' ){
						$active = 'show active';
					}else{
						$active = '';
					}   
					echo '<div class="tab-pane fade '.esc_attr($active).'" id="description'.esc_attr( $x ).'" role="tabpanel" aria-labelledby="description-tab'.esc_attr( $x ).'">';
						echo wp_kses_post( $data['content'] );
						echo '<div class="row gy-4">';
							echo '<div class="col-xxl-3 col-6">';
								echo konsal_img_tag( array(
									'url'   => esc_url( $data['image']['url'] ),
								) );
							echo '</div>';
							echo '<div class="col-xxl-3 col-6">';
								echo konsal_img_tag( array(
									'url'   => esc_url( $data['image2']['url'] ),
								) );
							echo '</div>';
							if( ! empty( $data['phone'] ) ){
								echo '<div class="col-xxl-6">';
									echo '<div class="service-details-inner-wrap">';
										echo '<div class="service-icon"><i class="fal fa-phone"></i></div>';
										echo '<div class="service-inner-details">';
											echo '<p class="service-inner-wrap-text">'.esc_html( $data['phone_label'] ).'</p>';
											echo '<h4 class="service-inner-wrap-title">'.esc_html( $data['phone'] ).'</h4>';
										echo '</div>';
									echo '</div>';
								echo '</div>';
							}
						echo '</div>';
					echo '</div>';
					$x++;
				}
			echo '</div>';

		}elseif( $settings['layout_style'] == 'layout_five' ){
			echo '<ul class="why-feature-list">';
				foreach( $settings['features'] as $data ) {
					echo '<li class="why-feature-list-wrap style3">';
						if( ! empty( $data['image']['url'] ) ){
							echo '<div class="icon">';
								echo konsal_img_tag( array(
									'url'   => esc_url( $data['image']['url'] ),
								) );
							echo '</div>';
						}
						echo '<div class="why-feature-list-details">';
							if( ! empty( $data['title'] ) ){
								echo '<h4 class="feature-title title-selector">'.esc_html( $data['title'] ).'</h4>';
							}
							if( ! empty( $data['content'] ) ){
								echo '<p class="feature-text desc-selector">'.esc_html( $data['content'] ).'</p>';
							}
						echo '</div>';
					echo '</li>';
				}
			echo '</ul>';

		}elseif( $settings['layout_style'] == 'layout_six' ){
			echo '<div class="row gy-4 justify-content-center">';
				foreach( $settings['features2'] as $data ) {
					echo '<div class="col-lg-4 col-md-6">';
						echo '<div class="feature-card style2">';
							echo '<div class="feature-card-bg-thumb" data-bg-src="'.esc_url( $data['image']['url'] ).'"></div>';
							if( ! empty( $settings['shape']['url'] ) ){
								echo '<div class="feature-card-bg-shape">';
									echo konsal_img_tag( array(
										'url'   => esc_url( $settings['shape']['url'] ),
									) );
								echo '</div>';
							}
							if( ! empty( $data['icon']['url'] ) ){
								echo '<div class="box-icon">';
									echo konsal_img_tag( array(
										'url'   => esc_url( $data['icon']['url'] ),
									) );
								echo '</div>';
							}
							if( ! empty( $data['title'] ) ){
								echo '<h3 class="box-title title-selector">'.esc_html( $data['title'] ).'</h3>';
							}
							if( ! empty( $data['content'] ) ){
								echo '<p class="box-text desc-selector">'.esc_html( $data['content'] ).'</p>';
							}
						echo '</div>';
					echo '</div>';
				}
			echo '</div>';

		}elseif( $settings['layout_style'] == 'layout_seven' ){
			echo '<div class="row gy-4 justify-content-between">';
				foreach( $settings['features7'] as $data ) {
					echo '<div class="col-auto">';
						echo '<div class="why-feature-list-wrap style4">';
							if( ! empty( $data['icon']['url'] ) ){
								echo '<div class="icon">';
									echo konsal_img_tag( array(
										'url'   => esc_url( $data['icon']['url'] ),
									) );
								echo '</div>';
							}
							echo '<div class="why-feature-list-details">';
								if( ! empty( $data['title'] ) ){
									echo '<h4 class="feature-title title-selector">'.esc_html( $data['title'] ).'</h4>';
								}
							echo '</div>';
						echo '</div>';
					echo '</div>';
				}
			echo '</div>';

		}


	}
}