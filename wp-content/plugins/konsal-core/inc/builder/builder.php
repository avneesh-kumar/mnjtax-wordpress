<?php
    /**
     * Class For Builder
     */
    class KonsalBuilder{

        function __construct(){
            // register admin menus
        	add_action( 'admin_menu', [$this, 'register_settings_menus'] );

            // Custom Footer Builder With Post Type
			add_action( 'init',[ $this,'post_type' ],0 );

 		    add_action( 'elementor/frontend/after_enqueue_scripts', [ $this,'widget_scripts'] );

			add_filter( 'single_template', [ $this, 'load_canvas_template' ] );

            add_action( 'elementor/element/wp-page/document_settings/after_section_end', [ $this,'konsal_add_elementor_page_settings_controls' ],10,2 );

		}

		public function widget_scripts( ) {
			wp_enqueue_script( 'konsal-core',KONSAL_PLUGDIRURI.'assets/js/konsal-core.js',array( 'jquery' ),'1.0',true );
		}


        public function konsal_add_elementor_page_settings_controls( \Elementor\Core\DocumentTypes\Page $page ){

			$page->start_controls_section(
                'konsal_header_option',
                [
                    'label'     => __( 'Header Option', 'konsal' ),
                    'tab'       => \Elementor\Controls_Manager::TAB_SETTINGS,
                ]
            );


            $page->add_control(
                'konsal_header_style',
                [
                    'label'     => __( 'Header Option', 'konsal' ),
                    'type'      => \Elementor\Controls_Manager::SELECT,
                    'options'   => [
    					'prebuilt'             => __( 'Pre Built', 'konsal' ),
    					'header_builder'       => __( 'Header Builder', 'konsal' ),
    				],
                    'default'   => 'prebuilt',
                ]
			);

            $page->add_control(
                'konsal_header_builder_option',
                [
                    'label'     => __( 'Header Name', 'konsal' ),
                    'type'      => \Elementor\Controls_Manager::SELECT,
                    'options'   => $this->konsal_header_choose_option(),
                    'condition' => [ 'konsal_header_style' => 'header_builder'],
                    'default'	=> ''
                ]
            );

            $page->end_controls_section();

            $page->start_controls_section(
                'konsal_footer_option',
                [
                    'label'     => __( 'Footer Option', 'konsal' ),
                    'tab'       => \Elementor\Controls_Manager::TAB_SETTINGS,
                ]
            );
            $page->add_control(
    			'konsal_footer_choice',
    			[
    				'label'         => __( 'Enable Footer?', 'konsal' ),
    				'type'          => \Elementor\Controls_Manager::SWITCHER,
    				'label_on'      => __( 'Yes', 'konsal' ),
    				'label_off'     => __( 'No', 'konsal' ),
    				'return_value'  => 'yes',
    				'default'       => 'yes',
    			]
    		);
            $page->add_control(
                'konsal_footer_style',
                [
                    'label'     => __( 'Footer Style', 'konsal' ),
                    'type'      => \Elementor\Controls_Manager::SELECT,
                    'options'   => [
    					'prebuilt'             => __( 'Pre Built', 'konsal' ),
    					'footer_builder'       => __( 'Footer Builder', 'konsal' ),
    				],
                    'default'   => 'prebuilt',
                    'condition' => [ 'konsal_footer_choice' => 'yes' ],
                ]
            );
            $page->add_control(
                'konsal_footer_builder_option',
                [
                    'label'     => __( 'Footer Name', 'konsal' ),
                    'type'      => \Elementor\Controls_Manager::SELECT,
                    'options'   => $this->konsal_footer_build_choose_option(),
                    'condition' => [ 'konsal_footer_style' => 'footer_builder','konsal_footer_choice' => 'yes' ],
                    'default'	=> ''
                ]
            );

			$page->end_controls_section();

        }

		public function register_settings_menus(){
			add_menu_page(
				esc_html__( 'Konsal Builder', 'konsal' ),
            	esc_html__( 'Konsal Builder', 'konsal' ),
				'manage_options',
				'konsal',
				[$this,'register_settings_contents__settings'],
				'dashicons-admin-site',
				2
			);

			add_submenu_page('konsal', esc_html__('Footer Builder', 'konsal'), esc_html__('Footer Builder', 'konsal'), 'manage_options', 'edit.php?post_type=konsal_footer_build');
			add_submenu_page('konsal', esc_html__('Header Builder', 'konsal'), esc_html__('Header Builder', 'konsal'), 'manage_options', 'edit.php?post_type=konsal_header');
			add_submenu_page('konsal', esc_html__('Tab Builder', 'konsal'), esc_html__('Tab Builder', 'konsal'), 'manage_options', 'edit.php?post_type=konsal_tab_builder');
		}

		// Callback Function
		public function register_settings_contents__settings(){
            echo '<h2>';
			    echo esc_html__( 'Welcome To Header And Footer Builder Of This Theme','konsal' );
            echo '</h2>';
		}

		public function post_type() {

			$labels = array(
				'name'               => __( 'Footer', 'konsal' ),
				'singular_name'      => __( 'Footer', 'konsal' ),
				'menu_name'          => __( 'Konsal Footer Builder', 'konsal' ),
				'name_admin_bar'     => __( 'Footer', 'konsal' ),
				'add_new'            => __( 'Add New', 'konsal' ),
				'add_new_item'       => __( 'Add New Footer', 'konsal' ),
				'new_item'           => __( 'New Footer', 'konsal' ),
				'edit_item'          => __( 'Edit Footer', 'konsal' ),
				'view_item'          => __( 'View Footer', 'konsal' ),
				'all_items'          => __( 'All Footer', 'konsal' ),
				'search_items'       => __( 'Search Footer', 'konsal' ),
				'parent_item_colon'  => __( 'Parent Footer:', 'konsal' ),
				'not_found'          => __( 'No Footer found.', 'konsal' ),
				'not_found_in_trash' => __( 'No Footer found in Trash.', 'konsal' ),
			);

			$args = array(
				'labels'              => $labels,
				'public'              => true,
				'rewrite'             => false,
				'show_ui'             => true,
				'show_in_menu'        => false,
				'show_in_nav_menus'   => false,
				'exclude_from_search' => true,
				'capability_type'     => 'post',
				'hierarchical'        => false,
				'supports'            => array( 'title', 'elementor' ),
			);

			register_post_type( 'konsal_footer_build', $args );

			$labels = array(
				'name'               => __( 'Header', 'konsal' ),
				'singular_name'      => __( 'Header', 'konsal' ),
				'menu_name'          => __( 'Konsal Header Builder', 'konsal' ),
				'name_admin_bar'     => __( 'Header', 'konsal' ),
				'add_new'            => __( 'Add New', 'konsal' ),
				'add_new_item'       => __( 'Add New Header', 'konsal' ),
				'new_item'           => __( 'New Header', 'konsal' ),
				'edit_item'          => __( 'Edit Header', 'konsal' ),
				'view_item'          => __( 'View Header', 'konsal' ),
				'all_items'          => __( 'All Header', 'konsal' ),
				'search_items'       => __( 'Search Header', 'konsal' ),
				'parent_item_colon'  => __( 'Parent Header:', 'konsal' ),
				'not_found'          => __( 'No Header found.', 'konsal' ),
				'not_found_in_trash' => __( 'No Header found in Trash.', 'konsal' ),
			);

			$args = array(
				'labels'              => $labels,
				'public'              => true,
				'rewrite'             => false,
				'show_ui'             => true,
				'show_in_menu'        => false,
				'show_in_nav_menus'   => false,
				'exclude_from_search' => true,
				'capability_type'     => 'post',
				'hierarchical'        => false,
				'supports'            => array( 'title', 'elementor' ),
			);

			register_post_type( 'konsal_header', $args );

			$labels = array(
				'name'               => __( 'Tab Builder', 'konsal' ),
				'singular_name'      => __( 'Tab Builder', 'konsal' ),
				'menu_name'          => __( 'Gesund Tab Builder', 'konsal' ),
				'name_admin_bar'     => __( 'Tab Builder', 'konsal' ),
				'add_new'            => __( 'Add New', 'konsal' ),
				'add_new_item'       => __( 'Add New Tab Builder', 'konsal' ),
				'new_item'           => __( 'New Tab Builder', 'konsal' ),
				'edit_item'          => __( 'Edit Tab Builder', 'konsal' ),
				'view_item'          => __( 'View Tab Builder', 'konsal' ),
				'all_items'          => __( 'All Tab Builder', 'konsal' ),
				'search_items'       => __( 'Search Tab Builder', 'konsal' ),
				'parent_item_colon'  => __( 'Parent Tab Builder:', 'konsal' ),
				'not_found'          => __( 'No Tab Builder found.', 'konsal' ),
				'not_found_in_trash' => __( 'No Tab Builder found in Trash.', 'konsal' ),
			);

			$args = array(
				'labels'              => $labels,
				'public'              => true,
				'rewrite'             => false,
				'show_ui'             => true,
				'show_in_menu'        => false,
				'show_in_nav_menus'   => false,
				'exclude_from_search' => true,
				'capability_type'     => 'post',
				'hierarchical'        => false,
				'supports'            => array( 'title', 'elementor' ),
			);

			register_post_type( 'konsal_tab_builder', $args );
		}

		function load_canvas_template( $single_template ) {

			global $post;

			if ( 'konsal_footer_build' == $post->post_type || 'konsal_header' == $post->post_type || 'konsal_tab_build' == $post->post_type ) {

				$elementor_2_0_canvas = ELEMENTOR_PATH . '/modules/page-templates/templates/canvas.php';

				if ( file_exists( $elementor_2_0_canvas ) ) {
					return $elementor_2_0_canvas;
				} else {
					return ELEMENTOR_PATH . '/includes/page-templates/canvas.php';
				}
			}

			return $single_template;
		}

        public function konsal_footer_build_choose_option(){

			$konsal_post_query = new WP_Query( array(
				'post_type'			=> 'konsal_footer_build',
				'posts_per_page'	    => -1,
			) );

			$konsal_builder_post_title = array();
			$konsal_builder_post_title[''] = __('Select a Footer','Konsal');

			while( $konsal_post_query->have_posts() ) {
				$konsal_post_query->the_post();
				$konsal_builder_post_title[ get_the_ID() ] =  get_the_title();
			}
			wp_reset_postdata();

			return $konsal_builder_post_title;

		}

		public function konsal_header_choose_option(){

			$konsal_post_query = new WP_Query( array(
				'post_type'			=> 'konsal_header',
				'posts_per_page'	    => -1,
			) );

			$konsal_builder_post_title = array();
			$konsal_builder_post_title[''] = __('Select a Header','Konsal');

			while( $konsal_post_query->have_posts() ) {
				$konsal_post_query->the_post();
				$konsal_builder_post_title[ get_the_ID() ] =  get_the_title();
			}
			wp_reset_postdata();

			return $konsal_builder_post_title;

        }

    }

    $builder_execute = new KonsalBuilder();