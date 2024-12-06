<?php
namespace TheBestTestimonials;

define('TBT_TEST_ASFSK_ASSETS_ADMIN_DIR_FILE', plugin_dir_url(__FILE__) . 'assets/admin');
class TheBestTestimonials {

	private static $_instance = null;

	public static function instance() {
		if ( is_null( self::$_instance ) ) {
			self::$_instance = new self();
		}
		return self::$_instance;
	}

	public function tbt_admin_editor_scripts() {
		add_filter( 'script_loader_tag', [ $this, 'tbt_admin_editor_scripts_as_a_module' ], 10, 2 );
	}

	public function tbt_admin_editor_scripts_as_a_module( $tag, $handle ) {
		if ( 'tbt_meet_the_team_editor' === $handle ) {
			$tag = str_replace( '<script', '<script type="module"', $tag );
		}

		return $tag;
	}

	private function include_widgets_files() {
		require_once( __DIR__ . '/widgets/tbt_testimonial.php' );
	}

	public function tbt_register_widgets() {
		// Its is now safe to include Widgets files
		$this->include_widgets_files(); 

		// Register Widgets
		\Elementor\Plugin::instance()->widgets_manager->register_widget_type( new Widgets\TBTTheBestTestimonials() );
	}

	// Register Category
	function tbt_add_elementor_widget_categories( $elements_manager ) {

		$elements_manager->add_category(
			'bwd-testimonials',
			[
				'title' => esc_html__( 'BWD Testimonials', 'bwd-testimonials' ),
				'icon' => 'eicon-person',
			]
		);
	}
	public function tbt_all_assets_for_the_public(){
		$tbt_cdn_all = plugin_dir_url( __FILE__ ) . 'assets/public/';
		wp_enqueue_script( 'tbt_testimonials_carouseljs', $tbt_cdn_all.'owl.carousel.min.js', array('jquery'), '2.7', true );
		wp_enqueue_script( 'tbt_testimonials_mainjs', $tbt_cdn_all.'main.js', array('jquery'), '2.7', true );
		$all_css_js_file = array(
            'tbt_testimonials_the_carouselcss' => array('tbt_path_define_with_testimonials'=>$tbt_cdn_all.'owl.carousel.min.css'),
            'tbt_testimonials_the_carousel_themecss' => array('tbt_path_define_with_testimonials'=>$tbt_cdn_all.'owl.theme.default.min.css'),
            'tbt_testimonials_the_tbt_main_css' => array('tbt_path_define_with_testimonials'=>$tbt_cdn_all.'tbt_main.css'),
        );
        foreach($all_css_js_file as $handle => $fileinfo){
            wp_enqueue_style( $handle, $fileinfo['tbt_path_define_with_testimonials'], null, '2.7', 'all');
        }
	}
	public function tbt_all_assets_for_elementor_editor_admin(){
		$all_css_js_file = array(
            'tbt_testimonials_admin_main_css' => array('tbt_path_admin_define'=>TBT_TEST_ASFSK_ASSETS_ADMIN_DIR_FILE . '/icon.css'),
        );
        foreach($all_css_js_file as $handle => $fileinfo){
            wp_enqueue_style( $handle, $fileinfo['tbt_path_admin_define'], null, '2.7', 'all');
        }
	}
	

	public function __construct() {

		// For public assets
		add_action('wp_enqueue_scripts', [$this, 'tbt_all_assets_for_the_public']);

		// For Elementor Editor
		add_action('elementor/editor/before_enqueue_scripts', [$this, 'tbt_all_assets_for_elementor_editor_admin']);

		// Register Category
		add_action( 'elementor/elements/categories_registered', [ $this, 'tbt_add_elementor_widget_categories' ] );

		// Register widgets
		add_action( 'elementor/widgets/widgets_registered', [ $this, 'tbt_register_widgets' ] );

		// Register editor scripts
		add_action( 'elementor/editor/after_enqueue_scripts', [ $this, 'tbt_admin_editor_scripts' ] );
	}
}

// Instantiate Plugin Class
TheBestTestimonials::instance();

