<?php
// Block direct access
if( !defined( 'ABSPATH' ) ){
    exit();
}
/**
 * @Packge     : Konsal
 * @Version    : 1.0
 * @Author     : Themeholy
 * @Author URI : https://www.themeholy.com/
 *
 */

// enqueue css
function konsal_common_custom_css(){
    wp_enqueue_style( 'konsal-color-schemes', get_template_directory_uri().'/assets/css/color.schemes.css' );

    $CustomCssOpt  = konsal_opt( 'konsal_css_editor' );
    if( $CustomCssOpt ){
        $CustomCssOpt = $CustomCssOpt;
    }else{
        $CustomCssOpt = '';
    }

    $customcss = "";
    
    if( get_header_image() ){
        $konsal_header_bg =  get_header_image();
    }else{
        if( konsal_meta( 'page_breadcrumb_settings' ) == 'page' ){
            if( ! empty( konsal_meta( 'breadcumb_image' ) ) ){
                $konsal_header_bg = konsal_meta( 'breadcumb_image' );
            }
        }
    }
    
    if( !empty( $konsal_header_bg ) ){
        $customcss .= ".breadcumb-wrapper{
            background-image:url('{$konsal_header_bg}')!important;
        }";
    }
    
    // theme color 1
    $konsalthemecolor = konsal_opt('konsal_theme_color');
    if( !empty( $konsalthemecolor ) ){
        list($r, $g, $b) = sscanf( $konsalthemecolor, "#%02x%02x%02x");
        $konsal_real_color = $r.','.$g.','.$b;
        if( !empty( $konsalthemecolor ) ) {
            $customcss .= ":root {
              --theme-color: rgb({$konsal_real_color});
            }";
        }
    }
    // theme color 2
    $konsalthemecolor2 = konsal_opt('konsal_theme_color2');
    if( !empty( $konsalthemecolor2 ) ){
        list($r, $g, $b) = sscanf( $konsalthemecolor2, "#%02x%02x%02x");
        $konsal_real_color = $r.','.$g.','.$b;
        if( !empty( $konsalthemecolor2 ) ) {
            $customcss .= ":root {
              --theme-color2: rgb({$konsal_real_color});
            }";
        }
    }
    // Heading  color
    $konsalheadingcolor = konsal_opt('konsal_heading_color');
    if( !empty( $konsalheadingcolor ) ){
        list($r, $g, $b) = sscanf( $konsalheadingcolor, "#%02x%02x%02x");

        $konsal_real_color = $r.','.$g.','.$b;
        if( !empty( $konsalheadingcolor ) ) {
            $customcss .= ":root {
                --title-color: rgb({$konsal_real_color});
            }";
        }
    }
    // Body color
    $konsalbodycolor = konsal_opt('konsal_body_color');
    if( !empty( $konsalbodycolor ) ){
        list($r, $g, $b) = sscanf( $konsalbodycolor, "#%02x%02x%02x");

        $konsal_real_color = $r.','.$g.','.$b;
        if( !empty( $konsalbodycolor ) ) {
            $customcss .= ":root {
                --body-color: rgb({$konsal_real_color});
            }";
        }
    }

    // Body font
    $konsalbodyfont = konsal_opt('konsal_theme_body_font', 'font-family');
    if( !empty( $konsalbodyfont ) ) {
        $customcss .= ":root {
            --body-font: $konsalbodyfont ;
        }";
    }

    // Heading font
    $konsalheadingfont = konsal_opt('konsal_theme_heading_font', 'font-family');
    if( !empty( $konsalheadingfont ) ) {
        $customcss .= ":root {
            --title-font: $konsalheadingfont ;
        }";
    }

    // Menu icon change
    if(konsal_opt('konsal_menu_icon_class')){
        $menu_icon_class = konsal_opt( 'konsal_menu_icon_class' );
    }else{
        $menu_icon_class = 'f0c6';
    }

    if( !empty( $menu_icon_class ) ) {
        $customcss .= ".main-menu ul.sub-menu li a:before {
                content: \"\\$menu_icon_class\" !important;
            }";
    }


    if( !empty( $CustomCssOpt ) ){
        $customcss .= $CustomCssOpt;
    }

    wp_add_inline_style( 'konsal-color-schemes', $customcss );
}
add_action( 'wp_enqueue_scripts', 'konsal_common_custom_css', 100 );