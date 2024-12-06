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

    if( class_exists( 'ReduxFramework' ) ) {
        $konsal404title        = konsal_opt( 'konsal_fof_title' );
        $konsal404description  = konsal_opt( 'konsal_fof_description' );
        $konsal404btntext      = konsal_opt( 'konsal_fof_btn_text' );
    } else {
        $konsal404title        = __( 'Ooops Page Not Found', 'konsal' );
        $konsal404description  = __( 'It looks like nothing was found at this location. Maybe try one of the links below or a search?', 'konsal' );
        $konsal404btntext      = __( ' Back To Home', 'konsal');

        
    }

    // get header
    get_header();

    echo '<div class="space">';
        echo '<div class="container">';
            echo '<div class="error-img">';
                if(!empty(konsal_opt('konsal_404_bg', 'url' ) )){
                    echo '<img src="'.esc_url( konsal_opt('konsal_404_bg', 'url' ) ).'" alt="'.esc_attr__('404 image', 'konsal').'">';
                }else{
                    echo '<img src="'.get_template_directory_uri().'/assets/img/error.svg" alt="'.esc_attr__('404 image', 'konsal').'">';
                }
            echo '</div>';
            echo '<div class="error-content">';
                echo '<h2 class="error-title">'.wp_kses_post( $konsal404title ).'</h3>';
                echo '<p class="error-text">'.esc_html( $konsal404description ).'</p>';
                echo '<a href="'.esc_url( home_url('/') ).'" class="th-btn error-btn">'.esc_html( $konsal404btntext ).'<i class="far fa-paper-plane ms-2"></i></a>';
            echo '</div>';
        echo '</div>';
    echo '</div>';
    //footer
    get_footer();