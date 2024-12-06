<?php
// Do not allow directly accessing this file.
if ( ! defined( 'ABSPATH' ) ) {
    exit( );
}
/**
 * @Packge    : konsal
 * @version   : 1.0
 * @Author    : Themeholy
 * @Author URI: https://www.themeholy.com/
 */

// demo import file
function konsal_import_files() {

	$demoImg = '<img src="'. KONSAL_DEMO_DIR_URI  .'screenshot.png" alt="'.esc_attr__('Demo Preview Imgae','konsal').'" />';

    return array(
        array(
            'import_file_name'             => esc_html__('Konsal Demo','konsal'),
            'local_import_file'            =>  KONSAL_DEMO_DIR_PATH  . 'konsal-demo.xml',
            'local_import_widget_file'     =>  KONSAL_DEMO_DIR_PATH  . 'konsal-widgets-demo.json',
            'local_import_redux'           => array(
                array(
                    'file_path'   =>  KONSAL_DEMO_DIR_PATH . 'redux_options_demo.json',
                    'option_name' => 'konsal_opt',
                ),
            ),
            'import_notice' => $demoImg,
        ),
    );
}
add_filter( 'pt-ocdi/import_files', 'konsal_import_files' );

// demo import setup
function konsal_after_import_setup() {
	// Assign menus to their locations.

	$primary_menu  		= get_term_by( 'name', 'Primary Menu', 'nav_menu' );
	$footer_menu  		= get_term_by( 'name', 'Footer Menu', 'nav_menu' );

	set_theme_mod( 'nav_menu_locations', array(
			'primary-menu'   	=> $primary_menu->term_id,
			'footer-menu'   	=> $footer_menu->term_id,
		)
	);

	// Assign front page and posts page (blog page).
	$front_page_id 	= get_page_by_title( 'Home Business Consult' );
	$blog_page_id  	= get_page_by_title( 'Blog' );

	update_option( 'show_on_front', 'page' );
	update_option( 'page_on_front', $front_page_id->ID );
	update_option( 'page_for_posts', $blog_page_id->ID );

    
}
add_action( 'pt-ocdi/after_import', 'konsal_after_import_setup' );


//disable the branding notice after successful demo import
add_filter( 'pt-ocdi/disable_pt_branding', '__return_true' );

//change the location, title and other parameters of the plugin page
function konsal_import_plugin_page_setup( $default_settings ) {
	$default_settings['parent_slug'] = 'themes.php';
	$default_settings['page_title']  = esc_html__( 'Konsal Demo Import' , 'konsal' );
	$default_settings['menu_title']  = esc_html__( 'Import Demo Data' , 'konsal' );
	$default_settings['capability']  = 'import';
	$default_settings['menu_slug']   = 'konsal-demo-import';

	return $default_settings;
}
add_filter( 'pt-ocdi/plugin_page_setup', 'konsal_import_plugin_page_setup' );

// Enqueue scripts
function konsal_demo_import_custom_scripts(){
	if( isset( $_GET['page'] ) && $_GET['page'] == 'konsal-demo-import' ){
		// style
		wp_enqueue_style( 'konsal-demo-import', KONSAL_DEMO_DIR_URI.'css/konsal.demo.import.css', array(), '1.0', false );
	}
}
add_action( 'admin_enqueue_scripts', 'konsal_demo_import_custom_scripts' );