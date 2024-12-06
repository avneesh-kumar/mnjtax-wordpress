<?php

use \Elementor\Widget_Base;
use \Elementor\Controls_Manager;
use \Elementor\Group_Control_Typography;
use \Elementor\Repeater;
use \Elementor\Utils;
use \Elementor\Group_Control_Background;
use \Elementor\Group_Control_Text_Shadow;
use \Elementor\Group_Control_Border;
use \Elementor\Group_Control_Box_Shadow;
/**
 *
 * Header Widget .
 *
 */
class Konsal_Header2 extends Widget_Base {

	public function get_name() {
		return 'konsalheader2';
	}
	public function get_title() {
		return __( 'Header V2', 'konsal' );
	}
	public function get_icon() {
		return 'th-icon';
    }
	public function get_categories() {
		return [ 'konsal_header_elements' ];
	}
	
	protected function register_controls() {

		$this->start_controls_section(
			'header_section',
			[
				'label' 	=> __( 'Header', 'konsal' ),
				'tab' 		=> Controls_Manager::TAB_CONTENT,
			]
        );
        $this->add_control(
			'layout_style',
			[
				'label' 		=> __( 'Layout Style', 'konsal' ),
				'type' 			=> Controls_Manager::SELECT,
				'default' 		=> '1',
				'options' 		=> [
					'1'  		=> __( 'Style One', 'konsal' ),
					'2'  		=> __( 'Style Two', 'konsal' ),
				],
			]
		);

		//----------------------------maim menu control----------------------------//
		$this->add_control(
			'logo_image',

			[
				'label' 		=> __( 'Upload Logo', 'konsal' ),
				'type' 			=> Controls_Manager::MEDIA,
				'default' 		=> [
					'url' => Utils::get_placeholder_image_src(),
				],
			]
		);
		
		$menus = $this->konsal_menu_select();

		if( !empty( $menus ) ){
	        $this->add_control(
				'konsal_menu_select',
				[
					'label'     	=> __( 'Select konsal Menu', 'konsal' ),
					'type'      	=> Controls_Manager::SELECT,
					'options'   	=> $menus,
					'description' 	=> sprintf( __( 'Go to the <a href="%s" target="_blank">Menus screen</a> to manage your menus.', 'konsal' ), admin_url( 'nav-menus.php' ) ),
				]
			);
		}else {
			$this->add_control(
				'no_menu',
				[
					'type' 				=> Controls_Manager::RAW_HTML,
					'raw' 				=> '<strong>' . __( 'There are no menus in your site.', 'konsal' ) . '</strong><br>' . sprintf( __( 'Go to the <a href="%s" target="_blank">Menus screen</a> to create one.', 'konsal' ), admin_url( 'nav-menus.php?action=edit&menu=0' ) ),
					'separator' 		=> 'after',
					'content_classes' 	=> 'elementor-panel-alert elementor-panel-alert-info',
				]
			);
		}

		$this->add_control(
			'show_search_btn',
			[
				'label' 		=> __( 'Show Search?', 'konsal' ),
				'type' 			=> Controls_Manager::SWITCHER,
				'label_on' 		=> __( 'Show', 'konsal' ),
				'label_off' 	=> __( 'Hide', 'konsal' ),
				'return_value' 	=> 'yes',
				'default' 		=> 'yes',
			]
		);
		$this->add_control(
			'show_cart_btn',
			[
				'label' 		=> __( 'Show Cart?', 'konsal' ),
				'type' 			=> Controls_Manager::SWITCHER,
				'label_on' 		=> __( 'Show', 'konsal' ),
				'label_off' 	=> __( 'Hide', 'konsal' ),
				'return_value' 	=> 'yes',
				'default' 		=> 'yes',
			]
		);
		$this->add_control(
			'show_offcanvas_btn',
			[
				'label' 		=> __( 'Show Offcanvas?', 'konsal' ),
				'type' 			=> Controls_Manager::SWITCHER,
				'label_on' 		=> __( 'Show', 'konsal' ),
				'label_off' 	=> __( 'Hide', 'konsal' ),
				'return_value' 	=> 'yes',
				'default' 		=> 'yes',
			]
		);
		$this->add_control(
			'button_text',
			[
				'label' 		=> __( 'Button Text', 'konsal' ),
				'type' 			=> Controls_Manager::TEXT,
				'default' 		=> __( 'Button Text' , 'konsal' ),
				'label_block' => true,
			]
		);
		$this->add_control(
			'button_url',
			[
				'label' 		=> esc_html__( 'Button Link', 'konsal' ),
				'type' 			=> Controls_Manager::URL,
				'placeholder' 	=> esc_html__( 'https://your-link.com', 'konsal' ),
				'show_external' => true,
				'default' 		=> [
					'url' 			=> '#',
					'is_external' 	=> false,
					'nofollow' 		=> false,
				],
			]
		);

        $this->end_controls_section();
       
        //-----------------------------------General Styling-------------------------------------//
         $this->start_controls_section(
			'general_styling',
			[
				'label'     => __( 'General Styling', 'konsal' ),
				'tab'       => Controls_Manager::TAB_STYLE,
			]
        );
             
        $this->add_control(
			'general_menu_color',
			[
				'label' 		=> __( 'Menu Background Color', 'konsal' ),
				'type' 			=> Controls_Manager::COLOR,
				'selectors' 	=> [
					'{{WRAPPER}} .menu-area' => 'background-color: {{VALUE}} !important;',
                ]
			]
        );

        $this->end_controls_section();

        //-----------------------------------Menubar Styling-------------------------------------//
        $this->start_controls_section(
			'menubar_styling',
			[
				'label'     => __( 'Menu Styling', 'konsal' ),
				'tab'       => Controls_Manager::TAB_STYLE,
			]
        );
        $this->add_control(
			'menu_etxt_color',
			[
				'label' 			=> __( 'Menu Text Color', 'konsal' ),
				'type' 				=> Controls_Manager::COLOR,
				'selectors' 		=> [
					'{{WRAPPER}} .main-menu>ul>li>a' => 'color: {{VALUE}} !important;',
                ]
			]
        );
        $this->add_control(
			'menu_text_hover_color',
			[
				'label' 			=> __( 'Menu Hover Color', 'konsal' ),
				'type' 				=> Controls_Manager::COLOR,
				'selectors' 		=> [
					'{{WRAPPER}} .main-menu>ul>li>a:hover' => 'color: {{VALUE}} !important;',
                ]
			]
        );
        $this->add_control(
			'dropdown_txt_color',
			[
				'label' 			=> __( 'Dropdown Text Color', 'konsal' ),
				'type' 				=> Controls_Manager::COLOR,
				'selectors' 		=> [
					'{{WRAPPER}} .main-menu ul.sub-menu li a' => 'color: {{VALUE}} !important;',
                ]
			]
        );
        $this->add_control(
			'dropdown_txt_hover_color',
			[
				'label' 			=> __( 'Dropdown Hover Color', 'konsal' ),
				'type' 				=> Controls_Manager::COLOR,
				'selectors' 		=> [
					'{{WRAPPER}} .main-menu ul.sub-menu li a:hover' => 'color: {{VALUE}} !important;',
                ]
			]
        );
		$this->add_control(
			'dropdown_icon_color',
			[
				'label' 			=> __( 'Dropdown Icon Color', 'konsal' ),
				'type' 				=> Controls_Manager::COLOR,
				'selectors' 		=> [
					'{{WRAPPER}} .main-menu ul.sub-menu li a:before, {{WRAPPER}} .main-menu ul li.menu-item-has-children > a:after' => 'color: {{VALUE}} !important;',
                ]
			]
        );
        $this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' 			=> 'menu_typography',
				'label' 		=> __( 'Menu Typography', 'konsal' ),
                'selector' 		=> '{{WRAPPER}} .main-menu>ul>li>a, {{WRAPPER}} .main-menu ul.sub-menu li a',
			]
		);
        $this->add_responsive_control(
			'menu_margin',
			[
				'label' 		=> __( 'Menu Margin', 'konsal' ),
				'type' 			=> Controls_Manager::DIMENSIONS,
				'size_units' 	=> [ 'px', '%', 'em' ],
				'selectors' 	=> [
					'{{WRAPPER}} .main-menu>ul>li>a' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}} !important;',
                ]
			]
        );
        $this->add_responsive_control(
			'menu_padding',
			[
				'label' 		=> __( 'Menu Padding', 'konsal' ),
				'type' 			=> Controls_Manager::DIMENSIONS,
				'size_units' 	=> [ 'px', '%', 'em' ],
				'selectors' 	=> [
					'{{WRAPPER}} .main-menu>ul>li>a' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}} !important;',
                ]
			]
		);

		$this->end_controls_section();

        //---------Button Style---------//
		konsal_button_style_fields( $this, '1', 'Button Style', '{{WRAPPER}} .th-btn', ['1', '2'] );


    }

    public function konsal_menu_select(){
	    $konsal_menu = wp_get_nav_menus();
	    $menu_array  = array();
		$menu_array[''] = __( 'Select A Menu', 'konsal' );
	    foreach( $konsal_menu as $menu ){
	        $menu_array[ $menu->slug ] = $menu->name;
	    }
	    return $menu_array;
	}

	protected function render() {

        $settings = $this->get_settings_for_display();


        $konsal_avaiable_menu   = $this->konsal_menu_select();

		if( ! $konsal_avaiable_menu ){
			return;
		}

		$args = [
			'menu' 			=> $settings['konsal_menu_select'],
			'menu_class' 	=> 'konsal-menu',
			'container' 	=> '',
		];

        if( class_exists( 'woocommerce' ) ){
    		global $woocommerce;
            if( ! empty( $woocommerce->cart->cart_contents_count ) ){
              $count = $woocommerce->cart->cart_contents_count;
            }else{
              $count = "0";
            } 
    	}
 
		// Header sub-menu icon / Sticky header
		if( class_exists( 'ReduxFramework' ) ){ 
			if(konsal_opt('konsal_header_sticky')){
				$sticky = '';
			}else{
				$sticky = '-no';
			}

			if(konsal_opt('konsal_menu_icon')){
				$menu_icon = '';
			}else{
				$menu_icon = 'hide-icon';
			}
		}

	    echo konsal_mobile_menu();
	    echo konsal_search_box(); 
		echo konsal_offcanvas_box();
		echo konsal_cart_box();

    	if($settings['layout_style'] == 1 ){
			echo '<div class="th-header header-layout4">';
				echo '<div class="sticky-wrapper'.esc_attr($sticky).'">';
                    echo '<!-- Main Menu Area -->';
                    echo '<div class="menu-area">';
                        echo '<div class="container">';
                            echo '<div class="row align-items-center justify-content-between">';
                                if( ! empty( $settings['logo_image']['url'] ) ){
									echo '<div class="col-auto">';
										echo '<div class="header-logo">';
											echo '<a href="'.esc_url( home_url( '/' ) ).'"><img src="'.esc_url( $settings['logo_image']['url'] ).'" alt="Konsal"></a>';
										echo '</div>';
									echo '</div>';
								}
                                echo '<div class="col-auto">';
                                    echo '<nav class="main-menu d-none d-lg-inline-block '.esc_attr($menu_icon).'">';
                                        if( ! empty( $settings['konsal_menu_select'] ) ){
                                            wp_nav_menu( $args );
                                        } 
                                    echo '</nav>';
                                    echo '<div class="header-button d-flex d-lg-none">';
                                        if( $settings['show_cart_btn'] == 'yes' ){
                                            echo '<button type="button" class="simple-icon sideMenuToggler">';
                                                echo '<span class="badge">'.esc_html($count).'</span>';
                                                echo '<i class="fa-regular fa-cart-shopping"></i>';
                                            echo '</button>';
                                        }
                                        echo '<button type="button" class="th-menu-toggle d-block d-lg-none"><i class="far fa-bars"></i></button>';
                                    echo '</div>';
                                echo '</div>';
                                echo '<div class="col-auto d-none d-xl-block">';
                                    echo '<div class="header-button">';
                                        if( $settings['show_search_btn'] == 'yes' ){
                                            echo '<button type="button" class="simple-icon searchBoxToggler"><i class="far fa-search"></i></button>';
                                        }
                                        if( $settings['show_cart_btn'] == 'yes' ){
                                            echo '<button type="button" class="simple-icon sideMenuToggler">';
                                                echo '<span class="badge">'.esc_html($count).'</span>';
                                                echo '<i class="fa-regular fa-cart-shopping"></i>';
                                            echo '</button>';
                                        }
                                        if( $settings['show_offcanvas_btn'] == 'yes' ){
                                            echo '<button type="button" class="simple-icon sideMenuInfo"><i class="fa-solid fa-bars"></i></button>';
                                        }
                                        if(!empty($settings['button_text'])){
											echo '<div class="d-xxl-block d-none">';
												echo '<a href="'.esc_url( $settings['button_url']['url'] ).'" class="th-btn style3">'.esc_html($settings['button_text']).'<i class="fas fa-arrow-right ms-2"></i></a>'; 
											echo '</div>    ';
										 }
                                    echo '</div>';
                                echo '</div>';
                            echo '</div>';
                        echo '</div>';
                    echo '</div>';
                echo '</div>';
            echo '</div>';

		}elseif($settings['layout_style'] == 2 ){
			echo '<div class="th-header header-layout6">';
				echo '<div class="sticky-wrapper'.esc_attr($sticky).'">';
					echo '<!-- Main Menu Area -->';
					echo '<div class="menu-area">';
						echo '<div class="container">';
							echo '<div class="row align-items-center justify-content-between">';
								if( ! empty( $settings['logo_image']['url'] ) ){
									echo '<div class="col-auto">';
										echo '<div class="header-logo">';
											echo '<a href="'.esc_url( home_url( '/' ) ).'"><img src="'.esc_url( $settings['logo_image']['url'] ).'" alt="Konsal"></a>';
										echo '</div>';
									echo '</div>';
								}
								echo '<div class="col-auto">';
									echo '<nav class="main-menu d-none d-lg-inline-block '.esc_attr($menu_icon).'">';
										if( ! empty( $settings['konsal_menu_select'] ) ){
											wp_nav_menu( $args );
										} 
									echo '</nav>';
									echo '<div class="header-button d-flex d-lg-none">';
										if( $settings['show_cart_btn'] == 'yes' ){
                                            echo '<button type="button" class="simple-icon sideMenuToggler">';
                                                echo '<span class="badge">'.esc_html($count).'</span>';
                                                echo '<i class="fa-regular fa-cart-shopping"></i>';
                                            echo '</button>';
                                        }
										echo '<button type="button" class="th-menu-toggle d-block d-lg-none"><i class="far fa-bars"></i></button>';
									echo '</div>';
								echo '</div>';
								echo '<div class="col-auto d-none d-xl-block">';
									echo '<div class="header-button">';
										if( $settings['show_search_btn'] == 'yes' ){
                                            echo '<button type="button" class="simple-icon searchBoxToggler"><i class="far fa-search"></i></button>';
                                        }
										if( $settings['show_cart_btn'] == 'yes' ){
                                            echo '<button type="button" class="simple-icon sideMenuToggler">';
                                                echo '<span class="badge">'.esc_html($count).'</span>';
                                                echo '<i class="fa-regular fa-cart-shopping"></i>';
                                            echo '</button>';
                                        }
										if( $settings['show_offcanvas_btn'] == 'yes' ){
                                            echo '<button type="button" class="simple-icon sideMenuInfo"><i class="fa-solid fa-bars"></i></button>';
                                        }
										if(!empty($settings['button_text'])){
											echo '<div class="d-xxl-block d-none">';
												echo '<a href="'.esc_url( $settings['button_url']['url'] ).'" class="th-btn style8">'.esc_html($settings['button_text']).'<i class="fas fa-arrow-right ms-3"></i></a>'; 
											echo '</div>    ';
										 }
									echo '</div>';
								echo '</div>';
							echo '</div>';
						echo '</div>';
					echo '</div>';
				echo '</div>';
			echo '</div>';
				
		}


	}
}