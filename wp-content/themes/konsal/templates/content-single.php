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

    konsal_setPostViews( get_the_ID() );

    ?>
    <div <?php post_class(); ?>>
    <?php
        if( class_exists('ReduxFramework') ) {
            $konsal_post_details_title_position = konsal_opt('konsal_post_details_title_position');
        } else {
            $konsal_post_details_title_position = 'header';
        }

        $allowhtml = array(
            'p'         => array(
                'class'     => array()
            ),
            'span'      => array(),
            'a'         => array(
                'href'      => array(),
                'title'     => array()
            ),
            'br'        => array(),
            'em'        => array(),
            'strong'    => array(),
            'b'         => array(),
        );
        // Blog Post Thumbnail
        do_action( 'konsal_blog_post_thumb' );

        if( $konsal_post_details_title_position != 'header' ) {
            echo '<h2 class="blog-title h3">'.wp_kses( get_the_title(), $allowhtml ).'</h2>';
        }
        
        echo '<div class="blog-content">';
            // Blog Post Meta
            do_action( 'konsal_blog_post_meta' );

            if( get_the_content() ){

                the_content();
                // Link Pages
                konsal_link_pages();
            }

            if( class_exists('ReduxFramework') ) {
                $konsal_post_details_share_options = konsal_opt('konsal_post_details_share_options');
            } else {
                $konsal_post_details_share_options = false;
            }
            
            $konsal_post_tag = get_the_tags();
            
            if( ! empty( $konsal_post_tag ) || ( function_exists( 'konsal_social_sharing_buttons' ) || $konsal_post_details_share_options ) ){
                echo '<div class="share-links clearfix">';
                    echo '<div class="row justify-content-between">';
                        if( is_array( $konsal_post_tag ) && ! empty( $konsal_post_tag ) ){
                            if( count( $konsal_post_tag ) > 1 ){
                                $tag_text = __( 'Tags:', 'konsal' );
                            }else{
                                $tag_text = __( 'Tag:', 'konsal' );
                            }
                            
                            echo '<div class="col-sm-auto">';
                                echo '<span class="share-links-title">'.esc_html( $tag_text ).'</span>';
                                echo '<div class="tagcloud">';
                                    foreach( $konsal_post_tag as $tags ){
                                        echo '<a href="'.esc_url( get_tag_link( $tags->term_id ) ).'">'.esc_html( $tags->name ).'</a>';
                                    }
                                echo '</div>';
                            echo '</div>';
                        }
    
                        /**
                        *
                        * Hook for Blog Details Share Options
                        *
                        * Hook konsal_blog_details_share_options
                        *
                        * @Hooked konsal_blog_details_share_options_cb 10
                        *
                        */
                        do_action( 'konsal_blog_details_share_options' );
                    echo '</div>';
                echo '</div>';
            }

            /**
            *
            * Hook for Blog Details Author Bio
            *
            * Hook konsal_blog_details_author_bio
            *
            * @Hooked konsal_blog_details_author_bio_cb 10
            *
            */
            do_action( 'konsal_blog_details_author_bio' );

            /**
            *
            * Hook for Blog Details Comments
            *
            * Hook konsal_blog_details_comments
            *
            * @Hooked konsal_blog_details_comments_cb 10
            *
            */
            do_action( 'konsal_blog_details_comments' );

        echo '</div>';

    echo '</div>';   
    