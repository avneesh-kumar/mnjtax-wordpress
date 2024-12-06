<?php
if ( ! defined( 'ABSPATH' ) ) {

	exit; // Exit if accessed directly.
}

/**
 * Main Konsal Core Class
 *
 * The main class that initiates and runs the plugin.
 *
 * @since 1.0.0
 */

final class Konsal_Extension {

	/**
	 * Plugin Version
	 *
	 * @since 1.0.0
	 *
	 * @var string The plugin version.
	 */
	const VERSION = '1.0.0';

	/**
	 * Minimum Elementor Version
	 *
	 * @since 1.0.0
	 *
	 * @var string Minimum Elementor version required to run the plugin.
	 */

	const MINIMUM_ELEMENTOR_VERSION = '2.0.0';

	/**
	 * Minimum PHP Version
	 *
	 * @since 1.0.0
	 *
	 * @var string Minimum PHP version required to run the plugin.
	 */
	const MINIMUM_PHP_VERSION = '7.0';


	/**
	 * Instance
	 *
	 * @since 1.0.0
	 *
	 * @access private
	 * @static
	 *
	 * @var Elementor_Test_Extension The single instance of the class.
	 */

	private static $_instance = null;

	/**
	 * Instance
	 *
	 * Ensures only one instance of the class is loaded or can be loaded.
	 *
	 * @since 1.0.0
	 *
	 * @access public
	 * @static
	 *
	 * @return Elementor_Test_Extension An instance of the class.
	 */
	public static function instance() {

		if ( is_null( self::$_instance ) ) {
			self::$_instance = new self();
		}
		return self::$_instance;

	}

	/**
	 * Constructor
	 *
	 * @since 1.0.0
	 *
	 * @access public
	 */
	public function __construct() {
		add_action( 'plugins_loaded', [ $this, 'init' ] );
	}

	/**
	 * Initialize the plugin
	 *
	 * Load the plugin only after Elementor (and other plugins) are loaded.
	 * Checks for basic plugin requirements, if one check fail don't continue,
	 * if all check have passed load the files required to run the plugin.
	 *
	 * Fired by `plugins_loaded` action hook.
	 *
	 * @since 1.0.0
	 *
	 * @access public
	 */
	public function init() {

		// Check if Elementor installed and activated

		if ( ! did_action( 'elementor/loaded' ) ) {
			add_action( 'admin_notices', [ $this, 'admin_notice_missing_main_plugin' ] );
			return;
		}

		// Check for required Elementor version

		if ( ! version_compare( ELEMENTOR_VERSION, self::MINIMUM_ELEMENTOR_VERSION, '>=' ) ) {
			add_action( 'admin_notices', [ $this, 'admin_notice_minimum_elementor_version' ] );
			return;
		}

		// Check for required PHP version

		if ( version_compare( PHP_VERSION, self::MINIMUM_PHP_VERSION, '<' ) ) {
			add_action( 'admin_notices', [ $this, 'admin_notice_minimum_php_version' ] );
			return;
		}


		// Add Plugin actions

		add_action( 'elementor/widgets/widgets_registered', [ $this, 'init_widgets' ] );


        // Register widget scripts

		add_action( 'elementor/frontend/after_enqueue_scripts', [ $this, 'widget_scripts' ]);


		// Specific Register widget scripts

		// add_action( 'elementor/frontend/after_register_scripts', [ $this, 'konsal_regsiter_widget_scripts' ] );
		// add_action( 'elementor/frontend/before_register_scripts', [ $this, 'konsal_regsiter_widget_scripts' ] );


        // category register

		add_action( 'elementor/elements/categories_registered',[ $this, 'konsal_elementor_widget_categories' ] );
	}

	/**
	 * Admin notice
	 *
	 * Warning when the site doesn't have Elementor installed or activated.
	 *
	 * @since 1.0.0
	 *
	 * @access public
	 */
	public function admin_notice_missing_main_plugin() {

		if ( isset( $_GET['activate'] ) ) unset( $_GET['activate'] );

		$message = sprintf(
			/* translators: 1: Plugin name 2: Elementor */
			esc_html__( '"%1$s" requires "%2$s" to be installed and activated.', 'konsal' ),
			'<strong>' . esc_html__( 'Konsal Core', 'konsal' ) . '</strong>',
			'<strong>' . esc_html__( 'Elementor', 'konsal' ) . '</strong>'
		);

		printf( '<div class="notice notice-warning is-dismissible"><p>%1$s</p></div>', $message );
	}

	/**
	 * Admin notice
	 *
	 * Warning when the site doesn't have a minimum required Elementor version.
	 *
	 * @since 1.0.0
	 *
	 * @access public
	 */
	public function admin_notice_minimum_elementor_version() {

		if ( isset( $_GET['activate'] ) ) unset( $_GET['activate'] );

		$message = sprintf(
			/* translators: 1: Plugin name 2: Elementor 3: Required Elementor version */

			esc_html__( '"%1$s" requires "%2$s" version %3$s or greater.', 'konsal' ),
			'<strong>' . esc_html__( 'Konsal Core', 'konsal' ) . '</strong>',
			'<strong>' . esc_html__( 'Elementor', 'konsal' ) . '</strong>',
			 self::MINIMUM_ELEMENTOR_VERSION
		);

		printf( '<div class="notice notice-warning is-dismissible"><p>%1$s</p></div>', $message );
	}
	/**
	 * Admin notice
	 *
	 * Warning when the site doesn't have a minimum required PHP version.
	 *
	 * @since 1.0.0
	 *
	 * @access public
	 */
	public function admin_notice_minimum_php_version() {

		if ( isset( $_GET['activate'] ) ) unset( $_GET['activate'] );

		$message = sprintf(

			/* translators: 1: Plugin name 2: PHP 3: Required PHP version */
			esc_html__( '"%1$s" requires "%2$s" version %3$s or greater.', 'konsal' ),
			'<strong>' . esc_html__( 'Konsal Core', 'konsal' ) . '</strong>',
			'<strong>' . esc_html__( 'PHP', 'konsal' ) . '</strong>',
			 self::MINIMUM_PHP_VERSION
		);

		printf( '<div class="notice notice-warning is-dismissible"><p>%1$s</p></div>', $message );
	}

	/**
	 * Init Widgets
	 *
	 * Include widgets files and register them
	 *
	 * @since 1.0.0
	 *
	 * @access public
	 */

	public function init_widgets() {

		// Include Widget files

		require_once( KONSAL_ADDONS . '/widgets/konsal-banner.php' );
		require_once( KONSAL_ADDONS . '/widgets/konsal-banner2.php' );
		require_once( KONSAL_ADDONS . '/widgets/konsal-banner3.php' );
		require_once( KONSAL_ADDONS . '/widgets/konsal-section-title.php' );
		require_once( KONSAL_ADDONS . '/widgets/konsal-features.php' );
		require_once( KONSAL_ADDONS . '/widgets/konsal-button.php' );
		require_once( KONSAL_ADDONS . '/widgets/konsal-service.php' );
		require_once( KONSAL_ADDONS . '/widgets/konsal-service2.php' );
		require_once( KONSAL_ADDONS . '/widgets/konsal-group-image.php' );
		require_once( KONSAL_ADDONS . '/widgets/konsal-group-image2.php' );
		require_once( KONSAL_ADDONS . '/widgets/konsal-faq.php' );
		require_once( KONSAL_ADDONS . '/widgets/konsal-image.php' );
		require_once( KONSAL_ADDONS . '/widgets/konsal-price.php' );
		require_once( KONSAL_ADDONS . '/widgets/konsal-project.php' );
		require_once( KONSAL_ADDONS . '/widgets/konsal-team.php' );
		require_once( KONSAL_ADDONS . '/widgets/konsal-counterup.php' );
		require_once( KONSAL_ADDONS . '/widgets/konsal-blog.php' );
		require_once( KONSAL_ADDONS . '/widgets/konsal-testimonials.php' );
		require_once( KONSAL_ADDONS . '/widgets/konsal-workprocess.php' );
		require_once( KONSAL_ADDONS . '/widgets/konsal-contactform.php' );

		require_once( KONSAL_ADDONS . '/widgets/konsal-menu-select.php' );
		require_once( KONSAL_ADDONS . '/widgets/konsal-gallery.php' );
		require_once( KONSAL_ADDONS . '/widgets/konsal-contact-info.php' );
		require_once( KONSAL_ADDONS . '/widgets/konsal-footer-widgets.php' );
		require_once( KONSAL_ADDONS . '/widgets/konsal-brand-logo.php' );
		require_once( KONSAL_ADDONS . '/widgets/konsal-progress-bar.php' );
		require_once( KONSAL_ADDONS . '/widgets/konsal-service-list.php' );
		require_once( KONSAL_ADDONS . '/widgets/konsal-download-button.php' );
		require_once( KONSAL_ADDONS . '/widgets/konsal-team-details.php' );
		require_once( KONSAL_ADDONS . '/widgets/konsal-project-info.php' );
		require_once( KONSAL_ADDONS . '/widgets/konsal-info-box.php' );
		require_once( KONSAL_ADDONS . '/widgets/konsal-choose-us.php' );
		require_once( KONSAL_ADDONS . '/widgets/konsal-animated-shape.php' );
		require_once( KONSAL_ADDONS . '/widgets/konsal-cta.php' );
		require_once( KONSAL_ADDONS . '/widgets/konsal-skill.php' );
		require_once( KONSAL_ADDONS . '/widgets/konsal-video.php' );
		require_once( KONSAL_ADDONS . '/widgets/konsal-schedule.php' );
		require_once( KONSAL_ADDONS . '/widgets/konsal-tab-builder.php' );
		
		
		// Register widget

		\Elementor\Plugin::instance()->widgets_manager->register_widget_type( new \Konsal_Banner() );
		\Elementor\Plugin::instance()->widgets_manager->register_widget_type( new \Konsal_Banner2() );
		\Elementor\Plugin::instance()->widgets_manager->register_widget_type( new \Konsal_Banner3() );
		\Elementor\Plugin::instance()->widgets_manager->register_widget_type( new \Konsal_Section_Title_Widget() );
		\Elementor\Plugin::instance()->widgets_manager->register_widget_type( new \Konsal_Features() );
		\Elementor\Plugin::instance()->widgets_manager->register_widget_type( new \Konsal_Button() );
		\Elementor\Plugin::instance()->widgets_manager->register_widget_type( new \Konsal_Service() );
		\Elementor\Plugin::instance()->widgets_manager->register_widget_type( new \Konsal_Service2() );
		\Elementor\Plugin::instance()->widgets_manager->register_widget_type( new \Konsal_Group_Image() );
		\Elementor\Plugin::instance()->widgets_manager->register_widget_type( new \Konsal_Group_Image2() );
		\Elementor\Plugin::instance()->widgets_manager->register_widget_type( new \Konsal_Faq() );
		\Elementor\Plugin::instance()->widgets_manager->register_widget_type( new \Konsal_Image() );
		\Elementor\Plugin::instance()->widgets_manager->register_widget_type( new \Konsal_Price() );
		\Elementor\Plugin::instance()->widgets_manager->register_widget_type( new \Konsal_Project() );
		\Elementor\Plugin::instance()->widgets_manager->register_widget_type( new \Konsal_Team() );
		\Elementor\Plugin::instance()->widgets_manager->register_widget_type( new \Konsal_CounterUp() );
		\Elementor\Plugin::instance()->widgets_manager->register_widget_type( new \Konsal_Blog_Post() );
		\Elementor\Plugin::instance()->widgets_manager->register_widget_type( new \Konsal_Testimonials() );
		\Elementor\Plugin::instance()->widgets_manager->register_widget_type( new \Konsal_Workprocess() );
		\Elementor\Plugin::instance()->widgets_manager->register_widget_type( new \Konsal_Contact_Form() );

		\Elementor\Plugin::instance()->widgets_manager->register_widget_type( new \konsal_Menu() );
		\Elementor\Plugin::instance()->widgets_manager->register_widget_type( new \konsal_Gallery() );
		\Elementor\Plugin::instance()->widgets_manager->register_widget_type( new \konsal_Contact_Info() );
		\Elementor\Plugin::instance()->widgets_manager->register_widget_type( new \konsal_Footer_Widgets() );
		\Elementor\Plugin::instance()->widgets_manager->register_widget_type( new \konsal_Brand_Logo() );
		\Elementor\Plugin::instance()->widgets_manager->register_widget_type( new \konsal_Progress_Bar() );
		\Elementor\Plugin::instance()->widgets_manager->register_widget_type( new \konsal_Service_List() );
		\Elementor\Plugin::instance()->widgets_manager->register_widget_type( new \Konsal_Download_Button() );
		\Elementor\Plugin::instance()->widgets_manager->register_widget_type( new \konsal_Team_Info() );
		\Elementor\Plugin::instance()->widgets_manager->register_widget_type( new \konsal_Project_Info() );
		\Elementor\Plugin::instance()->widgets_manager->register_widget_type( new \Konsal_Info_Box() );
		\Elementor\Plugin::instance()->widgets_manager->register_widget_type( new \Konsal_Choose() );
		\Elementor\Plugin::instance()->widgets_manager->register_widget_type( new \Konsal_Animated_Image() );
		\Elementor\Plugin::instance()->widgets_manager->register_widget_type( new \konsal_Cta() );
		\Elementor\Plugin::instance()->widgets_manager->register_widget_type( new \Konsal_Skill() );
		\Elementor\Plugin::instance()->widgets_manager->register_widget_type( new \konsal_Video() );
		\Elementor\Plugin::instance()->widgets_manager->register_widget_type( new \Konsal_Schedule() );
		\Elementor\Plugin::instance()->widgets_manager->register_widget_type( new \Konsal_Tab_Builder() );
		

		// Header Elements

		require_once( KONSAL_ADDONS . '/header/header.php' );
		require_once( KONSAL_ADDONS . '/header/header2.php' );

		

		// Header Widget Register

		\Elementor\Plugin::instance()->widgets_manager->register_widget_type( new \Konsal_Header() );
		\Elementor\Plugin::instance()->widgets_manager->register_widget_type( new \Konsal_Header2() );

	}

    public function widget_scripts() {

        // wp_enqueue_script(
        //     'konsal-frontend-script',
        //     KONSAL_PLUGDIRURI . 'assets/js/konsal-frontend.js',
        //     array('jquery'),
        //     false,
        //     true
		// );

	}

    function konsal_elementor_widget_categories( $elements_manager ) {

        $elements_manager->add_category(
            'konsal',
            [
                'title' => __( 'Konsal', 'konsal' ),
                'icon' 	=> 'fa fa-plug',
            ]
        );

        $elements_manager->add_category(
            'konsal_footer_elements',
            [
                'title' => __( 'Konsal Footer Elements', 'konsal' ),
                'icon' 	=> 'fa fa-plug',
            ]
		);

		$elements_manager->add_category(
            'konsal_header_elements',
            [
                'title' => __( 'Konsal Header Elements', 'konsal' ),
                'icon' 	=> 'fa fa-plug',
            ]
        );
	}
}

Konsal_Extension::instance();