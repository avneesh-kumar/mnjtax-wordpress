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
 * Project Box Widget .
 *
 */
class Konsal_Project extends Widget_Base {

	public function get_name() {
		return 'konsalproject';
	}

	public function get_title() {
		return __( 'Project', 'konsal' );
	}

	public function get_icon() {
		return 'th-icon';
    }

	public function get_categories() {
		return [ 'konsal' ];
	}

	protected function register_controls() {

		$this->start_controls_section(
			'project_section',
			[
				'label' 	=> __( 'Project', 'konsal' ),
				'tab' 		=> Controls_Manager::TAB_CONTENT,
			]
        );
        $this->add_control(
			'layout_style',
			[
				'label' 		=> __( 'Project Style', 'konsal' ),
				'type' 			=> Controls_Manager::SELECT,
				'default' 		=> 'layout_one',
				'options' 		=> [
					'layout_one'  		=> __( 'Style One', 'konsal' ),
					'layout_two'  		=> __( 'Style Two', 'konsal' ),
					'layout_three'  	=> __( 'Style Three', 'konsal' ),
					'layout_four'  		=> __( 'Style Four', 'konsal' ),
					'layout_five'  		=> __( 'Style Five', 'konsal' ),
					'layout_six'  		=> __( 'Style Six', 'konsal' ),
					'layout_seven'  	=> __( 'Style Seven', 'konsal' ),
				]
			]
		);
		
        $this->end_controls_section();

	    include konsal_get_elementor_option('project-one-options.php');
	    include konsal_get_elementor_option('project-three-options.php');

        //-------------------------------------title styling-------------------------------------//

        $this->start_controls_section(
			'section_title_style_section',
			[
				'label' => __( 'Style', 'konsal' ),
				'tab' 	=> Controls_Manager::TAB_STYLE,
			]
		);

		konsal_all_elementor_style($this, 'Title', '{{WRAPPER}} .title-selector',[ 'layout_one', 'layout_two', 'layout_three', 'layout_seven' ], '--white-color' );
		konsal_all_elementor_style($this, 'Subtitle', '{{WRAPPER}} .subtitle-selector',[ 'layout_one', 'layout_two', 'layout_three', 'layout_seven' ], '--white-color' );

        $this->end_controls_section();

		konsal_common2_style_fields( $this, 'title2', 'Title', '{{WRAPPER}} .title-selector', ['layout_four'], '--title-color', '--theme-color'  );
		konsal_common2_style_fields( $this, 'title22', 'Title', '{{WRAPPER}} .title-selector', ['layout_five'], '--white-color', '--theme-color'  );
		konsal_common_style_fields( $this, 'subtitle2', 'Subtitle', '{{WRAPPER}} .subtitle-selector', ['layout_four', 'layout_five'] );
       
	}

	protected function render() {

        $settings = $this->get_settings_for_display();

        if( $settings['layout_style'] == 'layout_one' ){
        	echo '<div class="row gy-30 gx-30 filter-active">';
        		foreach( $settings['project_list'] as $data ) {  
	                echo '<div class="col-xxl-auto col-xl-4 col-lg-6 filter-item">';
	                    echo '<div class="project-card">';
	                    	if( ! empty( $data['image']['url'] ) ){
		                        echo '<div class="project-img">';
		                            echo konsal_img_tag( array(
										'url'   => esc_url( $data['image']['url'] ),
									) );
		                        echo '</div>';
		                    }
	                        echo '<div class="project-content">';
	                            echo '<div class="project-details">';
	                            	if( !empty( $data['title'] ) ){
		                                echo '<h3 class="project-title title-selector"><a href="'.esc_url($data['button_link']).'">'.esc_html($data['title']).'</a></h3>';
		                            }
		                            if( !empty( $data['subtitle'] ) ){
		                                echo '<p class="project-subtitle subtitle-selector">'.esc_html($data['subtitle']).'</p>';
		                            }
	                                echo '<a href="'.esc_url($data['button_link']).'" class="icon-btn"><i class="far fa-arrow-right"></i></a>';
	                            echo '</div>';
	                        echo '</div>';
	                    echo '</div>';
	                echo '</div>';
	            }
            echo '</div>';

	    }elseif( $settings['layout_style'] == 'layout_two' ){
	    	echo '<div class="row gy-4">';

	    		$project_list = $settings['project_list'];
	    		$total_projects = count($project_list);

        		foreach( $project_list as $i => $data ) {  
        			if ($i === 0) {
        				$col = 6;
        			}elseif( $i === $total_projects - 1 ){
        				$col = 6;
        			}else{
        				$col = 3;
        			}
	                echo '<div class="col-xxl-'.esc_attr( $col ).' col-xl-4 col-lg-6">';
	                    echo '<div class="project-card style2">';
	                    	if( ! empty( $data['image']['url'] ) ){
		                        echo '<div class="project-img">';
		                            echo konsal_img_tag( array(
										'url'   => esc_url( $data['image']['url'] ),
									) );
		                        echo '</div>';
		                    }
	                        echo '<div class="project-content">';
	                            echo '<div class="project-details">';
	                            	if( !empty( $data['title'] ) ){
		                                echo '<h3 class="project-title title-selector"><a href="'.esc_url($data['button_link']).'">'.esc_html($data['title']).'</a></h3>';
		                            }
		                            if( !empty( $data['subtitle'] ) ){
		                                echo '<p class="project-subtitle subtitle-selector">'.esc_html($data['subtitle']).'</p>';
		                            }
	                                echo '<a href="'.esc_url($data['button_link']).'" class="icon-btn"><i class="far fa-arrow-right"></i></a>';
	                            echo '</div>';
	                        echo '</div>';
	                    echo '</div>';
	                echo '</div>';
	            }

            echo '</div>';

	    }elseif( $settings['layout_style'] == 'layout_three' ){
			echo '<div class="row justify-content-center">';
				echo '<div class="col-12">';
					echo '<div class="project-filter-btn filter-menu indicator-active filter-menu-active">';
						if( ! empty( $settings['filter_all_title'])){
							echo '<button data-filter="*" class="tab-btn active" type="button">'.esc_html($settings['filter_all_title']).'</button>';
						}
						foreach( $settings['portfolio_filter'] as $data ){
							$replace        = array(' ','-',' - ');
							$with           = array('','','');
							$filter_slug       = strtolower(str_replace( $replace, $with, $data['filter_data'] ));

							echo '<button data-filter=".'.esc_attr( $filter_slug ).'" class="tab-btn" type="button">'.esc_html($data['filter_title']).'</button>';
						}
					echo '</div>';
				echo '</div>';

			echo '</div>';

			echo '<div class="row gy-30 gx-30 filter-active">';
				foreach( $settings['project_list_2'] as $data ){
					$replace        = array('-',' - ');
					$with           = array('','','');
					$filter_slug       = strtolower(str_replace( $replace, $with, $data['filter_content_data'] ));

					echo '<div class="col-xxl-auto col-xl-4 col-lg-6 filter-item '.esc_attr( $filter_slug ).'">';
						echo '<div class="project-card style3">';
							if( ! empty( $data['image']['url'] ) ){
		                        echo '<div class="project-img">';
		                            echo konsal_img_tag( array(
										'url'   => esc_url( $data['image']['url'] ),
									) );
		                        echo '</div>';
		                    }
							echo '<div class="project-content">';
								echo '<div class="project-details">';
									echo '<span class="left-angle-shape"></span>';
									echo '<span class="right-angle-shape"></span>';
									if( !empty( $data['title'] ) ){
		                                echo '<h3 class="project-title title-selector"><a href="'.esc_url($data['button_link']['url']).'">'.esc_html($data['title']).'</a></h3>';
		                            }
		                            if( !empty( $data['subtitle'] ) ){
		                                echo '<p class="project-subtitle subtitle-selector">'.esc_html($data['subtitle']).'</p>';
		                            }
								echo '</div>';
							echo '</div>';
						echo '</div>';
					echo '</div>';
				}
			echo '</div>';

		}elseif( $settings['layout_style'] == 'layout_four' ){
			echo '<div class="row justify-content-center">';
				echo '<div class="col-12">';
					echo '<div class="project-filter-btn filter-menu indicator-active filter-menu-active">';
						if( ! empty( $settings['filter_all_title'])){
							echo '<button data-filter="*" class="tab-btn active" type="button">'.esc_html($settings['filter_all_title']).'</button>';
						}
						foreach( $settings['portfolio_filter'] as $data ){
							$replace        = array(' ','-',' - ');
							$with           = array('','','');
							$filter_slug       = strtolower(str_replace( $replace, $with, $data['filter_data'] ));

							echo '<button data-filter=".'.esc_attr( $filter_slug ).'" class="tab-btn" type="button">'.esc_html($data['filter_title']).'</button>';
						}
					echo '</div>';
				echo '</div>';
			echo '</div>';

			echo '<div class="row gy-30 gx-30 filter-active">';
				foreach( $settings['project_list_2'] as $data ){
					$replace        = array('-',' - ');
					$with           = array('','','');
					$filter_slug       = strtolower(str_replace( $replace, $with, $data['filter_content_data'] ));

					echo '<div class="col-xxl-auto col-xl-4 col-lg-6 filter-item '.esc_attr( $filter_slug ).'">';
						echo '<div class="project-card style4">';
							if( ! empty( $data['image']['url'] ) ){
								echo '<div class="project-img">';
									echo konsal_img_tag( array(
										'url'   => esc_url( $data['image']['url'] ),
									) );
								echo '</div>';
							}
							echo '<div class="project-content">';
								echo '<div class="project-details">';
									if( !empty( $data['title'] ) ){
										echo '<h3 class="project-title title-selector"><a href="'.esc_url($data['button_link']['url']).'">'.esc_html($data['title']).'</a></h3>';
									}
									if( !empty( $data['subtitle'] ) ){
										echo '<p class="project-subtitle subtitle-selector">'.esc_html($data['subtitle']).'</p>';
									}
								echo '</div>';
								if( !empty( $data['button_link']['url'] ) ){
									echo '<a href="'.esc_url($data['button_link']['url']).'" class="icon-btn"><i class="far fa-arrow-right"></i></a>';
								}
							echo '</div>';
						echo '</div>';
					echo '</div>';
				}
			echo '</div>';

		}elseif( $settings['layout_style'] == 'layout_five' ){
			echo '<div class="slider-area project-slider5">';
				echo '<div class="swiper th-slider" id="ProjectSlider5" data-slider-options=\'{"breakpoints":{"0":{"slidesPerView":1},"576":{"slidesPerView":"1"},"768":{"slidesPerView":"2"},"992":{"slidesPerView":"3"},"1200":{"slidesPerView":"3"}},"centeredSlides": true}\'>';
					echo '<div class="swiper-wrapper">';
					foreach( $settings['project_list'] as $data ) {  
						echo '<div class="swiper-slide">';
							echo '<div class="project-card style5">';
								if( ! empty( $data['image']['url'] ) ){
									echo '<div class="project-img">';
										echo konsal_img_tag( array(
											'url'   => esc_url( $data['image']['url'] ),
										) );
									echo '</div>';
								}
								echo '<div class="project-content">';
									echo '<div class="project-details">';
										if( !empty( $data['subtitle'] ) ){
											echo '<p class="project-subtitle subtitle-selector">'.esc_html($data['subtitle']).'</p>';
										}
										if( !empty( $data['title'] ) ){
											echo '<h3 class="project-title title-selector"><a href="'.esc_url($data['button_link']).'">'.esc_html($data['title']).'</a></h3>';
										}
									echo '</div>';
									echo '<a href="'.esc_url($data['button_link']).'" class="icon-btn"><i class="far fa-arrow-right"></i></a>';
								echo '</div>';
							echo '</div>';
						echo '</div>';
					}
					echo '</div>';
				echo '</div>';
				echo '<button data-slider-prev="#ProjectSlider5" class="slider-arrow style2 slider-prev"><i class="far fa-arrow-left"></i></button>';
				echo '<button data-slider-next="#ProjectSlider5" class="slider-arrow style2 slider-next"><i class="far fa-arrow-right"></i></button>    ';
			echo '</div>';

		}elseif( $settings['layout_style'] == 'layout_six' ){
			echo '<div class="row gy-30 gx-30 filter-active">';
				foreach( $settings['project_list'] as $data ) {  
					echo '<div class="col-xl-4 col-md-6 filter-item">';
						echo '<div class="project-card style6">';
							if( ! empty( $data['image']['url'] ) ){
								echo '<div class="project-img">';
									echo konsal_img_tag( array(
										'url'   => esc_url( $data['image']['url'] ),
									) );
								echo '</div>';
							}
							echo '<div class="project-content">';
								echo '<div class="project-details">';
									echo '<a href="'.esc_url($data['button_link']).'" class="icon-btn"><i class="far fa-arrow-up-right"></i></a>';
									if( !empty( $data['subtitle'] ) ){
										echo '<p class="project-subtitle subtitle-selector">'.esc_html($data['subtitle']).'</p>';
									}
									if( !empty( $data['title'] ) ){
										echo '<h3 class="project-title title-selector"><a href="'.esc_url($data['button_link']).'">'.esc_html($data['title']).'</a></h3>';
									}
								echo '</div>';
							echo '</div>';
						echo '</div>';
					echo '</div>';
				}
			echo '</div>';

		}elseif( $settings['layout_style'] == 'layout_seven' ){
			echo '<div class="row gy-30 gx-30 filter-active">';
				foreach( $settings['project_list'] as $data ) {  
					echo '<div class="col-lg-6 filter-item">';
						echo '<div class="project-card style7">';
							if( ! empty( $data['image']['url'] ) ){
								echo '<div class="project-img">';
									echo konsal_img_tag( array(
										'url'   => esc_url( $data['image']['url'] ),
									) );
								echo '</div>';
							}
							echo '<a href="'.esc_url($data['button_link']).'" class="icon-btn"><i class="far fa-arrow-up-right"></i></a>';
							echo '<div class="project-content">';
								echo '<div class="project-details">';
									if( !empty( $data['subtitle'] ) ){
										echo '<p class="project-subtitle subtitle-selector">'.esc_html($data['subtitle']).'</p>';
									}
									if( !empty( $data['title'] ) ){
										echo '<h3 class="project-title title-selector"><a href="'.esc_url($data['button_link']).'">'.esc_html($data['title']).'</a></h3>';
									}
								echo '</div>';
							echo '</div>';
						echo '</div>';
					echo '</div>';
				}
			echo '</div>';

		}


	}
}