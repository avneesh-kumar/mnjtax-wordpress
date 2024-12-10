<?php
/**
 * @Packge     : Konsal
 * @Version    : 1.0
 * @Author     : Themeholy
 * @Author URI : https://www.themeholy.com/
 *
 */

// Block direct access
if ( !defined( 'ABSPATH' ) ) {
    exit;
}

/**
 *
 * Define constant
 *
 */

// Base URI
if ( ! defined( 'KONSAL_DIR_URI' ) ) {
    define('KONSAL_DIR_URI', get_parent_theme_file_uri().'/' );
}

// Assist URI
if ( ! defined( 'KONSAL_DIR_ASSIST_URI' ) ) {
    define( 'KONSAL_DIR_ASSIST_URI', get_theme_file_uri('/assets/') );
}


// Css File URI
if ( ! defined( 'KONSAL_DIR_CSS_URI' ) ) {
    define( 'KONSAL_DIR_CSS_URI', get_theme_file_uri('/assets/css/') );
}

// Js File URI
if (!defined('KONSAL_DIR_JS_URI')) {
    define('KONSAL_DIR_JS_URI', get_theme_file_uri('/assets/js/'));
}


// Base Directory
if (!defined('KONSAL_DIR_PATH')) {
    define('KONSAL_DIR_PATH', get_parent_theme_file_path() . '/');
}

//Inc Folder Directory
if (!defined('KONSAL_DIR_PATH_INC')) {
    define('KONSAL_DIR_PATH_INC', KONSAL_DIR_PATH . 'inc/');
}

//KONSAL framework Folder Directory
if (!defined('KONSAL_DIR_PATH_FRAM')) {
    define('KONSAL_DIR_PATH_FRAM', KONSAL_DIR_PATH_INC . 'konsal-framework/');
}

//Hooks Folder Directory
if (!defined('KONSAL_DIR_PATH_HOOKS')) {
    define('KONSAL_DIR_PATH_HOOKS', KONSAL_DIR_PATH_INC . 'hooks/');
}

//Demo Data Folder Directory Path
if( !defined( 'KONSAL_DEMO_DIR_PATH' ) ){
    define( 'KONSAL_DEMO_DIR_PATH', KONSAL_DIR_PATH_INC.'demo-data/' );
}
    
//Demo Data Folder Directory URI
if( !defined( 'KONSAL_DEMO_DIR_URI' ) ){
    define( 'KONSAL_DEMO_DIR_URI', KONSAL_DIR_URI.'inc/demo-data/' );
}