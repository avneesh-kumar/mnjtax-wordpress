<?php
/**

 * Plugin Name: Konsal Core
 * Description: This is a helper plugin of konsal theme
 * Version:     1.0
 * Author:      Themeholy
 * Author URI:  http://themeholy.com/
 * License:     GPL2
 * License URI: https://www.gnu.org/licenses/gpl-2.0.html
 * Domain Path: /languages
 * Text Domain: konsal
 */



 // Blocking direct access

if( ! defined( 'ABSPATH' ) ) {

    exit();

}


// Define Constant
define( 'KONSAL_PLUGIN_PATH', plugin_dir_path( __FILE__ ) );

define( 'KONSAL_PLUGIN_INC_PATH', plugin_dir_path( __FILE__ ) . 'inc/' );
define( 'KONSAL_PLUGIN_CMB2EXT_PATH', plugin_dir_path( __FILE__ ) . 'cmb2-ext/' );

define( 'KONSAL_PLUGIN_WIDGET_PATH', plugin_dir_path( __FILE__ ) . 'inc/widgets/' );

define( 'KONSAL_PLUGDIRURI', plugin_dir_url( __FILE__ ) );

define( 'KONSAL_ADDONS', plugin_dir_path( __FILE__ ) .'addons/' );

define( 'KONSAL_ASSETS', plugin_dir_url( __FILE__ ) .'assets/' );

define( 'KONSAL_CORE_PLUGIN_TEMP', plugin_dir_path( __FILE__ ) .'konsal-template/' );



// load textdomain

load_plugin_textdomain( 'konsal', false, basename( dirname( __FILE__ ) ) . '/languages' );



//include file.
require_once KONSAL_PLUGIN_INC_PATH .'konsalcore-functions.php';
require_once KONSAL_PLUGIN_INC_PATH .'builder/builder.php';
require_once KONSAL_PLUGIN_INC_PATH . 'MCAPI.class.php';
require_once KONSAL_PLUGIN_INC_PATH .'konsalajax.php';
require_once KONSAL_PLUGIN_INC_PATH .'konsal-elementor-functions.php';

require_once KONSAL_PLUGIN_CMB2EXT_PATH . 'cmb2ext-init.php';

//Widget
require_once KONSAL_PLUGIN_WIDGET_PATH . 'recent-post-widget.php';
require_once KONSAL_PLUGIN_WIDGET_PATH . 'working-hours.php';
require_once KONSAL_PLUGIN_WIDGET_PATH . 'about-us-widget.php';
require_once KONSAL_PLUGIN_WIDGET_PATH . 'konsal-cta.php';
require_once KONSAL_PLUGIN_WIDGET_PATH . 'search-form.php';
require_once KONSAL_PLUGIN_WIDGET_PATH . 'category-lists.php';

//addons
require_once KONSAL_ADDONS . 'addons.php';
require_once KONSAL_ADDONS . 'addons-style-functions.php';
require_once KONSAL_ADDONS . 'addons-field-functions.php';

// Register widget styles
add_action( 'elementor/editor/after_enqueue_scripts', 'widget_styles' );

function widget_styles() {

    wp_register_style( 'editor-style-1', plugins_url( 'assets/css/editor.css', __FILE__ ) );
    wp_enqueue_style( 'editor-style-1' );

}
