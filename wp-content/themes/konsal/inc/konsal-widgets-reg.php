<?php
/**
 * @Packge     : Konsal
 * @Version    : 1.0
 * @Author     : Themeholy
 * @Author URI : https://www.themeholy.com/
 *
 */


// Block direct access
if( !defined( 'ABSPATH' ) ){
    exit;
}

function konsal_widgets_init() {

    if( class_exists('ReduxFramework') ) {
        $konsal_sidebar_widget_title_heading_tag = konsal_opt('konsal_sidebar_widget_title_heading_tag');
    } else {
        $konsal_sidebar_widget_title_heading_tag = 'h3';
    }

    //sidebar widgets register
    register_sidebar( array(
        'name'          => esc_html__( 'Blog Sidebar', 'konsal' ),
        'id'            => 'konsal-blog-sidebar',
        'description'   => esc_html__( 'Add Blog Sidebar Widgets Here.', 'konsal' ),
        'before_widget' => '<div id="%1$s" class="widget %2$s">',
        'after_widget'  => '</div>',
        'before_title'  => '<h3 class="widget_title">',
        'after_title'   => '</h3>',
    ) );

    // page sidebar widgets register
    register_sidebar( array(
        'name'          => esc_html__( 'Page Sidebar', 'konsal' ),
        'id'            => 'konsal-page-sidebar',
        'description'   => esc_html__( 'Add Page Sidebar Widgets Here.', 'konsal' ),
        'before_widget' => '<div id="%1$s" class="widget %2$s">',
        'after_widget'  => '</div>',
        'before_title'  => '<h3 class="widget_title">',
        'after_title'   => '</h3>',
    ) );
    if( class_exists( 'ReduxFramework' ) ){
        // footer widgets register
        register_sidebar( array(
           'name'          => esc_html__( 'Footer Widgets Area 1', 'konsal' ),
           'id'            => 'konsal-footer-1',
           'before_widget' => '<div class="col-md-6 col-xxl-3 col-xl-4"><div id="%1$s" class="widget footer-widget %2$s">',
           'after_widget'  => '</div></div>',
           'before_title'  => '<h3 class="widget_title">',
           'after_title'   => '</h3>',
        ) );
        register_sidebar( array(
           'name'          => esc_html__( 'Footer Widgets Area 2', 'konsal' ),
           'id'            => 'konsal-footer-2',
           'before_widget' => '<div class="col-md-6 col-xl-auto"><div id="%1$s" class="widget footer-widget %2$s">',
           'after_widget'  => '</div></div>',
           'before_title'  => '<h3 class="widget_title">',
           'after_title'   => '</h3>',
        ) );
        register_sidebar( array(
           'name'          => esc_html__( 'Footer Widgets Area 3', 'konsal' ),
           'id'            => 'konsal-footer-3',
           'before_widget' => '<div class="col-md-6 col-xl-auto"><div id="%1$s" class="widget footer-widget %2$s">',
           'after_widget'  => '</div></div>',
           'before_title'  => '<h3 class="widget_title">',
           'after_title'   => '</h3>',
        ) );
        register_sidebar( array(
           'name'          => esc_html__( 'Footer Widgets Area 4', 'konsal' ),
           'id'            => 'konsal-footer-4',
           'before_widget' => '<div class="col-md-6 col-xl-auto"><div id="%1$s" class="widget newsletter-widget footer-widget %2$s">',
           'after_widget'  => '</div></div>',
           'before_title'  => '<h3 class="widget_title">',
           'after_title'   => '</h3>',
        ) );
    }
    // Offcanvas sidebar widgets register
    register_sidebar( array(
        'name'          => esc_html__( 'Offcanvas Sidebar', 'konsal' ),
        'id'            => 'konsal-offcanvth-sidebar',
        'description'   => esc_html__( 'Add Page Offcanvas Widgets Here.', 'konsal' ),
        'before_widget' => '<div id="%1$s" class="widget %2$s">',
        'after_widget'  => '</div>',
        'before_title'  => '<h3 class="widget_title">',
        'after_title'   => '</h3>',
    ) );
    if( class_exists('woocommerce') ) {
        register_sidebar(
            array(
                'name'          => esc_html__( 'WooCommerce Sidebar', 'konsal' ),
                'id'            => 'konsal-woo-sidebar',
                'description'   => esc_html__( 'Add widgets here to appear in your woocommerce page sidebar.', 'konsal' ),
                'before_widget' => '<div class="widget %2$s">',
                'after_widget'  => '</div>',
                'before_title'  => '<h4 class="widget_title">',
                'after_title'   => '</h4>',
            )
        );
    }

}

add_action( 'widgets_init', 'konsal_widgets_init' );