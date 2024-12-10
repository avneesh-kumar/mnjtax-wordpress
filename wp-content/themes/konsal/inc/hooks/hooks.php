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

	/**
	* Hook for preloader
	*/
	add_action( 'konsal_preloader_wrap', 'konsal_preloader_wrap_cb', 10 );

	/**
	* Hook for offcanvas cart
	*/
	add_action( 'konsal_main_wrapper_start', 'konsal_main_wrapper_start_cb', 10 );

	/**
	* Hook for Header
	*/
	add_action( 'konsal_header', 'konsal_header_cb', 10 );
	
	/**
	* Hook for Blog Start Wrapper
	*/
	add_action( 'konsal_blog_start_wrap', 'konsal_blog_start_wrap_cb', 10 );
	
	/**
	* Hook for Blog Column Start Wrapper
	*/
    add_action( 'konsal_blog_col_start_wrap', 'konsal_blog_col_start_wrap_cb', 10 );
	
	/**
	* Hook for Blog Column End Wrapper
	*/
    add_action( 'konsal_blog_col_end_wrap', 'konsal_blog_col_end_wrap_cb', 10 );
	
	/**
	* Hook for Blog Column End Wrapper
	*/
    add_action( 'konsal_blog_end_wrap', 'konsal_blog_end_wrap_cb', 10 );
	
	/**
	* Hook for Blog Pagination
	*/
    add_action( 'konsal_blog_pagination', 'konsal_blog_pagination_cb', 10 );
    
    /**
	* Hook for Blog Content
	*/
	add_action( 'konsal_blog_content', 'konsal_blog_content_cb', 10 );
    
    /**
	* Hook for Blog Sidebar
	*/
	add_action( 'konsal_blog_sidebar', 'konsal_blog_sidebar_cb', 10 );
    
    /**
	* Hook for Blog Details Sidebar
	*/
	add_action( 'konsal_blog_details_sidebar', 'konsal_blog_details_sidebar_cb', 10 );

	/**
	* Hook for Blog Details Wrapper Start
	*/
	add_action( 'konsal_blog_details_wrapper_start', 'konsal_blog_details_wrapper_start_cb', 10 );

	/**
	* Hook for Blog Details Post Meta
	*/
	add_action( 'konsal_blog_post_meta', 'konsal_blog_post_meta_cb', 10 );

	/**
	* Hook for Blog Details Post Share Options
	*/
	add_action( 'konsal_blog_details_share_options', 'konsal_blog_details_share_options_cb', 10 );

	/**
	* Hook for Blog Details Post Author Bio
	*/
	add_action( 'konsal_blog_details_author_bio', 'konsal_blog_details_author_bio_cb', 10 );

	/**
	* Hook for Blog Details Tags and Categories
	*/
	add_action( 'konsal_blog_details_tags_and_categories', 'konsal_blog_details_tags_and_categories_cb', 10 );

	/**
	* Hook for Blog Details Related Post Navigation
	*/
	add_action( 'konsal_blog_details_post_navigation', 'konsal_blog_details_post_navigation_cb', 10 );

	/**
	* Hook for Blog Deatils Comments
	*/
	add_action( 'konsal_blog_details_comments', 'konsal_blog_details_comments_cb', 10 );

	/**
	* Hook for Blog Deatils Column Start
	*/
	add_action('konsal_blog_details_col_start','konsal_blog_details_col_start_cb');

	/**
	* Hook for Blog Deatils Column End
	*/
	add_action('konsal_blog_details_col_end','konsal_blog_details_col_end_cb');

	/**
	* Hook for Blog Deatils Wrapper End
	*/
	add_action('konsal_blog_details_wrapper_end','konsal_blog_details_wrapper_end_cb');
	
	/**
	* Hook for Blog Post Thumbnail
	*/
	add_action('konsal_blog_post_thumb','konsal_blog_post_thumb_cb');
    
	/**
	* Hook for Blog Post Content
	*/
	add_action('konsal_blog_post_content','konsal_blog_post_content_cb');
	
    
	/**
	* Hook for Blog Post Excerpt And Read More Button
	*/
	add_action('konsal_blog_postexcerpt_read_content','konsal_blog_postexcerpt_read_content_cb');
	
	/**
	* Hook for footer content
	*/
	add_action( 'konsal_footer_content', 'konsal_footer_content_cb', 10 );
	
	/**
	* Hook for main wrapper end
	*/
	add_action( 'konsal_main_wrapper_end', 'konsal_main_wrapper_end_cb', 10 );
	
	/**
	* Hook for Back to Top Button
	*/
	add_action( 'konsal_back_to_top', 'konsal_back_to_top_cb', 10 );

	/**
	* Hook for Page Start Wrapper
	*/
	add_action( 'konsal_page_start_wrap', 'konsal_page_start_wrap_cb', 10 );

	/**
	* Hook for Page End Wrapper
	*/
	add_action( 'konsal_page_end_wrap', 'konsal_page_end_wrap_cb', 10 );

	/**
	* Hook for Page Column Start Wrapper
	*/
	add_action( 'konsal_page_col_start_wrap', 'konsal_page_col_start_wrap_cb', 10 );

	/**
	* Hook for Page Column End Wrapper
	*/
	add_action( 'konsal_page_col_end_wrap', 'konsal_page_col_end_wrap_cb', 10 );

	/**
	* Hook for Page Column End Wrapper
	*/
	add_action( 'konsal_page_sidebar', 'konsal_page_sidebar_cb', 10 );

	/**
	* Hook for Page Content
	*/
	add_action( 'konsal_page_content', 'konsal_page_content_cb', 10 );