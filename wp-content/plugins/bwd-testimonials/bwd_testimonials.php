<?php
/**
 * Plugin Name: BWD Testimonials
 * Description: BWD Testimonials is beautiful responsive testimonial with slider and powerfull testimonial submitter for blogs and sites.
 * Plugin URI:  https://bestwpdeveloper.com/plugins/elementor/bwd-testimonials
 * Version:     2.7
 * Author:      Best WP Developer
 * Author URI:  https://bestwpdeveloper.com/
 * Text Domain: bwd-testimonials
 * Elementor tested up to: 3.0.0
 * Elementor Pro tested up to: 3.7.3
 */

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly
require_once ( plugin_dir_path(__FILE__) ) . '/includes/requires-check.php';
final class The_Best_Testimonials{

	const VERSION = '2.7';

	const MINIMUM_ELEMENTOR_VERSION = '3.0.0';

	const MINIMUM_PHP_VERSION = '7.0';

	public function __construct() {

		// Load translation
		add_action( 'tbt_init', array( $this, 'tbt_loaded_textdomain' ) );

		// tbt_init Plugin
		add_action( 'plugins_loaded', array( $this, 'tbt_init' ) );
	}

	public function tbt_loaded_textdomain() {
		load_plugin_textdomain( 'bwd-testimonials' );
	}

	public function tbt_init() {

		// Check if Elementor installed and activated
		if ( ! did_action( 'elementor/loaded' ) ) {
			add_action( 'admin_notices', 'tbt_admin_notice_missing_main_plugin');
			return;
		}

		// Check for required Elementor version
		if ( ! version_compare( ELEMENTOR_VERSION, self::MINIMUM_ELEMENTOR_VERSION, '>=' ) ) {
			add_action( 'admin_notices', array( $this, 'tbt_admin_notice_minimum_elementor_version' ) );
			return;
		}

		// Check for required PHP version
		if ( version_compare( PHP_VERSION, self::MINIMUM_PHP_VERSION, '<' ) ) {
			add_action( 'admin_notices', array( $this, 'tbt_admin_notice_minimum_php_version' ) );
			return;
		}

		// Once we get here, We have passed all validation checks so we can safely include our plugin
		require_once( 'tbt_plugin_boots.php' );
		require_once( 'includes/admin-notice.php' );
		$this->tbt_appsero_connect();
	}

	public function tbt_appsero_connect(){
		require __DIR__ . '/vendor/autoload.php';
		function tbt_appsero_init_() {
			if ( ! class_exists( 'Appsero\Client' ) ) {
			require_once __DIR__ . '/appsero/src/Client.php';
			}
			$client = new Appsero\Client( '2a88c952-3596-441b-827d-c2a24d2ba7d8', 'BWD Testimonials', __FILE__ );
			$client->insights()->init();
		}
		tbt_appsero_init_();
	}

	public function tbt_admin_notice_missing_main_plugin() {
		if ( isset( $_GET['activate'] ) ) {
			unset( $_GET['activate'] );
		}

		$message = sprintf(
			esc_html__( '"%1$s" requires "%2$s" to be installed and activated.', 'bwd-testimonials' ),
			'<strong>' . esc_html__( 'BWD Testimonials', 'bwd-testimonials' ) . '</strong>',
			'<strong>' . esc_html__( 'Elementor', 'bwd-testimonials' ) . '</strong>'
		);

		printf( '<div class="notice notice-warning is-dismissible"><p>' . esc_html__('%1$s', 'bwd-testimonials') . '</p></div>', $message );
	}

	public function tbt_admin_notice_minimum_elementor_version() {
		if ( isset( $_GET['activate'] ) ) {
			unset( $_GET['activate'] );
		}

		$message = sprintf(
			esc_html__( '"%1$s" requires "%2$s" version %3$s or greater.', 'bwd-testimonials' ),
			'<strong>' . esc_html__( 'BWD Testimonials', 'bwd-testimonials' ) . '</strong>',
			'<strong>' . esc_html__( 'Elementor', 'bwd-testimonials' ) . '</strong>',
			self::MINIMUM_ELEMENTOR_VERSION
		);

		printf( '<div class="notice notice-warning is-dismissible"><p>' . esc_html__('%1$s', 'bwd-testimonials') . '</p></div>', $message );
	}

	public function tbt_admin_notice_minimum_php_version() {
		if ( isset( $_GET['activate'] ) ) {
			unset( $_GET['activate'] );
		}

		$message = sprintf(
			esc_html__( '"%1$s" requires "%2$s" version %3$s or greater.', 'bwd-testimonials' ),
			'<strong>' . esc_html__( 'BWD Testimonials', 'bwd-testimonials' ) . '</strong>',
			'<strong>' . esc_html__( 'PHP', 'bwd-testimonials' ) . '</strong>',
			self::MINIMUM_PHP_VERSION
		);

		printf( '<div class="notice notice-warning is-dismissible"><p>' . esc_html__('%1$s', 'bwd-testimonials') . '</p></div>', $message );
	}
}

// Instantiate bwd-testimonials.
new The_Best_Testimonials();
remove_action( 'shutdown', 'wp_ob_end_flush_all', 1 );