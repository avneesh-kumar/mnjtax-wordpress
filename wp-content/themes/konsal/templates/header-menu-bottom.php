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
        exit();
    }

    if( defined( 'CMB2_LOADED' )  ){
        if( !empty( konsal_meta('page_breadcrumb_area') ) ) {
            $konsal_page_breadcrumb_area  = konsal_meta('page_breadcrumb_area');
        } else {
            $konsal_page_breadcrumb_area = '1';
        }
    }else{
        $konsal_page_breadcrumb_area = '1';
    }
    
    $allowhtml = array(
        'p'         => array(
            'class'     => array()
        ),
        'span'      => array(
            'class'     => array(),
        ),
        'a'         => array(
            'href'      => array(),
            'title'     => array()
        ),
        'br'        => array(),
        'em'        => array(),
        'strong'    => array(),
        'b'         => array(),
        'sub'       => array(),
        'sup'       => array(),
    );
    
    if(  is_page() || is_page_template( 'template-builder.php' )  ) {
        if( $konsal_page_breadcrumb_area == '1' ) {
            echo '<!-- Page title 2 -->';
            echo '<div class="breadcumb-wrapper">';
                if( !empty( konsal_opt('konsal_allHeader_shape', 'url' ) ) ){
                    echo '<div class="breadcumb-shape1">';
                        echo '<img src="'.esc_url( konsal_opt('konsal_allHeader_shape', 'url' ) ).'" alt="img">';
                    echo '</div>';
                }
                if( !empty( konsal_opt('konsal_allHeader_shape2', 'url' ) ) ){
                    echo '<div class="breadcumb-shape2">';
                        echo '<img src="'.esc_url( konsal_opt('konsal_allHeader_shape2', 'url' ) ).'" alt="img">';
                    echo '</div>';
                }
                echo '<div class="container">';
                    echo '<div class="breadcumb-content text-center">';
                        if( defined('CMB2_LOADED') || class_exists('ReduxFramework') ) {
                            if( !empty( konsal_meta('page_breadcrumb_settings') ) ) {
                                if( konsal_meta('page_breadcrumb_settings') == 'page' ) {
                                    $konsal_page_title_switcher = konsal_meta('page_title');
                                } else {
                                    $konsal_page_title_switcher = konsal_opt('konsal_page_title_switcher');
                                }
                            } else {
                                $konsal_page_title_switcher = '1';
                            }
                        } else {
                            $konsal_page_title_switcher = '1';
                        }

                        if( $konsal_page_title_switcher ){
                            if( class_exists( 'ReduxFramework' ) ){
                                $konsal_page_title_tag    = konsal_opt('konsal_page_title_tag');
                            }else{
                                $konsal_page_title_tag    = 'h1';
                            }

                            if( defined( 'CMB2_LOADED' )  ){
                                if( !empty( konsal_meta('page_title_settings') ) ) {
                                    $konsal_custom_title = konsal_meta('page_title_settings');
                                } else {
                                    $konsal_custom_title = 'default';
                                }
                            }else{
                                $konsal_custom_title = 'default';
                            }

                            if( $konsal_custom_title == 'default' ) {
                                echo konsal_heading_tag(
                                    array(
                                        "tag"   => esc_attr( $konsal_page_title_tag ),
                                        "text"  => esc_html( get_the_title( ) ),
                                        'class' => 'breadcumb-title'
                                    )
                                );
                            } else {
                                echo konsal_heading_tag(
                                    array(
                                        "tag"   => esc_attr( $konsal_page_title_tag ),
                                        "text"  => esc_html( konsal_meta('custom_page_title') ),
                                        'class' => 'breadcumb-title'
                                    )
                                );
                            }

                        }
                        if( defined('CMB2_LOADED') || class_exists('ReduxFramework') ) {

                            if( konsal_meta('page_breadcrumb_settings') == 'page' ) {
                                $konsal_breadcrumb_switcher = konsal_meta('page_breadcrumb_trigger');
                            } else {
                                $konsal_breadcrumb_switcher = konsal_opt('konsal_enable_breadcrumb');
                            }

                        } else {
                            $konsal_breadcrumb_switcher = '1';
                        }

                        if( $konsal_breadcrumb_switcher == '1' && (  is_page() || is_page_template( 'template-builder.php' ) )) {
                            konsal_breadcrumbs(
                                array(
                                    'breadcrumbs_classes' => 'nav',
                                )
                            );
                        }
                    echo '</div>';
                   
                echo '</div>';
            echo '</div>';
            echo '<!-- End of Page title -->';
            
        }
    } else {
        echo '<!-- Page title 3 -->';
        echo '<div class="breadcumb-wrapper">';
            if( !empty( konsal_opt('konsal_allHeader_shape', 'url' ) ) ){
                echo '<div class="breadcumb-shape1">';
                    echo '<img src="'.esc_url( konsal_opt('konsal_allHeader_shape', 'url' ) ).'" alt="img">';
                echo '</div>';
            }
            if( !empty( konsal_opt('konsal_allHeader_shape2', 'url' ) ) ){
                echo '<div class="breadcumb-shape2">';
                    echo '<img src="'.esc_url( konsal_opt('konsal_allHeader_shape2', 'url' ) ).'" alt="img">';
                echo '</div>';
            }
            echo '<div class="container">';
                echo '<div class="breadcumb-content text-center">';
                    if( class_exists( 'ReduxFramework' )  ){
                        $konsal_page_title_switcher  = konsal_opt('konsal_page_title_switcher');
                    }else{
                        $konsal_page_title_switcher = '1';
                    }

                    if( $konsal_page_title_switcher ){
                        if( class_exists( 'ReduxFramework' ) ){
                            $konsal_page_title_tag    = konsal_opt('konsal_page_title_tag');
                        }else{
                            $konsal_page_title_tag    = 'h1';
                        }
                        if( class_exists('woocommerce') && is_shop() ) {
                            echo konsal_heading_tag(
                                array(
                                    "tag"   => esc_attr( $konsal_page_title_tag ),
                                    "text"  => wp_kses( woocommerce_page_title( false ), $allowhtml ),
                                    'class' => 'breadcumb-title'
                                )
                            );
                        }elseif ( is_archive() ){
                            echo konsal_heading_tag(
                                array(
                                    "tag"   => esc_attr( $konsal_page_title_tag ),
                                    "text"  => wp_kses( get_the_archive_title(), $allowhtml ),
                                    'class' => 'breadcumb-title'
                                )
                            );
                        }elseif ( is_home() ){
                            $konsal_blog_page_title_setting = konsal_opt('konsal_blog_page_title_setting');
                            $konsal_blog_page_title_switcher = konsal_opt('konsal_blog_page_title_switcher');
                            $konsal_blog_page_custom_title = konsal_opt('konsal_blog_page_custom_title');
                            if( class_exists('ReduxFramework') ){
                                if( $konsal_blog_page_title_switcher ){
                                    echo konsal_heading_tag(
                                        array(
                                            "tag"   => esc_attr( $konsal_page_title_tag ),
                                            "text"  => !empty( $konsal_blog_page_custom_title ) && $konsal_blog_page_title_setting == 'custom' ? esc_html( $konsal_blog_page_custom_title) : esc_html__( 'Latest News', 'konsal' ),
                                            'class' => 'breadcumb-title'
                                        )
                                    );
                                }
                            }else{
                                echo konsal_heading_tag(
                                    array(
                                        "tag"   => "h1",
                                        "text"  => esc_html__( 'Latest News', 'konsal' ),
                                        'class' => 'breadcumb-title',
                                    )
                                );
                            }
                        }elseif( is_search() ){
                            echo konsal_heading_tag(
                                array(
                                    "tag"   => esc_attr( $konsal_page_title_tag ),
                                    "text"  => esc_html__( 'Search Result', 'konsal' ),
                                    'class' => 'breadcumb-title'
                                )
                            );
                        }elseif( is_404() ){
                            echo konsal_heading_tag(
                                array(
                                    "tag"   => esc_attr( $konsal_page_title_tag ),
                                    "text"  => esc_html__( '404 PAGE', 'konsal' ),
                                    'class' => 'breadcumb-title'
                                )
                            );
                        }elseif( is_singular( 'product' ) ){
                            $posttitle_position  = konsal_opt('konsal_product_details_title_position');
                            $postTitlePos = false;
                            if( class_exists( 'ReduxFramework' ) ){
                                if( $posttitle_position && $posttitle_position != 'header' ){
                                    $postTitlePos = true;
                                }
                            }else{
                                $postTitlePos = false;
                            }

                            if( $postTitlePos != true ){
                                echo konsal_heading_tag(
                                    array(
                                        "tag"   => esc_attr( $konsal_page_title_tag ),
                                        "text"  => wp_kses( get_the_title( ), $allowhtml ),
                                        'class' => 'breadcumb-title'
                                    )
                                );
                            } else {
                                if( class_exists( 'ReduxFramework' ) ){
                                    $konsal_post_details_custom_title  = konsal_opt('konsal_product_details_custom_title');
                                }else{
                                    $konsal_post_details_custom_title = __( 'Shop Details','konsal' );
                                }

                                if( !empty( $konsal_post_details_custom_title ) ) {
                                    echo konsal_heading_tag(
                                        array(
                                            "tag"   => esc_attr( $konsal_page_title_tag ),
                                            "text"  => wp_kses( $konsal_post_details_custom_title, $allowhtml ),
                                            'class' => 'breadcumb-title'
                                        )
                                    );
                                }
                            }
                        }else{
                            $posttitle_position  = konsal_opt('konsal_post_details_title_position');
                            $postTitlePos = false;
                            if( is_single() ){
                                if( class_exists( 'ReduxFramework' ) ){
                                    if( $posttitle_position && $posttitle_position != 'header' ){
                                        $postTitlePos = true;
                                    }
                                }else{
                                    $postTitlePos = false;
                                }
                            }
                            if( is_singular( 'product' ) ){
                                $posttitle_position  = konsal_opt('konsal_product_details_title_position');
                                $postTitlePos = false;
                                if( class_exists( 'ReduxFramework' ) ){
                                    if( $posttitle_position && $posttitle_position != 'header' ){
                                        $postTitlePos = true;
                                    }
                                }else{
                                    $postTitlePos = false;
                                }
                            }

                            if( $postTitlePos != true ){
                                echo konsal_heading_tag(
                                    array(
                                        "tag"   => esc_attr( $konsal_page_title_tag ),
                                        "text"  => wp_kses( get_the_title( ), $allowhtml ),
                                        'class' => 'breadcumb-title'
                                    )
                                );
                            } else {
                                if( class_exists( 'ReduxFramework' ) ){
                                    $konsal_post_details_custom_title  = konsal_opt('konsal_post_details_custom_title');
                                }else{
                                    $konsal_post_details_custom_title = __( 'Blog Details','konsal' );
                                }

                                if( !empty( $konsal_post_details_custom_title ) ) {
                                    echo konsal_heading_tag(
                                        array(
                                            "tag"   => esc_attr( $konsal_page_title_tag ),
                                            "text"  => wp_kses( $konsal_post_details_custom_title, $allowhtml ),
                                            'class' => 'breadcumb-title'
                                        )
                                    );
                                }
                            }
                        }
                    }
                    if( class_exists('ReduxFramework') ) {
                        $konsal_breadcrumb_switcher = konsal_opt( 'konsal_enable_breadcrumb' );
                    } else {
                        $konsal_breadcrumb_switcher = '1';
                    }
                    if( $konsal_breadcrumb_switcher == '1' ) {
                        konsal_breadcrumbs(
                            array(
                                'breadcrumbs_classes' => 'nav',
                            )
                        );
                    }
                echo '</div>';                
            echo '</div>';
        echo '</div>';
        echo '<!-- End of Page title -->';
    }