<?php
/**
 * @Packge     : Konsal
 * @Version    : 1.0
 * @Author     : Themeholy
 * @Author URI : https://www.themeholy.com/
 *
 */

// Block direct access
if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

/**
 * Include File
 *
 */

// Constants
require_once get_parent_theme_file_path() . '/inc/konsal-constants.php';

//theme setup
require_once KONSAL_DIR_PATH_INC . 'theme-setup.php';

//essential scripts
require_once KONSAL_DIR_PATH_INC . 'essential-scripts.php';

// Woo Hooks
require_once KONSAL_DIR_PATH_INC . 'woo-hooks/konsal-woo-hooks.php';

// Woo Hooks Functions
require_once KONSAL_DIR_PATH_INC . 'woo-hooks/konsal-woo-hooks-functions.php';

// plugin activation
require_once KONSAL_DIR_PATH_FRAM . 'plugins-activation/konsal-active-plugins.php';

// theme dynamic css
require_once KONSAL_DIR_PATH_INC . 'konsal-commoncss.php';

// meta options
require_once KONSAL_DIR_PATH_FRAM . 'konsal-meta/konsal-config.php';

// page breadcrumbs
require_once KONSAL_DIR_PATH_INC . 'konsal-breadcrumbs.php';

// sidebar register
require_once KONSAL_DIR_PATH_INC . 'konsal-widgets-reg.php';

//essential functions
require_once KONSAL_DIR_PATH_INC . 'konsal-functions.php';

// helper function
require_once KONSAL_DIR_PATH_INC . 'wp-html-helper.php';

// Demo Data
require_once KONSAL_DEMO_DIR_PATH . 'demo-import.php';

// pagination
require_once KONSAL_DIR_PATH_INC . 'wp_bootstrap_pagination.php';

// konsal options
require_once KONSAL_DIR_PATH_FRAM . 'konsal-options/konsal-options.php';

// hooks
require_once KONSAL_DIR_PATH_HOOKS . 'hooks.php';

// hooks funtion
require_once KONSAL_DIR_PATH_HOOKS . 'hooks-functions.php';