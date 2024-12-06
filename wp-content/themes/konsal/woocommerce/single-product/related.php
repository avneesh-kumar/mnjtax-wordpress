<?php
/**
 * Related Products
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/single-product/related.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see         https://docs.woocommerce.com/document/template-structure/
 * @package     WooCommerce/Templates
 * @version     3.9.0
 */

if ( ! defined( 'ABSPATH' ) ) {
    exit;
}
if( class_exists('ReduxFramework') ) {
    $konsal_woo_relproduct_display = konsal_opt('konsal_woo_relproduct_display');
    $konsal_woo_relproduct_num = konsal_opt('konsal_woo_relproduct_num');
    $konsal_woo_relproduct_slider = konsal_opt('konsal_woo_relproduct_slider');

    $subtitle = konsal_opt('konsal_woo_relproduct_subtitle');
    $title = konsal_opt('konsal_woo_relproduct_title');
}else{
    $konsal_woo_relproduct_display ='';
    $konsal_woo_relproduct_num = '';
    $konsal_woo_relproduct_slider = '';

    $subtitle = esc_html__('','konsal');
    $title = esc_html__('Related Shop','konsal'); 
}



if ( $related_products && $konsal_woo_relproduct_display){

    if( class_exists('ReduxFramework') ) {
        $konsal_woo_related_product_col = konsal_opt('konsal_woo_related_product_col');
        if( $konsal_woo_related_product_col == '2' ) {
            $konsal_woo_product_col_val = 'col-xl-2 col-lg-4 col-sm-6 mb-30';
        } elseif( $konsal_woo_related_product_col == '3' ) {
            $konsal_woo_product_col_val = 'col-xl-3 col-lg-4 col-sm-6 mb-30';
        } elseif( $konsal_woo_related_product_col == '4' ) {
            $konsal_woo_product_col_val = 'col-xl-4 col-lg-4 col-sm-6 mb-30';
        } elseif( $konsal_woo_related_product_col == '6' ) {
            $konsal_woo_product_col_val = 'col-lg-6 col-sm-6 mb-30';
        }
    } else {
        $konsal_woo_product_col_val = 'col-xl-3 col-lg-4 col-sm-6 mb-30';
    }
    
    $slider_active = $konsal_woo_relproduct_slider ? 'swiper-slide' : $konsal_woo_product_col_val ;

        echo '<div class="related-products space-extra-top">';
            echo '<div class="row justify-content-between align-items-center">';
                echo '<div class="col-md-auto">';
                    if(!empty($subtitle)){
                        echo '<span class="sub-title">'.esc_html($subtitle).'</span>';
                    }
                    if(!empty($title)){
                        echo '<h2 class="sec-title text-center">'.esc_html($title).'</h2>';
                    }
                echo '</div>';
                echo '<div class="col-md d-none d-sm-block">';
                    echo '<hr class="title-line">';
                echo '</div>';
                echo '<div class="col-md-auto d-none d-md-block">';
                    echo '<div class="sec-btn">';
                        echo '<div class="icon-box">';
                            echo '<button data-slider-prev="#productSlider1" class="slider-arrow default"><i class="far fa-arrow-left"></i></button>';
                            echo '<button data-slider-next="#productSlider1" class="slider-arrow default"><i class="far fa-arrow-right"></i></button>';
                        echo '</div>';
                    echo '</div>';
                echo '</div>';
            echo '</div>';

                if($konsal_woo_relproduct_slider){
                echo '<div class="swiper th-slider has-shadow" id="productSlider1" data-slider-options=\'{"breakpoints":{"0":{"slidesPerView":1},"576":{"slidesPerView":"2"},"768":{"slidesPerView":"2"},"992":{"slidesPerView":"3"},"1200":{"slidesPerView":"4"}}}\'>';
                    echo '<div class="swiper-wrapper">';
                }else{
                    echo '<div class="row">';
                }
                    foreach ( $related_products as $related_product ){
                        echo '<div class="'.esc_attr($slider_active).'">';
                            $post_object = get_post( $related_product->get_id() );
        
                            setup_postdata( $GLOBALS['post'] =& $post_object );
        
                            wc_get_template_part( 'content', 'product' );
                        echo '</div>';
                    }
                if($konsal_woo_relproduct_slider){
                    echo '</div>';
                echo '</div>';
                }else{
                    echo '</div>';
                }

                echo '<div class="d-block d-md-none mt-40 text-center">';
                    echo '<div class="icon-box">';
                        echo '<button data-slider-prev="#productSlider1" class="slider-arrow default"><i class="far fa-arrow-left"></i></button>';
                        echo '<button data-slider-next="#productSlider1" class="slider-arrow default"><i class="far fa-arrow-right"></i></button>';
                    echo '</div>';
                echo '</div>';

        echo '</div>';

}

wp_reset_postdata();