<?php
    /**
     * ReduxFramework Sample Config File
     * For full documentation, please visit: http://docs.reduxframework.com/
     */

    if ( ! class_exists( 'Redux' ) ) {
        return;
    }

    // This is your option name where all the Redux data is stored.
    $opt_name = "konsal_opt";

    // This line is only for altering the demo. Can be easily removed.
    $opt_name = apply_filters( 'redux_demo/opt_name', $opt_name );

    /*
     *
     * --> Used within different fields. Simply examples. Search for ACTUAL DECLARATION for field examples
     *
     */

    $sampleHTML = '';
    if ( file_exists( dirname( __FILE__ ) . '/info-html.html' ) ) {
        Redux_Functions::initWpFilesystem();

        global $wp_filesystem;

        $sampleHTML = $wp_filesystem->get_contents( dirname( __FILE__ ) . '/info-html.html' );
    }


    $alowhtml = array(
        'p' => array(
            'class' => array()
        ),
        'span' => array()
    );


    // Background Patterns Reader
    $sample_patterns_path = ReduxFramework::$_dir . '../sample/patterns/';
    $sample_patterns_url  = ReduxFramework::$_url . '../sample/patterns/';
    $sample_patterns      = array();

    if ( is_dir( $sample_patterns_path ) ) {

        if ( $sample_patterns_dir = opendir( $sample_patterns_path ) ) {
            $sample_patterns = array();

            while ( ( $sample_patterns_file = readdir( $sample_patterns_dir ) ) !== false ) {

                if ( stristr( $sample_patterns_file, '.png' ) !== false || stristr( $sample_patterns_file, '.jpg' ) !== false ) {
                    $name              = explode( '.', $sample_patterns_file );
                    $name              = str_replace( '.' . end( $name ), '', $sample_patterns_file );
                    $sample_patterns[] = array(
                        'alt' => $name,
                        'img' => $sample_patterns_url . $sample_patterns_file
                    );
                }
            }
        }
    }

    /**
     * ---> SET ARGUMENTS
     * All the possible arguments for Redux.
     * For full documentation on arguments, please refer to: https://github.com/ReduxFramework/ReduxFramework/wiki/Arguments
     * */

    $theme = wp_get_theme(); // For use with some settings. Not necessary.

    $args = array(
        // TYPICAL -> Change these values as you need/desire
        'opt_name'             => $opt_name,
        // This is where your data is stored in the database and also becomes your global variable name.
        'display_name'         => $theme->get( 'Name' ),
        // Name that appears at the top of your panel
        'display_version'      => $theme->get( 'Version' ),
        // Version that appears at the top of your panel
        'menu_type'            => 'menu',
        //Specify if the admin menu should appear or not. Options: menu or submenu (Under appearance only)
        'allow_sub_menu'       => true,
        // Show the sections below the admin menu item or not
        'menu_title'           => esc_html__( 'Konsal Options', 'konsal' ),
        'page_title'           => esc_html__( 'Konsal Options', 'konsal' ),
        // You will need to generate a Google API key to use this feature.
        // Please visit: https://developers.google.com/fonts/docs/developer_api#Auth
        'google_api_key'       => '',
        // Set it you want google fonts to update weekly. A google_api_key value is required.
        'google_update_weekly' => false,
        // Must be defined to add google fonts to the typography module
        'async_typography'     => false,
        // Use a asynchronous font on the front end or font string
        //'disable_google_fonts_link' => true,                    // Disable this in case you want to create your own google fonts loader
        'admin_bar'            => true,
        // Show the panel pages on the admin bar
        'admin_bar_icon'       => 'dashicons-portfolio',
        // Choose an icon for the admin bar menu
        'admin_bar_priority'   => 50,
        // Choose an priority for the admin bar menu
        'global_variable'      => '',
        // Set a different name for your global variable other than the opt_name
        'dev_mode'             => false,
        // Show the time the page took to load, etc
        'update_notice'        => true,
        // If dev_mode is enabled, will notify developer of updated versions available in the GitHub Repo
        'customizer'           => true,
        // Enable basic customizer support
        //'open_expanded'     => true,                    // Allow you to start the panel in an expanded way initially.
        //'disable_save_warn' => true,                    // Disable the save warning when a user changes a field

        // OPTIONAL -> Give you extra features
        'page_priority'        => null,
        // Order where the menu appears in the admin area. If there is any conflict, something will not show. Warning.
        'page_parent'          => 'themes.php',
        // For a full list of options, visit: http://codex.wordpress.org/Function_Reference/add_submenu_page#Parameters
        'page_permissions'     => 'manage_options',
        // Permissions needed to access the options panel.
        'menu_icon'            => '',
        // Specify a custom URL to an icon
        'last_tab'             => '',
        // Force your panel to always open to a specific tab (by id)
        'page_icon'            => 'icon-themes',
        // Icon displayed in the admin panel next to your menu_title
        'page_slug'            => '',
        // Page slug used to denote the panel, will be based off page title then menu title then opt_name if not provided
        'save_defaults'        => true,
        // On load save the defaults to DB before user clicks save or not
        'default_show'         => false,
        // If true, shows the default value next to each field that is not the default value.
        'default_mark'         => '',
        // What to print by the field's title if the value shown is default. Suggested: *
        'show_import_export'   => true,
        // Shows the Import/Export panel when not used as a field.

        // CAREFUL -> These options are for advanced use only
        'transient_time'       => 60 * MINUTE_IN_SECONDS,
        'output'               => true,
        // Global shut-off for dynamic CSS output by the framework. Will also disable google fonts output
        'output_tag'           => true,
        // Allows dynamic CSS to be generated for customizer and google fonts, but stops the dynamic CSS from going to the head
        // 'footer_credit'     => '',                   // Disable the footer credit of Redux. Please leave if you can help it.

        // FUTURE -> Not in use yet, but reserved or partially implemented. Use at your own risk.
        'database'             => '',
        // possible: options, theme_mods, theme_mods_expanded, transient. Not fully functional, warning!
        'use_cdn'              => true,
        // If you prefer not to use the CDN for Select2, Ace Editor, and others, you may download the Redux Vendor Support plugin yourself and run locally or embed it in your code.

        // HINTS
        'hints'                => array(
            'icon'          => 'el el-question-sign',
            'icon_position' => 'right',
            'icon_color'    => 'lightgray',
            'icon_size'     => 'normal',
            'tip_style'     => array(
                'color'   => 'red',
                'shadow'  => true,
                'rounded' => false,
                'style'   => '',
            ),
            'tip_position'  => array(
                'my' => 'top left',
                'at' => 'bottom right',
            ),
            'tip_effect'    => array(
                'show' => array(
                    'effect'   => 'slide',
                    'duration' => '500',
                    'event'    => 'mouseover',
                ),
                'hide' => array(
                    'effect'   => 'slide',
                    'duration' => '500',
                    'event'    => 'click mouseleave',
                ),
            ),
        )
    );


    Redux::setArgs( $opt_name, $args );

    /*
     * ---> END ARGUMENTS
     */


    /*
     * ---> START HELP TABS
     */

    $tabs = array(
        array(
            'id'      => 'redux-help-tab-1',
            'title'   => esc_html__( 'Theme Information 1', 'konsal' ),
            'content' => esc_html__( '<p>This is the tab content, HTML is allowed.</p>', 'konsal' )
        ),
        array(
            'id'      => 'redux-help-tab-2',
            'title'   => esc_html__( 'Theme Information 2', 'konsal' ),
            'content' => esc_html__( '<p>This is the tab content, HTML is allowed.</p>', 'konsal' )
        )
    );
    Redux::set_help_tab( $opt_name, $tabs );

    // Set the help sidebar
    $content = esc_html__( '<p>This is the sidebar content, HTML is allowed.</p>', 'konsal' );
    Redux::set_help_sidebar( $opt_name, $content );


    /*
     * <--- END HELP TABS
     */


    /*
     *
     * ---> START SECTIONS
     *
     */


    // -> START General Fields

    Redux::setSection( $opt_name, array(
        'title'            => esc_html__( 'General', 'konsal' ),
        'id'               => 'konsal_general',
        'customizer_width' => '450px',
        'icon'             => 'el el-cog',
        'fields'           => array(
            array(
                'id'       => 'konsal_theme_color',
                'type'     => 'color',
                'title'    => esc_html__( 'Theme Color', 'konsal' ),
            ),
            array(
                'id'       => 'konsal_theme_color2',
                'type'     => 'color',
                'title'    => esc_html__( 'Theme Color 2', 'konsal' ),
            ),
            array(
                'id'       => 'konsal_heading_color',
                'type'     => 'color',
                'title'    => esc_html__( 'Heading Color (H1-H6)', 'konsal' ),
            ),
            array(
                'id'       => 'konsal_body_color',
                'type'     => 'color',
                'title'    => esc_html__( 'Body Color (Default Text Color)', 'konsal' ),
            ),
            array(
                'id'       => 'konsal_link_color',
                'type'     => 'link_color',
                'title'    => esc_html__( 'Links Color', 'konsal' ),
                'output'   => array( 'color'    =>  'a' ),
            ),
        )

    ) );

    Redux::setSection( $opt_name, array(
        'title'            => esc_html__( 'Typography', 'konsal' ),
        'id'               => 'konsal_typography',
        'subsection'       => true,
        'fields'           => array(
            array(
                'id'       => 'konsal_theme_body_font',
                'type'     => 'typography',
                'title'    => esc_html__( 'Body Font Family', 'konsal' ),
                'google'      => true, 
                'font-size' => false,
                'line-height' => false,
                'subsets' => false,
                'text-align' => false,
                'color' => false,
                'font-style' => false,
                'font-weight' => false,
                'output'      => array(''),
            ),
            array(
                'id'       => 'konsal_theme_heading_font',
                'type'     => 'typography',
                'title'    => esc_html__( 'Heading Font Family', 'konsal' ),
                'google'      => true, 
                'font-size' => false,
                'line-height' => false,
                'subsets' => false,
                'text-align' => false,
                'color' => false,
                'font-style' => false,
                'font-weight' => false,
                'output'      => array(''),
            ),
            array(
                'id'    => 'info_1',
                'type'  => 'info',
                'style' => 'success',
                'title' => __('Heading Fonts', 'konsal'),
            ),
            array(
                'id'       => 'konsal_theme_h1_font',
                'type'     => 'typography',
                'title'    => esc_html__( 'H1 Font', 'konsal' ),
                'google'      => true, 
                'font-style' => true,
                'text-transform' => true,
                'subsets' => false,
                'text-align' => false,
                'color' => true,
                'output'      => array('h1'),
            ),
            array(
                'id'       => 'konsal_theme_h2_font',
                'type'     => 'typography',
                'title'    => esc_html__( 'H2 Font', 'konsal' ),
                'google'      => true, 
                'font-style' => true,
                'text-transform' => true,
                'subsets' => false,
                'text-align' => false,
                'color' => true,
                'output'      => array('h2'),
            ),
            array(
                'id'       => 'konsal_theme_h3_font',
                'type'     => 'typography',
                'title'    => esc_html__( 'H3 Font', 'konsal' ),
                'google'      => true, 
                'font-style' => true,
                'text-transform' => true,
                'subsets' => false,
                'text-align' => false,
                'color' => true,
                'output'      => array('h3'),
            ),
            array(
                'id'       => 'konsal_theme_h4_font',
                'type'     => 'typography',
                'title'    => esc_html__( 'H4 Font', 'konsal' ),
                'google'      => true, 
                'font-style' => true,
                'text-transform' => true,
                'subsets' => false,
                'text-align' => false,
                'color' => true,
                'output'      => array('h4'),
            ),
            array(
                'id'       => 'konsal_theme_h5_font',
                'type'     => 'typography',
                'title'    => esc_html__( 'H5 Font', 'konsal' ),
                'google'      => true, 
                'font-style' => true,
                'text-transform' => true,
                'subsets' => false,
                'text-align' => false,
                'color' => true,
                'output'      => array('h5'),
            ),
            array(
                'id'       => 'konsal_theme_h6_font',
                'type'     => 'typography',
                'title'    => esc_html__( 'H6 Font', 'konsal' ),
                'google'      => true, 
                'font-style' => true,
                'text-transform' => true,
                'subsets' => false,
                'text-align' => false,
                'color' => true,
                'output'      => array('h6'),
            ),
            array(
                'id'    => 'info_2',
                'type'  => 'info',
                'style' => 'success',
                'title' => __('Paragraph Fonts', 'konsal'),
            ),
            array(
                'id'       => 'konsal_theme_p_font',
                'type'     => 'typography',
                'title'    => esc_html__( 'P Font', 'konsal' ),
                'google'      => true, 
                'font-style' => true,
                'text-transform' => true,
                'subsets' => false,
                'text-align' => false,
                'color' => true,
                'output'      => array('p'),
            ),
           
        )
    ) );

    Redux::setSection( $opt_name, array(
        'title'            => esc_html__( 'Back To Top', 'konsal' ),
        'id'               => 'konsal_backtotop',
        'subsection'       => true,
        'fields'           => array(
            array(
                'id'       => 'konsal_display_bcktotop',
                'type'     => 'switch',
                'title'    => esc_html__( 'Back To Top Button', 'konsal' ),
                'subtitle' => esc_html__( 'Switch On to Display back to top button.', 'konsal' ),
                'default'  => true,
                'on'       => esc_html__( 'Enabled', 'konsal' ),
                'off'      => esc_html__( 'Disabled', 'konsal' ),
            ),
            array(
                'id'       => 'konsal_bcktotop_color',
                'type'     => 'color',
                'title'    => esc_html__( 'Color', 'konsal' ),
                'required' => array('konsal_display_bcktotop','equals','1'),
                'output'   => array( '--theme-color' =>'.scroll-top:after' ),
            ),
            array(
                'id'       => 'konsal_bcktotop_bg_color',
                'type'     => 'color',
                'title'    => esc_html__( 'Background Color', 'konsal' ),
                'required' => array('konsal_display_bcktotop','equals','1'),
                'output'   => array( 'background-color' =>'.scroll-top svg' ),
            ),
            array(
                'id'       => 'konsal_bcktotop_circle_color',
                'type'     => 'color',
                'title'    => esc_html__( 'Circle Scroll Color', 'konsal' ),
                'required' => array('konsal_display_bcktotop','equals','1'),
                'output'   => array( '--theme-color' =>'.scroll-top .progress-circle path' ),
            ),
        )
    ) );

    Redux::setSection( $opt_name, array(
        'title'            => esc_html__( 'Preloader', 'konsal' ),
        'id'               => 'konsal_preloader',
        'subsection'       => true,
        'fields'           => array(
            array(
                'id'       => 'konsal_display_preloader',
                'type'     => 'switch',
                'title'    => esc_html__( 'Preloader', 'konsal' ),
                'subtitle' => esc_html__( 'Switch Enabled to Display Preloader.', 'konsal' ),
                'default'  => true,
                'on'       => esc_html__('Enabled','konsal'),
                'off'      => esc_html__('Disabled','konsal'),
            ),

            array(
                'id'       => 'konsal_preloader_img',
                'type'     => 'media',
                'title'    => esc_html__( 'Preloader Image', 'konsal' ),
                'subtitle' => esc_html__( 'Set Preloader Image.', 'konsal' ),
                'required' => array( "konsal_display_preloader","equals",true )
            ),
        )
    ));

    /* End General Fields */

    /* Admin Lebel Fields */
    Redux::setSection( $opt_name, array(
        'title'             => esc_html__( 'Admin Label', 'konsal' ),
        'id'                => 'konsal_admin_label',
        'customizer_width'  => '450px',
        'subsection'        => true,
        'fields'            => array(
            array(
                'title'     => esc_html__( 'Admin Login Logo', 'konsal' ),
                'subtitle'  => esc_html__( 'It belongs to the back-end of your website to log-in to admin panel.', 'konsal' ),
                'id'        => 'konsal_admin_login_logo',
                'type'      => 'media',
            ),
            array(
                'title'     => esc_html__( 'Custom CSS For admin', 'konsal' ),
                'subtitle'  => esc_html__( 'Any CSS your write here will run in admin.', 'konsal' ),
                'id'        => 'konsal_theme_admin_custom_css',
                'type'      => 'ace_editor',
                'mode'      => 'css',
                'theme'     => 'chrome',
                'full_width'=> true,
            ),
        ),
    ) );

    // -> START Basic Fields
    Redux::setSection( $opt_name, array(
        'title'            => esc_html__( 'Header', 'konsal' ),
        'id'               => 'konsal_header',
        'customizer_width' => '400px',
        'icon'             => 'el el-credit-card',
        'fields'           => array(
            array(
                'id'       => 'konsal_header_options',
                'type'     => 'button_set',
                'default'  => '1',
                'options'  => array(
                    "1"   => esc_html__('Prebuilt','konsal'),
                    "2"      => esc_html__('Header Builder','konsal'),
                ),
                'title'    => esc_html__( 'Header Options', 'konsal' ),
                'subtitle' => esc_html__( 'Select header options.', 'konsal' ),
            ),
            array(
                'id'       => 'konsal_header_select_options',
                'type'     => 'select',
                'data'     => 'posts',
                'args'     => array(
                    'post_type'     => 'konsal_header'
                ),
                'title'    => esc_html__( 'Header', 'konsal' ),
                'subtitle' => esc_html__( 'Select header.', 'konsal' ),
                'required' => array( 'konsal_header_options', 'equals', '2' )
            ),
            array(
                'id'       => 'konsal_header_topbar_switcher',
                'type'     => 'switch',
                'default'  => 0,
                'on'       => esc_html__( 'Show', 'konsal' ),
                'off'      => esc_html__( 'Hide', 'konsal' ),
                'title'    => esc_html__( 'Header Topbar?', 'konsal' ),
                'subtitle' => esc_html__( 'Control Header Topbar By Show Or Hide System.', 'konsal'),
                'required' => array( 'konsal_header_options', 'equals', '1' )
            ),                    
            array(
                'id'       => 'konsal_header_topbar_social_icon_switcher',
                'type'     => 'switch',
                'default'  => 0,
                'on'       => esc_html__( 'Show', 'konsal' ),
                'off'      => esc_html__( 'Hide', 'konsal' ),
                'title'    => esc_html__( 'Header Social Icon?', 'konsal' ),
                'subtitle' => esc_html__( 'Click Show To Display Social Icon?', 'konsal'),
                'required' => array( 'konsal_header_topbar_switcher', 'equals', '1' )
            ),
            array(
                'id'       => 'konsal_header_topbar_language_switcher',
                'type'     => 'switch',
                'default'  => 0,
                'on'       => esc_html__( 'Show', 'konsal' ),
                'off'      => esc_html__( 'Hide', 'konsal' ),
                'title'    => esc_html__( 'Header Language Switcher?', 'konsal' ),
                'subtitle' => esc_html__( 'Click Show To Display Header Languages?', 'konsal'),
                'required' => array( 'konsal_header_topbar_switcher', 'equals', '1' )
            ),
            array(
                'id'       => 'konsal_menu_topbar_slogan',
                'type'     => 'text',
                'validate' => 'html',
                'title'    => esc_html__( 'Slogan :', 'konsal' ),
                'default'  => esc_html__( 'Welcome to our Konsal Company Consultation!', 'konsal' ),
                'required' => array( 'konsal_header_topbar_switcher', 'equals', '1' )
            ), 
            array(
                'id'       => 'konsal_topbar_phone_icon',
                'type'     => 'text',
                'validate' => 'html',
                'title'    => esc_html__( 'Phone Icon', 'konsal' ),
                'default'  => esc_html__( '', 'konsal' ),
                'required' => array( 'konsal_header_topbar_switcher', 'equals', '1' )
            ),
            array(
                'id'       => 'konsal_topbar_phone',
                'type'     => 'text',
                'validate' => 'html',
                'title'    => esc_html__( 'Phone Number', 'konsal' ),
                'default'  => esc_html__( '+1 (044) 123 456 789', 'konsal' ),
                'required' => array( 'konsal_header_topbar_switcher', 'equals', '1' )
            ),
            array(
                'id'       => 'konsal_topbar_email_icon',
                'type'     => 'text',
                'validate' => 'html',
                'title'    => esc_html__( 'Email Icon', 'konsal' ),
                'default'  => esc_html__( '', 'konsal' ),
                'required' => array( 'konsal_header_topbar_switcher', 'equals', '1' )
            ),
            array(
                'id'       => 'konsal_topbar_email',
                'type'     => 'text',
                'validate' => 'html',
                'title'    => esc_html__( 'Email Address :', 'konsal' ),
                'default'  => esc_html__( 'info@konsal.com', 'konsal' ),
                'required' => array( 'konsal_header_topbar_switcher', 'equals', '1' )
            ), 

            array(
                'id'       => 'konsal_header_search_switcher',
                'type'     => 'switch',
                'default'  => 0,
                'on'       => esc_html__( 'Show', 'konsal' ),
                'off'      => esc_html__( 'Hide', 'konsal' ),
                'title'    => esc_html__( 'Header Search Switcher?', 'konsal' ),
                'subtitle' => esc_html__( 'Click Show To Display Header Search?', 'konsal'),
            ),
            array(
                'id'       => 'konsal_header_cart_switcher',
                'type'     => 'switch',
                'default'  => 0,
                'on'       => esc_html__( 'Show', 'konsal' ),
                'off'      => esc_html__( 'Hide', 'konsal' ),
                'title'    => esc_html__( 'Header Cart Switcher?', 'konsal' ),
                'subtitle' => esc_html__( 'Click Show To Display Header Cart?', 'konsal'),
            ),
            array(
                'id'       => 'konsal_header_offcanvas_switcher',
                'type'     => 'switch',
                'default'  => 0,
                'on'       => esc_html__( 'Show', 'konsal' ),
                'off'      => esc_html__( 'Hide', 'konsal' ),
                'title'    => esc_html__( 'Header Offcanvas Switcher?', 'konsal' ),
                'subtitle' => esc_html__( 'Click Show To Display Header Offcanvas?', 'konsal'),
            ),
            array(
                'id'       => 'konsal_header_btn_text',
                'type'     => 'text',
                'validate' => 'html',
                'default'  => esc_html__( 'Appointment Now ', 'konsal' ),
                'title'    => esc_html__( 'Button Text', 'konsal' ),
                'subtitle' => esc_html__( 'Set Button Text', 'konsal' ),
            ),
            array(
                'id'       => 'konsal_btn_url',
                'type'     => 'text',
                'default'  => esc_html__( '#', 'konsal' ),
                'title'    => esc_html__( 'Button URL?', 'konsal' ),
                'subtitle' => esc_html__( 'Set Button URL Here', 'konsal' ),
            ),
        ),
    ) );
    // -> START Header Logo
    Redux::setSection( $opt_name, array(
        'title'            => esc_html__( 'Header Logo', 'konsal' ),
        'id'               => 'konsal_header_logo_option',
        'subsection'       => true,
        'fields'           => array(
            array(
                'id'       => 'konsal_site_logo',
                'type'     => 'media',
                'url'      => true,
                'title'    => esc_html__( 'Logo', 'konsal' ),
                'compiler' => 'true',
                'subtitle' => esc_html__( 'Upload your site logo for header ( recommendation png format ).', 'konsal' ),
            ),
            array(
                'id'       => 'konsal_site_logo_dimensions',
                'type'     => 'dimensions',
                'units'    => array('px'),
                'title'    => esc_html__('Logo Dimensions (Width/Height).', 'konsal'),
                'output'   => array('.header-logo .logo img'),
                'subtitle' => esc_html__('Set logo dimensions to choose width, height, and unit.', 'konsal'),
            ),
            array(
                'id'       => 'konsal_site_logomargin_dimensions',
                'type'     => 'spacing',
                'mode'     => 'margin',
                'output'   => array('.header-logo .logo img'),
                'units_extended' => 'false',
                'units'    => array('px'),
                'title'    => esc_html__('Logo Top and Bottom Margin.', 'konsal'),
                'left'     => false,
                'right'    => false,
                'subtitle' => esc_html__('Set logo top and bottom margin.', 'konsal'),
                'default'            => array(
                    'units'           => 'px'
                )
            ),
            array(
                'id'       => 'konsal_text_title',
                'type'     => 'text',
                'validate' => 'html',
                'title'    => esc_html__( 'Text Logo', 'konsal' ),
                'subtitle' => esc_html__( 'Write your logo text use as logo ( You can use span tag for text color ).', 'konsal' ),
            )
        )
    ) );
    // -> End Header Logo

    // -> START Header Menu
    Redux::setSection( $opt_name, array(
        'title'            => esc_html__( 'Header Style', 'konsal' ),
        'id'               => 'konsal_header_menu_option',
        'subsection'       => true,
        'fields'           => array(
            array(
                'id'    => 'sticky_info',
                'type'  => 'info',
                'style' => 'success',
                'title' => __('Header Sticky On/Off', 'konsal'),
            ),
            array(
                'id'       => 'konsal_header_sticky',
                'type'     => 'switch',
                'title'    => esc_html__( 'Header Sticky ON/OFF', 'konsal' ),
                'subtitle' => esc_html__( 'ON / OFF Header Sticky ( Default settings ON ).', 'konsal' ),
                'default'  => '1',
                'on'       => 'ON',
                'off'      => 'OFF',
            ),
            array( 
                'id'    => 'menu_icon_2',
                'type'  => 'info',
                'style' => 'success',
                'title' => __('Menu Icon', 'konsal'),
            ),
            array(
                'id'       => 'konsal_menu_icon',
                'type'     => 'switch',
                'title'    => esc_html__( 'Navbar Sub-menu Icon Hide/Show', 'konsal' ),
                'subtitle' => esc_html__( 'Hide / Show menu icon ( Default settings SHOW ).', 'konsal' ),
                'default'  => '1',
                'on'       => 'Show',
                'off'      => 'Hide',
            ),
            array(
                'id'       => 'konsal_menu_icon_class',
                'type'     => 'text',
                'validate' => 'html',
                'default'  => esc_html__( 'f0c6', 'konsal' ),
                'title'    => esc_html__( 'Sub Menu Icon', 'konsal' ),
                'subtitle' => esc_html__( 'If you change icon need to use Font-Awesome Unicode icon ( Example: f0c6 | f02d ).', 'konsal' ),
                'required' => array( 'konsal_menu_icon', 'equals', '1' )
            ),
            
            array(
                'id'    => 'info_2',
                'type'  => 'info',
                'style' => 'success',
                'title' => __('Background', 'konsal'),
            ),
            array(
                'id'       => 'konsal_header_topbar_bg',
                'type'     => 'color',
                'title'    => esc_html__( 'Header Topbar Backgound', 'konsal' ),
                'output'   => array( 'background-color'    =>  '.prebuilt .header-top' ),
            ),
            array(
                'id'       => 'konsal_header_menu_bg',
                'type'     => 'color',
                'title'    => esc_html__( 'Header Menu Backgound', 'konsal' ),
                'output'   => array( 'background-color'  =>  '.prebuilt .menu-area' ),
            ),
            array(
                'id'       => 'konsal_header_logo_bg',
                'type'     => 'color',
                'title'    => esc_html__( 'Header Logo Backgound', 'konsal' ),
                'output'   => array( 'background-color'  =>  '.prebuilt .logo-bg' ),
            ),
            array(
                'id'    => 'info_3',
                'type'  => 'info',
                'style' => 'success',
                'title' => __('Menu Style', 'konsal'),
            ),
            array(
                'id'       => 'konsal_header_menu_color',
                'type'     => 'color',
                'title'    => esc_html__( 'Menu Color', 'konsal' ),
                'output'   => array( 'color'    =>  '.prebuilt .main-menu>ul>li>a' ),
            ),
            array(
                'id'       => 'konsal_header_menu_hover_color',
                'type'     => 'color',
                'title'    => esc_html__( 'Menu Hover Color', 'konsal' ),
                'output'   => array( 'color'    =>  '.prebuilt .main-menu>ul>li>a:hover' ),
            ),
            array(
                'id'       => 'konsal_header_submenu_color',
                'type'     => 'color',
                'title'    => esc_html__( 'Submenu Color', 'konsal' ),
                'output'   => array( 'color'    =>  '.prebuilt .main-menu ul.sub-menu li a' ),
            ),
            array(
                'id'       => 'konsal_header_submenu_hover_color',
                'type'     => 'color',
                'title'    => esc_html__( 'Submenu Hover Color', 'konsal' ),
                'output'   => array( 'color'    =>  '.prebuilt .main-menu ul.sub-menu li a:hover' ),
            ),
            array(
                'id'       => 'konsal_header_submenu_icon_color',
                'type'     => 'color',
                'title'    => esc_html__( 'Submenu Icon Color', 'konsal' ),
                'output'   => array( 'color'    =>  '.prebuilt .main-menu ul.sub-menu li a:before, .prebuilt .main-menu ul li.menu-item-has-children > a:after' ),
            ),
            array(
                'id'    => 'info_4',
                'type'  => 'info',
                'style' => 'success',
                'title' => __('Button Style', 'konsal'),
            ),
            array(
                'id'       => 'konsal_btn_color',
                'type'     => 'color',
                'title'    => esc_html__( 'Button Color', 'konsal' ),
                'output'   => array( 'color'    =>  '.prebuilt .th-btn' ),
            ),
            array(
                'id'       => 'konsal_btn_hover_color',
                'type'     => 'color',
                'title'    => esc_html__( 'Button Hover Color', 'konsal' ),
                'output'   => array( 'color'    =>  '.prebuilt .th-btn:hover' ),
            ),
            array(
                'id'       => 'konsal_btn_bg_color',
                'type'     => 'color',
                'title'    => esc_html__( 'Button Background', 'konsal' ),
                'output'   => array( 'background'    =>  '.prebuilt .th-btn' ),
            ),
            array(
                'id'       => 'konsal_btn_bg_hover_color',
                'type'     => 'color',
                'title'    => esc_html__( 'Button Hover Background', 'konsal' ),
                'output'   => array( 'background'  =>  '.prebuilt .th-btn:before, .prebuilt .th-btn:after'),
            ),


        )
    ) );
    // -> End Header Menu

     // -> START Mobile Menu
     Redux::setSection( $opt_name, array(
        'title'            => esc_html__( 'Mobile Menu', 'konsal' ), 
        'id'               => 'konsal_mobile_menu_option',
        'subsection'       => true,
        'fields'           => array(
            array(
                'id'       => 'konsal_menu_menu_show',
                'type'     => 'switch',
                'title'    => esc_html__( 'Mobile Logo Hide/Show', 'konsal' ),
                'subtitle' => esc_html__( 'Hide / Show mobile menu logo ( Default settings SHOW ).', 'konsal' ),
                'default'  => '1',
                'on'       => 'Show',
                'off'      => 'Hide',
            ),
            array(
                'id'       => 'konsal_mobile_logo', 
                'type'     => 'media',
                'url'      => true,
                'title'    => esc_html__( 'Logo', 'konsal' ),
                'compiler' => 'true',
                'subtitle' => esc_html__( 'Upload your mobile logo for mobile menu ( recommendation png format ).', 'konsal' ),
                'required' => array( 
                    array('konsal_menu_menu_show','equals','1')  
                )
            ),
            array(
                'id'       => 'konsal_mobile_logo_dimensions',
                'type'     => 'dimensions',
                'units'    => array('px'),
                'title'    => esc_html__('Logo Dimensions (Width/Height).', 'konsal'),
                'output'   => array('.th-menu-wrapper .mobile-logo img'),
                'subtitle' => esc_html__('Set logo dimensions to choose width, height, and unit.', 'konsal'),
                'required' => array( 
                    array('konsal_menu_menu_show','equals','1') 
                )
            ),
            array(
                'id'       => 'konsal_mobile_menu_bg',
                'type'     => 'color',
                'title'    => esc_html__( 'Logo Background', 'konsal' ),
                'subtitle' => esc_html__( 'Set logo backgorund', 'konsal' ),
                'output'   => array( 'background-color'    =>  '.th-menu-wrapper .mobile-logo' ),
                'required' => array( 
                    array('konsal_menu_menu_show','equals','1') 
                )
            ),
    
        )
    ) );
    // -> End Mobile Menu

     // -> START Mobile Menu
    Redux::setSection( $opt_name, array(
        'title'            => esc_html__( 'Offcanvas', 'konsal' ),
        'id'               => 'konsal_offcanvas_panel',
        'subsection'       => true,
        'fields'           => array(
            array(
                'id'       => 'konsal_offcanvas_panel_bg',
                'type'     => 'background',
                'title'    => esc_html__( 'Offcanvas Panel Background', 'konsal' ),
                'output'   => array('.sidemenu-wrapper .sidemenu-content'),
                'subtitle' => esc_html__( 'Set Offcanvas Panel Background Color', 'konsal' ),
            ),

        )
    ) );
    // -> End Mobile Menu

    // -> START Blog Page
    Redux::setSection( $opt_name, array(
        'title'      => esc_html__( 'Blog', 'konsal' ),
        'id'         => 'konsal_blog_page',
        'icon'  => 'el el-blogger',
        'fields'     => array(

            array(
                'id'       => 'konsal_blog_sidebar',
                'type'     => 'image_select',
                'title'    => esc_html__( 'Layout', 'konsal' ),
                'subtitle' => esc_html__( 'Choose blog layout from here. If you use this option then you will able to change three type of blog layout ( Default Left Sidebar Layour ). ', 'konsal' ),
                'options'  => array(
                    '1' => array(
                        'alt' => esc_attr__('1 Column','konsal'),
                        'img' => esc_url( get_template_directory_uri(). '/assets/img/no-sideber.png')
                    ),
                    '2' => array(
                        'alt' => esc_attr__('2 Column Left','konsal'),
                        'img' => esc_url( get_template_directory_uri() .'/assets/img/left-sideber.png')
                    ),
                    '3' => array(
                        'alt' => esc_attr__('2 Column Right','konsal'),
                        'img' => esc_url(  get_template_directory_uri() .'/assets/img/right-sideber.png' )
                    ),

                ),
                'default'  => '3'
            ),
            array(
                'id'       => 'konsal_blog_grid',
                'type'     => 'image_select',
                'title'    => esc_html__( 'Post Column', 'konsal' ),
                'subtitle' => esc_html__( 'Select your blog post column from here. If you use this option then you will able to select three type of blog post layout ( Default Two Column ).', 'konsal' ),
                //Must provide key => value(array:title|img) pairs for radio options
                'options'  => array(
                    '1' => array(
                        'alt' => esc_attr__('1 Column','konsal'),
                        'img' => esc_url( get_template_directory_uri(). '/assets/img/1column.png')
                    ),
                    '2' => array(
                        'alt' => esc_attr__('2 Column Left','konsal'),
                        'img' => esc_url( get_template_directory_uri() .'/assets/img/2column.png')
                    ),
                    '3' => array(
                        'alt' => esc_attr__('2 Column Right','konsal'),
                        'img' => esc_url(  get_template_directory_uri() .'/assets/img/3column.png' )
                    ),

                ),
                'default'  => '1'
            ),
            array(
                'id'       => 'konsal_blog_page_title_switcher',
                'type'     => 'switch',
                'default'  => 1,
                'on'       => esc_html__('Show','konsal'),
                'off'      => esc_html__('Hide','konsal'),
                'title'    => esc_html__('Blog Page Title', 'konsal'),
                'subtitle' => esc_html__('Control blog page title show / hide. If you use this option then you will able to show / hide your blog page title ( Default Setting Show ).', 'konsal'),
            ),
            array(
                'id'       => 'konsal_blog_page_title_setting',
                'type'     => 'button_set',
                'title'    => esc_html__('Blog Page Title Setting', 'konsal'),
                'subtitle' => esc_html__('Control blog page title setting. If you use this option then you can able to show default or custom blog page title ( Default Blog ).', 'konsal'),
                'options'  => array(
                    "predefine"   => esc_html__('Default','konsal'),
                    "custom"      => esc_html__('Custom','konsal'),
                ),
                'default'  => 'predefine',
                'required' => array("konsal_blog_page_title_switcher","equals","1")
            ),
            array(
                'id'       => 'konsal_blog_page_custom_title',
                'type'     => 'text',
                'title'    => esc_html__('Blog Custom Title', 'konsal'),
                'subtitle' => esc_html__('Set blog page custom title form here. If you use this option then you will able to set your won title text.', 'konsal'),
                'required' => array('konsal_blog_page_title_setting','equals','custom')
            ),
            array(
                'id'            => 'konsal_blog_postExcerpt',
                'type'          => 'slider',
                'title'         => esc_html__('Blog Posts Excerpt', 'konsal'),
                'subtitle'      => esc_html__('Control the number of characters you want to show in the blog page for each post.. If you use this option then you can able to control your blog post characters from here ( Default show 10 ).', 'konsal'),
                "default"       => 46,
                "min"           => 0,
                "step"          => 1,
                "max"           => 100,
                'resolution'    => 1,
                'display_value' => 'text',
            ),
            array(
                'id'       => 'konsal_blog_readmore_setting',
                'type'     => 'button_set',
                'title'    => esc_html__( 'Read More Text Setting', 'konsal' ),
                'subtitle' => esc_html__( 'Control read more text from here.', 'konsal' ),
                'options'  => array(
                    "default"   => esc_html__('Default','konsal'),
                    "custom"    => esc_html__('Custom','konsal'),
                ),
                'default'  => 'default',
            ),
            array(
                'id'       => 'konsal_blog_custom_readmore',
                'type'     => 'text',
                'title'    => esc_html__('Read More Text', 'konsal'),
                'subtitle' => esc_html__('Set read moer text here. If you use this option then you will able to set your won text.', 'konsal'),
                'required' => array('konsal_blog_readmore_setting','equals','custom')
            ),
            array(
                'id'       => 'konsal_blog_title_color',
                'output'   => array( '.th-blog .blog-title a'),
                'type'     => 'color',
                'title'    => esc_html__( 'Blog Title Color', 'konsal' ),
                'subtitle' => esc_html__( 'Set Blog Title Color.', 'konsal' ),
            ),
            array(
                'id'       => 'konsal_blog_title_hover_color',
                'output'   => array( '.th-blog .blog-title a:hover'),
                'type'     => 'color',
                'title'    => esc_html__( 'Blog Title Hover Color', 'konsal' ),
                'subtitle' => esc_html__( 'Set Blog Title Hover Color.', 'konsal' ),
            ),
            array(
                'id'       => 'konsal_blog_contant_color',
                'output'   => array( '.blog-content p'),
                'type'     => 'color',
                'title'    => esc_html__( 'Blog Excerpt / Content Color', 'konsal' ),
                'subtitle' => esc_html__( 'Set Blog Excerpt / Content Color.', 'konsal' ),
            ),
            array(
                'id'       => 'konsal_blog_read_more_button_color',
                'type'     => 'color',
                'title'    => esc_html__( 'Read More Button Color', 'konsal' ),
                'subtitle' => esc_html__( 'Set Read More Button Color.', 'konsal' ),
                'output'   => array( '--theme-color' => '.blog-single .th-btn' ),
            ),
            array(
                'id'       => 'konsal_blog_read_more_button_hover_color',
                'type'     => 'color',
                'title'    => esc_html__( 'Read More Button Hover Gradient Color 1', 'konsal' ),
                'subtitle' => esc_html__( 'Set Read More Button Hover Color.', 'konsal' ),
                'output'   => array( '--theme-color' => '.blog-single .blog-content .th-btn' ),
            ),
            array(
                'id'       => 'konsal_blog_read_more_button_hover_color_2',
                'type'     => 'color',
                'title'    => esc_html__( 'Read More Button Hover Gradient Color 2', 'konsal' ),
                'subtitle' => esc_html__( 'Set Read More Button Hover Color.', 'konsal' ),
                'output'   => array( '--theme-color2' => '.blog-single .blog-content .th-btn' ),
            ),
            array(
                'id'       => 'konsal_blog_pagination_color',
                'output'   => array( '.pagination li a,.pagination a i'),
                'type'     => 'color',
                'title'    => esc_html__('Blog Pagination Color', 'konsal'),
                'subtitle' => esc_html__('Set Blog Pagination Color.', 'konsal'),
            ),
            array(
                'id'       => 'konsal_blog_pagination_active_color',
                'output'   => array( '.pagination li span.current'),
                'type'     => 'color',
                'title'    => esc_html__('Blog Pagination Active Color', 'konsal'),
                'subtitle' => esc_html__('Set Blog Pagination Active Color.', 'konsal'),
                'required'  => array('konsal_blog_pagination', '=', '1')
            ),
            array(
                'id'       => 'konsal_blog_pagination_hover_color',
                'output'   => array( '.pagination li a:hover,.pagination a i:hover'),
                'type'     => 'color',
                'title'    => esc_html__('Blog Pagination Hover Color', 'konsal'),
                'subtitle' => esc_html__('Set Blog Pagination Hover Color.', 'konsal'),
            ),
        ),
    ) );

    Redux::setSection( $opt_name, array(
        'title'      => esc_html__( 'Single Blog Page', 'konsal' ),
        'id'         => 'konsal_post_detail_styles',
        'subsection' => true,
        'fields'     => array(

            array(
                'id'       => 'konsal_blog_single_sidebar',
                'type'     => 'image_select',
                'title'    => esc_html__( 'Layout', 'konsal' ),
                'subtitle' => esc_html__( 'Choose blog single page layout from here. If you use this option then you will able to change three type of blog single page layout ( Default Left Sidebar Layour ). ', 'konsal' ),
                'options'  => array(
                    '1' => array(
                        'alt' => esc_attr__('1 Column','konsal'),
                        'img' => esc_url( get_template_directory_uri(). '/assets/img/no-sideber.png')
                    ),
                    '2' => array(
                        'alt' => esc_attr__('2 Column Left','konsal'),
                        'img' => esc_url( get_template_directory_uri() .'/assets/img/left-sideber.png')
                    ),
                    '3' => array(
                        'alt' => esc_attr__('2 Column Right','konsal'),
                        'img' => esc_url(  get_template_directory_uri() .'/assets/img/right-sideber.png' )
                    ),

                ),
                'default'  => '3'
            ),
            array(
                'id'       => 'konsal_post_details_title_position',
                'type'     => 'button_set',
                'default'  => 'header',
                'options'  => array(
                    'header'        => esc_html__('On Header','konsal'),
                    'below'         => esc_html__('Below Thumbnail','konsal'),
                ),
                'title'    => esc_html__('Blog Post Title Position', 'konsal'),
                'subtitle' => esc_html__('Control blog post title position from here.', 'konsal'),
            ),
            array(
                'id'       => 'konsal_post_details_custom_title',
                'type'     => 'text',
                'title'    => esc_html__('Blog Details Custom Title', 'konsal'),
                'subtitle' => esc_html__('This title will show in Breadcrumb title.', 'konsal'),
                'required' => array('konsal_post_details_title_position','equals','below')
            ),
            array(
                'id'       => 'konsal_display_post_tags',
                'type'     => 'switch',
                'title'    => esc_html__( 'Tags', 'konsal' ),
                'subtitle' => esc_html__( 'Switch On to Display Tags.', 'konsal' ),
                'default'  => true,
                'on'        => esc_html__('Enabled','konsal'),
                'off'       => esc_html__('Disabled','konsal'),
            ),
            array(
                'id'       => 'konsal_post_details_share_options',
                'type'     => 'switch',
                'title'    => esc_html__('Share Options', 'konsal'),
                'subtitle' => esc_html__('Control post share options from here. If you use this option then you will able to show or hide post share options.', 'konsal'),
                'on'        => esc_html__('Show','konsal'),
                'off'       => esc_html__('Hide','konsal'),
                'default'   => '0',
            ),
            array(
                'id'       => 'konsal_post_details_author_desc_trigger',
                'type'     => 'switch',
                'title'    => esc_html__('Author Info', 'konsal'),
                'subtitle' => esc_html__('Control biography info from here. If you use this option then you will able to show or hide biography info ( Default setting Show ).', 'konsal'),
                'on'        => esc_html__('Show','konsal'),
                'off'       => esc_html__('Hide','konsal'),
                'default'   => '0',
            ),

        )
    ));

    Redux::setSection( $opt_name, array(
        'title'      => esc_html__( 'Meta Data', 'konsal' ),
        'id'         => 'konsal_common_meta_data',
        'subsection' => true,
        'fields'     => array(
            array(
                'id'       => 'konsal_blog_meta_icon_color',
                'output'   => array( '.blog-meta a i'),
                'type'     => 'color',
                'title'    => esc_html__('Blog Meta Icon Color', 'konsal'),
                'subtitle' => esc_html__('Set Blog Meta Icon Color.', 'konsal'),
            ),
            array(
                'id'       => 'konsal_blog_meta_text_color',
                'output'   => array( '.blog-meta a,.blog-meta span'),
                'type'     => 'color',
                'title'    => esc_html__( 'Blog Meta Text Color', 'konsal' ),
                'subtitle' => esc_html__( 'Set Blog Meta Text Color.', 'konsal' ),
            ),
            array(
                'id'       => 'konsal_blog_meta_text_hover_color',
                'output'   => array( '.blog-meta a:hover'),
                'type'     => 'color',
                'title'    => esc_html__( 'Blog Meta Hover Text Color', 'konsal' ),
                'subtitle' => esc_html__( 'Set Blog Meta Hover Text Color.', 'konsal' ),
            ),
            array(
                'id'       => 'konsal_display_post_author',
                'type'     => 'switch',
                'title'    => esc_html__( 'Post Author', 'konsal' ),
                'subtitle' => esc_html__( 'Switch On to Display Post Author.', 'konsal' ),
                'default'  => true,
                'on'        => esc_html__('Enabled','konsal'),
                'off'       => esc_html__('Disabled','konsal'),
            ),
            array(
                'id'       => 'konsal_display_post_date',
                'type'     => 'switch',
                'title'    => esc_html__( 'Post Date', 'konsal' ),
                'subtitle' => esc_html__( 'Switch On to Display Post Date.', 'konsal' ),
                'default'  => true,
                'on'        => esc_html__('Enabled','konsal'),
                'off'       => esc_html__('Disabled','konsal'),
            ),
            array(
                'id'       => 'konsal_display_post_cate',
                'type'     => 'switch',
                'title'    => esc_html__( 'Post Category', 'konsal' ),
                'subtitle' => esc_html__( 'Switch On to Display Post Category.', 'konsal' ),
                'default'  => true,
                'on'        => esc_html__('Enabled','konsal'),
                'off'       => esc_html__('Disabled','konsal'),
            ),
            array(
                'id'       => 'konsal_display_post_comment',
                'type'     => 'switch',
                'title'    => esc_html__( 'Post Comments', 'konsal' ),
                'subtitle' => esc_html__( 'Switch On to Display Post Comments.', 'konsal' ),
                'default'  => true,
                'on'        => esc_html__('Enabled','konsal'),
                'off'       => esc_html__('Disabled','konsal'),
            ),
        )
    ));

    /* End blog Page */

    // -> START Page Option
    Redux::setSection( $opt_name, array(
        'title'      => esc_html__( 'Page', 'konsal' ),
        'id'         => 'konsal_page_page',
        'icon'  => 'el el-file',
        'fields'     => array(
            array(
                'id'       => 'konsal_page_sidebar',
                'type'     => 'image_select',
                'title'    => esc_html__( 'Select layout', 'konsal' ),
                'subtitle' => esc_html__( 'Choose your page layout. If you use this option then you will able to choose three type of page layout ( Default no sidebar ). ', 'konsal' ),
                //Must provide key => value(array:title|img) pairs for radio options
                'options'  => array(
                    '1' => array(
                        'alt' => esc_attr__('1 Column','konsal'),
                        'img' => esc_url( get_template_directory_uri(). '/assets/img/no-sideber.png')
                    ),
                    '2' => array(
                        'alt' => esc_attr__('2 Column Left','konsal'),
                        'img' => esc_url( get_template_directory_uri() .'/assets/img/left-sideber.png')
                    ),
                    '3' => array(
                        'alt' => esc_attr__('2 Column Right','konsal'),
                        'img' => esc_url(  get_template_directory_uri() .'/assets/img/right-sideber.png' )
                    ),

                ),
                'default'  => '1'
            ),
            array(
                'id'       => 'konsal_page_layoutopt',
                'type'     => 'button_set',
                'title'    => esc_html__('Sidebar Settings', 'konsal'),
                'subtitle' => esc_html__('Set page sidebar. If you use this option then you will able to set three type of sidebar ( Default no sidebar ).', 'konsal'),
                //Must provide key => value pairs for options
                'options' => array(
                    '1' => esc_html__( 'Page Sidebar', 'konsal' ),
                    '2' => esc_html__( 'Blog Sidebar', 'konsal' )
                 ),
                'default' => '1',
                'required'  => array('konsal_page_sidebar','!=','1')
            ),
            array(
                'id'       => 'konsal_page_title_switcher',
                'type'     => 'switch',
                'title'    => esc_html__('Title', 'konsal'),
                'subtitle' => esc_html__('Switch enabled to display page title. Fot this option you will able to show / hide page title.  Default setting Enabled', 'konsal'),
                'default'  => '1',
                'on'        => esc_html__('Enabled','konsal'),
                'off'       => esc_html__('Disabled','konsal'),
            ),
            array(
                'id'       => 'konsal_page_title_tag',
                'type'     => 'select',
                'options'  => array(
                    'h1'        => esc_html__('H1','konsal'),
                    'h2'        => esc_html__('H2','konsal'),
                    'h3'        => esc_html__('H3','konsal'),
                    'h4'        => esc_html__('H4','konsal'),
                    'h5'        => esc_html__('H5','konsal'),
                    'h6'        => esc_html__('H6','konsal'),
                ),
                'default'  => 'h1',
                'title'    => esc_html__( 'Title Tag', 'konsal' ),
                'subtitle' => esc_html__( 'Select page title tag. If you use this option then you can able to change title tag H1 - H6 ( Default tag H1 )', 'konsal' ),
                'required' => array("konsal_page_title_switcher","equals","1")
            ),
            array(
                'id'       => 'konsal_allHeader_title_color',
                'type'     => 'color',
                'title'    => esc_html__( 'Title Color', 'konsal' ),
                'subtitle' => esc_html__( 'Set Title Color', 'konsal' ),
                'output'   => array( 'color' => '.breadcumb-title' ),
            ),
            array(
                'id'       => 'konsal_allHeader_bg',
                'type'     => 'background',
                'title'    => esc_html__( 'Background', 'konsal' ),
                'subtitle' => esc_html__( 'Setting page header background. If you use this option then you will able to set Background Color, Background Image, Background Repeat, Background Size, Background Attachment, Background Position.', 'konsal' ),
                'output'   => array( 'background' => '.breadcumb-wrapper' ),
            ),
            array(
                'id'       => 'konsal_allHeader_shape',
                'type'     => 'media',
                'url'      => true,
                'title'    => esc_html__( 'Shape  Image 1', 'konsal' ),
                'compiler' => 'true',
            ),
            array(
                'id'       => 'konsal_allHeader_shape2',
                'type'     => 'media',
                'url'      => true,
                'title'    => esc_html__( 'Shape  Image 2', 'konsal' ),
                'compiler' => 'true',
            ),
            array(
                'id'       => 'konsal_enable_breadcrumb',
                'type'     => 'switch',
                'title'    => esc_html__( 'Breadcrumb Hide/Show', 'konsal' ),
                'subtitle' => esc_html__( 'Hide / Show breadcrumb from all pages and posts ( Default settings hide ).', 'konsal' ),
                'default'  => '1',
                'on'       => 'Show',
                'off'      => 'Hide',
            ),
            array(
                'id'       => 'konsal_allHeader_breadcrumbtextcolor',
                'type'     => 'color',
                'title'    => esc_html__( 'Breadcrumb Color', 'konsal' ),
                'subtitle' => esc_html__( 'Choose page header breadcrumb text color here.If you user this option then you will able to set page breadcrumb color.', 'konsal' ),
                'required' => array("konsal_page_title_switcher","equals","1"),
                'output'   => array( 'color' => '.breadcumb-wrapper .breadcumb-content ul li a' ),
            ),
            array(
                'id'       => 'konsal_allHeader_breadcrumbtextactivecolor',
                'type'     => 'color',
                'title'    => esc_html__( 'Breadcrumb Active Color', 'konsal' ),
                'subtitle' => esc_html__( 'Choose page header breadcrumb text active color here.If you user this option then you will able to set page breadcrumb active color.', 'konsal' ),
                'required' => array( "konsal_page_title_switcher", "equals", "1" ),
                'output'   => array( 'color' => '.breadcumb-wrapper .breadcumb-content ul li:last-child' ),
            ),
            array(
                'id'       => 'konsal_allHeader_dividercolor',
                'type'     => 'color',
                'output'   => array( 'color'=>'.breadcumb-wrapper .breadcumb-content ul li:after' ),
                'title'    => esc_html__( 'Breadcrumb Divider Color', 'konsal' ),
                'subtitle' => esc_html__( 'Choose breadcrumb divider color.', 'konsal' ),
            ),
        ),
    ) );
    /* End Page option */

    // -> START 404 Page

    Redux::setSection( $opt_name, array(
        'title'      => esc_html__( '404 Page', 'konsal' ),
        'id'         => 'konsal_404_page',
        'icon'       => 'el el-ban-circle',
        'fields'     => array(
            array(
                'id'       => 'konsal_404_bg',
                'type'     => 'media',
                'url'      => true,
                'title'    => esc_html__( '404  Image', 'konsal' ),
                'compiler' => 'true',
            ),
            array(
                'id'       => 'konsal_fof_title',
                'type'     => 'text',
                'title'    => esc_html__( 'Page Title', 'konsal' ),
                'default'  => esc_html__( '404', 'konsal' ),
            ),
            array(
                'id'       => 'konsal_fof_description',
                'type'     => 'text',
                'title'    => esc_html__( 'Page Description', 'konsal' ),
                'default'  => esc_html__( 'Unfortunately, something went wrong and this page does not exist. Try using the search or return to the previous page.', 'konsal' ),
            ),
            array(
                'id'       => 'konsal_fof_btn_text',
                'type'     => 'text',
                'title'    => esc_html__( 'Button Text', 'konsal' ),
                'default'  => esc_html__( 'Return To Home', 'konsal' ),
            ),
            array(
                'id'       => 'konsal_fof_text_color',
                'type'     => 'color',
                'output'   => array( '.error-content .error-title' ),
                'title'    => esc_html__( 'Title Color', 'konsal' ),
                'validate' => 'color'
            ),
            array(
                'id'       => 'konsal_fof_subtitle_color',
                'type'     => 'color',
                'output'   => array( '.error-content .error-text' ),
                'title'    => esc_html__( 'Description Color', 'konsal' ),
                'validate' => 'color'
            ),
            array(
                'id'       => 'konsal_fof_btn_color2',
                'type'     => 'color',
                'title'    => esc_html__( 'Button Color', 'konsal' ),
                'output'   => array( 'color' => '.th-btn.error-btn' ),
            ),
            array(
                'id'       => 'konsal_fof_btn_color',
                'type'     => 'color',
                'title'    => esc_html__( 'Button Background', 'konsal' ),
                'output'   => array( '--theme-color' => '.th-btn.error-btn' ),
            ),
            array(
                'id'       => 'konsal_fof_btn_hover_color',
                'type'     => 'color',
                'title'    => esc_html__( 'Button Hover Color', 'konsal' ),
                'output'   => array( 'color' => '.th-btn.error-btn:hover',  ),
            ),
            array(
                'id'       => 'konsal_fof_btn_hover_color2',
                'type'     => 'color',
                'title'    => esc_html__( 'Button Hover Background', 'konsal' ),
                'output'   => array( '--title-color' => '.th-btn.error-btn:hover::before, .th-btn.error-btn:hover::after',  ),
            ),

        ),
    ) );

    /* End 404 Page */
    // -> START Woo Page Option

    Redux::setSection( $opt_name, array(
        'title'      => esc_html__( 'Woocommerce Page', 'konsal' ),
        'id'         => 'konsal_woo_page_page',
        'icon'  => 'el el-shopping-cart',
        'fields'     => array(
            array(
                'id'       => 'konsal_woo_shoppage_sidebar',
                'type'     => 'image_select',
                'title'    => esc_html__( 'Set Shop Page Sidebar.', 'konsal' ),
                'subtitle' => esc_html__( 'Choose shop page sidebar', 'konsal' ),
                //Must provide key => value(array:title|img) pairs for radio options
                'options'  => array(
                    '1' => array(
                        'alt' => esc_attr__('1 Column','konsal'),
                        'img' => esc_url( get_template_directory_uri(). '/assets/img/no-sideber.png')
                    ),
                    '2' => array(
                        'alt' => esc_attr__('2 Column Left','konsal'),
                        'img' => esc_url( get_template_directory_uri() .'/assets/img/left-sideber.png')
                    ),
                    '3' => array(
                        'alt' => esc_attr__('2 Column Right','konsal'),
                        'img' => esc_url(  get_template_directory_uri() .'/assets/img/right-sideber.png' )
                    ),

                ),
                'default'  => '1'
            ),
            array(
                'id'       => 'konsal_woo_product_col',
                'type'     => 'image_select',
                'title'    => esc_html__( 'Product Column', 'konsal' ),
                'subtitle' => esc_html__( 'Set your woocommerce product column.', 'konsal' ),
                //Must provide key => value(array:title|img) pairs for radio options
                'options'  => array(
                    '2' => array(
                        'alt' => esc_attr__('2 Columns','konsal'),
                        'img' => esc_url( get_template_directory_uri() .'/assets/img/2col.png')
                    ),
                    '3' => array(
                        'alt' => esc_attr__('3 Columns','konsal'),
                        'img' => esc_url(  get_template_directory_uri() .'/assets/img/3col.png' )
                    ),
                    '4' => array(
                        'alt' => esc_attr__('4 Columns','konsal'),
                        'img' => esc_url( get_template_directory_uri(). '/assets/img/4col.png')
                    ),
                    '6' => array(
                        'alt' => esc_attr__('6 Columns','konsal'),
                        'img' => esc_url(  get_template_directory_uri() .'/assets/img/6col.png' )
                    ),
                ),
                'default'  => '4'
            ),
            array(
                'id'       => 'konsal_woo_product_perpage',
                'type'     => 'text',
                'title'    => esc_html__( 'Product Per Page', 'konsal' ),
                'default' => '10'
            ),
            array(
                'id'       => 'konsal_woo_singlepage_sidebar',
                'type'     => 'image_select',
                'title'    => esc_html__( 'Product Single Page sidebar', 'konsal' ),
                'subtitle' => esc_html__( 'Choose product single page sidebar.', 'konsal' ),
                //Must provide key => value(array:title|img) pairs for radio options
                'options'  => array(
                    '1' => array(
                        'alt' => esc_attr__('1 Column','konsal'),
                        'img' => esc_url( get_template_directory_uri(). '/assets/img/no-sideber.png')
                    ),
                    '2' => array(
                        'alt' => esc_attr__('2 Column Left','konsal'),
                        'img' => esc_url( get_template_directory_uri() .'/assets/img/left-sideber.png')
                    ),
                    '3' => array(
                        'alt' => esc_attr__('2 Column Right','konsal'),
                        'img' => esc_url(  get_template_directory_uri() .'/assets/img/right-sideber.png' )
                    ),

                ),
                'default'  => '1'
            ),
            array(
                'id'       => 'konsal_product_details_title_position',
                'type'     => 'button_set',
                'default'  => 'below',
                'options'  => array(
                    'header'        => esc_html__('On Header','konsal'),
                    'below'         => esc_html__('Below Thumbnail','konsal'),
                ),
                'title'    => esc_html__('Product Details Title Position', 'konsal'),
                'subtitle' => esc_html__('Control product details title position from here.', 'konsal'),
            ),
            array(
                'id'       => 'konsal_product_details_custom_title',
                'type'     => 'text',
                'title'    => esc_html__( 'Product Details Title', 'konsal' ),
                'default'  => esc_html__( 'Shop Details', 'konsal' ),
                'required' => array('konsal_product_details_title_position','equals','below'),
            ),
            array(
                'id'       => 'konsal_product_details_custom_title',
                'type'     => 'text',
                'title'    => esc_html__( 'Product Details Title', 'konsal' ),
                'default'  => esc_html__( 'Shop Details', 'konsal' ),
                'required' => array('konsal_product_details_title_position','equals','below'),
            ),
            array(
                'id'       => 'konsal_woo_relproduct_display',
                'type'     => 'switch',
                'title'    => esc_html__( 'Related product Hide/Show', 'konsal' ),
                'subtitle' => esc_html__( 'Hide / Show related product in single page (Default Settings Show)', 'konsal' ),
                'default'  => '1',
                'on'       => esc_html__('Show','konsal'),
                'off'      => esc_html__('Hide','konsal')
            ),
            array(
                'id'       => 'konsal_woo_relproduct_subtitle',
                'type'     => 'text',
                'title'    => esc_html__( 'Related products Subtitle', 'konsal' ),
                'default'  => esc_html__( 'Some Others Product', 'konsal' ),
                'required' => array('konsal_woo_relproduct_display','equals',true)
            ),
            array(
                'id'       => 'konsal_woo_relproduct_title',
                'type'     => 'text',
                'title'    => esc_html__( 'Related products Title', 'konsal' ),
                'default'  => esc_html__( 'Related products', 'konsal' ),
                'required' => array('konsal_woo_relproduct_display','equals',true)
            ),
            array(
                'id'       => 'konsal_woo_relproduct_slider', 
                'type'     => 'switch',
                'title'    => esc_html__( 'Related product Sldier On/Off', 'konsal' ),
                'subtitle' => esc_html__( 'Slider On/Off related product slider in single page (Default Settings Slider On)', 'konsal' ),
                'default'  => '1',
                'on'       => esc_html__('Slider On','konsal'),
                'off'      => esc_html__('Slider Off','konsal')
            ),
            array(
                'id'       => 'konsal_woo_relproduct_num',
                'type'     => 'text',
                'title'    => esc_html__( 'Related products number', 'konsal' ),
                'subtitle' => esc_html__( 'Set how many related products you want to show in single product page.', 'konsal' ),
                'default'  => 4,
                'required' => array('konsal_woo_relproduct_display','equals',true)
            ),

            array(
                'id'       => 'konsal_woo_related_product_col',
                'type'     => 'image_select',
                'title'    => esc_html__( 'Related Product Column', 'konsal' ),
                'subtitle' => esc_html__( 'Set your woocommerce related product column.', 'konsal' ),
                'required' => array('konsal_woo_relproduct_display','equals',true),
                //Must provide key => value(array:title|img) pairs for radio options
                'options'  => array(
                    '6' => array(
                        'alt' => esc_attr__('2 Columns','konsal'),
                        'img' => esc_url( get_template_directory_uri() .'/assets/img/2col.png')
                    ),
                    '4' => array(
                        'alt' => esc_attr__('3 Columns','konsal'),
                        'img' => esc_url(  get_template_directory_uri() .'/assets/img/3col.png' )
                    ),
                    '3' => array(
                        'alt' => esc_attr__('4 Columns','konsal'),
                        'img' => esc_url( get_template_directory_uri(). '/assets/img/4col.png')
                    ),
                    '2' => array(
                        'alt' => esc_attr__('6 Columns','konsal'),
                        'img' => esc_url(  get_template_directory_uri() .'/assets/img/6col.png' )
                    ),

                ),
                'default'  => '4'
            ),
            array(
                'id'       => 'konsal_woo_upsellproduct_display',
                'type'     => 'switch',
                'title'    => esc_html__( 'Upsell product Hide/Show', 'konsal' ),
                'subtitle' => esc_html__( 'Hide / Show upsell product in single page (Default Settings Show)', 'konsal' ),
                'default'  => '1',
                'on'       => esc_html__('Show','konsal'),
                'off'      => esc_html__('Hide','konsal'),
            ),
            array(
                'id'       => 'konsal_woo_upsellproduct_num',
                'type'     => 'text',
                'title'    => esc_html__( 'Upsells products number', 'konsal' ),
                'subtitle' => esc_html__( 'Set how many upsells products you want to show in single product page.', 'konsal' ),
                'default'  => 3,
                'required' => array('konsal_woo_upsellproduct_display','equals',true),
            ),

            array(
                'id'       => 'konsal_woo_upsell_product_col',
                'type'     => 'image_select',
                'title'    => esc_html__( 'Upsells Product Column', 'konsal' ),
                'subtitle' => esc_html__( 'Set your woocommerce upsell product column.', 'konsal' ),
                'required' => array('konsal_woo_upsellproduct_display','equals',true),
                //Must provide key => value(array:title|img) pairs for radio options
                'options'  => array(
                    '6' => array(
                        'alt' => esc_attr__('2 Columns','konsal'),
                        'img' => esc_url( get_template_directory_uri() .'/assets/img/2col.png')
                    ),
                    '4' => array(
                        'alt' => esc_attr__('3 Columns','konsal'),
                        'img' => esc_url(  get_template_directory_uri() .'/assets/img/3col.png' )
                    ),
                    '3' => array(
                        'alt' => esc_attr__('4 Columns','konsal'),
                        'img' => esc_url( get_template_directory_uri(). '/assets/img/4col.png')
                    ),
                    '2' => array(
                        'alt' => esc_attr__('6 Columns','konsal'),
                        'img' => esc_url(  get_template_directory_uri() .'/assets/img/6col.png' )
                    ),

                ),
                'default'  => '4'
            ),
            array(
                'id'       => 'konsal_woo_crosssellproduct_display',
                'type'     => 'switch',
                'title'    => esc_html__( 'Cross sell product Hide/Show', 'konsal' ),
                'subtitle' => esc_html__( 'Hide / Show cross sell product in single page (Default Settings Show)', 'konsal' ),
                'default'  => '1',
                'on'       => esc_html__( 'Show', 'konsal' ),
                'off'      => esc_html__( 'Hide', 'konsal' ),
            ),
            array(
                'id'       => 'konsal_woo_crosssellproduct_num',
                'type'     => 'text',
                'title'    => esc_html__( 'Cross sell products number', 'konsal' ),
                'subtitle' => esc_html__( 'Set how many cross sell products you want to show in single product page.', 'konsal' ),
                'default'  => 3,
                'required' => array('konsal_woo_crosssellproduct_display','equals',true),
            ),

            array(
                'id'       => 'konsal_woo_crosssell_product_col',
                'type'     => 'image_select',
                'title'    => esc_html__( 'Cross sell Product Column', 'konsal' ),
                'subtitle' => esc_html__( 'Set your woocommerce cross sell product column.', 'konsal' ),
                'required' => array( 'konsal_woo_crosssellproduct_display', 'equals', true ),
                //Must provide key => value(array:title|img) pairs for radio options
                'options'  => array(
                    '6' => array(
                        'alt' => esc_attr__('2 Columns','konsal'),
                        'img' => esc_url( get_template_directory_uri() .'/assets/img/2col.png')
                    ),
                    '4' => array(
                        'alt' => esc_attr__('3 Columns','konsal'),
                        'img' => esc_url(  get_template_directory_uri() .'/assets/img/3col.png' )
                    ),
                    '3' => array(
                        'alt' => esc_attr__('4 Columns','konsal'),
                        'img' => esc_url( get_template_directory_uri(). '/assets/img/4col.png')
                    ),
                    '2' => array(
                        'alt' => esc_attr__('6 Columns','konsal'),
                        'img' => esc_url(  get_template_directory_uri() .'/assets/img/6col.png' )
                    ),

                ),
                'default'  => '4'
            ),
        ),
    ) );

    /* End Woo Page option */
    // -> START Gallery
    Redux::setSection( $opt_name, array(
        'title'      => esc_html__( 'Gallery', 'konsal' ),
        'id'         => 'konsal_gallery_widget',
        'icon'       => 'el el-gift',
        'fields'     => array(
            array(
                'id'          => 'konsal_gallery_image_widget',
                'type'        => 'slides',
                'title'       => esc_html__('Add Gallery Image', 'konsal'),
                'subtitle'    => esc_html__('Add gallery Image and url.', 'konsal'),
                'show'        => array(
                    'title'          => false,
                    'description'    => false,
                    'progress'       => false,
                    'icon'           => false,
                    'facts-number'   => false,
                    'facts-title1'   => false,
                    'facts-title2'   => false,
                    'facts-number-2' => false,
                    'facts-title3'   => false,
                    'facts-number-3' => false,
                    'url'            => true,
                    'project-button' => false,
                    'image_upload'   => true,
                ),
            ),
        ),
    ) );
    // -> START Subscribe
    Redux::setSection( $opt_name, array(
        'title'      => esc_html__( 'Subscribe', 'konsal' ),
        'id'         => 'konsal_subscribe_page',
        'icon'       => 'el el-eject',
        'fields'     => array(

            array(
                'id'       => 'konsal_subscribe_apikey',
                'type'     => 'text',
                'title'    => esc_html__( 'Mailchimp API Key', 'konsal' ),
                'subtitle' => esc_html__( 'Set mailchimp api key.', 'konsal' ),
            ),
            array(
                'id'       => 'konsal_subscribe_listid',
                'type'     => 'text',
                'title'    => esc_html__( 'Mailchimp List ID', 'konsal' ),
                'subtitle' => esc_html__( 'Set mailchimp list id.', 'konsal' ),
            ),
        ),
    ) );

    /* End Subscribe */

    // -> START Social Media

    Redux::setSection( $opt_name, array(
        'title'      => esc_html__( 'Social', 'konsal' ),
        'id'         => 'konsal_social_media',
        'icon'      => 'el el-globe',
        'desc'      => esc_html__( 'Social', 'konsal' ),
        'fields'     => array(
            array(
                'id'          => 'konsal_social_links',
                'type'        => 'slides',
                'title'       => esc_html__('Social Profile Links', 'konsal'),
                'subtitle'    => esc_html__('Add social icon and url.', 'konsal'),
                'show'        => array(
                    'title'          => true,
                    'description'    => true,
                    'progress'       => false,
                    'facts-number'   => false,
                    'facts-title1'   => false,
                    'facts-title2'   => false,
                    'facts-number-2' => false,
                    'facts-title3'   => false,
                    'facts-number-3' => false,
                    'url'            => true,
                    'project-button' => false,
                    'image_upload'   => false,
                ),
                'placeholder'   => array(
                    'icon'          => esc_html__( 'Icon (example: fa fa-facebook) ','konsal'),
                    'title'         => esc_html__( 'Social Icon Class', 'konsal' ),
                    'description'   => esc_html__( 'Social Icon Title', 'konsal' ),
                ),
            ),
        ),
    ) );

    /* End social Media */


    // -> START Footer Media
    Redux::setSection( $opt_name , array(
       'title'            => esc_html__( 'Footer', 'konsal' ),
       'id'               => 'konsal_footer',
       'desc'             => esc_html__( 'konsal Footer', 'konsal' ),
       'customizer_width' => '400px',
       'icon'              => 'el el-photo',
   ) );

   Redux::setSection( $opt_name, array(
       'title'      => esc_html__( 'Pre-built Footer / Footer Builder', 'konsal' ),
       'id'         => 'konsal_footer_section',
       'subsection' => true,
       'fields'     => array(
            array(
               'id'       => 'konsal_footer_builder_trigger',
               'type'     => 'button_set',
               'default'  => 'prebuilt',
               'options'  => array(
                   'footer_builder'        => esc_html__('Footer Builder','konsal'),
                   'prebuilt'              => esc_html__('Pre-built Footer','konsal'),
               ),
               'title'    => esc_html__( 'Footer Builder', 'konsal' ),
            ),
            array(
               'id'       => 'konsal_footer_builder_select',
               'type'     => 'select',
               'required' => array( 'konsal_footer_builder_trigger','equals','footer_builder'),
               'data'     => 'posts',
               'args'     => array(
                   'post_type'     => 'konsal_footer_build'
               ),
               'on'       => esc_html__( 'Enabled', 'konsal' ),
               'off'      => esc_html__( 'Disable', 'konsal' ),
               'title'    => esc_html__( 'Select Footer', 'konsal' ),
               'subtitle' => esc_html__( 'First make your footer from footer custom types then select it from here.', 'konsal' ),
            ),
            array(
               'id'       => 'konsal_footercta_enable',
               'type'     => 'switch',
               'title'    => esc_html__( 'Footer CTA?', 'konsal' ),
               'default'  => 0,
               'on'       => esc_html__( 'Enabled', 'konsal' ),
               'off'      => esc_html__( 'Disable', 'konsal' ),
            ),

            array(
                'id'       => 'konsal_footer_cta_bg',
                'type'     => 'media',
                'url'      => true,
                'title'    => esc_html__( 'Background Image', 'konsal' ),
                'compiler' => 'true',
                'required' => array('konsal_footercta_enable','=','1'),
            ),
            array(
                'id'       => 'konsal_footer_cta_title',
                'type'     => 'text',
                'title'    => esc_html__( 'CTA Title', 'konsal' ),
                'default'  => esc_html__( 'WE ARE HERE', 'konsal' ),
                'required' => array('konsal_footercta_enable','=','1'),
            ),
            array(
                'id'       => 'konsal_footer_cta_subtitle',
                'type'     => 'text',
                'title'    => esc_html__( 'CTA Subtitle', 'konsal' ),
                'default'  => esc_html__( 'Tell us about your business we are ready to solve.', 'konsal' ),
                'required' => array('konsal_footercta_enable','=','1'),
            ),
            array(
                'id'       => 'konsal_footer_cta_btn_text',
                'type'     => 'text',
                'title'    => esc_html__( 'Button Label', 'konsal' ),
                'default'  => esc_html__( 'Read More', 'konsal' ),
                'required' => array('konsal_footercta_enable','=','1'),
            ),
            array(
                'id'       => 'konsal_footer_cta_btn_url',
                'type'     => 'text',
                'title'    => esc_html__( 'Button URL', 'konsal' ),
                'required' => array('konsal_footercta_enable','=','1'),
            ),


            
            array(
               'id'       => 'konsal_footerwidget_enable',
               'type'     => 'switch',
               'title'    => esc_html__( 'Footer Widget', 'konsal' ),
               'default'  => 0,
               'on'       => esc_html__( 'Enabled', 'konsal' ),
               'off'      => esc_html__( 'Disable', 'konsal' ),
               'required' => array( 'konsal_footer_builder_trigger','equals','prebuilt'),
            ),
            array(
               'id'       => 'konsal_footer_background',
               'type'     => 'background',
               'title'    => esc_html__( 'Footer Background', 'konsal' ),
               'subtitle' => esc_html__( 'Set footer background.', 'konsal' ),
               'output'   => array( '.footer-custom' ),
               'required' => array( 'konsal_footerwidget_enable','=','1' ),
            ),
            array(
               'id'       => 'konsal_disable_footer_bottom',
               'type'     => 'switch',
               'title'    => esc_html__( 'Footer Bottom?', 'konsal' ),
               'default'  => 1,
               'on'       => esc_html__('Enabled','konsal'),
               'off'      => esc_html__('Disable','konsal'),
               'required' => array('konsal_footer_builder_trigger','equals','prebuilt'),
            ),
             array(
               'id'       => 'konsal_footer_bottom_background',
               'type'     => 'color',
               'title'    => esc_html__( 'Footer Bottom Background Color', 'konsal' ),
               'required' => array( 'konsal_disable_footer_bottom','=','1' ),
               'output'   => array( 'background-color'   =>   '.copyright-wrap' ),
            ),
            array(
               'id'       => 'konsal_copyright_text',
               'type'     => 'text',
               'title'    => esc_html__( 'Copyright Text', 'konsal' ),
               'subtitle' => esc_html__( 'Add Copyright Text', 'konsal' ),
               'default'  => sprintf( 'Copyright <i class="fal fa-copyright"></i> %s <a href="%s">%s</a> All Rights Reserved by <a href="%s">%s</a>',date('Y'),esc_url('#'),__( 'Konsal.','konsal' ),esc_url('https://th.com/'),__( 'Themeholy', 'konsal' ) ),
               'required' => array( 'konsal_disable_footer_bottom','equals','1' ),
            ),
            array(
               'id'       => 'konsal_footer_copyright_color',
               'type'     => 'color',
               'title'    => esc_html__( 'Footer Copyright Text Color', 'konsal' ),
               'subtitle' => esc_html__( 'Set footer copyright text color', 'konsal' ),
               'required' => array( 'konsal_disable_footer_bottom','equals','1'),
               'output'   => array( '.footer-custom .copyright-wrap .copyright-text' ),
            ),
            array(
               'id'       => 'konsal_footer_copyright_acolor',
               'type'     => 'color',
               'title'    => esc_html__( 'Footer Copyright Ancor Color', 'konsal' ),
               'subtitle' => esc_html__( 'Set footer copyright ancor color', 'konsal' ),
               'required' => array( 'konsal_disable_footer_bottom','equals','1'),
               'output'   => array( '.copyright-wrap p a' ),
            ),
            array(
               'id'       => 'konsal_footer_copyright_a_hover_color',
               'type'     => 'color',
               'title'    => esc_html__( 'Footer Copyright Ancor Hover Color', 'konsal' ),
               'subtitle' => esc_html__( 'Set footer copyright ancor Hover color', 'konsal' ),
               'required' => array( 'konsal_disable_footer_bottom','equals','1'),
               'output'   => array( '.copyright-wrap p a:hover' ),
            ),

       ),
   ) );


    /* End Footer Media */

    // -> START Custom Css
    Redux::setSection( $opt_name, array(
        'title'      => esc_html__( 'Custom Css', 'konsal' ),
        'id'         => 'konsal_custom_css_section',
        'icon'  => 'el el-css',
        'fields'     => array(
            array(
                'id'       => 'konsal_css_editor',
                'type'     => 'ace_editor',
                'title'    => esc_html__('CSS Code', 'konsal'),
                'subtitle' => esc_html__('Paste your CSS code here.', 'konsal'),
                'mode'     => 'css',
                'theme'    => 'monokai',
            )
        ),
    ) );

    /* End custom css */



    if ( file_exists( dirname( __FILE__ ) . '/../README.md' ) ) {
        $section = array(
            'icon'   => 'el el-list-alt',
            'title'  => __( 'Documentation', 'konsal' ),
            'fields' => array(
                array(
                    'id'       => '17',
                    'type'     => 'raw',
                    'markdown' => true,
                    'content_path' => dirname( __FILE__ ) . '/../README.md', // FULL PATH, not relative please
                    //'content' => 'Raw content here',
                ),
            ),
        );
        Redux::setSection( $opt_name, $section );
    }
    /*
     * <--- END SECTIONS
     */


    /*
     *
     * YOU MUST PREFIX THE FUNCTIONS BELOW AND ACTION FUNCTION CALLS OR ANY OTHER CONFIG MAY OVERRIDE YOUR CODE.
     *
     */

    /**
     * This is a test function that will let you see when the compiler hook occurs.
     * It only runs if a field    set with compiler=>true is changed.
     * */
    if ( ! function_exists( 'compiler_action' ) ) {
        function compiler_action( $options, $css, $changed_values ) {
            echo '<h1>The compiler hook has run!</h1>';
            echo "<pre>";
            print_r( $changed_values ); // Values that have changed since the last save
            echo "</pre>";
            //print_r($options); //Option values
            //print_r($css); // Compiler selector CSS values  compiler => array( CSS SELECTORS )
        }
    }

    /**
     * Custom function for the callback validation referenced above
     * */
    if ( ! function_exists( 'redux_validate_callback_function' ) ) {
        function redux_validate_callback_function( $field, $value, $existing_value ) {
            $error   = false;
            $warning = false;

            //do your validation
            if ( $value == 1 ) {
                $error = true;
                $value = $existing_value;
            } elseif ( $value == 2 ) {
                $warning = true;
                $value   = $existing_value;
            }

            $return['value'] = $value;

            if ( $error == true ) {
                $field['msg']    = 'your custom error message';
                $return['error'] = $field;
            }

            if ( $warning == true ) {
                $field['msg']      = 'your custom warning message';
                $return['warning'] = $field;
            }

            return $return;
        }
    }

    /**
     * Custom function for the callback referenced above
     */
    if ( ! function_exists( 'redux_my_custom_field' ) ) {
        function redux_my_custom_field( $field, $value ) {
            print_r( $field );
            echo '<br/>';
            print_r( $value );
        }
    }

    /**
     * Custom function for filtering the sections array. Good for child themes to override or add to the sections.
     * Simply include this function in the child themes functions.php file.
     * NOTE: the defined constants for URLs, and directories will NOT be available at this point in a child theme,
     * so you must use get_template_directory_uri() if you want to use any of the built in icons
     * */
    if ( ! function_exists( 'dynamic_section' ) ) {
        function dynamic_section( $sections ) {
            //$sections = array();
            $sections[] = array(
                'title'  => __( 'Section via hook', 'konsal' ),
                'desc'   => __( '<p class="description">This is a section created by adding a filter to the sections array. Can be used by child themes to add/remove sections from the options.</p>', 'konsal' ),
                'icon'   => 'el el-paper-clip',
                // Leave this as a blank section, no options just some intro text set above.
                'fields' => array()
            );

            return $sections;
        }
    }

    /**
     * Filter hook for filtering the args. Good for child themes to override or add to the args array. Can also be used in other functions.
     * */
    if ( ! function_exists( 'change_arguments' ) ) {
        function change_arguments( $args ) {
            //$args['dev_mode'] = true;

            return $args;
        }
    }

    /**
     * Filter hook for filtering the default value of any given field. Very useful in development mode.
     * */
    if ( ! function_exists( 'change_defaults' ) ) {
        function change_defaults( $defaults ) {
            $defaults['str_replace'] = 'Testing filter hook!';

            return $defaults;
        }
    }