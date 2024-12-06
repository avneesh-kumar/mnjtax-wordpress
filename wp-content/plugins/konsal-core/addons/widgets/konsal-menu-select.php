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
 * Menu Select Widget .
 *
 */
class konsal_Menu extends Widget_Base {

	public function get_name() {
		return 'konsalmenuselect';
	} 
	public function get_title() {
		return __( 'Menu Select', 'konsal' );
	}
	public function get_icon() {
		return 'th-icon';
    }
	public function get_categories() {
		return [ 'konsal' ];
	}

	protected function register_controls() {

		 $this->start_controls_section(
			'menu_section',
			[
				'label'		 	=> __( 'Navigation Menu', 'konsal' ),
				'tab' 			=> Controls_Manager::TAB_CONTENT,
			]
        );

        $this->add_control(
			'layout_style',
			[
				'label' 		=> __( 'Layout Style', 'konsal' ),
				'type' 			=> Controls_Manager::SELECT,
				'default' 		=> 'two',
				'options' 		=> [
					'one'  		=> __( 'Style One', 'konsal' ),
					'two'  		=> __( 'Style Two', 'konsal' ),
					'three'  	=> __( 'Style Three', 'konsal' ),
				]
			]
		);

        $this->add_control(
            'title', [
                'label' 		=> __( 'Title', 'konsal' ),
                'type' 			=> \Elementor\Controls_Manager::TEXTAREA,
                'default' 		=> __( 'Title' , 'konsal' ),
                'rows' 			=> 2,
                'condition'	=> [
                    'layout_style' => ['two']
                ]
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

        $this->end_controls_section();

        //---------------------------------------
			//Style Section Start
		//---------------------------------------


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

        //Menu by menu select
        $konsal_avaiable_menu   = $this->konsal_menu_select();

        if( ! $konsal_avaiable_menu ){
            return;
        }
        $args = [
            'menu' 		=> $settings['konsal_menu_select'],
            'menu_class' 	=> 'konsal-menu',
            'container' 	=> '',
        ];

        if( $settings['layout_style'] == 'one' ){
            if( ! empty( $settings['konsal_menu_select'] ) ){
                wp_nav_menu( $args );
            } 

        }elseif( $settings['layout_style'] == 'two' ){
            echo '<div class="widget widget_nav_menu footer-widget">';
                if( ! empty( $settings['title'] ) ){
                    echo '<h3 class="widget_title">'.esc_html( $settings['title'] ).'</h3>';
                }
                echo '<div class="menu-all-pages-container">';
                    if( ! empty( $settings['konsal_menu_select'] ) ){
                        wp_nav_menu( $args );
                    } 
                echo '</div>';
            echo '</div>';

        }elseif( $settings['layout_style'] == 'three' ){
            echo '<div class="footer-links">';
                if( ! empty( $settings['konsal_menu_select'] ) ){
                    wp_nav_menu( $args );
                } 
           echo '</div>';

        }


	}

}