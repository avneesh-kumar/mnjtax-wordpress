<?php
/**
 * @Packge     : Konsal
 * @Version    : 1.0
 * @Author     : Themeholy
 * @Author URI : https://www.themeholy.com/
 *
 */

    // Block direct access
    if( ! defined( 'ABSPATH' ) ){
        exit();
    }

    if( class_exists( 'ReduxFramework' ) && defined('ELEMENTOR_VERSION') ) {
        if( is_page() || is_page_template('template-builder.php') ) {
            $konsal_post_id = get_the_ID();

            // Get the page settings manager
            $konsal_page_settings_manager = \Elementor\Core\Settings\Manager::get_settings_managers( 'page' );

            // Get the settings model for current post
            $konsal_page_settings_model = $konsal_page_settings_manager->get_model( $konsal_post_id );

            // Retrieve the color we added before
            $konsal_header_style = $konsal_page_settings_model->get_settings( 'konsal_header_style' );
            $konsal_header_builder_option = $konsal_page_settings_model->get_settings( 'konsal_header_builder_option' );

            if( $konsal_header_style == 'header_builder'  ) {

                if( !empty( $konsal_header_builder_option ) ) {
                    $konsalheader = get_post( $konsal_header_builder_option );
                    echo '<header class="header">';
                        echo \Elementor\Plugin::instance()->frontend->get_builder_content_for_display( $konsalheader->ID );
                    echo '</header>';
                }
            } else {
                // global options
                $konsal_header_builder_trigger = konsal_opt('konsal_header_options');
                if( $konsal_header_builder_trigger == '2' ) {
                    echo '<header>';
                    $konsal_global_header_select = get_post( konsal_opt( 'konsal_header_select_options' ) );
                    $header_post = get_post( $konsal_global_header_select );
                    echo \Elementor\Plugin::instance()->frontend->get_builder_content_for_display( $header_post->ID );
                    echo '</header>';
                } else {
                    // wordpress Header
                    konsal_global_header_option();
                }
            }
        } else {
            $konsal_header_options = konsal_opt('konsal_header_options');
            if( $konsal_header_options == '1' ) {
                konsal_global_header_option();
            } else {
                $konsal_header_select_options = konsal_opt('konsal_header_select_options');
                $konsalheader = get_post( $konsal_header_select_options );
                echo '<header class="header">';
                    echo \Elementor\Plugin::instance()->frontend->get_builder_content_for_display( $konsalheader->ID );
                echo '</header>';
            }
        }
    } else {
        konsal_global_header_option();
    }