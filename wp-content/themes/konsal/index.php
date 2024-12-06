<?php
/**
 * @Packge     : Konsal
 * @Version    : 1.0
 * @Author     : Themeholy
 * @Author URI : https://www.themeholy.com/
 *
 */

// Block direct access
if ( ! defined( 'ABSPATH' ) ) {
    exit;
}   
    // Header
    get_header();

    /**
    * 
    * Hook for Blog Start Wrapper
    *
    * Hook konsal_blog_start_wrap
    *
    * @Hooked konsal_blog_start_wrap_cb 10
    *  
    */
    do_action( 'konsal_blog_start_wrap' );

    /**
    * 
    * Hook for Blog Column Start Wrapper
    *
    * Hook konsal_blog_col_start_wrap
    *
    * @Hooked konsal_blog_col_start_wrap_cb 10
    *  
    */
    do_action( 'konsal_blog_col_start_wrap' );

    /**
    * 
    * Hook for Blog Content
    *
    * Hook konsal_blog_content
    *
    * @Hooked konsal_blog_content_cb 10
    *  
    */
    do_action( 'konsal_blog_content' );

    /**
    * 
    * Hook for Blog Pagination
    *
    * Hook konsal_blog_pagination
    *
    * @Hooked konsal_blog_pagination_cb 10
    *  
    */
    do_action( 'konsal_blog_pagination' ); 

    /**
    * 
    * Hook for Blog Column End Wrapper
    *
    * Hook konsal_blog_col_end_wrap
    *
    * @Hooked konsal_blog_col_end_wrap_cb 10
    *  
    */
    do_action( 'konsal_blog_col_end_wrap' ); 

    /**
    * 
    * Hook for Blog Sidebar
    *
    * Hook konsal_blog_sidebar
    *
    * @Hooked konsal_blog_sidebar_cb 10
    *  
    */
    do_action( 'konsal_blog_sidebar' );     
        
    /**
    * 
    * Hook for Blog End Wrapper
    *
    * Hook konsal_blog_end_wrap
    *
    * @Hooked konsal_blog_end_wrap_cb 10
    *  
    */
    do_action( 'konsal_blog_end_wrap' );

    //footer
    get_footer();